
<?php include('../includes/session.php')?>
<?php include('../includes/config.php')?>
<?php 
$tbltyp=intval($_GET['tbltyp']);

// Load the database configuration file  
// Filter the excel data 
function filterData(&$str){ 
    $str = preg_replace("/\t/", "\\t", $str); 
    $str = preg_replace("/\r?\n/", "\\n", $str); 
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"'; 
} 
 
// Excel file name for download 
 
// Column names 
if($tbltyp==1)
{
    $fileName = "leaves_taken_" . date('Y-m-d') . ".xls"; 

    $fields = array('FIRST NAME', 'LAST NAME', 'LEAVE TYPE', 'FROM DATE', 'TO DATE', 'DEPARTMENT', 'NO OF DAYS', 'HOD STATUS', 'PRINCIPAL STATUS', ''); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$sql = "SELECT tblleaves.LeaveType,tblleaves.FromDate, tblleaves.ToDate, tblleaves.PostingDate, tblemployees.FirstName, tblleaves.num_days,tblemployees.LastName,tblemployees.Department,tblleaves.Status,tblleaves.admin_status FROM tblleaves INNER JOIN tblemployees ON tblleaves.empid=tblemployees.emp_id ORDER BY PostingDate ASC";
$query = mysqli_query($conn, $sql) or die(mysqli_error());
$num_rows=5;
if($num_rows > 0){ 
    // Output each row of the data 
    while($row = mysqli_fetch_array($query)){ 
        $hod=$row['Status'];
        $admi=$row['admin_status'];
        if($hod==0)
        {
            $hod="Pending";
        }
        elseif ($hod==1) {
            $hod="Approved";
        }
        elseif($hod==2)
        {
            $hod="Rejected";
        }
        elseif ($hod==3) {
            $hod="Deleted"; 
        }

        if($admi==0)
        {
            $admi="Pending";
        }
        elseif ($admi==1) {
            $admi="Approved";
        }
        elseif($admi==2)
        {
            $admi="Rejected";
        }
        elseif ($admi==3) {
            $admi="Deleted"; 
        }
        $lineData = array($row['FirstName'], $row['LastName'], $row['LeaveType'], $row['ToDate'], $row['FromDate'], $row['Department'], $row['num_days'],$hod,$admi);
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
}
elseif($tbltyp==2)
{
    $fileName = "employ_leave_data_" . date('Y-m-d') . ".xls"; 

    $fields = array('FIRST NAME', 'LAST NAME', 'DEPARTMENT', 'CASUAL LEAVES', 'MEDICAL LEAVES', 'ON DUTY LEAVES', 'PAID LEAVES' ,'CC LEAVES','HEALTH CARE LEAVES'); 
 
// Display column names as first row 
$excelData = implode("\t", array_values($fields)) . "\n"; 
 
// Fetch records from database 
$sql = "SELECT * FROM tblemployees";
$query = mysqli_query($conn, $sql) or die(mysqli_error());
$num_rows=5;
if($num_rows > 0){ 
    // Output each row of the data 
    while($row = mysqli_fetch_array($query)){ 
        $lineData = array($row['FirstName'], $row['LastName'], $row['Department'], $row['casual_leave'], $row['medical_leave'], $row['on_duty_leave'], $row['paid_leave'], $row['compensatory_casual_leave'], $row['health_care_leave']);
        array_walk($lineData, 'filterData'); 
        $excelData .= implode("\t", array_values($lineData)) . "\n"; 
    } 
}else{ 
    $excelData .= 'No records found...'. "\n"; 
} 
}

 
// Headers for download 
header("Content-Type: application/vnd.ms-excel"); 
header("Content-Disposition: attachment; filename=\"$fileName\""); 
 
// Render excel data 
echo $excelData; 
 
exit; ?>

