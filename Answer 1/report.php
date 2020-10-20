<?php
include "includes/dbconnect.php";
$timetake="";
if($_SERVER["REQUEST_METHOD"]=="POST")
{
  if(isset($_POST['dt']))
  {
    $b=$_POST['dt'];
    $timetake=$_POST['dt'];
    
    $d=date("Y/m/d",strtotime($b));
  $totalPlate=$totalIncome="";
  $totalPlate ="SELECT sum(Number_of_Plates) as plate from transaction where date_time='$d'";
  $resPlate=mysqli_query($conn, $totalPlate);
  $totalIncome="SELECT sum(total_price) as total from transaction where date_time='$d'";
  $resIncome=mysqli_query($conn, $totalIncome);
    
  }
  
}
else
{
  $d=date("Y/m/d");
$totalPlate=$totalIncome="";
$totalPlate ="SELECT sum(Number_of_Plates) as plate from transaction where date_time='$d'";
$resPlate=mysqli_query($conn, $totalPlate);
$totalIncome="SELECT sum(total_price) as total from transaction where date_time='$d'";
$resIncome=mysqli_query($conn, $totalIncome);

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <title>Report</title>
   <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript">
       $(document).ready(function(){


      var d = new Date();

    var month = d.getMonth()+1;
    var day = d.getDate();
    var output =  d.getFullYear()+ '-' +
    (month<10 ? '0' : '') + month + '-' +
    (day<10 ? '0' : '') +day ;
    <?php if($timetake=="") { ?>
    $("#tm").val(output.toString());
  <?php } ?>
  
   
    
       });
    </script>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light" align="center">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
    <div class="navbar-nav">
   <b> <a href="index.php"  style="color:blue;">Home</a></b>&nbsp &nbsp
  <b> <a href="manage.php"  style="color:blue">MangeItem</a></b>&nbsp &nbsp
  <b> <a href="sell.php"  style="color:blue">SellItem</a></b>&nbsp &nbsp
  <b> <a href="report.php"  style="color:blue">Report</a></b>&nbsp &nbsp
     
    </div>
  </div>
</nav>
  <div align="center">
    <h2>Report</h2>
    <form method="POST">
    <h6>Date:&nbsp &nbsp<input type="date" name="dt" value="<?php if($timetake!=""){echo $timetake;} ?>" id="tm">&nbsp&nbsp
      <input type="submit" value="Search" class="btn btn-primary"></h6></form>
        <div class="container-fluid">
    <div class="row">
    <section class="col-md-7 offset-md-3">
        <table class="table table-striped" border="1">
      
      <tr>
        <th>Number of Kacci Plates Sold</th>
                <th>Total today's Earning Amount</th>
        
      </tr>
      <tr>
            <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b><span><?php
    if($resPlate->num_rows>0)
    {
        while($rows = mysqli_fetch_assoc($resPlate)){
            if($rows['plate']==null||$rows['plate']=="")
            {
                        echo "0";
            }
            else
            {
                        echo $rows['plate'];
            }
         }

    }
    else
    {
        echo "0";
    }
    
  ?> </span></b></td>
        
        <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<b><span><?php
if($resIncome->num_rows>0)
{
    while($row = mysqli_fetch_assoc($resIncome)){
      if($row['total']==null||$row['total']=="")
            {
                        echo "0";
            }
            else
            {
                         echo $row['total'];
            }   
   ;}
}

else
{
    echo "0";
}

  ?> </span></b></td>
      </tr>
    </table>
     </section>



</div>



</div>
    
    
  </div>
  <div align="center"><span style="color:blue">*Note:You can serach Report by Date</span></div>
  
     <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  
</body>
</html>

