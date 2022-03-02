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

    //Cities:
    $sql_cities = "SELECT * FROM cities;";
    $results_cities = $mysqli->query($sql_cities);
    if ( $results_cities == false ) {
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
	<title>Add Poem</title>
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
            <form action="addconf.php" method="POST" class="col-12" id="search-form">
                <div class="form-row">
                    <h3>Add your own work!</h3>
                    <div class="field">
                        <label for="title-id" class="sr-only">Title*:</label>
                        <input type="text" name="title" class="form-control" id="title-id" placeholder="Wild Geese">
                    </div>

                    <div class="field">
                        <label for="loc-id" class="sr-only">Name of the city that inspired you*:</label>
                        <!-- <input type="text" name="loc" class="form-control" id="loc-id" placeholder=""> -->
                        <!-- <select name="album" id="album-id" class="form-control">
                            <option value="" selected disabled>-- Select one of the following --</option>
                        </select> -->
                        <select name="loc" id="loc-id" class="form-control">
						<option value="" selected disabled >-- Select One --</option>
						<?php while( $row = $results_cities->fetch_assoc() ): ?>

							<option value="<?php echo $row['id']; ?>">
								<?php echo $row['name']; ?>
							</option>

						<?php endwhile; ?>

					</select>
                    </div>

                    <div class="field">
                        <label for="YOP-id" class="sr-only">Year of publication (YYYY)*:</label>
                        <input type="number" name="YOP" class="form-control" id="YOP-id" min="1400" max="2021" placeholder="1923">
                    </div>

                    <div class="field">
                        <label for="link-id" class="sr-only">Add a link to your work!*:</label>
                        <input type="url" name="link" class="form-control" id="link-id" placeholder="https://wordpress.home.blog">
                    </div>

                    <div class="thanks">
                        <label class="sr-only">Thankyou for being part of our community!</label>
                    </div>

                    <div class="garbage">
                        <button type="submit" class="btn btn-warning btn-block">Upload!</button>
                    </div>

                </div>
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