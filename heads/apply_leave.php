<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>

<?php

	if(isset($_POST['apply']))
	{
	$empid=$session_id;
	$leave_type=$_POST['leave_type'];
	$fromdate=date('d-m-Y', strtotime($_POST['date_from']));
	$todate=date('d-m-Y', strtotime($_POST['date_to']));
	$description=$_POST['description'];  
	$classh=$_POST['hourclass'];
	$substute=$_POST['substute'];
	$status=1;
	$isread=0;
	$leave_days=$_POST['leave_days'];
	$current = date("d-m-Y");
	$datePosting=date("Y-m-d");
	$cnt=0;
	$start_date=$fromdate;
	$end_date=$todate;
   $today=date("d-m-Y");
   $dates=array();
   $sql = "SELECT fromdate, status from calender";
	$query = $dbh -> prepare($sql);
	$query->execute();
   $results=$query->fetchAll(PDO::FETCH_OBJ);
   if($query->rowCount() > 0)
						{
						foreach($results as $result)
						{
                            $daa=strtotime($result->fromdate);
                            $dates[$daa]=$result->status;

                  } }
	while (strtotime($start_date) <= strtotime($end_date)) {
        $check=true;
		$timestamp = strtotime($start_date);
        $day = date('D', $timestamp);
		if(array_key_exists($timestamp,$dates))
        {
            if($dates[$timestamp]!='holiday')
            {
                $check=false;
            }
        }
		if($day!="Sun" && !array_key_exists($timestamp,$dates) && $check)
		{
			$cnt++;
		}

		$start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date)));
	}	
	$num_days=$cnt;
	if($fromdate > $todate)
	{
	    echo "<script>alert('End Date should be greater than Start Date');</script>";
	  }
	elseif($leave_days <= 0)
	{
	    echo "<script>alert('YOU HAVE EXCEEDED YOUR LEAVE LIMIT. LEAVE APPLICATION FAILED');</script>";
	  }
	elseif($current>$fromdate && $current>$todate)
	{
		echo "<script>alert('YOU ARE IN THE PAST');</script>";
	}
	elseif ($num_days<=0) {
		echo "<script>alert('CHECK YOUR DATES. YOU MAY HAVE APPLIED ON SUNDAY');</script>";

	}

	else {
		$image = $_FILES['image']['name'];

	if(!empty($image)){
		move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/'.$image);
		$location = $image;	
	}
	else {
		echo "<script>alert('Please Select Picture to Update');</script>";
	}

		$sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Description,Status,IsRead,empid,num_days,PostingDate,class_hour,substute,location) VALUES(:leave_type,:fromdate,:todate,:description,:status,:isread,:empid,:num_days,:datePosting,:classh,:substute,:location)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':leave_type',$leave_type,PDO::PARAM_STR);
		$query->bindParam(':classh',$classh,PDO::PARAM_STR);
		$query->bindParam(':location',$location,PDO::PARAM_STR);
		$query->bindParam(':substute',$substute,PDO::PARAM_STR);
		$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
		$query->bindParam(':todate',$todate,PDO::PARAM_STR);
		$query->bindParam(':description',$description,PDO::PARAM_STR);
		$query->bindParam(':status',$status,PDO::PARAM_STR);
		$query->bindParam(':isread',$isread,PDO::PARAM_STR);
		$query->bindParam(':empid',$empid,PDO::PARAM_STR);
		$query->bindParam(':num_days',$num_days,PDO::PARAM_STR);
		$query->bindParam(':datePosting',$datePosting,PDO::PARAM_STR);
		$query->execute();
		$lastInsertId = $dbh->lastInsertId();
		if($lastInsertId)
		{
			echo "<script>alert('Leave Application was successful.');</script>";
			echo "<script type='text/javascript'> document.location = 'leave_history.php'; </script>";
		}
		else 
		{
			echo "<script>alert('Something went wrong. Please try again');</script>";
		}

	}

}

