<?php
session_start();
include('includes/config.php');
if(isset($_POST['signin']))
{
	$username=$_POST['username'];
	$password=md5($_POST['password']);

	$sql ="SELECT * FROM tblemployees where EmailId ='$username' AND Password ='$password'";
	$query= mysqli_query($conn, $sql);
	$count = mysqli_num_rows($query);
	if($count > 0)
	{
		while ($row = mysqli_fetch_assoc($query)) {
		    if ($row['role'] == 'Admin') {
		    	$_SESSION['alogin']=$row['emp_id'];
		    	$_SESSION['arole']=$row['Department'];
			 	echo "<script type='text/javascript'> document.location = 'admin/admin_dashboard.php'; </script>";
		    }
		    elseif ($row['role'] == 'Staff') {
		    	$_SESSION['alogin']=$row['emp_id'];
		    	$_SESSION['arole']=$row['Department'];
			 	echo "<script type='text/javascript'> document.location = 'staff/index.php'; </script>";
		    }
            elseif ($row['role'] == 'dean') {
		    	$_SESSION['alogin']=$row['emp_id'];
		    	$_SESSION['arole']=$row['Department'];
			 	echo "<script type='text/javascript'> document.location = 'dean/index.php'; </script>";
		    }
			elseif ($row['role'] == 'principal') {
		    	$_SESSION['alogin']=$row['emp_id'];
		    	$_SESSION['arole']=$row['Department'];
			 	echo "<script type='text/javascript'> document.location = 'principal/admin_dashboard.php'; </script>";
		    }
		    else {
		    	$_SESSION['alogin']=$row['emp_id'];
		    	$_SESSION['arole']=$row['Department'];
			 	echo "<script type='text/javascript'> document.location = 'heads/index.php'; </script>";
		    }
		}

	} 
	else{
	  
	  echo "<script>alert('Invalid Details');</script>";

	}

}
// $_SESSION['alogin']=$_POST['username'];
// 	echo "<script type='text/javascript'> document.location = 'changepassword.php'; </script>";
?>

<!DOCTYPE html>
<html>
<head>
	<!-- Basic Page Info -->
	<meta charset="utf-8">
	<title>MRCET FACULTY LEAVE MANAGER</title>

	<!-- Site favicon -->
	<link rel="images-removebg-preview" sizes="180x180" href="vendors/images/images-removebg-preview.png" alt="" width="100px" height="100px">
	<link rel="icon" type="image/png" sizes="40x40" href="vendors/images/ images-removebg-preview.png" alt="" width="100px" height="100px">
	<link rel="icon" type="image/png" sizes="40x40" href="vendors/images/ images-removebg-preview.png" alt="" width="100px" height="100px">

	<!-- Mobile Specific Metas -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Google Font -->
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
	<!-- CSS -->
	<link rel="stylesheet" type="text/css" href="vendors/styles/core.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/icon-font.min.css">
	<link rel="stylesheet" type="text/css" href="vendors/styles/style.css">

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119386393-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-119386393-1');
	</script>
    <style>
body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
}

html {
  box-sizing: border-box;
}

*, *:before, *:after {
  box-sizing: inherit;
}

.column {
  float: left;
  width: 33.3%;
  margin-bottom: 16px;
  padding: 0 8px;
}

.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  margin: 5px;
}

.about-section {
  padding: 50px;
  text-align: center;
  background-color: #474e5d;
  color: white;
}

.container {
  padding: 0 16px;
}

.container::after, .row::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: black;
}


@media screen and (max-width: 650px) {
  .column {
    width: 100%;
    display: block;
  }
}
footer{
    background: black;
    width: 100%;
    text-align: center;
    color: #F5DEB3;
    font-size: 17px
}
 h1 {
    color: #DAA520;
}

