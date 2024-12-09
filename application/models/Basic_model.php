<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Basic_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
    }

    /**
     * Get agent details based on un_id
     *
     * @param string $unId
     * @return array|bool
     */
    public function agentDetails($unId)
    {
        // Query the agent table for the given un_id
        $this->db->where('un_id', $unId);
        $query = $this->db->get('agent'); // 'agent' is the table name

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the first result as an array
        } else {
            return false; // Return false if no result is found
        }
    }

    public function getUserDetails($unId)
    {
        // Query the customers table for the given un_id
        $this->db->where('un_id', $unId);
        $query = $this->db->get('customers'); // 'customers' is the table name

        if ($query->num_rows() > 0) {
            return $query->row_array(); // Return the first result as an array
        } else {
            return false; // Return false if no result is found
        }
    }


    function getUserDetailsByUsername($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get('customers');

        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return false;
        }
    }

    function team_list($username)
    {
        $this->db->where('placement_id', $username);
        return $this->db->get('customers')->result_array();
    }

    function updateCustomer($un_id, $form)
    {
        $this->db->where('un_id', $un_id);
        $this->db->update('customers', $form);
    }

    function create_income($form)
    {
        $this->db->insert('income', $form);
    }


    function agentGatewayList($agentId)
    {
        $this->db->where('agent_un_id', $agentId);
        $this->db->where('status', 1);
        return $this->db->get('agent_payment_gateway')->result_array();
    }
}
