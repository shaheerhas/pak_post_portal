<html>
<head>
<link href="ppost.css" rel="stylesheet" type="text/css" />
</head>
<title>Pakistan Post</title>
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

<div class="float homeinfo" >
	<font style="color:#000000; font-size:60px;">
		We Move  You <br>
</font>
<font style="color:#000000; font-size:18px;"> Safe & Fast Service </font>

</div>

<div class="float trackform" >

<form method="Post" name="signinform" action="">

<input type="text"  name="trackingID" placeholder="Enter Tracking Number" size="10" / class="widthofboxsignin" required><br />
<input type="submit" value="Track Your Parcel"  class="widthofboxsignin" name="trackP" />

</form>
</div>
<div style="clear: both">
<br>
<br>
<br>
<br>

</div>

<?php 



if(isset($_POST["trackP"])){
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
			  if($con==0) 
				{	
					die("Oracle Connection unsuccessful.");
			  	}
				else{
			   //for getting details from parcel table
			    $track=$_POST["trackingID"];
				$q="select * from parcel where tracking_no=$track ";
				$a = oci_parse($con, $q);
				$r1 = oci_execute($a);
				$r1 =oci_fetch_array($a,OCI_BOTH+OCI_RETURN_NULLS);
				//for getting data from trackingHistory Table 
				
				$q6="select * from t_history where tracking_no=$track and sno=(select max(sno) from t_history where tracking_no=$track) ";
				$a6 = oci_parse($con, $q6);
				$r6 = oci_execute($a6);
				$r6 =oci_fetch_array($a6,OCI_BOTH+OCI_RETURN_NULLS);
				 
				
} ?>

<div style="float: left; margin-left: 100px;">
				<p> Tracking No : <?php  echo $track; ?>   </p>
				<h2> Shipment Detail:</h2>
<?php           $q1="select * from o_invoice where tracking_no=$track";
				$a1 = oci_parse($con, $q1);
				$r2 = oci_execute($a1);
				$r2 =oci_fetch_array($a1,OCI_BOTH+OCI_RETURN_NULLS);	

					echo "Agent Reference Number:" ;  echo $r2['S_ID']; ?> <br>
<?php $q2="select * from customer where c_id =(select cust_id from parcel where tracking_no=$track)";
				$a2 = oci_parse($con, $q2);
				$r3 = oci_execute($a2);
				$r3 =oci_fetch_array($a2,OCI_BOTH+OCI_RETURN_NULLS); ?>

					Origin: <?php  echo $r3['CITY'];	?><br>
					Destination: <?php echo $r1['RCITY']; ?><br>
					Booking Date:<?php echo $r2['O_TIMEDATE'];?>  <br>
</div>


<div style="float:right;" id="parcelSummaryTable">
			<h4>Shipment Tracking Summary :</h4>
			Current Status : <?php echo $r6['STATUS']; ?>

			<br>
</div>

<div style="clear: both"></div>

<div style="margin-top: 20px;margin-left: 100px; border-style: solid; border-color: black;width: 75%;">
	<table>
	<tr>
		<td width="33%" style="padding-left:10px;">
			Date & Time 
		</td>
		<td width="33%" style="padding-left:10px;" >
			Status
		</td>
		<td style="padding-left:10px;">Location</td>
	</tr>	

	<tr>
		<?php
		$q3="select * from T_history where tracking_no =$track";
		$a3 = oci_parse($con, $q3);
		$r4 = oci_execute($a3);
		


		  while($r4 =oci_fetch_array($a3,OCI_BOTH+OCI_RETURN_NULLS)) { ?>

		<td width="33%" style="padding-left:10px;" ><?php echo $r4['TIME_DATE']; ?></td>
		<td width="33%" style="padding-left:10px;"> <?php echo $r4['STATUS']; ?></td>
		<td style="padding-left:10px;"> <?php echo $r4['LOCATION']; ?></td>
	
	</tr>		
<?php } ?>
	</table>


</div>


</div>


<?php } ?>
</body></html>