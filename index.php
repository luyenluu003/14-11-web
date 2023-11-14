<?php
include('connection.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Load More</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
<div class="row justify-content-center" id="content">

<?php 

$sql="select * from comments limit 0,3";
$result=mysqli_query($conn,$sql);

while($data=mysqli_fetch_array($result))
{?>
<div class="col-xl-7">
  <div class="card mb-3">
    <div class="card-body">
      <h4 class="card-title"><?php echo $data['name'];?></h4>
      <p class="card-text"><?php echo $data['description'];?></p>
      
    </div>
  </div>
 </div> 
<?php } ?> 
 
 </div>

<div class="row">
<div class="col-xl-12">

<p class="text-center"><button type="button" class="btn btn-primary" id="loadmore">Load More...</button></p>

<input type="hidden" id="start" value="0">

</div>
</div>
 
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>

$("#loadmore").click(function()
{
	 $start=parseInt($("#start").val());
	 $perpage=3;
	 
	 $start=$start+$perpage;
	 
	 $("#start").val($start);
	 
	 $.ajax({
		 
		 url:'data.php',
		 method:'POST',
		 data:{'starting':$start},
		 success:function(response)
		 {
			 if(response!='')
			 {
			 $("#content").append(response);
			 }
			 else 
			 {
				 $("#loadmore").text('Data has Finished');
				 $("#loadmore").slideUp(2000);
				 
			 }
		 }
		 
	 })
	 
})

</script>

</body>
</html>
