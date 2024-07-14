<?php
// The basic HTML, CSS, and PHP logic required for the header area of the website is included in this header file. It guarantees that all required elements are loaded for appropriate style and page structure.
include 'header.php';
//// This confirms that the authorized user has an admin role and sees if the 'account' session is set.
if(isset($_SESSION['account']) && $_SESSION['role'] == 'admin') { ?>
<!-- The form for adding a new admin appears if the requirement mentioned above is met. -->
<form action="addAdmin.php" method="post">
 <!-- These are the fields where the new administrator's username, email address, and password are to be entered. -->
    <label for="username">Username:</label>
    <input type="text" id="username" name="name" required>
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
<!-- To stop the user from changing the role, we'll set it to 'admin' and make it hidden. -->
    <input type="hidden" name="role" value="admin">
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <!-- The submit button for adding a new admin is located here. -->
    <input type="submit" name="submit" value="Add Admin">
</form>
<?php
} else {
    // A message stating that they lack authorization to visit this page is shown if they don't meet the requirement.//
    echo "this page is unavailable to you";
}
//after confirming that the form was submitted, the admin is added to the database.//
if (isset($_POST['submit'])) {
   // By doing this, the values entered into the form are retrieved.//
      $ha_nd_Le = $_POST['name']; //yesle admin ko username store garcha//
    $e_Ma_il= $_POST['email']; //yesle admin ko email store garcha//
    $p_I_n = $_POST['password']; //yesle admin ko password save garcha//
    $pOs_Itio_N = $_POST['role']; //yesle admin ko role store garcha//
    $p_I_n = password_hash($p_I_n, PASSWORD_DEFAULT); //yesle password lai hash garcha//
    $cL_IE_nt = $T_ie->prepare('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)'); //this prepares the query to insert the admin into the database
    //yesle parameter ma use hune query lai define garcha//
    $Fa_Cto_R = [
        'name' => $ha_nd_Le,
        'email' => $e_Ma_il,
        'password' => $p_I_n,
        'role' => $pOs_Itio_N
    ];
    //this uses the supplied data to execute the prepared statement.
    $cL_IE_nt->execute($Fa_Cto_R);
    //jaba admin successfully create huncha , tespachi esle manche lai redirect garcha manageAdmins page ma//
    echo '<script>window.location.href="manageAdmins.php" </script>';
    //esle execution of the script lai rokcha//
    die();
}
// The HTML, CSS, and PHP logic needed for the website's footer section is included in this footer file.//
include 'footer.php';
?>