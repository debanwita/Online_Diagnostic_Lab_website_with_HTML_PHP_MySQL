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
  <?php
  session_start();

      $servername="localhost";
      $username="root";
      $password="";
      $db="lab";

      $conn=new mysqli($servername,$username,$password,$db);
    
      if(isset($_POST['form']))
      {
        switch ($_POST['form']) 
        {
            case "A":
                    //echo "submitted A";
                    $username=$_POST["name"];
                    $password=$_POST["password"];
                    //$type=$_POST["book"];

                    $labid=$_POST["labid"];
                    $_SESSION["labid"]=$labid;
                   
                    if($conn)
                    {
                      $query="select Admin_name,Admin_password from Lab where Lab_id=$labid";
                      $result=mysqli_query($conn,$query);
                      if($result)
                      {
                        if($row=mysqli_fetch_assoc($result))
                        {
                          $name=$row['Admin_name'];
                          $p=$row['Admin_password'];
                          if($username==$name and $password==$p)
                          {
                            echo "<script type='text/javascript'>";
                            echo "window.alert ('Login is succesfull!!')";
                            echo "</script>";
                          }
                        }
                      }
                    }
                    break;

           case "B":
                 // echo "submitted B";
                  $labid=$_SESSION["labid"];
                  $type=$_POST["type"];
                  $_SESSION["type"]=$type ;
                  //echo $type ;
                  if($type=="Test") //test
                  {
                     $query="select Book_id from Book_test where Lab_id=$labid and Book_id not in (select Book_id from Report_test) ";
                     $result=mysqli_query($conn,$query);
                     if($result)
                     {
                       $i=0;
                       while($row=mysqli_fetch_assoc($result))
                       {
                         $bookid[$i]=$row['Book_id'];
                         $i=$i+1;
                       }
                       $n=$i;
                     }
                  }
                  else //package
                  {
                    //echo "package";
                     $query="select Book_id from Book_package where Lab_id=$labid and Book_id not in (select Book_id from Report_package) ";
                     $result=mysqli_query($conn,$query);
                     if($result)
                     {
                       $i=0;
                       while($row=mysqli_fetch_assoc($result))
                       {
                         $bookid[$i]=$row['Book_id'];
                         $i=$i+1;
                       }
                       $n=$i;
                     }
                  }
                  break;

        }
      }
      
    ?>
  <div class="jumbotron">
  <center>
<h1>DEXTER DIAGNOSTIC LAB</h1>
</center>
</div> 
   <div class="contain">
     <form class="form-inline" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
       <input type="hidden" name="form" value="B">
       <br><br>
        <div class="form-group section-filter">
          <div class="col-sm-12 form-inline">
            <table align='center' border='2pt'>
              <tr>
                <td id="label"><b>Generate Report For :   </b><span></span></td>
                <td></td>
                <td></td><td></td>
                <td>
                  <select class="form-control" id='type' name='type'>
                  <option value="" disabled selected >Select Test/Package</option>
                  <option value="Test">Test</option>
                  <option value="Package">Package</option>
                   <script type="text/javascript">
                    document.getElementById('type').value ="<?php echo $_POST['type'];?>" ;
                  </script>
                </td>
              </tr>
          </table>
          </div>
          <br><br><br>
           <center> <button type="submit" class="btn btn-default">Submit</button></center>
    </form>
    <br><br>
    <form class="form-inline" action="generate_report2.php" method="post">
      <input type="hidden" name="form" value="C">
        <center>  
        <div class="form-group section-filter">
          <div class="col-sm-12 form-inline">
            <table align='center' border='2pt'>
              <tr>
                <td id="label"><b>Select Book_Id :   </b></td>
                <td></td>
                <td></td>
                <td>
                  <select class="form-control" id='bookid' name='bookid'>
                  <option value="" disabled selected>Select book_id </option>
                  <?php
                  for($l=0;$l<$n;$l++)
                  {
                    echo "<option value='$bookid[$l]'>BK-$bookid[$l]</option>" ;
                  }
                  ?>
                  </select>
                </td>
              </tr>
          </table>
          </div>
          <br><br><br>
          <center> <button type="submit" class="btn btn-default">Submit</button></center>
      </form>
</div>
	</body>
	</html>