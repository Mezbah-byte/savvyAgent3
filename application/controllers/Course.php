<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course extends CI_Controller
{

    protected $userUnId;
    protected $isLoggedIn;

    public function __construct()
    {
        parent::__construct();

        // Load necessary libraries, helpers, and models
        $this->load->library(['session']);
        $this->load->helper(['url']);
        $this->load->model(['Course_model', 'Basic_model']); // Load models

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

    public function courseList()
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        // Fetch data using Course_model and Basic_model
        $data['courses'] = $this->Course_model->getActiveCourse();
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

        // Load the view with data
        $this->load->view('dashboard/course_list', $data);
    }

    public function orderList($type)
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }

        $courseRowData = $this->Course_model->getOrderListByType(1);

        $finalArray = array();

        foreach ($courseRowData as $course) {
            $singleArray = array();

            // Fetch user, course, and gateway details
            $userData = $this->Basic_model->getUserDetails($course['user_un_id']);
            $courseDetails = $this->Course_model->getCourseDetails($course['course_id']);
            $getAgentGatewayDetails = $this->Course_model->getAgentGatewayDetails($course['gateway_id']);

            // Populate data for each order
            $singleArray['name'] = $userData['first_name'];
            $singleArray['username'] = $userData['username'];
            $singleArray['email'] = $userData['email'];
            $singleArray['phoneNumber'] = $userData['phone_number'];
            $singleArray['userImg'] = $userData['img'] == ""
                ? 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg'
                : $userData['img'];
            $singleArray['courseName'] = $courseDetails['title'];
            $singleArray['paymentMethod'] = isset($getAgentGatewayDetails['name']) ? $getAgentGatewayDetails['name'] : "Unknown";
            $singleArray['paymentMethodIcon'] = isset($getAgentGatewayDetails['image']) ? $getAgentGatewayDetails['image'] : "https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg";

            $singleArray['trx'] = $course['trx'];
            $singleArray['ss'] = 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg';

            array_push($finalArray, $singleArray);
        }

        $data['datas'] = $finalArray;
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

        // Load the view with data
        $this->load->view('dashboard/order_list', $data);
    }
}
