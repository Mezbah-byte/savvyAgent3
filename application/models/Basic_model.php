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

    /**
     * Get user details from the customers table based on un_id
     *
     * @param string $unId
     * @return array|bool
     */
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
}
