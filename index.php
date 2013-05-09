<?php
  // do not modify this
  session_start();
  require("lib/functions.php");
  
  // add any global stuff that you need here
  
  // add pages to your site here
  frameworkAddPage("pages/home.php", "home");
  frameworkAddPage("pages/viewall.php", "viewall");
  frameworkAddPage("pages/edit.php", "edit");
  frameworkAddPage("pages/404.php", "404");
  //frameworkAddPage("pages/album.php", "album");
  
  // set the default page if no page is specified
  frameworkSetDefault("home");
  // set the page to display if cannot find the page (can be a 404 type page)
  frameworkSetMissing("404");
  
  // do not modify this
  if(isset($_GET['page'])) {
    list($sidebar, $content, $title) = frameworkRenderPage($_GET['page']);
  }
  else{  
    list($sidebar, $content, $title) = frameworkRenderDefault();
  }
?>
<!DOCTYPE html>
<html>
  <head>
  	<link rel="stylesheet" type="text/css" href="style.css" />
    <title>
       <?php echo $title ?>
    </title>
  </head>
  <body>
    <div id="wrapper">
      <div id="navbar">
        <ul>
          <li><a href="?">Home</a></li>
          <li><a href="?page=viewall">View Albums</a></li>
          <?php //echo '<li><a href="?page=album=">Album</a></li>' ?>
          <li><a href="?page=edit">Edit</a></li>
        </ul>
      </div>
      <div id="main">
      	<div id="background">
        </div>
        <div id="page">
          <div id="sidebar">
            <?php 
			//echo $sidebar; 
			if (!isset($_SESSION['logged_user'])){
			  if (!isset($_POST['username']) && !isset($_POST['password'])) {
				  echo '<h2>Log in</h2>
					  <form action="?page='.$title.'" method="post">
					  Username: <input type="text" name="username" /> <br />
					  Password: <input type="password" name="password" /> <br />
					  <input type="submit" value="Login" />
					  </form>';
			  } elseif ($_POST['username'] == "lizzy" && $_POST['password'] == "onepine1") {
				  echo '<h2>Log Out</h2>
					  <form action="?page='.$title.'" method="post">
					  <input type="submit" name="logout" value="Logout" />
					  </form>';
				  $_SESSION['logged_user'] = $_POST['username'];
			  } else {
				  echo 'You did not login successfully<br />
					  <h2>Log in</h2>
					  <form action="?page='.$title.'" method="post">
					  Username: <input type="text" name="username" /> <br />
					  Password: <input type="password" name="password" /> <br />
					  <input type="submit" value="Login" />
					  </form>';
			  }
			} else{
				if (isset($_POST['logout'])) {
					$olduser = $_SESSION['logged_user'];
					unset($_SESSION['logged_user']);
					session_destroy();
				} else {
					$olduser = false;
				}
				if ($olduser) {
					echo "Thanks for using our page, $olduser!\n";
				} else {
					echo '<h2>Log Out</h2>
					  <form action="?page='.$title.'" method="post">
					  <input type="submit" name="logout" value="Logout" />
					  </form>';
				}	
			}
			?>
          </div>
        </div>
        <div id="content">
          <?php echo $content;
		  if(isset($_GET['page'])) {
    echo $_GET['page'];
  }

		   ?>
        </div>
      </div>
    </div>
  </body>
</html>