<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="pin.ico">
    <title>Sign-up</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="signup.css">
</head>
<body onload="message()">
    <?php include 'nav.php'; ?>
    <div class="container-fluid">
        <div class="header">
            <a href="homepage.php"><div class="header">
                <img src="logo.png" id ="logo" alt ="GeoPoem"/>
                <p id="tagline">the world through words...</p>
            </div></a>
        </div>
        <div class="signup">
                <form action="signup_confirmation.php" method="POST" class="col-12" id="search-form">
                    <div class="form-row">
                        <h3>Sign-up!</h3>
                        <div class="field">
                            <label for="email-id" class="sr-only">Email Address*:</label>
                            <input type="email" name="email" class="form-control" id="email-id" placeholder="wspeare@gmail.com">
                            <small id="email-error" class="invalid-feedback">You must provide an email :(</small>
                        </div>
                        <div class="field">
                            <label for="username-id" class="sr-only">Name*:</label>
                            <input type="text" name="username" class="form-control" id="username-id" placeholder="William Shakespeare">
                            <small id="username-error" class="invalid-feedback">You must provide a username :(</small>
                        </div>
    
                        <div class="field">
                            <label for="password-id" class="sr-only">Password*:</label>
                            <input type="password" name="password" class="form-control" id="password-id" placeholder="123poetry">
                            <small id="password-error" class="invalid-feedback">You must provide a password :(</small>
                        </div>
    
                        <div class="garbage">
                            <button type="submit" class="btn btn-warning btn-block">Submit!</button>
                        </div>

                        <div class="field">
                            Already have an account? <a href="login.php">Log-in</a>
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
        function message() {
            alert("Welcome to the first step in your wonderful journey of poetry exploration!");
        }
		//client side input validation
		document.querySelector('form').onsubmit = function(){
			if ( document.querySelector('#username-id').value.trim().length == 0 ) {
				document.querySelector('#username-id').classList.add('is-invalid');
			} else {
				document.querySelector('#username-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#email-id').value.trim().length == 0 ) {
				document.querySelector('#email-id').classList.add('is-invalid');
			} else {
				document.querySelector('#email-id').classList.remove('is-invalid');
			}

			if ( document.querySelector('#password-id').value.trim().length == 0 ) {
				document.querySelector('#password-id').classList.add('is-invalid');
			} else {
				document.querySelector('#password-id').classList.remove('is-invalid');
			}

			return ( !document.querySelectorAll('.is-invalid').length > 0 );
		}
	</script>
</body>
</html>