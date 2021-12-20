<?php
$pdo = new PDO('mysql:dbname=games;host=mysql', 'student', 'student');

if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('INSERT INTO  game (name, platformId ) VALUES (:name, :platformId)');

	$values = [
		'name' => $_POST['name'],
		'platformId' => $_POST['platformId']
	];

	$stmt->execute($values);
	echo 'Game ' . $_POST['name'] . ' added';
}
else {
?>
<form action="addgame.php" method="POST">
	<label>Game name:</label>
	<input type="text" name="name" />
	<label>Select platform:</label>
	<select name="platformId">
	<?php

		$stmt = $pdo->prepare('SELECT * FROM platform');
		$stmt->execute();

		foreach ($stmt as $row) {
			echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
		}

	?>
	</select>

	<input type="submit" name="submit" value="Add" />
</form>
<?php
}
?>
