<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php

	if(isset($_POST['apply']))
	{
        
		$old=$_POST['old'];
        $new=$_POST['new'];
        $conform=$_POST['conform'];
        $enold=md5($old);
        $sql="SELECT Password from tblemployees where emp_id='$session_id'";
$query = mysqli_query($conn, $sql) or die(mysqli_error());
$result= mysqli_fetch_array($query);
$pass=$result['Password'];
        if($new!=$conform)
        {
            echo "<script>alert('conform password should me same!!');</script>";
        }
        elseif($old==$new)
        {
            echo "<script>alert('Your new password cannot be your new password');</script>";
        }
        elseif($enold!=$pass)
        {
            echo "<script>alert('wrong password!!');</script>";

        }
        else
        {
            $ennew=md5($new);
            $result = mysqli_query($conn,"update tblemployees set password='$ennew' where emp_id='$session_id'");
            if ($result) {
                echo "<script>alert('password changed');</script>";
               } else{
                 die(mysqli_error());
              }

        }


}
?>

<body>
	<div class="pre-loader">
		<div class="pre-loader-box">
			<div class="loader-logo"><img src="../vendors/images/images-removebg-preview.png" alt=""></div>
			<div class='loader-progress' id="progress_div">
				<div class='bar' id='bar1'></div>
			</div>
			<div class='percent' id='percent1'>0%</div>
			<div class="loading-text">
				Loading...
			</div>
		</div>
	</div>

	<?php include('includes/navbar.php')?>

	<?php include('includes/right_sidebar.php')?>

	<?php include('includes/left_sidebar.php')?>

	<div class="mobile-menu-overlay"></div>

	<div class="mobile-menu-overlay"></div>

	<div class="main-container">
		<div class="pb-20">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Password Reset</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">change Password</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">change password</h4>
							<p class="mb-20"></p>
						</div>
					</div>
					<div class="wizard-content">
						<form method="post" action="" enctype="multipart/form-data">
							<section>

                            <div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label>Old Password</label>
											<input name="old" type="password" class="form-control" required="true" autocomplete="off">
										</div>
									</div>
                                </div>
                                <div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label>New Password</label>
											<input name="new" type="password" class="form-control" required="true" autocomplete="off" >
										</div>
									</div>
                                </div>
                                <div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label>Confirm New Password</label>
											<input name="conform" type="password" class="form-control" required="true" autocomplete="off" >
										</div>
									</div>
                                </div>
								<div class="row">

									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label style="font-size:16px;"><b></b></label>
											<div class="modal-footer justify-content-center">
												<button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Confirm</button>
											</div>
										</div>
									</div>
								</div>
								
							</section>
						</form>
					</div>
				</div>

			</div>
			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->
	<?php include('includes/scripts.php')?>
</body>
</html>