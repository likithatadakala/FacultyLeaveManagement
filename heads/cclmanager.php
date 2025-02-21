<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php
if(isset($_POST['apply'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
	$role="Staff";
	$today=date('d-m-Y');
	$department=$_POST['department'];
	$holiday=$_POST['holiday'];
	$working=$_POST['working'];
	$date=$_POST['date'];
	$sql="SELECT ccldate from cclmanager where department='$department'";
$query = mysqli_query($conn, $sql) or die(mysqli_error());
$dates=array();
while ($row = mysqli_fetch_array($query)) {
  $fromdate=date('d-m-Y', strtotime($row['ccldate']));
  array_push($dates, $fromdate);
}


	$sql="INSERT INTO cclmanager(ccldate,holiday,working,department) VALUES(:date,:holiday,:working,:department)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':department',$department,PDO::PARAM_STR);
		$query->bindParam(':holiday',$holiday,PDO::PARAM_STR);
		$query->bindParam(':working',$working,PDO::PARAM_STR);
		$query->bindParam(':date',$date,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();

		if($lastInsertId)
		{
			echo "<script>alert('Leave Application was successful.');</script>";
			echo "<script type='text/javascript'> document.location = #; </script>";
		}
		else 
		{
			echo "<script>alert('Something went wrong. Please try again');</script>";
		}
	$sql="SELECT FirstName,LastName,emp_id,Department from tblemployees where role='$role'";
	$query = mysqli_query($conn, $sql) or die(mysqli_error());
	$cnt=1;

	while ($row = mysqli_fetch_array($query)) {
		$name=$row["FirstName"].$row["LastName"];
		$depar=$row['Department'];
		if(in_array($name,$_POST['check_list'],false))
		{
			$id=$row['emp_id'];
			$status=1;
			$result = mysqli_query($conn,"update tblemployees set cclgrant='$status',compensatory_casual_leave=compensatory_casual_leave+1 where emp_id = '$id'");
					if ($result) {

					   } else{
						 die(mysqli_error());
					  }
		}
		else
		{
			$id=$row['emp_id'];
			$status=0;
			$result = mysqli_query($conn,"update tblemployees set cclgrant='$status' where emp_id = '$id'");
					if ($result) {
					   } else{
						 die(mysqli_error());
					  }
		}
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
		<div class="pd-ltr-20 xs-pd-20-10">
			<div class="min-height-200px">
				<div class="page-header">
					<div class="row">
						<div class="col-md-6 col-sm-12">
							<div class="title">
								<h4>Staff Portal</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">CCL Manager</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Staff Form</h4>
							<p class="mb-20"></p>
						</div>
					</div>
					
					<div class="wizard-content">
						<form method="post" action="" enctype="multipart/form-data">
							<section>
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Date :</label>
											<input name="date" type="text" class="form-control date-picker" required="true" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
									<?php $query= mysqli_query($conn,"select Department from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
									$row = mysqli_fetch_array($query);
								?>
										<div class="form-group">
											<label>Department :</label>
											<input name="department" type="text" class="form-control date-picker" readonly value="<?php echo $row['Department']; ?>" required="true" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Holiday Reason:</label>
											<input name="holiday" type="text" class="form-control" required="true" autocomplete="off" >

										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Working Reason:</label>
											<input name="working" type="text" class="form-control" required="true" autocomplete="off">
										</div>
									</div>
								</div>
								
								</div>
								
							</section>
							<?php 
                            $role="Staff";
							$sql="SELECT Department from tblemployees where emp_id='$session_id'";
                            $query = mysqli_query($conn, $sql) or die(mysqli_error());
							$dep=$row['Department'];
                            $sql="SELECT FirstName,LastName,emp_id from tblemployees where role='$role' AND Department='$dep'";
                            $query = mysqli_query($conn, $sql) or die(mysqli_error());
                            $cnt=1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
                            <input type="checkbox" name="check_list[]" value=<?php echo htmlentities ($row["FirstName"].$row["LastName"]) ?>><label><?php echo htmlentities ($row["FirstName"]." ".$row["LastName"]) ?></label><br/>
                            <?php $cnt++;} ?>
                            <div class="modal-footer justify-content-center">
							<button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Grant&nbsp;CCL</button>
							</div>
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