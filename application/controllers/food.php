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
        $this->load->view('showfood',$data);
    }

    function add()
    {
                //Set Array for sending data 
        $insert_data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('name'),
            'price' => $this->input->post('price'),
            'qty' => 1
        );

                // This function add items to cart
            $this->cart->insert($insert_data);

                //This will show insert_data in cart
            redirect('food/showfood');
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
		redirect('food/showfood');        
	}	

    function billing_view() //This function will load "billing_view"
    {
        $this->load->view('billing_view');
    }

    public function save_order()
    {
               //This will store all values which inserted from user 
        $customer = array(
            'name'          => $this->input->post('name'),
            'address'       => $this->input->post('address'),
            'phonenumber'   => $this->input->post('phonenumber')

        );

        $cust_id = $this->Food_model->insert_customer($customer);

        $ord_id  = $this->Food_model->insert_order_detail($order);

        if ($cart = $this->cart->contents()):
            foreach ($cart as $item):
            $order_detail = array (
                'id'        => $ord_id,
                'productid' => $item['id'],
                'quantity'  => $item['qty'],
                'price'     => $item['price']
            );
        $cust_id = $this->Food_model->insert_order_detail($order_detail);
            endforeach;
        endif;

            //Insert product information with order detail,
            //store in cart also store in database
        
        //$this->load->view('billing_success');
    }







}   