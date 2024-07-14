<?php
// The basic HTML, CSS, and PHP logic needed for the header area of the website is included in this header file.
include 'header.php';
//esle  'account' session set vako ki chaina vanera check garcha//
if(isset($_SESSION['account'])){
     // edi set vacha vane, esle database bata sabai categories haru fetch garcha// 
    $c_La_Sss = $T_ie->query('SELECT * FROM category'); ?>
<!-- esle euta form display garcha jasma new auction add garna milcha -->
<form action="" method="post">
    <label for="name">Title:</label>
    <input type="text" name="title"/>
    <label for="description">Description:</label>
    <input type="text" name="description" id="description" />
    <label for="category">Category:</label>
     <!-- esle dropdown menu with categories display garcha -->
    <select name="category">
        <?php foreach ($c_La_Sss as $c_La_Ss) { ?>
              <!-- esle euta euta category option jasari display garcha dropdown menu ma -->
            <option value="<?php echo $c_La_Ss['category_id'] ?>"><?php echo $c_La_Ss['name'] ?></option>
        <?php } ?>
    </select>
    <label for="end">End Date:</label>
    <input type="date" name="end_date" id="end" />
        <!--  esle submit button pathaucha auction add garna lai -->
    <input type="submit" name="submit" value="Add Auction" />  
</form>
<?php
}

?>
<?php
// form submit vacha ki nai vanera check garcha//
if (isset($_POST['submit'])) {
     // form ma vako input data haru retrieve garcha//
    $En_Tit_leme_NT = $_POST['title'];
    $d_Eta_il = $_POST['description'];
    $c_La_Ss = $_POST['category'];
    $De_Ad_Lin_e = $_POST['end_date'];
    $Ac_cO_unT = $_SESSION['id'];
     //  esle auction table ma data insert garna ko lagi SQL statement prepare garcha//
$V_en_d_DUes= $T_ie->prepare("INSERT INTO auction (title, description, category, end_date,user_id) VALUES (:title, :description, :category, :end, :user_id)");
  //esle associative array value sanga insert garnu ko lagi define garcha//
$Fa_Cto_R = [ 'title' => $En_Tit_leme_NT, 'description' => $d_Eta_il, 'category' => $c_La_Ss,  'end' => $De_Ad_Lin_e, 'user_id' => $Ac_cO_unT]; 
    try {
        //  esle prepared statement sangai provide gareko data lai execute garcha//
        $V_en_d_DUes->execute($Fa_Cto_R);
        //After the auction has been successfully added, redirect the user to the'myAuction.php' page.//
        echo '<script>window.location.href="myAuction.php" </script>';
         // esle script execution bata exit garne //
        exit;
    } catch (PDOException $e) {
        //esle code ma ako errror handle garcha (esle user friendly message pathaucha)
        echo "Error: " . $e->getMessage();
    }
}