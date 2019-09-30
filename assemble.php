<?php

if ( !isset($_COOKIE['web_user_id']) ) {
  header('location:./');
}

$page = 'PC Items';

require 'config.php';

$user_id = $_COOKIE['web_user_id'];

$list = '';
$price_box = '';

$include_motherboard  = 0;
$include_processor    = 0;
$include_ram          = 0;
$include_vga          = 0;
$include_hdd          = 0;
$include_rom          = 0;

$main_motherboard_comp_1 = '';
$main_motherboard_comp_2 = '';

$query = $db->query("SELECT * FROM `sale_assemble` WHERE `status` = 0 AND `user_id` = '$user_id' ");
$rowCount = $query->num_rows;
if($rowCount > 0){
  $amount_tot = 0;
  while($row = $query->fetch_assoc()){

    $id = $row['id'];
    $user_id = $row['user_id'];
    $item_id = $row['item_id'];

    $query_item = $db->query("SELECT * FROM `item` WHERE `id` = '$item_id' ");
    $row_item = $query_item->fetch_assoc();
    $vendor_id = $row_item['vendor_id'];
    $product_item_id = $row_item['item_id'];
    $product_category_id = $row_item['category_id'];
    $amount = $row_item['amount'];
    $compatible_1 = $row_item['compatible_1'];
    $compatible_2 = $row_item['compatible_2'];

    if ( $product_category_id == 4 ) {
      $main_motherboard_comp_1 = $compatible_1;
      $main_motherboard_comp_2 = $compatible_2;
    }


    $amount_tot += $amount;

    $amount = number_format($amount, 2, '.', ',');

    $amount_tot_label = number_format($amount_tot, 2, '.', ',');

    //Product Item
    $query_i = $db->query("SELECT * FROM `product_items` WHERE `id` = '$product_item_id' ");
    $row_i = $query_i->fetch_assoc();
    $item_title = $row_i['title'];
    $item_brand_id = $row_i['brand_id'];
    $item_category_id = $row_i['category_id'];
    $item_sub_category_id = $row_i['sub_category_id'];
    

    //Product Brand
    $query_b = $db->query("SELECT * FROM `product_brand` WHERE `id` = '$item_brand_id' ");
    $row_b = $query_b->fetch_assoc();
    $brand_name = $row_b['title'];

    //Vendor
    $query_v = $db->query("SELECT * FROM `user` WHERE `id` = '$vendor_id' ");
    $row_v = $query_v->fetch_assoc();
    $vendor_name = $row_v['name'];
    $vendor_location_id = $row_v['location_id'];
    
    $query_loc = $db->query("SELECT * FROM `location` WHERE `id` = '$vendor_location_id' ");
    $row_loc = $query_loc->fetch_assoc();
    $vendor_location = $row_loc['name'];


    $label_1 = $row_item['label_1'];
    $label_2 = $row_item['label_2'];
    $label_3 = $row_item['label_3'];
    $label_4 = $row_item['label_4'];
    $label_5 = $row_item['label_5'];    

    //Label Type

    $query_label_1        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_1' ");
    $row_label_1        = $query_label_1->fetch_assoc();
    $label_l_1_label_id     = $row_label_1['product_label_id'];
    $label_l_1          = $row_label_1['type'];

    $query_label_2        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_2' ");
    $row_label_2        = $query_label_2->fetch_assoc();
    $label_l_2_label_id     = $row_label_2['product_label_id'];
    $label_l_2          = $row_label_2['type'];

    $query_label_3        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_3' ");
    $row_label_3        = $query_label_3->fetch_assoc();
    $label_l_3_label_id     = $row_label_3['product_label_id'];
    $label_l_3          = $row_label_3['type'];

    $query_label_4        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_4' ");
    $row_label_4        = $query_label_4->fetch_assoc();
    $label_l_4_label_id     = $row_label_4['product_label_id'];
    $label_l_4          = $row_label_4['type'];

    $query_label_5        = $db->query("SELECT * FROM `product_item_label_type` WHERE `id` = '$label_5' ");
    $row_label_5        = $query_label_5->fetch_assoc();
    $label_l_5_label_id     = $row_label_5['product_label_id'];
    $label_l_5          = $row_label_5['type'];


    //Label

    $query_label_l_1_label  = $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_1_label_id' ");
    $row_label_l_1_label  = $query_label_l_1_label->fetch_assoc();
    $label_l_1_label    = $row_label_l_1_label['type'];

    $query_label_l_2_label  = $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_2_label_id' ");
    $row_label_l_2_label  = $query_label_l_2_label->fetch_assoc();
    $label_l_2_label    = $row_label_l_2_label['type'];

    $query_label_l_3_label  = $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_3_label_id' ");
    $row_label_l_3_label  = $query_label_l_3_label->fetch_assoc();
    $label_l_3_label    = $row_label_l_3_label['type'];

    $query_label_l_4_label  = $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_4_label_id' ");
    $row_label_l_4_label  = $query_label_l_4_label->fetch_assoc();
    $label_l_4_label    = $row_label_l_4_label['type'];

    $query_label_l_5_label  = $db->query("SELECT * FROM `product_item_label` WHERE `id` = '$label_l_5_label_id' ");
    $row_label_l_5_label  = $query_label_l_5_label->fetch_assoc();
    $label_l_5_label    = $row_label_l_5_label['type'];


    $label_l_2_n = ( $label_l_2 > 0 ) ? ' - '.$label_l_2 : '';
    $label_l_3_n = ( $label_l_3 > 0 ) ? ' - '.$label_l_3 : '';
    $label_l_4_n = ( $label_l_4 > 0 ) ? ' - '.$label_l_4 : '';
    $label_l_5_n = ( $label_l_5 > 0 ) ? ' - '.$label_l_5 : '';

    $all_labels = $label_l_1 . $label_l_2_n . $label_l_3_n . $label_l_4_n . $label_l_5_n;

     
    $label_2_label = ($label_2 > 0) ? ', ' . $label_l_2_label . ' - ' . $label_l_2 : '';
    $label_3_label = ($label_3 > 0) ? ', ' . $label_l_3_label . ' - ' . $label_l_3 : '';
    $label_4_label = ($label_4 > 0) ? ', ' . $label_l_4_label . ' - ' . $label_l_4 : '';
    $label_5_label = ($label_5 > 0) ? ', ' . $label_l_5_label . ' - ' . $label_l_5 : '';

    $short_title = $item_title .' - '. $brand_name . $all_labels ;
    $short_title = strlen($short_title) > 35 ? substr($short_title,0,35)."..." : $short_title;

$price_box .=<<<PRICE
<p>$short_title <span>Rs $amount </span></p>
PRICE;    


$list .=<<<EOD
<tr>
  <th class="text-left" style="width: 80%;"> <!-- Media Image --> 

    <!-- Item Name -->
    <div class="media-body">
      <span>$item_title - $brand_name $all_labels</span>
      <p>$label_l_1_label - $label_l_1 $label_2_label $label_3_label $label_4_label $label_5_label</p>
      <p>$vendor_name  - $vendor_location. </p>
    </div>
  </th>
  <td style="width: 15%;text-align: right;"><span class="price"><small>Rs</small>$amount</span></td>
  <td style="width: 5%;text-align: right;"><a class="remove-assemble-item" href="javascript:void(0);" data-id="$id"><i class="icon-close"></i></a></td>
</tr>
EOD;

/*
Start Compatible Include check

4   = Motherboard
13  = Processor
6   = RAM
8   = VGA
7   = HDD
12  = ROM

*/

if ( $product_category_id == 4 ) {
  $include_motherboard++;
}

if ( $product_category_id == 13 ) {
  $include_processor++;
}

if ( $product_category_id == 6 ) {
  $include_ram++;
}

if ( $product_category_id == 8 ) {
  $include_vga++;
}

if ( $product_category_id == 7 ) {
  $include_hdd++;
}

if ( $product_category_id == 12 ) {
  $include_rom++;
}


if ( $product_category_id == 6 ) {

  if ( $main_motherboard_comp_2 == $compatible_1 ) {
    $comp_ram  = ( $product_category_id == 6 ) ? '<span class="compatible">Compatible</span>' : '' ;
  }else{
    $comp_ram  = ( $product_category_id == 6 ) ? '<span class="not-compatible">Not Compatible</span>' : '' ;
  }  
  
}

if ( $product_category_id == 13 ) {

  if ( $main_motherboard_comp_1 == $compatible_1 ) {
    $comp_processor  = ( $product_category_id == 13 ) ? '<span class="compatible">Compatible</span>' : '' ;
  }else{
    $comp_processor  = ( $product_category_id == 13 ) ? '<span class="not-compatible">Not Compatible</span>' : '' ;
  }  
  
}

if ( $product_category_id == 8 ) {

  if ( $main_motherboard_comp_1 == $compatible_1 ) {
    $comp_vga  = ( $product_category_id == 8 ) ? '<span class="compatible">Compatible</span>' : '' ;
  }else{
    $comp_vga  = ( $product_category_id == 8 ) ? '<span class="not-compatible">Not Compatible</span>' : '' ;
  }  
  
}




  }
}else{

$list .=<<<EOD
<tr>
  <th class="text-left"> <!-- Media Image --> 
    <!-- Item Name -->
    <div class="media-body">
      <span>No Items</span>
      <p>Select Item and add to Assamble</p>
    </div>
  </th>
  <td><span class="price"></td>
  <td><a href="#."></td>
</tr>
EOD;

}

