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

    $sql_0 ="SELECT * FROM poets
    WHERE name = '".$_SESSION['username']."';";

    $poet_results = $mysqli->query($sql_0);
    if ( $poet_results == false ) {
        echo $mysqli->error;
        exit();
    }

    $sampling = $poet_results->fetch_assoc();

    $sql = "SELECT * FROM poems
    WHERE poets_id = '".$sampling['id']."';";
    
    $results = $mysqli->query($sql);
    if ( $results == false ) {
        echo $mysqli->error;
        exit();
    }

    // Close DB Connection
    $mysqli->close();

    // var_dump($_SESSION['username']); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="pin.ico">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="dashboard.css">
    <!-- <script type='text/javascript' src='js/demo.js'></script> -->
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
        <br>
        <div class="row">
            <button type="button" class="btn btn-outline-primary special_add" style="text-align:center;">
                <div class="col" id="button">
                    <a href="addpoem.php">Add a Poem</a>
                </div>
            </button>
        </div>
        <div class="row">
            <button type="button" class="btn btn-outline-primary">
                <div class="col" id="button">
                    <a href="selfedit.php">Edit your works</a>
                </div>
            </button>
        </div>
        <div class="row">
            <button type="button" class="btn btn-outline-primary">
                <div class="col" id="button">
                    <a href="selfdelete.php">Delete a piece</a>
                </div>
            </button>
        </div>
        <div id="speciall" style="visibility:hidden"><?php echo $results->num_rows; ?></div>
        <div class="row" id="priv_admin" style="visibility:hidden">
            <button type="button" class="btn btn-outline-primary">
                <div class="col" id="button">
                    <a href="deleteany.php">Delete ANY poem</a>
                </div>
            </button>
        </div>
    </div>
    <div class="clearfloat"></div>
    <div id="footer">
        GeoPoem @2021
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script type='text/javascript' src='particleground-master/jquery.particleground.js'></script>
    <script>
        document.querySelector(".special_add").onclick = function() {
            alert("Add 5 poems to gain special privelages ;)");
        }
        $testing = document.getElementById("speciall").textContent;
        console.log($testing);
        if ($testing > 4)
        {
            document.querySelector("#priv_admin").style.visibility = "visible";
        }
    </script>
</body>
</html>
