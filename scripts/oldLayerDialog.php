<?php
if( isset($_POST['layer']) ) {
	if( substr($_POST['layer'], 0, 1) == ':' ) {
		$pos = substr($_POST['layer'], 1);
		$newLayer == true;
	} else {
		$pos = $_POST['layer'];
		$newLayer = false;
	}
	
	echo '
	<div class="modal-backdrop" onclick="location.href=\'?page=editor\'"></div>
		<div class="modal">
			Введите название слоя:
			<form action="index.php" method="post">
				<input type="text" name="layer" value="';
				if($newLayer) {
					echo htmlspecialchars($_SESSION['code'][$pos]);
				}
				echo '" autofocus">
				<div class="btn_row">
					<button onclick="location.href=\'?page=editor\'">Отмена</button>
					<input type="hidden" name="newLayer" value="'.$newLayer.'">
					<button type="submit">Отправить</button>
				</div>
			</form>
		</div>
	</div>
	';
}

# По реализации импорта простого добавления в конец может быть недостаточно
# в особых случаях, если секция layers окажется закрытой. Хотя и принято
# оставлять её до конца файла. Тогда придётся находить точную строку конца.
if( $_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['newLayer']) ) {
	array_push($_SESSION['code'], '- name: '.(string)$_POST["newLayer"].PHP_EOL);
	array_push($_SESSION['code'], '    passThrough: true'.PHP_EOL);
	array_push($_SESSION['code'], '    bindings:'.PHP_EOL);
	# $_SESSION['code'][$pos+1] = '    passThrough:'.PHP_EOL;
}

?>