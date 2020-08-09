<?php
	session_start();
	$book_id=$_SESSION["book_id"];
	$lab_name=$_SESSION["lab_name"];
	$package_name=$_SESSION["package_name"];
	$cust_name=$_SESSION["cust_name"];
	$test_date=$_SESSION["test_date"];
	$time=$_SESSION["time"];
	$charge=$_SESSION["charge"];
	$t_id=$_SESSION["t_id"];
	$tdate=$_SESSION["tdate"];
	$ttime=$_SESSION["ttime"];
	$amount=$_SESSION["amount"];

	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		require("fpdf/fpdf.php");
		$pdf=new FPDF();
		$pdf->AddPage();
		$pdf->SetFont("Arial","B",16);
		$pdf->Cell(0,10,"Payment Receipt",1,1,"C");

		$pdf->Cell(100,10,"Book-id: ",1,0,"C");
		$pdf->Cell(90,10,'BK-'.$book_id,1,1,"C");

		$pdf->Cell(100,10,"Lab Name: ",1,0,"C");
		$pdf->Cell(90,10,$lab_name,1,1,"C");

		$pdf->Cell(100,10,"Package Name: ",1,0,"C");
		$pdf->Cell(90,10,$package_name,1,1,"C");

		$pdf->Cell(100,10,"Customer Name: ",1,0,"C");
		$pdf->Cell(90,10,$cust_name,1,1,"C");

		$pdf->Cell(100,10,"Test Date: ",1,0,"C");
		$pdf->Cell(90,10,$test_date,1,1,"C");

		$pdf->Cell(100,10,"Test Time: ",1,0,"C");
		$pdf->Cell(90,10,$time,1,1,"C");

		$pdf->Cell(100,10,"Charge: ",1,0,"C");
		$pdf->Cell(90,10,$charge.'/-',1,1,"C");

		$pdf->Cell(100,10,"Transaction-id: ",1,0,"C");
		$pdf->Cell(90,10,'TR-'.$t_id,1,1,"C");

		$pdf->Cell(100,10,"Transaction Date: ",1,0,"C");
		$pdf->Cell(90,10,$tdate,1,1,"C");

		$pdf->Cell(100,10,"Transaction Time: ",1,0,"C");
		$pdf->Cell(90,10,$ttime,1,1,"C");

		$pdf->Cell(100,10,"Transaction Amount: ",1,0,"C");
		$pdf->Cell(90,10,$amount.'/-',1,1,"C");

		$pdf->output();
	}
	session_destroy();
	
?>