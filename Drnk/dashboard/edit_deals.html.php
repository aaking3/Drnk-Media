<?php
	require_once "../autoloader.php";
	require "../session.php";
    require "../refresh_user.php";
    require "../login_check.php";

    $user = $_SESSION['user'];
	$dealTracker = new DealTracker($user);
	$businessType = strtolower($user->getBusinessType());
	if ($businessType == "bar") {
		$day = isset($_GET['day']) ? $_GET['day'] : "Sunday";	
	} else {
		$day = "Everyday";
	}


	$status = isset($_GET['status']) ? $_GET['status'] : false;
	$errorMessage = isset($_GET['error_message']) ? $_GET['error_message'] : false;

	$deals = $dealTracker->getDealsByDay($day);
	$deal1 = isset($deals[0]) ? $deals[0] : null;
	$deal2 = isset($deals[1]) ? $deals[1] : null;
	$deal3 = isset($deals[2]) ? $deals[2] : null;
	$deal4 = isset($deals[3]) ? $deals[3] : null;
	$deal5 = isset($deals[4]) ? $deals[4] : null;
	if (strtolower($businessType) == "liquor store") {
		$deal6 = isset($deals[5]) ? $deals[5] : null;
		$deal7 = isset($deals[6]) ? $deals[6] : null;
		$deal8 = isset($deals[7]) ? $deals[7] : null;
		$deal9 = isset($deals[8]) ? $deals[8] : null;
		$deal10 = isset($deals[9]) ? $deals[9] : null;
	}

	$deal1Name = !is_null($deal1) ? $deal1->getDealName() : "";
	$deal1Price = !is_null($deal1) ? $deal1->getPrice() : "";
	$deal1Featured = !is_null($deal1) && $deal1->getFeatured() == 1 ? "Checked" : "";

	$deal2Name = !is_null($deal2) ? $deal2->getDealName() : "";
	$deal2Price = !is_null($deal2) ? $deal2->getPrice() : "";
	$deal2Featured = !is_null($deal2) && $deal2->getFeatured() == 1 ? "Checked" : "";

	$deal3Name = !is_null($deal3) ? $deal3->getDealName() : "";
	$deal3Price = !is_null($deal3) ? $deal3->getPrice() : "";
	$deal3Featured = !is_null($deal3) && $deal3->getFeatured() == 1 ? "Checked" : "";

	$deal4Name = !is_null($deal4) ? $deal4->getDealName() : "";
	$deal4Price = !is_null($deal4) ? $deal4->getPrice() : "";
	$deal4Featured = !is_null($deal4) && $deal4->getFeatured() == 1 ? "Checked" : "";

	$deal5Name = !is_null($deal5) ? $deal5->getDealName() : "";
	$deal5Price = !is_null($deal5) ? $deal5->getPrice() : "";
	$deal5Featured = !is_null($deal5) && $deal5->getFeatured() == 1 ? "Checked" : "";

	if (strtolower($businessType) == "liquor store") {
		$deal6Name = !is_null($deal6) ? $deal6->getDealName() : "";
		$deal6Price = !is_null($deal6) ? $deal6->getPrice() : "";
		$deal6Featured = !is_null($deal6) && $deal6->getFeatured() == 1 ? "Checked" : "";

		$deal7Name = !is_null($deal7) ? $deal7->getDealName() : "";
		$deal7Price = !is_null($deal7) ? $deal7->getPrice() : "";
		$deal7Featured = !is_null($deal7) && $deal7->getFeatured() == 1 ? "Checked" : "";

		$deal8Name = !is_null($deal8) ? $deal8->getDealName() : "";
		$deal8Price = !is_null($deal8) ? $deal8->getPrice() : "";
		$deal8Featured = !is_null($deal8) && $deal8->getFeatured() == 1 ? "Checked" : "";

		$deal9Name = !is_null($deal9) ? $deal9->getDealName() : "";
		$deal9Price = !is_null($deal9) ? $deal9->getPrice() : "";
		$deal9Featured = !is_null($deal9) && $deal9->getFeatured() == 1 ? "Checked" : "";

		$deal10Name = !is_null($deal10) ? $deal10->getDealName() : "";
		$deal10Price = !is_null($deal10) ? $deal10->getPrice() : "";
		$deal10Featured = !is_null($deal10) && $deal10->getFeatured() == 1 ? "Checked" : "";
	}
