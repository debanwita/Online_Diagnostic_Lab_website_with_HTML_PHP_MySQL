<html>
	<head>
		<title>View Report</title>
		<link rel="stylesheet" href="css/book_test.css">
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
    height: 350px; 
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
#submit{
	color:black;
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
			$type='';
			//$cust_id=100;
			$cust_id=$_SESSION["cust_id"] ;
	
			$servername="localhost";
			$username="root";
			$password="";
			$db="lab";

			$conn=new mysqli($servername,$username,$password,$db);
		
			if ($_SERVER["REQUEST_METHOD"] == "POST") 
			{
				$type=$_POST["laboratory"];
				$_SESSION["type"]=$type;
				//echo $type ;
				if($conn)
				{
					if($type=="Test")
					{
						$query="select Book_id from Book_test where cust_id='$cust_id' and Book_id in (select Book_id from Report_test)" ;
						$result=mysqli_query($conn,$query);
						if($result)
						{
							$n=1;
							while($row=mysqli_fetch_assoc($result))
							{
								$bookid[$n]=$row['Book_id'];
								$n=$n+1;
							}
						//print_r($testid);
						//print_r($testname);
						}
					}
					else
					{
						$query="select Book_id from Book_package where cust_id='$cust_id' and Book_id in (select Book_id from Report_package)" ;
						$result=mysqli_query($conn,$query);
						if($result)
						{
							$n=1;
							while($row=mysqli_fetch_assoc($result))
							{
								$bookid[$n]=$row['Book_id'];
								$n=$n+1;
							}
						//print_r($testid);
						//print_r($testname);
						}
					}
				}
			}
		?>
		<center>
		<div class="container">
			
			<center><h2><b><font style="Arial" color="white">VIEW/SEARCH REPORT</font></b></h2></center><br/>
			
			<form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
				
				<center>	
				<div class="form-group section-filter">
					<div class="form-inline">
						<table align='center'>
							<tr>
								<td id="label"><b>Select (Test/Package) :   </b><span class="glyphicon glyphicon-asterisk"></span></td>
								<td></td>
								<td></td>
								<td>
									<select class="form-control" id='laboratory' name='laboratory'>
									<option value="" >Select Test/Package</option>
									<option value="Test">Test</option>
									<option value="Package">Package</option>
									<script type="text/javascript">
 										document.getElementById('laboratory').value ="<?php echo $_POST['laboratory'];?>" ;
									</script>
					               </select>
								</td>
							</tr>
					</table>
					</div>
					<br/>
					<table align='center'>
					<tr></tr>
					<tr><td></td><td>
					<button type="submit" class="btn btn-default" id="submit">Get Book Id</button>
					</td></tr>
					</table>
					</div>
				 </center>
			</form>

			<form class="form-inline" action="view_report1.php" method="post">
				<center>
					
				<div class="form-group section-filter">
					<div class=" form-inline">
						<table align='center'>
							<tr>
								<td id="label"><b>Select Book_Id :   </b><span class="glyphicon glyphicon-asterisk"></span></td>
								<td></td>
								<td></td>
								<td>
									<select class="form-control" id='laboratory' name='laboratory'>
									<option value="" >Select book_id </option>
									<?php
									for($l=1;$l<$n;$l++)
									{
										echo "<option value='$bookid[$l]'>BK-$bookid[$l]</option>" ;
									}
									?>
									</select>
									<script type="text/javascript">
 										document.getElementById('laboratory').value ="<?php echo $_POST['laboratory'];?>" ;
									</script>
					
								</td>
							</tr>
					</table>
					</div>
					<br>
					<table align='center'>
					<tr></tr>
					<tr><td></td><td>
					<button type="submit" class="btn btn-default" id="submit">Submit</button>
					</td></tr>
					</table>
					</div>
				 </center>
			</form>
			
		</div>
	</center>
	</body>
</html>