<?php
// Add the database.php file, which has the code needed to create a database connection//
include 'database.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Carbuy Auctions</title>
    <!--Provides a styling link to the carbuy.css stylesheet -->
    <link rel="stylesheet" href="carbuy.css" />
</head>
<body>
    <!-- Section Header-->
    <header>
        <!-- The index.php page is linked to the Carbuy logo -->
        <h1><a href="index.php"><span class="C">C</span>
            <span class="a">a</span>
            <span class="r">r</span>
            <span class="b">b</span>
            <span class="u">u</span>
            <span class="y">y</span>
            </a>
        </h1>
        <!-- Searching form -->
        <form action="search.php" method="post">
            <!-- Field for entering search terms for cars -->
            <input type="text" name="search" placeholder="Search for a car" />
            <!-- The search form's "Submit" button -->
            <input type="submit" name="submit" value="Search" />
        </form>
    </header>
    <!-- Navigating section -->
    <nav>
        <ul>
            <?php 
            // From the 'category' database, extract every category//
            $c_La_Ss  = $T_ie->query('SELECT * FROM category'); //from category bata//
            // Go over each category once and put it in the navigation menu//
            foreach ($c_La_Ss as $c_La_Ss) { ?>
                <!--List item with a URL to the page category.php -->
                <li><a class="categoryLink" href="category.php?id=<?php echo $c_La_Ss['category_id'] ?>"><?php echo $c_La_Ss['name'] ?></a></li>
            <?php } ?>
        </ul>
    </nav>
    <!-- Section on main content -->
    <?php 
    // esle user logged in cha ki nai vanera check garcha//
    if (isset($_SESSION['account'])) { ?>
        <!-- List item with the page myAuction.php hyperlinked to it -->
        <li><a href="myAuction.php">My Auctions</a></li>
        <?php 
        // user admin ho ki haina vanera check garcha//
        if ($_SESSION['role'] == 'admin') { ?>
            <!-- Include a link to the adminCategories.php page in the list item -->
            <li><a href="adminCategories.php">Admin Categories</a></li>
            <!-- Link to the manageAdmins.php page in the list item -->
            <li><a href="manageAdmins.php">Manage Admins</a></li>
        <?php } ?>
        <!-- List item containing a link to the page logout.php -->
        <li><a href="logout.php">Logout</a></li>
    <?php } else { ?>
        <!-- List item that points to the logout.php page  -->
        <li><a class="categoryLink" href="login.php">Login</a></li>
    <?php } ?>
    <!--esle  Banner image dekhaucha -->
    <img src="banners/1.jpg" alt="Banner" />
    <!-- this is the  Main content section of the page -->
    <main>
