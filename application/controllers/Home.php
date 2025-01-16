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
        $this->load->model(['Basic_model', 'Course_model']);

        // Get session data
        $this->userUnId = $this->session->userdata('userUnId');
        $this->isLoggedIn = !empty($this->userUnId);

        // Check login
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
        $data = array();
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

        return $data;
    }

    public function index()
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }
        $this->home();
    }

    public function home()
    {
        if (!$this->checkLogin()) {
            redirect(base_url());
        }


        $myGatewayList = $this->Basic_model->agentGatewayList($this->session->userdata('userUnId'));

        $successfullOrderList = array();
        $pendingOrderList = array();
        $canceledOrderList = array();

        $courseRowData = array();

        foreach ($myGatewayList as $gateway) {
            $courseRowData = $this->Course_model->getOrderListByType('all', $gateway['un_id']);
            foreach ($courseRowData as $c) {
                if ($c['status'] == 0) {
                    array_push($pendingOrderList, $c);
                } else if ($c['status'] == 1) {
                    array_push($successfullOrderList, $c);
                } else if ($c['status'] == 2) {
                    array_push($canceledOrderList, $c);
                }

            }
        }

        $getActiveCourse = $this->Course_model->getActiveCourse();

        $courseList = array();

        foreach ($getActiveCourse as $course) {
            $myCoursesForThisCourse = $this->Basic_model->myCourseList(1, $course['un_id'], $this->session->userdata('userUnId'));
            $course['myCoursesCount'] = count($myCoursesForThisCourse);

            $myGatewayList = $this->Basic_model->agentGatewayList($this->session->userdata('userUnId'));
            $courseSellList = array();
            foreach ($myGatewayList as $gateway) {
                $courseOrderListByGateway = $this->Basic_model->courseOrderListByGateway($course['un_id'], $gateway['un_id']);
                $courseSellList = array_merge($courseSellList, $courseOrderListByGateway);
            }
            $course['courseSellListCount'] = count($courseSellList);
            array_push($courseList, $course);
        }

        $data = $this->globalData();
        $data['successfullOrderList'] = $successfullOrderList == null ? [] : $successfullOrderList;
        $data['pendingOrderList'] = $pendingOrderList == null ? [] : $pendingOrderList;
        $data['canceledOrderList'] = $canceledOrderList == null ? [] : $canceledOrderList;
        $data['allOrders'] = $courseRowData == null ? [] : $courseRowData;
        $data['myGatewayList'] = $myGatewayList == null ? [] : $myGatewayList;
        $data['courseList'] = $courseList == null ? [] : $courseList;

        $this->load->view('dashboard/home', $data);
    }

    function myGateways($status)
    {
        $myGatewayList = $this->Basic_model->agentGatewayListByStatus($this->session->userdata('userUnId'), $status);

        $data = $this->globalData();
        $data['myGatewayList'] = $myGatewayList;

        $this->load->view('dashboard/gateway_list', $data);
    }

    function changeGatewayStatus($gatewayId, $status)
    {
        $form = array('status' => $status);
        $this->Basic_model->changeGatewayStatus($gatewayId, $form);
        redirect(base_url() . 'myGateways/1');
    }
}
