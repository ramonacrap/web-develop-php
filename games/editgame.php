<?php
$pdo = new PDO('mysql:dbname=games;host=mysql', 'student', 'student');

if (isset($_POST['submit'])) {
	$stmt = $pdo->prepare('UPDATE game
						   SET name = :name , platformId = :platformId
						   WHERE id = :id');

	$values = [
		'name' => $_POST['name'],
		'platformId' => $_POST['platformId'],
		'id' => $_POST['id']
	];

	$stmt->execute($values);
	echo 'Game ' . $_POST['name'] . ' edited';
}
//If the form has not been submitted, check that a game has been selected to be edited e.g. editgame.php?id=3
else if (isset($_GET['id'])) {

	$gameStmt = $pdo->prepare('SELECT * FROM game WHERE id = :id');

	$values = [
		'id' => $_GET['id']
	];

	$gameStmt->execute($values);

	$game = $gameStmt->fetch();
?>
<form action="editgame.php" method="POST">
	<input type="hidden" name="id" value="<?php echo $game['id']; ?>"/>

	<label>Game name:</label>
	<input type="text" name="name"  value="<?php echo $game['name']; ?>" />
	<label>Select platform:</label>
	<select name="platformId">
	<?php

		$stmt = $pdo->prepare('SELECT * FROM platform');
		$stmt->execute();

		foreach ($stmt as $row) {
			if ($row['id'] == $game['platformId']) {
				echo '<option value="' . $row['id'] . '" selected="selected">' . $row['name'] . '</option>';
			}
			else {
				echo '<option value="' . $row['id'] . '">' . $row['name'] . '</option>';
			}
		}

	?>
	</select>

	<input type="submit" name="submit" value="Add" />
</form>
<?php
}
?>
