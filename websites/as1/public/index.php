<?php 
// Add the header.php file, which include the HTML, CSS, and PHP logic needed to create the header.
include 'header.php';
?>
<!-- Display the page's header -->
<h1>Latest Car Listings / Search Results / Category listing</h1>
<?php
// The 'auction' table contains the most recent ten automobile postings, arranged by expiration date//
$V_en_d_DUes = $T_ie->query('SELECT * FROM auction ORDER BY end_date LIMIT 10');

//Find out how many rows were retrieved from the query//
$Ta_ll_Y = $V_en_d_DUes->rowCount();

// Verify if any auctions were discovered//
if($Ta_ll_Y == 0){
    // If there are no auctions, display a notice//
    echo '<p>No auctions found</p>';
} else {
    // Show every auction listing as a list//
    echo '<ul class="carList">';
    foreach($V_en_d_DUes as $V_en_d_DUe){
        //Obtain information about the current auction's category//
        $c_La_Sss = $T_ie->query("SELECT * FROM category WHERE category_id = " . $V_en_d_DUe['category']);
        $c_La_Sss = $c_La_Sss->fetch();
        //Obtain the highest bid amount for the ongoing auction//
        $tE_nde_r = $T_ie->query("SELECT MAX(bid) AS max FROM bid WHERE auction_id = " . $V_en_d_DUe['auction_id']);
        $tE_nde_r = $tE_nde_r->fetch();
        //Show the auction's information, such as the current bid, title, category, and description//
        echo '<li>
                <img src="car.png" alt="car name">
                <article>
                    <h2>' . $V_en_d_DUe['title'] .'</h2>
                    <h3>'.$c_La_Sss['name'] .'</h3>
                    <p>'.$V_en_d_DUe['description'].'</p>';
        // Verify if any bids have been placed for the auction//
        if($tE_nde_r['max'] == null){
            //If there are no bids, show the default message//
            echo '<p class="price">Current bid: £0</p>';
        } else {
            // If there is a maximum bid amount available, display it//
            echo '<p class="price">Current bid: £' .$tE_nde_r['max'] .'</p>';
        }
        //Show a link where users may access further auction details//
        echo '<a href="auction.php?id=' .$V_en_d_DUe['auction_id'] .'" class="more auctionLink">More &gt;&gt;</a>
                </article>
              </li>';
    }
    // Close the car classifieds list//
    echo '</ul><hr />';
}
?>
<?php
// Add the footer.php file, which is going to contain any PHP logic, HTML, and CSS needed for the footer//
include 'footer.php';
?>
