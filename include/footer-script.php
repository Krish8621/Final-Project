<?php
$f_path = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];

$f = basename($_SERVER['PHP_SELF']); 

$path = str_replace($f,'',$f_path);

?>
<script src="js/jquery-1.12.4.min.js"></script> 
<script src="js/popper.min.js"></script> 
<script src="js/bootstrap.min.js" ></script> 
<script src="js/own-menu.js"></script> 
<script src="js/jquery.lighter.js"></script> 
<script src="js/jquery.magnific-popup.min.js"></script> 
<script src="js/owl.carousel.min.js"></script> 
<script src="js/main.js"></script>

<script>
  function myAlertTop(){
    $(".myAlert-top").show();
    setTimeout(function(){
      $(".myAlert-top").hide(); 
    }, 2000);
  }
</script>

<script>
  $(document).ready(function(){

    $('.auth-login').on('click', function(){

      $.ajax({
          url:'ajax-sale.php',
          type:'POST',
          data:'type=warning_login_first',
          success:function (data) {
            $('#msg-alert').html(data);
            myAlertTop();
          }
      });  

    });

    $('.add-assemble').on('click', function(){

      var item_id = $(this).data('id');

      $.ajax({
          url:'ajax-sale.php',
          type:'POST',
          data:'type=add_tmp_sale_assemble_item&item_id='+item_id,
          success:function (data) {
            $('#msg-alert').html(data);
            myAlertTop();
          }
      });    

    });


    $('.remove-assemble-item').on('click', function(){

      var item_id = $(this).data('id');

      $.ajax({
          url:'ajax-sale.php',
          type:'POST',
          data:'type=remove_tmp_sale_assemble_item&item_id='+item_id,
          success:function (data) {
            $('#msg-alert').html(data);
            myAlertTop();
            window.setTimeout(function(){
              location.reload();
            },1000);
          }
      });    

    });


    $('.set-province').on('click', function(){

      var id = $(this).data('id');

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=set_location_province&id='+id,
          success:function (data) {
            location.reload();
          }
      });    

    });

    $('.set-district').on('click', function(){

      var id = $(this).data('id');

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=set_location_district&id='+id,
          success:function (data) {
            location.reload();
          }
      });    

    });

    $('.set-city').on('click', function(){

      var id = $(this).data('id');

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=set_location_city&id='+id,
          success:function (data) {
            location.reload();
          }
      });    

    });

    $('.set-sub_category').on('click', function(){

      var id = $(this).data('id');

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=set_sub_category&id='+id,
          success:function (data) {
            location.reload();
          }
      });    

    });

    $('.set-vendor').on('click', function(){

      var id = $(this).data('id');

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=set_vendor&id='+id,
          success:function (data) {
            window.location.href = "<?php echo $path; ?>";           
          }
      });    

    });

    $('.province-clear').on('click', function(){

      var id = '1';

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=clear_location_province&id='+id,
          success:function (data) {
            location.reload();
          }
      });    

    });

    $('.district-clear').on('click', function(){

      var id = '1';

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=clear_location_district&id='+id,
          success:function (data) {
            location.reload();
          }
      });    

    });

    $('.city-clear').on('click', function(){

      var id = '1';

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=clear_location_city&id='+id,
          success:function (data) {
            location.reload();
          }
      });    

    });

    

    $('.sub-category-clear').on('click', function(){

      var id = '1';

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=clear_sub_category&id='+id,
          success:function (data) {
            location.reload();
          }
      });    

    });

    $('.vendor-clear').on('click', function(){

      var id = '1';

      $.ajax({
          url:'ajax-setup.php',
          type:'POST',
          data:'type=clear_vendor&id='+id,
          success:function (data) {
            location.reload();
          }
      });    

    });


  });
</script>