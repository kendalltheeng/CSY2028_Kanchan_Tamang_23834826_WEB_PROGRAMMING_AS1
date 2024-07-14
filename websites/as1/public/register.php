<?php
// Add the header.php file, which include the HTML, CSS, and PHP logic needed to create the header//
include 'header.php';
?>
<!-- Registration garne form -->
<form action="register.php" method="post">
    <!-- Input field for username for the page -->
    <label for="username">Username:</label>
    <input type="text" id="username" name="name" required>
    <!-- Input field for email of the page -->
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>
    <!-- Hidden input field for role of the  page -->
    <input type="hidden" name="role" value="user">
    <!-- Input field for password of the page -->
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required>
    <!-- Submit button to register of the page -->
    <input type="submit" name="submit" value="Register">
    <!-- Link to login page pf the page -->
    <label> Have an Account?<a href="login.php"> Login</a> </label>
</form>
<?php
// Verify that the registration form has been turned in//
if (isset($_POST['submit'])) {
    //Obtain form data//
    $ha_nd_Le = $_POST['name']; // User ko nam 
    $email = $_POST['email']; // Email of the user
    $p_I_n = $_POST['password']; // Password of the user
    $pOs_Itio_N = $_POST['role']; // Role of the user
    // esle password lai hash garcha//
    $p_I_n = password_hash($p_I_n, PASSWORD_DEFAULT);
    // Prepare and execute SQL query to insert user data into the database//
    $cL_IE_nts = $T_ie->prepare('INSERT INTO users (name, email, password, role) VALUES (:name, :email, :password, :role)');
    $Fa_Cto_R = [
        'name' => $ha_nd_Le,
        'email' => $email,
        'password' => $p_I_n,
        'role' => $pOs_Itio_N
    ];
    $cL_IE_nts->execute($Fa_Cto_R);
    var_dump($cL_IE_nts);
    // Go to the login page once your registration has been approved//
    echo '<script>window.location.href="login.php" </script>';
}
// Add the footer.php file, which is going to contain any PHP logic, HTML, and CSS needed for the footer//
include 'footer.php';
?>
