<?php include('includes/session.php')?>
<?php include('includes/config.php')?>
<!-- <?php include('includes/tools.php')?> -->
<?php 
$start_date='2003-03-16';
$end_date='2003-03-25';

echo 'dafads ';

?>
<?php 
$ccl="SELECT cclgrant from tblemployees where emp_id='$session_id'";
$cclq = mysqli_query($conn, $ccl) or die(mysqli_error());
$ccld= mysqli_fetch_array($cclq);
$cclm=$ccld['cclgrant'];
echo $cclm;
?> 
