<?php
// The website's header, which includes the required HTML, CSS, and PHP logic, is included in this header file.//
require 'header.php';
// esle check garcha ki account session set vako cha ki nai ani authenticated role admin ho vanera//
if(isset($_SESSION['account']) && $_SESSION['role'] == 'admin') { 
    // edi user admin ho vane esle form to add naya category display garcha//
?>
<form action="addCategory.php" method="post">
    <label for="name">Category Name:</label>
    <input type="text" name="name" id="name" />
    <input type="submit" name="submit" value="Add Category" />
</form>
<?php
// esle form submit vayo ki nai vanera check garcha//
if (isset($_POST['submit'])) {
    // esle form bata category name retrive garcha//
    $ha_nd_Le = $_POST['name'];
     // esle SQL statement prepare garcha jasma category name category table ma insert garna milcha//
    $c_La_Sss = "INSERT INTO category (name) VALUES (:name)";
    // Esle SQL statement lai execute garcha//
    $as_Ser_T = $T_ie->prepare($c_La_Sss);
     // esle parameter lai bind garne kam garcha: nam lai category nam ma//
    $as_Ser_T->bindParam(':name', $ha_nd_Le);
    try {
        // esle prepare gareko statement lai execute garcha//
        $as_Ser_T->execute();
         // esle naya category add garesake pachi  users haru lai 'adminCategories.php' vanne page ma redirect garcha//
        echo '<script>window.location.href="adminCategories.php" </script>';
         //  esle script execution lai exit garcha//
        exit;
    } catch (PDOException $e) {
        //  esle ayeko errror lai handle garcha ani user friendly message display garchaa//
        echo "Error: " . $e->getMessage();
    }
} 

}
 else {
     // edi user admin haina vanr esle message display garcha jasma lack of permission vanne  message indicate hucnha//
    echo "Not available to you";
}
// // Incorporate the footer.php file, which has the PHP, CSS, and HTML code required for the footer area.//
require 'footer.php';
?>