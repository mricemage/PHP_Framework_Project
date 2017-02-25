

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
    #back{
      font-size: 25px;
      width: 150px;
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
    $(window).load(function(){
        $('#myModal').modal('show');
    });
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
        <li><a href="<?php echo base_url('index.php'); ?>">Home</a></li>
        <li><a href="<?php echo site_url('food/showFood'); ?>">Food List</a></li>
        <li class="active"><a href="<?php echo site_url('food/feedback'); ?>">Feedback</a></li>
        <li><a href="#">Download Document</a></li>
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
            <form name="billing" method="post" action="add_comment">
                <input type="hidden" name="command" />
                <div align="center">
                    <h1 align="center">Feedbacks</h1>
                    <table border="0" cellpadding="15px">

                        <tr><td>Your Email:</td><td><input type="email" name="email" required style="margin: 10px;"/></td></tr>
                        <tr><td>Your Feedback</td><td><input type="text" name="comments" required style="margin: 10px;" /></td></tr>
                      </td><td><br><input type="submit" name="btn" class ='fg-button teal' value="Leave Feedback" /></td></tr>

                    </table><br>
                </div>


            </form>

        </div>


          <h2>Our feedbacks</h2>

    <?php
    foreach ($feedback as $feed) {
      echo '<div class="panel panel-default" style="text-align:left">';
      echo '<h4 style="margin-left: 1%; color: orange;">' .$feed['customer_email']. ' has written: </h4>';
      echo '<div class="panel-body">' .$feed['comments'] .'</div>';
      echo '</div>';
    }
    ?>



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
