<?php
/// The basic HTML, CSS, and PHP logic required for the header area of the website is included in this header file. It guarantees that all required elements are loaded for appropriate style and page structure.
include 'header.php';

//Esle database bata auctions retrieve garcha jun specified category ID sanga huncha//
$V_en_d_DUes = $T_ie->query('SELECT * FROM auction where category = ' . $_GET['id']);

//  Esle database bata payeko auction haru thougrouly iteriate garcha//
foreach ($V_en_d_DUes as $V_en_d_DUe) {
    //esle chalti auction bata category ko details haru retrieve garcha//
    $c_La_Ss = $T_ie->query("SELECT * FROM category WHERE category_id = " . $V_en_d_DUe['category']);
    $c_La_Ss = $c_La_Ss->fetch(); // Fetch category details
    
    // esle chalti auction bata maximum bid retrieve garcha//
    $tE_nde_r = $T_ie->query("SELECT max(bid) as max FROM bid WHERE auction_id = " . $V_en_d_DUe['auction_id']);
    $tE_nde_r = $tE_nde_r->fetch(); // Fetch the maximum bid
    
    //  esle auction ko details lai display garcha//
    echo'<li>
        <img src="car.png" alt="car name">
        <article>
            <h2>' . $V_en_d_DUe['title'] .'</h2>
            <h3>'.$c_La_Ss['name'] .'</h3>
            <p>'.$V_en_d_DUe['description'].'</p>';
            // esle auction ma vako current bid paisa dekhaucha edi bid chaina vane £0 dekhaucha//
            if($tE_nde_r['max'] == null){
                echo '<p class="price">Current bid: £0</p>';
            } else {
                echo '<p class="price">Current bid: £' .$tE_nde_r['max'] .'</p>';
            }
            //Esle euta link display garcha jas bata dhearai details auction ko barema herna milcha//
            echo '
            <a href="auction.php?id=' .$V_en_d_DUe['auction_id'] .'" class="more auctionLink">More &gt;&gt;</a>
        </article>
    </li>';
}
// esle footer.php file include garne kam garcha//
include 'footer.php';
?>
