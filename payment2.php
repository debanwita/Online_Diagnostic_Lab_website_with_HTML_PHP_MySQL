<?php
	$owner="";
	session_start();
	$servername="localhost";
	$username="root";
	$password="";
	$db="lab";
	//$mail="debanwita4dt@gmail.com";

	$conn=new mysqli($servername,$username,$password,$db);
	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$owner=$_POST["owner"];
		
		$tdate=date("Y-m-d");
		$_SESSION["tdate"]=$tdate ;
		$query="select now()";

		if($conn)
		{
			$result=mysqli_query($conn,$query);
			if($result)
			{
				if($row=mysqli_fetch_assoc($result))
				{
					$x= $row["now()"];
					$ttime=substr($x,11,8);
					$_SESSION["ttime"]=$ttime ;
				}
			}
			$book_id=$_SESSION["book_id"];
			$charge=$_SESSION["charge"];
			$amount=$charge+11;
			$_SESSION["amount"]=$amount;

			$query="insert into Transaction_test(Book_id,Time,Date,Amount)values($book_id,'$ttime','$tdate',$amount)";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				echo "<script type='text/javascript'>alert('Booking Sucessful!!')</script>";

				$cid=$_SESSION["cust_id"];
				$query="select Email from Patient where Cust_id=$cid";
				$result=mysqli_query($conn,$query);
				if($result)
				{
					if($row=mysqli_fetch_assoc($result))
					{
						$mail=$row['Email'];
						if(mail("$mail","About Booking a Test","Your Test has been Sucessfully booked!!","From: DoNotReply@abe1112.com"))
							echo "<script type='text/javascript'>alert('Confirmation email sent!!')</script>";
						else
							echo "<script type='text/javascript'>alert('error!!')</script>";
					}
				}
			}

			$query="select max(Transaction_id) from Transaction_test";
			$result=mysqli_query($conn,$query);
			if($result)
			{
				if($row=mysqli_fetch_assoc($result))
				{
					$t_id=$row['max(Transaction_id)'];
					$_SESSION["t_id"]=$t_id ;
				}
			}

		}
	}
?>
<html>
<head>
	<title>Book a Test</title>
	<link rel="stylesheet" href="css/booking.css">
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
				<center><h2><b><font style="Arial" color="white">BOOKING DETAILS</font></b></h2></center>	
				<table align='center'border='1pt'>
					<tr>
						<th text-align='center'>
							Book_No
						</th>
						<th text-align='center'>
							Lab_Name
						</th>
						<th text-align='center'>
							Test_Name
						</th>
						<th text-align='center'>
							Cust_Name
						</th>
						<th text-align='center'>
							Test_Date(yyyy-mm-dd)
						</th>
						<th text-align='center'>
							Test_Time
						</th>
						<th text-align='center'>
							Test_Charge
						</th>
					</tr>
					<tr></tr>
					<tr>
						<td text-align='center'>
							<?php echo "BK-" ;echo $_SESSION["book_id"];?>
						</td>
						<td text-align='center'>
							<?php echo $_SESSION["lab_name"] ;?>
						</td>
						<td text-align='center'>
							<?php echo $_SESSION["test_name"] ;?>
						</td>
						<td text-align='center'>
							<?php echo $_SESSION["cust_name"] ; ?>
						</td>
						<td text-align='center'>
							<?php echo $_SESSION["test_date"] ; ?>
						</td>
						<td text-align='center'>
							<?php echo $_SESSION["time"] ; ?>
						</td>
						<td text-align='center'>
							<?php echo $_SESSION["charge"] ; ?>
						</td>
					</tr>
					</tr>
				</table>
			

			<br><br>
			
				<table align='center' border='1pt'>
					<tr>
						<th text-align='center'>
							Transaction_Ref_no
						</th>
						<th text-align='center'>
							Transaction_date(yyyy-mm-dd)
						</th>
						<th text-align='center'>
							Transaction_time(hh:mm:ss)
						</th>
						<th text-align='center'>
							Transaction_amount(in rupee)
						</th>
					</tr>
					<tr></tr>
					<tr>
						<td text-align='center'>
							<?php echo "TR-" ; echo $t_id ;?>
						</td>
						<td text-align='center'>
							<?php echo  $tdate;?>
						</td>
						<td text-align='center'>
							<?php echo $ttime ;?>
						</td>
						<td text-align='center'>
							<?php echo $amount ; ?>
						</td>
					</tr>
					<tr></tr>
				</table>
			
			<br><center>
			<form action="print_test.php" method="POST">
			
							<button type="submit" class="btn btn-default" >Print</button>
						
			</form>
		</center>
			
		
	</body>
</html>
