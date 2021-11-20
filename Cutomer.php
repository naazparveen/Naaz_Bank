<?php

$con= mysqli_connect("localhost","root","","naaz_bank");
//check forconnection success
$query="SELECT * FROM customers ORDER BY id";
$result=mysqli_query($con,$query);
if (!$con) {
    die("connection to this database due to".
    mysqli_connect_error());

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Naaz bank| Welcome</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">

    <link rel="stylesheet" href="css/jquery.fancybox.min.css">

    <link rel="stylesheet" href="css/bootstrap-datepicker.css">

    <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

    <link rel="stylesheet" href="css/aos.css">

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./css/customer.css">
</head>
<body>
<header class="site-navbar js-sticky-header site-navbar-target" role="banner">

<div class="container" style="background-color: #6CDAE7;">
  <div class="row align-items-center" >
    
    <div class="col-6 col-xl-2">
      <h1 class="mb-0 site-logo"><a href="index.html" class="h2 mb-0" style="color:white;">Naaz <span class="text-primary">Bank</span> </a></h1>
    </div>

    <div class="col-12 col-md-10 d-none d-xl-block">
      <nav class="site-navigation position-relative text-right" role="navigation">

        <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
          <li><a href="index.html" class="nav-link" style="color:white;">Home</a></li>
          <li><a href="Cutomer.php" class="nav-link" style="color:white;">View Customers</a></li>
          <li><a href="./transfers.php" class="nav-link" style="color:white;">Transfer Money</a></li>
          <li class="social"><a href="#contact-section" class="nav-link"><span class="icon-facebook" style="color:white;"></span></a></li>
          <li class="social"><a href="#contact-section" class="nav-link"><span class="icon-twitter" style="color:white;"></span></a></li>
          <li class="social"><a href="#contact-section" class="nav-link"><span class="icon-linkedin" style="color:white;"></span></a></li>
        </ul>
      </nav>
    </div>


    <div class="col-6 d-inline-block d-xl-none ml-md-0 py-3" style="position: relative; top: 3px;"><a href="#" class="site-menu-toggle js-menu-toggle float-right"><span class="icon-menu h3"></span></a></div>

  </div>
</div>
</header>
<br>
<br>
<br>
<br>
    <div class="container customer-container">
        <br>
        <div class="table-responsive mytable">
            <table id="employee_data" class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <td><a class="white-text templatemo-sort-by">Id </a></td>
                        <td><a class="white-text templatemo-sort-by">Name </a></td>
                        <td><a class="white-text templatemo-sort-by">Email</a></td>
                        <td><a class="white-text templatemo-sort-by">Current_Balance</a></td>
                        
                    </tr>
                </thead>
                <?php
                while ($row = mysqli_fetch_array($result)) {
                    echo '  
                               <tr>  
                                    <td>' . $row['id'] . '</td>
                                    <td>' . $row['name'] . '</td>
                                    <td>' . $row['email'] . '</td>
                                    <td>' . $row['CurrentBalance'] . '</td>
                                    
                               </tr>  
                               ';
                }
                ?>
            </table>
        </div>
    </div>
    </body>
    <script>
        $(document).ready(function() {
            $('#employee_data').DataTable();
        });
    </script>
    
</html>