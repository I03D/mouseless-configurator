<?php
if(isset($_POST['download']) and $_POST['download'] == 'true') {
	
	// Создаем временный файл с текстом kuku
	
	$tmp_file = tempnam(sys_get_temp_dir(), 'config.yaml');
	
	if (ob_get_level()) {
		ob_end_clean();
	}


	header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="config.yaml"');
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($tmp_file));

	$content = implode($_SESSION['code']);
	file_put_contents($tmp_file, $content);

    
	
	


	readfile($tmp_file);
	

	// Удаляем временный файл после использования
	unlink($tmp_file);
	exit;
}
?>