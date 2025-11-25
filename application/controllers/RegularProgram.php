<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegularProgram extends CI_Controller
{

    protected $userUnId;
    protected $isLoggedIn;

    public function __construct()
    {
        parent::__construct();

        // Load necessary libraries, helpers, and models
        $this->load->library(['session']);
        $this->load->helper(['url']);
        $this->load->model(['RegularProgram_model', 'Basic_model']); // Load models

        // Get session data
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

    private function globalData()
    {
        // Fetch global data using Basic_model
        $data = array();
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);
        return $data;
    }

    public function programList()
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        // Fetch data using RegularProgram_model and Basic_model
        $data['programs'] = $this->RegularProgram_model->getActivePrograms();
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

        // Load the view with data
        $this->load->view('dashboard/regular_program_list', $data);
    }


    public function orderList($type)
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        $myGatewayList = $this->Basic_model->agentGatewayList($this->session->userdata('userUnId'));

        $fArray = array();

        foreach ($myGatewayList as $gateway) {
            $programRowData = $this->RegularProgram_model->getOrderListByType($type, $gateway['un_id']);
            foreach ($programRowData as $p) {
                array_push($fArray, $p);
            }
        }

        // Sort by created_at in descending order
        usort($fArray, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        $finalArray = array();

        foreach ($fArray as $program) {
            // Fetch user details
            $userData = $this->Basic_model->getUserDetails($program['user_un_id']);

            // If no user data is found, skip this order record
            if (!$userData) {
                continue;
            }

            $programDetails = $this->RegularProgram_model->getProgramDetails($program['regular_program_package_id']);
            $getAgentGatewayDetails = $this->RegularProgram_model->getAgentGatewayDetails($program['gatewayId']);

            $singleArray = array();

            // Populate data for each order
            $singleArray['id'] = $program['id'];
            $singleArray['name'] = $userData['first_name'];
            $singleArray['username'] = $userData['username'];
            $singleArray['email'] = $userData['email'];
            $singleArray['phoneNumber'] = $userData['phone_number'];
            $singleArray['userImg'] = $userData['img'] == "" 
                ? 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg' 
                : $userData['img'];
            $singleArray['programName'] = isset($programDetails['title']) ? $programDetails['title'] : "Unknown";
            $singleArray['amount'] = isset($program['amount']) ? $program['amount'] : 0;
            $singleArray['quantity'] = $program['quantity'];
            $singleArray['paymentMethod'] = isset($getAgentGatewayDetails['name']) ? $getAgentGatewayDetails['name'] : "Unknown";
            $singleArray['paymentMethodIcon'] = isset($getAgentGatewayDetails['image']) 
                ? $getAgentGatewayDetails['image'] 
                : 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg';
            $singleArray['trx'] = $program['trx'];
            $singleArray['ss'] = isset($program['ssLink']) 
                ? $program['ssLink'] 
                : 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg';
            $singleArray['created_at'] = $program['created_at'];
            $singleArray['updated_at'] = $program['created_at']; // using created_at as updated_at doesn't exist
            $singleArray['status'] = $program['status'];

            array_push($finalArray, $singleArray);
        }

        $data['datas'] = $finalArray;
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

        // Load the view with data
        $this->load->view('dashboard/regular_program_order_list', $data);
    }


    public function acceptOrder($id)
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        $getProgramOrderDetails = $this->RegularProgram_model->getProgramOrderDetails($id);

        if (empty($getProgramOrderDetails)) {
            $this->session->set_flashdata('error', 'Order not found!');
            redirect(base_url() . 'regularProgram/orderList/0');
            return;
        }

        if ($getProgramOrderDetails['status'] != 0) {
            $this->session->set_flashdata('error', 'You can not edit this order!');
            redirect(base_url() . 'regularProgram/orderList/0');
            return;
        }

        $quantity = $getProgramOrderDetails['quantity'];
        $customerDetails = $this->Basic_model->getUserDetails($getProgramOrderDetails['user_un_id']);

        $form = array();
        $form['status'] = 1;
        $this->RegularProgram_model->updateProgramOrder($id, $form);

        $AgentDetails = $this->RegularProgram_model->getAgentDetailsByGateway($getProgramOrderDetails['gatewayId']);
        $checking = $this->RegularProgram_model->update_status_requests($AgentDetails['un_id'], $getProgramOrderDetails['regular_program_package_id'], 2, $quantity);

        $this->session->set_flashdata('success', 'Order accepted successfully!');
        redirect(base_url() . 'regularProgram/orderList/1');
    }


    public function rejectOrder($id)
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        $getProgramOrderDetails = $this->RegularProgram_model->getProgramOrderDetails($id);

        if (empty($getProgramOrderDetails)) {
            $this->session->set_flashdata('error', 'Order not found!');
            redirect(base_url() . 'regularProgram/orderList/0');
            return;
        }

        if ($getProgramOrderDetails['status'] != 0) {
            $this->session->set_flashdata('error', 'You can not edit this order!');
            redirect(base_url() . 'regularProgram/orderList/0');
            return;
        }

        $form = array();
        $form['status'] = 2;
        $this->RegularProgram_model->updateProgramOrder($id, $form);

        $this->session->set_flashdata('success', 'Order rejected successfully!');
        redirect(base_url() . 'regularProgram/orderList/2');
    }


    public function buyProgram($programId)
    {
        $programDetails = $this->RegularProgram_model->getProgramDetails($programId);
        $programDetails['price'] = $programDetails['price']+$programDetails['vat'];
        $agentData      = $this->Basic_model->agentDetails($this->userUnId);
        $gatewayList    = $this->RegularProgram_model->getPaymentGateway();
        $items          = $this->RegularProgram_model->getActivePrograms();

        // 1) Validation
        $this->form_validation->set_rules('quantity',   'Quantity',        'required|integer|greater_than_equal_to[1]');
        $this->form_validation->set_rules('gateway_id', 'Payment Gateway', 'required|integer');
        $this->form_validation->set_rules('trx',        'Transaction ID',  'required|trim');

        if ($this->form_validation->run() === FALSE) {
            return $this->load->view('dashboard/buy_regular_program', compact('programDetails','agentData','gatewayList','items'));
        }

        // 2) Gather inputs
        $quantity  = (int) $this->input->post('quantity');
        $gatewayId = (int) $this->input->post('gateway_id');
        $trx       = $this->input->post('trx');

        // 3) Handle screenshot upload → B2
        $ssLink = null;
        if (!empty($_FILES['ssLink']['name'])) {
            // a) Stage locally
            $cfg = [
                'upload_path'   => './uploads/tmp/',
                'allowed_types' => 'jpg|jpeg|png|gif',
                'max_size'      => 2048,
                'file_name'     => uniqid('pay_'),
            ];
            $this->load->library('upload', $cfg);

            if ($this->upload->do_upload('ssLink')) {
                $ud         = $this->upload->data();
                $tmpPath    = $ud['full_path'];
                $mimeType   = $ud['file_type'];
                $remoteName = 'payments/' . $ud['file_name'];

                // b) Push to B2
                $this->load->library('b2');
                try {
                    /** @var \BackblazeB2\Models\UploadFile $file */
                    $file = $this->b2->uploadFile($tmpPath, $remoteName, $mimeType);
    
                    // c) Build the URL (bucket must be public)
                    $ssLink = $this->b2->getFileUrl($remoteName);
                } catch (\Exception $e) {
                    // you could log $e->getMessage() here for debugging
                }

                // d) Cleanup
                @unlink($tmpPath);
            }
        }

        $ssLink = str_replace('\\/', '/', $ssLink);

        // 4) Calculate commission & totals
        // Fixed commission: 50 taka per package
        $price                   = floatval($programDetails['price']);
        $commissionPerUnit       = 50;  // Fixed 50 taka per package
        
        $bagTotal         = $price * $quantity;
        $commissionAmount = $commissionPerUnit * $quantity;
        $finalAmount      = $bagTotal - $commissionAmount;

        // 5) Save order
        $order = [
            'agent_un_id'          => $this->userUnId,
            'program_un_id'        => $programId,
            'quantity'             => $quantity,
            'price_per_unit'       => $price,
            'commission_per_unit'  => $commissionPerUnit,
            'commission_amount'    => $commissionAmount,
            'balance_used'         => 0,
            'total_amount'         => $finalAmount,
            'gateway_id'           => $gatewayId,
            'trx'                  => $trx,
            'ssLink'               => $ssLink,
            'status'               => 0,
            'created_at'           => date('Y-m-d H:i:s'),
            'updated_at'           => date('Y-m-d H:i:s')
        ];

        $this->RegularProgram_model->buyProgramRequest($order);
        $this->session->set_flashdata('success', 'Regular program buy request submitted successfully!');
        redirect(base_url('regularProgram/programList'));
    }


    public function myPrograms()
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        // Get agent's programs inventory
        $data['myPrograms'] = $this->RegularProgram_model->getAgentPrograms($this->userUnId);
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

        // Load the view with data
        $this->load->view('dashboard/my_regular_programs', $data);
    }


    public function buyRequestList($status = 'all')
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        // Get agent's buy requests
        $data['requests'] = $this->RegularProgram_model->getAgentBuyRequests($this->userUnId, $status);
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);
        $data['status'] = $status;

        // Load the view with data
        $this->load->view('dashboard/regular_program_buy_requests', $data);
    }


    public function viewRequest($id)
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        $data['request'] = $this->RegularProgram_model->getBuyRequestDetails($id);
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

        if (empty($data['request']) || $data['request']['agent_un_id'] != $this->userUnId) {
            $this->session->set_flashdata('error', 'Request not found!');
            redirect(base_url() . 'regularProgram/buyRequestList');
            return;
        }

        // Get program details
        $data['programDetails'] = $this->RegularProgram_model->getProgramDetails($data['request']['program_un_id']);

        // Load the view with data
        $this->load->view('dashboard/view_regular_program_request', $data);
    }
}
