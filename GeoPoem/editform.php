<?php

    session_start();
    if(!isset($_GET['poem_id']) || empty($_GET['poem_id'])) {
        echo "Invalid ID :(";
        exit();
    }

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

    $sql = "SELECT poems.name AS name, poems.year AS year, poems.poem AS poem, cities.name AS city, poems.id AS id, cities.id AS city_id
    FROM poems 
    LEFT JOIN cities
		ON poems.cities_id = cities.id
    WHERE poems.id = " .$_GET['poem_id']. ";";

    $sql_cities = "SELECT * FROM cities;";
    $result_cities = $mysqli->query($sql_cities);
    if ( $result_cities == false ) {
        echo $mysqli->error;
        exit();
    }

    // echo $sql;
    $results = $mysqli->query($sql);
    if ( $results == false ) {
        echo $mysqli->error;
        exit();
    }
    $res = $results->fetch_assoc();

    // Close DB Connection
    $mysqli->close();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="pin.ico">
	<title>Edit Poem</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="addpoem.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="clearfloat"></div>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="homepage.html"><div class="header">
            <img src="logo.png" id ="logo" alt ="GeoPoem"/>
            <p id="tagline">the world through words...</p>
        </div></a></li>
	</ol>
	<div class="container-fluid">
        <div class="signup">
            <form action="editconf.php" method="POST" class="col-12" id="search-form">
                <div class="form-row">
                    <h3>Edit poem</h3>
                    <div class="field">
                        <label for="title-id" class="sr-only">Title*:</label>
                        <input type="text" name="title" class="form-control" id="title-id" value="<?php echo $res['name']?>">
                    </div>

                    <div class="field">
                        <label for="loc-id" class="sr-only">City*:</label>
                        <!-- <input type="text" name="loc" class="form-control" id="loc-id" placeholder=""> -->
                        <!-- <select name="album" id="album-id" class="form-control">
                            <option value="" selected disabled>-- Select one of the following --</option>
                        </select> -->
                        <select name="loc" id="loc-id" class="form-control">
						<option value="" selected disabled ><?php echo $res['city']; ?></option>
						<?php while( $row = $result_cities->fetch_assoc() ): ?>
							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['name']; ?>
							</option>
						<?php endwhile; ?>

					</select>
                    </div>

                    <div class="field">
                        <label for="YOP-id" class="sr-only">Year of publication (YYYY)*:</label>
                        <input type="number" name="YOP" class="form-control" id="YOP-id" min="1400" max="2021" value="<?php echo $res['year']?>">
                    </div>

                    <div class="field">
                        <label for="link-id" class="sr-only">Link*:</label>
                        <input type="url" name="link" class="form-control" id="link-id" value="<?php echo $res['poem']?>">
                    </div>

                    <div class="thanks">
                        <label class="sr-only">Thankyou for your contribution!</label>
                    </div>

                    <div class="garbage">
                        <button type="submit" class="btn btn-warning btn-block">Save!</button>
                    </div>

                </div>
                <input type="hidden" name="poem_id" value="<?php echo $res['id']?>">
            </form>
        </div>
    </div>
    <div id="footer">
        GeoPoem @2021
    </div>
    <script>
		//client side input validation
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#title-id').value.trim().length == 0 ) {
				document.querySelector('#title-id').classList.add('is-invalid');
			} else {
				document.querySelector('#title-id').classList.remove('is-invalid');
			}
            if(document.querySelector('#fname-id').value.trim() != $_SESSION['username'])
            {
                alert("Please enter the username you registered with!")
            }
			if ( document.querySelector('#loc-id').value.trim().length == 0 ) {
				document.querySelector('#loc-id').classList.add('is-invalid');
			} else {
				document.querySelector('#loc-id').classList.remove('is-invalid');
			}

            if ( (document.querySelector('#YOP-id').value.trim().length == 0) || (document.querySelector('#YOP-id').value > 2021 || (document.querySelector('#YOP-id').value < 1400))) {
				document.querySelector('#YOP-id').classList.add('is-invalid');
			} else {
				document.querySelector('#YOP-id').classList.remove('is-invalid');
			}

            if ( document.querySelector('#link-id').value.trim().length == 0 ) {
				document.querySelector('#link-id').classList.add('is-invalid');
			} else {
				document.querySelector('#link-id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>