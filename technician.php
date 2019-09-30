<?php
$page = 'Homepage';

require_once 'config.php';

$side_list_location = '';

//Fetch All Provinces 

if ( !isset( $_COOKIE['province'] ) ) {

  $query = $db->query("SELECT * FROM `location` WHERE `status` = 1 AND `level` = 1 ");
  $rowCount = $query->num_rows;
  if($rowCount > 0){
    $tmp_list = '';
    while($row = $query->fetch_assoc()){

      $id = $row['id'];
      $name = $row['name'];
$tmp_list .= <<<LIST
<li><a class="set-province" href="javascript:void(0);" data-id="$id"> $name</a></li>
LIST;
    }
  }
$side_list_location = <<<EOD
<h5 class="shop-tittle margin-bottom-30">Province</h5>
<ul class="shop-cate">
  $tmp_list
</ul>
EOD;
}

//Fetch All Districts belong to Province ID 

if ( isset( $_COOKIE['province'] ) && !isset( $_COOKIE['district'] ) ) {

  $tmp_parent_id = $_COOKIE['province'];

  $query = $db->query("SELECT * FROM `location` WHERE `status` = 1 AND `parent_id` = '$tmp_parent_id' ");
  $rowCount = $query->num_rows;
  if($rowCount > 0){
    $tmp_list = '';
    while($row = $query->fetch_assoc()){

      $id = $row['id'];
      $name = $row['name'];
$tmp_list .= <<<LIST
<li><a class="set-district" href="javascript:void(0);" data-id="$id"> $name</a></li>
LIST;
    }
  }
$side_list_location = <<<EOD
<h5 class="shop-tittle margin-bottom-30">District</h5>
<ul class="shop-cate">
  $tmp_list
</ul>
EOD;

}

//Fetch All Cities belong to District ID 

if ( isset( $_COOKIE['province'] ) && isset( $_COOKIE['district'] ) && !isset( $_COOKIE['city'] ) ) {

  $tmp_parent_id = $_COOKIE['district'];

  $query = $db->query("SELECT * FROM `location` WHERE `status` = 1 AND `parent_id` = '$tmp_parent_id' ");
  $rowCount = $query->num_rows;
  if($rowCount > 0){
    $tmp_list = '';
    while($row = $query->fetch_assoc()){

      $id = $row['id'];
      $name = $row['name'];
$tmp_list .= <<<LIST
<li><a class="set-city" href="javascript:void(0);" data-id="$id"> $name</a></li>
LIST;
    }
  }
$side_list_location = <<<EOD
<h5 class="shop-tittle margin-bottom-30">City</h5>
<ul class="shop-cate">
  $tmp_list
</ul>
EOD;

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
    <section class="shop-page padding-top-100 padding-bottom-100">
      <div class="container">
        <div class="row"> 
          <!-- Shop SideBar -->
          <div class="col-md-3">
            <div class="shop-sidebar"> 
              <div class="col-md-12 col-sm-12 col-xs-12" style="margin: 0 0 30px 0;">
                <form>
                  <div class="form-group">
                    <input class="form-control" type="text" name="" placeholder="Search here..." style="padding-right: 35px;">
                    <button class="" style="padding: 4px 5px;position: absolute;top: 0;right: 20px;line-height: 30px;border: navajowhite;background: transparent;"><i class="icon-magnifier"></i></button>
                  </div>
                </form>
              </div>
              
              <!-- Location -->
              <?php echo $side_list_location; ?>
              
            </div>
          </div>
          
          <!-- Item Content -->
          <div class="col-md-9" id="all-list">
           <div class="item-fltr"> 
              <div class="short-by">
                <?php include 'include/files/filter-province.php'; ?>
                <?php include 'include/files/filter-district.php'; ?>
                <?php include 'include/files/filter-city.php'; ?>
              </div>
            </div>
            <!-- Item -->
            <div id="products" class="arrival-block col-item-3 list-group">
              <div class="row">

                <!-- Item -->
                <?php include 'include/files/technician-list.php'; ?>
              </div>
            </div>
            
            <!-- Quick View -->
            <div id="qck-view-shop" class="zoom-anim-dialog qck-inside mfp-hide qck-view-shop-id">
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

    $('.popup-with-move-anim').on('click', function(){

      var item_id = $(this).data('id');

      $.ajax({
          url:'ajax-item-details.php',
          type:'POST',
          data:'type=get_item_data&item_id='+item_id,
          success:function (data) {
            $('#qck-view-shop').html(data);
          }
      });    

    });
  });
</script>

</body>
</html>