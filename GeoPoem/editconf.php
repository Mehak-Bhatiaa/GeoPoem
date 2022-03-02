<?php
    session_start();
    // Check what was passed from the add form
    // var_dump($_POST);

    // First check that all the REQUIRED fiels are filled out
    if ( !isset($_POST['title']) || 
        empty($_POST['title']) ||  
        !isset($_POST['loc']) || 
        empty($_POST['loc']) || 
        !isset($_POST['YOP']) || 
        empty($_POST['YOP']) || 
        !isset($_POST['link']) || 
        empty($_POST['link']) ||
        !isset($_POST['poem_id']) || 
        empty($_POST['poem_id'])  ) {

        $error = "Please fill out all required fields :(";
    }
    else {
        // All required fields are given. Time to connect to the database!
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
        
        // sql statement
        
        $sql = "UPDATE poems
        SET name = '".$_POST['title']."', year= ".$_POST['YOP'].", poem = '".$_POST['link']."', cities_id = ".$_POST['loc']."
        WHERE id = ".$_POST['poem_id'].";";

        // REally important to check that sql statement looks correct
        echo "<hr>" . $sql . "<hr>";

        // If looks good, query the db!

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

        $mysqli->close();
    }

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="pin.ico">
	<title>Edit</title>
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
        <div class="signup" style="height: 40vh;">
            <?php if ( isset($error) && !empty($error) ) : ?>
                <div id="tagline" style="font-size: 2vw;">
                    <?php echo $error; ?>
                </div>
            <?php else : ?>
                <div id="tagline" style="font-size: 2vw">
			        <span id="tagline" style="font-size: 2vw;"><?php echo $_POST['title']; ?></span> was successfully edited.
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div id="footer">
        GeoPoem @2021
    </div>
</body>
</html>