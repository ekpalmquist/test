<?php
  $framework_paths = array();
  $framework_default_path = "";
  $framework_missing_path = "";
  $title = "";
  function frameworkAddPage($filename, $url) {
    global $framework_paths;
    $framework_paths[$url] = $filename;
  }
  
  function frameworkRenderPage($url) {
    global $framework_paths, $framework_missing_path;
    if(isset($framework_paths[$url])) {
      $filename = $framework_paths[$url];
      require($filename);
      $sidebar = "";
      if(function_exists("frameworkGetSidebar")) {
        $sidebar = frameworkGetSidebar();
      }
      $content = "";
      if(function_exists("frameworkGetContent")) {
        $content = frameworkGetContent();
      }
	  $title = $url;
      return array($sidebar, $content, $title);
    }
    elseif($framework_missing_path && isset($framework_paths[$framework_missing_path])) {
      return frameworkRenderPage($framework_missing_path);
    }
    else {
      return array(null, "404", "404");
    }
  }
  
  function frameworkRenderDefault() {
    global $framework_default_path;
    return frameworkRenderPage($framework_default_path);
  }
  
  function frameworkSetDefault($url) {
    global $framework_default_path;
    $framework_default_path = $url;
  }
  
  function frameworkSetMissing($url) {
    global $framework_missing_path;
    $framework_missing_path = $url;
  }