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


}