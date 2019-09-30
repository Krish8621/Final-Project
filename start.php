<?php
$page = 'Start';

if ( isset($_COOKIE['service_type']) ) {
  header('location:./');
}

if (isset($_POST['assemble'])) {

  //Clear cookie if it is set
  if (isset($_COOKIE['service_type'])) {
    setcookie("service_type", '', time() - 36000);    
  }

  

  $cookie_type = 'service_assemble';
  
  setcookie("service_type", $cookie_type, 0);             
  session_start(['cookie_lifetime' => 36000,]);
  header('location:./');
  header('refresh:0');

}


if (isset($_POST['part'])) {

  //Clear cookie if it is set
  if (isset($_COOKIE['service_type'])) {
    setcookie("service_type", '', time() - 36000);    
  }



  $cookie_type = 'service_part';
  setcookie("service_type", $cookie_type, 0);             
  session_start(['cookie_lifetime' => 36000,]);
  header('location:./');
  header('refresh:0');

}


if (isset($_POST['service'])) {

  //Clear cookie if it is set
  if (isset($_COOKIE['service_type'])) {
    setcookie("service_type", '', time() - 36000);    
  }



  $cookie_type = 'service_service';

  setcookie("service_type", $cookie_type, 0);             
  session_start(['cookie_lifetime' => 36000,]);
  header('location:technician');
  header('refresh:0');

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'include/head.php'; ?>
</head>
<body style="background: #f5f5f5;">
<?php include 'include/preloader.php'; ?>

<!-- Wrap -->
<div id="wrap"> 
  
  <!-- Content -->
  <div id="content"> 
    
    <!-- Products -->
    <section class="chart-page login gray-bg padding-top-100 padding-bottom-100">
      <div class="container"> 
    
          <div class="col-sm-7 center-block"> 

            <h1 class="text-center">WHAT ARE YOU LOOKING FOR?</h1>

            <form method="POST" class="start-form">
              <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <button class="btn btn-block" type="submit" name="assemble">PC ASSEMBLE</button>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <button class="btn btn-block" type="submit" name="part">PC PART</button>
                  </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                  <div class="form-group">
                    <button class="btn btn-block" type="submit" name="service">SERVICE</button>
                  </div>
                </div>
              </div>
            </form>
               
          </div>
      </div>
    </section>

  </div>

  
  <!-- GO TO TOP  --> 
  <a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a> 
  <!-- GO TO TOP End --> 
  
</div>
<?php include 'include/footer-script.php'; ?>

</body>
</html>