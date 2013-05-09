<?php
 
  // this is optional
  function frameworkGetSidebar() {
    $output = "";
    return $output;
  }
  
  // this is optional
  function frameworkGetContent() {
    $output = "";
	if (isset($_SESSION['logged_user'])) {
		$olduser = $_SESSION['logged_user'];
		unset($_SESSION['logged_user']);
		session_destroy();
	} else {
		$olduser = false;
	}
	if ($olduser) {
		$output .= "Thanks for using our page, $olduser!\n";
	} else {
		$output .= "You haven’t logged in.\n";
	}	
    return $output;
  }  