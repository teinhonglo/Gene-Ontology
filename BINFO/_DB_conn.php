<?PHP
function connect(){
	$servername = "localhost";
	$username = "BINFO";
	$password = "BINFO";
	$dbname = "gene_ontology";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	return $conn;
}

?>