<?php 
  session_start(); 
  ob_start();
  include "admin/inc/db.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/0c66e46c25.js" crossorigin="anonymous"></script>

    <!-- DATATABLE CSS LINK -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.4/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.2.5/css/buttons.dataTables.css">

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">


    <style>
      body, .main_body {
        background-color: #E4E9F7;
      }
      #sidebar-nav {
          width: 200px;
      }

      a.list-group-item.border-end-0.d-inline-block.text-truncate {
          background: #11101D;
          color: #fff;
          border: 0;
          line-height: 4em;
      }

      a.list-group-item.border-end-0.d-inline-block.text-truncate:hover{
        border-bottom: 1px solid #fff;        
        color: #fff;
        border-radius: 5px; 
        transition: 0.2s ease-in-out;
        background: #1d1b31;
      }

      a.border.rounded-3.p-1.text-decoration-none {
          color: #11101D;
      }
    </style>
  </head>
  <body>
    <section class="">
      <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="col-auto px-0" style="background: #11101D;">
                <div id="sidebar" class="collapse collapse-horizontal show border-end" >
                    <div id="sidebar-nav" class="list-group border-0 rounded-0 text-sm-start min-vh-100">
                        <a href="sellerDashboard.php?do=Home" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="fa-solid fa-gauge-simple-high"></i> <span>&nbsp;Dashboard</span> </a>
                        <hr style="color: #72717f;">
                        <a href="sellerDashboard.php?do=Manage" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="fa-solid fa-box"></i> <span>&nbsp;Products Part</span></a>
                        <a href="sellerDashboard.php?do=Profile" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="fa-solid fa-user"></i> <span>&nbsp;Profile</span></a>
                        <a href="sellerDashboard.php?do=Support" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="fa-regular fa-message"></i> <span>&nbsp;Support</span></a>
                        <a href="sellerDashboard.php?do=Contact" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="fa-solid fa-address-book"></i> <span>&nbsp;Contact</span></a>
                        <a href="logout.php" class="list-group-item border-end-0 d-inline-block text-truncate" data-bs-parent="#sidebar"><i class="fa-solid fa-right-from-bracket"></i> <span>&nbsp;Logout</span></a>
                    </div>
                </div>
            </div>
            <main class="col ps-md-2 pt-2 main_body">
                

                <div class="d-flex justify-content-between pb-3">
                  <a href="#" data-bs-target="#sidebar" data-bs-toggle="collapse" class="border rounded-3 p-1 text-decoration-none"><i class="fa-solid fa-backward"></i> Menu</a>
                  <!-- For users login or nor -->
                  <?php  
                    if (!empty($_SESSION['user_id'])) { 

                      $user_id = $_SESSION['user_id'];
                      $readUId_Sql = "SELECT * FROM users WHERE status=1 AND user_id='$user_id'";
                      $readUId_Query = mysqli_query($db, $readUId_Sql);

                      while( $row = mysqli_fetch_assoc($readUId_Query) ) {
                        $user_id        = $row['user_id'];
                        $fullname         = $row['user_name'];
                        $_SESSION['email']    = $row['user_email'];
                        $password         = $row['user_password'];
                        $role           = $row['role'];
                        $status         = $row['status'];
                        $user_image       = $row['user_image'];
                        ?>
                          <div class="d-flex align-self-center">
                            <div>
                              <?php  
                                    if (!empty($user_image)) {
                                  echo '<img src="admin/assets/images/seller/' . $user_image . '" style="width: 50px;margin: 0px 10px;">';
                                }
                                else {
                                  echo '<img src="admin/assets/images/seller/default.png" style="width: 50px;margin: 0px 10px;">';
                                }
                                  ?>
                            </div>
                            <div>
                              <h3><?php echo $fullname; ?></h3>
                            </div>
                          </div>
                        <?php
                      }

                      ?>
                      
                    <?php }

                    else { ?>
                      <li class="dropdown">
                        <a class="dropdown-item dropdown-toggle" href="login.php">
                          <i class="fa-solid fa-arrow-right-to-bracket px-1"></i> Login
                        </a>
                      </li>

                      <li class="dropdown">
                        <a class="dropdown-item dropdown-toggle" href="register.php">
                          <i class="fa-regular fa-address-card px-1"></i> Regsiter
                        </a>
                      </li>

                    <?php }
                  ?>
                  <!-- For users login or nor -->
                </div>

                <div class="p-3">

                 

                  <?php

                    $do = isset( $_GET['do'] ) ? $_GET['do'] : "Manage";

                    if ( $do == "Manage" ) { ?>
                      <div class="container pb-5">
                        <div class="row">
                          <div class="col-lg-12">
                              <h4 class="text-uppercase">Manage All Products</h4>

                              <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="sellerDashboard.php?do=Add" class="btn btn-dark">Add New Product</a>
                                <a href="sellerDashboard.php?do=ManageTrash" class="btn btn-danger">Trash</a>
                              </div>
                              
                            
                            <hr>                           

                            <!-- START: TABLE -->
                            <div class="table-responsive" style="padding: 30px; box-shadow: 0px 1px 8px #ccc; border-radius: 10px;">
                              <table id="example" class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                  <tr>
                                    <th scope="col">#Sl.</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price (Taka)</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Join Date</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>

                                <tbody>
                                  <?php  
                                    if (!empty($_SESSION['email'])) {
                                      $sellerId = $_SESSION['email'];

                                      $sellerReadSql = "SELECT * FROM category WHERE status !=0 AND seller_email='$sellerId' ORDER BY cat_name ASC";
                                      $sellerReadQuery = mysqli_query( $db, $sellerReadSql );
                                      $sellerCount = mysqli_num_rows($sellerReadQuery);

                                      if ( $sellerCount == 0 ) { ?>
                                        <div class="alert alert-danger text-center" role="alert">
                                        Sorry! No Product Found!.
                                      </div>
                                      <?php }

                                      else {
                                        $i = 0;

                                        while ($row = mysqli_fetch_assoc($sellerReadQuery)) {
                                          $cat_id     = $row['cat_id'];
                                          $cat_name     = $row['cat_name'];
                                          $cat_desc     = $row['cat_desc'];
                                          $is_parent    = $row['is_parent'];
                                          $status     = $row['status'];
                                          $join_date    = $row['join_date'];
                                          $cat_image    = $row['cat_image'];        
                                          $price      = $row['price'];        
                                          $seller_name  = $row['seller_name'];        
                                          $seller_email   = $row['seller_email'];       
                                          $i++;
                                          ?>

                                          <tr>
                                            <th scope="row" class="text-center"><?php echo $i; ?></th>
                                            <td class="text-center">
                                              <?php  
                                                if (!empty($cat_image)) {
                                              echo '<img src="admin/assets/images/category/' . $cat_image . '" style="width: 60px";>';
                                            }
                                            else {
                                              echo '<img src="admin/assets/images/category/default.jpg" style="width: 60px";>';
                                            }
                                              ?>
                                            </td>
                                            <td class="text-center"><?php echo $cat_name; ?></td>
                                            <td class="text-center"><?php echo $price; ?> Taka</td>
                                            <td class="text-center">
                                              <?php  

                                                $readCat_Sql = "SELECT * FROM category WHERE cat_id='$is_parent'";
                                                $readCat_Quary = mysqli_query($db, $readCat_Sql);

                                                while( $row = mysqli_fetch_assoc($readCat_Quary) ){
                                                  $cc_id   = $row['cat_id'];
                                                  $cc_name = $row['cat_name'];
                                                  ?>
                                                  <span class="badge text-bg-secondary"><?php echo "$cc_name"; ?></span>
                                                  <?php

                                                  
                                                }

                                              ?>
                                        </td>
                                            <td class="text-center">
                                              <?php  
                                                if ($status == 1) { ?>
                                                  <span class="badge text-bg-success">ACTIVE</span>
                                                <?php }
                                                else if ($status == 0) { ?>
                                                  <span class="badge text-bg-danger">INACTIVE</span>
                                                <?php }
                                                else if ($status == 2) { ?>
                                                  <span class="badge text-bg-warning">PENDING</span>
                                                <?php }
                                              ?>
                                            </td>
                                            <td class="text-center"><?php echo $join_date; ?></td>
                                            <td>
                                            <div class="action-btn">
                                              <ul>
                                                  <li>
                                                    <a href="sellerDashboard.php?do=Edit&uId=<?php echo $cat_id; ?>"><i class="fa-regular fa-pen-to-square edit"></i></a>
                                                  </li>
                                                  <li>
                                                    <a href=""  data-bs-toggle="modal" data-bs-target="#uId<?php echo $cat_id; ?>"><i class="fa-regular fa-trash-can trush"></i></a>
                                                  </li>
                                              </ul>
                                            </div>

                                            <!-- Modal Start -->
                                            <div class="modal fade" id="uId<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog" >
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel">Are You Sure?? To Move <i class="fa-regular fa-face-frown"></i><br> <span style="color: green;"><?php echo $cat_name; ?></span> Trash folder!!</h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="modal-btn">
                                                      <a href="sellerDashboard.php?do=Trash&tId=<?php echo $cat_id; ?>"class="btn btn-danger me-3">Trash</a>
                                                      <a href="" class="btn btn-success" data-dismiss="modal">Close</a>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- Modal End -->
                                           </td>
                                          </tr>

                                          <?php
                                        }
                                      }






                                      
                                    }
                                  ?>
                                  
                                </tbody>
                              </table>
                            </div>
                            <!-- END: TABLE -->

                          </div>
                        </div>
                      </div>
                    <?php }

                    else if ( $do == "Home" ) { ?>
                        <div class="page-header pt-3">
                          <h2 class="text-center">Welcome To Seller Dashboard</h2>
                        </div>
                    <?php }

                    else if ( $do == "Contact" ) { ?>
                        <div class="page-header pt-3" style="padding: 30px; box-shadow: 0px 1px 8px #ccc; border-radius: 10px;  margin: 0px auto;">
                          <h2 class="text-center pb-5">Contact Info</h2>

                          <div>                          
                          
                            <p><i class="fa-solid fa-envelope"></i> &nbsp; dummy@gmail.com</p>
                            <p><i class="fa-solid fa-phone"></i> &nbsp; +880 8888888888</p>
                            <p><i class="fa-solid fa-map-pin"></i> &nbsp; Dhaka</p>
                          </div>
                        </div>
                    <?php }

                    else if ( $do == "Profile" ) { ?>
                        <div class="page-header pt-3" style="padding: 30px; box-shadow: 0px 1px 8px #ccc; border-radius: 10px;  margin: 0px auto;">
                          <h2 class="text-center pb-5">Profile Update</h2>

                          <?php  

                            $sessionId =  $_SESSION['user_id'];
                            $readUId_Sql = "SELECT * FROM users WHERE status=1 AND user_id='$sessionId'";
                            $readUId_Query = mysqli_query($db, $readUId_Sql);

                            while( $row = mysqli_fetch_assoc($readUId_Query) ) {
                              $user_id    = $row['user_id'];
                              $user_name    = $row['user_name'];
                              $user_email   = $row['user_email'];
                              $user_phone   = $row['user_phone'];
                              $user_address   = $row['user_address'];
                              $role       = $row['role'];
                              $status     = $row['status'];
                              $user_image   = $row['user_image'];
                              $join_date    = $row['join_date'];

                              ?>

                              <form action="" method="POST" enctype="multipart/form-data">
                                <div class="row">
                                  <div class="col-lg-4">
                                    <div class="mb-3">
                                      <label for="" class="form-label">Full Name</label>
                                      <input type="text" name="fname" class="form-control" required autocomplete="off" autofocus value="<?php echo $user_name; ?>">
                                    </div>

                                    <div class="mb-3">
                                      <label for="" class="form-label">Password</label>
                                      <input type="password" name="password" class="form-control" autocomplete="off" autofocus placeholder="password..">
                                    </div>

                                    <div class="mb-3">
                                      <label for="" class="form-label">Re-type Password</label>
                                      <input type="password" name="re_password" class="form-control" autocomplete="off" autofocus placeholder="re-type password..">
                                    </div>
                                  </div>

                                  <div class="col-lg-4">
                                    <div class="mb-3">
                                      <label for="" class="form-label">Phone No.</label>
                                      <input type="tel" name="phone" class="form-control" required autocomplete="off" autofocus  value="<?php echo $user_phone; ?>">
                                    </div>

                                    <div class="mb-3">
                                      <label for="" class="form-label">Address</label>
                                      <textarea name="address" class="form-control" autocomplete="off" autofocus cols="30" rows="7"><?php echo $user_address; ?></textarea>
                                    </div>

                                    
                                  </div>

                                  <div class="col-lg-4">

                                    <div class="mb-3">
                                      <!-- User Role -->
                                      <input type="hidden" value="<?php echo $role; ?>" name="role">
                                    </div>

                                    <div class="mb-3">
                                      <!-- Status -->
                                      <input type="hidden" value="1" name="status">
                                    </div>

                                    <div class="mb-3">
                                      <label for="">Image</label>
                                      <br>
                                      <?php  
                                            if (!empty($user_image)) {
                                          echo '<img src="admin/assets/images/seller/' . $user_image . '" style="width: 100%; height: 200px;">';
                                        }
                                        else {
                                          echo "Sorry! No Image Uploaded.";
                                        }
                                          ?>  
                                          <br><br>
                                      <input type="file" name="image" class="form-control">
                                    </div>

                                    <div class="d-grid gap-2">
                                      <input type="hidden" name="updateUserId" value="<?php echo $user_id; ?>">
                                      <input type="submit" name="updateUser" class="btn btn-dark btn-lg btn-block">
                                    </div>
                                  </div>
                                </div>
                              </form>

                              <?php  
                                if (isset($_POST['updateUser'])) {
                                $updateUserId   = mysqli_real_escape_string($db, $_POST['updateUserId']);
                                $fname      = mysqli_real_escape_string($db, $_POST['fname']);
                                $password     = mysqli_real_escape_string($db, $_POST['password']);
                                $re_password  = mysqli_real_escape_string($db, $_POST['re_password']);
                                $phone      = mysqli_real_escape_string($db, $_POST['phone']);
                                $address    = mysqli_real_escape_string($db, $_POST['address']);
                                $role       = mysqli_real_escape_string($db, $_POST['role']);
                                $status     = mysqli_real_escape_string($db, $_POST['status']);
                                
                                $image      = mysqli_real_escape_string($db,$_FILES['image']['name']);
                                $temp_img     = $_FILES['image']['tmp_name'];

                                // Only Password & Only Image Chnage
                                if (!empty($password) && !empty($image)) {
                                  if ($password == $re_password) {
                                    $hassedPass = sha1($password);

                                    // Delete Old Image From  Folder
                                    $oldImgSql = "SELECT * FROM users WHERE user_id='$updateUserId'";
                                    $oldImageQuery = mysqli_query($db, $oldImgSql);

                                    while ( $row = mysqli_fetch_assoc($oldImageQuery) ) {
                                      $oldImage   = $row['user_image'];
                                      unlink("admin/assets/images/seller/$img" . $oldImage);
                                    }

                                    $img = rand(0, 999999) . "_" . $image;
                                    move_uploaded_file($temp_img, 'admin/assets/images/seller/' . $img);

                                    $updateUserSql = "UPDATE users SET user_name='$fname', user_password='$hassedPass', user_phone='$phone', user_address='$address', role='$role', status='$status', user_image='$img' WHERE user_id='$updateUserId'";
                                    $upateUserQuery = mysqli_query($db, $updateUserSql);

                                    if ($upateUserQuery) {
                                      header("Location: sellerDashboard.php?do=Profile");
                                    }
                                    else {
                                      die ("Mysql Error." .mysqli_error($db) );
                                    }
                                  }
                                  else { ?>
                                    <div class="alert alert-warning text-center" role="alert">
                                      Sorry! please password and repassword use same input.
                                    </div>
                                  <?php }
                                }

                                // Not Password & Only Image Chnage
                                else if (empty($password) && !empty($image)) {

                                  // Delete Old Image From  Folder
                                    $oldImgSql = "SELECT * FROM users WHERE user_id='$updateUserId'";
                                    $oldImageQuery = mysqli_query($db, $oldImgSql);

                                    while ( $row = mysqli_fetch_assoc($oldImageQuery) ) {
                                      $oldImage   = $row['user_image'];
                                      unlink("admin/assets/images/seller/$img" . $oldImage);
                                    }

                                  $img = rand(0, 999999) . "_" . $image;
                                  move_uploaded_file($temp_img, 'admin/assets/images/seller/' . $img);

                                  $updateUserSql = "UPDATE users SET user_name='$fname', user_phone='$phone', user_address='$address', role='$role', status='$status', user_image='$img' WHERE user_id='$updateUserId'";
                                  $upateUserQuery = mysqli_query($db, $updateUserSql);

                                  if ($upateUserQuery) {
                                    header("Location: sellerDashboard.php?do=Profile");
                                  }
                                  else {
                                    die ("Mysql Error." .mysqli_error($db) );
                                  }

                                }

                                // Only Password & Not Image Chnage
                                else if (!empty($password) && empty($image)) {
                                  if ($password == $re_password) {
                                    $hassedPass = sha1($password);

                                    $updateUserSql = "UPDATE users SET user_name='$fname', user_password='$hassedPass', user_phone='$phone', user_address='$address', role='$role', status='$status' WHERE user_id='$updateUserId'";
                                    $upateUserQuery = mysqli_query($db, $updateUserSql);

                                    if ($upateUserQuery) {
                                      header("Location: sellerDashboard.php?do=Profile");
                                    }
                                    else {
                                      die ("Mysql Error." .mysqli_error($db) );
                                    }
                                  }
                                  else { ?>
                                    <div class="alert alert-warning text-center" role="alert">
                                      Sorry! please password and repassword use same input.
                                    </div>
                                  <?php }
                                }

                                // Not Password & Not Image Chnage
                                else if (empty($password) && empty($image)) {

                                  $updateUserSql = "UPDATE users SET user_name='$fname', user_phone='$phone', user_address='$address', role='$role', status='$status' WHERE user_id='$updateUserId'";
                                  $upateUserQuery = mysqli_query($db, $updateUserSql);

                                  if ($upateUserQuery) {
                                    header("Location: sellerDashboard.php?do=Profile");
                                  }
                                  else {
                                    die ("Mysql Error." .mysqli_error($db) );
                                  }

                                }

                      }
                      ?>

                              <?php


                            }

                            ?>

                                
                        </div>
                    <?php }

                    else if ( $do == "Support" ) { ?>
                        <div class="page-header pt-3" style="padding: 30px; box-shadow: 0px 1px 8px #ccc; border-radius: 10px;  margin: 0px auto;">
                          <h2 class="text-center pb-5">Support</h2>

                          <div>
                            <!-- for form -->
                            <div class="col-lg-6" style="margin: 0px auto;">
                              <div class="contact_form" style="box-shadow: 1px 10px 15px #ccc; border-top: 4px solid #08c; border-radius: 5px; color: #000; background: #F7F7F7; font-size: 16px; padding: 34px;">

                                <?php  
                                  if(isset($_SESSION['msg'])) {
                                      $message = $_SESSION['msg'];
                                      unset($_SESSION['msg']);
                                      ?>
                                      <div class="alert alert-info text-center" role="alert">
                                      <?php echo $message; ?>
                                    </div>
                                      <?php
                                      
                                  }
                                ?>

                                <form action="" method="POST" enctype="multipart/form-data">
                                  <div class="mb-3">
                                    <label for="subject">Subject of the Message</label>
                                    <input type="text" name="title" class="form-control" id="subject" aria-describedby="subject" placeholder="subject.." required autocomplete="off">
                                  </div>
                                  <div class="mb-3">
                                    <label for="message">Message</label>
                                    <textarea name="message" class="form-control" id="message.." rows="5" placeholder="message" required autocomplete="off"></textarea>
                                  </div>

                                  <?php  
                                    if (empty($_SESSION['user_id'])) {
                                      ?>
                                      <a href="login.php">Login to reserve your service</a>
                                      <?php
                                    }
                                    else { ?>

                                      <input type="hidden" name="status" value="1">
                                  <input type="hidden" name="useremail" value="<?php echo $_SESSION['email']; ?>">
                                  <input type="hidden" name="userphone" value="<?php echo $_SESSION['phone']; ?>">
                                  <input type="submit" name="addUser" class="btn btn-primary btn-lg btn-block">

                                    <?php }
                                  ?>

                                  
                                </form>

                                <?php  
                                  if (isset($_POST['addUser'])) {
                                    $title    = mysqli_real_escape_string($db, $_POST['title']);
                                    $message  = mysqli_real_escape_string($db, $_POST['message']);
                                    $status   = mysqli_real_escape_string($db, $_POST['status']);
                                    $useremail  = mysqli_real_escape_string($db, $_POST['useremail']);
                                    $userphone  = mysqli_real_escape_string($db, $_POST['userphone']);

                                    $sql = "INSERT INTO comments ( user_id, user_number, subject, comments, status, cmt_date ) VALUES('$useremail', '$userphone', '$title', '$message', '$status', now())";
                                    $query = mysqli_query( $db, $sql );

                                    if ($query) {
                                      $_SESSION['msg'] = "We Received your message. After of some times letter we will call & email you. Thank you for with us.";
                                      header("Location: sellerDashboard.php?do=Support");
                                    }
                                    else {
                                      die("Mysql Error." . mysqli_error($db));
                                    }
                                  }
                                ?>

                              </div>
                            </div>
                            <!-- for form -->
                          </div>
                        </div>
                    <?php }

                    else if ( $do == "Add" ) { ?>
                      <div class="container pb-5">
                        <div class="row">
                          <div class="col-lg-12">
                            <h4 class="text-uppercase">ADD NEW PRODUCT</h4>
                            <hr>

                            <!-- ########## START: FORM ########## -->
                            <form action="sellerDashboard.php?do=Store" method="POST" enctype="multipart/form-data" style="padding: 30px; box-shadow: 0px 1px 8px #ccc; border-radius: 10px;">
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="mb-3">
                                    <label for=""  class="form-label">Product Name</label>
                                    <input type="text" name="catName" class="form-control" placeholder="enter product name" required autocomplete="off">
                                  </div>

                                  <div class="mb-3">
                                    <label for=""  class="form-label">Price (Taka)</label>
                                    <input type="text" name="price" class="form-control" placeholder="enter price amount" required autocomplete="off">
                                  </div>

                                  <div class="mb-3">
                                    <label for=""  class="form-label">Select the Parent Category [ If Any ]</label>
                                    <select class="form-select" name="is_parent">
                                      <option value="1">Please select the parent category</option>
                                      <?php  
                                        $sql = "SELECT * FROM category WHERE is_parent=1 AND status=1 ORDER BY cat_name ASC ";
                                        $query = mysqli_query($db, $sql);

                                        while( $row = mysqli_fetch_assoc($query) ){
                                          $cat_id     = $row['cat_id'];
                                        $cat_name     = $row['cat_name'];
                                          ?>

                                          <option value="<?php echo $cat_id; ?>"><?php echo $cat_name; ?></option>

                                          <?php
                                        }
                                      ?>
                                    </select>
                                  </div>
                                  

                                  <div class="mb-3">
                                    <label for=""  class="form-label">Category Image</label>
                                    <input class="form-control" type="file" name="image" type="file">
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="mb-3">
                                    <label for="" class="form-label">Category Description</label>
                                    <textarea name="desc" class="form-control" id="" cols="30" rows="8"></textarea>
                                  </div>

                                  <div class="mb-3">
                                    <input type="hidden" value="2" name="status">
                                    <input type="hidden" name="seller_email" value="<?php echo $_SESSION['email']; ?>">
                                  </div>

                                  <div class="mb-3">
                                    <div class="d-grid gap-2">
                                      <input type="submit" name="addCategory" class="btn btn-dark btn-lg btn-block" value="Add New Product">
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>                          
                            </form>
                            <!-- ########## END: FORM ########## -->

                          </div>
                        </div>
                      </div>
                    <?php }

                    else if ( $do == "Store" ) {
                      if (isset($_POST['addCategory'])) {
                        $catName    = mysqli_real_escape_string($db, $_POST['catName']);
                        $price      = mysqli_real_escape_string($db, $_POST['price']);
                        $is_parent    = mysqli_real_escape_string($db, $_POST['is_parent']);
                        $status     = mysqli_real_escape_string($db, $_POST['status']);
                        $seller_email   = mysqli_real_escape_string($db, $_POST['seller_email']);
                        $desc       = mysqli_real_escape_string($db, $_POST['desc']);

                        
                        $image      = mysqli_real_escape_string($db,$_FILES['image']['name']);
                        $temp_img     = $_FILES['image']['tmp_name'];


                        if (!empty($image)) {
                          $img = rand(0, 999999) . "_" . $image;
                          move_uploaded_file($temp_img, 'admin/assets/images/category/' . $img);
                        }
                        else {
                          $img = '';
                        }

                        $addSql = "INSERT INTO category (cat_name, cat_desc, is_parent, status, cat_image, join_date, price, seller_email) VALUES('$catName', '$desc', '$is_parent', '$status', '$img', now(), '$price', '$seller_email')";
                        $addQuery = mysqli_query($db, $addSql);

                        if ($addQuery) {
                          header("Location: sellerDashboard.php?do=Manage");
                        }
                        else {
                          die ("Mysql Error." .mysqli_error($db) );
                        }

                      }

                    }

                    else if ( $do == "Edit" ) { 
                      if (isset($_GET['uId'])) {
                        $upId = $_GET['uId'];
                        $upReadSql = "SELECT * FROM category WHERE cat_id='$upId'";
                        $upReadQuery = mysqli_query($db, $upReadSql);

                        while ( $row = mysqli_fetch_assoc($upReadQuery) ) {
                          $cat_id     = $row['cat_id'];
                            $cat_name     = $row['cat_name'];
                            $cat_desc     = $row['cat_desc'];
                            $is_parent    = $row['is_parent'];
                            $status     = $row['status'];
                            $join_date    = $row['join_date'];
                            $cat_image    = $row['cat_image'];
                            $price      = $row['price'];
                            $seller_email   = $row['seller_email'];
                            ?>
                              <div class="container pb-5">
                              <div class="row">
                                <div class="col-lg-12">
                                  <h4 class="text-uppercase">UPDATE PRODUCT</h4>
                                  <hr>

                                  <!-- ########## START: FORM ########## -->
                                  <form action="sellerDashboard.php?do=Update" method="POST" enctype="multipart/form-data" style="padding: 30px; box-shadow: 0px 1px 8px #ccc; border-radius: 10px;">
                                    <div class="row">
                                      <div class="col-lg-6">
                                        <div class="mb-3">
                                          <label for="" class="form-label">Product Name</label>
                                          <input type="text" name="catName" class="form-control" placeholder="enter product name" required autocomplete="off" value="<?php echo $cat_name; ?>">
                                        </div>

                                        <div class="mb-3">
                                          <label for="" class="form-label">Price (Taka)</label>
                                          <input type="text" name="price" class="form-control" placeholder="enter price amount" required autocomplete="off" value="<?php echo $price; ?>">
                                        </div>

                                        <div class="mb-3">
                                          <label for="" class="form-label">Select the Parent Category [ If Any ]</label>
                                          <select class="form-control" name="is_parent">
                                            <option value="1">Please select the parent category</option>
                                            <?php  
                                              $p_sql = "SELECT * FROM category WHERE is_parent=1  ORDER BY cat_name ASC ";
                                              $p_query = mysqli_query($db, $p_sql);

                                              while( $row = mysqli_fetch_assoc($p_query) ){
                                                $p_cat_id     = $row['cat_id'];
                                              $p_cat_name   = $row['cat_name'];
                                              ?>

                                              <option value="<?php echo $p_cat_id; ?>" <?php if( $p_cat_id == $is_parent ){ echo "selected"; } ?> ><?php echo $p_cat_name; ?></option>

                                              <?php
                                              }
                                            ?>
                                          </select>
                                        </div>
                                        

                                        <div class="mb-3">
                                          <label for="" class="form-label">Category Image</label>
                                          <br><br>

                                          <?php  
                                                if (!empty($cat_image)) {
                                              echo '<img src="admin/assets/images/category/' . $cat_image . '" style="width: 100%; height: 200px;">';
                                            }
                                            else {
                                              echo 'No Image Found';
                                            }
                                              ?>
                                              <br><br>
                                          <input class="form-control" type="file" name="image" type="file">
                                        </div>
                                      </div>
                                      <div class="col-lg-6">
                                        <div class="mb-3">
                                          <label for="" class="form-label">Category Description</label>
                                          <textarea name="desc" class="form-control" id="" cols="30" rows="8"><?php echo $cat_desc; ?></textarea>
                                        </div>

                                        <div class="mb-3">
                                          <label for="" class="form-label">Status Update</label>
                                          <select class="form-select" aria-label="Default select example" name="status">
                                            <option selected>Please Select The Status</option>
                                            <option value="1" <?php if ($status == 2)  { echo "selected"; } ?>>Active</option>
                                            <option value="0" <?php if ($status == 0)  { echo "selected"; } ?>>InActive</option>
                                          </select>
                                        </div>

                                        <div class="mb-3">
                                          <input type="hidden" value="2" name="status">
                                          <input type="hidden" name="seller_email" value="<?php echo $_SESSION['email']; ?>">
                                        </div>

                                        <div class="mb-3">
                                          <div class="d-grid gap-2">
                                            <input type="hidden" name="updateCategoryId" value="<?php echo $cat_id; ?>">
                                            <?php  
                                              if ( $status != 0 ) { ?>
                                                <input type="submit" name="updateCategory" class="btn btn-dark btn-lg btn-block" value="Update Product">
                                              <?php }
                                              else { ?>
                                                <input type="submit" name="updateCategory" class="btn btn-dark btn-lg btn-block" value="Return Product">
                                              <?php }
                                            ?>
                                            
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </div>                          
                                  </form>
                                  <!-- ########## END: FORM ########## -->

                                </div>
                              </div>
                            </div>
                            <?php
                        }
                      }
                      
                    }

                    else if ( $do == "Update" ) {
                      if (isset($_POST['updateCategory'])) {
                        $updateCategoryId   = mysqli_real_escape_string($db, $_POST['updateCategoryId']);
                        $catName      = mysqli_real_escape_string($db, $_POST['catName']);
                        $is_parent      = mysqli_real_escape_string($db, $_POST['is_parent']);
                        $status       = mysqli_real_escape_string($db, $_POST['status']);
                        $desc         = mysqli_real_escape_string($db, $_POST['desc']);
                        $price        = mysqli_real_escape_string($db, $_POST['price']);
                        $seller_email     = mysqli_real_escape_string($db, $_POST['seller_email']);
                        
                        $image        = mysqli_real_escape_string($db,$_FILES['image']['name']);
                        $temp_img       = $_FILES['image']['tmp_name'];

                        if (!empty($image)) {
                          $oldImageSql = "SELECT * FROM category WHERE cat_id='$updateCategoryId'";
                          $oldImgQuery = mysqli_query( $db, $oldImageSql );

                          while( $row = mysqli_fetch_assoc($oldImgQuery) ) {
                            $oldcat_image = $row['cat_image'];
                            unlink( "admin/assets/images/category/$img" . $oldcat_image );            
                          }

                          $img = rand(0, 999999) . "_" . $image;
                          move_uploaded_file($temp_img, 'admin/assets/images/category/' . $img);

                          $upSql = "UPDATE category SET cat_name='$catName', cat_desc='$desc', is_parent='$is_parent', status='$status', cat_image='$img', price='$price', seller_email='$seller_email' WHERE cat_id='$updateCategoryId' ";
                
                          $updateQuery = mysqli_query($db, $upSql);

                          if ($updateQuery) {
                            header("Location: sellerDashboard.php?do=Manage");
                          }
                          else {
                            die ("Mysql Error." .mysqli_error($db) );
                          }

                        }
                        else if (empty($image)){

                          $upSql = "UPDATE category SET cat_name='$catName', cat_desc='$desc', is_parent='$is_parent', status='$status', price='$price', seller_email='$seller_email' WHERE cat_id='$updateCategoryId' ";
                          $updateQuery = mysqli_query($db, $upSql);

                          if ($updateQuery) {
                            header("Location: sellerDashboard.php?do=Manage");
                          }
                          else {
                            die ("Mysql Error." .mysqli_error($db) );
                          }
                        }

                        
                      }
                    }

                    else if ( $do == "Trash" ) {
                      if (isset($_GET['tId'])) {
                        $trushId = $_GET['tId'];
                        $trushSql = "UPDATE category SET status=0 WHERE cat_id='$trushId'";
                        $trushQuery = mysqli_query( $db, $trushSql );

                        if ($trushQuery) {
                          header("Location: sellerDashboard.php?do=Manage");
                        }
                        else {
                          die("mysql error" . mysqli_error($db));
                        }

                      }
                    }

                    else if ( $do == "ManageTrash" ) { ?>
                      <div class="container pb-5">
                        <div class="row">
                          <div class="col-lg-12">
                            <h4 class="text-uppercase">Trash Manage All Products</h4>

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                              <a href="sellerDashboard.php?do=Add" class="btn btn-dark">Add New Product</a>
                              <a href="sellerDashboard.php?do=Manage" class="btn btn-dark">All Products</a>
                            </div>
                            <hr>

                            <!-- START: TABLE -->
                            <div class="table-responsive" style="padding: 30px; box-shadow: 0px 1px 8px #ccc; border-radius: 10px;">
                              <table id="example" class="table table-striped table-hover table-bordered">
                                <thead class="thead-dark">
                                  <tr>
                                    <th scope="col">#Sl.</th>
                                    <th scope="col">Product Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price (Taka)</th>
                                    <th scope="col">Category Name</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Join Date</th>
                                    <th scope="col">Action</th>
                                  </tr>
                                </thead>

                                <tbody>
                                  <?php  
                                    if (!empty($_SESSION['email'])) {
                                      $sellerId = $_SESSION['email'];

                                      $sellerReadSql = "SELECT * FROM category WHERE status=0 AND seller_email='$sellerId' ORDER BY cat_name ASC";
                                      $sellerReadQuery = mysqli_query( $db, $sellerReadSql );
                                      $sellerCount = mysqli_num_rows($sellerReadQuery);

                                      if ( $sellerCount == 0 ) { ?>
                                        <div class="alert alert-info text-center" role="alert">
                                        Sorry! No Product Found!.
                                      </div>
                                      <?php }

                                      else {
                                        $i = 0;

                                        while ($row = mysqli_fetch_assoc($sellerReadQuery)) {
                                          $cat_id     = $row['cat_id'];
                                          $cat_name     = $row['cat_name'];
                                          $cat_desc     = $row['cat_desc'];
                                          $is_parent    = $row['is_parent'];
                                          $status     = $row['status'];
                                          $join_date    = $row['join_date'];
                                          $cat_image    = $row['cat_image'];        
                                          $price      = $row['price'];        
                                          $seller_name  = $row['seller_name'];        
                                          $seller_email   = $row['seller_email'];       
                                          $i++;
                                          ?>

                                          <tr>
                                            <th scope="row" class="text-center"><?php echo $i; ?></th>
                                            <td class="text-center">
                                              <?php  
                                                if (!empty($cat_image)) {
                                              echo '<img src="admin/assets/images/category/' . $cat_image . '" style="width: 60px";>';
                                            }
                                            else {
                                              echo '<img src="admin/assets/images/category/default.jpg" style="width: 60px";>';
                                            }
                                              ?>
                                            </td>
                                            <td class="text-center"><?php echo $cat_name; ?></td>
                                            <td class="text-center"><?php echo $price; ?> Taka</td>
                                            <td class="text-center">
                                          <?php  
                                                $readCat_Sql = "SELECT * FROM category WHERE cat_id='$is_parent'";
                                                $readCat_Quary = mysqli_query($db, $readCat_Sql);

                                                while( $row = mysqli_fetch_assoc($readCat_Quary) ){
                                                  $cc_id   = $row['cat_id'];
                                                  $cc_name = $row['cat_name'];
                                                  ?>
                                                  <span class="badge text-bg-secondary"><?php echo "$cc_name"; ?></span>
                                                  <?php

                                                  
                                                }

                                              ?>
                                        </td>
                                            <td class="text-center">
                                              <?php  
                                                if ($status == 1) { ?>
                                                  <span class="badge text-bg-success">ACTIVE</span>
                                                <?php }
                                                else if ($status == 0) { ?>
                                                  <span class="badge text-bg-danger">INACTIVE</span>
                                                <?php }
                                                else if ($status == 2) { ?>
                                                  <span class="badge text-bg-warning">PENDING</span>
                                                <?php }
                                              ?>
                                            </td>
                                            <td class="text-center"><?php echo $join_date; ?></td>
                                            <td>
                                            <div class="action-btn">
                                              <ul>
                                                  <li>
                                                    <a href="sellerDashboard.php?do=Edit&uId=<?php echo $cat_id; ?>"><i class="fa-regular fa-pen-to-square edit"></i></a>
                                                  </li>
                                                  <li>
                                                    <a href=""  data-bs-toggle="modal" data-bs-target="#uId<?php echo $cat_id; ?>"><i class="fa-regular fa-trash-can trush"></i></a>
                                                  </li>
                                              </ul>
                                            </div>

                                            <!-- Modal Start -->
                                            <div class="modal fade" id="uId<?php echo $cat_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                              <div class="modal-dialog">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h3 class="modal-title" id="exampleModalLabel">Are You Sure?? To Delete <i class="fa-regular fa-face-frown"></i><br> <span style="color: green;"><?php echo $cat_name; ?></span></h3>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <div class="modal-btn">
                                                      <a href="sellerDashboard.php?do=Delete&DId=<?php echo $cat_id; ?>"class="btn btn-danger me-3">Delete</a>
                                                      <a href="" class="btn btn-success" data-bs-dismiss="modal">Close</a>
                                                    </div>
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            <!-- Modal End -->
                                           </td>
                                          </tr>

                                          <?php
                                        }
                                      }






                                      
                                    }
                                  ?>
                                  
                                </tbody>
                              </table>
                            </div>
                            <!-- END: TABLE -->

                          </div>
                        </div>
                      </div>
                    <?php }

                    else if ( $do == "Delete" ) {
                      if (isset($_GET['DId'])) {
                        $deleteId = $_GET['DId'];
                        $deleteSql = "DELETE FROM category WHERE cat_id='$deleteId' ";
                        $deleteQuery = mysqli_query($db, $deleteSql);

                        if ($deleteQuery) {
                          header("Location: sellerDashboard.php?do=Manage");
                        }
                        else {
                          die("Mysql Error." . mysqli_error($db));
                        }
                      }
                    }

                  ?>

                 
                  
                </div>
                
            </main>
        </div>
    </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.4/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.5/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.5/js/buttons.dataTables.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.2.5/js/buttons.print.min.js"></script>

    <script>
      new DataTable('#example', {
          layout: {
              topStart: {
                  buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
              }
          }
      });
    </script>



    <?php  
      ob_end_flush();
    ?>
  </body>
</html>