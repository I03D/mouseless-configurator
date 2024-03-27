<?php
if( isset($_POST['edit']) ) {
	if( isset($_POST['line']) ) {		
		if( substr($_POST['edit'], 0, 1) == '+' ) {
			$edit = substr($_POST['edit'], 1);
			$add = true;
		} else {
			$edit = $_POST['edit'];
			$add = false;
		}
		
		if( $add ) {
			$x                = array_merge(
		 						array_slice($_SESSION['code'], 0, $edit),
								[(string)$_POST['line'].PHP_EOL],
								array_slice($_SESSION['code'], $edit));
		
			#$x = array_splice($_SESSION['code'], (int)$edit, 0, $_POST['line']);
			#print_r(array_splice($_SESSION['code'], 3, 0, 'test'));
			#$x = ['test', 'test2'];
			$_SESSION['code'] = $x;		
		} else {
			$_SESSION['code'][$edit] = (string)$_POST["line"].PHP_EOL;
		}
	} else {
		$edit = $_POST['edit'];
		echo '
		<div class="modal-backdrop" onclick="location.href=\'?page=editor\'"></div>
			<div class="modal">
				Введите значение свойства:
				<form action="index.php" method="post">
					<input type="text" name="line" value="'.htmlspecialchars($_SESSION['code'][$edit]).'" autofocus">
					<div class="btn_row">
						<button onclick="location.href=\'?page=editor\'">Отмена</button>
						<input type="hidden" name="edit" value="'.$edit.'">
						<button type="submit">Отправить</button>
					</div>
				</form>
			</div>
		</div>
		';
	}
}


?>
