<?php
// The basic HTML, CSS, and PHP logic required for the header area of the website is included in this header file. It guarantees that all required elements are loaded for appropriate style and page structure.
include 'database.php';

// Esle POST data bata bid amount retreive garcha//
$tE_nde_r = $_POST['bid'];

//Esle GET parameters bata auction ID retrieve garcha//
$V_en_d_DUe_i_d = $_GET['id'];

//  Esle session bata user ko ID retrieve garcha//
$aC_ouNt_i_D = $_SESSION['id'];

// Esle SQL statement prepare garcha jasma chai bid data bid vanne table ma insert garna milcha//
$tE_nde_rs = $T_ie->prepare('INSERT INTO bid (bid, auction_id, user_id) VALUES (:bid, :auction_id, :user_id)');

// esle associative array sangai tesko values haru deifne garne kam garcha//
$a_Ss_Et = [
    'bid' => $tE_nde_r,
    'auction_id' => $V_en_d_DUe_i_d,
    'user_id' => $aC_ouNt_i_D
];

// Esle prepared statement sangai provide vako daata ni execute garne kam garcha//
$tE_nde_rs->execute($a_Ss_Et);

// esle user haru lai auction page with uniahru ko specified ID ma direct garcha//
header('Location: auction.php?id=' . $V_en_d_DUe_i_d);
?>
