<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recharge_model extends CI_Model {
    protected $table = 'agent_mobile_recharge';

    public function __construct() {
        parent::__construct();
    }

    public function create(array $data) {
        $now = date('Y-m-d H:i:s');
        $data['created_at'] = $data['created_at'] ?? $now;
        $data['updated_at'] = $data['updated_at'] ?? $now;
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function updateByTranId($tran_id, array $data) {
        $data['updated_at'] = date('Y-m-d H:i:s');
        return $this->db->where('tran_id', $tran_id)->update($this->table, $data);
    }

    public function findByTranId($tran_id) {
        return $this->db->get_where($this->table, ['tran_id' => $tran_id])->row_array();
    }

    public function historyByUser($user_un_id) {
        return $this->db->where('user_un_id', $user_un_id)
                        ->order_by('created_at', 'DESC')
                        ->get($this->table)
                        ->result_array();
    }
}
