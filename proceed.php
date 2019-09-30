<?php

if ( !isset($_COOKIE['web_user_id']) ) {
  header('location:./');
}

$page = 'Proceed';

require 'config.php';

$province = '';

$query = $db->query("SELECT * FROM `location` WHERE `parent_id` = 0 AND `status` = 1 ");
$rowCount = $query->num_rows;
if($rowCount > 0){      
  $tmp_item_amount = 0;
  while($row = $query->fetch_assoc()){
    $pro_id = $row['id'];
    $pro_name = $row['name'];

$province .= <<<EOD
<option value="$pro_id">$pro_name</option>
EOD;
  }
}
 


$user_details = '';

$user_id = $_COOKIE['web_user_id'];

$query_check = $db->query("SELECT * FROM `sale_assemble` WHERE `user_id` = '$user_id' AND `status` = 0 ");
$rowCount_check = $query_check->num_rows;
if ( $rowCount_check == 0 ) {
  header('location:assemble');
}



$query = $db->query("SELECT * FROM `user` WHERE `id` = '$user_id' ");
$rowCount = $query->num_rows;
if($rowCount > 0){
  while($row = $query->fetch_assoc()){

    $new_user_id         = $row['id'];
    $new_user_email       = $row['username'];
    $new_user_name       = $row['name'];
    $new_user_contact    = $row['contact'];
    $new_user_address    = str_replace(',', '<br>', $row['address']);

$user_details .= <<<EOD
<div class="col-md-12">
  <table style="width: 100%;margin-bottom: 40px;">
    <tr>
      <td style="width: 20%;padding: 10px 0;">Name</td>
      <td style="width: 80%;padding: 10px 0;">$new_user_name</td>
    </tr>
    <tr>
      <td style="width: 20%;padding: 10px 0;">Contact</td>
      <td style="width: 80%;padding: 10px 0;">$new_user_contact</td>
    </tr>
    <tr>
      <td style="width: 20%;padding: 10px 0;">Email</td>
      <td style="width: 80%;padding: 10px 0;">$new_user_email</td>
    </tr>
    <tr>
      <td style="width: 20%;padding: 10px 0;">Address</td>
      <td style="width: 80%;padding: 10px 0;">$new_user_address</td>
    </tr>
  </table>
</div>
EOD;

  }
}


