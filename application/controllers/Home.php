<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    protected $userUnId;
    protected $isLoggedIn;

    public function __construct()
    {
        parent::__construct();

        // Load session and necessary models
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Basic_model'); // Load BasicModel

        // Get session data
        $this->userUnId = $this->session->userdata('userUnId');
        $this->isLoggedIn = !empty($this->userUnId);

        // Check login
        if (!$this->checkLogin()) {
            redirect(base_url()); // Redirect to login page if not logged in
        }
    }

    private function checkLogin()
    {
        // Check if the user is logged in
        return $this->isLoggedIn;
    }

    private function globalData()
    {
        // Fetch global data from the Basic model
        $data = array();
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

        return $data;
    }

    public function index()
    {
        // Redirect to the home method if logged in
        if (!$this->checkLogin()) {
            redirect(base_url());
        }
        $this->home();
    }

    public function home()
    {
        // Ensure the user is logged in
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        // Fetch global data
        $data = $this->globalData();

        // Load the home view with data
        $this->load->view('dashboard/home', $data);
    }

    public function productsList()
    {
        // Ensure the user is logged in
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        // Example response for another method
        echo "This is another method. User un_id: " . $this->userUnId;
    }
}