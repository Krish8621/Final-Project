<?php

$page_name = basename($_SERVER['PHP_SELF']);

if ( $page_name == 'vendor.php' ) {
  $vendor_active = 'active';
}elseif ( $page_name == 'technician.php' ) {
  $tech_active = 'active';
}elseif ( $page_name == 'about.php' ) {
  $about_active = 'active';
}elseif ( $page_name == 'contact.php' ) {
  $contact_active = 'active';
}else{
  $home_active = 'active';
}

$pc_part_list = '';
$query = $db->query("SELECT * FROM `product_category` WHERE `status` = 1 AND `parent_id` = 1 AND `level` = 2 ");
$rowCount = $query->num_rows;
if($rowCount > 0){
  while($row = $query->fetch_assoc()){

    $sub_category_id = $row['id'];
    $sub_category = strtoupper($row['type']);

$pc_part_list .= <<<EOD
<li><a href="javascript:void(0);" class="set-sub_category" data-id="$sub_category_id">$sub_category</a> </li>
EOD;
  }
}

$pc_accessory_list = '';
$query = $db->query("SELECT * FROM `product_category` WHERE `status` = 1 AND `parent_id` = 2 AND `level` = 2 ");
$rowCount = $query->num_rows;
if($rowCount > 0){
  while($row = $query->fetch_assoc()){

    $sub_category_id = $row['id'];
    $sub_category = strtoupper($row['type']);

$pc_accessory_list .= <<<EOD
<li><a href="javascript:void(0);" class="set-sub_category" data-id="$sub_category_id">$sub_category</a> </li>
EOD;
  }
}

?>



<header>
  <div class="sticky">
    <div class="container-full"> 
      
      <!-- Logo -->
      <div class="logo"> <a href="./"><img class="img-responsive" src="images/logo.png" alt="" ></a> </div>
      <nav class="navbar ownmenu navbar-expand-lg ">
        <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"> <span></span> </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="nav">
            <li class="<?php echo $home_active; ?>">
              <a href="./" >Home</a>
            </li>
            <li class="<?php echo $vendor_active; ?>">
              <a href="vendor" >Vendors</a>
            </li>
            <li class="dropdown"> <a href="index.html" class="dropdown-toggle" data-toggle="dropdown">PC Parts</a>
              <ul class="dropdown-menu">
                <?php echo $pc_part_list; ?>
              </ul>
            </li>
            <li class="dropdown"> <a href="index.html" class="dropdown-toggle" data-toggle="dropdown">PC Accessories</a>
              <ul class="dropdown-menu">
                <?php echo $pc_accessory_list; ?>
              </ul>
            </li>

            <li class="<?php echo $tech_active; ?>">
              <a href="technician" >Support</a>
            </li>
            <li class="<?php echo $about_active; ?>">
              <a href="./" >About</a>
            </li>
            <li class="<?php echo $contact_active; ?>">
              <a href="./" >Contact</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
  <div class="clearfix"></div>
</header>