<?php 
/// The basic HTML, CSS, and PHP logic required for the header area of the website is included in this header file. It guarantees that all required elements are loaded for appropriate style and page structure.
include 'header.php';
?>
<?php
// Esle user ley login garera admin role pako cha ki chaina vanera check garcha// 
if(isset($_SESSION['account']) && $_SESSION['role'] == 'admin') { 
    // Edi user admin ho vane, sabai categories haru database bata esle fetch garcha// 
    $c_La_Sss = $T_ie->query('SELECT * FROM category');

    //  esle admin categories ko lagi heading disaplay garcha//
    echo '<h1>Admin Categories</h1>';

    //  esle naya category rakhna ko lagi link dekhaucha//
    echo "<a href='addCategory.php'>Add Category</a>";

    // esle database bata fetch vako euta euta category lai iteriate garcha//
    foreach ($c_La_Sss as $c_La_Ss) {
?>
        <!-- esle euta euta category lai list item vanera dekhaucha-->
        <ul>
            <li><?php echo $c_La_Ss['name'] ?></li>
            <!-- esle euta link dekhaucha jasma chai category along with its parameter chai edit garna milcha -->
            <a href="editCategory.php?id=<?php echo $c_La_Ss['category_id']?>">Edit Category</a>
            <!-- esle euta link display garcha jasma chai category eith its IDchai delete garna milcha  as a parameter-->
            <a href='deleteCategory.php?id=<?php echo $c_La_Ss['category_id']?>'>Delete Category</a> 
        </ul>
<?php
    } 
} else {
    //  edi user admin haina vane esle euta message display garcha jasma lack of permission vancha//
    echo "Not available to you";
}  
?>
