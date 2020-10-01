<?php
// Displays the file that is recieved.
class Load {

	function display($file_name, $data = null) {
		if (is_array($data)) {
			extract($data);
		}
		include $file_name . '.php';
	}
}
?>
