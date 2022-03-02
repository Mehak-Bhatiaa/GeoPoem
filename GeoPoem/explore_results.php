<?php

// Establishing DB Connection
$host = "303.itpwebdev.com";
$user = "mabhatia_db_user";
$password = "ITP3032021_";
$db = "mabhatia_poem_db";

$mysqli = new mysqli($host, $user, $password, $db);
if ( $mysqli->connect_errno ) {
	echo $mysqli->connect_error;
	exit();
}

$mysqli->set_charset('utf8');

//generate and submit SQL
// Poems:
$sql = "SELECT poems.name, poets.name AS poet, cities.name AS city, poems.year, poems.poem
FROM poems
JOIN poets
	ON poems.poets_id = poets.id
JOIN cities
	ON poems.cities_id = cities.id
WHERE 1 = 1";

if ( isset($_GET['city_name']) && !empty($_GET['city_name']) ) {
	$sql = $sql . " AND cities.name LIKE '%" . $_GET['city_name'] . "%'";
}

if ( isset($_GET['poet_name']) && !empty($_GET['poet_name']) ) {
	$sql = $sql . " AND poets.name LIKE '%" . $_GET['poet_name'] . "%'";
}


$sql = $sql . " ORDER BY poets.name;";

//submit query
$results = $mysqli->query($sql);

//checking for errors
if ( $results == false ) {
	echo $mysqli->error;
	exit();
}

// Close DB Connection
$mysqli->close();

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="pin.ico">
	<title>Explore</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="explore.css">
</head>
<body>
	<?php include 'nav.php'; ?>
	<div class="container-fluid">
		<div class="row">
			<a href="homepage.php"><div class="header">
                <img src="logo.png" id ="logo" alt ="GeoPoem"/>
                <p id="tagline">the world through words...</p>
            </div></a>
		</div> <!-- .row -->

		<div class="row">

			<form action="explore.php" method="" class="col-12" id="search-form">
				<div class="form-row">
					<div class="col-12 mt-4 col-sm-auto garbage">
                         garbage
						<button type="submit" class="btn btn-warning btn-block"> Back to Explore</button>
					</div>

				</div>
			</form>

		</div> 

		<div class="row">

			<div class="col-12 mt-4 field">
				<span id="num-results" class="font-weight-bold"><?php echo $results->num_rows ?></span> match(es) found!
			</div>

			<table class="table table-responsive table-striped col-12 mt-3">
				<thead>
					<tr>
                        <div class=row1>
						    <th>Title</th>
                        </div>
						<th>Poet</th>
                        <div class="row1">
						    <th>City</th>
                        </div>
						<th>Year of Publication</th>
					</tr>
				</thead>
				<tbody>

						<?php while ( $row = $results->fetch_assoc() ) : ?>
							<tr>
								<td>
									<a class="title" href="<?php echo $row['poem'] ?>" target="blank">
										<?php echo $row['name']; ?>
									</a>
								</td>
								<td><?php echo $row['poet']; ?></td>
								<td><?php echo $row['city']; ?></td>
								<td><?php echo $row['year']; ?></td>
							</tr>
						<?php endwhile; ?>
				</tbody>
			</table>
		</div>

	</div> 
    <div id="footer">
        GeoPoem @2021
    </div>
</body>
</html>