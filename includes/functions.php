<?php  //THIS FILE STORE BASIC FUNCTIONS FOR WIDGET CORP 
	function confirm_query($result_set) {
	if (!$result_set) {
	die("database query failed" . mysql_error());
	}
 }	
function mysql_prep($string) {
	$magic_quote_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists('mysql_real_escape_string');
		if ($new_enough_php) {
		   if ($magic_quote_active) {
		   $value = stripcslashes($value);
				}
		$value = mysql_real_escape_string($value);
		}else {
		 if (!$magic_quote_active) {
		 	$value = addcslashes($value);
		 		}
			return $value;
			}
		return $escaped_string;
		
		
		
	}
function redirect_to($location) {
	header("location: {$location} "); exit;
}
	function get_all_subjects($public = TRUE) {
	global $connection;
	$query = "SELECT * ";
	$query .= "FROM subjects ";
	if ($public) {
		$query .= "WHERE visible = 1";
	}

     
	$subject_set= mysql_query($query,	$connection);
	confirm_query($subject_set);
	return $subject_set;
}

 function get_pages_for_subjects($subject_id) {
  global $connection;

$page_set = mysql_query("SELECT * FROM pages WHERE subject_id = {$subject_id}", $connection);
  confirm_query($page_set); 
return $page_set;
}

function get_subjects_by_id($subject_id) {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id=" .$subject_id." ";
		// $query .= "LIMIT 1";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		if ($subject = mysql_fetch_array($result_set)){
		return $subject;
		}else {return NULL;}
}
function get_page_by_id($page_id) {
		global $connection;
		
		$query  = "SELECT * ";
		$query .= "FROM pages ";
		$query .= "WHERE id=" .$page_id." ";
		$query .= "LIMIT 1";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		if ($page = mysql_fetch_array($result_set)){
		return $page;
		}else {return NULL;}
} 
function find_selected_page() {
	global $sel_subject;
	global $sel_page;
	   if (isset($_GET['subj'])) {
    $sel_subj = $_GET['subj'];
    $sel_subject = get_subjects_by_id($sel_subj);
    $sel_page= NULL;
	}   elseif (isset($_GET['page'])) {
    $sel_subject=NULL;
    $sel_pg = $_GET['page'];
    $sel_page = get_page_by_id($sel_pg);
	}   else {
    $sel_subject= NULL;
    $sel_page= NULL;
	}
}
function navigation($sel_subject, $sel_page, $public = FALSE){
$output ="<ul class=\"subjects\">"; 
 $subject_set = get_all_subjects($public=false);

while   ($subject = mysql_fetch_array($subject_set)) {
        $output .= "<li";
    if($subject['id']==$sel_subject['id']) {$output .= "class=\"selected\"";}
        $output .= "><a href=\"edit_subject.php?subj=".urlencode($subject['id']). "\">{$subject["menu_name"]} </a></li>";
  
  
    $page_set = get_pages_for_subjects($subject['id']);
      $output .= "<ul class=\"pages\">";
  while ($page = mysql_fetch_array($page_set)) {
      $output .= "<li";
      if($page['id']==$sel_page['id']) {$output .= "class=\"selected\"";}
      $output .= "><a href=\"edit_page.php?page=". urlencode($page['id'])."\">{$page["menu_name"]}</a></li>"; 
  }
       $output .= "</ul>"; 
}    
          $output .= "</ul>";
          return $output;
}
function public_navigation($sel_subject, $sel_page, $public = TRUE){
$output ="<ul class=\"subjects\">"; 
 $subject_set = get_all_subjects($public);

while   ($subject = mysql_fetch_array($subject_set)) {
        $output .= "<li";
    if($subject['id']==$sel_subject['id']) {$output .= "class=\"selected\"";}
        $output .= "><a href=\"index.php?subj=".urlencode($subject['id']). "\">{$subject["menu_name"]} </a></li>";
  
  if($subject['id']==$sel_subject['id']) {
    $page_set = get_pages_for_subjects($subject['id']);
      $output .= "<ul class=\"pages\">";
  while ($page = mysql_fetch_array($page_set)) {
      $output .= "<li";
      if($page['id']==$sel_page['id']) {$output .= "class=\"selected\"";}
      $output .= "><a href=\"index.php?page=". urlencode($page['id'])."\">{$page["menu_name"]}</a></li>"; 
  }
       $output .= "</ul>"; 

       		}//end  of if($subject['id']==$sel_subject['id']) for page
}    
          $output .= "</ul>";
          return $output;
}
 
 ?>
