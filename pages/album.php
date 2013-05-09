<?php
  function frameworkGetSidebar() {
    $output = "";
    return $output;
  }
  
  function frameworkGetContent() {
    $output = "";
	require_once("db.php");
    $header = array("caption" => "Caption", "url" => "url", "date_taken" => "Date Taken", "pid" => "pid");
		$check = true;
		if ($mysqli->errno) {
			$output .=$mysqli->error;
			exit();
		}
		$output .="before result";
		$result = $mysqli->query("SELECT aid, title FROM albums WHERE aid=".$_GET['page']);
		$output .="before result";
        if (!$result) {
                	$output .=$mysqli->error;
                	exit();
                }
                while ($row = $result->fetch_assoc()){
                	foreach ($row as $type => $item) {
                		if($type=="title"){
                			$output .="<h1>$item</h1>";
                		}
               		}
                }
			$query = "SELECT caption, url, DATE_FORMAT(date_taken, '%e %b %Y'), pid FROM photos NATURAL JOIN sequences WHERE aid=".$_GET['page'];
			 $result = $mysqli->query($query);
                if (!$result) {
                    $output .=$mysqli->error;
                    exit();
                }
				 if($result->num_rows==0) {
               $output .="<p>This album has no content.<br /> 
			   			<a href=\"?page=viewall\">Back to all albums</a></p>";
            }
            else {
				$output .="<table>\n<thead><tr>\n";
				foreach ($header as $headitm) {
					if($headitm!="pid"){
						$output .="<th>$headitm</th>\n";
					}
				}
				$output .="</tr></thead>\n";
                while ($row = $result->fetch_assoc()) {
                   $output .="<tr>\n";
				    foreach ($row as $type => $item) {
						if($type!='pid'){
			
							if ($type == "url"){
								$output .="<td class=\"image\"><a href=\"photo.php?pid=".$row['pid']."\"><img  src=\"images/$item\" alt=\"$item\" width=\"48\" height=\"48\" /></a></td>";
							}
							else {
								$output .="<td>$item</td>\n\n";
							}
						}
					}
					$output .="</tr>\n";
				}
				$output .="</table>";
				$output .="<p><a href=\"?page=viewall\">Back to all albums</a></p>";
			}
			$output .="<p>This album has no content.<br /> 
			   			<a href=\"?page=viewall\">Back to all albums</a></p>";
    return $output;
  }  