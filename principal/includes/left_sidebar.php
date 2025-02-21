<div class="left-side-bar">
		<div class="brand-logo">
			<a href="admin_dashboard.php">
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
						<a href="admin_dashboard.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Dashboard</span>
						</a>
						
					</li>
					<li class="dropdown">
						<a href="superaccept.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Accept Leaves</span>
						</a>
						
					</li>
					<li>
						<a href="department.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-house-1"></span><span class="mtext">Department</span>
						</a>
					</li>
					<li>
						<a href="leave_type.php" class="dropdown-toggle no-arrow">
							<span class="micon dw dw-calendar1"></span><span class="mtext">Leave Type</span>
						</a>
					</li>

					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-library"></span><span class="mtext">Staff</span>
						</a>
						<ul class="submenu">
							<li><a href="add_staff.php">New Staff</a></li>
							<li><a href="staff.php">Manage Staff</a></li>
						</ul>
					</li>
					<li class="dropdown">
						<a href="javascript:;" class="dropdown-toggle">
							<span class="micon dw dw-apartment"></span><span class="mtext"> Leave </span>
						</a>
						<ul class="submenu">
							<li><a href="leaves.php">All Leave</a></li>
							<li><a href="apply_leave.php">Apply Leave</a></li>
							<li><a href="pending_leave.php">Pending Leave</a></li>
							<li><a href="approved_leave.php">Approved Leave</a></li>
							<li><a href="rejected_leave.php">Rejected Leave</a></li>
						</ul>
					</li>

					<li>
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
					
					
				</ul>
			</div>
		</div>
	</div>