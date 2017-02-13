<?php

Class Food_model extends CI_model {
    public function showFoods(){
        $this->db->select('*');
        $this->db->from('food');
        return $this->db->get()->result_array();
    }
}