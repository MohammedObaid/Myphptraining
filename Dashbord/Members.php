<?php

session_start();

/*
 STEP1 This to check if user is login in web site ,Than include main component for web site
*/

if(isset($_SESSION['UserName']))
{
	$pageTitle='Members';
	include 'init.php';

		$event=isset($_GET['event'])?$_GET['event']:"Manage";
		if(isset($event)){





		if($event=='Manage')
		{
			/*
		STEP2  PageOne -->( Manage Member pagetHere) Make Component for this page
		*/

		$stm=$con->prepare('select * from  users  Where GroupId=1');

		$stm->execute();
		$rows=$stm->fetchAll();

		if($stm->rowCount()>=1){
	?>
		
		<h1 class="text-center"><span class="subtitle">Manage Mamber</span></h1>

		<div class="container">
	
		 <div class="table-responsive">
			<table class="table-main table text-center table-bordered">
				<tr>
				<td>ID</td>
				<td>User Name</td>
				<td>Email</td>
				<td>Full Name</td>
				<td>Register Data</td>
				<td>Register Date</td>
				<td>Control</td>

				</tr>
			
				<?php
			       foreach($rows as $row)
						{
				echo "<tr>";
					echo "<td>".$row['Id']."</td>";
					echo "<td>".$row['UserName']."</td>";
					echo "<td>".$row['Email']."</td>";
					echo "<td>".$row['FullName']."</td>";
					echo "<td>".$row['RegisterStates']."</td>";
					echo "<td>".$row['DateRegister']."</td>";
					echo "
					<td>
				  <a href='Members.php?event=Edite&id=".$row['Id']."' class='btn btn-success sitebtnthem'>Edite</a>
						<a href='Members.php?event=Delete&id=".$row['Id']."' class='btn btn-danger sitebtnthem confirm'>Delete</a>
					</td>
					";
			echo "</tr>";
						}




				?>
			
					
					
			
			
			</table>

		</div>
		 <a href='Members.php?event=Add' class="btn btn-primary sitebtnthem"><i class="fa fa-plus"></i>
		 	Add Member</a>
	</div>

		
		

	<?php   }

		else{

		echo ' <a href="Members.php?event=Add" class="btn btn-primary sitebtnthem"><i class="fa fa-plus"></i>
		 	Add Member</a>';
		}
		}

		elseif($event=='Add')
		{
			/*
		STEP2  PageOne -->( Add Member pagetHere) Make Component for this page
		*/

		?>

		<h1 class="text-center"><span class="subtitle">Edit Profile</span></h1>

					<div class="updateform container">
						<form class="form-horizontal" action="?event=InsertNewMember" method="POST">
						<!-- Start User Name Filed input -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 col-sm-offset-2 control-label">User Name</label>
								<div class="col-sm-10  col-md-4 ">
									<input class="form-control" type="text" name="userName" autocomplete="off" required="required" />
									
								</div>
							</div>
						<!-- End User Name Filed input -->

						<!-- Start  Password Filed input -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 col-sm-offset-2 control-label">Password</label>
								<div class="col-sm-10 col-md-4">
									<input class="form-control" type="password" name="Password" autocomplete="new-password" required="required" />
									<!-- <i class="show-pass fa fa-eye fa-2x"></i> -->
								</div>
							</div>
						<!-- End Password  Filed input -->

						<!-- Start  Fullname Filed input -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 col-sm-offset-2 control-label">Full Name</label>
								<div class="col-sm-10 col-md-4">
									<input class="form-control" type="text" name="fullName" autocomplete="off"  required="required"/>
								</div>
							</div>
						<!-- End Fullname  Filed input -->

						<!-- Start  Email Filed input -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 col-sm-offset-2  control-label">Email</label>
								<div class="col-sm-10 col-md-4">
									<input class="form-control" required="required" type="email" name="email" autocomplete="off"  required="required"/>
								</div>
							</div>
						<!-- End Email  Filed input -->
						<!-- Start  Submit Filed input -->
							<div class="form-group ">
								
								<div class="col-sm-offset-4 col-sm-10">
									<input class="btn btn-primary btn-lg" type="submit" value="Add Member"  />
								</div>
							</div>
						<!-- End Submit  Filed input -->

						</form>
					</div>

			<?php

		}
		elseif($event=='InsertNewMember')
		{
			/*
		STEP2  PageOne -->( InsertNewMember Member pagetHere) Make Component for this page
		*/

				if($_SERVER['REQUEST_METHOD']=='POST'){
				
				$userName=$_POST['userName'];
				$email=$_POST['email'];
				$fullName=$_POST['fullName'];
				$pass= sha1($_POST['Password']);

				// echo  $userName.' '.$fullName.' '.$email.'  '.$pass;

			

			$ErrorAr=array();
					if(empty($userName))
					{
						$ErrorAr[]='<div class="alert alert-danger">User Name Cant Be <strong>Empty</strong></div>';
					}
					if(empty($email))
					{
						$ErrorAr[]='<div class="alert alert-danger">User Email Cant Be <strong>Empty</strong></div>';
					}
					if(empty($fullName))
					{
						$ErrorAr[]='<div class="alert alert-danger">User Full Name Cant Be <strong>Empty</strong></div>';
					}
					if(!empty($_POST['Password'])&&$_POST['Password']<8)
					{
						$ErrorAr[]='<div class="alert alert-danger">Password Must Be  <strong>More Than 8 Charaters</strong></div>';
					}
					if(empty($ErrorAr)){

					try {
					$stm=$con->prepare("Insert  into users (UserName,FullName,Password,Email) values (?,?,?,?)");
					$stm->execute(array($userName,$fullName,$pass,$email));
					$count=$stm->rowCount();
					} catch(PDOException $err) {

						    // test case only.  do not echo sql errors to end users.
						   if( $err->getCode( )=='23000')
						   {

						   		echo ' </br><div class="container">';
							echo '<div class="alert alert-danger  ">Usre Name Used By Anthor Member</strong></div>';
							echo '</div>';
						   }
					



						}
						if($count>0){
							echo ' </br><div class="container">';
							echo '<div class="alert alert-success  ">Number Insert Members  <strong>'.$count.'</strong></div>';
							echo '</div>';
							}
					

			

					}
					else{
						echo '</br><div class="container">';
					foreach ($ErrorAr as $e) {

						echo $e ;
						
					}
					echo '</div>';
				}

			}///////////

			else{
					echo'<h1 class="text-center"><span class="subtitle">This Paget Not Available
					</span></h1>';

			}

			}
		elseif($event=='Edite'){  
		/*
		STEP2  PageOne -->( Edite Member pagetHere) Make Component for this page
		*/
		$userid=(isset($_GET['id'])&&is_numeric($_GET['id']))?intval($_GET['id']):0;
				$stm=$con->prepare("select 	* from users Where Id=? limit 1");
					$stm->execute(array($userid));
					$row=$stm->fetch();
					

		if($stm->rowCount()>0){  //&&$_SESSION['UserId']==$userid
		?>

		<h1 class="text-center"><span class="subtitle">Edit Profile</span></h1>

					<div class="updateform container">
						<form class="form-horizontal" action="?event=UpdateMember" method="POST">
						<!-- Start User Name Filed input -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 col-sm-offset-2 control-label">User Name</label>
								<div class="col-sm-10  col-md-4 ">
									<input class="form-control" value="<?php echo $row['UserName'];?>" type="text" name="userName" autocomplete="off" required="required" />
									<input type="hidden" name="userid" value="<?php echo $userid;?>">
								</div>
							</div>
						<!-- End User Name Filed input -->

						<!-- Start  Password Filed input -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 col-sm-offset-2 control-label">Password</label>
								<div class="col-sm-10 col-md-4">
									<input  type="hidden" name="oldPassword" value="<?php echo $row['Password'];?>" />
									<input class="form-control" type="password" name="newPassword" autocomplete="new-password" />
								</div>
							</div>
						<!-- End Password  Filed input -->

						<!-- Start  Fullname Filed input -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 col-sm-offset-2 control-label">Full Name</label>
								<div class="col-sm-10 col-md-4">
									<input class="form-control" value="<?php echo $row['FullName'];?>" type="text" name="fullName" autocomplete="off"  required="required"/>
								</div>
							</div>
						<!-- End Fullname  Filed input -->

						<!-- Start  Email Filed input -->
							<div class="form-group form-group-lg">
								<label class="col-sm-2 col-sm-offset-2  control-label">Email</label>
								<div class="col-sm-10 col-md-4">
									<input class="form-control" value="<?php echo $row['Email'];?>" type="email" name="email" autocomplete="off"  required="required"/>
								</div>
							</div>
						<!-- End Email  Filed input -->
						<!-- Start  Submit Filed input -->
							<div class="form-group ">
								
								<div class="col-sm-offset-4 col-sm-10">
									<input class="btn btn-primary btn-lg" type="submit" value="Save"  />
								</div>
							</div>
						<!-- End Submit  Filed input -->

						</form>
					</div>

			<?php	}
			else{
					echo'<h1 class="text-center"><span class="subtitle">This Information Is Not available For This User
					</span></h1>';

			}

		}

			elseif($event=='UpdateMember')
			{
						/*
		STEP2  PageOne -->( Update Member Member pagetHere) Make Component for this page
		*/


			if($_SERVER['REQUEST_METHOD']=='POST'){
				$userid=$_POST['userid'];
				$userName=$_POST['userName'];
				$email=$_POST['email'];
				$fullName=$_POST['fullName'];
				$pass= empty($_POST['newPassword']) ? $_POST['oldPassword'] : sha1($_POST['newPassword']);

				// echo $userid  .' '.$userName.' '.$fullName.' '.$email;

			

			$ErrorAr=array();
					if(empty($userName))
					{
						$ErrorAr[]='<div class="alert alert-danger">User Name Cant Be <strong>Empty</strong></div>';
					}
					if(empty($email))
					{
						$ErrorAr[]='<div class="alert alert-danger">User Email Cant Be <strong>Empty</strong></div>';
					}
					if(empty($fullName))
					{
						$ErrorAr[]='<div class="alert alert-danger">User Full Name Cant Be <strong>Empty</strong></div>';
					}
					if(!empty($_POST['newPassword'])&&strlen($_POST['newPassword']<8))
					{
						$ErrorAr[]='<div class="alert alert-danger">Password Must Be  <strong>More Than 8 Charaters</strong></div>';
					}
					if(empty($ErrorAr)){

					$stm=$con->prepare("update users	SET UserName=?,FullName= ?, Password= ? ,Email= ?  Where Id= ? ");
					$stm->execute(array($userName,$fullName,$pass,$email,$userid));
					$count=$stm->rowCount();
				echo ' </br><div class="container">';
					echo '<div class="alert alert-success  ">Number Updated Members  <strong>'.$count.'</strong></div>';
						echo '</div>';

			

					}
					else{
						echo '</br><div class="container">';
					foreach ($ErrorAr as $e) {

						echo $e ;
						
					}
					echo '</div>';
				}

			}///////////

			else{
					echo'<h1 class="text-center"><span class="subtitle">This Paget Not Available
					</span></h1>';

			}

		}


		elseif ($event=="Delete") {


				/*
		STEP2  PageOne -->( Edite Member pagetHere) Make Component for this page
		*/
		$userid=(isset($_GET['id'])&&is_numeric($_GET['id']))?intval($_GET['id']):0;
				$stm=$con->prepare("select 	* from users Where Id=? limit 1");
					$stm->execute(array($userid));
					$row=$stm->fetch();
					

		if($stm->rowCount()>0){  //&&$_SESSION['UserId']==$userid

		$stm=$con->prepare("delete from users where Id=?");
		$stm->execute(array($userid));
		$count=$stm->rowCount();
		echo ' </br><div class="container">';
					echo '<div class="alert alert-success  ">Number Delete Members  <strong>'.$count.'</strong></div>';
						echo '</div>';


			}
		else{
			echo ' </br><div class="container">';
					echo'<h1 class="text-center"><span class="subtitle">This Information Is Not available For This User
					</span></h1>';
					echo '</div>';

			}
		}


}



	include $template."footer.php";
}
else
{
/*
STEP3 If user does not login in website redirect him to login paget
*/
	header('location:login.php');
		exit();
}







?>