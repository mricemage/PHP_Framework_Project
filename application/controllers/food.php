<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Food extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('Food_model');
        $this->load->library('cart');
    }

    public function showFood() 
    {
        $this->load->model('Food_model');
        $data['food']=$this->Food_model->showFoods();
        $data['page']='showfood';
        $this->load->view('menu/content',$data);
    }
}   