$inc_motherboard  = ( $include_motherboard > 0 ) ? 'add icon-check' : 'not-add icon-close' ;
$inc_processor    = ( $include_processor > 0  ) ? 'add icon-check' : 'not-add icon-close' ;
$inc_ram          = ( $include_ram > 0  ) ? 'add icon-check' : 'not-add icon-close' ;
$inc_vga          = ( $include_vga > 0  ) ? 'add icon-check' : 'not-add icon-close' ;
$inc_hdd          = ( $include_hdd > 0  ) ? 'add icon-check' : 'not-add icon-close' ;
$inc_rom          = ( $include_rom > 0  ) ? 'add icon-check' : 'not-add icon-close' ;




$comp_motherboard  = ( $include_motherboard > 0 ) ? '<span class="compatible">Compatible</span>' : '' ;

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
    <section class="padding-top-100 padding-bottom-100 pages-in chart-page">
      <div class="container"> 
        
        <!-- Payments Steps -->
        <div class="shopping-cart text-center">
          <table class="table">
            <thead class="thead-dark">
              <tr>
                <th scope="col" class="text-left">Item</th>
                <th scope="col">Price</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
              <?php echo $list; ?>        
            </tbody>
          </table>
        </div>
      </div>
    </section>
    
    <!-- PAGES INNER -->
    <section class="padding-top-100 padding-bottom-100 light-gray-bg shopping-cart small-cart">
      <div class="container"> 
        
        <!-- SHOPPING INFORMATION -->
        <div class="cart-ship-info margin-top-0">
          <div class="row"> 
            
            <!-- DISCOUNT CODE -->
            <div class="col-sm-5 compatible-data">
              <h6>Compatibility</h6>
              <table>
                <thead>
                  <tr>
                    <th style="width: 50%;">Item</th>
                    <th style="width: 15%;">Include</th>
                    <th style="width: 30%;">Status</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><p>Motherboard</p></td>
                    <td style="text-align: center;"><i class="<?php echo $inc_motherboard; ?>"></i></td>
                    <td style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td><p>Processor</p></td>
                    <td style="text-align: center;"><i class="<?php echo $inc_processor; ?>"></i></td>
                    <td style="text-align: center;"><?php echo $comp_processor; ?></td>
                  </tr>
                  <tr>
                    <td><p>RAM</p></td>
                    <td style="text-align: center;"><i class="<?php echo $inc_ram; ?>"></i></td>
                    <td style="text-align: center;"><?php echo $comp_ram; ?></td>
                  </tr>
                  <tr>
                    <td><p>Graphic Card</p></td>
                    <td style="text-align: center;"><i class="<?php echo $inc_vga; ?>"></i></td>
                    <td style="text-align: center;"><?php echo $comp_vga; ?></td>
                  </tr>
                  <tr>
                    <td><p>Hard Disk</p></td>
                    <td style="text-align: center;"><i class="<?php echo $inc_hdd; ?>"></i></td>
                    <td style="text-align: center;"></td>
                  </tr>
                  <tr>
                    <td><p>CD ROM</p></td>
                    <td style="text-align: center;"><i class="<?php echo $inc_rom; ?>"></i></td>
                    <td style="text-align: center;"></td>
                  </tr>
                </tbody>
                  
              </table>
            </div>

            <div class="col-sm-2">
            </div>
            
            <!-- SUB TOTAL -->
            <div class="col-sm-5">
              <h6>Grand Total</h6>
              <div class="grand-total">
                <div class="order-detail">
                  <p style="font-weight: bold;border-bottom: navajowhite;margin-bottom: 10px;">ITEM <span>AMOUNT </span></p>
                  <?php echo $price_box; ?>
                  
                  <!-- SUB TOTAL -->
                  <p class="all-total">TOTAL COST <span> <?php echo ($amount_tot_label > 0) ? 'Rs '.$amount_tot_label : 'Rs 0.00'; ?> </span></p>
                </div>
                <a href="proceed" class="btn margin-top-20">Proceed to Purchase</a> </div>
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