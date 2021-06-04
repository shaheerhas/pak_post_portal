<html>
 <head>
   <title>Form Handling</title>
    <style type="text/css">
    td
    {
      padding:5px;
      
     }
  </style>
 </head>
 <body>
   <h1 align="center">Registeration Form</h1>

    <table align="center" >
     <form name="reg" action="insert.php" method="post">
     <tr>
       <td><label>ID</label></td>
       <td><input type="text" name="id" value=""></td> 
     </tr>
     <tr>
       <td><label>First Name</label></td>
       <td><input type="text" name="fname" value=""></td> 
     </tr>
     <tr>
       <td><label>Last Name</label></td>
       <td><input type="text" name="lname" value=""></td> 
     </tr> 
      <tr>
       <td><label>Adddress</label></td>
       <td><input type="text" name="add" value=""></td> 
     </tr> 
     <tr>
       <td><label>City</label></td>
       <td><input type="text" name="city" value=""></td> 
     </tr> 
     <tr>
       <td></td> 
       <td><input type="submit"></td>
     </tr> 
    </form> 
 </body>
</html>