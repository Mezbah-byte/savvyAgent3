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

        $myGatewayList = $this->Basic_model->agentGatewayList($this->session->userdata('userUnId'));

        $fArray = array();

        foreach ($myGatewayList as $gateway) {
            $courseRowData = $this->Course_model->getOrderListByType($type, $gateway['un_id']);
            foreach ($courseRowData as $c) {
                array_push($fArray, $c);
            }
        }

        // Sort by created_at in descending order
        usort($fArray, function ($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });

        $finalArray = array();

        foreach ($fArray as $course) {
            // Fetch user details
            $userData = $this->Basic_model->getUserDetails($course['user_un_id']);

            // If no user data is found, skip this order record
            if (!$userData) {
                continue;
            }

            $courseDetails = $this->Course_model->getCourseDetails($course['course_id']);
            $getAgentGatewayDetails = $this->Course_model->getAgentGatewayDetails($course['gateway_id']);

            $singleArray = array();

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
            $singleArray['amount'] = isset($courseDetails['price']) ? $courseDetails['price'] : 0;
            $singleArray['quantity'] = $course['quantity'];
            $singleArray['courseType'] = isset($courseDetails['type']) ? $courseDetails['type'] : "";
            $singleArray['paymentMethod'] = isset($getAgentGatewayDetails['name']) ? $getAgentGatewayDetails['name'] : "Unknown";
            $singleArray['paymentMethodIcon'] = isset($getAgentGatewayDetails['image']) 
                ? $getAgentGatewayDetails['image'] 
                : 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg';
            $singleArray['trx'] = $course['trx'];
            $singleArray['ss'] = isset($course['ssLink']) 
                ? $course['ssLink'] 
                : 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg';
            $singleArray['created_at'] = $course['created_at'];
            $singleArray['updated_at'] = $course['updated_at'];
            $singleArray['status'] = $course['status'];

            array_push($finalArray, $singleArray);
        }

        $data['datas'] = $finalArray;
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

        // Load the view with data
        $this->load->view('dashboard/order_list', $data);
    }


    // public function orderList($type)
    // {
    //     if (!$this->checkLogin()) {
    //         redirect(base_url());
    //     }

    //     $myGatewayList = $this->Basic_model->agentGatewayList($this->session->userdata('userUnId'));

    //     $fArray = array();

    //     foreach ($myGatewayList as $gateway) {
    //         $courseRowData = $this->Course_model->getOrderListByType($type, $gateway['un_id']);
    //         foreach ($courseRowData as $c) {
    //             array_push($fArray, $c);
    //         }
    //     }

    //     // Sort by created_at in descending order
    //     usort($fArray, function ($a, $b) {
    //         return strtotime($b['created_at']) - strtotime($a['created_at']);
    //     });

    //     // Limit the results to the latest 10
    //     // $fArray = array_slice($fArray, 0, 10);

    //     $finalArray = array();

    //     foreach ($fArray as $course) {
    //         $singleArray = array();

    //         $userData = $this->Basic_model->getUserDetails($course['user_un_id']);
    //         $courseDetails = $this->Course_model->getCourseDetails($course['course_id']);
    //         $getAgentGatewayDetails = $this->Course_model->getAgentGatewayDetails($course['gateway_id']);

    //         $singleArray['id'] = $course['id'];
    //         $singleArray['name'] = $userData['first_name'];
    //         $singleArray['username'] = $userData['username'];
    //         $singleArray['email'] = $userData['email'];
    //         $singleArray['phoneNumber'] = $userData['phone_number'];
    //         $singleArray['userImg'] = $userData['img'] == ""
    //             ? 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg'
    //             : $userData['img'];
    //         $singleArray['courseName'] = isset($courseDetails['title']) ? $courseDetails['title'] : "Unknown";
    //         $singleArray['amount'] = isset($courseDetails['price']) ? $courseDetails['price'] : 0;
    //         $singleArray['quantity'] = $course['quantity'];
    //         $singleArray['courseType'] = $courseDetails['type'];
    //         $singleArray['paymentMethod'] = isset($getAgentGatewayDetails['name']) ? $getAgentGatewayDetails['name'] : "Unknown";
    //         $singleArray['paymentMethodIcon'] = isset($getAgentGatewayDetails['image']) ? $getAgentGatewayDetails['image'] : "https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg";

    //         $singleArray['trx'] = $course['trx'];
    //         $singleArray['ss'] = isset($course['ssLink']) ? $course['ssLink'] : 'https://img.freepik.com/premium-photo/screenshot-screen-showing-different-planets_1142283-336281.jpg';
    //         $singleArray['created_at'] = $course['created_at'];
    //         $singleArray['updated_at'] = $course['updated_at'];
    //         $singleArray['status'] = $course['status'];

    //         array_push($finalArray, $singleArray);
    //     }

    //     $data['datas'] = $finalArray;
    //     $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);

    //     $this->load->view('dashboard/order_list', $data);
    // }



    function acceptCoursePayment($id)
    {
        $getCourseOrderDetails = $this->Course_model->getCourseOrderDetails($id);

        if ($getCourseOrderDetails['status'] != 0) {
            $this->session->set_flashdata('error', 'You can not edit this order!');
            redirect(base_url() . 'orderList/0');
            return;
        }

        $quantity = $getCourseOrderDetails['quantity'];
        $customerDetails = $this->Basic_model->getUserDetails($getCourseOrderDetails['user_un_id']);

        $uData = $this->Basic_model->getUserDetails($customerDetails['refered_by']);
        $courseDetails = $this->Course_model->getCourseDetails($getCourseOrderDetails['course_id']);

        if ($customerDetails['type'] == "open" || $customerDetails['type'] == "regularMember") {
            $data = array();
            $data['packageId'] = $getCourseOrderDetails['course_id'];
            if ($customerDetails['type'] == "open") {
                $data['refered_by'] = $uData['un_id'];
                $data['placement_id'] = !empty($this->get_network_by_level($uData['un_id'], 0)) ? count($this->Basic_model->team_list($uData['un_id'])) < 2 ? $uData['un_id'] : $this->get_network_by_level($uData['un_id'], 0)[0]['un_id'] : $uData['un_id'];
                $form['placement_time'] = date('Y-m-d H:i:s');
            }

            $data['type'] = $courseDetails['type'];
            $this->Basic_model->updateCustomer($customerDetails['un_id'], $data);
        }

        $form = array();
        $form['status'] = 1;
        $form['updated_at'] = date('Y-m-d H:i:s');
        $this->Course_model->updateCourseOrder($id, $form);

        $AgentDetails = $this->Course_model->getAgentDetailsByGateway($getCourseOrderDetails['gateway_id']);
		$checking = $this->Course_model->update_status_requests($AgentDetails['un_id'], $getCourseOrderDetails['course_id'], 2, $quantity);
        echo $AgentDetails['un_id'].'<br>';
        echo $getCourseOrderDetails['course_id'].'<br>';
        echo $checking.'<br>';
        echo $quantity.'<br>';
        echo json_encode($checking);

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
                        $ibonus = 0;

                        if($courseDetails['type'] == "premium"){
                            if($userDetails['current_post_id'] < 11){
                                $ibonus = 200*$quantity;
                            } else if($userDetails['current_post_id'] == 20){
                                $ibonus = 300*$quantity;
                            } else if($userDetails['current_post_id'] == 30){
                                $ibonus = 400*$quantity;
                            } else if($userDetails['current_post_id'] > 30){
                                $ibonus = 500*$quantity;
                            }  else{
                                $ibonus = 0*$quantity;
                            }
                        } else{
                            $ibonus = 0;
                        }

                        $form = array();
                        $form['total_income'] = $userDetails['total_income'] + ($bonus * $quantity) + $ibonus;
                        $form['current_balance'] = $userDetails['current_balance'] + ($bonus * $quantity) + $ibonus;
                        $this->Basic_model->updateCustomer($userDetails['un_id'], $form);

                        if($courseDetails['type'] == "premium"){
                            $bincome = array();
                            $bincome['from_user'] = $customerDetails['un_id'];
                            $bincome['to_user'] = $userDetails['un_id'];
                            $bincome['amount'] = $ibonus;
                            $bincome['package_id'] = $getCourseOrderDetails['course_id'];
                            $bincome['generation'] = $a;
                            $bincome['source'] = 'bonus_income';
                            $bincome['created_at'] = date('Y-m-d H:i:s');
                            $bincome['title'] = 'Eid Bonus';
                            $bincome['details'] = 'Eid Bonus from My Savvy BD';
                            $this->Basic_model->create_bonus_income($bincome);
                        }
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
                        $form['from_user'] = $customerDetails['un_id'];
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

        $this->session->set_flashdata('success', 'Accepted successfully!');
         redirect(base_url() . 'orderList/0');
    }

    function cancelCoursePayment($id)
    {
        $form = array();
        $form['status'] = 2;
        $this->Course_model->updateCourseOrder($id, $form);

        $this->session->set_flashdata('success', 'Order Canceled!');
        redirect(base_url() . 'orderList/0');
    }


    function get_network_by_level($un_id, $level = 0)
    {
        $network = array();
        $members = $this->Basic_model->team_list($un_id);

        foreach ($members as $member) {
            $member['level'] = $level;
            if (count($this->Basic_model->team_list($member['un_id'])) < 2) {
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


    public function buyCourse($courseId)
    {
        $courseDetails = $this->Course_model->getCourseDetails($courseId);
        $agentData     = $this->Basic_model->agentDetails($this->userUnId);
        $gatewayList   = $this->Course_model->getPaymentGateway();

        // 1) Validation
        $this->form_validation->set_rules('quantity',   'Quantity',        'required|integer|greater_than_equal_to[20]');
        $this->form_validation->set_rules('gateway_id', 'Payment Gateway','required|integer');
        $this->form_validation->set_rules('trx',        'Transaction ID',  'required|trim');

        if ($this->form_validation->run() === FALSE) {
            return $this->load->view('dashboard/buy_course', compact('courseDetails','agentData','gatewayList'));
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
                    // We don’t need to check $file as an array—if no exception, upload succeeded
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
        $map = $courseDetails['type'] === 'premium'
            ? ['onlineAgent'=>100,'officeSupport'=>100]
            : ['onlineAgent'=>20, 'officeSupport'=>20];
            // ? ['onlineAgent'=>100,'officeSupport'=>100,'paymentGateway'=>100]
            // : ['onlineAgent'=>20, 'officeSupport'=>20, 'paymentGateway'=>20];

        preg_match_all('/"([^"]+)"/', $agentData['comission'], $m);
        $types = $m[1] ?? [];
        $commissionPerUnit = 0;
        foreach ($types as $t) {
            if (isset($map[$t])) {
                $commissionPerUnit += $map[$t];
            }
        }

        $price            = floatval($courseDetails['price']);
        $bagTotal         = $price * $quantity;
        $commissionAmount = $commissionPerUnit * $quantity;
        $finalAmount      = $bagTotal - $commissionAmount;

        // 5) Save order
        $order = [
            'agent_un_id'           => $this->userUnId,
            'course_un_id'            => $courseId,
            'quantity'             => $quantity,
            'price_per_unit'       => $price,
            'commission_per_unit'  => $commissionPerUnit,
            'commission_amount'    => $commissionAmount,
            'total_amount'         => $finalAmount,
            'gateway_id'           => $gatewayId,
            'trx'                  => $trx,
            'ssLink'               => $ssLink,
            'status'               => 0,
            'created_at'           => date('Y-m-d H:i:s'),
            'updated_at'           => date('Y-m-d H:i:s')
        ];

        // echo json_encode($order); // Debugging line, remove in production

        $this->Course_model->buyCourseRequest($order);
        $this->session->set_flashdata('success', 'Course bought successfully!');
        redirect(base_url('courses'));
    }

}
