
<?php require_once('includes/functions.php'); 
      require_once('includes/connect.php'); 
      include('includes/header.php'); ?>
<?php 
find_selected_page();
?>
   	<table id="structure">
   			<tr>
   				<td id="navigation">
        <?php  echo navigation($sel_subject, $sel_page); ?>
   				</td>	
   				<td id="page">	
		<h2> Add subject</h2>
        	<form action="create_subject.php" method="post">
		  <p>Subject name:
		    <input type="text" name="menu_name" value="" />
		  </p>
		  <p>Position:
		    <select name="position">
		   <?php  $subject_set = get_all_subjects();
					$subject_count = mysql_num_rows($subject_set);
		for($count = 1; $count <=($subject_count + 1); $count++) {
						echo "<option value=\"{$count}\">{$count}</option>";
					}?>
			
		    </select>
		  </p>
		  <p>Visible:
		    <input type="radio" name="visible" value="0" /> No
		    &nbsp;
		    <input type="radio" name="visible" value="1" /> Yes
		  </p>
		  <input type="submit" value="Add Subject" />
		</form>	<br />
		<a href="content.php">Cancel</a>
   				</td>
   			</tr>
   	</table>
 <?php require('includes/footer.php');?>  