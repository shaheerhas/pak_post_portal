<html>
<head>
<link href="ppost.css" rel="stylesheet" type="text/css" />
</head>
<title>Sign Up</title>
<body>

<div id="menubar">

<div id="icon" class=" float text">
<a href="home_ppost.php"> 
<img src="pp.jpg" height="50px" />
</a>
</div>

<div id="track" class="float textbooking" style="padding-top: 0;">
<ul type="none">
<a href="customerTransactions.php"> 
<li>Track Your &nbsp;&nbsp;Parcels</li> </a>
</div>

<div id="info" class="float textbooking" >
<ul class="listdecoration">
<li style="padding-left: 20px;"><a href="bookParcel.php">BookParcel</a></li>
<li style="padding-left: 20px;"><a href="getReport.php">Reports</a></li>
</ul>
</div>
<div id="member" class="textmember float" style="padding-top:22px; text-align:right;">
<a href="signup.php">SignUp</a>
</div>


</div>



<div id="homebody">
<div style="font-size:56px; font-family:Arial, Helvetica, sans-serif; text-align:center; color:#CC0000; margin-top:20px;">
Register On PPost 
</div>

<div style="font-size:20px; font-family:Arial, Helvetica, sans-serif; text-align:center;">We've made it easier than ever to keep Track of all your parcels. <br />
Join For Safe and Fast Sending of Parcels.

</div>



<hr  size="2px"/>

<div style="margin-top:30px;margin-left:35%;">
<form method="post" name="signupform">
<input type="text"  name="fname"   placeholder="First Name" class="widthofboxsignup" required />
<input type="text"  name="lname"   placeholder="Last Name" class="widthofboxsignup" required />
</div>
<div style="margin-left:35%;font-size: 20">
Gender
<input type="radio" value="male" name="gender">Male</input>
<input type="radio" value="female" name="gender">Female</input>
<input type="radio" value="other" name="gender">Other</input>
<br>
CNIC  :&nbsp;&nbsp;&nbsp;&nbsp;   <input type="text" name="cnic"   placeholder="0000000000000" class="widthofboxsignup"/>
<br>
Email : &nbsp;&nbsp;&nbsp;&nbsp;<input type="email"  name="email"   placeholder="xyz@mail.com" class="widthofboxsignup" />
<br>
Phone : &nbsp;&nbsp; <input type="text"  name="phoneNumber"   placeholder="0000-0000000 " class="widthofboxsignup" />
<br>
Address : 
<input type="text"  name="Address"   placeholder="Street#3 I-8 " class="widthofboxsignup" />
<br>
City  : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="text" name="City"   placeholder="Rawalpindi " class="widthofboxsignup" />
<br>
<input type="submit" value="Sign Up" name="Join" class="widthofboxsignup" style="font-size : 20px; padding:0;"/></b>
</form>
</div>



</body>

</html>

<?php 



if(isset($_POST["Join"])){
   
    $db_sid = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = Valeed-PC)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = valeed)
    )
  )";

     		$db_user = "scott"; 
			 $db_pass = "tiger";		 
			  $con = oci_connect($db_user,$db_pass,$db_sid); 
			  if($con==0) 
				{	
					die("Oracle Connection unsuccessful.");
			  	}
				else{
					
					$namef = $_POST["fname"];
					$namel = $_POST["lname"];		
					$idcard = $_POST["cnic"];
					$mail = $_POST["email"];
					$phone = $_POST["phoneNumber"];
					$add = $_POST["Address"];
					$city = $_POST["City"];
					
		$q="INSERT INTO customer (C_id,C_fname,C_lname,CNIC,address,city,phoneNo,email)VALUES (cust_id.nextval,'$namef','$namel','$idcard' , '$add' , '$city','$phone',
					'$mail')";
					$a = oci_parse($con, $q);
					$r1 = oci_execute($a);
					//$r1 =oci_fetch_array($a,OCI_BOTH+OCI_RETURN_NULLS);
					$q1="commit";
					$a1 = oci_parse($con, $q1);
					$r2 = oci_execute($a);
					
					}
}
?>