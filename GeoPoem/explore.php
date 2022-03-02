<?php
session_start();
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
ORDER BY poets.name;";

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

			<form action="explore_results.php" method="GET" class="col-12" id="search-form">
				<div class="form-row">

					<div class="col-12 mt-4 col-sm-6 col-lg-4 field">
                        City:
						<label for="search-id" class="sr-only">Search:</label>
						<input type="text" name="city_name" class="form-control" id="search-id" placeholder="London">
					</div>

					<div class="col-12 mt-4 col-sm-4 col-md-3 col-lg-2 field">
                        Poet:
						<label for="limit-id" class="sr-only">Number of results:</label>
                        <input type="text" name="poet_name" class="form-control" id="search-id" placeholder="Wordsworth">
					</div>

					<div class="col-12 mt-4 col-sm-auto garbage">
                         garbage
						<button type="submit" class="btn btn-warning btn-block">Search</button>
					</div>

				</div>
			</form>

		</div> 

		<div class="row">
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
					<!-- <tr>
						<td><a class="title" href="https://www.poetryfoundation.org/poems/58180/los-angeles-56d23c544a77e" target="blank">Los Angeles</a></td>
						<td>Ben Fama</td>
						<td>Los Angeles</td>
						<td>2015</td>
					</tr>
                    <tr>
						<td><a class="title" href="https://www.poetryfoundation.org/poems/57620/los-angeles-boys" target="blank">Los Angeles/Boys</a></td>
						<td>Rachel Sherwood</td>
						<td>Los Angeles</td>
						<td>1981</td>
					</tr>
                    <tr>
						<td><a class="title" href="https://www.poetryfoundation.org/poetrymagazine/browse?contentId=25521" target="blank">Los Angeles Smog</a></td>
						<td>John Gould Fletcher</td>
						<td>Los Angeles</td>
						<td>1950</td>
					</tr>
                    <tr>
						<td><a class="title" href="https://www.poetryfoundation.org/poems/154872/new-years-eve-5fb7f66495649" target="blank">New Year's Eve</a></td>
						<td>Warren Woessner</td>
						<td>New York City</td>
						<td>2019</td>
					</tr>
                    <tr>
						<td><a class="title" href="https://www.poetryfoundation.org/poetrymagazine/poems/49324/new-york-56d22b4bed8f8" target="blank">New York</a></td>
						<td>Valzhyna Mort</td>
						<td>New York City</td>
						<td>2007</td>
					</tr>
                    <tr>
						<td><a class="title" href="https://www.poetryfoundation.org/poems/154261/new-yor-i" target="blank">New Yor I</a></td>
						<td>Peter Davison</td>
						<td>New Yorkk City</td>
						<td>1995</td>
					</tr>
                    <tr>
						<td><a class="title" href="https://www.poetryfoundation.org/poetrymagazine/poems/57740/london-exchange" target="blank">London Exchange</a></td>
						<td>Eileen Myles</td>
						<td>London</td>
						<td>2015</td>
					</tr>
                    <tr>
						<td><a class="title" href="https://www.poetryfoundation.org/poems/51900/londons-summer-morning" target="blank">London’s Summer Morning</a></td>
						<td>Mary Robinson</td>
						<td>London</td>
						<td>2006</td>
					</tr> -->
                    
                    

				</tbody>
			</table>
		</div>

	</div> 
    <div id="footer">
        GeoPoem @2021
    </div>
</body>
</html>
