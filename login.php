<?php
$page = 'Login'; 

if ( isset($_COOKIE['web_user_id']) ) {
  header('location:./');
}

require 'config.php';

if (isset($_POST['login'])) {

  $email    = $_POST['email'];
  $password = sha1($_POST['password']);

$query      = $db->query("SELECT * FROM `user` WHERE `username` = '$email' AND `password` = '$password' ");
$rowCount   = $query->num_rows;
if($rowCount > 0){
    while($row = $query->fetch_assoc()){

      $get_user_id = $row['id'];
      $get_username = $row['username'];
      $get_password = $row['password'];
      $get_status   = $row['status'];
      

      if( strcmp($email , $get_username) == 0 && strcmp($password , $get_password) == 0 ) {

        if ( $get_status == 1 ) {
            
          setcookie("web_user_id", $get_user_id, 0);
          header('location:./');


        }else{

          header('location:error');

        }

      }       

    }
  }     

}





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
              <div class="col-sm-5 center-block"> 
                <div class="heading text-center margin-bottom-50 margin-top-50">
                  <h4>LOGIN</h4>
                  <hr>
                </div>

                <?php echo $alert; ?>

                <!-- Login Register Inside -->
                <div class="tab-content" id="myTabContent"> 
                  
                  <div class="tab-pane fade show active" id="log" role="tabpanel" aria-labelledby="login-tab">
                    <form method="POST">
                      <ul class="row">
                        <li class="col-md-12">
                          <label> Email Address
                            <input type="text" name="email" placeholder="username@email.com" class="form-control">
                          </label>
                        </li>
                        <li class="col-md-12">
                          <label> Password
                            <input type="password" name="password" placeholder="PASSWORD" class="form-control">
                          </label>
                        </li>

                        <li class="col-md-12 text-right">
                          <button type="submit" class="btn" name="login">LOGIN</button>
                        </li>
                      </ul>
                    </form>
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