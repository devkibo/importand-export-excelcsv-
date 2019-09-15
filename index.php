<html>
<head>
	<title>Import or Export Excel File into or from MySQL</title>
</head>
<body>
	<h1>Import or Export Excel File into or from MySQL</h1>
	<?php
	error_reporting(0);
	if(isset($_POST["btnImport"])){
	   if(!empty($_FILES["excelFile"]["tmp_name"])){
	   	   $fileName=explode(".",$_FILES["excelFile"]["name"]);
	   	   if($fileName[1]=="csv"){
	   	   	   echo "Processing!!!!";
	   	     $connect=mysqli_connect("localhost","root","","testing");
	   	   	

            $file=$_FILES["excelFile"]["tmp_name"];
            $openFile=fopen($file,"r");
             $number=0;
            while($dataFile=fgetcsv($openFile,3000,",")){
            	$number++;
            	 $ID=$dataFile[0] ;
            	  $name=$dataFile[1] ;
            	   $Course=$dataFile[2] ;
            	    $Gender=$dataFile[3] ;
            	     $Marks=$dataFile[4] ;
            	      $Status=$dataFile[5] ;
            	      //echo $ID ."-" .$name ."-" .$Course ."-" . $Gender ."-" . $Marks ."-" . $Status;
            	      
            	      if($number!=1)
            	      {

                        mysqli_query($connect,"insert into excelsheet(ID,name,Course,Gender,Marks,Status)  values('$ID','$name','$Course','$Gender','$Marks','$Status')");
            	      }

            }
             echo "<br>Data was success import to MySQL<br>";
	   	   }else{
	   	   	echo "You must choose  a csv file to import!!!";
	   	   }
	   }else{
	   	echo "You must choose a file!!!";
	   }
	  
}else if(isset($_POST["btnExport"]))
{
   $connect=mysqli_connect("localhost","root","","testing");
   $dataTable=mysqli_query($connect,"select * from excelsheet");
   $rowTable=mysqli_num_rows($dataTable);
   if($rowTable>=1){
   	$file="export/" . strtotime(now) . ".csv";
   	$openFile=fopen($file,"w");
    
   	echo "Export Processing<br>";
   	$allData=mysqli_fetch_assoc($dataTable);
   	$line=0;
   	foreach ($allData as $name => $value) {
   		$line++;
   		if($line<6)
   		{
   		$label .= $name . ",";	
   		}
   		else
   		{
   		$label .= $name . "\n";
   		}
   		
   	}
   		$dataTable2=mysqli_query($connect,"select * from excelsheet");
   		while($allData2=mysqli_fetch_assoc($dataTable2))
   		{
   			$dataValue .= $allData2["ID"] . "," . $allData2["Name"] . "," . $allData2["Course"] . "," . $allData2["Gender"] . "," . $allData2["Marks"] . "," . $allData2["Status"]  ."\n";
   		}
   	fputs($openFile,$label . $dataValue);
   	echo "<a href='$file'>Download a Excel File Here</a>";
   }else
   {
   	echo "You don't have any data from MySQL";
   }
   //echo "You clicked Export button";
}
?>
	<form action="" method="post" enctype="multipart/form-data">
  	   <input type="file"  name="excelFile"/><input type="submit"  name="btnImport"  value="Import data from excel"/>
  	</form>
  	<form action="" method="post" enctype="multipart/form-data">
  	   <input type="submit"  name="btnExport"  value="Export data into excel"/>
  	</form>
</body>
</html>

