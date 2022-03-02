<?php


//server side input validation
if ( !isset($_POST['email']) || empty($_POST['email'])
	|| !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all of the required fields :)";
}

else {
    // Establishing DB Connection
    $host = "303.itpwebdev.com";
    $user = "mabhatia_db_user";
    $password = "ITP3032021_";
    $db = "mabhatia_poem_db";

    $mysqli = new mysqli($host, $user, $password, $db);

	
	if($mysqli->connect_errno) {
		echo $mysqli->connect_error;
		exit();
	}

	//if username or email already exists in the users table query db
	$statement_registered = $mysqli->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
	$statement_registered->bind_param("ss", $_POST["username"], $_POST["email"]);
	$executed_registered = $statement_registered->execute();
	if(!$executed_registered) {
		echo $mysqli->error;
	}

	//number of results using prepared statements
	$statement_registered->store_result();
	$numrows = $statement_registered->num_rows;

	$statement_registered->close();

	//username or email is taken if we get result
	if( $numrows > 0) {
		$error = "Username or email is already taken :(";
	}
	else {
		// Hash the password
		$password = hash("sha256", $_POST["password"]);

		// Add this information as a new record into the newly created users table
		$statement = $mysqli->prepare("INSERT INTO users(username, email, password) VALUES(?,?,?)");
		$statement->bind_param("sss", $_POST["username"], $_POST["email"], $password);
		$executed = $statement->execute();
		if(!$executed) {
			echo $mysqli->error;
		}
		$statement->close();

        //add user to poet list
        $sql = "INSERT INTO poets(name)
        VALUES('" . $_POST["username"] . "');";

        $results = $mysqli->query($sql);
        if( !$results) {
            echo $mysqli->error;
            exit();
        }

        // To check if it was added, affected_rows returns the number of rows inserted, updated or deleted by the last SQL query 
        echo "Inserted: " . $mysqli->affected_rows;

        if($mysqli->affected_rows > 0) {
            $isInserted = true;
        }

	}

	$mysqli->close();
	
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="pin.ico">
    <title>Sign-up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="signup_conf.css">
</head>
<body>
    <section class="container-fluid">
        <?php include 'nav.php'; ?>
        <div id="particles" style="width:100vw; height:30vh"></div>
        <div class="header" id="intro">
            <a href="homepage.php"><div class="header">
                <img src="logo.png" id ="logo" alt ="GeoPoem"/>
                <p id="tagline">the world through words...</p>
            </div></a>
        </div>
        <div class="signup">
            <?php if ( isset($error) && !empty($error) ) : ?>
                <div id="content">
                    <div class="text-danger" style="text-shadow: 2px 1px black"><?php echo $error; ?></div>
                    <button type="submit" class="btn btn-warning btn-block"><a href="signup.php">Try Again!</a></button>
                </div>
            <?php else : ?>
                <div id="content">
                    <p> Welcome to the GeoPoem community! Thank you for signing up :)</p>
                    <div class="field">
                        Please proceed to <a href="login.php" style="text-decoration: underline">Log-in</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
        <div id="particles_2" style="width:100vw; height:30vh"></div>
    </section>
    <div id="footer">
        GeoPoem @2021
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type='text/javascript' src='particleground-master/jquery.particleground.js'></script>
    <script>
        /**
         * Particleground demo
         * @author Jonathan Nicol - @mrjnicol
         */

        document.addEventListener('DOMContentLoaded', function () {
        particleground(document.getElementById('particles'), {
            dotColor: 'rgb(250, 97, 148)',
            lineColor: '#dfd424',
            density:7000,
            parrticleRadius:27,
            lineWidth:3
        });
        }, false);
        document.addEventListener('DOMContentLoaded', function () {
        particleground(document.getElementById('particles_2'), {
            dotColor: 'rgb(250, 97, 148)',
            lineColor: '#dfd424',
            density:7000,
            parrticleRadius:27,
            lineWidth:3
        });
        }, false);
    </script>
</body>
</html>