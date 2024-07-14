<?php
//Put the header file in//
include 'header.php';

// Verify if the search form has been sent in//
if(isset($_POST['submit'])) {
    // Get the search query back//
    $search = $_POST['search'];
    // Run a SQL query to retrieve auctions that correspond with the search term//
    $V_en_d_DUes = $T_ie->query('SELECT * FROM auction WHERE title LIKE "%' . $search . '%" OR description LIKE "%' . $search . '%" ORDER BY end_date LIMIT 10');    
    ?>
    <h1>Latest Car Listings / Search Results / Category listing</h1>
    <?php
    // To find auctions that match the search keyword, run a SQL query//
    $t_A_ll_Y = $V_en_d_DUes->rowCount();
    // Verify if any auctions are listed//
    if($t_A_ll_Y == 0){
        echo '<p>No auctions found</p>';
    } else {
        // Show the list of auctions that were found//
        echo '<ul class="carList">';
        foreach($V_en_d_DUes as $V_en_d_DUe){
            // Obtain the auction's category//
            $c_La_Ss = $T_ie->query("SELECT * FROM category WHERE category_id = " . $V_en_d_DUe['category']);
            $c_La_Ss = $c_La_Ss->fetch();
            //Obtain the highest bid amount for the auction//
            $tE_nde_r = $T_ie->query("SELECT max(bid) as max FROM bid WHERE auction_id = " . $V_en_d_DUe['auction_id']);
            $tE_nde_r = $tE_nde_r->fetch();
            // esle auction details lai display garcha//
            echo '<li>
                    <img src="car.png" alt="car name">
                    <article>
                        <h2>' . $V_en_d_DUe['title'] .'</h2>
                        <h3>'.$c_La_Ss['name'] .'</h3>
                        <p>'.$V_en_d_DUe['description'].'</p>';
            // Show the current bid//
            if($tE_nde_r['max'] == null){
                echo '<p class="price">Current bid: £0</p>';
            } else {
                echo '<p class="price">Current bid: £' .$tE_nde_r['max'] .'</p>';
            }
            // Show the link to the auction//
            echo '<a href="auction.php?id=' .$V_en_d_DUe['auction_id'] .'" class="more auctionLink">More &gt;&gt;</a>
                    </article>
                </li>';
        }
        echo '</ul><hr />';
    }
}
// Put the footer file in there//
include 'footer.php';
?>
