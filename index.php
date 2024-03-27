<!DOCTYPE html>
<html lang="ru">
<link rel="stylesheet" href="styles.css">
<?php
	include 'scripts/sessionInit.php';
	include 'scripts/downloadConfig.php';
?>
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Mouseless-Configurator</title>
</head>
<body>
    <header>
		<div class="hdiv">
			<b>Mouseless-configurator</b>
		</div>
    </header>
	<?php
		// Здесь появляются модальные окна:
		include 'scripts/deleteDialog.php';
		include 'scripts/itemDialog.php';
		include 'scripts/layerDialog.php';
		include 'scripts/gridDialog.php';
		
	?>
	<div class="deco"> <!-- Этот раздел нужен для красивых
						закруглённых углов под header'ом.-->
		<div class="container">
			<div class="div menu"> <!-- Меню здесь. -->
				<form action="index.php" method="post">
					<input type="hidden" name="page" value="editor">
					<button submit onclick="location.href='?page=editor'"><b>Редактор</b></th>
				</form>
			
				<form action="index.php" method="post">
					<input type="hidden" name="page" value="manual">
					<button submit onclick="location.href='?page=editor'"><b>Документация</b></th>
				</form>
			
				<form action="index.php" method="post">
					<input type="hidden" name="page" value="about">
					<button submit onclick="location.href='?page=editor'"><b>О Mouseless</b></th>
				</form>
			</div>
			<div class="div content">
				<?php
					// А сюда загружается основной контент:
					// редактор, "about", документация.
					include 'scripts/contentLoader.php';
				?>
			</div>
		</div>
	</div>
</body>
</html>
