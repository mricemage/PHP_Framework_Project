

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Food List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }
  </style>
  <script type="text/javascript">
            // To conform clear all data in cart.
            function clear_cart() {
                var result = confirm('Are you sure want to clear all bookings?');

                if (result) {
                    window.location = "<?php echo base_url(); ?>index.php/food/remove/all";
                } else {
                    return false; // cancel button
                }
            }
        </script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Foodie</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="<?php echo base_url('index.php'); ?>">Home</a></li>
        <li><a href="<?php echo site_url('food/showFood'); ?>">Food List</a></li>
        <li><a href="#">Feedback</a></li>
        <li><a href="#">About</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        
      </ul>
    </div>
  </div>
</nav>
  
<div class="container-fluid text-center">    
  <div class="row content">
    <div class="col-sm-2 sidenav">
      <p><a href="#">Advertisement Place Here</a></p>
      <p><a href="#">Advertisement Place Here</a></p>
      <p><a href="#">Advertisement Place Here</a></p>
    </div>
    <div class="col-sm-8 text-center"> 
    <!-- Thus is the cart place -->
      <div id='content'>
                
        <div id="cart" >
            <div id = "heading">
                <h2 align="center">How many things have you got here?</h2>
            </div>
            
                <div id="text"> 
            <?php  $cart_check = $this->cart->contents();
            
            // If cart is empty, this will show below message.
             if(empty($cart_check)) {
             echo 'There is no item in the cart! '; 
             }  ?> </div>
            
                <table id="table" border="0" cellpadding="2px" cellspacing="20px">
                  <?php
                  // All values of cart store in "$cart". 
                  if ($cart = $this->cart->contents()): ?>
                    <tr id= "main_heading">
                        <td>ID</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Amount</td>
                        <td>Cancel Product</td>
                    </tr> <br>
                    <?php
                     // Create form and send all values in "shopping/update_cart" function.
                    echo form_open('food/update_cart');
                    $grand_total = 0;
                    $i = 1;

                    foreach ($cart as $item):
                        //   echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        //  Will produce the following output.
                        // <input type="hidden" name="cart[1][id]" value="1" />
                        
                        echo form_hidden('cart[' . $item['id'] . '][id]', $item['id']);
                        echo form_hidden('cart[' . $item['id'] . '][rowid]', $item['rowid']);
                        echo form_hidden('cart[' . $item['id'] . '][name]', $item['name']);
                        echo form_hidden('cart[' . $item['id'] . '][price]', $item['price']);
                        echo form_hidden('cart[' . $item['id'] . '][qty]', $item['qty']);
                        ?>
                        <tr>
                            <td>
                       <?php echo $i++; ?>
                            </td> 
                            <td>
                      <?php echo $item['name']; ?>
                            </td>
                            <td>
                                € <?php echo number_format($item['price'], 2); ?>
                            </td>
                            <td>
                            <?php echo form_input('cart[' . $item['id'] . '][qty]', $item['qty'], 'maxlength="3" size="4" style="text-align: right"'); ?>
                            </td> 
                        <?php $grand_total = $grand_total + $item['subtotal']; ?>
                            <td>
                                € <?php echo number_format($item['subtotal'], 2) ?>
                            </td>
                            <td>
                              
                            <?php 
                            // cancle image.
                            $path = "X";
                            echo anchor('Food/remove/' . $item['rowid'], $path); ?>
                            </td>
                     <?php endforeach; ?>
                    </tr>
                    <tr>
                        <td><b>Order Total: $<?php 
                        
                        //Grand Total.
                        echo number_format($grand_total, 2); ?></b></td>
                        
                        <?php // "clear cart" button call javascript confirmation message ?>
                        <td colspan="5" align="right"><input type="button" class ='fg-button teal' value="Clear Cart" onclick="clear_cart()"> 
                            
                            <?php //submit button. ?>
                            <input type="submit" class ='fg-button teal' value="Update Cart"> 
                            <?php echo form_close(); ?>
                            
                            <!-- "Place order button" on click send "billing" controller  -->
                            <input type="button" class ='fg-button teal' value="Place Order" onclick="window.location = 'billing'"></td> 
                    </tr>
<?php endif; ?>
            </table>
        </div>
        </div>
        



    <!-- End of cart place -->

      
      <h2 style="text-align:center;">Products</h3>
      <!-- The product side is here -->
        <?php
            
            // "$products" send from "shopping" controller,its stores all product which available in database. 
            foreach ($food as $product) {
                $id = $product['id'];
                $name = $product['name'];
                $description = $product['description'];
                $price = $product['price'];
          ?>
          <div id='product_div'>  
                    <div id='image_div'>
                        <img src="<?php echo base_url() . $product['image'] ?>"/>
                    </div>
                    <div id='info_product'>
                        <div id='name'><?php echo $name; ?></div>
                        <div id='desc'>  <?php echo $description; ?></div>
                        <div id='rs'><b>Price</b>:<big style="color:green">
                            €<?php echo $price; ?></big></div>
                        <?php
                        
                        //Create form and send values in 'shopping/add' function.
                        echo form_open('food/add');
                        echo form_hidden('id', $id);
                        echo form_hidden('name', $name);
                        echo form_hidden('price', $price);
                        
                        ?> </div> 
                    <div id='add_button'>
                        <?php
                        $btn = array(
                            'class' => 'fg-button teal',
                            'value' => 'Add to Cart',
                            'name' => 'action'
                        );
                        
                        // Submit Button.
                        echo form_submit($btn);
                        echo form_close();
                        ?>
                    </div>
                </div>
                

<?php }?>
    


          
    </div>

    <div class="col-sm-2 sidenav">
      <div class="well">
        <p>Advertisement place here</p>
      </div>
      <div class="well">
        <p>Advertisement place here</p>
      </div>
    </div>
  </div>
</div>


<footer class="container-fluid text-center">
  <p> PHP Framework (2017) - Ho Minh Thang - DIN15SP</p>
</footer>
</body>
</html>
