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

        $courseRowData = $this->Course_model->getOrderListByType($type);

        $finalArray = array();

        foreach ($courseRowData as $course) {
            $singleArray = array();

            // Fetch user, course, and gateway details
            $userData = $this->Basic_model->getUserDetails($course['user_un_id']);
            $courseDetails = $this->Course_model->getCourseDetails($course['course_id']);
            $getAgentGatewayDetails = $this->Course_model->getAgentGatewayDetails($course['gateway_id']);

            // Populate data for each order
            $singleArray['id'] = $course['id'];
            $singleArray['name'] = $userData['first_name'];
            $singleArray['username'] = $userData['username'];
            $singleArray['email'] = $userData['email'];
            $singleArray['phoneNumber'] = $userData['phone_number'];
            $singleArray['userImg'] = $userData['img'] == ""
                ? 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg'
                : $userData['img'];
            $singleArray['courseName'] = isset($courseDetails['title']) ? $courseDetails['title'] : "Unknown";
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


    function acceptCoursePayment($id)
    {
        $getCourseOrderDetails = $this->Course_model->getCourseOrderDetails($id);

        $quantity = $getCourseOrderDetails['quantity'];
        $customerDetails = $this->Basic_model->getUserDetails($getCourseOrderDetails['user_un_id']);

        $uData = $this->Basic_model->getUserDetails($customerDetails['refered_by']);
        $courseDetails = $this->Course_model->getCourseDetails($getCourseOrderDetails['course_id']);

        if ($customerDetails['type'] == "open") {
            $data = array();
            $data['packageId'] = $getCourseOrderDetails['course_id'];
            $data['refered_by'] = $uData['un_id'];
            $data['placement_id'] = !empty($this->get_network_by_level($uData['un_id'], 0)) ? count($this->Basic_model->team_list($uData['un_id'])) < 2 ? $uData['un_id'] : $this->get_network_by_level($uData['un_id'], 0)[0]['un_id'] : $uData['un_id'];
            $form['placement_time'] = date('Y-m-d H:i:s');
            $data['type'] = $courseDetails['type'];
            $this->Basic_model->updateCustomer($customerDetails['un_id'], $data);
        }


        $referedBy = $uData['un_id'];
        $a = 0;

        while ($a < 10) {
            $userDetails = $this->Basic_model->getUserDetails($referedBy);
            $bonus = 0;
            if ($userDetails == null) {
                $a = 50;
            } else {
                if ($userDetails['current_post_id'] > -1) {
                    if ($a == 0) {
                        // $bonus = $courseDetails['type'] == "premium"? 500:$courseDetails['type'] == "regularMember"?200:0;
                        $bonus = $courseDetails['type'] == "premium" ? 500 : ($courseDetails['type'] == "regularMember" ? 200 : 0);

                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                    } else if ($a == 1) {
                        // if ($userDetails['current_post_id'] > 9) {
                        $bonus = $courseDetails['type'] == "premium" ? 50 : ($courseDetails['type'] == "regularMember" ? 20 : 0);
                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                        // }
                    } else if ($a == 2) {
                        // if ($userDetails['current_post_id'] > 9) {
                        $bonus = $courseDetails['type'] == "premium" ? 50 : ($courseDetails['type'] == "regularMember" ? 20 : 0);
                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                        // }
                    } else if ($a == 3) {
                        // if ($userDetails['current_post_id'] > 19) {
                        $bonus = $courseDetails['type'] == "premium" ? 50 : ($courseDetails['type'] == "regularMember" ? 20 : 0);
                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                        // }
                    } else if ($a == 4) {
                        // if ($userDetails['current_post_id'] > 19) {
                        $bonus = $courseDetails['type'] == "premium" ? 50 : ($courseDetails['type'] == "regularMember" ? 20 : 0);
                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                        // }
                    } else if ($a == 5) {
                        // if ($userDetails['current_post_id'] > 29) {
                        $bonus = $courseDetails['type'] == "premium" ? 50 : ($courseDetails['type'] == "regularMember" ? 20 : 0);
                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                        // }
                    } else if ($a == 6) {
                        // if ($userDetails['current_post_id'] > 29) {
                        $bonus = $courseDetails['type'] == "premium" ? 50 : ($courseDetails['type'] == "regularMember" ? 20 : 0);
                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                        // }
                    } else if ($a == 7) {
                        // if ($userDetails['current_post_id'] > 39) {
                        $bonus = $courseDetails['type'] == "premium" ? 50 : ($courseDetails['type'] == "regularMember" ? 20 : 0);
                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                        // }
                    } else if ($a == 8) {
                        // if ($userDetails['current_post_id'] > 49) {
                        $bonus = $courseDetails['type'] == "premium" ? 50 : ($courseDetails['type'] == "regularMember" ? 20 : 0);
                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                        // }
                    } else if ($a == 9) {
                        // if ($userDetails['current_post_id'] > 49) {
                        $bonus = $courseDetails['type'] == "premium" ? 50 : ($courseDetails['type'] == "regularMember" ? 20 : 0);
                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity);
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity);
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);
                        // }
                    }

                    if ($bonus != 0) {
                        $form = array();
                        $form['from_user'] = $customerDetails['user_un_id'];
                        $form['to_user'] = $userDetails['un_id'];
                        $form['amount'] = ($bonus * $quantity);
                        $form['package_id'] = $getCourseOrderDetails['course_id'];
                        $form['generation'] = $a;
                        $form['source'] = 'affiliate';
                        $form['packageQuantity'] = $quantity;
                        $form['created_at'] = date('Y-m-d H:i:s');
                        $this->Basic_model->create_income($form);

                        // if ($this->admin_model->getUserFcmData($userDetails['un_id']) != null) {
                        //     sendNotification($this->admin_model->getUserFcmData($userDetails['un_id'])['fcm'], 'Bonus', 'Congratulations! You got generation bonus.', 'https://img.freepik.com/free-psd/casino-bonus-sign-icon-render_23-2149326543.jpg');
                        // }
                    }
                }
                $referedBy = $userDetails['refered_by'];
                $a++;
            }
        }
    }

    function cancelCoursePayment($id)
    {

    }


    function get_network_by_level($un_id, $level = 0)
    {
        $network = array();
        $members = $this->auth_model->team_list($un_id);

        foreach ($members as $member) {
            $member['level'] = $level;
            if (count($this->auth_model->team_list($member['un_id'])) < 2) {
                $network[] = $member;
            }
            $sub_network = $this->get_network_by_level($member['un_id'], $level + 1);
            if (!empty($sub_network)) {
                $network = array_merge($network, $sub_network);
            }
        }

        $levels = array_column($network, 'level');
        array_multisort($levels, SORT_ASC, $network);

        return $network;
    }
}
