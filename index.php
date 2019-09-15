<html>
<head>
	<title>Import or Export Excel File into or from MySQL</title>
</head>
<body>
	<h1>Import or Export Excel File into or from MySQL</h1>

	<?php
	if(isset($_POST["btnImport"])){
	   if(!empty($_FILES["excelFile"]["tmp_name"])){
	   	   $fileName=explode(".",$_FILES["excelFile"]["name"]);
	   	   if($fileName[1]=="csv"){
	   	   	   echo "Processing!!!!";
	   	   	$sql=mysql_connect("localhost","root","");
	   	   	$db=mysql_select_db("testing");

	   	   }else{
	   	   	echo "You must choose  a csv file to import!!!";
	   	   }
	   }else{
	   	echo "You must choose a file!!!";
	   }
	  
}
?>

  <form action="" method="post" enctype="multipart/form-data">
  	   <input type="file"  name="excelFile"/><input type="submit"  name="btnImport"  value="Import data from excel"/>
  	</form>
</body>
</html>