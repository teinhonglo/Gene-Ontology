<?php

include("_DB_conn.php");

// Create connection
$conn = connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Search</title>
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
</head>
<body>
	<ul class="list-group">
    <?php
	$id = $_GET['id'];

	$sql = "SELECT ";
	$sql.= "A.id,A.name,A.term_type,A.acc,A.is_obsolete,A.is_root,A.is_relation,";
	$sql.= "B.term_definition,";
	$sql.= "C.term_synonym";
	$sql.= " FROM `term` A";
	$sql.= " left join `term_definition` B on A.id=B.term_id ";
	$sql.= " left join `term_synonym` C on A.id=C.term_id ";
	$sql.= " WHERE id = \"$id\";";

	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);

		// Join all synonym
		$synonym_sql = "SELECT term_synonym FROM `term_synonym` WHERE term_id =" . $row["id"];
		$synonym_res = mysqli_query($conn, $sql);
		if(mysqli_num_rows($synonym_res) > 0)
			$synonym = "";
			while ($srow = mysqli_fetch_assoc($synonym_res))
				if ($synonym)
					$synonym .= ", " . $srow["term_synonym"];
				else
					$synonym .= $srow["term_synonym"];

		$row["term_synonym"] = $synonym;
	?>

		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">ID</span></h4><?="\t" . $row["id"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">Name</span></h4><?="\t" . $row["name"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">Definition</span></h4><?="\t" . $row["term_definition"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">Type</span></h4><?="\t" . $row["term_type"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">Synonym</span></h4><?="\t" . $row["term_synonym"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">acc</span></h4><?="\t" . $row["acc"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">is_obsolete</span></h4><?="\t" . $row["is_obsolete"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">is_root</span></h4><?="\t" . $row["is_root"]?></li>
		<li class="list-group-item"><h4 style="display: inline-block;"><span class="label label-default">is_relation</span></h4><?="\t" . $row["is_relation"]?></li>
	<?php
	} else {
		echo "0 results";
	}

    mysqli_close($conn);
    ?>
	</ul>
	<script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
</body>
</html>