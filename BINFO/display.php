<!DOCTYPE html>
<?php

include("_DB_conn.php");

// Create connection
$conn = connect();
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Display all data</title>
    <link rel="stylesheet" type="text/css" href="dist/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="dist/css/sticky-footer-navbar.css">
    <!-- Add jQuery library -->
    <script type="text/javascript" src="fancybox/lib/jquery-1.10.1.min.js"></script>
    <!-- Add mousewheel plugin (this is optional) -->
    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <!-- Add fancyBox main JS and CSS files -->
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <script type="text/javascript">
        // fancybox
        $('.named_entity').fancybox({
                type : 'iframe',
                padding : 5
        });
    </script>
</head>
<body role="document">
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span> <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.html">105-1 Bioinformatics Final Project</a>
            </div>
            <div id="navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="display.php">Display all</a></li>
                    <li><a href="search.php">Search</a></li>
                    <li><a href="mapping.html">Term mapping</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" role="main">
        <div class="jumbotron">
            <h1>Display all data</h1>
        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT id, name, term_type FROM `term`;";

                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row["id"] . "</td><td>" . $row["name"] . "</td><td>" . $row["term_type"] . "</td>";
                    echo "<td><a class=\"btn btn-sm btn-info named_entity\" href='search sigal.php?id=" . $row["id"] . "'>More</a></td>";
                    echo "</tr>";
                }

                mysqli_close($conn);
                ?>
            </tbody>
        </table>

    </div>
    <footer class="footer">
        <div class="container" style="text-align: center">
            <p class="text-muted">
            &copy; 2016 NTNU CSIE 60547047S 羅天宏, 60547052S 林奕儒, 40247043S 劉慈恩.
            </p>
        </div>
    </footer>

    <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    function validateForm() {
        var x = document.forms["search"]["query"].value;
        if (x == "") {
            return false;
        }
    }
    </script>
</body>
</html>
