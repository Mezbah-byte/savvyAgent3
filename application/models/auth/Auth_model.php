<?php
/**
 *
 */
class Auth_model extends CI_model
{
	public function __construct()
	{
		parent::__construct();
	}

	function can_login($email, $password)
	{
		$this->db->where('email', $email);
		$this->db->where('password', $password);
		$query = $this->db->get('agent');

		if ($query->num_rows() > 0) {
			return $query->row_array();
			return true;
		} else {
			return false;
		}
	}

}
?>