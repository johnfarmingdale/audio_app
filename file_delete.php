<?php  
 $FileToDelete = $_REQUEST['file'];
   unlink("./files/".$FileToDelete);
?>