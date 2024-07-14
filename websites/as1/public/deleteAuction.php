<?php
// Add the database.php file, which has the code needed to create a database connection.
require 'database.php';

//Esle user logged in cha ki nai vanera check garcha//
if(isset($_SESSION['account'])) {
    //Esle GET parameters bata auction ID retrieve garcha//
    $I_Dent_y = $_GET['id'];

    //Esle auction table bata auction delete garne vanne SQL statement display garcha//
    $V_en_d_DUes = $T_ie->prepare("DELETE FROM auction WHERE auction_id = $I_Dent_y");

    //Esle auction delete garna lai prepared statement lai execute garcha//
    $V_en_d_DUes->execute();

    // Auction successfully delete vaye pachi user lai 'myAuction.php' vanne page ma direct garcha//
    echo '<script>window.location.href="myAuction.php" </script>';

    // Yesle script execution lai exit garcha//
    exit;
} else {
    //Esle user logged in chaina vane lack of permission vanne message display garcha//
    echo "not available to you";
}
?>
