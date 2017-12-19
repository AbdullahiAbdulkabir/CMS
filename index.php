<?php require_once('includes/functions.php'); 
      require_once('includes/connect.php'); 
      include('includes/header.php'); ?>
<?php 
 find_selected_page();?>
   	<table id="structure">
   			<tr>
   				<td id="navigation">
        <?php  echo public_navigation($sel_subject, $sel_page); ?>
        
      
   				</td>	
   				<td id="page">
        <?php  if (!is_null($sel_subject)) { //subject selected?>
           <h2> <?php echo  $sel_subject['menu_name']; ?></h2>
        <?php } elseif (!is_null($sel_page)) { //page selected ?>   <h2> <?php echo  $sel_page['menu_name']; ?></h2>
            <div class="page-content">
                 <?php echo $sel_page['content']; ?>
            </div>   
      
   		  <?php	} else {//nothing selected} ?>
            <h2> Welcome to Widget Corp</h2>
        <?php } ?>          
           				
   				</td>
   			</tr>
   	</table>
 <?php require('includes/footer.php');?>  