<?php
if(isset($_POST['delete']) and $_POST['delete'] != 'allConfirmed') {
	
	
	if (substr($_POST['delete'], -14) == 'layerConfirmed') { // Удаляем весь слой после подтверждения:
		$startLine = (int)strtok($_POST['delete'], 'C');
		
		unset($_SESSION['code'][$startLine]);
		$startLine += 1;
		
		$length = count($_SESSION['code']);
		
		while( substr($_SESSION['code'][$startLine], 0, 7) != '- name:' and $startLine <= $length ) {
			unset($_SESSION['code'][$startLine]);
			$startLine += 1;
		}
		$_SESSION['code'] = array_values($_SESSION['code']);

	} else {
		$object = $_POST['delete'];
		
		if ($object == 'all') {
			$message = 'Подтвердите удаление всего кода. Это действие нельзя отменить.';
		} else {
			$message = 'Подтвердите удаление слоя. Это действие нельзя отменить.';
			$object .= 'layer';
		}

		echo '<div class="modal-backdrop" onclick="location.href=\'?page=editor\'"></div>
		<div class="modal"><p>'.$message.'</p><br><br>
			<form action="index.php" method="post">
				<div class="btn_row">
					<button action="index.php" class="dg_btn" name="page" value="editor">Отмена</button>
					<input type="hidden" name="page" value="editor">
					<button type="submit" action="index.php" class="critical" name="delete" value="'.$object.'Confirmed">Удалить</button>
				</div>
			</form>
		</div>
	</div>
	';
	}
}
?>