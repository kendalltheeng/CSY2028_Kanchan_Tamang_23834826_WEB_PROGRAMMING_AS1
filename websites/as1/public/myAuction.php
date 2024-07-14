<?php
// Add the header.php file, which include the HTML, CSS, and PHP logic needed to create the header//
include 'header.php';

// esle user log in chaki nai check garcha//
if(isset($_SESSION['id'])) { 
    // Obtain the auctions connected to the active user//
    $V_en_d_DUes = $T_ie->query('SELECT * FROM auction WHERE user_id = ' . $_SESSION['id']);
    // Show the user's auctions heading//
    echo '<h1>My Auctions</h1>';
    // Show the link for adding a new auction//
    echo '<a href="addAuction.php">Add Auction</a>';
    // Go over each auction one by one, displaying its details along with edit and remove buttons//
    foreach ($V_en_d_DUes as $V_en_d_DUe) {
?>
    <!-- Show auction details in a list that is not sorted -->
    <ul>
        <li><?php echo $V_en_d_DUe['title'] ?></li>
        <!-- edit auction  garne link -->
        <a href="editAuction.php?id=<?php echo $V_en_d_DUe['auction_id'] ?>">Edit Auction</a>
        <!-- delete auction garne link -->
        <a href="deleteAuction.php?id=<?php echo $V_en_d_DUe['auction_id'] ?>">Delete Auction</a> 
    </ul>
<?php
    } 
} else {
    //Show a message informing the user that they are unable to access the material if they are not logged in.
    echo "Not available to you";
}
//  Add the footer.php file, which is going to contain any PHP logic, HTML, and CSS needed for the footer//
include 'footer.php';
?>
