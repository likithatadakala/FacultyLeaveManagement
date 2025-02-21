<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
<?php
if(isset($_POST['apply'])){//to run PHP script on submit
if(!empty($_POST['check_list'])){
	$description="Leave accepted by principal";
    $status=1;
    $admremarkdate=date("d-m-Y");

	foreach($_POST['check_list'] as $idd)
    {
        $sql = "SELECT tblleaves.LeaveType,tblleaves.num_days from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblleaves.id='$idd'";
        $query = mysqli_query($conn, $sql) or die(mysqli_error());
        $row = mysqli_fetch_array($query);
        $count=$row['num_days'];
        $did=$idd;
        $leavetype=$row['LeaveType'];
        if($leavetype == "Casual Leave")
     {
        $sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.casual_leave=tblemployees.casual_leave-'$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
     }
     elseif($leavetype == "Medical Leave")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.medical_leave=tblemployees.medical_leave-'$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     elseif($leavetype == "On Duty")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.on_duty_leave=tblemployees.on_duty_leave-'$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     elseif($leavetype == "paid leave")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.paid_leave=tblemployees.paid_leave-'$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     elseif($leavetype == "Compensatory Casual Leave")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.compensatory_casual_leave=tblemployees.compensatory_casual_leave-'$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     elseif($leavetype == "Health Care Leave")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.health_care_leave=tblemployees.health_care_leave-'$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     else
     {
        echo "<script>alert('NO VALID LEAVE TYPE');</script>";
     }
				$result= $dbh->prepare($sql);
				$result->execute();
				if ($result) {
			     	echo "<script>alert('Leave Granted Successfully');</script>";
					} else{
					  die(mysqli_error());
				   }
    }
}
else 
		{
			echo "<script>alert('select faculty!!');</script>";
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
                    <table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
                            <th class="table-plus datatable-nosort">CHECK BOX</th>
								<th class="table-plus datatable-nosort">STAFF NAME</th>
								<th>LEAVE TYPE</th>
								<th>APPLIED DATE</th>
								<th>NO. OF DAYS</th>
							</tr>
						</thead>
						<tbody>
                        <?php 
                            $stat=1;
                            $adstat=0;
                            $sql = "SELECT tblemployees.FirstName,tblemployees.LastName,tblleaves.id,tblleaves.num_days,tblleaves.PostingDate,tblleaves.LeaveType from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblleaves.Status='$stat' AND tblleaves.admin_status='$adstat'";
                            $query = mysqli_query($conn, $sql) or die(mysqli_error());
                            $cnt=1;
                            while ($row = mysqli_fetch_array($query)) {
                            ?>
							<tr>
                                <td>
                                <input type="checkbox" name="check_list[]" value=<?php echo htmlentities ($row["id"]) ?>>

                            </td>
                            <td class="table-plus">
									<div class="name-avatar d-flex align-items-center">
										<div class="txt">
											<div class="weight-600"><?php echo $row['FirstName']." ".$row['LastName'];?></div>
										</div>
									</div>
								</td>
                                <td><?php echo $row['LeaveType']; ?></td>
								<td><?php echo $row['PostingDate']; ?></td>
								<td><?php echo $row['num_days']; ?></td>


								
							</tr>
                            <?php } ?>
						</tbody>
					</table>
                    <div class="modal-footer justify-content-center">
							<button class="btn btn-primary" name="apply" id="apply" data-toggle="modal">Grant&nbsp;Leave</button>
							</div>
                    </form>


                
				</div>

			</div>
			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->
	<?php include('includes/scripts.php')?>
</body>
</html>