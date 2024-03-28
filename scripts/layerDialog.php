<?php
if( isset($_POST['newLayer']) and isset($_POST['layerSubmit']) ) {
	# array_push($_SESSION['code'], '- name:test'.PHP_EOL);
	if( isset($_POST['newLayer']) ) {
		if( substr($_POST['newLayer'], 0, 1) == '+' ) {
			$pos = substr($_POST['newLayer'], 1);
			
			array_push($_SESSION['code'], '- name: '.(string)$_POST["layerName"].PHP_EOL);
			array_push($_SESSION['code'], '    passThrough: true'.PHP_EOL);
			array_push($_SESSION['code'], '    bindings:'.PHP_EOL);
			# $_SESSION['code'][$pos+1] = '    passThrough:'.PHP_EOL;
		} else {
			$pos = $_POST['newLayer'];
			
			$_SESSION['code'][$pos] = '- name: '.(string)$_POST["layerName"].PHP_EOL;
		}
		unset($_POST['layerSubmit']);
		unset($_POST['newLayer']);
		
	}
} else if( isset($_POST['layer']) ){
	if( substr($_POST['layer'], 0, 1) == '+' ) {
		$pos = substr($_POST['layer'], 1);
	} else {
		$pos = $_POST['layer'];
	}

	
	$pos = $_POST['layer'];
	echo '
	<div class="modal-backdrop" onclick="location.href=\'?page=editor\'"></div>
		<div class="modal">
			Введите название слоя:
			<form action="index.php" method="post">
				<input type="text" name="layerName" value="';
				if($newLayer) {
					echo htmlspecialchars($_SESSION['code'][$pos]);
				}
				echo '" autofocus">
				<div class="btn_row">
					<button onclick="location.href=\'?page=editor\'">Отмена</button>
					<input type="hidden" name="newLayer" value="'.$_POST['layer'].'">
					<button type="submit" name="layerSubmit">Отправить</button>
				</div>
			</form>
		</div>
	</div>
	';
}

?>