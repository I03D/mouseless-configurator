<?php
if( isset($_POST['grid']) ) {
	if($_POST['grid'] == 'dialog' ) {
	echo '
	<div class="modal-backdrop" onclick="location.href=\'?page=editor\'"></div>
		<div class="modal">
			Установите имя слоя, размеры сетки (X, Y) и разрешение экрана:
			<form action="index.php" method="post">
				<div class="btn_row">
					<input type="text" name="lyr_nm" value="aim">
					<input type="hidden" name="grid" value="generate">
					<input type="number" name="x" min="1" max="30" value="4">
					<input type="number" name="y" min="1" max="30" value="3">
					<input type="number" name="width" min="1" max="10000" value="1920">
					<input type="number" name="height" min="1" max="10000" value="1080">
				</div>
				<div class="btn_row">
					<button onclick="location.href=\'?page=editor\'">Отмена</button>
					<button type="submit">Отправить</button>
				</div>
			</form>
		</div>
	</div>
	';	
	} else {
		
		array_push( $_SESSION['code'], '- name: '.$_POST['lyr_nm'] );
		
		$letters = ['a','b','c','d','e','f','g',
		'h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
		
		$l = 0;
		$ll = '';
		
		$wStep = round($_POST['width']/$_POST['x'], 1);
		$hStep = round($_POST['height']/$_POST['y'], 1);
		
		$wShift = round($wStep / 2, 1);
		$hShift = round($hStep / 2, 1);
		
		for($y = 0; $y < $_POST['y']; $y += 1) {
			for($x = 0; $x < $_POST['x']; $x += 1) {
				array_push($_SESSION['code'],
					$letters[$l].$ll.': multi layer mouse;
									exec xdotool mousemove '.
									($wShift + ($wStep*$x)).' '.
									($hShift + ($hStep*$y)).PHP_EOL);
					#'test');
				$l += 1;
				if( $l >= count($letters) ) {
					$l = 0;
					if( $ll == '' ) {
						$ll = 2;
					} else {
						$ll += 1;
					}
				}
			}
		}
		unset($_POST['grid']);
	}
}

?>