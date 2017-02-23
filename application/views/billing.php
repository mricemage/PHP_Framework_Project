

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
 
</head>
<body>
 <?php
$grand_total = 0;
// Calculate grand total.
if ($cart = $this->cart->contents()):
    foreach ($cart as $item):
        $grand_total = $grand_total + $item['subtotal'];
    endforeach;
endif;
?>

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
    <div id="bill_info">
            
            <?php // Create form for enter user imformation and send values 'shopping/save_order' function?>
            <form name="billing" method="post" action="<?php echo base_url() . 'index.php/Food/save_order' ?>" >
                <input type="hidden" name="command" />
                <div align="center">
                    <h1 align="center">Billing Info</h1>
                    <table border="0" cellpadding="15px">
                        <tr><td>Order Total:</td><td><strong>€ <?php echo number_format($grand_total, 2); ?></strong></td></tr>
                        <tr><td>Your Name:</td><td><input type="text" name="name" required=""/></td></tr>
                        <tr><td>Address:</td><td><input type="text" name="address" required="" /></td></tr>
                        <tr><td>Phone:</td><td><input type="text" name="phonenumber"  required="" /></td></tr>
                        <tr><td><?php
                        // This button for redirect main page.
                        echo "<br><a class ='fg-button teal' id='back' href=" . base_url() . "index.php/food/showFood>Back</a>&nbsp;";  ?>
                            </td><td><br><input type="submit" class ='fg-button teal' value="Place Order" /></td></tr> 
                            
                    </table><br>
                </div>
            </form>
        </div>
          
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