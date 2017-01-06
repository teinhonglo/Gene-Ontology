<?php
	ini_set('memory_limit', '256M');
	include("_DB_conn.php");

	// Create connection
	$conn = connect();
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	$sql = "SELECT id, name FROM `term`";

	$named_entitys 				= array();
	$named_entitys_replace   	= array();
	$id_lists					= array();
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($named_entitys, $row["name"]);
			array_push($id_lists, $row["id"]);
			#$named_entitys[$row["id"]]=$row["name"];
		}
	}

	$sql = "SELECT term_id, term_synonym FROM `term_synonym`";

	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($named_entitys, $row["term_synonym"]);
			array_push($id_lists, $row["term_id"]);
			#$named_entitys[$row["term_id"]]=$row["term_synonym"];
		}
	}

    mysqli_close($conn);
	// get the phrase parameter from URL
	$phrase = $_REQUEST["c"];
/*
	test:
	You should eat fruits, vegetables, and fiber every day.
	Fiber, also known as roughage, is the part of plant-based foods (grains, fruits, vegetables, nuts, and beans) that the body can't break down. It passes through the body undigested, keeping your digestive system clean and healthy, easing bowel movements, and flushing cholesterol and harmful carcinogens out of the body.Fiber comes in two varieties: insoluble and soluble.Insoluble fiber does not dissolve in water. It is the bulky fiber that helps to prevent constipation, and is found in whole grains, wheat cereals, and vegetables such as carrots, celery, and tomatoes.Soluble fiber dissolves in water and helps control blood sugar levels and reduce cholesterol. Good sources include barley, oatmeal, beans, nuts, and fruits such as apples, berries, citrus fruits, and pears.Many foods contain both soluble and insoluble fiber. In general, the more natural and unprocessed the food, the higher it is in fiber. There is no fiber in meat, dairy, or sugar. Refined or “white” foods, such as white bread, white rice, and pastries, have had all or most of their fiber removed.
*/
	$count = 0;

	/*foreach($named_entitys as $row)
	{
		//$named_entitys_replace[$count++] = "<a class=\"named_entity\" href=" . $ne . ".html >" . $ne . "</a>";
		$named_entitys_replace[$key] = "<a class=\"named_entity\" href='search sigal.php?id=".$row[0]."' >" . $row[1] . "</a>";
	}*/
	for ($i = 0; $i < count($named_entitys); $i++) {
		$named_entitys_replace[$i] = "<a class=\"named_entity\" href='search sigal.php?id=".$id_lists[$i]."' >" . $named_entitys[$i] . "</a>";
	}

	$new_phrase = str_replace($named_entitys, $named_entitys_replace, $phrase);

	// Output
	echo $new_phrase;
?>
