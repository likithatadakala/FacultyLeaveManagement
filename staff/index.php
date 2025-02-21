<?php include('includes/header.php')?>
<?php include('../includes/session.php')?>
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

	<div class="main-container">
		<div class="pd-ltr-20">
			<div class="card-box pd-20 height-100-p mb-30">
				<div class="row align-items-center">
					<div class="col-md-4 user-icon">
					<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
						?>
						<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" alt="">
					</div>
					<div class="col-md-8">

						<?php $query= mysqli_query($conn,"select * from tblemployees where emp_id = '$session_id'")or die(mysqli_error());
								$row = mysqli_fetch_array($query);
						?>

						<h4 class="font-20 weight-500 mb-10 text-capitalize">
							Welcome back <div class="weight-600 font-30 text-blue"><?php echo $row['FirstName']. " " .$row['LastName']; ?>,</div>
						</h4>
						<p class="font-18 max-width-600">staff member, MRCET Campus.</p>
					</div>
				</div>
			</div>
			<div class="row pb-10">
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						

						<div class="d-flex flex-wrap">
							<div class="widget-data">
							<?php
						$sql = "SELECT * from tblleaves where empid = '$session_id'";
						$result=mysqli_query($conn,$sql);
						$rows=mysqli_num_rows($result);
						
						?>
						<div class="weight-700 font-24 text-dark"><?php echo $rows;?></div>
								<div class="font-14 text-secondary weight-500">Leaves Applied</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#00eccf"><i class="icon-copy dw dw-user-2"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php 
						 $status=1;
						 $query = mysqli_query($conn,"select * from tblleaves where empid = '$session_id' AND admin_status = '$status'")or die(mysqli_error());
						 $count_reg_staff = mysqli_num_rows($query);
						 ?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo htmlentities($count_reg_staff); ?></div>
								<div class="font-14 text-secondary weight-500">Accepted Leaves</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#09cc06"><span class="icon-copy fa fa-hourglass"></span></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php 
						 $status=0;
						 $query_pend = mysqli_query($conn,"select * from tblleaves where empid = '$session_id' AND admin_status = '$status'")or die(mysqli_error());
						 $rej=mysqli_num_rows($query_pend);
						 ?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($rej); ?></div>
								<div class="font-14 text-secondary weight-500">Pending Leaves</div>
							</div>
							<div class="widget-icon">
								<div class="icon"><i class="icon-copy fa fa-hourglass-end" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-3 col-lg-3 col-md-6 mb-20">
					<div class="card-box height-100-p widget-style3">

						<?php 
						 $status=2;
						 $query_reject = mysqli_query($conn,"select * from tblleaves where empid = '$session_id' AND admin_status = '$status'")or die(mysqli_error());
						 $count_reject = mysqli_num_rows($query_reject);
						 ?>

						<div class="d-flex flex-wrap">
							<div class="widget-data">
								<div class="weight-700 font-24 text-dark"><?php echo($count_reject); ?></div>
								<div class="font-14 text-secondary weight-500">Rejected Leaves</div>
							</div>
							<div class="widget-icon">
								<div class="icon" data-color="#ff5b5b"><i class="icon-copy fa fa-hourglass-o" aria-hidden="true"></i></div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between pb-10">
							<div class="h5 mb-0">Department Heads</div>
							<div class="table-actions">
								<a title="VIEW" href="#"><i class="icon-copy ion-disc" data-color="#17a2b8"></i></a>	
							</div>
						</div>
						<div class="user-list">
							<ul>
								<?php
								$rrole='HOD';
		                         $query = mysqli_query($conn,"select * from tblemployees WHERE role='$rrole' ORDER BY tblemployees.emp_id desc limit 4") or die(mysqli_error());
		                         while ($row = mysqli_fetch_array($query)) {
		                         $id = $row['emp_id'];
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo (!empty($row['location'])) ? '../uploads/'.$row['location'] : '../uploads/NO-IMAGE-AVAILABLE.jpg'; ?>" class="border-radius-100 box-shadow" width="50" height="50" alt="">
										</div>
										<div class="txt">
											<span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"><?php echo $row['Department']; ?></span>
											<div class="font-14 weight-600"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></div>
											<div class="font-12 weight-500" data-color="#b2b1b6"><?php echo $row['EmailId']; ?></div>
										</div>
									</div>
									<div class="font-12 weight-500" data-color="#17a2b8"><?php echo $row['Phonenumber']; ?></div>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0"></div>
							<div class="table-actions">
								
							</div>
						</div>

						<div ></div>
					</div>
				</div>
				<div class="col-lg-4 col-md-6 mb-20">
					<div class="card-box height-100-p pd-20 min-height-200px">
						<div class="d-flex justify-content-between">
							<div class="h5 mb-0">Staff</div>
							<div class="table-actions">
								<a title="VIEW" href="#"><i class="icon-copy ion-disc" data-color="#17a2b8"></i></a>	
							</div>
						</div>

						<div class="user-list">
							<ul>
								<?php
		                         $query = mysqli_query($conn,"select * from tblemployees where role = 'Admin' ORDER BY tblemployees.emp_id desc limit 4") or die(mysqli_error());
		                         while ($row = mysqli_fetch_array($query)) {
		                         $id = $row['emp_id'];
		                             ?>

								<li class="d-flex align-items-center justify-content-between">
									<div class="name-avatar d-flex align-items-center pr-2">
										<div class="avatar mr-2 flex-shrink-0">
											<img src="<?php echo $row['location']; ?>" class="border-radius-100 box-shadow" width="50" height="50" alt="">
										</div>
										<div class="txt">
											<span class="badge badge-pill badge-sm" data-bgcolor="#e7ebf5" data-color="#265ed7"><?php echo $row['Department']; ?></span>
											<div class="font-14 weight-600"><?php echo $row['FirstName'] . " " . $row['LastName']; ?></div>
											<div class="font-12 weight-500" data-color="#b2b1b6"><?php echo $row['EmailId']; ?></div>
										</div>
									</div>
									<div class="font-12 weight-500" data-color="#17a2b8"><?php echo $row['Phonenumber']; ?></div>
								</li>
								<?php }?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		
			<div class="card-box mb-40">
				<div class="pd-10">
					<h2 class="text-blue h4">LEAVE HISTORY</h2>
				</div>
				<div class="pb-20">
					<table class="data-table table stripe hover nowrap">
						<thead>
							<tr>
								<th class="table-plus">LEAVE TYPE</th>
								<th>DATE FROM</th>
								<th>DATE TO</th>
								<th>NO. OF DAYS</th>
								<th>HOD STATUS</th>
								<th>PRINCIPAL STATUS</th>
								
							</tr>
						</thead>
						<tbody>
							<tr>
								
								 <?php 
                                    $sql = "SELECT * from tblleaves where empid = '$session_id'";
                                    $query = $dbh -> prepare($sql);
                                    $query->execute();
                                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                                    $cnt=1;
                                    if($query->rowCount() > 0)
                                    {
                                    foreach($results as $result)
                                    {               ?>  

								  <td><?php echo htmlentities($result->LeaveType);?></td>
                                  <td><?php echo htmlentities($result->ToDate);?></td>
                                  <td><?php echo htmlentities($result->FromDate);?></td>
                                  <td><?php echo htmlentities($result->num_days);?></td>
                                  <td><?php $stats=$result->Status;
                                       if($stats==1){
                                        ?>
                                           <span style="color: green">Approved</span>
                                            <?php } if($stats==2)  { ?>
                                           <span style="color: red">Not Approved</span>
                                            <?php } if($stats==0)  { ?>
	                                       <span style="color: blue">Pending</span>
										   <?php } if($stats==3)  { ?>
	                                       <span style="color: black">Deleted</span>
	                                       <?php } ?>

                                    </td>
                                    <td><?php $stats=$result->admin_status;
                                       if($stats==1){
                                        ?>
                                           <span style="color: green">Approved</span>
                                            <?php } if($stats==2)  { ?>
                                           <span style="color: red">Not Approved</span>
                                            <?php } if($stats==0)  { ?>
	                                       <span style="color: blue">Pending</span>
										   <?php } if($stats==3)  { ?>
	                                       <span style="color: black">Deleted</span>
	                                       <?php } ?>

                                    </td>
								   <!-- <td>
									  <div class="table-actions">
										<a title="VIEW" href="view_leave.php?edit=<?php echo htmlentities($result->id);?>" data-color="#265ed7"><i class="icon-copy dw dw-eye"></i></a>
									  </div>
								   </td> -->
							</tr>
							<?php $cnt++;} }?>  
						</tbody>
					</table>
			   </div>
			</div>
			
<br><br><br>
			<div class="card-box mb-40">
				<div class="pd-10">
					<h2 class="text-blue h4">LEAVE TRACKING</h2>

				</div>
				<div class="pb-20"><div class="tab-pane fade show active" id="timeline" role="tabpanel">
											<div class="pd-20">
												<div class="profile-timeline">
													<?php $query= mysqli_query($conn,"SELECT * from tblleaves where empid = '$session_id'")or die(mysqli_error());
																while ($row = mysqli_fetch_array($query)) {
		                        								$id = $row['id'];
															?>
													<div class="timeline-month">
														<h5><?php echo date('d M Y', strtotime($row['PostingDate'])); ?></h5>
													</div>
													<div class="profile-timeline-list">
														<ul>
															
															<li>
																<div class="date"><?php echo $row['num_days']; ?> Days</div>
																<div class="task-name"><i class="ion-ios-chatboxes"></i><?php echo $row['LeaveType']; ?></div>
																<p><?php echo $row['Description']; ?></p>

																<div class="task-time">
																	<?php $stats=$row['Status'];
								                                       if($stats==1){
								                                        ?>
								                                           <span style="color: green">Approved</span>
								                                            <?php } if($stats==2)  { ?>
								                                           <span style="color: red">Not Approved</span>
								                                            <?php } if($stats==0)  { ?>
									                                       <span style="color: blue">Pending</span>
									                                <?php } ?>
																</div>

															</li>
															
															
														</ul>
													</div>
												<?php }?>
												</div>
											</div>
										</div>
					
			   </div>
			</div><br>
			

			<?php include('includes/footer.php'); ?>
		</div>
	</div>
	<!-- js -->

	<?php include('includes/scripts.php')?>
</body>
</html>