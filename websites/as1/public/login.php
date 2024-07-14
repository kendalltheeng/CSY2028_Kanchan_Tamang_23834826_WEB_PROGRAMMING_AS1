<?php 
// Add the header.php file, which include the HTML, CSS, and PHP logic needed to create the header//
require 'header.php';
?>
<!-- Form for signing in -->
<form action="login.php" method="post">
    <!--  input field for email -->
    <label for="email">Email:</label>
    <input type="text" name="email" id="email" />
    <!--  input field  for password-->
    <label for="password">Password:</label>
    <input type="password" name="password" id="password" />
    <!--this is the  Radio buttons for selecting role in the page -->
    <input type="radio" name="role" value="admin" /> <label>Admin</label>
    <input type="radio" name="role" value="user" /> <label>User </label>
    <!--  this is the Submit button for the login form -->
    <input type="submit" name="submit" value="Login" />
    <!-- yo Link to register page of the page -->
    <label></label> Don't have an account? <a href="register.php">Register</a> </label>
</form>

<?php
// esle log in form submit vayo ki nai check garcha//
if (isset($_POST['submit'])) {
    // Get the position, email address, and password from the form//
    $cL_IE_nt_nāma = $_POST['email'];
    $p_I_n = $_POST['password'];
    $pOs_Itio_N = $_POST['role'];
    //esle password lai hash garcha//
    $hashedPassword = password_hash($p_I_n, PASSWORD_DEFAULT);

    // query to choose user according to role and email//
    $cL_IE_nt = "SELECT * FROM users WHERE email = :email AND role = :role";
    $A_ss_Et = $T_ie->prepare($cL_IE_nt);
    $A_ss_Et->bindParam(':email', $cL_IE_nt_nāma);
    $A_ss_Et->bindParam(':role', $pOs_Itio_N);
    $A_ss_Et->execute();

    // Retrieve the user's information//
    $o_Ut_Com_E = $A_ss_Et->fetch(PDO::FETCH_ASSOC);

    // esle check and verify the password//
    if ($o_Ut_Com_E && password_verify($p_I_n, $o_Ut_Com_E['password'])) {
        // Configure the user's session variables//
        $_SESSION['account'] = $o_Ut_Com_E['name'];
        $_SESSION['id'] = $o_Ut_Com_E['user_id'];
        $_SESSION['role'] = $o_Ut_Com_E['role'];

        // Go back to the main page//
        echo '<script>window.location.href="index.php" </script>';
        exit;
    } else {
        // Display an error message if your password or username are incorrect//
        echo "Invalid username or password";
    }
}
?>

<?php
//Add the footer.php file, which is going to contain any PHP logic, HTML, and CSS needed for the footer//
require 'footer.php';
?>
