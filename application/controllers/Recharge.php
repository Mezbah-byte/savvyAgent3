<?php
// application/controllers/Recharge.php

defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge extends CI_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model(['Product_model', 'Basic_model', 'Recharge_model']);
        $this->load->config('sohojpay');
        // Load other helpers/libraries if needed

        $this->userUnId = $this->session->userdata('userUnId');
        $this->isLoggedIn = !empty($this->userUnId);

        // Redirect to login if not logged in
        if (!$this->checkLogin()) {
            redirect(base_url());
        }
    }


    private function checkLogin()
    {
        return $this->isLoggedIn;
    }

    public function index() {
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);
        $this->load->view('dashboard/recharge_form', $data);
    }

    public function process() {
        $phone = trim((string) $this->input->post('phone'));
        $operator = trim((string) $this->input->post('operator'));
        $type = (string) $this->input->post('type');
        $amount = (string) $this->input->post('amount');

        $cfg = $this->config->item('sohojpay');
        $api_key = $cfg['api_key'];
        $base_url = rtrim($cfg['base_url'], '/');

        // Generate unique transaction ID
        $bytes = random_bytes(5);
        $transactionId = "SAVVY" . strtoupper(bin2hex($bytes));

        $payload_array = [
            'number'    => $phone,
            'operator'  => $operator,
            'tran_id'   => $transactionId,
            'type'      => $type,
            'amount'    => $amount
        ];
        $payload = json_encode($payload_array);

        // Save pending record before API call
        $this->Recharge_model->create([
            'user_un_id' => $this->userUnId,
            'tran_id'    => $transactionId,
            'number'     => $phone,
            'operator'   => $operator,
            'type'       => (int)$type,
            'amount'     => (float)$amount,
            'status'     => 0, // 0=pending, 1=success, 2=failed
        ]);

        $endpoint = $base_url . '/recharge/request/create';
        $ch = curl_init($endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'SOHOJPAY-API-KEY: ' . $api_key
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, isset($cfg['timeout']) ? (int)$cfg['timeout'] : 20);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, isset($cfg['connect_timeout']) ? (int)$cfg['connect_timeout'] : 10);
        if (isset($cfg['verify_ssl']) && !$cfg['verify_ssl']) {
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        }
        $response = curl_exec($ch);
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $curl_error = curl_error($ch);
        curl_close($ch);

        $result = null;
        if ($response !== false) {
            $result = json_decode($response, true);
        }

        // Debug output (if needed)
        // log_message('debug', 'Recharge endpoint: ' . $endpoint . ' payload: ' . $payload . ' response: ' . $response);

        if ($curl_error) {
            // Mark as failed on network error
            $this->Recharge_model->updateByTranId($transactionId, [
                'status' => 2,
                'message' => 'Network error: ' . $curl_error,
                'http_code' => $http_code,
                'api_response' => $response,
            ]);
            $this->session->set_flashdata('error', 'Recharge request failed (network): ' . $curl_error);
            redirect(base_url('recharge/cancel'));
            return;
        }
        // echo '</pre>';

        // Determine success robustly across possible response shapes
        $is_success = false;
        if (is_array($result)) {
            if (isset($result['status'])) {
                $statusVal = $result['status'];
                $statusStr = is_string($statusVal) ? strtolower($statusVal) : $statusVal;
                $is_success = ($statusVal === 1 || $statusVal === '1' || $statusVal === true || $statusStr === 'success' || (int)$statusVal === 200);
            } elseif (isset($result['success'])) {
                $is_success = (bool)$result['success'];
            } elseif (isset($result['code'])) {
                $is_success = ((int)$result['code'] === 200);
            }
        }

        if ($http_code >= 200 && $http_code < 300 && $is_success) {
            // Mark as success
            $this->Recharge_model->updateByTranId($transactionId, [
                'status' => 1,
                'message' => is_array($result) && isset($result['message']) ? (string)$result['message'] : 'Recharge successful',
                'http_code' => $http_code,
                'api_response' => is_string($response) ? $response : json_encode($result),
            ]);
            redirect(base_url('recharge/success'));
            return;
        }

        // Fallback: show meaningful error context
        $message = 'Recharge request failed.';
        if ($http_code && $http_code >= 400) {
            $message .= ' HTTP ' . $http_code . '.';
        }
        if (is_array($result) && isset($result['message']) && $result['message']) {
            $message .= ' ' . $result['message'];
        } elseif ($response) {
            $message .= ' Response: ' . substr($response, 0, 300);
        }
        // Mark as failed and show error
        $this->Recharge_model->updateByTranId($transactionId, [
            'status' => 2,
            'message' => $message,
            'http_code' => $http_code,
            'api_response' => is_string($response) ? $response : json_encode($result),
        ]);
        $this->session->set_flashdata('error', $message);
        redirect(base_url('recharge/cancel'));
    }

    public function success() {
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);
        $this->load->view('dashboard/recharge_success', $data);
    }

    public function cancel() {
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);
        $this->load->view('dashboard/recharge_cancel', $data);
    }

    public function history() {
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);
        // Fetch recharge history for the logged-in user
        $data['history'] = $this->Recharge_model->historyByUser($this->userUnId);
        $this->load->view('dashboard/recharge_history', $data);
    }

    public function webhook() {
        // Handle webhook (optional)
        echo 'Webhook received.';
    }
}
