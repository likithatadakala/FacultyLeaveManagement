<?php include('../includes/session.php')?>
<div class="left-side-bar"> 
		<div class="brand-logo">
			<a href="index.php">
				<img src="../vendors/images/mrcet-removebg-preview.png" alt="" class="dark-logo">
				<img src="../vendors/images/mrcet-removebg-preview.png" alt="" class="light-logo">
			</a>
			<div class="close-sidebar" data-toggle="left-sidebar-close">
				<i class="ion-close-round"></i>
			</div>
		</div>
		<div class="menu-block customscroll">
			<div class="sidebar-menu">
				<ul id="accordion-menu">
					<li class="dropdown">
						<a href="index.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-apartment"></span><span class="mtext"> Leave </span>
						</a>
						<ul class="submenu">
							<li><a href="apply_leave.php">Apply Leave</a></li>
							<li><a href="leave_history.php">Leave History</a></li>
							
						</ul>
					</li>

					<li>
						<div class="dropdown-divider"></div>
					</li>
					<?php 
						
						$res=mysqli_query($conn,"SELECT casual_leave,medical_leave,on_duty_leave,paid_leave,compensatory_casual_leave,health_care_leave from tblemployees where emp_id='$session_id'");
						
						while ($row = mysqli_fetch_array($res)) 
						{
							$a=$row["casual_leave"];
							$b=$row["medical_leave"];
							$c=$row["on_duty_leave"];
							$d=$row["paid_leave"];
							$e=$row["compensatory_casual_leave"];
							$f=$row["health_care_leave"];

						}
						?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Casual Leaves-<?php echo htmlentities($a) ?></span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">medical Leaves-<?php echo htmlentities($b) ?></span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">On Duty Leave-<?php echo htmlentities($c) ?></span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Paid Leave-<?php echo htmlentities($d) ?></span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Compensatory CL-<?php echo htmlentities($e) ?></span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Health Care-<?php echo htmlentities($f) ?></span>
						</a>
						
					</li>
					

					
					
				</ul>
			</div>
		</div>
	</div>