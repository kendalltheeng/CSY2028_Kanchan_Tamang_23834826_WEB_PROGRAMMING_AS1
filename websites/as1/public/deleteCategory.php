<?php
// Add the database.php file, which has the code needed to create a database connection.
require 'database.php';

// Esle user login vayo ki nai ani admin role pacha ki nai vanera check garcha//
if(isset($_SESSION['account']) && $_SESSION['role'] == 'admin') {
    // Esle GET parameters bata category ko ID retrieve garcha//
    $I_Dent_yent_y = $_GET['id'];

    //Esle euta SQL atatement banaucha jas bata category category table bata hatauna milcha//
    $c_La_Sss = $T_ie->prepare("DELETE FROM category WHERE category_id = $I_Dent_yent_y");

    // Esle tayar gareko statement jasma category delete garna parcha tiyo dtatement lai execute garcha//
    $c_La_Sss->execute();

    //Upon successful deletion of the category, direct the user to the 'adminCategories.php' page.
    echo '<script>window.location.href="adminCategories.php" </script>';

    // Yesle Script lai run huna didaina
    die();
} else {
    //Yesle error message dekhaucha jun bela user logged in hudaina.
    echo "not available to you";
}
?>
