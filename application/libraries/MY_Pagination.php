<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Extended Pagination Class
 * Fixes ctype_digit() warning for null values in CodeIgniter 3.1.13+
 */
class MY_Pagination extends CI_Pagination {

    /**
     * Initialize Preferences
     * Override to ensure cur_page is never null
     */
    public function initialize($params = array())
    {
        parent::initialize($params);
        
        // Make sure URI segment is retrieved safely
        $CI =& get_instance();
        $segment = $CI->uri->segment($this->uri_segment);
        
        // If segment is null or empty, set to 0
        if ($segment === NULL || $segment === '' || $segment === FALSE) {
            $this->cur_page = 0;
        } elseif (is_numeric($segment)) {
            $this->cur_page = (int)$segment;
        } else {
            $this->cur_page = 0;
        }
        
        return $this;
    }

    /**
     * Generate the pagination links
     * Override with additional null checks
     */
    public function create_links()
    {
        // Ensure cur_page is never null before calling parent
        if ($this->cur_page === NULL || $this->cur_page === '') {
            $this->cur_page = 0;
        }
        
        // Make absolutely sure it's an integer
        $this->cur_page = (int)$this->cur_page;
        
        // Check if we even need pagination
        if ($this->total_rows == 0 OR $this->per_page == 0) {
            return '';
        }

        // Calculate number of pages
        $num_pages = (int) ceil($this->total_rows / $this->per_page);

        // Is there only one page? If so, return empty
        if ($num_pages === 1) {
            return '';
        }

        // Safely call parent with guaranteed non-null cur_page
        return parent::create_links();
    }
}
