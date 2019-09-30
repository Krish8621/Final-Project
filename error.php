<?php
$page = 'Login';

require 'config.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'include/head.php'; ?>
</head>
<body>
<?php include 'include/preloader.php'; ?>

<!-- Wrap -->
<div id="wrap"> 
  <!-- TOP Bar -->
  <?php include 'include/topbar.php'; ?>
    
  <!-- header -->
  <?php include 'include/header.php'; ?>
  
  <!-- Content -->
  <div id="content"> 
    
    <!-- PAGES INNER -->
    <section class="chart-page login gray-bg padding-bottom-100">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="shopping-cart"> 
          
          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">
            <div class="row"> 
              
              <!-- Login Register -->
              <div class="col-sm-6 center-block"> 
                <div class="heading text-center margin-bottom-50 margin-top-50">
                  <h4>ERROR!</h4>
                  <hr>
                </div>

                <!-- Login Register Inside -->
                <div class="tab-content" id="myTabContent"> 
                  
                  <div class="tab-pane fade show active" id="log" role="tabpanel" aria-labelledby="login-tab">
                    <div class="row text-center">
                      <h1 class="text-center">Something went wrong with your account.</h1>
                      <h3 style="margin: 30px auto;">Please contact admin.</h3>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    
  </div>
  
  <!-- FOOTER -->
  <?php include 'include/footer.php'; ?>
  
  <!-- GO TO TOP  --> 
  <a href="#" class="cd-top"><i class="fa fa-angle-up"></i></a> 
  <!-- GO TO TOP End --> 
  
</div>
<?php include 'include/footer-script.php'; ?>

</body>
</html>