<?php

if ( !isset($_COOKIE['web_user_id']) ) {
  header('location:./');
}

$page = 'History';

require 'config.php';

$order_list = '';

$user_id = $_COOKIE['web_user_id'];

if ( isset($_POST['recieved'])) {
  
  $tmp_job_id = $_POST['tmp_job_id'];

  $db->query("UPDATE `job` SET `recieved`= 1, `recieved_time`= '$now' WHERE `id` = '$tmp_job_id' ");

  header('refresh:0');

}



$query_job = $db->query("SELECT * FROM `job` WHERE `client_id` = '$user_id' ORDER BY `id` DESC ");
$rowCount_job = $query_job->num_rows;
if($rowCount_job > 0){

  $nos = 0;

  while($row_job = $query_job->fetch_assoc()){

    $nos++;

    $job_id = $row_job['id'];

    $job_id_data = str_pad( $job_id, 10, 0 , STR_PAD_LEFT);

    $select = ( $nos == 1 ) ? 'order-select' : '';

    if ( $nos == 1  ) {
      $first_id  =$job_id;
    }


$order_list .= <<<ORDER
<li><a href="javascript:void(0);" class="all-order-list $select select-order" data-id="$job_id"> ORDER <span style="margin-right: 10px;">#$job_id_data</span></a></li>
ORDER;
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
            <div class="sidebar"> 
              <div class="history-order-list">
                <ul class="shop-cate margin-top-20">
                  <?php echo $order_list; ?>
                </ul>
              </div>
                
            </div>
          </div>
          
          <!-- Item Content -->
          <div class="col-md-9 profile-detail" id="order-data" style="min-height: 320px;">
            <div class="text-center" id="a-loader" style="display: none;">
              <i class="fa fa-spinner fa-spin" style="font-size: 50px;color: #ffe115; margin-top: 100px;"></i>
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

    var job_id = '<?php echo $first_id; ?>' ;

    $.ajax({
      url:'ajax-order.php',
      type:'POST',
      data:'type=get_order_data&job_id='+job_id,
      beforeSend: function() {
        $('#a-loader').show();
      },
      complete: function(){
        $('#a-loader').hide();
      },
      success:function (data) {
      $('#order-data').html(data);
      }
    });

    $('.select-order').on('click', function(e){
      e.preventDefault();

      var job_id = $(this).data('id');

      $('.all-order-list').removeClass('order-select');
      $(this).addClass('order-select');

      $.ajax({
          url:'ajax-order.php',
          type:'POST',
          data:'type=get_order_data&job_id='+job_id,
          beforeSend: function() {
            $('#a-loader').show();
          },
          complete: function(){
            $('#a-loader').hide();
          },
          success:function (data) {
          $('#order-data').html(data);
          }
      });    

    });

  });
</script>

</body>
</html>