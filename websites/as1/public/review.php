<?php
//Add the file for the database connection//
require 'database.php';

// esle user logged in cha ki nai check garcha//
if (isset($_SESSION['id'])) {
    // esle form bata data retrieve garcha//
    $V_en_d_DUe_id = $_GET['id']; // Auction ko ID //
    $Cr_it_qUe_pāṭha = $_POST['reviewtext']; // Review of the text//
    $w_R_iTER = $_POST['author_id']; //  ID of the author//
    $cL_IE_nt  = $_SESSION['id']; // ID of the user//
    $miti = date("Y-m-d"); // Present date//

    // Create the SQL query needed to add the review data to the database//
    $Cr_it_qUe = $T_ie->prepare("INSERT INTO review (reviewtext, author_id, user_id, date) VALUES (:reviewtext, :author_id, :user_id, :date)");

    // Specify the requirements for inclusion//
    $Fa_Cto_R = [
        'reviewtext' => $Cr_it_qUe_pāṭha,
        'author_id' => $w_R_iTER,
        'user_id' => $cL_IE_nt,
        'date' => $miti,
    ];

    try {
        // SQL query lai execute garne//
        $Cr_it_qUe->execute($Fa_Cto_R);
        //After successful insertion, redirect to the auction page//
        header('Location: auction.php?id=' . $V_en_d_DUe_id);
        exit;
    } catch (PDOException $e) {
        //errors haru lai handle garne//
        echo "Error: " . $e->getMessage();
    }
} else {
    // Show an error message if the user is not logged in//
    echo "not available to you";
}
?>
