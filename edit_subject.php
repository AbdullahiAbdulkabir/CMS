<?php require_once('includes/functions.php'); 
      require_once('includes/connect.php'); 
      include('includes/header.php');  
	  find_selected_page();
?>
  <?php if (intval($_GET['subj'])==0) {
 	redirect_to("content.php");
 }

  if (isset($_POST['submit'])) {
		$errors = array();	
			
	$required_fields = array('menu_name','position', 'visible');		
 	foreach ($required_fields as $fieldname) {
 		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])) {
 				$errors[] = $fieldname;
 					}			
 			}						
 		$fields_with_lengths = array('menu_name => 30');	
 		foreach ($fields_with_lengths as $fieldname => $maxlength) {
 			if (strlen(trim($_POST[$fieldname])) >$maxlength) {
 				$errors = $fieldname;
 			}
 		}
 		if (empty($errors)) {
 			$id = $_GET['subj'];	
 			$menu_name = $_POST['menu_name'];
 			$position = $_POST['position'];	
 			$visible = $_POST['visible'];

 			$query = "UPDATE subjects SET
 			menu_name = '{$menu_name}'
		    position =	'{$position}'
		 	visible =	'{$visible}'
		 	WHERE id = {$id} ";
		 	$result = mysql_query($query, $connect);	
 		  	}			
 		}//end of (isset($_POST['submit']))
			
?>			
			
			
			
   	<table id="structure">
   			<tr>
   				<td id="navigation">
        <?php  echo navigation($sel_subject, $sel_page); ?>
   				</td>	
   				<td id="page">	
		<h2> Edit subject: <?php echo $sel_subject['menu_name'];?> </h2>
	<form action="edit_subject.php?subj=<?php echo urlencode($sel_subject['id'])?>;" method="post">
		  <p>Subject name:
		    <input type="text" name="menu_name" value="<?php echo $sel_subject['menu_name'];?>" />
		  </p>
		  <p>Position:
		    <select name="position">
		   <?php  $subject_set = get_all_subjects();
					$subject_count = mysql_num_rows($subject_set);
		for($count = 1; $count <=($subject_count + 1); $count++) {
						echo "<option value=\"{$count}\">
			
						{$count}</option>";
					}?>
			
		    </select>
		  </p>
		  <p>Visible:
		    <input type="radio" name="visible" value="0" /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" /> Yes
		  </p>
		  <input type="submit" value="Edit Subject" />
		</form>	<br />
		<a href="content.php">Cancel</a>
   				</td>
   			</tr>
   	</table>
 <?php require('includes/footer.php');?>  