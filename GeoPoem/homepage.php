<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="pin.ico">
    <title>GeoPoem</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="homepage.css">
</head>
<body>
    <?php include 'nav.php'; ?>
    <div class="container-fluid">
        <div class="header">
            <img src="logo.png" id ="logo" alt ="GeoPoem"/>
            <p id="tagline">the world through words...</p>
        </div>
        <div class="textrows">
            <p>
                Often, when we travel to new places or wander around our own neighbourhood, we experience these locations largely through our senses. My motivation behind coming up with the concept of GeoPoem is to further the use of poetry as a means to explore places, both new and old. What GeoPoem allows users to do is experience places through the words of others by recommending poetry to them written at or about their location of choice. It also allows for new and established artists to share their own works of poetry, thus helping connect people and places through words.
            </p>
        </div>
        <div class="row">
            <button type="button" id="spacing" class="btn btn-outline-primary">
                <div class="col" id="button">
                    <a href="explore.php">Explore</a>
                </div>
            </button>
            <button type="button" id="spacing" class="btn btn-outline-primary">
                <div class="col" id="button">
                    <a href="signup.php">Contribute</a>
                </div>
            </button>
        </div>
    </div>
    <div class="clearfloat"></div>
    <div id="footer">
        GeoPoem @2021
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script>
        document.querySelector(".textrows").onmouseenter = function() {
            document.querySelector(".textrows").style.backgroundColor = "#94cbffaf";
            }
        document.querySelector(".textrows").onmouseleave = function() {
            document.querySelector(".textrows").style.backgroundColor = "rgb(0, 0, 0,0.5);";
        }
    </script>
</body>
</html>