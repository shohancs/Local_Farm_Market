<?php 
	include "inc/header.php";
?>

			<div role="main" class="main">

				<!-- ########## START: TOP HEADING ########## -->
		<section class="page-header page-header-modern bg-color-light-scale-1 page-header-md"
		style="background-image: linear-gradient(to left, rgba(0,0,0,0.4), rgba(0,0,0,0.4)) ,url(assets/images/breadcrumb.jpg);
					background-repeat: no-repeat;
					background-size: cover;
					background-position: center;
					
					">
			<div class="container">
				<div class="row">
					<div class="col-md-12 align-self-center p-static order-2 text-center">

						<h1 class="text-white font-weight-bold text-8">Blog Pages</h1>
					</div>

					<div class="col-md-12 align-self-center order-1">

						<ul class="breadcrumb d-block text-center" >
							<li><a href="index.php" class="text-white">HOME</a></li>
							<li class="active text-white" >BLOG Pages</li>
						</ul>
					</div>					
				</div>
			</div>
		</section>
		<!-- ########## END: TOP HEADING ########## -->

				<div class="container py-5 ">

					<div class="row pb-4">
						<div class="col-lg-3 order-lg-2">
							<?php include"inc/sidebar.php"; ?>
						</div>
						<div class="col-lg-9 order-lg-1">
							<div class="row">
							<?php  
								$sql = "SELECT * FROM post WHERE status=1 ORDER BY post_id DESC LIMIT 3";
								$postData = mysqli_query($db, $sql);

								while( $row = mysqli_fetch_assoc($postData) ) {
									$post_id 		= $row['post_id'];
									$title 			= $row['title'];
									$post_desc 		= $row['post_desc'];
									$image 			= $row['image'];
									$category_id 	= $row['category_id'];
									$author_id 		= $row['author_id'];
									$tags 			= $row['tags'];
									$status 		= $row['status'];
									$post_date 		= $row['post_date'];
									?>

									<div class="col-md-4 col-lg-4 mb-5 mb-lg-0 appear-animation animated fadeInUpShorter appear-animation-visible" data-appear-animation="fadeInUpShorter" data-appear-animation-delay="200" style="animation-delay: 200ms;">

									<div class="card blog_card">
										<a href="details.php?dId=<?php echo $post_id; ?>">
											<?php 
												if (!empty($image)) {
													echo '<img src="admin/assets/images/posts/' . $image . '" class="img-fluid img-thumbnail img-thumbnail-no-borders " alt="'. $title .'">';
												}
											?>
											
										</a>
										<div class="card-body" style="padding: 10px;">
											<div class="d-flex align-items-center justify-content-between">
												<div class="post-date" style="margin-top: -10px;    font-size: 10px; background: antiquewhite; padding: 3px; color: #000;">
													<!-- <span class="day">10</span> -->
													<span class="month"><?php echo $post_date; ?></span>
												</div>

												<div style="font-size: 11px;text-align: right;color: #000;text-decoration: none;"><i class="far fa-user"></i><a href="" style="color: #000; text-decoration: none;">
														<?php  
												      		$readUser_Sql = "SELECT * FROM users WHERE user_id='$author_id'";
												      		$readUser_Quary = mysqli_query($db, $readUser_Sql);

												      		while( $row = mysqli_fetch_assoc($readUser_Quary) ){
												      			$auth_id 	 = $row['user_id'];
												      			$auth_name = $row['user_name'];

												      			echo $auth_name;
												      		}

												      	?>
													</a> 
												</div>

											</div>
											<h4 class="card-title mb-1 font-weight-bold" style="font-size: 22px;padding: 7px 0px;text-align: left;"><a href="blog_details.php?dId=<?php echo $post_id; ?>" style="color: #000; text-decoration: none;"><?php echo $title; ?></a></h4>
											<p class="card-text"><?php echo substr($post_desc, 0, 50) ?>... <a href="blog_details.php?dId=<?php echo $post_id; ?>">Read More</a></p>

											<div class="d-flex align-items-center justify-content-between">
												<div style="font-size: 13px;color: #000; text-decoration: none;"><i class="far fa-comments"></i> <a href="#">0</a></div>

												<div style="font-size: 13px; color: #000;"><i class="far fa-folder"></i> <a href="" style="font-size: 13px; color: #000; text-decoration: none;">
													<?php  
											      		$readCat_Sql = "SELECT * FROM category WHERE cat_id='$category_id'";
											      		$readCat_Quary = mysqli_query($db, $readCat_Sql);

											      		while( $row = mysqli_fetch_assoc($readCat_Quary) ){
											      			$cc_id 	 = $row['cat_id'];
											      			$cc_name = $row['cat_name'];

											      			?>
											      			<a href="details.php?do=Manage&did=<?php echo $cc_id; ?>"><?php echo $cc_name; ?></a>
											      			<?php
											      		}

												      	?>
													</a> 
												</div>
											</div>

										</div>
									</div>
								</div>
									<?php
								}
							?>
						</div>
						</div>
					</div>

				</div>

			</div>

<?php include "inc/footer.php"; ?>