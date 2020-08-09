<html>
<head>
<title>Login</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
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
    height: 300px; 
    opacity:0.4; 
    border: 2px solid black;
    padding: 15px;
     margin: 12px;  
     color:black;
     font-family: Arial;
     text-decoration: bold;
     display:block;
}
.contain{
	background-color:lightblue;
    opacity:0.6;
   font-size: 16px;
    width: 600px;
    height: 600px; 
    opacity:0.6; 
    border: 2px solid black;
    padding: 15px;
     margin: 12px;  
     color:black;
     font-family: Arial;
     text-decoration: bold;
     display:block;

}
body
{
	background:url("pic3.jpg");
	font-family: Gothic;
	font-size:25px;
	opacity:1.0;
}
div{
	display:block;
}
button[type=submit],button[type=reset],input[type=text],input[type=password],input[type=date],input[type=number],input[type=email]{
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
			
			$servername="localhost";
			$username="root";
			$password="";
			$db="lab";

			$conn=new mysqli($servername,$username,$password,$db);
		
			if(isset($_POST['form']))
      {
        switch ($_POST['form']) 
        {
            case "B":
                      $fname=$_POST["fname"];
                      $lname=$_POST["lname"];
                      $contact=$_POST["contact"];
                      $email=$_POST["email"];
                      $dob=$_POST["dob"];
                      $street=$_POST["street"];
                      $city=$_POST["city"];
                      $state=$_POST["state"];
                      $pin=$_POST["pin"];
                      $password=$_POST["psw"];
                      
                      $query="select Cust_id from Patient where Email='$email'";
                      $result=mysqli_query($conn,$query);
                      if($result)
                      {
                         if(mysqli_num_rows($result))
                         {
                              echo "<script type='text/javascript'>";
                              echo "window.alert ('You have already registered!! Please Login to continue')";
                              echo "</script>";
                         }
                         else
                         {
                            $query="insert into Patient(Fname,Lname,Contact,Email,Dob,Street,City,State,Pincode,Password) values('$fname','$lname',$contact,'$email','$dob','$street','$city','$state',$pin,'$password') " ;
                            $result=mysqli_query($conn,$query);
                            if($result)
                            {
                               echo "<script type='text/javascript'>";
                               echo "window.alert ('Registration successful!! Please Login to continue')";
                               echo "</script>";
                               
                              
                               $query="select max(Cust_id) from Patient";
                               $result=mysqli_query($conn,$query);
                               if($result)
                               {
                                if($row=mysqli_fetch_assoc($result))
                                {
                                  $cid=$row['max(Cust_id)'];
                                }
                               }
                               $msg="You have sucessfully registered in Dexter Lab!!..Please Log in to continue.Your customer id is  : ".$cid;
                               $header="From:Dexturelab@gmail.com";
                               mail("$email","About Suceesful Registration in Dexter Lab",$msg,$header);
                            }
                         }

                      }
           
                      break;

           case "A":  $username=$_POST["email"];
                      $password=$_POST["password"];
                      if($conn)
                      {
                        $query="select Cust_id,Password from Patient where Email='$username'";
                        $result=mysqli_query($conn,$query);
                        if($result)
                        {
                          if(mysqli_num_rows($result)==0)
                          {
                            echo "<script type='text/javascript'>";
                            echo "window.alert ('You have not registered yet!!..Please register and continue')";
                            echo "</script>";
                          }
                          else
                          {
                              if($row=mysqli_fetch_assoc($result))
                              {
                                $p=$row['Password'];
                                if($p==$password)
                                {
                                  $cust_id=$row['Cust_id'];
                                  $_SESSION["cust_id"]=$cust_id;
                                  
                                  ?>
                                  <html>
                                  <script language='javascript'>window.alert('Login Sucessful!!');window.location='view_report.php';</script>
                                  </html>
                                  <?php
                                }
                                else
                                {
                                  echo "<script type='text/javascript'>";
                                  echo "window.alert ('Invalid username/password given!!!...Please try again')";
                                  echo "</script>";
                                }
                              }
                          }
                        }
                      }  
              			  break ;
          }
        }
		?>
<div class="jumbotron">
	<center>
<h1>DEXTER DIAGNOSTIC LAB</h1>
</center>
</div>
	<div class="row">
		<div class="col-sm-6">
			<div class="container">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
    <input type="hidden" name="form" value="A">
 <center><legend><h2><b><font style="Arial" color="white"><span>SIGN IN</span></font></b></h2></legend></center>
 <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
      <input id="name" type="text" class="form-control" name="email" placeholder="Username" required="required">
    </div>
    <div class="input-group">
      <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
      <input id="password" type="password" class="form-control" name="password" placeholder="Password" required="required">
    </div>
    <center>
  <div class="checkbox">
   <h4><font color="white"> <label><input type="checkbox">Remember me</label></font></h4>
  </div></center>
  <center><button type="submit" class="btn btn-default">Login</button>
  &nbsp &nbsp &nbsp<button type="reset" class="btn btn-default">Reset</button></center>
  <font color="Violet">If you haven't registered, then Register Now!!</font>
</form>
</div>
</div>
<div class="col-sm-6">
	<div class="contain">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
		<center><legend><h2><b><font style="Arial" color="white">REGISTER</font></b></h2></legend></center>
    <input type="hidden" name="form" value="B">
  <div class="form-inline">
    <label for="name"><font color="red">*</font>First-Name:</label>
    <input type="text" class="form-control" name="fname" required="required" placeholder="Enter First-Name">
  </div>
  <div class="form-inline">
    <label for="name"><font color="red">*</font>Last-name:</label>
    &nbsp<input type="text" class="form-control" name="lname" required="required" placeholder="Enter Last-Name" >
  </div>
  <div class="form-inline">
    <label for="psw"><font color="red">*</font>Password:</label>
    &nbsp&nbsp<input type="password" class="form-control" name="psw" required="required"><br/>
   <font color="red" size="3px"><b> **Password should be minimum 6 length of characters.</b></font>
  </div>
    <div class="form-inline">
    <label for="Contact"><font color="red">*</font>Contact:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp<input type="number" class="form-control" name="contact" required="required">
  </div>
    <div class="form-inline">
    <label for="email"><font color="red">*</font>Email:</label>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="email" class="form-control" name="email" required="required">
  </div>
    <div class="form-inline">
    <label for="date"><font color="red">*</font>Dob:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp &nbsp<input type="date" class="form-control" name="dob" required="required">
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
    <label for="pwd"><font color="red">*</font>State:</label>
   &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp <input type="text" class="form-control" name="state" required="required">
  </div>
    <div class="form-inline">
    <label for="pincode"><font color="red">*</font>Pin:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="number" class="form-control" name="pin" required="required">
  </div>
  <div class="checkbox">
    <h4><label><input type="checkbox">Remember me</label></h4>
  </div>
 <center> <button type="submit" class="btn btn-default">Submit</button></center>
</form>

</div>
</div>
</body>
</html>