if (isset($_POST['proceed']) ) {

  $tech_id          = $_POST['technician'];
  $delivery         = $_POST['delivery'] ;
  $payment_method   = $_POST['payment_method'];

  $db->query("INSERT INTO `job`( `tech_id`, `client_id`, `add_time`, `delivery`, `payment_method_id` ) VALUES ('$tech_id', '$user_id', '$now', '$delivery', '$payment_method')");
  $last_id = $db->insert_id;

  

  if ( $last_id > 0 ) {

    $query = $db->query("SELECT * FROM `sale_assemble` WHERE `user_id` = '$user_id' AND `status` = 0 ");
    $rowCount = $query->num_rows;
    if($rowCount > 0){      
      $tmp_item_amount = 0;
      while($row = $query->fetch_assoc()){

        $tmp_id = $row['id'];
        $tmp_item_id = $row['item_id'];

        $query_item = $db->query("SELECT * FROM `item` WHERE `id` = '$tmp_item_id' ");
        $row_item = $query_item->fetch_assoc();
        $tmp_amount = $row_item['amount'];

        $db->query("UPDATE `sale_assemble` SET `job_id`= '$last_id', `item_purchase_amount`= '$tmp_amount', `status`= 1 WHERE `id` = '$tmp_id' ");

        $tmp_item_amount += $tmp_amount;
       
      }
    }
    
  }

  $db->query("UPDATE `job` SET `job_amount`= '$tmp_item_amount' WHERE `id` = '$last_id' ");
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
  
  <!--======= SUB BANNER =========-->
  <section class="sub-bnr" data-stellar-background-ratio="0.5">
    <div class="position-center-center">
      <div class="container">
        <h4>Proceed your PC Items purchasing</h4>
      </div>
    </div>
  </section>
  
  <!-- Content -->
  <div id="content"> 
    
    <!--======= PAGES INNER =========-->
    <section class="chart-page padding-top-30 padding-bottom-100">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="shopping-cart"> 
          
          <!-- SHOPPING INFORMATION -->
          <div class="cart-ship-info">
            <div class="row"> 
              
              <!-- ESTIMATE SHIPPING & TAX -->
              <div class="col-sm-7">
                <h6>Billing Information</h6>                 

                <form>
                  <ul class="row" id="technician-all">

                    <?php echo $user_details; ?>   

                    <li class="col-md-6">
                      <div class="form-group">
                        <label> TECHNICIAN PROVINCE</label>
                        <select class="form-control cal-total" id="tech-province">
                          <option>SELECT</option>
                          <?php echo $province; ?>
                        </select>
                      </div>
                      
                    </li> 
                    <li class="col-md-6" id="tech-district">
                                            
                    </li> 
                    <li class="col-md-12" id="tech-city">
                      
                    </li>                  

                    <li class="col-md-12" id="tech-data">
                                            
                    </li>
                  </ul>
                </form>
              </div>
              
              <!-- SUB TOTAL -->
              <div class="col-sm-5" id="amount-panel">
                
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

  var tech = $('#technician-all'); 

  $(tech).on('change', '#tech-province', function(e){ 
    e.preventDefault();

    var id = $(this).val();

    if ( id == 'SELECT' ) {
      $('#tech-district').html('');
      $('#tech-city').html('');
      $('#tech-data').html('');
      
    }else{
      $.ajax({
        url:'ajax-technician.php',
        type:'POST',
        data:'type=get_tech_data_district&id='+id,
        success:function (data) {
          $('#tech-district').html(data);
        }
      }); 

      $.ajax({
        url:'ajax-technician.php',
        type:'POST',
        data:'type=get_tech_data&id='+id+'&list_province='+id,
        success:function (data) {
          $('#tech-data').html(data);
        }
      });
    }

     

  });

  $(tech).on('change', '#tech-district-select', function(e){ 
    e.preventDefault();

    var id = $(this).val();

    if ( id == 'SELECT' ) {
      $('#tech-city').html('');
      
    }else{
      $.ajax({
        url:'ajax-technician.php',
        type:'POST',
        data:'type=get_tech_data_city&id='+id,
        success:function (data) {
          $('#tech-city').html(data);
        }
      }); 

      $.ajax({
        url:'ajax-technician.php',
        type:'POST',
        data:'type=get_tech_data&id='+id+'&list_district='+id,
        success:function (data) {
          $('#tech-data').html(data);
        }
      }); 
    }      

  });


  $(tech).on('change', '#tech-city-select', function(e){ 
    e.preventDefault();

    var id = $(this).val();

    $.ajax({
      url:'ajax-technician.php',
      type:'POST',
      data:'type=get_tech_data&id='+id+'&list_city='+id,
      success:function (data) {
        $('#tech-data').html(data);
      }
    }); 

  });

  $(tech).on('change', '#get-tech-details', function(e){ 
    e.preventDefault();

    var id = $(this).val();
    if ( id > 0 ) {
      $.ajax({
        url:'ajax-technician.php',
        type:'POST',
        data:'type=get_tech_details&id='+id,
        success:function (data) {
          $('#tech-details').html(data);
        }
      });
    }else{
      $('#tech-details').html('');
    }       

  });


  $(tech).on('change', '.cal-total', function(e){ 
    e.preventDefault();

    var tech_id = $('#get-tech-details').val();

    $.ajax({
      url:'ajax-technician.php',
      type:'POST',
      data:'type=get_cost_details&tech_id='+tech_id,
      success:function (data) {
        $('#amount-panel').html(data);
      }
    }); 

  });

  $.ajax({
    url:'ajax-technician.php',
    type:'POST',
    data:'type=get_cost_details',
    success:function (data) {
      $('#amount-panel').html(data);
    }
  }); 

});
</script>


</body>
</html>