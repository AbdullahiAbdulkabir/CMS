<?php require_once('includes/functions.php'); 
      require_once('includes/connect.php');
$errors = array();		
		 //form validation  		
  if (!isset($_POST['menu_name']) || empty($_POST['menu_name'])  ) {
  	$errors[] = 'menu_name';
  }
	if (!empty($errors)) {
		redirect_to('new_subject.php');
		}	
		
		
?>		
<?php  
$menu_name = $_POST['menu_name'];
$position = $_POST['position'];
$visible = $_POST['visible'];
?>
<?php 
$query = "INSERT INTO subjects(menu_name, position,visible) VALUES ('$menu_name', {$position}, {$visible})"; 

if (mysql_query($query, $connection)) {
	header("Location:content.php");
exit;
}else {
echo "<p>Subject creation failed.</p>";
echo "<p>.mysql_error().</p>";}
?>

<?php mysql_close($connection); ?>