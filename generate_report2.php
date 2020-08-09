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
    height: 320px; 
    opacity:0.4; 
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
.contain{
	background-color:aliceblue;
    opacity:0.6;
   font-size: 16px;
    width: 500px;
    height: 340px; 
    opacity:0.6; 
    padding: 15px;
     margin: 12px;  
     color:black;
     font-family: Arial;
     text-decoration: bold;
     display:block;
     position: absolute;
     top:36%;
     left:30%;

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
#label{
  padding-left : 40px;
  padding-right : 15px;
  text-align : center ;
}
</style>

</head>
<body>
	<div class="jumbotron">
  <center>
<h1>DEXTER DIAGNOSTIC LAB</h1>
</center>
</div> 
</body>
<?php

	session_start();

	$type=$_SESSION["type"];
	$labid=$_SESSION["labid"];


	$servername="localhost";
	$username="root";
	$password="";
	$db="lab";

	$conn=new mysqli($servername,$username,$password,$db);
	if($conn)
	{
		if(isset($_POST['form']))
     	{
        	switch ($_POST['form']) 
       		{
            	case "C": if($type=="Test")
            				{
								$bookid=$_POST["bookid"];
								$_SESSION["bookid"]=$bookid;
								
								//echo $bookid;
								$query="select Cust_id,is_parameter,Test.Test_id,Test_name from Test,Book_test where Book_id=$bookid and Test.Test_id=Book_Test.Test_id" ;
								$result=mysqli_query($conn,$query);
								if($result)
								{
									if($row=mysqli_fetch_assoc($result))
									{
										$cust_id=$row["Cust_id"];
										$_SESSION["cust_id"]=$cust_id;
										$is_parameter=$row["is_parameter"];
										$_SESSION["is_parameter"]=$is_parameter;
										$testid=$row['Test_id'];
										$_SESSION["testid"]=$testid;
										$testname=$row["Test_name"];
										$_SESSION["testname"]=$testname;
										/*echo $is_parameter;
										echo $testname ;*/

										$query="select Doctor_name from Offers_test where Test_id=$testid and Lab_id=$labid";
										$result=mysqli_query($conn,$query);
										if($result)
										{
											if($row=mysqli_fetch_assoc($result))
											{
												$dname=$row['Doctor_name'];
											}
										}
										$query="select Fname,Lname,Email from Patient where Cust_id=$cust_id";
										$result=mysqli_query($conn,$query);
										if($result)
										{
											if($row=mysqli_fetch_assoc($result))
											{
												$fname=$row["Fname"];
												$lname=$row["Lname"];
												$name=$fname."  ".$lname;
												$email=$row["Email"];
												$_SESSION["email"]=$email;
											}
										}

										if($is_parameter==1)	//parameter exists 
										{
											$query="select Parameters.Parameter_id,Parameter_name,max_value,min_value,unit from Contains,Parameters where Test_id=$testid and Parameters.Parameter_id=Contains.Parameter_id";
											$result=mysqli_query($conn,$query);
											if($result)
											{
												$count=0;
												$_SESSION['Parameter_id']=array();
												$_SESSION['Parameter_name']=array();
												$_SESSION['max_value']=array();
												$_SESSION['min_value']=array();
												$_SESSION['unit']=array();
												while($row=mysqli_fetch_assoc($result))
												{
													$parameter_id[$count]=$row["Parameter_id"];
													//echo $parameter_id[$count];
													array_push($_SESSION['Parameter_id'],$parameter_id[$count]);
													$parameter_name[$count]=$row["Parameter_name"];
													array_push($_SESSION['Parameter_name'],$parameter_name[$count]);
													$max_value[$count]=$row["max_value"];
													array_push($_SESSION['max_value'],$max_value[$count]);
													$min_value[$count]=$row["min_value"];
													array_push($_SESSION['min_value'],$min_value[$count]);
													$unit[$count]=$row["unit"];
													array_push($_SESSION['unit'],$unit[$count]);
													$count=$count+1;
												}
												//print_r($parameter_name);
											}?>
												<html>
													<style>
													#t1{
														font-size : 18pt ;
													}
													#comment{
														width : 700px;
														height : 200px;
													}
													#text{
													font-size : 15pt;
													}
													</style>
													<body>
													<form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
													     <center>  
													     	<input type="hidden" name="form" value="D">
												    	<div class="form-group section-filter">
												      	<div class="col-sm-12 form-inline">
												      		<h1><u><b>Report Generation(For <?php echo $type.')' ; ?></b></u></h1>
												      		<h3 align='center'><b><u><?php echo "Test Name : " ;echo $testname ;?></u></b></h3>
															<h3 align='center'><b><u><?php echo "Doctor Name : " ;echo $dname ;?></u></b></h3><br>
															<p  id="text" align='center'><b><u>Book-id : &nbsp&nbsp <?php echo "BK-" ;echo $bookid ;?></u></b>  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
																 <b><u>Cust-id : &nbsp&nbsp <?php echo "Cust-" ; echo $cust_id ;?></u></b>
																 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
																 <b><u>Cust-Name : &nbsp&nbsp <?php  echo $name ;?></u></b>
															</p>
												      		<br>
												        <table align='center' border='2pt'>
												          <tr>
												            <td id="t1" width='20%' height='80' align='center'><b><u>Parameter Name</u></b></td>
												            <td id="t1" width='20%' height='50' align='center'><b><u>Max_Value</u></b></td>
												            <td id="t1" width='20%' height='50' align='center'><b><u>Min_Value</u></b></td>
												            <td id="t1" width='20%' height='50' align='center'><b><u>Value</u></b></td>
												             <td id="t1" width='20%' height='50' align='center'><b><u>Unit</u></b></td>
												          </tr>
													      <?php
													      $i=0;
													      foreach ($_SESSION['Parameter_id'] as $key=>$value)
												   		  {
													        $parameter_id[$i]=$value;
													        $i=$i+1;
													       }
													       
													      $i=0;
													      foreach ($_SESSION['Parameter_name'] as $key=>$value)
												   		  {
													        $parameter_name[$i]=$value;
													        $i=$i+1;
													       }
													       $i=0;
													       foreach ($_SESSION['max_value'] as $key=>$value)
												   		  {
													        $max_value[$i]=$value;
													        $i=$i+1;
													       }
													       $i=0;
													       foreach ($_SESSION['min_value'] as $key=>$value)
												   		  {
													        $min_value[$i]=$value;
													        $i=$i+1;
													       }
													       $i=0;
													       foreach ($_SESSION['unit'] as $key=>$value)
												   		  {
													        $unit[$i]=$value;
													        $i=$i+1;
													       }
													       $count=$i;
													       $_SESSION["count"]=$count ;
												          	for($j=0;$j<$count;$j++)
												          	{
												          		echo "<tr>" ;
												            	echo "<td id='t1' width='20%' height='40' align='center'>$parameter_name[$j]</td>" ;
												                echo "<td id='t1' width='20%' height='40' align='center'>$max_value[$j]</td>" ;
												                echo "<td id='t1' width='20%' height='40' align='center'>$min_value[$j]</td>" ;
												                echo "<td id='t1' width='20%' height='40' align='center'><input type='text' style='width: 10em' name='p-".$j."' placeholder=' Enter the value'/></td>" ;
												                echo "<td id='t1' width='20%' height='40' align='center'>$unit[$j]</td>" ;
												            	echo "</tr>" ;
												          	}
												          ?>
													    </table>
													     <div>
													     </div>
													     <br><br><br>
													     <h1 align='center'><b><u> Comments :</u></b> </h1>
								    						<textarea name="comment" id="comment" rows="10" tabindex="10"  required="required"></textarea>
								    						<br><br><br>
													     <center> <button type="submit" class="btn btn-default">Submit</button></center>
													     </form>
													    </body>
													    </html>
										<?php  }
										else
										{
											//echo "No parameter";?>
											<html>
											<style>
												#comment{
														width : 700px;
														height : 200px;
													}
												#text{
													font-size : 15pt;
												}
											</style>
											<body>
											<h1 align='center'><u><b>Report Generation(For <?php echo $type.')' ; ?></b></u></h1>
											<h3 align='center'><b><u><?php echo "Test Name : " ;echo $testname ;?></u></b></h3>
											<br>
											<p  id="text" align='center'><b><u>Book-id : &nbsp&nbsp <?php echo "BK-" ;echo $bookid ;?></u></b>  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
												 <b><u>Cust-id : &nbsp&nbsp <?php echo "Cust-" ; echo $cust_id ;?></u></b>
												 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
												 <b><u>Cust-Name : &nbsp&nbsp <?php  echo $name ;?></u></b>
											</p>
											
											<form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
													     <center>  
													     	<input type="hidden" name="form" value="D">
													     	<br>
													    	 <h1 align='center'><b><u> Comments :</u></b> </h1>
								    						<textarea name="comment" id="comment" rows="10" tabindex="10"  required="required"></textarea>
								    						<br><br><br>
													     <center> <button type="submit" class="btn btn-default">Submit</button></center>
														</center>	
											</form>
											</body>
											</html>
										<?php
										}

									}
								}
							}
							else //report for package
							{
								$bookid=$_POST["bookid"];
								$_SESSION["bookid"]=$bookid;

								$query="select Cust_id,Package.Package_id,Package_name from Package,Book_Package where Book_id=$bookid and Package.Package_id=Book_Package.Package_id" ;
								$result=mysqli_query($conn,$query);
								if($result)
								{
									if($row=mysqli_fetch_assoc($result))
									{
										$cid=$row["Cust_id"];
										$packageid=$row["Package_id"];
										$packagename=$row["Package_name"];
										/*echo $cid ;
										echo $packageid ;
										echo $packagename ;*/
									}
									$query="select Test.Test_id,Test_name,is_parameter from Have_tests,Test where Have_tests.Test_id=Test.Test_id and Have_tests.Package_id=$packageid";
									$result=mysqli_query($conn,$query);
									if($result)
									{
										$c=0;
										$_SESSION['testid_list']=array();
										$_SESSION['testname_list']=array();
										$_SESSION['isparameter_list']=array();
												
										while($row=mysqli_fetch_Assoc($result))
										{
											$testid_list[$c]=$row["Test_id"];
											array_push($_SESSION['testid_list'],$testid_list[$c]);
											$testname_list[$c]=$row["Test_name"];
											array_push($_SESSION['testname_list'],$testname_list[$c]);
											$isparameter_list[$c]=$row["is_parameter"];
											array_push($_SESSION['isparameter_list'],$isparameter_list[$c]);

											$query1="select Doctor_name from Offers_test where Lab_id=$labid and Test_id=$testid_list[$c]";
											$result1=mysqli_query($conn,$query1);
											if($result1)
											{
												if($row1=mysqli_fetch_assoc($result1))
												{
													$dlist[$c]=$row1['Doctor_name'];
												}
											}

											$c=$c+1;
										}
										$number_of_tests=$c-1;
										$_SESSION["number_of_tests"]=$number_of_tests;
										/*print_r($testid_list);
										print_r($testname_list);
										print_r($isparameter_list);
										print_r($dlist);*/

										$query="select Fname,Lname,Email from Patient where Cust_id=$cid";
										$result=mysqli_query($conn,$query);
										if($result)
										{
											if($row=mysqli_fetch_assoc($result))
											{
												$fname=$row['Fname'];
												$lname=$row['Lname'];
												$name=$fname.'  '.$lname;
												$email=$row['Email'];
												$_SESSION["email"]=$email;
												/*echo $name;
												echo $email;*/
											}
										}
										?>
										<html>
											<style>
											#t1{
												font-size : 18pt ;
											}
											#comment{
												width : 700px;
												height : 200px;
											}
											#text{
											font-size : 15pt;
											}

											</style>
											<body>
											<form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
											     <center>  
											     	<input type="hidden" name="form" value="D">
										    	<div class="form-group section-filter">
										      	<div class="col-sm-12 form-inline">
										      		<h1><u><b>Report Generation(For <?php echo $type.')' ; ?></b></u></h1>
										      		<h3 align='center'><b><u><?php echo "Package Name : " ;echo $packagename ;?></u></b></h3>
													<br>
													<p  id="text" align='center'><b><u>Book-id : &nbsp&nbsp <?php echo "BK-" ;echo $bookid ;?></u></b>  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
														 <b><u>Cust-id : &nbsp&nbsp <?php echo "Cust-" ; echo $cid ;?></u></b>
														 &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
														 <b><u>Cust-Name : &nbsp&nbsp <?php  echo $name ;?></u></b>
													</p>
										      		<br> 
										     		
												<?php
												$pc=0;		//parameter_id_counter
												$_SESSION["no_of_parameters"]=array();//per test
												$_SESSION["parameter_id_list"]=array();
												for($i=0;$i<=$number_of_tests;$i++)
												{
													if($isparameter_list[$i]==1)
													{
										        		echo "<h2 align='center'><b><u>Test name : $testname_list[$i]</u></b></h2>" ;
										        		echo "<h3 align='center'><b><u>Doctor name : $dlist[$i]</u></b></h3>" ;
										        		echo "<table align='center' border='2pt'>" ;
											            echo "<tr>";
											            echo "<td id='t1' width='20%' height='80' align='center'><b><u>Parameter Name</u></b></td>" ;
											            echo "<td id='t1' width='20%' height='50' align='center'><b><u>Max_Value</u></b></td>" ;
											            echo "<td id='t1' width='20%' height='50' align='center'><b><u>Min_Value</u></b></td>" ;
											           echo " <td id='t1' width='20%' height='50' align='center'><b><u>Value</u></b></td>";
											             echo "<td id='t1' width='20%' height='50' align='center'><b><u>Unit</u></b></td>" ;
											          echo "</tr>" ;
											          $query="select Parameter_name,max_value,min_value,unit,Parameters.Parameter_id from Parameters,Contains where Contains.Parameter_id=Parameters.Parameter_id and Contains.Test_id=$testid_list[$i]";

											          $result=mysqli_query($conn,$query);
											          if($result)
											          {
											          		$count_p=0;
											          		while($row=mysqli_fetch_assoc($result))
											          		{
												          		$pname=$row['Parameter_name'];
												          		$pmax=$row['max_value'];
												          		$pmin=$row['min_value'];
												          		$punit=$row['unit'] ;
												          		$parameter_id_list[$pc]=$row['Parameter_id'];
												          		array_push($_SESSION['parameter_id_list'],$parameter_id_list[$pc]);
												          		$pc=$pc+1;

												          		echo "<tr>";
												            	echo "<td id='t1' width='20%' height='40' align='center'>$pname</td>" ;
												            	echo "<td id='t1' width='20%' height='40' align='center'>$pmax</td>" ;
												            	echo "<td id='t1' width='20%' height='40' align='center'>$pmin</td>" ;
												           		echo "<td id='t1' width='20%' height='40' align='center'><input type='text' style='width: 10em' name='p-".$i."".$count_p."' placeholder=' Enter the value'/></td>" ;
												             	echo "<td id='t1' width='20%' height='40' align='center'>$punit</td>" ;
												          		echo "</tr>" ;
												          		$count_p=$count_p+1;
											          		}
											          }
											          echo "</table>" ;
											      }
											       $no_of_parameters[$i]=$count_p-1;
											       array_push($_SESSION['no_of_parameters'],$no_of_parameters[$i]);
											      }
											      $_SESSION["pc"]=$pc-1;
											      //print_r($no_of_parameters);
											      //print_r($parameter_id_list);
										     echo "</div>" ;
										echo  "</div>" ;
										echo "<h1 align='center'><b><u> Comments :</u></b> </h1>" ;
								    	echo "<textarea name='comment' id='comment' rows='10' tabindex='10'  required='required'></textarea>
								    						<br><br><br>" ;
										echo "<center> <button type='submit' class='btn btn-default'>Submit</button></center>" ;
										echo "</center>" ;
									echo "</form>" ;
								echo "</body>" ;
								echo "</html>" ;


									}
								}

							}
							 break;
							
				case "D" : //echo "self"; 
							if($type=="Test")
							{
								$is_parameter=$_SESSION["is_parameter"];
								$bookid=$_SESSION["bookid"];
								$comments=$_POST["comment"];
								$email=$_SESSION["email"];
								//$today=date("d/m/y");

								$today=date("d/m/y");
								$day=substr($today,0,2);
								$month=substr($today,3,2);
								$year=substr($today,6,2);
								$year="20".$year;

								$today=$year.'-'.$month.'-'.$day;
								//echo $today ;
								if($is_parameter==1) //parameter exists
								{
									$i=0;
							       foreach ($_SESSION['Parameter_id'] as $key=>$value)
						   		  {
							        $parameter_id[$i]=$value;
							        $i=$i+1;
							       }
							       $count=$i;

						   		 for($j=0;$j<$count;$j++)
									{
										$arr[$j]=$_POST["p-$j"];
									}
						   			
						   			//echo $comments;
						   			
						   			$query="insert into Report_test(Book_id,Generation_date,Comments) values($bookid,'$today','$comments')";
						   			$result=mysqli_query($conn,$query);

						   			if($result)
						   			{
						   				$query="select max(Report_id) from Report_test";
						   				$result=mysqli_query($conn,$query);
						   				if($result)
						   				{
						   					if($row=mysqli_fetch_assoc($result))
						   					{
						   						$report_id=$row['max(Report_id)'];
						   						//echo $report_id ;
						   						$_SESSION["report_id"]=$report_id;
						   					}
						   				}
						   				for($j=0;$j<$count;$j++)
						   				{
						   					$query="insert into Consists_of_test values($report_id,$parameter_id[$j],$arr[$j])" ;
						   					$result=mysqli_query($conn,$query);
						   				}
						   				echo "<script type='text/javascript'>";
			                            echo "window.alert ('Report is succesfully generated!!')";
			                            echo "</script>";
			                         
			                           
			                            if(mail("$email","About Report","Your Report has been Sucessfully generated!!","From: DoNotReply@abe1112.com"))
											echo "<script type='text/javascript'>alert('Confirmation email sent!!')</script>";
										else
											echo "<script type='text/javascript'>alert('error!!')</script>";
						   			}
						   		}
						   		else //no parameter 
						   		{
						   			$query="insert into Report_test(Book_id,Generation_date,Comments) values($bookid,'$today','$comments')";
						   			$result=mysqli_query($conn,$query);
						   			if($result)
						   			{
						   				echo "<script type='text/javascript'>";
			                            echo "window.alert ('Report is succesfully generated!!')";
			                            echo "</script>";

			                            if(mail("$email","About Report","Your Report has been Sucessfully generated!!","From: DoNotReply@abe1112.com"))
											echo "<script type='text/javascript'>alert('Confirmation email sent!!')</script>";
										else
											echo "<script type='text/javascript'>alert('error!!')</script>";
			                            
						   			}
						   		}
						   	}	
						   	else
						   	{
						   		//echo "Package";
						   		$bookid=$_SESSION["bookid"];
								$comments=$_POST["comment"];
								$email=$_SESSION["email"];
								//$today=date("d/m/y");
								$today=date("d/m/y");
								$day=substr($today,0,2);
								$month=substr($today,3,2);
								$year=substr($today,6,2);
								$year="20".$year;

								$today=$year.'-'.$month.'-'.$day;
								//echo $today ;
								$number_of_tests=$_SESSION["number_of_tests"];
								/*echo $number_of_tests;
								echo $bookid;
								echo $comments;*/

								$query="insert into Report_package(Book_id,Generation_date,Comments)values($bookid,'$today','$comments')";
								$result=mysqli_query($conn,$query);
								if($result)
								{
									//echo "sucess";
									$query="select max(Report_id) from Report_package";
									$result=mysqli_query($conn,$query);
									if($result)
									{
										if($row=mysqli_fetch_assoc($result))
										{
											$reportid=$row['max(Report_id)'];
											//echo $reportid ;
										}
									}
								}

								$i=0;
								 foreach ($_SESSION['no_of_parameters'] as $key=>$value) // per test number of parameters
						   		  {
							        $no_of_parameters[$i]=$value;
							        $i=$i+1;
							       }
							     $i=0;
								 foreach ($_SESSION['parameter_id_list'] as $key=>$value) // total number of parameters
								 {
							        $parameter_id_list[$i]=$value;
							        $i=$i+1;
							      }  
							       //print_r($parameter_id_list);
							      $m=0;
								for($j=0;$j<=$number_of_tests;$j++)
								{
									$x=$no_of_parameters[$j];
									//echo $x;
									for($k=0;$k<=$x;$k++)
									{
										$pval=$_POST["p-$j$k"];
										$pid=$parameter_id_list[$m];
										$m=$m+1;

										$query="insert into Consists_of_package values($reportid,$pid,$pval)";
										$result=mysqli_query($conn,$query) ;
										
									}
									//print_r($arr);
								}
								echo "<script type='text/javascript'>";
		                        echo "window.alert ('Report is succesfully generated!!')";
		                        echo "</script>";

		                        if(mail("$email","About Report","Your Report has been Sucessfully generated!!","From: DoNotReply@abe1112.com"))
										echo "<script type='text/javascript'>alert('Confirmation email sent!!')</script>";
								else
									echo "<script type='text/javascript'>alert('error!!')</script>";
						   	}
						   	session_destroy();
						    break;
			}
		}
	}	
	
?>
