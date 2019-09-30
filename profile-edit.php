<?php

if ( !isset($_COOKIE['web_user_id']) ) {
  header('location:./');
}

$page = 'Profile';

require 'config.php';


$user_id = $_COOKIE['web_user_id'];

$query = $db->query("SELECT * FROM `user` WHERE `id` = '$user_id' ");
$rowCount = $query->num_rows;
if($rowCount > 0){
  while($row = $query->fetch_assoc()){

    $new_user_id         = $row['id'];
    $new_user_name       = $row['name'];
    $new_user_contact    = $row['contact'];
    $new_user_address    = $row['address'];


  }
}

$msg = '';

if ( isset($_POST['save']) ) {

  $tmp_user_id         = $_POST['tmp_id'];
  $tmp_user_name       = $_POST['name'];
  $tmp_user_contact    = $_POST['contact'];
  $tmp_user_address    = $_POST['address'];

  $db->query("UPDATE `user` SET `name`= '$tmp_user_name',`contact`= '$tmp_user_contact',`address`= '$tmp_user_address' WHERE `id`= '$tmp_user_id' ");

$msg = <<<MSG
<div class="alert alert-success" style="display:block;">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Updated!</strong> Your informations has been updated.
</div>
MSG;

header('refresh:2');
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
    <!-- Products -->
    <section class="shop-page padding-top-30 padding-bottom-100">
      <div class="container">
        <div class="row"> 
          <!-- Shop SideBar -->
          <div class="col-md-3">
            <img src="images/user.png" alt="user" style="width: 100%;">
            <div class="sidebar"> 
              <ul class="shop-cate margin-top-20">
                <li><a href="javascript:void(0);"> Inbox <span>01</span></a></li>
                <li><a href="history"> My History </a></li>
                <li><a href="profile"> Profile</a></li>
              </ul>
            </div>
          </div>
          
          <!-- Item Content -->
          <div class="col-md-9 profile-detail">
            <div class="col-md-9">
              <?php echo $msg; ?>
              <form method="POST">
                <div class="form-group">
                  <label> Name</label>
                  <input type="text" name="name" placeholder="Name" value="<?php echo $new_user_name; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label> Contact Number</label>
                  <input type="text" name="contact" placeholder="0000000000" value="<?php echo $new_user_contact; ?>" class="form-control">
                </div>
                <div class="form-group">
                  <label> Address</label>
                  <textarea class="form-control" name="address" rows="6"><?php echo $new_user_address; ?></textarea>
                </div>
                <div class="form-group text-right">
                   <input type="text" name="tmp_id" value="<?php echo $new_user_id; ?>" style="display: none;" >
                  <button type="submit" class="btn" name="save">SAVE</button>
                </div>
              </form>
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