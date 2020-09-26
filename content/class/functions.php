<?php
	function redirect_to($page) {
		header("location: " . $page);
	}

	function escape($value) {
		return addcslashes($value, '$_');
	}

	function option($key, $value, $selected = NULL){
		return '<option value="'.$value.'" '.($selected!=NULL&&$value==$selected ? 'selected' : '').'>'.$key.'</option>';
	}

?>