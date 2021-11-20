<?php
$con = mysqli_connect("localhost", "root", "", "naaz_bank");
if (!$con) {
  die("connection to this database due to" .
    mysqli_connect_error());
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/jquery.fancybox.min.css">
  <link rel="stylesheet" href="css/bootstrap-datepicker.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
  <link rel="stylesheet" href="fonts/icomoon/style.css">
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
    <div class="container" style="background-color: #273436;">
      <div class="row align-items-center">

        <div class="col-6 col-xl-2">
          <h1 class="mb-0 site-logo"><a href="index.html" class="h2 mb-0" style="color:white;">Naaz <span class="text-primary">Bank</span> </a></h1>
        </div>

        <div class="col-12 col-md-10 d-none d-xl-block">
          <nav class="site-navigation position-relative text-right" role="navigation">

            <ul class="site-menu main-menu js-clone-nav mr-auto d-none d-lg-block">
              <li><a href="index.html" class="nav-link" style="color:white;">Home</a></li>
              <li><a href="Cutomer.php" class="nav-link" style="color:white;">View Customers</a></li>
              <li><a href="./transfer.php" class="nav-link" style="color:white;">Transfer Money</a></li>
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

  <div class="card-body">
    <form method="POST">
      <div class="alert alert-secondary w-50 mx-auto">
        <h5>New Transfer</h5>
        <input type="text" name="fromAcNo" class="form-control " placeholder="Enter Sender Account number" required>
        <input type="text" name="toAcNo" class="form-control " placeholder="Enter Receiver Account number" required>
        <button type="submit" name="get" class="btn btn-primary btn-bloc btn-sm my-1">Get Account Info</button>
      </div>
    </form>
    <?php

    if (isset($_POST['get'])) {
      $fromAC = $con->query("select * from customers where accnumber = '$_POST[fromAcNo]'");
      $toAC = $con->query("select * from customers where accnumber = '$_POST[toAcNo]'"); {

        if ($fromAC->num_rows > 0 && $toAC->num_rows > 0) {

          $fromRow = $fromAC->fetch_assoc();
          $toRow = $toAC->fetch_assoc();
          echo "<div class='alert alert-secondary w-50 mx-auto'>
                  <form method='POST'>
                  <p class='text-white bg-dark'>From </p>
                  Account No#
                  <input type='text' name='fromAcNo' value='$fromRow[accnumber]' class='form-control ' readonly required>
                  Account Holder Name.
                  <input type='text' class='form-control' value='$fromRow[name]' readonly required>
                  
                  <input type='text' name='availableBalance' class='form-control' value='$fromRow[CurrentBalance]' readonly required hidden>
                 
                  <hr  style='border-top: 1px solid #ccc;'>
                  <p class='text-white bg-dark'>To </p>
                   Account No#
                    <input type='text' name='ToAcNo' value='$toRow[accnumber]' class='form-control ' readonly required>
                    Account Holder Name.
                    <input type='text' class='form-control' value='$toRow[name]' readonly required>
                    Enter Amount for tranfer.
                    <input type='number' name='transferAmt' class='form-control' min='1' max='$fromRow[CurrentBalance]' required>
                    <button type='submit' name='transfer' class='btn btn-primary btn-bloc btn-sm my-1'>Tranfer</button>
                  </form>
                </div>";
        } else
          echo "<div class='alert alert-success w-50 mx-auto'>Account No. $_POST[otherNo] Does not exist</div>";
      }
    }

    ?>
    <?php

    function creditBalance($amount, $process, $accnumber)
    {
      $con = new mysqli('localhost', 'root', '123root@TMM', 'naaz_bank');
      $array = $con->query("select * from customers where accnumber='$accnumber'");
      $row = $array->fetch_assoc();
      if ($process == 'credit') {
        $CurrentBalance = $row['CurrentBalance'] + $amount;
        return $con->query("update customers set CurrentBalance = '$CurrentBalance' where accnumber = '$accnumber'");
      } else {
        $CurrentBalance = $row['CurrentBalance'] - $amount;
        return $con->query("update customers set CurrentBalance = '$CurrentBalance' where accnumber = '$accnumber'");
      }
    }

    if (isset($_POST['transfer'])) {
      $transferAmt = $_POST['transferAmt'];
      $frmAcNoTrans = $_POST['fromAcNo'];
      $toAcNoTrans = $_POST['ToAcNo'];
      $availableBlc = $_POST['availableBalance'];

      if ($availableBlc >= $transferAmt) {
        // Debit sender account
        // Amount debited
        $remBlcAmount = (float)$availableBlc - (float)$transferAmt;
        // Update account
        $updateQry = $con->query("UPDATE customers SET CurrentBalance = '$remBlcAmount' WHERE accnumber = '$frmAcNoTrans'");


        // Credit receiver account.
        // current available balance for To (Receiver (Credited ac))
        $sqlAvaBlc = $con->query("SELECT CurrentBalance FROM customers WHERE accnumber='$toAcNoTrans'");
        $row = $sqlAvaBlc->fetch_assoc();
        $toAvaBlc = $row['CurrentBalance'];

        // print_r($toAvaBlc); 
        // print_r($transferAmt); 

        // After transfer balcace available
        $blcAvailableAfterTransfer = (float)$toAvaBlc + (float)$transferAmt;
        // print_r($blcAvailableAfterTransfer); 
        // Update account
        $toupdateQry = $con->query("UPDATE customers SET CurrentBalance = '$blcAvailableAfterTransfer' WHERE accnumber = '$toAcNoTrans'");

        // Insert in transfer table

        $trans = $con->query("INSERT INTO transfers (credited_ac, debited_ac, amount) VALUES ('$toAcNoTrans', '$frmAcNoTrans', '$transferAmt')");

        //  print_r($toupdateQry); 
        //  die;
        echo "<script>alert('Transfer Successfull');window.location.href='transfers.php'</script>";
      } else {
        echo "<script>alert('Sufficient balance is not available');</script>";
      }

      /*  print_r($transferAmt); 
            print_r($frmAcNoTrans); 
            print_r($toAcNoTrans); 
            die;
            creditBalance($transferAmt, 'debit', $_POST['fromAcNo']);
            creditBalance($transferAmt, 'credit', $_POST['ToAcNo']);
            echo "<script>alert('Transfer Successfull');window.location.href='transfer.php'</script>"; */
    }
    ?>
  </div>
</body>

</html>