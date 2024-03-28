<?php
function closeLayer($line_n=-1) { // Закрывающие теги для конца слоя (см. "Слои") и кнопка "+":
	if( $line_n == -1 ){
		$line_n = count($_SESSION['code']);
	}
	
	echo('
		<form action="index.php" method="post">
			<button class="new" type="submit" name="edit" value=+'.$line_n.'><span class="center">+</span></button>
		</form>
		</summary>
	</details>
	');
}

  /////////////////////////
 /////////////////////////
/////////////////////////
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
		<form action="index.php" method="post">
			<details>
				<summary><span class="grey">&emsp;'.$value.'</span></summary><br>
				<input type="hidden" name="page" value="editor">
				<button type="submit" name="layer" value="'.$line_n.'">&emsp;Переименовать слой</button>
				<button type="submit" name="delete" value="'.$line_n.'">&emsp;Удалить слой</button><br><br>
		</form>
			');
	} else if( strlen($line) < 3) { // Удаление пустых строк.
	} else if( strpos($line, ':') !== false ) { // Свойства и значения:
		
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
	} else { // Закомментировать строку, если "неправильная":
		$_SESSION['code'][$line_n] = '# '.$_SESSION['code'][$line_n];
		echo('
		<form action="index.php" method="post">
			<button type="submit" class="comment" name="edit" value="'.$line_n.'">
			<span class="greyComment">
			#   </span>
		</form>
		'.substr($line, 0).'</button>
		');
	}
}

if ($openedLayer) {
	closeLayer();
}

echo '
<br><br><br>

<form action="index.php" method="post">
	<button type="submit" name="layer" value="+'.( count($_SESSION['code'])+1 ).'">
		&emsp;Добавить новый слой
	</button>
	
	<button type="submit" name="grid" value="dialog">
		&emsp;Генерировать слой-сетку
	</button>

	<button type="submit" name="download" value="true" >
		&emsp;Скачать конфигурацию
	</button>

	<br><br><br>

	<button type="submit" name="delete" value="all">
		&emsp;Сбросить код
	</button>
</form>';
?>