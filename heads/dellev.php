<?php include('../includes/session.php')?>
<?php include('../includes/config.php')?>
<?php include('../includes/tools.php')?>

<?php
$lid=intval($_GET['leaveid']);
$sql = "SELECT admin_status from tblleaves where id=:lid";
$query = $dbh -> prepare($sql);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
    $admins=$result->admin_status;
}  }

if ($admins==1) {
$sql = "SELECT tblemployees.emp_id,tblleaves.num_days,tblleaves.LeaveType from tblleaves join tblemployees on tblleaves.empid=tblemployees.emp_id where tblleaves.id=:lid";
$query = $dbh -> prepare($sql);
$query->bindParam(':lid',$lid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
    $levtyp=$result->LeaveType;
    $empid=$result->emp_id;
    $numdays=$result->num_days;

}  }
$qname=familyName($levtyp);

$sql = "SELECT $qname from tblemployees where emp_id=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
foreach($results as $result)
{ 
    $left=$result->$qname;

} 
$final=$left+$numdays;
$update=mysqli_query($conn,"update tblemployees set $qname='$final' where emp_id='$empid'");
if ($update) {
	echo "<script>alert('Leave updated Successfully');</script>";
	} else{
	die(mysqli_error());
	}
}
$sss=3;
    $result = mysqli_query($conn,"update tblleaves set Status='$sss',admin_status='$sss' where id='$lid'");

	if ($result) {
	echo "<script>alert('Leave updated Successfully');</script>";
	} else{
	die(mysqli_error());
	}

header("location: index.php");
?>