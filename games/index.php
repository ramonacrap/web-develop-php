<ul>
	<li><a href="addplatform.php">Add Platform</a></li>
	<li><a href="addgame.php">Add Game</a></li>
</ul>

<h2>Select platform:</h2>
<ul>
<?php
    $pdo = new PDO('mysql:dbname=games;host=mysql', 'student', 'student');
	$stmt = $pdo->prepare('SELECT * FROM platform');

	$stmt->execute();

	foreach ($stmt as $row) {
		echo '<li><a href="viewgames.php?platformId=' . $row['id'] . '">' . $row['name'] . '</a></li>';
	}
?>
</ul>
