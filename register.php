<?php
$page = 'Register';

if ( isset($_COOKIE['web_user_id']) ) {
  header('location:./');
}

require 'config.php';

$alert = '';

if (isset($_POST['register'])) {

  $email      = $_POST['email'];
  $password   = sha1($_POST['password']);
  $name      = $_POST['name'];
  $contact      = $_POST['contact'];
  $level      = $_POST['level'];

  $province_id      = $_POST['province_id'];
  $district_id      = $_POST['district_id'];
  $city_id          = $_POST['city_id'];
      
  $query    = $db->query("SELECT * FROM `user` WHERE `username` = '$email' ");
  $rowCount = $query->num_rows;


  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

    $alert = '<div class="alert alert-danger" style="display: block;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> Invalid Email address.
                  </div>';

  }else{

    if ( $rowCount > 0 ) {

      $alert = '<div class="alert alert-danger" style="display: block;">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error!</strong> Email address already exist.
                  </div>';
    }else{

      $db->query("INSERT INTO `user`(`username`, `password`, `name`, `contact`, `location_id`, `province_id`, `district_id`, `city_id`, `level_id`, `status`) VALUES ('$email', '$password', '$name', '$contact', '$city_id', '$province_id', '$district_id', '$city_id', '$level', 1 )");

      header('location:login');

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
                  <h4>REGISTER</h4>
                  <hr>
                </div>

                <?php echo $alert; ?>
                <!-- Login Register Inside -->
                <div class="tab-content" id="myTabContent">

                  <div class="tab-pane fade show active" id="log" role="tabpanel" aria-labelledby="login-tab">
                    <form method="POST">
                      <ul class="row" id="register-data">

                        <li class="col-md-12">
                          <label> Register as a
                            <select class="form-control" name="level" id="level">
                              <option value="4">User</option>
                              <option value="3">Technician</option>
                              <option value="2">Vendor</option>
                            </select>
                          </label>
                        </li>
                        <li class="col-md-12" id="tmp-name">                          
                        </li>
                        <li class="col-md-12" id="tmp-contact">                          
                        </li>
                        <li class="col-md-12" id="location-province">
                        </li>
                        <li class="col-md-12" id="location-district">
                        </li>
                        <li class="col-md-12" id="location-city">
                        </li>
                        <li class="col-md-12">
                          <label> Email Address
                            <input type="text" name="email" placeholder="username@email.com" class="form-control" autocomplete="off">
                          </label>
                        </li>
                        <li class="col-md-12">
                          <label> Password
                            <input type="password" name="password" placeholder="PASSWORD" class="form-control">
                          </label>
                        </li>
                        <li class="col-md-12 text-right">
                          <button type="submit" class="btn" name="register">REGISTER</button>
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

<script>
$(document).ready(function(){

  var tech = $('#register-data'); 

  $(tech).on('change', '#level', function(e){ 
    e.preventDefault();    
    var id = $(this).val();

    if ( id == '4' ) {
      $('#location-province').html('');
      $('#location-district').html('');
      $('#location-city').html('');
      $('#tmp-name').html('');
      $('#tmp-contact').html('');
    }

    $.ajax({
      url:'ajax-register.php',
      type:'POST',
      data:'type=get_locations&id='+id,
      success:function (data) {
        $('#location-province').html(data);
      }
    });

    $.ajax({
      url:'ajax-register.php',
      type:'POST',
      data:'type=get_general_data_name&id='+id,
      success:function (data) {
        $('#tmp-name').html(data);
      }
    });

    $.ajax({
      url:'ajax-register.php',
      type:'POST',
      data:'type=get_general_data_contact&id='+id,
      success:function (data) {
        $('#tmp-contact').html(data);
      }
    });

  });

  $(tech).on('change', '#get-province', function(e){ 
    e.preventDefault();    
    var id = $(this).val();

    $.ajax({
      url:'ajax-register.php',
      type:'POST',
      data:'type=get_district&id='+id,
      success:function (data) {
        $('#location-district').html(data);
      }
    }); 
    
  });

  $(tech).on('change', '#get-district', function(e){ 
    e.preventDefault();    
    var id = $(this).val();

    $.ajax({
      url:'ajax-register.php',
      type:'POST',
      data:'type=get_city&id='+id,
      success:function (data) {
        $('#location-city').html(data);
      }
    }); 
    
  });


});
</script>

</body>
</html>