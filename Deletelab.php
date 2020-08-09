<html>
<head><title>Admin Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <style>
.jumbotron{
  opacity:0.6;
  font-style: Gothic;
}
.container{
    background-color:silver;
    opacity:0.6;
   font-size: 16px;
    width: 450px;
    height: 580px; 
    opacity:0.4; 
    padding: 15px;
     margin: 12px;  
     color:black;
     font-family: Arial;
     text-decoration: bold;
     display:block;
}
.contain{
  background-color:grey;
    opacity:0.6;
   font-size: 16px;
    width: 500px;
    height: 260px; 
    opacity:0.6; 
    border: 2px solid black;
    padding: 15px;
     margin: 12px;  
     color:black;
     font-family: Arial;
     text-decoration: bold;
     display:block;

}
body{
  background:lightblue;
}
select:required:invalid {
  color: gray;
}
option[value=""][disabled] {
  display: none;
}
option {
  color: black;
}
button[type=submit],button[type=reset],input[type=text],input[type=number],input[type=email],input[type=password]{
    width: 20%;
    padding: 4px 2px;
    margin: 2px 2px;
    border:2px solid black;
    box-sizing: border-box; 
    font-size: 20px;
    position: relative;

}
</style>

</head>
<body>
  <?php
      session_start();
      $custid='' ;
      $servername="localhost";
      $username="root";
      $password="";
      $db="lab";
      $conn=new mysqli($servername,$username,$password,$db);
    
      if ($_SERVER["REQUEST_METHOD"] == "POST") 
      {
        $reg=$_POST["reg"];
        $labname=$_POST["labname"];
        if($conn)
        {
          $q="Delete from lab where Reg_no='$reg' and Lab_name='$labname'" ;

           if($conn->query($q)===TRUE)
          {
            echo "<script type='text/javascript'>";
            echo "window.alert ('Deletion is succesfull!!')";

                   echo "</script>";
           }
           else
           {
            echo "<script type='text/javascript'>";
            echo "window.alert ('Deletion is unsuccesfull!!')";

                   echo "</script>";
           }
           }        
      }
    ?>
  <div class="jumbotron">
  <center>
<h1>DEXTER DIAGNOSTIC LAB</h1>
</center>
</div>
    <center>
			<div class="contain">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
 <center><legend><h2><b><font style="Arial" color="white"><span>DELETE LAB DETAILS</span></font></b></h2></legend></center>
 <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Reg-no:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="reg" required="required">
  </div>
  <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Lab-name:</label>
    &nbsp&nbsp&nbsp<input type="text" class="form-control" name="labname" required="required" >
  </div>
  <br/>
 <center> <button type="submit" class="btn btn-default">Submit</button></center>
</form>
</div>
</center>
</body>
</html>
