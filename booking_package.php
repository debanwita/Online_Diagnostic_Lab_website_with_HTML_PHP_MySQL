<?php
	session_start();
	
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$packageid = $_POST["test_name"];

		//echo $packageid ;
		$date=$_POST["test_date"];


		$_SESSION["test_date"]=$date;
		$time=$_POST["time"] ;
		$_SESSION["time"]=$time ;
		$book_date=date("Y-m-d");
		
		//$cust_id=100;
		$cust_id=$_SESSION["cust_id"];
		
		$lid=$_SESSION["labid"];
		
		$servername="localhost";
		$username="root";
		$password="";
		$db="lab";
		$conn=new mysqli($servername,$username,$password,$db);

		if($conn)
		{
			
				$query="insert into Book_package(Lab_id,Package_id,Cust_id,Book_date) 
						values($lid,$packageid,$cust_id,'$book_date') " ;
				$result=mysqli_query($conn,$query);

				if($result)
				{
					//echo "Insertion sucessful";
					$query="select max(Book_id) from Book_package";
					$result=mysqli_query($conn,$query);
					if($result)
					{
						if($row=mysqli_fetch_assoc($result))
						{
							$book_id=$row['max(Book_id)'];
							$_SESSION["book_id"]=$book_id ;
						}
					}
					$query="select Fname,Lname from Patient where Cust_id='$cust_id'";
					$result=mysqli_query($conn,$query);
					if($result)
					{
						if($row=mysqli_fetch_assoc($result))
						{
							$fname=$row['Fname'];
							$lname=$row['Lname'];

							$cust_name=$fname.'  '.$lname;
							$_SESSION["cust_name"]=$cust_name ;
							//echo $cust_name ;
						}
					}
					$query="select Lab_name from Lab where Lab_id=$lid";
					$result=mysqli_query($conn,$query);
					if($result)
					{
						if($row=mysqli_fetch_assoc($result))
						{
							$lab_name=$row['Lab_name'];
							$_SESSION["lab_name"]=$lab_name ;
							//echo $lab_name ;
						}
					}
					$query="select Package_name from Package where Package_id=$packageid";
					$result=mysqli_query($conn,$query);
					if($result)
					{
						if($row=mysqli_fetch_assoc($result))
						{
							$package_name=$row['Package_name'];
							$_SESSION["package_name"]=$package_name ;
							//echo $lab_name ;
						}
					}
					$query="select Charge,Discount from Offers_package where Lab_id=$lid and Package_id=$packageid";
					$result=mysqli_query($conn,$query);
					if($result)
					{
						if($row=mysqli_fetch_assoc($result))
						{
							$charge=$row['Charge'];
							$discount=$row['Discount'];
							$charge=$charge-($charge*$discount/100);

							//echo $charge ;
							$_SESSION["charge"]=$charge ;
						}
					}
					$query="insert into Bookings_package(Book_id,Test_date,Test_timings,Amount)values($book_id,'$date','$time',$charge)";
					$result=mysqli_query($conn,$query);


					$query="select Test_name,Charge from test,Have_tests,Offers_test where Package_id='$packageid' and Test.Test_id=Have_tests.Test_id and Test.Test_id=Offers_test.Test_id and Lab_id='$lid'" ;
					$result=mysqli_query($conn,$query);
					if($result)
					{
						$index=1;
						while($row=mysqli_fetch_assoc($result))
						{
							$tests[$index]=$row['Test_name'];
							$charges[$index]=$row['Charge'];
							$index=$index+1;
						}
					}
				}
			

		}
	}

?>

<html>
<head>
	<title>Book a package</title>
	
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
		
		<center><h2><b><font style="Arial" color="white">BOOKING DETAILS</font></b></h2></center><br/>
				<div id="table">
				<table align='center' border='2pt' width='80%'>
					<tr>
						<th id="th">
							Book_No
						</th>
						<th id="th">
							Lab_Name
						</th>
						<th id="th">
							Package_Name
						</th>
						<th id="th">
							Cust_Name
						</th>
						<th id="th">
							Sample_Collect_Date(yyyy-mm-dd)
						</th>
						<th id="th">
							Sample_Collect_Time
						</th>
						<th id="th">
							Package_Charge(in rupees)
						</th>
					</tr>
					<tr></tr>
					<tr>
						<td id="td">
							<?php echo "BK-" ; echo $book_id ;?>
						</td>
						<td id="td">
							<?php echo $lab_name ;?>
						</td>
						<td id="td">
							<?php echo $package_name ;?>
						</td>
						<td id="td">
							<?php echo $cust_name ; ?>
						</td>
						<td id="td">
							<?php echo $date ; ?>
						</td>
						<td id="td">
							<?php echo $time ; ?>
						</td>
						<td id="td">
							<?php echo $charge ; echo '/-+(internet handling charge=11/-)' ; ?>
						</td>
					</tr>
					</tr>
				</table>
			</div>
			<br>
			<center><h4><b><font style="Arial" color="white">TEST DETAILS UNDER THIS PACKAGE</font></b></h4></center>
			<?php
				echo "<div id='table'>" ;
				echo "<table align='center' border='2pt'>" ;
					echo "<tr>" ;
						echo "<th id='th'>" ;
							echo "Serial_Number" ;
						echo "</th>" ;
						echo "<th id='th'>" ;
							echo "Test_Name" ;
						echo "</th>" ;
						echo "<th id='th'>" ;
							echo "Test_Charge(in rupees)" ;
						echo "</th>" ;
					echo "</tr>" ;
					echo "<tr></tr>" ;
					
					for($t=1;$t<$index;$t++)
					{
						echo "<tr>" ;
						echo "<td id='td'>" ;
							echo $t.'.' ;
						echo "</td>" ;
						echo "<td id='td'>" ;
							echo $tests[$t] ;
						echo "</td>" ;
						echo "<td id='td'>" ;
							echo $charges[$t] ;
						echo "</td>" ;
						echo "</tr>" ;
					}
				echo "</table>" ;
				echo "</div>" ;
			?>

			</div>
				<br>
				            <center>
							<form method="post" action="payment_package.php">
							<button type="submit" class="btn btn-default" id="submit">Pay For Package</button>
							</form>
						</center>
							
			
		</div>
	</body>
</html>