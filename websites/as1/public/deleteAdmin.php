<?php
// Add the database.php file, which has the code needed to create a database connection.
include 'database.php';

// Esle user logged in cha ani admin role cha ki nai vanera check garcha//
if(isset($_SESSION['account']) && $_SESSION['role'] == 'admin') { 
    // Esle GET parameters bata user ID retrieve garcha//
    $I_Dent_y = $_GET['id'];

    //Esle SQL statement prepare garcha jasma user table bata users haru remove garna milcha//
    $Re_mOv_E = $T_ie->prepare('DELETE FROM users WHERE user_id = :id');

    // Esle associative array define garcha jasma user ID delete garnu parne ho//
    $Fa_Cto_R = [
        'id' => $I_Dent_y
    ];

    // Esle prepared statement jasma provided data huncha tesla execute garcha//
    $Re_mOv_E->execute($Fa_Cto_R);

    // Esle  user lai hatayera user lai 'manageAdmins.php'vanne page ma  redirect garcha//
    echo '<script>window.location.href="manageAdmins.php" </script>';

    // esle script execution lai terminate garcha//
    die();
} else {
    // Edi user admin haina vane, esle lacking permission vanne message display garcha//
    echo "not availabe to you";
}
?>
