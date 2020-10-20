<?php

	include "includes/dbconnect.php";
	if($_SERVER["REQUEST_METHOD"]=="POST")
	{
		if(isset($_POST['p'])&&isset($_POST['q'])&&isset($_POST['editKacci']))
		{
			$d=date("Y/m/d");

			$arr=str_split($_POST['editKacci'],1);
			$a=$arr[0];
			$b=$_POST['q'];
			$c=$_POST['p'];
		
			$quer ="INSERT into transaction (Item_Id,Number_of_Plates,total_price,date_time) VALUES
		              ('$a','$b','$c','$d');";
		     $data = mysqli_query($conn, $quer); 
		     if($data>0)
		      {
		      	echo "<script> window.alert('Succesfully Sold!') </script>";

		      }

		
			
		}

	}
	$commentsQuery = "SELECT * from item";
      $ddata = mysqli_query($conn, $commentsQuery);
	 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<title>Sell Item</title>
	 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	$("#cnfrm").hide();
      	var d = new Date();

	var month = d.getMonth()+1;
		var day = d.getDate();

	var output =  day+ '/' +
    (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + d.getFullYear();
      	$("#time").html(output);
      	$("#time").val(output);
      	$("#quantity").change(function(){
      		if($("#editKacci").val()==""||$("#editKacci").val()==null)
      		{
      			alert("Select an item first!");
      			$("#quantity").val("");
      		}
      		else if($("#quantity").val()<0)
      		{
      			$("#qerr").html("*Can not be negetive");


      		}
      		else
      		{
      			$("#qerr").html("");

      			$("#cnfrm").show();

      			var a= $("#editKacci").val().split("-->");


      			$("#tp").val(a[2]*$("#quantity").val());



      		}

      	});
      


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
	<b>	<a href="manage.php"  style="color:blue">MangeItem</a></b>&nbsp &nbsp
	<b>	<a href="sell.php"  style="color:blue">SellItem</a></b>&nbsp &nbsp
	<b>	<a href="report.php"  style="color:blue">Report</a></b>&nbsp &nbsp
     
    </div>
  </div>
</nav>
	<div align="center">
		<h2>Sell Kacci Item</h2>
		<label>Date :</label><span id="time"></span><br><br>
		<form action="" method="POST">
        <div class="container-fluid">
    <div class="row">
    <section class="col-md-6 offset-md-3">
     <table class="table table-striped" align="center" border="1" width="500">
    <tr><th>Kacci Item</th>
				<td>
		<?php
    			$i=1;
    			echo "<select name='editKacci' id='editKacci'>";
    			echo "<option selected disabled>Choose Kacci Item</option>";
    			 while($rowedt = mysqli_fetch_assoc($ddata))
			     {
			       echo "<option value='".$rowedt["Id"]."-->".$rowedt["Name"]."-->".$rowedt["Price"]."'>".$rowedt["Name"]."-->".$rowedt["Price"]."</option>";
			     
			     }





    			?>
    			
    		</select></td></tr>
    		<tr>
    			<th>Number of Plates</th>
    			<td><input type="number" name="q" id="quantity" min=0 required><span style="color:red" id="qerr"></span></td>
    		</tr>
    		<tr>
    			<th>Total Price</th>
    			<td><input type="number" name="p" id="tp" min=0 readonly></td>
    		</tr>
    		<tr>
    			
    			<td colspan="2" align="center"><input type="submit" class="btn btn-primary" id="cnfrm" value="Confirm"></td>
    		</tr>
    	</table>
      
     </section>



</div>



</div>
		
			
    	</form>
		
	</div>
	 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: jQuery, Popper.js, and Bootstrap JS
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
    -->
</body>
</html>