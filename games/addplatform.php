 <?php
if (isset($_POST['submit'])) {
    $pdo = new PDO('mysql:dbname=games;host=mysql', 'student', 'student');


	$stmt = $pdo->prepare('INSERT INTO  platform (name) VALUES (:name)');

	$values = [
		'name' => $_POST['name']
	];

	$stmt->execute($values);
	echo 'Platform ' . $_POST['name'] . ' added';
}
else {
?>
<form action="addplatform.php" method="POST">
	<label>Platform name:</label>
	<input type="text" name="name" />
	<input type="submit" name="submit" value="Add" />
</form>
<?php
}
?>
