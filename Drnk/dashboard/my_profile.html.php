<?php
function booleanToYesNo($bool) {
	$convertedString = $bool ? "Yes" : "No";
	return $convertedString;
}
?>
<div class="page-wrapper my_profile_wrapper">
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-md-8 col-md-offset-2">
	        	<form style="padding: 10px; margin-top: 20px;">
					<div class="panel panel-primary">
						<div class="panel-heading">
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-12">
										<h2 class="text-center">DRNK Account Info</h2>
										<?php if ($user->isAdmin()) { ?>
						        					<strong><p class="text-center">(Admin Account)</p></strong>
										<?php } ?>
									</div>
								</div>
							</div>
						</div>
						<hr>
						<div class="panel-body">
							<div class="form-group">
								<div class="row">
			        				<div class="col-md-12">
			        					
			        					<div class="form-group">
				        					<label for="email">Email Address</label>
											<input class="form-control" type="email" id="email" name="email" value="<?php echo $user->getEmail(); ?>" readonly>
										</div>
										<div class="form-group">
				        					<label for="password">Password</label>
											<input class="form-control" type="text" id="password" name="password" value="" readonly>
										</div>
<!--										<div class="form-group">-->
<!--				        					<strong><p>Business Verified: --><?php //echo booleanToYesNo((bool)$user->isBusinessVerified()); ?><!--</p></strong>-->
<!--										</div>-->
<!--										<div class="form-group">-->
<!--				        					<strong><p>-->
<!--				        						--><?php //
//				        						$yesNoIsAccountActive = booleanToYesNo((bool)$user->isAccountActive()) ;
//				        							  if ((bool)$user->isAccountActive()) { ?>
<!--				        								Account Active: --><?//= $yesNoIsAccountActive ?>
<!--				        						--><?php //} else { ?>
<!--				        								Account Active: --><?//= $yesNoIsAccountActive ?><!-- -->
<!--				           						--><?php //} ?>
<!--				        						-->
<!--				        					</p></strong>-->
<!--										</div>-->
<!--										<div class="form-group">-->
<!--				        					<strong>-->
<!--				        					--><?php //if ((bool) $user->isAccountActive() && (bool) $user->isBusinessVerified()) { ?>
<!--				        								<p class="text-success">Congratulations! Your business has been approved and customers can now see your business on the DRNK App!</p>-->
<!--				        					--><?php //} else { ?>
<!--				        								<p><span class="text-danger">Your business is not listed on DRNK.</span> (Why?)</p>-->
<!--				        					--><?php //} ?>
<!--				        					</strong>-->
<!--										</div>-->
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>