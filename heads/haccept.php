<?php include('../includes/session.php')?>
<?php include('../includes/config.php')?>
<?php include('../includes/tools.php')?>


<?php 
						
						$lid=intval($_GET['leaveid']);
						$tracker=intval($_GET['tracker']);
                        $sql = "SELECT tblleaves.id as  lid,tblemployees.emp_id,tblemployees.Av_leave,tblleaves.num_days,tblleaves.LeaveType , tblemployees.compensatory_casual_leave from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblleaves.id=:lid";
						$query = $dbh -> prepare($sql);
						$query->bindParam(':lid',$lid,PDO::PARAM_STR);
						$query->execute();
						$results=$query->fetchAll(PDO::FETCH_OBJ);
						$cnt=1;
						$leavetype;
						if($query->rowCount() > 0)
						{
						foreach($results as $result)
						{ 
                            $avleave=$result->Av_leave;
                            $daysnum=$result->num_days;
							$leavetype=$result->LeaveType;
							$ccc=$result->compensatory_casual_leave;
                        }  }


?>


<?php
	
	// code for update the read notification status
	$leval=familyName($leavetype);
	$isread=1;
	$did=intval($_GET['leaveid']);  
	date_default_timezone_set('Asia/Kolkata');
	$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
	$sql="update tblleaves set IsRead=:isread where id=:did";
	$query = $dbh->prepare($sql);
	$query->bindParam(':isread',$isread,PDO::PARAM_STR);
	$query->bindParam(':did',$did,PDO::PARAM_STR);
	$query->execute();
    echo "1";
	// code for action taken on leave
	
		$did=intval($_GET['leaveid']);
		$description="checked your leave";
		$status=$tracker;  
		$av_leave=$avleave;
		$num_days=$daysnum;
		$ccc=$ccc+1;
		$cclremark='Approved by your HOD';
		$cclstatus=1;
		// $REMLEAVE = $av_leave - $num_days;
		$reg_remarks = 'Leave was Rejected. Registra/Registry will not see it';
		$reg_status = 2;
		date_default_timezone_set('Asia/Kolkata');
		$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));
        echo $status;
		if ($status === 2) {
			$result = mysqli_query($conn,"update tblleaves, tblemployees set tblleaves.AdminRemark='$description',tblleaves.Status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblleaves.registra_remarks = '$reg_remarks', tblleaves.admin_status = '$reg_status' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'");

				if ($result) {
			     	echo "<script>alert('Leave updated Successfully');</script>";
					} else{
					  die(mysqli_error());
				   }
		}
		elseif ($status === 1) {
				
					$result = mysqli_query($conn,"update tblleaves, tblemployees set tblleaves.AdminRemark='$description',tblleaves.Status='$status',tblleaves.AdminRemarkDate='$admremarkdate' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'");
				
				

				if ($result) {
			     	echo "<script>alert('Leave updated Successfully');</script>";
					} else{
					  die(mysqli_error());
				   }
		}


		// date_default_timezone_set('Asia/Kolkata');
		// $admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));

		// $sql="update tblleaves set AdminRemark=:description,Status=:status,AdminRemarkDate=:admremarkdate where id=:did";

		// $query = $dbh->prepare($sql);
		// $query->bindParam(':description',$description,PDO::PARAM_STR);
		// $query->bindParam(':status',$status,PDO::PARAM_STR);
		// $query->bindParam(':admremarkdate',$admremarkdate,PDO::PARAM_STR);
		// $query->bindParam(':did',$did,PDO::PARAM_STR);
		// $query->execute();
		// echo "<script>alert('Leave updated Successfully');</script>";

?>

<?php header("location: index.php"); ?>