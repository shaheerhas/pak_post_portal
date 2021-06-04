<html>
<head>
<link href="ppost.css" rel="stylesheet" type="text/css" />
</head>
<title>Reports</title>
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
PPost Branch Yearly Funds Collection 
</div>
<hr  size="2px"/>

<div style="font-size: 20px;margin-left: 50px;">

<form name="reportForm" action="" method="post">
<div style="float:left;" >
Year :
<input type="text" name="year" placeholder="2017" required class="widthofboxReport">
</div>
<div style="float:right; margin-right:40%; " >
DeptID :
<input type="text" name="dept" placeholder="20" required class="widthofboxReport">
</div>

<div style="clear:both; " >

<input type="submit" value="Generate"  name="reportSubmit" class="widthofboxReport" style="font-size:18px;padding: 0;margin-top: 20px;">

</div>


</form>

<div style="clear: both"><br></div>
<?php
  if(isset($_POST["reportSubmit"])){
   $totalamount =0;
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
        else
        {
          $saal = $_POST["year"];
          $deptid = $_POST["dept"];
          $q= "SELECT * from dept where D_id =$deptid";  
          $a = oci_parse($con, $q);
          $r = oci_execute($a);
          $r =oci_fetch_array($a,OCI_BOTH+OCI_RETURN_NULLS);
          $mgid = $r['MGR_ID'];
          $q1 = "SELECT * from staff where S_id =$mgid";
          $a1 = oci_parse($con, $q1);
          $r1 = oci_execute($a1);
          $r1 =oci_fetch_array($a1,OCI_BOTH+OCI_RETURN_NULLS);

        
      
?>

<div style="float: left;">Branch Name: <?php echo $r['ST_ADDRESS']?> 
</div>

<div style="float:right;margin-right: 52%">Mgr Name :  
  
  <?php 
  
  echo $r1['S_FNAME'] . " " ;
  echo $r1['S_LNAME'];
  
  ?>

</div>

<div style="clear: both;margin-top:60px;">   
                      
<table  style="border:solid;border-color: black;width: 80%;font-size: 20px;">
                           
        <tr> 
         <td width="10%" ">
           No. of Collections</td>
         <td width="20%" style="">
           Month</td>
       
         <td width="25%" style="">
           Amount Collected</td>
       
         <td width="25%" style="">
           Amount Returned</td>
         <td width="20%" style="padding:10px;">
           NetAmount</td>                  
       </tr>
            
<?php 


        $q2="SELECT COUNT(*),extract(month from o_timedate),sum(amountcollected),sum(amountreturned) from O_invoice where D_id = $deptid
		AND extract(year from o_timedate) = $saal group by extract(month from o_timedate)";
        $a2 = oci_parse($con, $q2);
        $r2 = oci_execute($a2);
        /*
        $numCollection = r2['COUNT(*)'];
        $mon = r2['Month'];
        $q3 = "SELECT SUM(charges)  "Month" from O_invoice  where D_id = $deptid AND extract(year from o_timedate) = $saal group by extract(month from o_timedate)";
        $a3 = oci_parse($con, $q3);
        $r3 = oci_execute($a3);
        $AmountCollected = r2['SUM(CHARGES)'];*/
        while ($r2 =oci_fetch_array($a2,OCI_BOTH+OCI_RETURN_NULLS))
    { 
?>


        <tr> 
       
        <td width="10%" style="padding:10px;">
        <?php  echo $r2[0]; 
		
		?>
        </td>
        
        <td width="20%" style="padding:10px;padding-right: 0px;">
        <?php  echo $r2[1]; ?>
        
        </td>
        
        <td width="25%" style="padding:10px;padding-left: 5px;">
                 <?php  echo $r2['SUM(AMOUNTCOLLECTED)']; ?>

        </td>
        <td width="25%" style="padding:10px;padding-left: 2px">
         <?php  echo $r2['SUM(AMOUNTRETURNED)']; ?>
        </td>
        
        <td width="20%" style="padding:10px;">
			
			<?php 
			
		    $totalamount += ($r2[2]-$r2[3]);
			echo ($r2[2]-$r2[3]); 
			
			?>

        </td>
       


       </tr>

      <?php   } ?>

         <tr>
          <td width="25%" style="padding:10px;padding-left: 5px;font-size:30px;">Total :</td>
          <td> <?php echo $totalamount ?></td>
          <td></td>
          <td></td>



         </tr>



        </table>
                   
                            
   </div>   

  <?php }} ?>

  </div>

</div>


</body>
</html>

