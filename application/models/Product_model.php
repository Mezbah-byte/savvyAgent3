<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Product_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database(); // Load the database
    }

    /**
     * Get all active products with published = 1
     *
     * @return array
     */
    public function getActiveProducts()
    {
        $this->db->where('published', 1); // Check if the product is published
        $query = $this->db->get('products'); // 'products' is the table name
        return $query->result_array(); // Return all active products as an array
    }
}
