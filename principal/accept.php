<?php include('../includes/session.php')?>
<?php include('../includes/config.php')?>
<?php include('../includes/tools.php')?>

<!-- tracker values
1accept for admin_dashboard
2decline for admin admin_dashboard -->


<?php 
						
						$lid=intval($_GET['leaveid']);
						$tracker=intval($_GET['tracker']);
						$sql = "SELECT tblleaves.id as lid,tblemployees.emp_id,tblemployees.Av_leave,tblleaves.LeaveType,tblleaves.num_days from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblleaves.id=:lid";
						$query = $dbh -> prepare($sql);
						$query->bindParam(':lid',$lid,PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
                        $avleave;
                        $num_days;
						if($query->rowCount() > 0)
						{
						foreach($results as $result)
						{ 
                            $avleave=$result->Av_leave;
                            $daysnum=$result->num_days;
							$leavetype=$result->LeaveType;
							$eid=$result->emp_id;
                        } }       
	?>

<?php
	// code for update the read notification status
	$levtyp=familyName($leavetype);
	$isread=1;
	$blql = "SELECT $levtyp from tblemployees where emp_id='$eid'";
	$lalal = $dbh -> prepare($blql);
	$lalal->execute();
	$hooo=$lalal->fetchAll(PDO::FETCH_OBJ);
	if($lalal->rowCount() > 0)
	{
	foreach($hooo as $aaa)
{
	$count=$aaa->$levtyp;
} }       
	date_default_timezone_set('Asia/Kolkata');
	$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
	$sql="update tblleaves set IsRead=:isread where id=:did";
	$query = $dbh->prepare($sql);
	$query->bindParam(':isread',$isread,PDO::PARAM_STR);
	$query->bindParam(':did',$did,PDO::PARAM_STR);
	$query->execute();

	// code for action taken on leave
		$status=$tracker;
		$did=intval($_GET['leaveid']);
		$description="no message";
		$av_leave=$avleave;
		$num_days=$daysnum;
		$count=$count-$num_days;
		$REMLEAVE = $av_leave - $num_days;

		date_default_timezone_set('Asia/Kolkata');
		$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));

		if ($status === 2) {
			$description="leave rejected.";
			$sql="update tblleaves set registra_remarks=:description,admin_status=:status,AdminRemarkDate=:admremarkdate where id=:did";

			$query = $dbh->prepare($sql);
			$query->bindParam(':description',$description,PDO::PARAM_STR);
			$query->bindParam(':status',$status,PDO::PARAM_STR);
			$query->bindParam(':admremarkdate',$admremarkdate,PDO::PARAM_STR);
			$query->bindParam(':did',$did,PDO::PARAM_STR);
			$query->execute();
			echo "<script>alert('Leave updated Successfully');</script>";
		}
		elseif ($status === 1) {
			if($leavetype == "Casual Leave")
     {
        $sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.Av_leave='$REMLEAVE', tblemployees.casual_leave='$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
     }
     elseif($leavetype == "Medical Leave")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.Av_leave='$REMLEAVE', tblemployees.medical_leave='$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     elseif($leavetype == "On Duty")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.Av_leave='$REMLEAVE', tblemployees.on_duty_leave='$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     elseif($leavetype == "paid leave")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.Av_leave='$REMLEAVE', tblemployees.paid_leave='$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     elseif($leavetype == "Compensatory Casual Leave")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.Av_leave='$REMLEAVE', tblemployees.compensatory_casual_leave='$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     elseif($leavetype == "Health Care Leave")
     {
		$sql = "update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.Av_leave='$REMLEAVE', tblemployees.health_care_leave='$count' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'";
	}
     else
     {
        echo "<script>alert('NO VALID LEAVE TYPE');</script>";
     }
				$result= $dbh->prepare($sql);
				$result->execute();
				if ($result) {
			     	echo "<script>alert('Leave updated Successfully');</script>";
					} else{
					  die(mysqli_error());
				   }
		}
?>

<?php header("location: admin_dashboard.php"); ?>