?>
<div class="page-wrapper edit_deals_wrapper">
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
				<form method="POST" action="submit_deals.php" style="margin-top: 20px;">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-12">
										<h2 class="text-center">DRNK Deal Manager</h2>
									</div>
								</div>
							</div>
						</div>
						<div class="panel-body">
							
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-12">
										<h1 class="lead" style="text-align: center;">Enter your deals. These deals will appear in the DRNK App.</h1>
									</div>
								</div>
							</div>
							
							<div class="form-group text-bold">
								<?php
								if ($businessType == "bar") {
									$sundayActive = $day == "Sunday" ? "class='active'" : "";
									$mondayActive = $day == "Monday" ? "class='active'" : "";
									$tuesdayActive = $day == "Tuesday" ? "class='active'" : "";
									$wednesdayActive = $day == "Wednesday" ? "class='active'" : "";
									$thursdayActive = $day == "Thursday" ? "class='active'" : "";
									$fridayActive = $day == "Friday" ? "class='active'" : "";
									$saturdayActive = $day == "Saturday" ? "class='active'" : "";

									echo '<ul class="nav nav-tabs">
											<li role="presentation"' . $sundayActive . '><a href="?page=edit_deals&day=Sunday">Sunday</a></li>
											<li role="presentation"' . $mondayActive . '><a href="?page=edit_deals&day=Monday">Monday</a></li>
											<li role="presentation"' . $tuesdayActive . '><a href="?page=edit_deals&day=Tuesday">Tuesday</a></li>
											<li role="presentation"' . $wednesdayActive . '><a href="?page=edit_deals&day=Wednesday">Wednesday</a></li>
											<li role="presentation"' . $thursdayActive . '><a href="?page=edit_deals&day=Thursday">Thursday</a></li>
											<li role="presentation"' . $fridayActive . '><a href="?page=edit_deals&day=Friday">Friday</a></li>
											<li role="presentation"' . $saturdayActive . '><a href="?page=edit_deals&day=Saturday">Saturday</a></li>
										</ul>';
								} else {
									?>  <ul class="nav nav-tabs">
											<li role="presentation" <?= $day == "Everyday" ? "class=\'active\'" : ""; ?>><a href="?page=edit_deals&day=Everyday">Everyday Deals</a></li>
										</ul>
									<?php
								}
								?>
								
								<input type="hidden" value="<?= $day ?>" name="day">
							</div>
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-7">
										<input class="form-control" type="text" id="deal-1" name="deal-1" placeholder="Enter the name of your deal." value="<?php echo $deal1Name?>">
									</div>
									<div class="col-md-3">
										<div class="input-group">
											<div class="input-group-addon">$</div>
			      							<input type="text" class="form-control" name="price-1" id="price-1" placeholder="Price" value="<?php echo $deal1Price; ?>">
		      							</div>
									</div>
									<div class="col-md-2">
										<label for="featured-1">Featured?</label>
										<input type="checkbox" value="featured-1" name="featured-1" <?php echo $deal1Featured;?> >
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-7">
										<input class="form-control" type="text" id="deal-2" name="deal-2" placeholder="Enter the name of your deal." value="<?php echo $deal2Name; ?>">
									</div>
									<div class="col-md-3">
										<div class="input-group">
											<div class="input-group-addon">$</div>
			      							<input type="text" class="form-control" name="price-2" id="price-2" placeholder="Price" value="<?php echo $deal2Price; ?>">
		      							</div>
									</div>
									<div class="col-md-2">
										<label for="featured-2">Featured?</label>
										<input type="checkbox" value="featured-2" name="featured-2" <?php echo $deal2Featured; ?> >
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-7">
										<input class="form-control" type="text" id="deal-3" name="deal-3" placeholder="Enter the name of your deal." value="<?php echo $deal3Name; ?>">
									</div>
									<div class="col-md-3">
										<div class="input-group">
											<div class="input-group-addon">$</div>
			      							<input type="text" class="form-control" name="price-3" id="price-3" placeholder="Price" value="<?php echo $deal3Price; ?>">
		      							</div>
									</div>
									<div class="col-md-2">
										<label for="featured-3">Featured?</label>
										<input type="checkbox" value="featured-3" name="featured-3" <?php echo $deal3Featured; ?> >
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-7">
										<input class="form-control" type="text" id="deal-4" name="deal-4" placeholder="Enter the name of your deal." value="<?php echo $deal4Name; ?>">
									</div>
									<div class="col-md-3">
										<div class="input-group">
											<div class="input-group-addon">$</div>
			      							<input type="text" class="form-control" name="price-4" id="price-4" placeholder="Price" value="<?php echo $deal4Price; ?>">
		      							</div>
									</div>
									<div class="col-md-2">
										<label for="featured-4">Featured?</label>
										<input type="checkbox" value="featured-4" name="featured-4" <?php echo $deal4Featured; ?> >
									</div>
								</div>
							</div>
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-7">
										<input class="form-control" type="text" id="deal-5" name="deal-5" placeholder="Enter the name of your deal." value="<?php echo $deal5Name; ?>">
									</div>
									<div class="col-md-3">
										<div class="input-group">
											<div class="input-group-addon">$</div>
			      							<input type="text" class="form-control" name="price-5" id="price-5" placeholder="Price" value="<?php echo $deal5Price; ?>">
		      							</div>
									</div>
									<div class="col-md-2">
										<label for="featured-5">Featured?</label>
										<input type="checkbox" value="featured-5" name="featured-5" <?php echo $deal5Featured; ?> >
									</div>
								</div>
							</div>
							<?php if (strtolower($businessType) == "liquor store") { ?>
									<div class="form-group">
										<div class="row">
					        				<div class="col-md-7">
												<input class="form-control" type="text" id="deal-6" name="deal-6" placeholder="Enter the name of your deal." value="<?php echo $deal6Name; ?>">
											</div>
											<div class="col-md-3">
												<div class="input-group">
													<div class="input-group-addon">$</div>
					      							<input type="text" class="form-control" name="price-6" id="price-6" placeholder="Price" value="<?php echo $deal6Price; ?>">
				      							</div>
											</div>
											<div class="col-md-2">
												<label for="featured-6">Featured?</label>
												<input type="checkbox" value="featured-6" name="featured-6" <?php echo $deal6Featured; ?> >
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
					        				<div class="col-md-7">
												<input class="form-control" type="text" id="deal-7" name="deal-7" placeholder="Enter the name of your deal." value="<?php echo $deal7Name; ?>">
											</div>
											<div class="col-md-3">
												<div class="input-group">
													<div class="input-group-addon">$</div>
					      							<input type="text" class="form-control" name="price-7" id="price-7" placeholder="Price" value="<?php echo $deal7Price; ?>">
				      							</div>
											</div>
											<div class="col-md-2">
												<label for="featured-7">Featured?</label>
												<input type="checkbox" value="featured-7" name="featured-7" <?php echo $deal7Featured; ?> >
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
					        				<div class="col-md-7">
												<input class="form-control" type="text" id="deal-8" name="deal-8" placeholder="Enter the name of your deal." value="<?php echo $deal8Name; ?>">
											</div>
											<div class="col-md-3">
												<div class="input-group">
													<div class="input-group-addon">$</div>
					      							<input type="text" class="form-control" name="price-8" id="price-8" placeholder="Price" value="<?php echo $deal8Price; ?>">
				      							</div>
											</div>
											<div class="col-md-2">
												<label for="featured-8">Featured?</label>
												<input type="checkbox" value="featured-8" name="featured-8" <?php echo $deal8Featured; ?> >
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
					        				<div class="col-md-7">
												<input class="form-control" type="text" id="deal-9" name="deal-9" placeholder="Enter the name of your deal." value="<?php echo $deal9Name; ?>">
											</div>
											<div class="col-md-3">
												<div class="input-group">
													<div class="input-group-addon">$</div>
					      							<input type="text" class="form-control" name="price-9" id="price-9" placeholder="Price" value="<?php echo $deal9Price; ?>">
				      							</div>
											</div>
											<div class="col-md-2">
												<label for="featured-9">Featured?</label>
												<input type="checkbox" value="featured-9" name="featured-9" <?php echo $deal9Featured; ?> >
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
					        				<div class="col-md-7">
												<input class="form-control" type="text" id="deal-10" name="deal-10" placeholder="Enter the name of your deal." value="<?php echo $deal10Name; ?>">
											</div>
											<div class="col-md-3">
												<div class="input-group">
													<div class="input-group-addon">$</div>
					      							<input type="text" class="form-control" name="price-10" id="price-10" placeholder="Price" value="<?php echo $deal10Price; ?>">
				      							</div>
											</div>
											<div class="col-md-2">
												<label for="featured-10">Featured?</label>
												<input type="checkbox" value="featured-10" name="featured-10" <?php echo $deal10Featured; ?> >
											</div>
										</div>
									</div>
								<?php } ?>
								<div class="form-group">
									<input class="btn btn-lg btn-primary btn-block text-bold submit-button" type="submit" value="Save Deals">
								</div>
								<div class="form-group">
								<?php if ($status == "success") {?>
											<div class="alert alert-success fade in">
				    							<a href="#" class="close" data-dismiss="alert">&times;</a>
				    							<p class="text-center text-success"><strong>Success!</strong> Your deals were saved.</p>
				    						</div>
			    				<?php } elseif ($status == "failure") { ?>
										
										<div class="alert alert-danger fade in">
			    							<a href="#" class="close" data-dismiss="alert">&times;</a>
			    							<p class="text-center text-danger"><strong>Oops! Deals could not be saved.</strong></p>
			    							<p class="text-center text-danger"> Error message: <?= $errorMessage ? $errorMessage : "Something went wrong."; ?></p>
			    						</div>
								<?php }	?>

							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>