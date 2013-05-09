<?php
  function frameworkGetSidebar() {
    $output = "";
    return $output;
  }
  
  function frameworkGetContent() {
    $output = "<h1>Edit</h1>";
	require_once("db.php");
	if(isset($_SESSION['logged_user'])){
		$output .= '<form method="post" id="updates" action="?page=edit" onsubmit="return validAlbum();">
   					<p>
      					<label> Update Album </label>
      					<br/>
      					Album Title:
      					<select name="oldtitle">';
		$header = array("aid" => "aid", "title" => "Title");
		
        $result = $mysqli->query("SELECT * FROM test");
        if (!$result) {
            $output .= $mysqli->error;
            exit();
        }
		while ($row = $result->fetch_assoc()){
        	$aid="";
        	foreach ($row as $type => $item) {
            	if($type=="aid"){
                	$aid=$item;
                }
				if($type=="title"){
                	$output .= '<option value='.$aid.'>'.$item.'</option>';
                }
        	}
		}
		$output .= '</select>
      					New Title:
      					<input id="title" type="text" name="newtitle" onchange="validTitle(this.value);"/>
      						<span id="titlemsg">*</span> <span id="submitmsg">&nbsp;</span>
      					<input id="submit" type="submit" name="updateAlbum"  value="UpdateAlbum"/>
   					</p>
  					</form>';
    	if (isset($_POST['updateAlbum'])) {
        	$check = true;
        	if ($check) {
            	if($_POST['newtitle']!=""){
            		$query = "UPDATE test SET title='".trim(strip_tags($_POST['newtitle']))."' WHERE aid=".$_POST['oldtitle']; 
            		$mysqli->query($query);
            	}
            	$check=false;
        	}
		}
	} else{
		$output .="Please login to update content";
	}
	return $output;
  }