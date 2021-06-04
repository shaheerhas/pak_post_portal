<html>
<head>
<link href="ppost.css" rel="stylesheet" type="text/css" />
</head>
<title>Customer Transactions</title>
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


<div style="font-size:40px; font-family:Arial, Helvetica, sans-serif; text-align:center; color:#CC0000; margin-top:20px;">

PPost Customer Transactions 

</div>

<hr  size="2px"/>

<div style="font-size: 20px;margin-left: 50px;">

<form name="CustForm" action="" method="post">
<div style="float:left; margin-bottom:20px; " >
CustID :
<input type="text" name="custID" placeholder="20" required class="widthofboxReport">
</div>
<div style="float: left;margin-left:30;">
<input type="submit" value="Track"  name="custSubmit" class="widthofboxReport" style="width: 100px;font-size: 20px;padding: 0px;">
</div>
</form>
<div style="clear: both"><br></div>


      <?php
      if(isset($_POST['custSubmit']))
      {

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

        $cusID=$_POST['custID'];
        $q="select * from customer where c_id=$cusID";
        $a = oci_parse($con, $q);
        $r = oci_execute($a);
		$r=oci_fetch_array($a,OCI_BOTH+OCI_RETURN_NULLS);


      ?>


<div style="float: left;">Customer Name: <?php echo $r['C_FNAME']." ".$r['C_LNAME'];?>
</div>

<div style="float: right;margin-right: 50%">Customer ID: <?php echo $r['C_ID'];?>

</div>
<div style="clear: both"><br></div>

<div style="float: left;">Address: <?php echo $r['ADDRESS'] ;?>
</div>
<div style="float: right;margin-right: 50%">&nbsp;City: <?php echo $r['CITY'] ;?>
</div>

<div style="clear: both"><br></div>
<div style="float: left;">Mobile#: <?php echo $r['PHONENO'] ;?></div>
<div style="float: right;margin-right: 50%">CNIC: <?php echo $r['CNIC'] ;?></div>
<div style="clear:both;margin-left: 40%;font-size: 26;">
<br>
Parcel Information</div>

<div style="clear: both;margin-top:20px;">   
                      
<table  style="width: 95%;border:solid;border-color: black;">
                           
        <tr style="font-size: 20;"> 
         <td width="10%" style="padding:5px;">
           Tracking Number</td>
         <td width="15%" style="padding:10px;">
           ReceipentName
         </td>
         <td width="15%" style="padding:10px;">
           RecAddress</td>
         <td width="10%" style="padding:10px;">
           City</td>
         <td width="15%" style="padding:10px;">
           Status</td>
         <td width="10%" style="padding:10px;padding-left: 0px">
           Date</td>
       
       </tr>
                      <?php

              $q1="select * from Parcel where cust_id=$cusID" ;
              $a1 = oci_parse($con, $q1);
              $r1 = oci_execute($a1);
              while($r1=oci_fetch_array($a1,OCI_BOTH+OCI_RETURN_NULLS))
              {
                
            ?>
                
         <tr>
         	<td><?php echo $r1['TRACKING_NO'] ;?></td>
          <td><?php echo $r1['RECIPIENT_NAME'] ;?></td>
          <td><?php echo $r1['RST_ADD'] ;?></td>
          <td><?php echo $r1['RCITY'] ;?></td>
        
	<?php	
	$track = $r1['TRACKING_NO'];
	$q6="select * from t_history where tracking_no=$track and sno=(select max(sno) from t_history where tracking_no=$track) ";
				$a6 = oci_parse($con, $q6);
				$r6 = oci_execute($a6);
				$r6 =oci_fetch_array($a6,OCI_BOTH+OCI_RETURN_NULLS);
			  
?>


		<td><?php echo $r6['STATUS'] ;?></td>
             
            <?php $trNo=$r1['TRACKING_NO']; 
              $q2="select o_timedate from o_invoice where Tracking_no=$trNo"; 
              $a2 = oci_parse($con, $q2);
              $r2 = oci_execute($a2);
			  $r2=oci_fetch_array($a2,OCI_BOTH+OCI_RETURN_NULLS);
              ?>  
          <td><?php echo $r2[0];  ?></td>
         </tr>

         <?php } ?> 
        
        </table>                           
</div>   

<?php  }} ?>


</div>

</body>

</html>