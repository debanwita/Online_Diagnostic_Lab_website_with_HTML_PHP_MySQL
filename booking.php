<?php
	session_start();

	$testid = $_POST["test_name"];
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
		$query="select Book_id from Book_test where Lab_id=$lid and Test_id=$testid and Cust_id=$cust_id and Book_date='$book_date'";
		$result=mysqli_query($conn,$query);
		$number=mysqli_num_rows($result);
		if($number!=0)
		{
			echo "<script type='text/javascript'>alert('The test is already booked !! Please select another option')</script>";
			echo "<a href='http://localhost:1234/diagnostic_lab/book_test.php'>Click here To Go Back </a>" ;

		}
		else
		{
			$query="insert into Book_test(Lab_id,Test_id,Cust_id,Book_date) 
					values($lid,$testid,$cust_id,'$book_date') " ;
			$result=mysqli_query($conn,$query);

			if($result)
			{
				//echo "Insertion sucessful";
				$query="select max(Book_id) from Book_test";
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
				$query="select Test_name from Test where Test_id=$testid";
				$result=mysqli_query($conn,$query);
				if($result)
				{
					if($row=mysqli_fetch_assoc($result))
					{
						$test_name=$row['Test_name'];
						$_SESSION["test_name"]=$test_name ;
						//echo $lab_name ;
					}
				}
				$query="select Charge,Discount from Offers_test where Lab_id=$lid and Test_id=$testid";
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
				$query="insert into Bookings_test(Book_id,Test_date,Test_timings,Amount)values($book_id,'$date','$time',$charge)";
				$result=mysqli_query($conn,$query);
			}
		}

	}

?>

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
				<center><h2><b><font style="Arial" color="white">BOOKING DETAILS</font></b></h2></center><br/>
				<table align='center' border='2pt' width='80%'>
					<tr>
						<th id="th">
							Book_No
						</th>
						<th id="th">
							Lab_Name
						</th>
						<th id="th">
							Test_Name
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
							Test_Charge
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
							<?php echo $test_name ;?>
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
				<br>
                             <center>
							<form method="post" action="payment.php">
							<button type="submit" class="btn btn-default">Pay For Test</button>
							</form>
						</center>

	</body>
</html>