</style>
</head>
<body class="login-page">
	<div class="login-header box-shadow">
		<div class="container-fluid d-flex justify-content-between align-items-center">
			<div class="brand-logo"><link rel="images-removebg-preview" sizes="90x90px" href="vendors/images/download.png">
				<a href="login.html">
					<img src="vendors/images/qwe.jpg" alt="" width="100" height="100"><h1 style="text-align:center;">MRCET FACULTY ONLINE LEAVE APPLICATION</h1>
				</a>
			</div>
		</div>
	</div>
    
	<div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-md-6 col-lg-7";>
					<img src="vendors/images/mallareddy.jpg" alt="" width="1000" height="1900">
				</div>
				<div class="col-md-6 col-lg-5">
					<div class="login-box bg-white box-shadow border-radius-10">
						<div class="login-title">
							<h2 class="text-center text-prim<br>ary" style="color:#4B0082";>Login To MRCET</h2>
						</div><br>
						<form name="signin" method="post">
						<br>
							<div class="input-group custom">
								<input type="text" class="form-control form-control-lg" placeholder="Email ID" name="username" id="username"> 
                                <div class="input-group-append custom">
									<span class="input-group-text"><i class="icon-copy fa fa-envelope-o"></i></span>
								</div> 
							</div>
							<div class="input-group custom">
								<input type="password" class="form-control form-control-lg" placeholder="**********"name="password" id="password">
								<div class="input-group-append custom">
									 <span class="input-group-text"><i class="dw dw-padlock1" aria-hidden="true"></i></span>
								</div>
							</div>
							<div class="row pb-30">
								
								<div class="col-6">
									<div class="forgot_password"><a href="forgot_password.html"></a></div>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<div class="input-group mb-0">
									   <input class="btn btn-primary btn-lg btn-block" name="signin" id="signin" type="submit" value="Sign In">
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
			<div>
				
			</div>
		</div><div class="head" height="1px" style="color:#4B0082";>Note :<marquee width="70%" direction="left" height="18px" style="text-align:left";>
Please hold your work adjustment form (OR) leave adjustment form with you.
</marquee></div>
		
        
	</div>
    <img src="vendors/images/gta.png" alt="" width="20px" height="20px" class="center"> 

        <div class="about-section">
  <h1 style="color:	#DAA520">DEVELOPED BY</h1>
  <p>Dept.of EMERGING TECHNOLOGIES</p>
</div>

<h2 style="text-align:center">Our Team ANONYMOUS</h2><BR>
<div class="row">
  <div class="column">
    <div class="card">
      
      <div class="container">
        <h2>Dr. M. V. KAMAL</h2>
        <p class="title">PROJECT MENTOR</p>
        <p>"HoD" OF DEPT. CSE[EMERGING TECHNOLOGIES](SOCSE-3)</p>
        
      </div>
    </div>
  </div>

  <div class="column">
    <div class="card">
      
      <div class="container">
        <h2>S. PAVAN TEJA</h2>
        <p class="title">TEAM_LEAD</p>
        <p>2ND YEAR CSE-[DATA SCIENCE] ROLLNO:21N35A6706</p>
        
      </div>
    </div>
  </div>
  
  <div class="column">
    <div class="card">
      
      <div class="container">
        <h2>B. ABHINAV</h2>
        <p class="title">BACKEND PROGRAMMER</p>
        <p>2ND YEAR CSE-[IoT]<br>
			 ROLLNO:20N31A6912</p>
      </div>
    </div>
  </div>
  <div class="column">
    <div class="card" style="align:center">
      
      <div class="container" >
        <h2>K. SRI VAKULA</h2>
        <p class="title">FRONTEND PROGRAMMER/TESTER</p>
        <p>2ND YEAR CSE-[DATA SCIENCE] ROLLNO:20N31A6736</p>
      </div>
    </div>
  </div>
  <div class="column">
    <div class="card" style="align:center">
      
      <div class="container" >
        <h2>T. LIKITHA </h2>
        <p class="title">FRONTEND PROGRAMMER</p>
        <p>2ND YEAR CSE-[DATA SCIENCE] ROLLNO:20N31A6755</p>
      </div>
    </div>
  </div>
  <div class="column">
    <div class="card" style="align:center">
      
      <div class="container" >
        <h2>contact us</h2>
        <p class="title">CSE-EMERGING TECHNOLOGIES</p><br>
        <p>socse3mrcet@gmail.com</p>
      </div>
    </div>
  </div>
</div>
    <div class="nonew">



	<!-- js -->
	<script src="vendors/scripts/core.js"></script>
	<script src="vendors/scripts/script.min.js"></script>
	<script src="vendors/scripts/process.js"></script>
	<script src="vendors/scripts/layout-settings.js"></script>
</body>
<footer style="align:center";>FOR ANY [EMERGENCY/ISSUES/QUERIES] CALL US:<BR>
Dr.M.V.KAMAL [7409262929],(HoD,SoCSE-3)<BR>Mr. S.PAVAN TEJA [9573694260],(CSE-DATA SCIENCE)</footer>
</html>
