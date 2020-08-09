<?php
	session_start();
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		$bookid=$_POST['laboratory'];
		$_SESSION["bookid"]=$bookid;
		$type=$_SESSION["type"];
		$cust_id=$_SESSION["cust_id"];
		//echo $cust_id ;
		//echo $bookid ;

		$servername="localhost";
		$username="root";
		$password="";
		$db="lab";

		$conn=new mysqli($servername,$username,$password,$db);
	}
?>

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
		
			<center><h2><b><font style="Arial">VIEW/SEARCH REPORT</font></b></h2></center><br/>
			
		
			<?php
				if($conn)
				{
					if($type=="Test")
					{
						$query="select Test_name,Test.Test_id from Book_Test,Test where Book_Test.Test_id=Test.Test_id and Book_id='$bookid'";

						$result=mysqli_query($conn,$query);
						if($result)
						{
							if($row=mysqli_fetch_assoc($result))
							{
								$tname=$row['Test_name'];
								$tid=$row['Test_id'];
								$_SESSION["tname"]=$tname ;
								$_SESSION["tid"]=$tname;
							}
						}

						$query="select Lab.Lab_id,Lab_name from Book_Test,Lab where Book_Test.Lab_id=Lab.Lab_id and Book_id='$bookid'";

						$result=mysqli_query($conn,$query);
						if($result)
						{
							if($row=mysqli_fetch_assoc($result))
							{
								$lid=$row['Lab_id'];
								$labname=$row['Lab_name'];
								$_SESSION['labname']=$labname ;
								$_SESSION['labid']=$lid;
							}
						}

					
						$query="select Fname,Lname,Dob from Patient where Cust_id='$cust_id'";
						$result=mysqli_query($conn,$query);
						if($result)
						{
							if($row=mysqli_fetch_assoc($result))
							{
								$fname=$row['Fname'];
								$lname=$row['Lname'];
								$dob=$row['Dob'];
								$custname=$fname.' '.$lname;
								$_SESSION["custname"]=$custname ;
							}
						}
						$from = new DateTime($dob);
						$to   = new DateTime('today');
						$age=$from->diff($to)->y;
						//echo $age;
						$_SESSION['age']=$age;


						$query="select is_parameter,Test.Test_id from Report_test,Book_test,Test where Report_test.Book_id=Book_test.Book_id and Book_test.Test_id=Test.Test_id and Book_test.Book_id='$bookid'";

						$result=mysqli_query($conn,$query);
						if($result)
						{
							if($row=mysqli_fetch_assoc($result))
							{
								$is=$row['is_parameter'];
								$_SESSION["is"]=$is ;
								$test_id=$row['Test_id'];

								$query="select Doctor_name from Offers_test where Test_id='$test_id' and Lab_id='$lid'";
								$result=mysqli_query($conn,$query);
								if($result)
								{
									if($row=mysqli_fetch_assoc($result))
									{
										$dname=$row['Doctor_name'];
										$_SESSION["dname"]=$dname;
									}
								}

								$query="select Report_id from Report_test where Book_id='$bookid'";
									$result=mysqli_query($conn,$query);
									if($result)
									{
										if($row=mysqli_fetch_assoc($result))
										{
											$reportid=$row['Report_id'];
											$_SESSION["reportid"]=$reportid;
										}
									}
								$query="select Generation_date,Comments from Report_test where  Report_id=$reportid";

								$result=mysqli_query($conn,$query) ;
								if($result)
								{
									if($row=mysqli_fetch_assoc($result))
									{
										$gdate=$row['Generation_date'];
										$_SESSION['gdate']=$gdate;
										$comments=$row['Comments'];
										$_SESSION["comments"]=$comments;
									}
								}


								?>

								<html>
										<style>
											#t1{
												font-size :18pt ;
											}
											
										</style>
									</html>	
									<?php

									
									echo "<div id='t1' align='center'><b><u>Lab name &nbsp : &nbsp $labname </u></b></div>" ;
									echo "<br>";
									echo "<div id='t1' align='center'><b><u>Test name : $tname </u></b></div>" ;
									echo "<br>";
								
									echo "<div id='t1' align='center'><b><u>Book Id &nbsp : &nbsp BK-$bookid </u></b></div>" ;
									
									echo "<br><br>" ;
 
									echo "<div id='t1'><b><u>Doctor Name : &nbsp$dname</u>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b><u>Patient Name &nbsp: &nbsp$fname &nbsp $lname </u></b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Date : $gdate</u></b></div>";

								//echo $test_id ;
								//echo $is ;
								if($is==1) // parameter exists
								{
									$query = "select Parameters.Parameter_id,Parameter_name,Max_value,Min_value,Unit from Parameters,Test,Contains where Test.Test_id=Contains.Test_id and Parameters.Parameter_id=Contains.Parameter_id and Test.Test_id='$test_id' ";
									$result=mysqli_query($conn,$query);

									if($result)
									{
										$index=0;
										$_SESSION['pname']=array();
										$_SESSION['max']=array();
										$_SESSION['min']=array();
										$_SESSION['unit']=array(); 
										$_SESSION['pid']=array();

										while($row=mysqli_fetch_assoc($result))
										{
											$paraid[$index]=$row['Parameter_id'];
											array_push($_SESSION['pid'],$paraid[$index]);

											$pname[$index]=$row['Parameter_name'];
											
											array_push($_SESSION['pname'],$pname[$index]);
											

											$max[$index]=$row['Max_value'];
											array_push($_SESSION['max'],$max[$index]);
										
											$min[$index]=$row['Min_value'];
											array_push($_SESSION['min'],$min[$index]);
											
											$unit[$index]=$row['Unit'];
											array_push($_SESSION['unit'],$unit[$index]);

											$index=$index+1;
										}
										$_SESSION['index']=$index;
									}
									echo "<br><br>" ;
									echo "<table align='center' border='4pt'>" ;
											
									echo "<tr>" ;

										echo "<td align='center' width='30%' height='40'>" ;
											echo "<b><u>Parameter_Name</u></b>" ;
										echo "</td>" ;

										echo "<td align='center' width='20%' height='40'>" ;
											echo "<b><u>Value</u></b>" ;
										echo "</td>" ;

										echo "<td align='center' width='20%' height='40'>" ;
											echo "<b><u>Max_Value</u></b>" ;
										echo "</td>" ;

										echo "<td align='center' width='20%' height='40'>" ;
											echo "<b><u>Min_Value</u></b>" ;
										echo "</td>" ;

										echo "<td align='center' width='20%' height='40'>" ;
											echo "<b><u>Unit</u></b>" ;
										echo "</td>" ;
									
									echo "</tr>" ;
									echo "<tr></tr>" ;
							
									for($t=0;$t<$index;$t++)
									{
										echo "<tr>" ;
										
										echo "<td align='center' height='30'>" ;
											echo $pname[$t] ;
										echo "</td>" ;
	
										$p=$paraid[$t];

										$query="select Value from Consists_of_test where Report_id='$reportid' and Parameter_id='$p'";
										$result=mysqli_query($conn,$query);
										if($result)
										{
											if($row=mysqli_fetch_assoc($result))
												{
													$value=$row['Value'] ;
												}
										}
										echo "<td align='center'>" ;
											echo $value;
										echo "</td>" ;

										echo "<td align='center'>" ;
											echo $max[$t] ;
										echo "</td>" ;

										echo "<td align='center'>" ;
											echo $min[$t] ;
										echo "</td>" ;

										echo "<td align='center'>" ;
											if($unit[$t]=='')
												echo "---";
											else
												echo $unit[$t] ;
										echo "</td>" ;

										echo "</tr>" ;
									}
									echo "</table>" ;
									echo "</div>" ;
									echo "</div>" ;

									?>
									<html>
										<style>
											
		 									#t{
											
    											font-size : 16pt;
    											font-family : Times New Roman;
		 									}
										</style>
									</html>
									<?php
									if($comments!='')
									{
										echo "<br>";
										
										echo "<div id='t'> <b><u>Comments : </u></b></div>" ;
										echo "<div id='t'>" ;

										echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ;
										
										for($j=0;$j<strlen($comments);$j++)
										{
											
											$x=$comments[$j];
											echo $x;
											if($x=='.')
											{
												echo "<br>";
												echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ;

											}
										}
										echo "</div>"	;
									}
							
								}
								else
								{
									//echo "No Parameters" ;
									?>
									<html>
										<style>
											
		 									#t{
												font-family : Times New Roman;
    											font-size : 20pt;
		 									}
										</style>
									</html>
									<?php
									echo "<br><br><br>";
									
									echo "<div id='t' align='center'> <b><u>Test Reports : </u></b></div>" ;
									
									echo "<br>";
									echo "<div id='t' align='center'>" ;

									echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ;
									
									for($j=0;$j<strlen($comments);$j++)
									{
										
										$x=$comments[$j];
										echo $x;
										if($x=='.')
										{
											echo "<br>";
											echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ;

										}
									}
									echo "</div>"	;
							
								}
							}
						}
					}
					else
					{
						//echo "Package";

						$query="select Lab.Lab_id,Lab_name from Book_Package,Lab where Book_Package.Lab_id=Lab.Lab_id and Book_id='$bookid'";

						$result=mysqli_query($conn,$query);
						if($result)
						{
							if($row=mysqli_fetch_assoc($result))
							{
								$lid=$row['Lab_id'];
								$labname=$row['Lab_name'];
								$_SESSION['labname']=$labname ;
								$_SESSION['labid']=$lid ;
							}
						}

						$query="select Fname,Lname,Dob from Patient where Cust_id='$cust_id'";
						$result=mysqli_query($conn,$query);
						if($result)
						{
							if($row=mysqli_fetch_assoc($result))
							{
								$fname=$row['Fname'];
								$lname=$row['Lname'];
								$dob=$row['Dob'];
								$custname=$fname.' '.$lname;
								$_SESSION["custname"]=$custname ;
							}
						}
						$from = new DateTime($dob);
						$to   = new DateTime('today');
						$age=$from->diff($to)->y;
						//echo $age;
						$_SESSION['age']=$age;

						$query="select Report_id,Generation_date,Comments from Report_package where Book_id='$bookid'";
						$result=mysqli_query($conn,$query);
						if($result)
						{
							if($row=mysqli_fetch_assoc($result))
							{
								$reportid=$row['Report_id'];
								$_SESSION["reportid"]=$reportid;
								$gdate=$row['Generation_date'];
								$_SESSION['gdate']=$gdate;
								$comments=$row['Comments'];
								$_SESSION['comments']=$comments;
							}
						}
						$query="select Package_name,Package.Package_id,Lab_name from Book_package,Package,Lab where Cust_id='$cust_id' and Book_id='$bookid' and Book_package.Package_id=Package.Package_id and Book_package.Lab_id=Lab.Lab_id";
						$result=mysqli_query($conn,$query);
						if($result)
						{
							if($row=mysqli_fetch_assoc($result))
							{
								$packageid=$row['Package_id'];
								$packagename=$row['Package_name'];
								$labname=$row['Lab_name'];
								$_SESSION['packageid']=$packageid;
								$_SESSION['packagename']=$packagename;
								$_SESSION['labanme']=$labname;
								/*echo $packageid ;
								echo $packagename ;
								echo $labname ;*/
							}
						}
						$query="select distinct Test.Test_id,Test_name,is_parameter from Test,Have_tests where Have_tests.Package_id='$packageid' and Have_tests.Test_id=Test.Test_id";
						$result=mysqli_query($conn,$query);

						$_SESSION['testid']=array();
						$_SESSION['testname']=array();
						$_SESSION['isparameter']=array();

						if($result)
						{
							$i=0;
							while($row=mysqli_fetch_assoc($result))
							{
								$testid[$i]=$row['Test_id'];
								array_push($_SESSION['testid'],$testid[$i]);

								$testname[$i]=$row['Test_name'];
								array_push($_SESSION['testname'],$testname[$i]);

								$isparameter[$i]=$row['is_parameter'];
								array_push($_SESSION['isparameter'],$isparameter[$i]);

								$

								$i=$i+1;
							}
							$index=$i-1;

							/*print_r($testid);
							echo "<br>";
							print_r($testname);
							echo "<br>";
							print_r($isparameter);*/
						}

						?>

						<html>
							<style>
								#t1{
									font-size :18pt ;
								}
								
								
								#t{
								font-family : Times New Roman;
								font-size : 20pt;
								}
							</style>
						</html>
						<?php
						echo "<div id='t1' align='center'><b><u>Package name : $packagename </u></b></div>" ;
						echo "<br>";
						echo "<div id='t1' align='center'><b><u>Lab name &nbsp : &nbsp $labname </u></b></div>" ;
						echo "<br>";
						echo "<div id='t1' align='center'><b><u>Book Id &nbsp : &nbsp BK-$bookid </u></b></div>" ;
						
						echo "<br><br>" ;

						/*echo "<div id='t1'><b><u>Doctor Name : &nbsp$dname</u>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b><u>Patient Name &nbsp: &nbsp$fname &nbsp $lname </u></b>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<u>Date : $gdate</u></b></div>";*/


							for($i=0;$i<=$index;$i++)
							{
								echo "<div id='t'> <b><u>Test Name: $testname[$i] :</u></b></div>" ;
								echo "<br>";

								echo "<table align='center' border='4pt'>" ;
											
								echo "<tr>" ;

								echo "<td align='center' width='30%' height='50'>" ;
								echo "<b><u>Parameter_Name</u></b>" ;
								echo "</td>" ;

								echo "<td align='center' width='20%' height='50'>" ;
								echo "<b><u>Value</u></b>" ;
								echo "</td>" ;

								echo "<td align='center' width='20%' height='50'>" ;
								echo "<b><u>Max_Value</u></b>" ;
								echo "</td>" ;

								echo "<td align='center' width='20%' height='50'>" ;
								echo "<b><u>Min_Value</u></b>" ;
								echo "</td>" ;

								echo "<td align='center' width='20%' height='40'>" ;
								echo "<b><u>Unit</u></b>" ;
								echo "</td>" ;
								
								echo "</tr>" ;
								echo "<tr></tr>" ;
								
								$id=$testid[$i];
								if($isparameter[$i]==1)
								{
									$query="select Parameters.Parameter_id,Parameter_name,Max_value,Min_value ,Unit from Contains,Test,Parameters where Contains.Test_id=Test.Test_id and Test.Test_id='$id' and Contains.Parameter_id=Parameters.Parameter_id";
									$result=mysqli_query($conn,$query);
									$j=0;
									if($result)
									{
										while($row=mysqli_fetch_assoc($result))
										{
											$parameterid[$j]=$row['Parameter_id'];
											$parametername[$j]=$row['Parameter_name'];
											$max[$j]=$row['Max_value'];
											$min[$j]=$row['Min_value'];
											$unit[$j]=$row['Unit'];
											$j=$j+1;
										}
										for($k=0;$k<$j;$k++)
										{
											$query1="select Value from Consists_of_package where Report_id='$reportid' and Parameter_id='$parameterid[$k]'" ;
											$result1=mysqli_query($conn,$query1);
											if($result1)
											{
												if($row=mysqli_fetch_assoc($result1))
												{
													$value[$k]=$row['Value'];
												}
											}
										}
										for($k=0;$k<$j;$k++)
										{
											echo "<tr>" ;

											echo "<td align='center' width='20%' height='40'>" ;
											echo $parametername[$k];
											echo "</td>" ;

											echo "<td align='center' width='20%' height='40'>" ;
											echo $value[$k] ;
											echo "</td>" ;

											echo "<td align='center' width='20%' height='40'>" ;
											echo $max[$k] ;
											echo "</td>" ;

											echo "<td align='center' width='20%' height='40'>" ;
											echo $min[$k] ;
											echo "</td>" ;

											echo "<td align='center' width='20%' height='40'>" ;
											if($unit[$k]=='')
												echo "---";
											else
												echo $unit[$k];
											echo "</td>" ;
											
											echo "</tr>" ;
										}
										echo "</table>";
										echo "<br>";
									}

								}
							}
							if($comments!='')
							{
								echo "<br>";
								
								echo "<div id='t'> <b><u>Comments : </u></b></div>" ;
								echo "<div id='t'>" ;

								echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ;
								
								for($j=0;$j<strlen($comments);$j++)
								{
									
									$x=$comments[$j];
									echo $x;
									if($x=='.')
									{
										echo "<br>";
										echo "&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp" ;

									}
								}
								echo "</div>"	;
							}

					}
				}
			?>
			<br>
		<form action="print_report.php" method="POST">
			<table align='center'>
					<tr></tr>
					<tr>
						<td></td>
						<td>
							<button type="submit" class="btn btn-default" id="submit">Print</button>
						</td>
						</tr>
				</table>
			</form>
	</body>
</html>