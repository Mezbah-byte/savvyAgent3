<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extended Pagination Class
 * Fixes ctype_digit() warning for null values
 */
class MY_Pagination extends CI_Pagination {

    /**
     * Override the parent method to fix ctype_digit warning
     */
    public function create_links()
    {
        // Ensure cur_page is always an integer to prevent ctype_digit() warnings
        if ($this->cur_page === NULL || $this->cur_page === '') {
            $this->cur_page = 0;
        }
        
        // Ensure it's numeric before proceeding
        if (!is_numeric($this->cur_page)) {
            $this->cur_page = 0;
        }
        
        // Cast to integer
        $this->cur_page = (int)$this->cur_page;
        
        return parent::create_links();
    }
}
