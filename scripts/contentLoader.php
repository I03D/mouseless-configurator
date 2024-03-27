<?php
// Можно упростить.
if(isset($_POST['page'])) {
	$page = $_POST['page'];
}

// Чтение файла в зависимости от запрашиваемой страницы:
switch($page) {
	case 'manual':
		include 'manual.html';
		break;
	case 'editor':
		include 'editor.php';
		break;
	case 'about':
		include 'about.html';
		break;
}
?>