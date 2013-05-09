<?php
 
  // this is optional
  function frameworkGetSidebar() {
    $output = "";
    return $output;
  }
  
  // this is optional
  function frameworkGetContent() {
    $output = "<h1>All Albums</h1>";
	require_once("db.php");
	$header = array("aid" => "aid", "title" => "Title", "date_created" => "Date Created", "date_modified" => "Date Modified");
		
	if ($mysqli->errno) {
		$output .=$mysqli->error;
		exit();
	}
	
	$result = $mysqli->query("SELECT aid, title, date_created, date_modified FROM albums ORDER BY aid");
	if (!$result) {
		$output .=$mysqli->error;
		exit();
	}
	
	while ($row = $result->fetch_assoc()) {
		global $aid;
		$aid=$row['aid'];
		frameworkAddPage("pages/album.php:".$aid, $aid);
		$output .=$aid;
		$_SESSION['aid']=$aid;
		foreach ($row as $type => $item) {
			if($type!="aid"){
			  if ($type =="date_modified") {
				  $date = date('d M Y', $item);
				  $output .="$type: $date<br /> \n";
			  } 
			  else if ($type == "title"){
				  
				  $output .="$type: <a href=\"?page=".$aid."\">$item </a>\n";
				  $page=$aid;
			  }
			  else if ($type == "date_created"){
				  $date = date('d M Y', $item);
				  $output .="$type: $date\n";
			  }
			  else {
				  $output .="$type: $item\n";
			  }
			}
		}
	}

    return $output;
	//return $page;
  }  