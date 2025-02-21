<?php include('../includes/session.php')?>
<?php include('../includes/config.php')?>
<!-- tracker values
1accept for admin_dashboard
2decline for admin admin_dashboard -->


<?php 
						
						$lid=intval($_GET['leaveid']);
						$tracker=intval($_GET['tracker']);
						$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.emp_id,tblemployees.Gender,tblemployees.Phonenumber,tblemployees.EmailId,tblemployees.Av_leave,tblleaves.LeaveType,tblleaves.ToDate,tblleaves.FromDate,tblleaves.Description,tblleaves.PostingDate,tblleaves.Status,tblleaves.AdminRemark,tblleaves.admin_status,tblleaves.registra_remarks,tblleaves.AdminRemarkDate,tblleaves.num_days from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblleaves.id=:lid";
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
                        } }       
	?>

<?php
	// code for update the read notification status
	$isread=1;
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

		$REMLEAVE = $av_leave - $num_days;

		date_default_timezone_set('Asia/Kolkata');
		$admremarkdate=date('Y-m-d G:i:s ', strtotime("now"));

		if ($status === 2) {
			echo "running leave rejected";
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
			echo "running leave accepted";
				$result = mysqli_query($conn,"update tblleaves, tblemployees set tblleaves.registra_remarks='$description',tblleaves.admin_status='$status',tblleaves.AdminRemarkDate='$admremarkdate', tblemployees.Av_leave='$REMLEAVE' where tblleaves.empid = tblemployees.emp_id AND tblleaves.id='$did'");

				if ($result) {
			     	echo "<script>alert('Leave updated Successfully');</script>";
					} else{
					  die(mysqli_error());
				   }
		}
?>

<?php header("location: admin_dashboard.php"); ?>