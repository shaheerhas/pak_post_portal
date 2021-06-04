<html>
  <head><title>Confirm</title></head>
  <body><br><br><br>

   
   <?php
    //if (isset($_POST['submit']))
     //{
     $db_sid = "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = SHAHEER.Home)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = orcl.Home)
    )
  )"; 
     $db_user = "admin"; 
     $db_pass = "hospital";
     
      $con = oci_connect($db_user,$db_pass,$db_sid); 
      if($con) 
      { 
       echo "Oracle Connection Successful.";
        
      } 
   else 
      { die('Could not connect to Oracle: '); 
      }
    
      $a=$_POST['id'];
      $b=$_POST['fname'];
      $c=$_POST['lname'];
      $d=$_POST['add'];
      $e=$_POST['city'];;
     $query=" INSERT INTO Patient (Patient_ID,  LastName, FirstName,Address ,City)
 VALUES ('$a', '$b', '$c', '$d', '$e')";

     $a = oci_parse($con, $query); 

     $run = oci_execute($a);
 if($run)
{
echo "record inserted";
}
else
{
echo "<br>Error while inserting record ";
}

//}

                  
?>
  </body>
</html>