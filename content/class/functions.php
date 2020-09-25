<?php
	function redirect_to($page) {
		header("location: " . $page);
	}

	function escape($value) {
		return addcslashes($value, '$_');
	}
?>