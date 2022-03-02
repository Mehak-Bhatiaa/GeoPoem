<nav class="navbar navbar-light fixed-top" style="background-color:rgb(255, 187, 0) ">
        <div class="container">
                <a href="homepage.php" class="navbar-brand"><i class="fas fa-calculator mr-3"></i>GeoPoem</a>
                <a class="nav-link" href="explore.php">Explore</a>
                <?php if(!isset($_SESSION["logged_in"]) || !$_SESSION["logged_in"]) :?>
                    <a class="nav-link" href="signup.php">Signup</a>
                    <a class="nav-link" href="login.php">Log-in</a>

                <?php else: ?>
                    <a class="nav-link" href="dashboard.php">Dashboard</a>
                    <a class="nav-link" href="dashboard.php"><div class="p-2"><?php echo $_SESSION["username"];?>'s account</div></a>

                <?php endif;?>
        </div>
    </nav>