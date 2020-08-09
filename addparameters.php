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
    background-color:silver;
    opacity:0.6;
   font-size: 16px;
    width: 450px;
    height: 580px; 
    opacity:0.4; 
    padding: 15px;
     margin: 12px;  
     color:black;
     font-family: Arial;
     text-decoration: bold;
     display:block;
}
.contain{
  background-color:grey;
    opacity:0.6;
   font-size: 16px;
    width: 500px;
    height: 420px; 
    opacity:0.6; 
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

option {
  color: black;
}
option[value=""][disabled] {
  display: none;
}
button[type=submit],button[type=reset],input[type=text],input[type=number],input[type=email],input[type=password]{
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
        $pname=$_POST["pname"];
        $max=$_POST["max"];
        $min=$_POST["min"];
        $unit=$_POST["unit"];
        $testid=$_POST["testid"];
        if($conn)
        {
                 
          $q="insert into Parameters(Parameter_name,max_value,min_value,unit)values('$pname',$max,$min,'$unit')" ;

           if($conn->query($q)===TRUE)
          {
            $q1="select Parameter_id from Parameters where Parameter_name='$pname'";
            $result = mysqli_query($conn,$q1);
           if($result)
           {
           while($row=mysqli_fetch_assoc($result)) {
            $c=$row['Parameter_id'];
           }
         }
         $q2="insert into Contains values($testid,$c)";
         if($conn->query($q2)===TRUE){
           echo "<script type='text/javascript'>";
            echo "window.alert ('Insertion is succesfull!!')";
      
                   echo "</script>";
           }
           else
           {
            echo "<script type='text/javascript'>";
            echo "window.alert ('Insertion is unsuccesfull!!')";

                   echo "</script>";
           }
           }      
      }
    }
      $conn->close();
    ?>
  <div class="jumbotron">
  <center>
<h1>DEXTER DIAGNOSTIC LAB</h1>
</center>
</div>
<?php
                  $servername="localhost";
                 $username="root";
                  $password="";
                 $db="lab";
                  $conn=new mysqli($servername,$username,$password,$db);
                if($conn)
        {
          $q1="select Test_id,Test_name from Test" ;
          $result = mysqli_query($conn,$q1);
           if($result)
          {
            $m=1;
             while($row=mysqli_fetch_assoc($result))
             {

                $i[$m]=$row['Test_id'];
                $n1[$m]=$row['Test_name'];
                 $m=$m+1; 
             }
                      
           }
         }
         $conn->close();
         ?>
    <center>
			<div class="contain">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
 <center><legend><h2><b><font style="Arial" color="white"><span>ADD TEST PARAMETER DETAILS</span></font></b></h2></legend></center>
 <div>
    <select class="form-control" name="testid">
                  <option value="" disabled selected>Select Test</option>
                  <?php
                  for($k=1;$k<$m;$k++)
                  {
                    echo "<option value='$i[$k]'>$n1[$k]</option>" ;
                  }
                  ?>
                  </select>
                  
  </div><br/>
 <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter ParameterName:</label>
    &nbsp<input type="text" class="form-control" name="pname" required="required">
  </div>
  <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Max-value:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="number" class="form-control" name="max" required="required" >
  </div>
   <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Min-value:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="number" class="form-control" name="min" required="required">
  </div>
   <div class="form-inline">
    <label for="name"><font color="red">*</font>Enter Unit:</label>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="text" class="form-control" name="unit" required="required">
  </div>
  <br/>
 <center> <button type="submit" class="btn btn-default">Submit</button></center>
</form>
</div>
</center>
</body>
</html>
