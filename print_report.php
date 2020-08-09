<?php
	session_start();

	$type=$_SESSION['type'];
	if($type=='Test')
	{
		$labname=$_SESSION['labname'];
		$tname=$_SESSION['tname'];
		$is=$_SESSION['is'];
		$dname=$_SESSION['dname'];
		$pname=$_SESSION['pname'];
		$max=$_SESSION['max'];
		$min=$_SESSION['min'];
		$unit=$_SESSION['unit'];
		$pid=$_SESSION['pid'];
		$index=$_SESSION['index'];
		$reportid=$_SESSION['reportid'];
		$bookid=$_SESSION['bookid'];
		$custname=$_SESSION['custname'];
		$comments=$_SESSION['comments'];
		$age=$_SESSION['age'];
		$gdate=$_SESSION['gdate'];
		
		//echo $comments ;

		$i=0;
		foreach ($_SESSION['pname'] as $key=>$value)
	    {
	        $parameter_name[$i]=$value;
	        $i=$i+1;
	    }
	    
	    $index=$i-1;
	    
	    $servername="localhost";
		$username="root";
		$password="";
		$db="lab";

		$conn=new mysqli($servername,$username,$password,$db);
		$i=0;	
	    foreach ($_SESSION['pid'] as $key=>$value)
	    {
	    	$query="select Value from Consists_of_test where Report_id='$reportid' and Parameter_id='$value'";
	    	$result=mysqli_query($conn,$query);
	    	if($result)
	    	{
	    		if($row=mysqli_fetch_assoc($result))
	    		{
	    			$paraval[$i]=$row['Value'];
	    			$i=$i+1;
	    		}
	    	}
		}

	    $i=0;
	    foreach ($_SESSION['max'] as $key=>$value)
	    {
	        $max[$index]=$value;
	        $i=$i+1;
	    }
	   // print_r($max);

	    $i=0;
	    foreach ($_SESSION['min'] as $key=>$value)
	    {
	        $min[$index]=$value;
	        $i=$i+1;
	    }

	    $i=0;
	    foreach ($_SESSION['pid'] as $key=>$value)
	    {
	        $pid[$index]=$value;
	        $i=$i+1;
	    }
	    //print_r($min);

	    $i=0;
	    foreach ($_SESSION['unit'] as $key=>$value)
	    {
	        $unit[$index]=$value;
	        $i=$i+1;
	    }
	    //print_r($unit);
	    if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			require("fpdf/fpdf.php");
			$pdf=new FPDF();
			$pdf->AddPage();
			$pdf->SetFont("Arial","B",20);
			$pdf->Cell(0,10,"Test Report",1,1,"C");

			$pdf->SetFont("Arial","B",10);
			$pdf->Cell(100,10,"Lab Name: ",1,0,"C");
			$pdf->Cell(90,10,$labname,1,1,"C");

			$pdf->Cell(100,10,"Test Name: ",1,0,"C");
			$pdf->Cell(90,10,$tname,1,1,"C");

			$custname=$custname.' '.'(Age: '.$age.')';

			$pdf->Cell(100,10,"Patient Name: ",1,0,"C");
			$pdf->Cell(90,10,$custname,1,1,"C");

			$pdf->Cell(100,10,"Doctor Name: ",1,0,"C");
			$pdf->Cell(90,10,$dname,1,1,"C");

			$pdf->Cell(100,10,"Report Date: ",1,0,"C");
			$pdf->Cell(90,10,$gdate,1,1,"C");

			if($is==1)
			{
				$pdf->Cell(0,10,"Test Parameter Details",1,1,"C");

				$pdf->Cell(70,10,"Parameter Name ",1,0,"C");
				$pdf->Cell(40,10,"Value",1,0,"C");
				$pdf->Cell(20,10,"Max Value",1,0,"C");
				$pdf->Cell(20,10,"Min Value",1,0,"C");
				$pdf->Cell(40,10,"Uint",1,1,"C");
			
				for($i=0;$i<=$index;$i++)
				{
					$name=$parameter_name[$i];
					$maxvalue=$max[$i];
					$minvalue=$min[$i];
					$u=$unit[$i];
					$v=$paraval[$i];
					
					$pdf->Cell(70,10,$name,1,0,"C");
					$pdf->Cell(40,10,$v,1,0,"C");
					$pdf->Cell(20,10,$maxvalue,1,0,"C");
					$pdf->Cell(20,10,$minvalue,1,0,"C");
					$pdf->Cell(40,10,$u,1,1,"C");
				}
			}

			if($comments!='')
			{
				$pdf->Cell(0,10,"Comments",1,1,"C");
				$start=0;
				$displacement=0;
				for($j=0;$j<strlen($comments);$j++)
				{							
					$x=$comments[$j];
					if($x=='.')
					{
						$pdf->Cell(0,10,substr($comments,$start,$displacement),1,1,"C");

						$start=$j+1;
						$displacement=0;
					}
					else
					{
						$displacement=$displacement+1;
					}
										
				}
				$pdf->output();
			}
		}
	}
	else //package
	{
		$testname=$_SESSION['testname'];
		$testid=$_SESSION['testid'];
		$isparameter=$_SESSION['isparameter'];
		$packagename=$_SESSION['packagename'];
		$labname=$_SESSION['labname'];
		$labid=$_SESSION['labid'];
		$custname=$_SESSION['custname'];
		$gdate=$_SESSION['gdate'];
		$age=$_SESSION['age'];
		$reportid=$_SESSION['reportid'];
		$comments=$_SESSION['comments'];

		$i=0;
		foreach ($_SESSION['testname'] as $key=>$value)
	    {
	        $testname[$i]=$value;
	        $i=$i+1;
	    }
	    $index=$i-1;

	    foreach ($_SESSION['testid'] as $key=>$value)
	    {
	        $testid[$i]=$value;
	    }
	    foreach ($_SESSION['isparameter'] as $key=>$value)
	    {
	        $isparameter[$i]=$value;
	    }
	    if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			require("fpdf/fpdf.php");
			$pdf=new FPDF();
			$pdf->AddPage();
			$pdf->SetFont("Arial","B",20);
			$pdf->Cell(0,10,"Package Report",1,1,"C");

			$pdf->SetFont("Arial","B",10);
			$pdf->Cell(100,10,"Lab Name: ",1,0,"C");
			$pdf->Cell(90,10,$labname,1,1,"C");

			$pdf->Cell(100,10,"Package Name: ",1,0,"C");
			$pdf->Cell(90,10,$packagename,1,1,"C");

			$custname=$custname.' '.'(Age: '.$age.')';

			$pdf->Cell(100,10,"Patient Name: ",1,0,"C");
			$pdf->Cell(90,10,$custname,1,1,"C");


			$pdf->Cell(100,10,"Report Date: ",1,0,"C");
			$pdf->Cell(90,10,$gdate,1,1,"C");


		    $servername="localhost";
			$username="root";
			$password="";
			$db="lab";

			$conn=new mysqli($servername,$username,$password,$db);

			for($i=0;$i<=$index;$i++)
			{
				//$pdf->Cell(100,10,"Test Name: ",1,0,"C");
				$x=$testname[$i];
				$tid=$testid[$i];
				//$pdf->Cell(90,10,$x,1,1,"C");
				$pdf->Cell(0,10,"Test Name : $x",1,1,"C");

				$query2="select Doctor_name from Offers_test where Lab_id=$labid and Test_id=$tid";
				$result2=mysqli_query($conn,$query2);
				if($result2)
				{
					if($row2=mysqli_fetch_assoc($result2))
					{
						$dname=$row2['Doctor_name'];
						$pdf->Cell(0,10,"Doctor Name : $dname",1,1,"C");
					}
				}

				if($isparameter[$i]==1) //parameter exists
				{
					
					$pdf->Cell(70,10,"Parameter Name ",1,0,"C");
					$pdf->Cell(40,10,"Value",1,0,"C");
					$pdf->Cell(20,10,"Max Value",1,0,"C");
					$pdf->Cell(20,10,"Min Value",1,0,"C");
					$pdf->Cell(40,10,"Uint",1,1,"C");

					$query="select Parameters.Parameter_id,Parameter_name,max_value,min_value,unit from Parameters,Contains where Contains.Test_id=$tid and Contains.Parameter_id=Parameters.Parameter_id";
					$result=mysqli_query($conn,$query);

					if($result)
					{
						$count=0;
						while($row=mysqli_fetch_assoc($result))
						{
							$paraid=$row['Parameter_id'];
							$paraname=$row['Parameter_name'];
							$max_value=$row['max_value'];
							$min_value=$row['min_value'];
							$unit=$row['unit'];

							$query1="select Value from Consists_of_package where Report_id=$reportid and Parameter_id=$paraid ";
							$result1=mysqli_query($conn,$query1);
							if($result1)
							{
								if($row1=mysqli_fetch_assoc($result1))
								{
									$value=$row1['Value'];
								}
							}


							$pdf->Cell(70,10,$paraname,1,0,"C");
							$pdf->Cell(40,10,$value,1,0,"C");
							$pdf->Cell(20,10,$max_value,1,0,"C");
							$pdf->Cell(20,10,$min_value,1,0,"C");
							if($unit=='')
								$pdf->Cell(40,10,"---",1,1,"C");
							else
								$pdf->Cell(40,10,$unit,1,1,"C");

							$count=$count+1;
						}
					}
				}
				else
					$pdf->Cell(0,10,"(See comments section)",1,1,"C");

			}
			if($comments!='')
			{
				$pdf->Cell(0,10,"Comments",1,1,"C");
				$start=0;
				$displacement=0;
				for($j=0;$j<strlen($comments);$j++)
				{							
					$x=$comments[$j];
					if($x=='.')
					{
						$pdf->Cell(0,10,substr($comments,$start,$displacement),1,1,"C");

						$start=$j+1;
						$displacement=0;
					}
					else
					{
						$displacement=$displacement+1;
					}
										
				}
			}

			$pdf->output();
		}
	}
	session_destroy();
?>
