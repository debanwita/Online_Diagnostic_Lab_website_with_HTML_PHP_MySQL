<html>
	<head>
		<title>Book a Test</title>
		<link rel="stylesheet" href="css/payment.css">
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
		<center> <h1>DEXTER DIAGNOSTIC LAB</h1></center>
           </center>
            </div>
			<center><h2><b><font style="Arial" color="white">CREDIT CARD DETAILS</font></b></h2></center>		
			<form class="form-inline" action="payment_package2.php" method="post">
				<div class="creditCardForm">
    			<div class="payment">
            		<div class="form-group owner">
                			<label for="owner">Owner</label>
                			<input type="text" class="form-control" id="owner" name="owner" placeholder="Enter the name"/>
            		</div>
            		<div class="form-group CVV">
               				 <label for="cvv">CVV</label>
                			<input type="text" class="form-control" id="cvv" placeholder="- - -"/>
            		</div>
           			 <div class="form-group" id="card-number-field">
               				 <label for="cardNumber">Card Number</label>
                			<input type="text" class="form-control" id="cardNumber" placeholder="- - - -   - - - -  - - - -  - - - - "/>
           			 </div>
           			<div class="form-group" id="expiration-date">
						<label>Expiration Date</label>
						<select>
						<option value="01">January</option>
						<option value="02">February </option>
						<option value="03">March</option>
						<option value="04">April</option>
						<option value="05">May</option>
						<option value="06">June</option>
						<option value="07">July</option>
						<option value="08">August</option>
						<option value="09">September</option>
						<option value="10">October</option>
						<option value="11">November</option>
						<option value="12">December</option>
						</select>
						<select>
						<option value="16"> 2016</option>
						<option value="17"> 2017</option>
						<option value="18"> 2018</option>
						<option value="19"> 2019</option>
						<option value="20"> 2020</option>
						<option value="21"> 2021</option>
						</select>
           			 </div>
          			
					<div class="form-group" id="pay-now">
						<input type="submit" class="btn btn-default" id="confirm-purchase" name="PAY"/>
					</div>
    			</div>
			</div>
		</form>
	</body>
</html>