if (isset($_POST["update_image"])) {

	$image = $_FILES['image']['name'];

	if(!empty($image)){
		move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/'.$image);
		$location = $image;	
	}
	else {
		echo "<script>alert('Please Select Picture to Update');</script>";
	}

    $result = mysqli_query($conn,"update tblemployees set location='$location' where emp_id='$session_id'         
		")or die(mysqli_error());
    if ($result) {
     	echo "<script>alert('Profile Picture Updated');</script>";
     	echo "<script type='text/javascript'> document.location = 'my_profile.php'; </script>";
	} else{
	  die(mysqli_error());
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
								<h4>Leave Application</h4>
							</div>
							<nav aria-label="breadcrumb" role="navigation">
								<ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
									<li class="breadcrumb-item active" aria-current="page">Apply for Leave</li>
								</ol>
							</nav>
						</div>
					</div>
				</div>

				<div style="margin-left: 50px; margin-right: 50px;" class="pd-20 card-box mb-30">
					<div class="clearfix">
						<div class="pull-left">
							<h4 class="text-blue h4">Staff Form</h4>
							<p class="mb-20"></p>
						</div>
					</div>
					<div class="wizard-content">
						<form method="post" action="" enctype="multipart/form-data">
							<section>

								<?php if ($role_id = 'Staff'): ?>
								<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
									$row = mysqli_fetch_array($query);
								?>
						
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label >First Name </label>
											<input name="firstname" type="text" class="form-control wizard-required" required="true" readonly autocomplete="off" value="<?php echo $row['FirstName']; ?>">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label >Last Name </label>
											<input name="lastname" type="text" class="form-control" readonly required="true" autocomplete="off" value="<?php echo $row['LastName']; ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Email Address</label>
											<input name="email" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['EmailId']; ?>">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Available Leave Days </label>
											<input name="leave_days" type="text" class="form-control" required="true" autocomplete="off" readonly value="<?php echo $row['Av_leave']; ?>">
										</div>
									</div>
									<?php endif ?>
								</div>
								<div class="row">
									<div class="col-md-12 col-sm-12">
										<div class="form-group">
											<label>Leave Type :</label>
											<select name="leave_type" class="custom-select form-control" required="true" autocomplete="off">
											<option value="">Select leave type...</option>
											<?php $sql = "SELECT  LeaveType from tblleavetype";
											$query = $dbh -> prepare($sql);
											$query->execute();
											$results=$query->fetchAll(PDO::FETCH_OBJ);
											$cnt=1;
											if($query->rowCount() > 0)
											{
											foreach($results as $result)
											{
											?>                                        
											<option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->LeaveType);?></option>
											<?php }} ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>Start Leave Date :</label>
											<input name="date_from" type="text" class="form-control date-picker" required="true" autocomplete="off">
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>End Leave Date :</label>
											<input name="date_to" type="text" class="form-control date-picker" required="true" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>work adjusted :</label>
											<select name="hourclass" class="custom-select form-control" required="true" autocomplete="off">
											<option value="yes">Yes</option>
											<option value="no">No</option>

										</select>
										
										</div>
									</div>
									<div class="col-md-6 col-sm-12">
										<div class="form-group">
											<label>reason for leave :</label>
											<input name="substute" type="text" class="form-control" required="true" autocomplete="off">
										</div>
									</div>
								</div>
								<div class="clearfix">
						<div class="pull-left">
							<h5 class="text-blue h5">Please upload work adjustment details (or) write work adjustments on a paper and take a picture and upload it for reference. or use notepad in your mobile (take screenshot after details are mentioned) </h5>
							<p class="mb-20"></p>
						</div>
					</div>
								<div class="row">
								<div class="col-md-12 col-sm-12">
								<input type="file" accept="image/*" name="image" id="image">


									</div>
								</div>
								
							</div><br>
								<div class="row">
									<div class="col-md-8 col-sm-12">
										<div class="form-group">
											<label>other remarks :</label>
											<textarea id="textarea1" name="description" class="form-control" required length="150" maxlength="150" required="true" autocomplete="off"></textarea>
										</div>
									</div>
									<div class="col-md-4 col-sm-12">
										<div class="form-group">
											<label style="font-size:16px;"><b></b></label>
											<div class="modal-footer justify-content-center">
												<button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Apply&nbsp;Leave</button>
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