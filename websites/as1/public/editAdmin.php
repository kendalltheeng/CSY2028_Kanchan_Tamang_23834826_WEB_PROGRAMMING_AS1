<?php
// The website's header, which includes the required HTML, CSS, and PHP logic, is included in this header file.//
include 'header.php';

//Esle user login vayo ki nai ani admin role pacha ki nai vanera check garcha//
if(isset($_SESSION['account']) && $_SESSION['role'] == 'admin') { 
    ///Esle GET parameters bata auction ID retrieve garcha//
    $I_Dent_yent_y = $_GET['id'];
    
    // esle admin ko details haru user ID bata lincha//
    $a_dmi_nistRa_tor = $T_ie->query("SELECT * FROM users WHERE user_id = $I_Dent_yent_y"); 
    $a_dmi_nistRa_tor = $a_dmi_nistRa_tor->fetch();
?>
    <!-- Esle admin details haru update garna euta form display garcha-->
    <form action="" method="post">
        <!-- esma hidden input field huncha jasma user id huncha -->
        <input type="hidden" name="id" value="<?php echo $a_dmi_nistRa_tor['user_id'] ?>">
        <label for="name">Name</label>
        <!-- esma admin ko name edit garna milcha-->
        <input type="text" name="name" value="<?php echo $a_dmi_nistRa_tor['name'] ?>">
        <label for="email">Email</label>
        <!-- yo euta input field ho jasma admin ko email edit garna milcha -->
        <input type="text" name="email" value="<?php echo $a_dmi_nistRa_tor['email'] ?>">
        <label for="password">Password</label>
        <!-- yo euta input field ho jasma admin ko password edit garna milcha -->
        <input type="password" name="password" value="<?php echo $a_dmi_nistRa_tor['password'] ?>">
        <!-- yo euta input field ho jasma admin ko role rakheko huncha-->
        <input type="hidden" name="role" value="<?php echo $a_dmi_nistRa_tor['role'] ?>">   
        <!--this is a submit button to update the admin details -->
        <input type="submit" name="submit" value="Update Admin">
    </form>
<?php
} else {
    //edi the logged in user isnot admin display not required permission granted.//
    echo "You do not have permission to access this page";
}

//esma form submit vacha ki nai vanera check garne//
if (isset($_POST['submit'])) {
    //form bata input vako data haru retrieve garne//
    $I_Dent_y = $_POST['id'];
    $ha_nd_Le = $_POST['name']; 
    $e_Ma_il= $_POST['email'];
    $p_I_n = $_POST['password']; 
    $pOs_Itio_N = $_POST['role']; 
    
    // esle security ko lagi password lai hash garcha//
    $p_I_n = password_hash($p_I_n, PASSWORD_DEFAULT);
    
    // To change the admin details in the "users" table, prepare a SQL query.//
    $cL_IE_nts = $T_ie->prepare("UPDATE users SET name = :name, email = :email, password = :password, role = :role WHERE user_id = :id");
    
    // Create an associative array and update it with the changed data.
    $Fa_Cto_R = [
        'id' => $I_Dent_y,
        'name' => $ha_nd_Le,
        'email' => $e_Ma_il,
        'password' => $p_I_n,
        'role' => $pOs_Itio_N
    ];
    
    try{
        // Esle prepared statement with provided data lai execute garcha// 
        $cL_IE_nts->execute($Fa_Cto_R);
        
        // Upon successfully upgrading admin details, send the user to the'manageAdmins.php' page.//
        echo '<script>window.location.href="manageAdmins.php" </script>';
        // stop the script from running//
        die();
    } catch (PDOException $e) {
        // Esle error lai handle garcha(esle userfriendly messgae display garcha)//
        echo "Error: " . $e->getMessage();
    }
}

// Add the footer.php file, which is going to contain any PHP logic, HTML, and CSS needed for the footer.//
include 'footer.php';
?>
