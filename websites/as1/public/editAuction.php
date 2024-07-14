<?php
// The website's header, which includes the required HTML, CSS, and PHP logic, is included in this header file.//
include 'header.php';

//Esle user logged in vacha ki nai vanera check garcha//
if (isset($_SESSION['id'])) {
    // Esle GET parameters bata auction ID retrieve garcha//
    $I_Dent_yent_y = $_GET['id'];

    // Esle auction ID ko anusar auctions ko details fetch garcha// 
    $V_en_d_DUes = $T_ie->query("SELECT * FROM auction WHERE auction_id = $I_Dent_yent_y");
    $V_en_d_DUe = $V_en_d_DUes->fetch();

    //esle form submit vacha ki nai check garcha//
    if (isset($_POST['submit'])) {
        // esle form bata input data haru retrieve garcha//
        $En_Tit_leme_NT = $_POST['title'];
        $d_Eta_il = $_POST['description'];
        $c_La_Ss = $_POST['category'];
        $De_Ad_Lin_e = $_POST['end_date'];
        $Ac_cO_unT = $_SESSION['id'];

        //To change the auction details in the 'auction' table, prepare a SQL statement.//
        $V_en_d_DUes = $T_ie->prepare('UPDATE auction SET title = :title, description = :description, category = :category, end_date = :end WHERE auction_id = :id');
        
        // Create an associative array and populate it with the changed data.//
        $Fa_Cto_R = ['title' => $En_Tit_leme_NT, 'description' => $d_Eta_il, 'category' => $c_La_Ss, 'end' => $De_Ad_Lin_e, 'id' => $I_Dent_yent_y];

        try {
            //Esle provided data sanga statement display garcha//
            $V_en_d_DUes->execute($Fa_Cto_R);
            
            // After the auction has been successfully edited, send the user back to the'myAuction.php' page.//
            echo '<script>window.location.href="myAuction.php" </script>';
            // stop the script from running//
            exit;
        } catch (PDOException $e) {
            // esle error lai handle garcha//
            echo "Error: " . $e->getMessage();
        }
    }
    // esle sabai categories haru lai fetch garcha//
    $c_La_Sses = $T_ie->query('SELECT * FROM category');
    
    // action edit garna ko lagi it displays a heading//
    echo '<h1>Edit Auction</h1>';
    //esle form display garcha auction details edit garna ko lagi//
    echo '<form method="post">';
    echo '<label for="title">Title</label><input type="text" name="title" value="' . $V_en_d_DUe['title'] . '" required><br>';
    echo '<label for="description">Description</label><input type="text" name="description" value="' . $V_en_d_DUe['description'] . '" required><br>';
    echo '<label for="category">Category</label><select name="category">';
    // Go through each category once and put it in the dropdown menu.//
    foreach ($c_La_Sses as $c_La_Ss) {
        echo '<option value="' . $c_La_Ss['category_id'] . '"';
        // Verify that the category is the one that is being chosen for the auction.
        if ($c_La_Ss['category_id'] == $V_en_d_DUe['category']) {
            echo ' selected';
        }
        echo '>' . $c_La_Ss['name'] . '</option>';
    }
    echo '</select><br>';
    echo '<label for="end_date">End Date</label><input type="date" name="end_date" value="' . $V_en_d_DUe['end_date'] . '" required><br>';
    echo '<input type="submit" name="submit" value="Edit Auction">';
    echo '</form>';
} else {
    // Esle error lai handle garcha(esle userfriendly messgae display garcha)//
    echo "not available to you";
}
// Add the footer.php file, which is going to contain any PHP logic, HTML, and CSS needed for the footer.//
include 'footer.php';
?>
