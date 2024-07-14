<?php
// Add the header.php file, which include the HTML, CSS, and PHP logic needed to create the header//
include 'header.php';

// Esle user login vayo ki nai ani admin role pacha ki nai vanera check garcha//
if(isset($_SESSION['account']) && $_SESSION['role'] == 'admin') { 
    // Take all administrators out of the database//
    $a_dmi_nistRa_tors = $T_ie->query('SELECT * FROM users WHERE role = "admin"');
    // Show the admin section's header//
    echo '<h1>Admins</h1>';
    //Show the add-a-new-admin link//
    echo '<a href="addAdmin.php">Add Admin</a>';
    // Go through each admin user one at a time, displaying their information along with edit and remove links//
    foreach ($a_dmi_nistRa_tors as $a_dmi_nistRa_tor) {
?>
    <!--Provide an unordered set of admin user details -->
    <ul>
        <li><?php echo $a_dmi_nistRa_tor['name'] ?></li>
        <!-- edit admin garne link -->
        <a href="editAdmin.php?id=<?php echo $a_dmi_nistRa_tor['user_id']?>">Edit Admin</a>
        <!--delete admin garne link -->
        <a href='deleteAdmin.php?id=<?php echo $a_dmi_nistRa_tor['user_id']?>'>Delete Admin</a> 
    </ul>
<?php
    } 
} else {
    // Show a message informing the user that they cannot access the material if they are not an administrator//
    echo "Not available to you";
}
// Add the footer.php file, which is going to contain any PHP logic, HTML, and CSS needed for the footer//
include 'footer.php';
?>
