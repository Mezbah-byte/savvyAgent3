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
        // echo json_encode($myGatewayList);

        $fArray = array();

        foreach ($myGatewayList as $gateway) {
            $programRowData = $this->RegularProgram_model->getOrderListByType($type, $gateway['un_id']);
            // echo json_encode($programRowData);
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

        // echo json_encode($data);

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
        $packageId = $getProgramOrderDetails['regular_program_package_id'];
        $userUnId = $getProgramOrderDetails['user_un_id'];
        
        $customerDetails = $this->Basic_model->getUserDetails($userUnId);

        // Check if agent has enough inventory
        $AgentDetails = $this->RegularProgram_model->getAgentDetailsByGateway($getProgramOrderDetails['gatewayId']);
        $availableInventory = $this->RegularProgram_model->getAgentAvailableInventory($AgentDetails['un_id'], $packageId);
        
        if ($availableInventory < $quantity) {
            $this->session->set_flashdata('error', "Insufficient inventory! You have only {$availableInventory} regular programs available, but order requires {$quantity}.");
            redirect(base_url() . 'regularProgram/orderList/0');
            return;
        }

        // Update order status to approved
        $form = array();
        $form['status'] = 1;
        $this->RegularProgram_model->updateProgramOrder($id, $form);

        // Update agent's inventory
        $updatedCount = $this->RegularProgram_model->update_status_requests($AgentDetails['un_id'], $packageId, 2, $quantity);
        
        // Double-check that the inventory was actually updated
        if ($updatedCount < $quantity) {
            // Rollback the order approval
            $rollbackForm = array('status' => 0);
            $this->RegularProgram_model->updateProgramOrder($id, $rollbackForm);
            
            $this->session->set_flashdata('error', "Inventory update failed! Only {$updatedCount} programs were available.");
            redirect(base_url() . 'regularProgram/orderList/0');
            return;
        }

        // Update customer's package status
        $customerUpdateForm = array();
        $customerUpdateForm['current_regular_program_package_id'] = $packageId;

        $uData = $this->Basic_model->getUserDetails($getProgramOrderDetails['referenceId']);
        
        // If user is 'open' type, upgrade to 'premium' and set referral data
        if ($customerDetails['type'] == 'open') {
            $customerUpdateForm['type'] = 'premium';
            $customerUpdateForm['refered_by'] = $getProgramOrderDetails['referenceId'];
            $customerUpdateForm['placement_id'] = !empty($this->get_network_by_level($uData['un_id'], 0)) ? count($this->Basic_model->team_list($uData['un_id'])) < 2 ? $uData['un_id'] : $this->get_network_by_level($uData['un_id'], 0)[0]['un_id'] : $uData['un_id'];
        }
        
        $this->RegularProgram_model->updateUserWallet($userUnId, $customerUpdateForm);

        // $this->sendReferBonus($userUnId, $customerDetails['refered_by'], $packageId, $quantity);
        $this->sendReferBonus($userUnId, $getProgramOrderDetails['referenceId'], $packageId, $quantity);

        // Send royalty bonus
        $this->sendRoyality($userUnId, $packageId, $quantity);

        $this->session->set_flashdata('success', 'Order accepted successfully! Bonuses distributed.');
        redirect(base_url() . 'regularProgram/orderList/1');
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

        // Load pagination library
        $this->load->library('pagination');

        // Pagination configuration
        $config['base_url'] = base_url('regularProgram/myPrograms');
        $config['total_rows'] = $this->RegularProgram_model->getAgentProgramsTotalCount($this->userUnId);
        $config['per_page'] = 20; // Items per page
        $config['uri_segment'] = 3;

        // Pagination styling (Bootstrap 5)
        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['first_tag_open'] = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';
        $config['prev_link'] = '&laquo;';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';
        $config['next_link'] = '&raquo;';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['attributes'] = array('class' => 'page-link');

        $this->pagination->initialize($config);

        // Get page number from URL
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        // Get agent's programs inventory with pagination
        $data['myPrograms'] = $this->RegularProgram_model->getAgentProgramsPaginated($this->userUnId, $config['per_page'], $page);
        $data['agentData'] = $this->Basic_model->agentDetails($this->userUnId);
        $data['pagination'] = $this->pagination->create_links();

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

    /**
     * Send referral and generation bonuses
     */
    private function sendReferBonus($sender, $receiver, $packageId, $packageQuantity) 
    {
        try {
            $packageDetails = $this->RegularProgram_model->packageDetails($packageId);
            $refererDetails = $this->Basic_model->getUserDetails($receiver);
            $senderDetails = $this->Basic_model->getUserDetails($sender);

            if (!$packageDetails || !$refererDetails) {
                return false;
            }

            // Direct referral bonus: 10% / 2 = 5%
            $update_amount = ((($packageDetails['price'] * 10) / 100) / 2) * $packageQuantity; 
            $withdrawable_amount = ((($packageDetails['price'] * 10) / 100) / 2) * $packageQuantity;

            // Only give bonus if referrer has a regular program package
            if ($refererDetails && !empty($refererDetails['current_regular_program_package_id'])) {
                $referBonusForm = array(
                    'sender_un_id' => $sender,
                    'receiver_un_id' => $receiver,
                    'update_amount' => $update_amount,
                    'withdrawable_amount' => $withdrawable_amount,
                    'package_id' => $packageId,
                    'status' => '1',
                    'level' => 0,
                    'source' => 'referal',
                    'created_at' => date('Y-m-d H:i:s')
                );

                $this->RegularProgram_model->addRegularProgramReferBonus($referBonusForm);
                $this->RegularProgram_model->incrementUserRegularProgramAmounts(
                    $refererDetails['un_id'], 
                    (float)$update_amount, 
                    (float)$withdrawable_amount
                );
            }

            // Generation bonuses: 1% / 2 = 0.5% for levels 1-9
            $uData = $this->Basic_model->getUserDetails($senderDetails['refered_by']);
            $level = 1;

            while ($level < 10) {
                if (empty($uData['refered_by'])) {
                    break;
                }

                $uData = $this->Basic_model->getUserDetails($uData['refered_by']);
                
                if (!$uData) {
                    break;
                }

                // Only give bonus if upline has a regular program package
                if ($uData && !empty($uData['current_regular_program_package_id'])) {
                    $level_bonus = (($packageDetails['price'] * 0.01) * $packageQuantity) / 2;  
                    $level_withdrawable_bonus = (($packageDetails['price'] * 0.01) * $packageQuantity) / 2; 

                    $generationBonusForm = array(
                        'sender_un_id' => $sender,
                        'receiver_un_id' => $uData['un_id'],
                        'update_amount' => $level_bonus,
                        'withdrawable_amount' => $level_withdrawable_bonus,
                        'package_id' => $packageId,
                        'status' => '1',
                        'level' => $level,
                        'source' => 'generation',
                        'created_at' => date('Y-m-d H:i:s')
                    );

                    $this->RegularProgram_model->addRegularProgramReferBonus($generationBonusForm);
                    $this->RegularProgram_model->incrementUserRegularProgramAmounts(
                        $uData['un_id'], 
                        (float)$level_bonus, 
                        (float)$level_withdrawable_bonus
                    );
                }

                $level += 1;
            }
            
            return true;
        } catch (Exception $e) {
            log_message('error', 'Error in sendReferBonus: ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Send royalty bonus to all eligible users
     */
    private function sendRoyality($sender, $packageId, $packageQuantity) 
    {
        try {
            $packageDetails = $this->RegularProgram_model->packageDetails($packageId);
            $senderDetails = $this->Basic_model->getUserDetails($sender);
            
            if (!$packageDetails || !$senderDetails) {
                return false;
            }

            // Calculate sender's total package count
            $senderCurrentPackageCount = $packageQuantity;
            $senderPackages = $this->RegularProgram_model->userRegularPackagesList($sender);
            
            foreach ($senderPackages as $pkg) {
                $senderCurrentPackageCount += (int)$pkg['quantity'];
            }

            // Get eligible users based on sender's total packages
            if ($senderCurrentPackageCount >= 7) {
                $allRegularProgramUsers = $this->RegularProgram_model->getAllsevenAboveUsers();
            } else {
                $allRegularProgramUsers = $this->RegularProgram_model->getAllRegularProgramIds();
            }

            // Calculate royalty distribution: 30% of package price
            $totalSharesToDistribute = $packageDetails['price'] * 0.30 * $packageQuantity;

            $totalUsers = 0;
            foreach ($allRegularProgramUsers as $user) {
                $userPackages = $this->RegularProgram_model->userRegularPackagesList($user['un_id']);
                foreach ($userPackages as $pkg) {
                    $totalUsers = $totalUsers + $pkg['quantity'];
                }
            }
            
            if ($totalUsers <= 0) {
                return true; // No users to distribute to
            }

            $amountPerUser = $totalSharesToDistribute / $totalUsers;

            foreach ($allRegularProgramUsers as $user) {
                if ($user['un_id'] == $sender) {
                    continue; // Skip the sender
                }

                $upd = (float)($amountPerUser / 2);
                $wd  = (float)($amountPerUser / 2);

                $userPackagess = $this->RegularProgram_model->userRegularPackagesList($user['un_id']);
                $userPackageCount = 0;
                foreach ($userPackagess as $pkg) {
                    $userPackageCount = $userPackageCount + (int)$pkg['quantity'];
                }

                if($userPackageCount >= 7) {
                    $upd = $upd*$userPackageCount;
                    $wd = $wd*$userPackageCount;
                }

                $royalityBonusForm = array(
                    'sender_un_id' => $sender,
                    'receiver_un_id' => $user['un_id'],
                    'update_amount' => $upd, 
                    'withdrawable_amount' => $wd,
                    'package_id' => $packageId,
                    'status' => '1',
                    'source' => 'royalty',
                    'level' => 100,
                    'created_at' => date('Y-m-d H:i:s')
                );

                $this->RegularProgram_model->addRegularProgramReferBonus($royalityBonusForm);
                $this->RegularProgram_model->incrementUserRegularProgramAmounts($user['un_id'], $upd, $wd);
            }
            
            return true;
        } catch (Exception $e) {
            log_message('error', 'Error in sendRoyality: ' . $e->getMessage());
            return false;
        }
    }
}
