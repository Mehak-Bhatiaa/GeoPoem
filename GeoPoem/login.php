<?php

session_start();
// Using session variables, we can check if a user is logged in or not. If logged in, kick them out of this page
if( !isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {

	// If we get $_POST['username], it means user tried to submit the login form (as opposed to user just getting to the form page (GET request))
	if ( isset($_POST['username']) && isset($_POST['password']) ) {
		// Checking that both username and password was filled out
		if ( empty($_POST['username']) || empty($_POST['password']) ) {

			$error = "Please enter username and password :(";

		}
		else {
			// User filled out both username and password so connect to db and check combo
            $host = "303.itpwebdev.com";
            $user = "mabhatia_db_user";
            $password = "ITP3032021_";
            $db = "mabhatia_poem_db";
        
            $mysqli = new mysqli($host, $user, $password, $db);

			if($mysqli->connect_errno) {
				echo $mysqli->connect_error;
				exit();
			}
			// Hash the user's input and compare this hashed version to the hashed password in the database
			$passwordInput = hash("sha256", $_POST["password"]);

			$sql = "SELECT * FROM users
						WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";

			
			$results = $mysqli->query($sql);

			if(!$results) {
				echo $mysqli->error;
				exit();
			}

			// If we get a result back, that means there was a username/pw combo match! 
			if($results->num_rows > 0) {
				// echo "logged in!";
				// Use session to store some simple information that we want to persist throughout the web application
				$_SESSION['logged_in'] = true;
				$_SESSION['username'] = $_POST['username'];

				// Redirect the user to the home page
				header("Location: dashboard.php");
				
			}
			else {
				$error = "Invalid email or password.";
			}
		} 
	}
}
else {
	// This user is logged in so they don't need to see this page. Redirect them to the homage page.
	header("Location: dashboard.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="pin.ico">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="login.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container-fluid">
        <a href="homepage.php"><div class="header">
            <img src="logo.png" id ="logo" alt ="GeoPoem"/>
            <p id="tagline">the world through words...</p>
        </div></a>
        <div class="signup">
                <form action="login.php" method="POST" class="col-12" id="search-form">
                    <div class="form-row">
                        <h3>Log-in!</h3>
                        <div class="field">
                            <label for="username-id" class="sr-only">Username*:</label>
                            <input type="username" name="username" class="form-control" id="username-id" placeholder="Will Shakespeare">
                        </div>
                        <div class="field">
                            <label for="password-id" class="sr-only">Password*:</label>
                            <input type="password" name="password" class="form-control" id="password-id" placeholder="123poetry">
                        </div>
                        <div class="font-italic text-danger col-sm-9 ml-sm-auto" style="margin-left:auto; margin-right:auto;">
                            <!-- Show errors here. -->
                            <p  style="text-shadow: 2px 1px black; color:red; font-size: 2vw; text-align:center; padding-top:3%;">
                                <?php
                                    if ( isset($error) && !empty($error) ) {
                                        echo $error;
                                    }
                                ?>
                            </p>
                        </div>
                        <div class="garbage">
                            <button type="submit" class="btn btn-warning btn-block" href="<?php echo $_SERVER['HTTP_REFERER']; ?>">Enter!</button>
                        </div>
                    </div>
                </form>

        </div>
    </div>
    <div id="footer">
        GeoPoem @2021
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
		//client side input validation
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#username-id').value.trim().length == 0 ) {
				document.querySelector('#username-id').classList.add('is-invalid');
			} else {
				document.querySelector('#username-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password-id').value.trim().length == 0 ) {
				document.querySelector('#password-id').classList.add('is-invalid');
			} else {
				document.querySelector('#password-id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}


        //making use of webstorage to save username
        let storedEmail = localStorage.getItem("email-id");
	</script>
</body>
</html>