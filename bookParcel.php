<html>
<head>
<link href="ppost.css" rel="stylesheet" type="text/css" />
</head>
<title>Book Parcel</title>
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


</div>


<div id="bookbody">

<div style="font-size:56px; font-family:Arial, Helvetica, sans-serif; text-align:center; color:#CC0000; margin-top:20px;">
Booking Of Parcel 
</div>
<hr  size="2px"/>
<div style="margin-top:30px;">


<form method="post" name="bookform" action="">
<div style="float:left;">
Customer ID :&nbsp;&nbsp;&nbsp;&nbsp;

<input type="text"  name="custID"   placeholder="12345" class="boxBooking" required />
</div>

<div style="clear: both;"></div>

<div style="float:left;">
Recipent Name:
<input type="text"  name="rec_name"   placeholder="Shaheera G" class="boxBooking" />
</div>

<div style="float:left; margin-left: 10%;">
Recipent Address:
<input type="text"  name="recAddress"   placeholder="St xyz, I-9/4 " class="boxBooking" required />
</div>

<div style="float:left;margin-left: 5%">
Recipent City :
<input type="text"  name="recCity"   placeholder="Rawalpindi" class="boxBooking" required />
</div>

<div style="clear: both;"> <br>
</div>

	<div style="float:left;">                Weight(Grams):
	<input type="text"  name="Weight"   placeholder="10" 
	style="border:solid #600; border-radius:4px;padding: 10px;margin-top: 10;width:100px" required />
	</div>
	
	<div style="float:left;margin-left: 22%">StampID : 

	<input type="text"  name="stampID"   placeholder="123" 
	style="border:solid #600; border-radius:4px;padding: 10px;margin-top: 10;width:100px" required />
	</div>
	<div style="float:left;margin-left: 13%">InsuranceID :
	<input type="text"  name="InsID"   placeholder="111" 
	style="border:solid #600; border-radius:4px;padding: 10px;margin-top: 10;width:100px" required />
	</div>


<div style="clear: both;"> <br>
</div>


	<div style="float:left;">MailType : 

	<input type="text"  name="mailType"   placeholder="07" 
	style="border:solid #600; border-radius:4px;padding: 10px;margin-top: 10;width:100px;margin-left: 40px;" required />

	</div>
	<div style="float:left;margin-left: 18%"> Worth(Rupees) &nbsp;: 
	<input type="text"  name="pWorth"   placeholder="3000" 
	style="border:solid #600; border-radius:4px;padding: 10px;margin-top: 10;width:100px" required />

	</div>

<div style="clear: both;"> <br>
</div>


Parcel Status : &nbsp;   <input type="text" name="status"   placeholder="Delivered" class="boxBooking"/>
<br>


<input type="submit" value="Book Parcel" name="Join" class="boxBooking" style="font-size : 20px; padding:10;margin-top: 20px" />


</form>

<?php 
if(isset($_POST["Join"])){
 $db_sid = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = Valeed-PC)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = valeed)
    )
  )
";
        $db_user = "Scott"; 
       $db_pass = "tiger";
       
        $con = oci_connect($db_user,$db_pass,$db_sid);  
			  $con = oci_connect($db_user,$db_pass,$db_sid); 
			  if($con==0) 
				{	

					die("Oracle Connection unsuccessful.");
			  	}
			  	
$v1 = $_POST["custID"];

$q="select * from customer where c_id=$v1";
$a = oci_parse($con, $q);
$r = oci_execute($a);
$r =oci_fetch_array($a,OCI_BOTH+OCI_RETURN_NULLS);


$v2 =  $_POST["status"];
$v3 = $_POST["rec_name"];
$v4 = $_POST["recCity"];
$v5 = $_POST["recAddress"];
$v6 = $_POST["pWorth"];
$v7 = $_POST["Weight"];
$v8 = $_POST["InsID"];
$v9 = $_POST["mailType"];
$v10 = $_POST["stampID"];

/*
if( $r[0] == $_POST['custID'] ) {
	$q1="insert into parcel(tracking_no,cust_id,status,recipient_name,rcity,rst_add,pworth,weight,ins_id,m_id,st_id) values ( 
	'track_no.nextval','$v1','$v2','$v3','$v4','$v5','$v6','$v7','$v8','$v9','$v10')" ;}
else{
$q1="insert into parcel(tracking_no,cust_id,status,recipient_name,rcity,rst_add,pworth,weight,ins_id,m_id,st_id) values ( 
	'track_no.nextval','cust_id.nextval','$v2','$v3','$v4','$v5','$v6','$v7','$v8','$v9','$v10')";
}*/

$q1="insert into parcel(track_no,cust_id,status,recipient_name,rcity,rst_add,pworth,weight,ins_id,m_id,st_id) values ( 2
	,'$v1','$v2','$v3','$v4','$v5',$v6,$v7,$v8,$v9,$v10)";

$a1 = oci_parse($con, $q1);
$r1 = oci_execute($a1);

$q4 = "commit";
$a3 = oci_parse($con, $q4);
$r3 = oci_execute($a3);



}
?>



</div>
 

</body>


</html>