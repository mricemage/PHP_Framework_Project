<?php 

Class Food_model extends CI_model {

    public function __construct()
    {
         parent::__construct();   
    }

    public function showFoods(){
        $this->db->select('*');
        $this->db->from('food');
        return $this->db->get()->result_array();
    }

    public function insert_customer($data)
    {
        $this->db->insert('customers', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
    
    public function insert_order_detail($data)
    {
        $this->db->insert('order_detail', $data);
        $id = $this->db->insert_id();
        return (isset($id)) ? $id : FALSE;
    }
}