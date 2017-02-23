<?php

defined('BASEPATH') OR exit('No direct script access allowed'); 

class Food extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        //load model
        $this->load->model('Food_model');
        $this->load->helper(array('url', 'form'));
        $this->load->library("cart");
    }

    public function showFood() 
    {
        $this->load->model('Food_model');
        $data['food']=$this->Food_model->showFoods();
        $data['page']='showfood';
        $this->load->view('menu/content',$data);
    }

    public function add(){
                //Set Array for sending data 
        $insert_data = array( 'id' => $this->input->post('id'),
                              'name' => $this->input->post('name'),
                              'price' => $this->input->post('price'),
                              'qty' => 1 );

 // This function add items into cart.
$this->cart->insert($insert_data);
        // print_r($newfood);
        
       redirect('Food/showFood');
     
            
    }

    function remove($rowid) {
                    // Check rowid value.
		if ($rowid==="all"){
                       // Destroy data which store in  session.
			$this->cart->destroy();
		}else{
                    // Destroy selected rowid in session.
			$data = array(
				'rowid'   => $rowid,
				'qty'     => 0
			);
                     // Update cart data, after cancle.
			$this->cart->update($data);
		}
		
                 // This will show cancle data in cart.
		redirect('food/showfood');
	}

    function update_cart(){
                
                // Recieve post values,calcute them and update
                $cart_info =  $_POST['cart'] ;
 		foreach( $cart_info as $id => $cart)
		{	
                    $rowid = $cart['rowid'];
                    $price = $cart['price'];
                    $amount = $price * $cart['qty'];
                    $qty = $cart['qty'];
                    
                    	$data = array(
				'rowid'   => $rowid,
                                'price'   => $price,
                                'amount' =>  $amount,
				'qty'     => $qty
			);
             
			$this->cart->update($data);
		}
		redirect('food/showFood');        
	}	

    function billing2() //This function will load "billing_view"
    {
        $this->load->view('billing');
    }

    public function billing()
    {
        $this->load->view('billing');
               //This will store all values which inserted from user 
       $b=$this->input->post('btn');
       if(isset($b))   {
        $customer = array(
            'name'          => $this->input->post('name'),
            'address'       => $this->input->post('address'),
            'phonenumber'   => $this->input->post('phonenumber')

        );

        $cust_id = $this->Food_model->insert_customer($customer);

        
        
        if ($cart = $this->cart->contents()):
            foreach ($cart as $item):
            $order_detail = array (
        
                'productid' => $item['id'],
                'quantity'  => $item['qty'],
                'price'     => $item['price']
            );

        
        $cust_id = $this->Food_model->insert_order_detail($order_detail);
            endforeach;
        endif;
         }
      //  $this->load->view('billing');
            //Insert product information with order detail,
            //store in cart also store in database
        
        //$this->load->view('billing_success');
    }







}   