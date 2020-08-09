<html>
	<head>
		<title>Book a Test</title>
		
		 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   		 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

		 <style>
		 	
		 	.jumbotron{
	opacity:0.6;
	font-style: Gothic;
}
.container{
    background-color:grey;
    opacity:0.6;
   font-size: 16px;
    width: 530px;
    height: 460px; 
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
	background-color : lightblue;
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
           <div class="jumbotron">
	<center>
          <h1>DEXTER DIAGNOSTIC LAB</h1>
           </center>
            </div>

		<?php
			session_start();
			$labid='' ;
	
			$servername="localhost";
			$username="root";
			$password="";
			$db="lab";

			$conn=new mysqli($servername,$username,$password,$db);
		
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$labid=$_POST["laboratory"];
				$_SESSION["labid"]=$labid;
				//echo $labid ;
				if($conn)
				{
					$query="select Test.Test_id,Test.Test_name from Test, Offers_test where Offers_test.Test_id=Test.Test_id && Offers_test.Lab_id='$labid'" ;
					$result=mysqli_query($conn,$query);
					if($result)
					{
						$n=1;
						while($row=mysqli_fetch_assoc($result))
						{
							$testid[$n]=$row['Test_id'];
							$testname[$n]=$row['Test_name'];
							$n=$n+1;
						}
						//print_r($testid);
						//print_r($testname);
					}
				}
			}
		?>
		<center>
		<div class="container" >
			<center><h2><b><font style="Arial" color="white">BOOK A TEST</font></b></h2></center><br/>
			<?php
				$servername="localhost";
				$username="root";
				$password="";
				$db="lab";

				$conn=new mysqli($servername,$username,$password,$db);
				if($conn)
				{
					$query="select Lab_id,Lab_name from Lab";
					$result = mysqli_query($conn,$query);
					if($result)
					{
						$m=1;
						while($row=mysqli_fetch_assoc($result))
						{
							$arr[$m]=$row['Lab_name'];
							$lab_id[$m]=$row['Lab_id'] ;
							$m=$m+1;
						}
						//print_r($lab_id);
					}
				}
			?>
			<form  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">

									<select class="form-control" id='laboratory' name='laboratory'>
									<option value="" >Select a Lab</option>
									<?php
									for($l=1;$l<$m;$l++)
									{
										echo "<option value='$lab_id[$l]'>$arr[$l]</option>" ;
									}
									?>
									</select>
									<script type="text/javascript">
 						document.getElementById('laboratory').value ="<?php echo $_POST['laboratory'];?>" ;
					</script><br/>
					<button type="submit" class="btn btn-default" id="submit">Enter</button>

			</form>
			<form  name="form2" action="booking.php" method="post" >
									<select class="form-control" name="test_name" id="test_name">
										<option value="">Select a Test</option>
										<?php
											for($k=1;$k<$n;$k++)
											{
												echo "<option value='$testid[$k]'>$testname[$k]</option>" ;
											}
										?>
									</select><br/>
									 <div class="form-inline">
    <label for="date"><font color="red">*</font>Choose Sample collection date:</label>
    <input type='date' class="form-control" name='test_date' required='required' placeholder="choose date" autocomplete='off' id='test_date'/><span class="glyphicon glyphicon-calendar"></span>
  </div><br/>
									<select class="form-control" name="time" id="time">
										<option value="">Select a Sample Collection Slot</option>
										<option value="08:00 A.M-09:00 A.M.">08:00 A.M.-09:00 A.M.</option>
										<option value="09:00 A.M-10:00 A.M.">09:00 A.M.-10:00 A.M.</option>
										<option value="10:00 A.M-11:00 A.M.">10:00 A.M.-11:00 A.M.</option>
										<option value="11:00 A.M-12:00 A.M.">11:00 A.M.-12:00 A.M.</option>
										<option value="12:00 A.M-01:00 P.M.">12:00 A.M.-01:00 P.M.</option>
										<option value="01:00 P.M-02:00 P.M.">01:00 P.M.-02:00 P.M.</option>
										<option value="02:00 P.M-03:00 P.M.">02:00 P.M.-03:00 P.M.</option>
										<option value="03:00 P.M-04:00 P.M.">03:00 P.M.-04:00 P.M.</option>
										<option value="04:00 P.M-05:00 P.M.">04:00 P.M.-05:00 P.M.</option>
									</select><br/>
									<button type="submit" class="btn btn-default" id="submit" onclick=" return validate()">Submit</button>
				   
			</form>
		</div>
	</center>
	</body>
</html>