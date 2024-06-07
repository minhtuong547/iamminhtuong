<?php 
if(isset($_POST['email']) && !empty($_POST['email'])) {
	$handle = fopen("subscribe_list.txt", "a");
	fwrite($handle, PHP_EOL . $_POST['email']);
	fclose($handle);
}
?>