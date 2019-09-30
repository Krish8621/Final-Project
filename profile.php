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
    $new_user_email      = $row['username'];
    $new_user_name       = $row['name'];
    $new_user_contact    = $row['contact'];
    $new_user_address    = str_replace(',', '<br>', $row['address']);
    $new_user_level_id   = $row['level_id'];

    if ( $new_user_level_id == 1 ) {
      $new_user_level = 'ADMIN';
    }elseif ( $new_user_level_id == 2 ) {
      $new_user_level = 'VENDOR';
    }elseif ( $new_user_level_id == 3 ) {
      $new_user_level = 'TECHNICIAN';
    }elseif ( $new_user_level_id == 4 ) {
      $new_user_level = 'USER';
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
                <li><a href="profile-edit"> Edit</a></li>
              </ul>
            </div>
          </div>
          
          <!-- Item Content -->
          <div class="col-md-9 profile-detail">
            <table>
              <tr>
                <td style="width: 25%;">Name<div class="on-sale"> <?php echo $new_user_level; ?> </div></td>
                <td style="width: 75%;"><h4><?php echo $new_user_name; ?></h4></td>
              </tr>
              <tr>
                <td style="width: 25%;">Email</td>
                <td style="width: 75%;"><h6><?php echo $new_user_email; ?></h6></td>
              </tr>
              <tr>
                <td style="width: 25%;">Contact</td>
                <td style="width: 75%;"><h6><?php echo $new_user_contact; ?></h6></td>
              </tr>
              <tr>
                <td style="width: 25%;">Address</td>
                <td style="width: 75%;">
                  <h6><?php echo $new_user_address; ?></h6>
                </td>
              </tr>
            </table>
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