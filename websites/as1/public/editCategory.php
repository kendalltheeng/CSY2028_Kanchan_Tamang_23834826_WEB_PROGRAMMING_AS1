<?php
// The website's header, which includes the required HTML, CSS, and PHP logic, is included in this header file.//
include 'header.php';
// /Esle user login vayo ki nai ani admin role pacha ki nai vanera check garcha//
if(isset($_SESSION['account']) && $_SESSION['role'] == 'admin') {
    //Esle GET parameters bata category ID retrieve garcha//
    $I_Dent_yent_y = $_GET['id'];
    // esle form submit vacha ki nai check garcha//
    if(isset($_POST['submit'])){
        //  esle form bata input data haru retrieve garcha//
        $ha_nd_Le = $_POST['name'];

        // To edit the category name in the 'category' table, prepare a SQL query.//
        $c_La_Sss = $T_ie->prepare("UPDATE category SET name = :name WHERE category_id = $I_Dent_yent_y");
        
        // Define the new category name in an associative array.//
        $Fa_Cto_R = ['name' => $ha_nd_Le];
        
        //Use the supplied data name to execute the prepared statement.//
        $c_La_Sss->execute($Fa_Cto_R);
        
        // Once the category has been successfully edited, send the user back to the 'adminCategories.php' page.//
        echo '<script>window.location.href="adminCategories.php" </script>';
        // stop the script from running//
        die();
    }
    
    // Using the category ID, retrieve the category information.
    $c_La_Ss = $T_ie->query("SELECT * FROM category WHERE category_id = $I_Dent_yent_y");
    $c_La_Ss = $c_La_Ss->fetch();
?>
    <!--Get the category details by using the category ID-->
    <form action="" method="post">
        <label for="name">Category Name:</label>
        <!-- Enter text to change the category name -->
        <input type="text" name="name" id="name" value="<?php echo $c_La_Ss['name']; ?>" />
        <input type="submit" name="submit" value="Edit Category" />
    </form>
<?php
} else {
    // Display an error message if the user is not logged in as the administrator//
    echo "not available to you";   
}
?>
