<?php

$db = new SQLite3('./database.db');

$db->exec("CREATE TABLE IF NOT EXISTS Names (name varchar(16))");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$name = $_POST["name"];

	$sql = "INSERT INTO Names (name) VALUES (:name)";
	$stmt = $db->prepare($sql);
	$stmt->bindParam(':name', $name);
	$stmt->execute();}	

$rows = $db->query("SELECT * FROM Names");

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>AH Computing Example - Names</title>
</head>
<body>
	<h1>Add a name</h1>

	<form action="/" method="post">
		<input type="text" name="name" minlength="3" maxlength="16">

		<input type="submit">
	</form>

	<h1>Names</h1>

	<?php

	while ($name = $rows->fetchArray()) {
		echo $name["name"] . "<br>";
	}

	?>
</body>
</html>