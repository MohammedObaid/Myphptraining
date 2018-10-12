<?php 
session_start();
if(isset($_SESSION['UserName']))
{
	header('location:Dashbord.php');
		exit();
}
$noNavBar='';
$pageTitle='Login';
include 'init.php';



//////Check method if  is post//////////////////
if($_SERVER['REQUEST_METHOD']=='POST')
{
	$name=$_POST['username'];
	$password=$_POST['password'];
	$hashpassword=sha1($_POST['password']);

	// echo $name .'  '. $hashpassword;

	//////Check User Exist In DB //////////////////
	$stm=$con->prepare("select 	Id,FullName,UserName , Password from users Where UserName=? And Password=? And 	GroupId=1 limit 1");
	$stm->execute(array($name,$hashpassword));
	$count=$stm->rowCount();
	if($count>=1)
	{

		$row=$stm->fetch();

		$_SESSION['UserId']=$row['Id'];
		$_SESSION['UserNameFull']=$row['FullName'];
		$_SESSION['UserName']=$name;

		header('location:Dashbord.php');
		exit();
	}


}

?>


<form class="login" action="<?php echo $_SERVER['PHP_SELF']  ?>"  method="POST">
			<h3 class="text-center"> Login Page</h3>
		<input class="form-control" type="text" placeholder="User Name" name="username" autocomplete="off">
		<input class="form-control" type="password" placeholder="Password" name="password" autocomplete="new-password">
		<input class="btn btn-primary btn-block"  type="submit" value="Login">

</form>


<?php 
include "includes/template/footer.php";
?>