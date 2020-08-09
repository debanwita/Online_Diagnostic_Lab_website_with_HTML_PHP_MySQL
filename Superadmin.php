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
    background-color:black;
    opacity:0.6;
   font-size: 16px;
    width: 400px;
    height: 280px; 
    opacity:0.4; 
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
button[type=submit],button[type=reset]{
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
        $n=$_POST["name"];
      $p=$_POST["password"];
        if($conn)
        {
           if($n=="superadmin" && $p=="password")
          {
            echo "<script type='text/javascript'>";
            echo "window.alert ('Login is succesfull!!')";

                   echo "</script>";
           }
           else
           {
            echo "<script type='text/javascript'>";
            echo "window.alert ('Login is unsuccesfull!!')";

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
			<div class="container">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
 <center><legend><h2><b><font style="Arial" color="white"><span>SUPER ADMIN LOGIN</span></font></b></h2></legend></center>
 <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="name" type="text" class="form-control" name="name" placeholder="Admin Name" required="required">
    </div>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="required">
    </div>
<center>
    <div class="checkbox">
   <h4><font color="white"> <label><input type="checkbox">Remember me</label></font></h4>
  </div>
</center>
  <center><button type="submit" class="btn btn-default">Login</button>
  &nbsp &nbsp &nbsp<button type="reset" class="btn btn-default">Reset</button></center>
</form>
</div>
</center>
</body>
</html>
