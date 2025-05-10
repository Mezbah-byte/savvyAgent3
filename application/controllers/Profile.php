<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

    protected $userUnId;
    protected $isLoggedIn;

    public function __construct()
    {
        parent::__construct();

        // Load necessary libraries, helpers, and models
        $this->load->library(['session']);
        $this->load->helper(['url']);
        $this->load->model(['Product_model', 'Basic_model']); // Load models

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

    function profile() {
        $agent = $this->Basic_model->agentDetails($this->userUnId);

        $agent['roles'] = json_decode($agent['comission'], true) ?: [];
        // map to human-friendly labels
        $roleMap = [
          'onlineAgent'    => 'Online Agent',
          'officeSupport'  => 'Office Support',
          'paymentGateway' => 'Payment Gateway',
        ];
        $agent['roles_labels'] = array_map(function($r) use ($roleMap){
          return $roleMap[$r] ?? $r;
        }, $agent['roles']);


        $data['agentData'] = $agent;

        $this->load->view('dashboard/profile', $data);
    }
}
