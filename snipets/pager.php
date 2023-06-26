
	<?php

function pager($db, $statement, $numberPerPage, $tableName){
	
	$numPerPage = $numberPerPage; 
	$pageNumber = (isset($_GET["pageNum"]))? $_GET["pageNum"] : 1;

	$startingRecord = ($pageNumber * $numPerPage) - $numPerPage;

	$con = mysqli_connect("localhost", "root", "", $db); 
	$sql = $statement. "LIMIT $startingRecord,$numPerPage";
	$results = mysqli_query($con, $sql);
	// var_dump($con);

	$sql = "SELECT COUNT(id) as numRecords FROM $tableName"; 
	$results = mysqli_query($con, $sql);
	$recordStats = mysqli_fetch_assoc($results); 
	$totalNum = $recordStats['numRecords'];
	$numPages = ceil($totalNum / $numPerPage); 

	?>
		<div class="records"><!-- more generic -->
	<?php
		while($record = mysqli_fetch_assoc($results)){?>
			<div class="record"><?=$record["name"]?></div>
	<?php
	}
	?>		
		</div>
		
		<div class="pager">
	<?php
		if ($pageNumber>1) 
		{
			echo '<a href="index.php?pageNum='.($pageNumber-1).'">Previous</a>';  
		}
		for($i=1;$i<=$numPages; $i++) 
		{
			$activeState = ($i == $pageNumber) ? "active" : "";
			echo '<a href="index.php?pageNum='.$i.'" class="'.$activeState.'">'.$i.'</a>'; 
		}
		if ($pageNumber != $numPages)
		{
			echo '<a href="index.php?pageNum='.($pageNumber+1).'">Next</a>'; 
		}
	?>			
		</div>
<?php

	}
?>