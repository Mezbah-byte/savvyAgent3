<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RegularProgram_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
    }

    /**
     * Get all active regular programs with status = 1
     *
     * @return array
     */
    public function getActivePrograms()
    {
        $this->db->where('status', 1);
        $query = $this->db->get('regular_program_packages');
        return $query->result_array();
    }

    /**
     * Get order list by type for regular programs
     *
     * @param string $type
     * @param string $gatewayId
     * @return array
     */
    public function getOrderListByType($type, $gatewayId)
    {
        if ($type != 'all') {
            $this->db->where('status', $type);
        }

        $this->db->where('gatewayId', $gatewayId);
        $this->db->where('payment_mode', 'agent');
        $query = $this->db->get('regular_program_package_update');
        return $query->result_array();
    }

    /**
     * Get regular program order details
     *
     * @param int $id
     * @return array|bool
     */
    function getProgramOrderDetails($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('regular_program_package_update');
        return $query->row_array();
    }

    /**
     * Get regular program details
     *
     * @param string $unId
     * @return array|bool
     */
    public function getProgramDetails($unId)
    {
        $this->db->where('un_id', $unId);
        return $this->db->get('regular_program_packages')->row_array();
    }

    /**
     * Get package details (alias for getProgramDetails)
     *
     * @param string $packageId
     * @return array|bool
     */
    public function packageDetails($packageId)
    {
        $this->db->where('un_id', $packageId);
        return $this->db->get('regular_program_packages')->row_array();
    }

    /**
     * Update regular program order
     *
     * @param int $id
     * @param array $form
     */
    function updateProgramOrder($id, $form)
    {
        $this->db->where('id', $id);
        $this->db->update('regular_program_package_update', $form);
    }

    /**
     * Get agent payment gateway details based on un_id
     *
     * @param string $id
     * @return array|bool
     */
    public function getAgentGatewayDetails($id)
    {
        $this->db->where('un_id', $id);
        $query = $this->db->get('agent_payment_gateway');
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    /**
     * Get payment gateways
     *
     * @return array
     */
    function getPaymentGateway() {
        $this->db->where('status', 1);
        $this->db->where('diposit_working', 1);
        $this->db->where('working', 1);
        return $this->db->get('gateways')->result_array();
    }

    /**
     * Insert regular program buy request
     *
     * @param array $data
     */
    function buyProgramRequest($data) {
        $this->db->insert('agentregularprogrambuyrequest', $data);
        $insertId = $this->db->insert_id();
        
        // If approved (status = 1), create program entries in agentregularprograms
        if (isset($data['status']) && $data['status'] == 1) {
            $this->createAgentPrograms($data['agent_un_id'], $data['program_un_id'], $data['quantity']);
        }
        
        return $insertId;
    }

    /**
     * Create agent program entries after approval
     *
     * @param string $agentUnId
     * @param string $programUnId
     * @param int $quantity
     */
    function createAgentPrograms($agentUnId, $programUnId, $quantity) {
        $batch = [];
        for ($i = 0; $i < $quantity; $i++) {
            $batch[] = [
                'agent_un_id'   => $agentUnId,
                'program_un_id' => $programUnId,
                'status'        => 1, // Active/Available
                'created_at'    => date('Y-m-d H:i:s')
            ];
        }
        
        if (!empty($batch)) {
            $this->db->insert_batch('agentregularprograms', $batch);
        }
    }

    /**
     * Update status of agent's regular programs
     *
     * @param string $agent_un_id
     * @param string $program_un_id
     * @param int $new_status
     * @param int $quantity
     * @return int
     */
    /**
     * Get agent's available inventory count for a specific program
     *
     * @param string $agent_un_id
     * @param string $program_un_id
     * @return int
     */
    public function getAgentAvailableInventory($agent_un_id, $program_un_id) {
        $this->db->where('agent_un_id', $agent_un_id);
        $this->db->where('program_un_id', $program_un_id);
        $this->db->where('status', 1); // Active/available programs
        return $this->db->count_all_results('agentregularprograms');
    }

    public function update_status_requests($agent_un_id, $program_un_id, $new_status, $quantity) {
        // 1) fetch up to $quantity active IDs
        $active = $this->db
            ->select('id')
            ->from('agentregularprograms')
            ->where('agent_un_id',  $agent_un_id)
            ->where('program_un_id', $program_un_id)
            ->where('status',       1)
            ->order_by('created_at','ASC')
            ->limit($quantity)
            ->get()
            ->result_array();

        if (empty($active)) {
            return 0;
        }

        $ids = array_column($active, 'id');

        // 2) update those IDs
        $this->db
            ->where_in('id', $ids)
            ->update('agentregularprograms', [
                'status' => $new_status,
            ]);

        return $this->db->affected_rows();
    }

    /**
     * Get agent details by gateway ID
     *
     * @param string $gatewayId
     * @return array|bool
     */
    function getAgentDetailsByGateway($gatewayId) {
        $this->db->where('un_id', $gatewayId);
        $gatewayDetails = $this->db->get('agent_payment_gateway')->row_array();

        if ($gatewayDetails) {
            $this->db->where('un_id', $gatewayDetails['agent_un_id']);
            return $this->db->get('agent')->row_array();
        }
        
        return false;
    }

    /**
     * Get agent's regular programs inventory
     *
     * @param string $agentUnId
     * @param int $status (optional)
     * @return array
     */
    function getAgentPrograms($agentUnId, $status = null) {
        $this->db->select('agentregularprograms.*, regular_program_packages.title, regular_program_packages.price');
        $this->db->from('agentregularprograms');
        $this->db->join('regular_program_packages', 'agentregularprograms.program_un_id = regular_program_packages.un_id');
        $this->db->where('agentregularprograms.agent_un_id', $agentUnId);
        
        if ($status !== null) {
            $this->db->where('agentregularprograms.status', $status);
        }
        
        $this->db->order_by('agentregularprograms.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get agent's regular programs inventory with pagination
     *
     * @param string $agentUnId
     * @param int $limit
     * @param int $offset
     * @param int $status (optional)
     * @return array
     */
    function getAgentProgramsPaginated($agentUnId, $limit, $offset, $status = null) {
        $this->db->select('agentregularprograms.*, regular_program_packages.title, regular_program_packages.price');
        $this->db->from('agentregularprograms');
        $this->db->join('regular_program_packages', 'agentregularprograms.program_un_id = regular_program_packages.un_id');
        $this->db->where('agentregularprograms.agent_un_id', $agentUnId);
        
        if ($status !== null) {
            $this->db->where('agentregularprograms.status', $status);
        }
        
        $this->db->order_by('agentregularprograms.created_at', 'DESC');
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get total count of agent's programs
     *
     * @param string $agentUnId
     * @param int $status (optional)
     * @return int
     */
    function getAgentProgramsTotalCount($agentUnId, $status = null) {
        $this->db->where('agent_un_id', $agentUnId);
        
        if ($status !== null) {
            $this->db->where('status', $status);
        }
        
        return $this->db->count_all_results('agentregularprograms');
    }

    /**
     * Get agent's buy requests
     *
     * @param string $agentUnId
     * @param string $status
     * @return array
     */
    function getAgentBuyRequests($agentUnId, $status = 'all') {
        $this->db->select('agentregularprogrambuyrequest.*, regular_program_packages.title, regular_program_packages.price');
        $this->db->from('agentregularprogrambuyrequest');
        $this->db->join('regular_program_packages', 'agentregularprogrambuyrequest.program_un_id = regular_program_packages.un_id');
        $this->db->where('agentregularprogrambuyrequest.agent_un_id', $agentUnId);
        
        if ($status !== 'all') {
            $this->db->where('agentregularprogrambuyrequest.status', $status);
        }
        
        $this->db->order_by('agentregularprogrambuyrequest.created_at', 'DESC');
        $query = $this->db->get();
        return $query->result_array();
    }

    /**
     * Get buy request details
     *
     * @param int $id
     * @return array|bool
     */
    function getBuyRequestDetails($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('agentregularprogrambuyrequest');
        return $query->row_array();
    }

    /**
     * Update buy request status
     *
     * @param int $id
     * @param array $data
     */
    function updateBuyRequest($id, $data) {
        $this->db->where('id', $id);
        $this->db->update('agentregularprogrambuyrequest', $data);
    }

    /**
     * Approve buy request and create program entries
     *
     * @param int $requestId
     * @return bool
     */
    function approveBuyRequest($requestId) {
        $request = $this->getBuyRequestDetails($requestId);
        
        if (!$request || $request['status'] != 0) {
            return false;
        }

        // Update request status
        $this->updateBuyRequest($requestId, [
            'status'     => 1,
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        // Create program entries
        $this->createAgentPrograms($request['agent_un_id'], $request['program_un_id'], $request['quantity']);

        return true;
    }

    /**
     * Reject buy request
     *
     * @param int $requestId
     * @param string $reason
     * @return bool
     */
    function rejectBuyRequest($requestId, $reason = '') {
        $request = $this->getBuyRequestDetails($requestId);
        
        if (!$request || $request['status'] != 0) {
            return false;
        }

        // Update request status
        $this->updateBuyRequest($requestId, [
            'status'           => 2,
            'rejection_reason' => $reason,
            'updated_at'       => date('Y-m-d H:i:s')
        ]);

        return true;
    }

    /**
     * Get count of agent's programs by status
     *
     * @param string $agentUnId
     * @return array
     */
    function getAgentProgramsCount($agentUnId) {
        $counts = [
            'total'     => 0,
            'active'    => 0,
            'sold'      => 0,
            'pending'   => 0
        ];

        // Total
        $this->db->where('agent_un_id', $agentUnId);
        $counts['total'] = $this->db->count_all_results('agentregularprograms');

        // Active
        $this->db->where('agent_un_id', $agentUnId);
        $this->db->where('status', 1);
        $counts['active'] = $this->db->count_all_results('agentregularprograms');

        // Sold
        $this->db->where('agent_un_id', $agentUnId);
        $this->db->where('status', 2);
        $counts['sold'] = $this->db->count_all_results('agentregularprograms');

        // Pending
        $this->db->where('agent_un_id', $agentUnId);
        $this->db->where('status', 0);
        $counts['pending'] = $this->db->count_all_results('agentregularprograms');

        return $counts;
    }

    /**
     * Get user's regular package list
     */
    public function userRegularPackagesList($un_id) 
    {
        $this->db->where('user_un_id', $un_id);
        $this->db->where('status', 1); // Only approved packages
        return $this->db->get('regular_program_package_update')->result_array();
    }

    /**
     * Update user wallet and package info
     */
    public function updateUserWallet($un_id, $form) 
    {
        $this->db->where('un_id', $un_id);
        $this->db->update('customers', $form);
    }

    /**
     * Add regular program referral/generation/royalty bonus
     */
    public function addRegularProgramReferBonus($form) 
    {
        $this->db->insert('regular_program_refer_bonus', $form);
    }

    /**
     * Increment user's regular program amounts atomically
     */
    public function incrementUserRegularProgramAmounts($un_id, $updateAmount, $withdrawableAmount) 
    {
        $this->db->set('current_regular_program_update_amount', 'current_regular_program_update_amount + ' . (float)$updateAmount, FALSE);
        $this->db->set('total_regular_program_update_amount', 'total_regular_program_update_amount + ' . (float)$updateAmount, FALSE);
        $this->db->set('current_regular_program_withdraw_amount', 'current_regular_program_withdraw_amount + ' . (float)$withdrawableAmount, FALSE);
        $this->db->set('total_regular_program_withdraw_amount', 'total_regular_program_withdraw_amount + ' . (float)$withdrawableAmount, FALSE);
        $this->db->where('un_id', $un_id);
        $this->db->update('customers');
    }

    /**
     * Get all users with regular program packages
     */
    public function getAllRegularProgramIds() 
    {
        $this->db->where('current_regular_program_package_id !=', '');
        $data = $this->db->get('customers')->result_array();
        return $data;
    }

    /**
     * Get all users with 7 or more packages
     */
    public function getAllsevenAboveUsers() 
    {
        $this->db->where('current_regular_program_package_id !=', '');
        $data = $this->db->get('customers')->result_array();
        $finalData = [];
        
        foreach ($data as $user) {
            $userPackages = $this->userRegularPackagesList($user['un_id']);
            $totalPackages = 0;
            
            foreach ($userPackages as $pkg) {
                $totalPackages += (int)$pkg['quantity'];
            }
            
            if ($totalPackages >= 7) {
                $finalData[] = $user;
            }
        }
        
        return $finalData;
    }
}
