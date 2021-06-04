<html>
  <head><title>Confirm</title></head>
  <body><br><br><br>
   <table>
   <form name="reg" action="" method="post">
     <tr>
       <td><label>Enter  id</label></td>
       <td><input type="text" name="id" value=""></td> 
     </tr>
<tr>
       <td></td> 
       <td><input type="submit" name ="submit"></td>
     </tr> 
    </form>
   </table>


<?php
    if (isset($_POST['submit']))
     {echo "ok";
     $db_sid = "(DESCRIPTION = (ADDRESS_LIST = (ADDRESS = (PROTOCOL = TCP)(HOST = pc1)(PORT = 1521)) ) (CONNECT_DATA = (SID = orcl) ) )"; 
     $db_user = "scott"; 
     $db_pass = "tiger";
     
      $con = oci_connect($db_user,$db_pass); 
      if($con) 
      { 
       echo "Oracle Connection Successful.";
        
      } 
   else 
      { die('Could not connect to Oracle: '); 
      }
    
      $a=$_POST['id'];
     
     $query=" select * from patient where patient_id='$a'";

     $a = oci_parse($con, $query); 

     $run = oci_execute($a);
echo "<br><br><br>";?>
<table border ="true"> 
<?php
while($row = oci_fetch_array($a, OCI_BOTH+OCI_RETURN_NULLS))  //parse or execute for update, insert
      	  {?>
<tr>
        	    <td>   <?php  echo $row[0]."	"; ?></td>
                    <td>   <?php  echo $row[1]."	";  ?></td>
                     <td>  <?php  echo $row[2]."	";  ?></td>
                     <td>  <?php  echo $row[3]." ";  ?></td>
</tr>     
<?php		  }

  






}
//else
//{echo "nooo";}                  
?>   
</table>



  </body>
</html>