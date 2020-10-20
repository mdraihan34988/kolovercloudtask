<?php
	include "includes/dbconnect.php";
	 

  if($_SERVER["REQUEST_METHOD"]=="POST")
  {
 
  	if(isset($_POST['iName'])&&isset($_POST['iPrice']))
  	{
  		$a=$_POST['iName'];
  		$b=$_POST['iPrice'];
  		
  	$commentsQuery ="INSERT into item (Name,Price) values ('$a','$b');";
      $data = mysqli_query($conn, $commentsQuery);
      if($data>0)
      {
      	echo "<script> window.alert('Succesfully Created!') </script>";

      }


  	}
  	if(isset($_POST['eiName'])&&isset($_POST['eiPrice']))
  	{
  		$a=$_POST['eiName'];
  		$b=$_POST['eiPrice'];
  		$c=$_POST['eid'];
  		
  	$commentsQuery ="UPDATE item set Name='$a',Price='$b' where Id='$c' ;";
      $data1 = mysqli_query($conn, $commentsQuery);
      if($data1>0)
      {
      	echo "<script> window.alert('Succesfully Updated!') </script>";

      }


  	}


    

    

  }

  $commentsQuery = "SELECT * from item";
      $data = mysqli_query($conn, $commentsQuery);
      $ddata=mysqli_query($conn, $commentsQuery);;


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

	<title>Manage Item</title>
	 <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script type="text/javascript">
      $(document).ready(function(){
      	$("#editBtn").hide();
      	
      		$("#itemName").change(function(){

          if($("#itemName").val()=="")
          {
            $("#crtCatErr").html("*Provide Name");
          }
          else

          {
          	$("#crtCatErr").html("");
          }

        });
      		$("#itemPrice").change(function(){

          if($("#itemPrice").val()=="")
          {
            $("#crtPrErr").html("*Provide Quantity");
          }
          else if($("#itemPrice").val()<0)
          	{
          	$("#crtPrErr").html("*Can not be negetive");
          }
          else
          {
          	$("#crtPrErr").html("");
          }

        });
      	$("#edt").click(function(){
      			$("#edit").show();

        });
        $("#editKacci").change(function(){

        	var a= $("#editKacci").val().split("-->");
       
        	$("#eId").val(a[0]);
        	$("#eitemName").val(a[1]);
        	$("#eitemPrice").val(a[2]);
        	$("#editBtn").show();

        });
        $("#eitemName").change(function(){

          if($("#eitemName").val()=="")
          {
            $("#edtCatErr").html("*Provide Name");
          }
          else

          {
          	$("#edtCatErr").html("");
          }

        });
      		$("#eitemPrice").change(function(){

          if($("#eitemPrice").val()=="")
          {
            $("#edtPrErr").html("*Provide Quantity");
          }
          else if($("#eitemPrice").val()<0)
          	{
          	$("#edtPrErr").html("*Can not be negetive");
          }
          else
          {
          	$("#edtPrErr").html("");
          }

        });
   		






    });
    

    </script>
    <script>
    	
    	function deleteItem(id)
    	{
    		 var xhttp;
			  
			  xhttp = new XMLHttpRequest();
			
			  xhttp.open("GET", "delItem.php?Val="+id, true);
			  xhttp.send();
			 window.alert("Succesfully Deleted!");
			 window.location.reload(true);

			  

    		

    	}
    	
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
		<h3>Kacci Item List</h3>
		<form method="GET" class="from-control">
		<?php
   
   if($data->num_rows>0)
   { ?>
   <div class="container-fluid">
    <div class="row">
    <section class="col-md-6 offset-md-3">
     <table class="table table-striped" align="center" border="1" width="500">
    <tr>
    <th>Sl.</th>
   
      <th>Name</th>
      <th>Price</th>
      <th>Operation</th>
      
    </tr> <?php
    $i=1;
     while($row = mysqli_fetch_assoc($data))
     {
       echo "<tr><td>".$i."</td><td>".$row["Name"]."</td><td>".$row["Price"]."</td><td> &nbsp <input type='submit' class='btn btn-danger' onclick=deleteItem('".$row["Id"]."') name='delete' id='".$row["Id"]."' value='Delete'></td><tr>";
       $i++;

     }
    
   }
   else{

    echo "No result found";
   }
  

   ?>
    </table>
        
     </section>



</div>



</div>
   
</form>

		
	</div>
	<div align="center" id="edit">
	<form action="" method="POST" class="from-control">
    <h3>Edit Kacci Item</h3>
    <div class="container-fluid">
    <div class="row">
    <section class="col-md-6 offset-md-3">
     <table class="table table-striped" align="center" border="1" width="500">
    
        <tr>
    		<th>Select</th>
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
    			
    		</select></td>
    		
    	</tr>
    	<tr><th>Sl</th><td><input type="text" id="eId" name="eid" readonly></td></tr>
    	<tr>
    		<th>Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
    		<td><input type="text" name="eiName" class="from-control" id="eitemName"  required><span id="edtCatErr" style="color:red"></span></td>
    		
    	</tr>
    	<tr>
    		<th>Price &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
    		<td><input type="number" name="eiPrice" class="from-control" id="eitemPrice" min=0 required><span id="edtPrErr" style="color:red"></span></td>
    	</tr>
    	<tr>
    		<td colspan="2"><input type="submit" class="btn btn-primary" id="editBtn" value="Edit"></td>

    	</tr>

    </table>
     </section>



</div>



</div>
    
    	
    </form>


	</div>
	<div align="center">
		<form action="" method="post" class="from-control">
    <h3>Create Kacci Item</h3>
    <div class="container-fluid">
    <div class="row">
    <section class="col-md-6 offset-md-3">
     <table class="table table-striped" align="center" border="1" width="500">
        <tr>
    		<th>Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
    		<td><input type="text" name="iName" id="itemName" class="from-control" required><span id="crtCatErr" style="color:red"></span></td>
    		
    	</tr>
    	<tr>
    		<th>Price &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</th>
    		<td><input type="number" name="iPrice" id="itemPrice" class="from-control" min=0 required><span id="crtPrErr" style="color:red"></span></td>
    	</tr>
    	<tr>
    		<td colspan="2" align="center"><input class="btn btn-success" type="submit" id="crt" value="Create"></td>

    	</tr>

    </table>
       
     </section>



</div>



</div>
   
    	
    </form>
    <div id="info"></div>

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