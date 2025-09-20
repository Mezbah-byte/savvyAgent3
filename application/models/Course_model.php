<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Course_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
    }

    /**
     * Get all active courses with status = 1
     *
     * @return array
     */
    public function getActiveCourse()
    {
        $this->db->where('status', 1);
        $query = $this->db->get('course'); // 'course' is the table name
        return $query->result_array(); // Return all active courses as an array
    }

    /**
     * Get order list by type
     *
     * @param string $type
     * @return array
     */
    public function getOrderListByType($type, $gatewayId)
    {
        if ($type != 'all') {
            $this->db->where('status', $type);
        }

        $this->db->where('gateway_id', $gatewayId);
        $query = $this->db->get('user_courses');
        return $query->result_array();
    }

    function getCourseOrderDetails($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('user_courses');
        return $query->row_array();
    }

    /**
     * Get course details based on un_id
     *
     * @param string $unId
     * @return array|bool
     */
    public function getCourseDetails($unId)
    {
        $this->db->where('un_id', $unId);
        return $this->db->get('course')->row_array();
    }

    function updateCourseOrder($id, $form)
    {
        $this->db->where('id', $id);
        $this->db->update('user_courses', $form);
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
        $query = $this->db->get('agent_payment_gateway'); // 'agent_payment_gateway' is the table name
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the payment gateway details as an associative array
        }
        return false; // Return false if no record is found
    }

    function getPaymentGateway() {
        $this->db->where('status', 1);
        $this->db->where('diposit_working', 1);
        $this->db->where('working', 1);
        return $this->db->get('gateways')->result_array();
    }

    function buyCourseRequest($data) {
        $this->db->insert('agentcoursebuyrequest', $data);
    }


    public function update_status_requests($agent_un_id, $course_un_id, $new_status, $quantity) {
        // 1) fetch up to $quantity pending IDs
        $pending = $this->db
            ->select('id')
            ->from('agentcourses')
            ->where('agent_un_id',  $agent_un_id)
            ->where('course_un_id', $course_un_id)
            ->where('status',       1)
            ->order_by('created_at','ASC')
            ->limit($quantity)
            ->get()
            ->result_array();

        if (empty($pending)) {
            return 0;
        }

        $ids = array_column($pending, 'id');

        // 2) update those IDs
        $this->db
            ->where_in('id', $ids)
            ->update('agentcourses', [
                'status'     => $new_status,
                // 'updated_at' => date('Y-m-d H:i:s'),
            ]);

        return $this->db->affected_rows();
    }


    function getAgentDetailsByGateway($gatewayId) {
        $this->db->where('un_id', $gatewayId);
        $gatewayDetails = $this->db->get('agent_payment_gateway')->row_array();

        $this->db->where('un_id', $gatewayDetails['agent_un_id']);
        return $this->db->get('agent')->row_array();
    }

    function activeBonusPackagesList() {
        $this->db->where('status', 1);
        return $this->db->get('bonus')->result_array();
    }
}
