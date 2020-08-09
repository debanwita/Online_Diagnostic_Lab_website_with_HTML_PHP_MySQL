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
    width: 520px;
    height: 650px; 
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
        $labcontact=$_POST["labcontact"];
        $labemail=$_POST["labemail"];
        $opentime=$_POST["opentime"];
        $closetime=$_POST["closetime"];
        $street=$_POST["street"];
        $city=$_POST["city"];
        $state=$_POST["state"];
        $pincode=$_POST["pin"];
        $adminname=$_POST["adminname"];
        $adminpsw=$_POST["psw"];
        if($conn)
        {
          $q="insert into Lab(Reg_no,Lab_name,Lab_contact,Lab_email, Open_time,Close_time,Street,City,State, Pincode,Admin_name,Admin_password)values('$reg','$labname',$labcontact,'$labemail','$opentime','$closetime','$street','$city','$state',$pincode,'$adminname','$adminpsw')";

           if($conn->query($q)===TRUE)
          {
            echo "<script type='text/javascript'>";
            echo "window.alert ('Insertion is succesfull!!')";

                   echo "</script>";
           }
           else
           {
            echo "<script type='text/javascript'>";
            echo "window.alert ('Insertion is unsuccesfull!!')";

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
 <center><legend><h2><b><font style="Arial" color="white"><span>ADD LAB DETAILS</span></font></b></h2></legend></center>
 <div class="form-inline">
    <label for="name"><font color="red">*</font>Reg-no:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="reg" required="required">
  </div>
  <div class="form-inline">
    <label for="name"><font color="red">*</font>Lab-name:</label>
    &nbsp&nbsp&nbsp<input type="text" class="form-control" name="labname" required="required" >
  </div>
  <div class="form-inline">
    <label for="contact"><font color="red">*</font>Lab-contact:</label>
    <input type="number" class="form-control" name="labcontact" required="required"><br/>
  </div>
    <div class="form-inline">
    <label for="email"><font color="red">*</font>Lab-email:</label>
    &nbsp&nbsp&nbsp<input type="email" class="form-control" name="labemail" required="required">
  </div>
    <div class="form-inline">
    <label for="time"><font color="red">*</font>Open-time:</label>
   &nbsp&nbsp<input type="text" class="form-control" name="opentime" required="required">
  </div>
    <div class="form-inline">
    <label for="time"><font color="red">*</font>Close-time:</label>
    &nbsp<input type="text" class="form-control" name="closetime" required="required">
  </div>
    <div class="form-inline">
    <label for="name"><font color="red">*</font>Street:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="street" required="required">
  </div>
    <div class="form-inline">
    <label for="name"><font color="red">*</font>City:</label>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" class="form-control" name="city" required="required">
  </div>
    <div class="form-inline">
    <label for="name"><font color="red">*</font>State:</label>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" class="form-control" name="state" required="required">
  </div>
    <div class="form-inline">
    <label for="pincode"><font color="red">*</font>Pin:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="number" class="form-control" name="pin" required="required">
  </div>
  <div class="form-inline">
    <label for="adminname"><font color="red">*</font>AdminName:</label>
  <input type="text"  class="form-control" name="adminname" required="required">
  </div>
  <div class="form-inline">
    <label for="adminpassword"><font color="red">*</font>AdminPsw:</label>
    <input type="password" class="form-control" name="psw" required="required">
  </div>
  <div class="checkbox">
    <h4><label><input type="checkbox">Remember me</label></h4>
  </div>
 <center> <button type="submit" class="btn btn-default">Submit</button></center>
</form>
</div>
</center>
</body>
</html>
