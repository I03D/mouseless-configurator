<?php
function closeLayer($line_n=-1) { // Закрывающие теги для конца слоя (см. "Слои") и кнопка "+":
	if( $line_n != -1 ){
		echo('
			<form action="index.php" method="post">
				<button class="new" type="submit" name="edit" value=+'.$line_n.'><span class="center">+</span></button>
			</form>
			');
	}
	echo('
		</summary>
	</details>
	');
}

$settings = '
<div>devices:</div>
<div>baseMouseSpeed: 750.0</div>
<div>baseScrollSpeed: 20.0</div>
<div>mouseAccelerationTime: 200.0</div>
<div>mouseAccelerationCurve: 2.0</div>
<div>startMouseSpeed: 0.0</div>
<div>mouseDecelerationTime: 300.0</div>
<div>mouseDecelerationCurve: 3.0</div>
';
$split = 'Layers:';
$layer = '
<details>
	<summary>
	- name: initial<br>
	&emsp;	bindings:
	</summary>
	<div class="green">+</div>
	<div>f</div>
	<div>f</div>
	<div>f</div>
	<form action="index.php" method="post">
		<div class="critical" onclick="location.href=\'?page=editor&delete=1\'">Удалить слой</div>
	</form>
</details>
';
# echo $settings;
# echo $split;

# echo $layer;
# echo $layer;
foreach ($_SESSION['code'] as $line_n=>$line) { // Здесь визуализируются элементы из массива:

	if( substr($line, 0, 1) == '#' ) { // Комментарии:
		echo('
		<form action="index.php" method="post">
			<button type="submit" class="comment" name="edit" value="'.$line_n.'">
			<span class="greyComment">
			#   </span>
		</form>
		'.substr($line, 1).'</button>
		');
	} else if( substr($line, 0, 7) == 'layers:' ) { // Раздел слоёв:
		echo('<span class="grey">Слои:</span><sbr><br><br>');
	} else if( substr($line, 0, 7) == '- name:' ) { // Слои:
		if ($openedLayer) {
			closeLayer($line_n);
		}
		$openedLayer = True;
		
		
		$value = substr($line, strpos($line, ":")+1);
		echo('
		<details>
			<summary><span class="grey">&emsp;'.$value.'</span></summary><br>
			<form action="index.php" method="post">
				<input type="hidden" name="page" value="editor">
				<button type="submit" name="delete" value="'.$line_n.'">&emsp;Удалить слой</button><br><br>
			</form>
			');
	} else if( strlen($line) == 1) { // Пропуск пустых строк.
		// echo ' ';
	} else { // Свойства и значения:

		$name = strtok($line, ':');
		$value = substr($line, strpos($line, ":")+1);
		if (strlen($value) == 1) {
			$value = '-';
		}

		echo '
		<form action="index.php" method="post">
			<button type="submit" name="edit" value='.$line_n.'>
				<span class="n">
				'.$name.':
				</span>
				
				<span class="v">
				'.$value.'
				</span>
			</button>
		</form>
		';
	}
}

if ($openedLayer) {
	closeLayer();
}

echo '
<br><br><br>

<form action="index.php" method="post">
	<button action="index.php" name="layer" value=":'.( count($_SESSION['code'])+1 ).'">
		&emsp;Добавить новый слой
	</button>

	<button action="index.php" name="download" value="true" >
		&emsp;Скачать конфигурацию
	</button>

	<br><br><br>

	<button type="submit" name="delete" value="all" class="critical">
		&emsp;Сбросить код
	</button>
</form>';
?>