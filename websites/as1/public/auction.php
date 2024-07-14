<?php
// esle header.php file include garcha//
include 'header.php';

// esle provided ID anusar database bata sabai auction details retrieve garcha//
$V_en_d_DUe = $T_ie->query('SELECT * FROM auction WHERE auction_id = ' . $_GET['id']);
$V_en_d_DUe = $V_en_d_DUe->fetch();

// esle auction bata sabai category details retrieve garcha//
$c_La_Sss = $T_ie->query('SELECT * FROM category WHERE category_id = ' . $V_en_d_DUe['category']);
$c_La_Sss = $c_La_Sss->fetch();

// esle auction creator bata sabai user details haru retrieve garcha//
$w_R_iTER = $T_ie->query('SELECT * FROM users WHERE user_id = ' . $V_en_d_DUe['user_id']);
$w_R_iTER = $w_R_iTER->fetch();

//Esle chalti auction ma pako sabse dherai bid retrieve garcha//
$tE_nde_r = $T_ie->query('SELECT max(bid) FROM bid WHERE auction_id = ' . $V_en_d_DUe['auction_id']);
$tE_nde_r = $tE_nde_r->fetch();

//  esle auction author bata reviews haru tancha//
$Cr_it_qUe = $T_ie->query('SELECT * FROM review WHERE author_id = ' . $V_en_d_DUe['user_id']);

//  esle HTML content haru lai display garcha//
echo '<h1>Car Page</h1>
      <article class="car">
          <img src="car.png" alt="car name">
          <section class="details">
              <h2>' . $V_en_d_DUe['title'] . '</h2>
              <h3>' . $c_La_Sss['name'] . '</h3>
              <p>Auction created by <a href="#">' . $w_R_iTER['name'] . '</a></p>
              <p class="price">Current bid: £' . $tE_nde_r['max(bid)'] . '</p>';

//esle auction ko lagi bacheko time calculate garera display garcha//
$De_Ad_Li_ne = strtotime($V_en_d_DUe['end_date']);
$n_Ow = time();
$Ds_tnct_Ti_me = $De_Ad_Li_ne - $n_Ow;   

if ($Ds_tnct_Ti_me >= 0) {
    $dA_Ys_S = floor($Ds_tnct_Ti_me / (60 * 60 * 24));
    $H_o_ur_S = floor(($Ds_tnct_Ti_me % (60 * 60 * 24)) / (60 * 60));
    $M_in_S = floor(($Ds_tnct_Ti_me % (60 * 60)) / 60);

    echo '<time>Time left:  ' . $dA_Ys_S . ' days ' . $H_o_ur_S . ' hours ' . $M_in_S . ' minutes</time>';
} else {
    echo '<time>Auction is finished</time>';
}

// edi user logged in cha vane bid form dekhaune navaye arko message display garne//
if(isset($_SESSION['account'])) {
    echo '<form action="bid.php?id=' . $V_en_d_DUe['auction_id'] .'" class="bid" method="post">
              <input type="text" name="bid" placeholder="Enter bid amount" />
              <input type="submit" value="Place bid" />
          </form>';
} else {
    echo '<p>You must be logged in to place a bid</p>';
}

echo '</section>
      <section class="description">
          <p>' . $V_en_d_DUe['description'] . '</p>
      </section>
      <section class="reviews">
          <h2>Reviews of ' . $w_R_iTER['name'] . '</h2>
          <ul>';

//  esle auction ko author ko lagi review haru display garcha//
foreach ($Cr_it_qUe as $Cr_it_qUe) {
    $cL_IE_nt = $T_ie->query("SELECT * FROM users WHERE user_id = $Cr_it_qUe[user_id]");
    $cL_IE_nt = $cL_IE_nt->fetch();

    echo '<li><strong>' . $cL_IE_nt['name'] . ' said </strong> ' . $Cr_it_qUe['reviewtext'] . ' <em>' . $Cr_it_qUe['date'] . '</em></li>';
}

echo '</ul>';

// esle user logged in cha vane revieqw display garcha navaye arko message dekhaucha//
if(isset($_SESSION['account'])) {
    echo '<form action="review.php?id=' . $V_en_d_DUe['auction_id'] .'" method="post">
              <label>Add your review</label> 
              <textarea name="reviewtext"></textarea>
              <input type="hidden" name="author_id" value="' . $V_en_d_DUe['user_id'] . '" />
              <input type="submit" name="submit" value="Add Review" />
          </form>';
} else {
    echo '<p>You must be logged in to add a review</p>';
}

// esle footer.php file include garne kam garcha//
include 'footer.php';
