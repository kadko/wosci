<?php
$TITLE = '';
$NAME = '';
$URL = '';

if (basename($_SERVER['PHP_SELF']) === FILENAME_PRODUCT_INFO)
{
  $NAME = htmlspecialchars($product_info['products_name'], ENT_QUOTES);
  $TITLE = urlencode($product_info['products_name']);
  $URL = urlencode(StripSID(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product_info['products_id'], 'NONSSL', false )));
}
else if (! tep_not_null($TITLE) && isset($_GET['cPath']))
{
  $parts = explode("_", $_GET['cPath']);
  $category_id = $parts[count($parts) - 1];
  $category_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$languages_id . "'");
  $category = tep_db_fetch_array($category_query);
  $NAME = htmlspecialchars($category['categories_name'], ENT_QUOTES);
  $TITLE = urlencode($category['categories_name']);
  $URL = urlencode(StripSID(tep_href_link(FILENAME_DEFAULT, 'cPath=' . $category_id , 'NONSSL', false )));
}
else 
  $URL = urlencode("http://" . StripSID(tep_href_link(basename($_SERVER['PHP_SELF']))));
  
?>
<tr>
 <td align="right"><table border="0" width="20%">
  <tr>
  <td><a rel="nofollow" target="_blank" href="http://del.icio.us/post?url=<?php echo $URL . '&title=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/delicious.png', 'Add ' . $NAME . ' to del.icio.us'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://digg.com/submit?phase=2&url=<?php echo $URL . '&title=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/digg.png', 'Add ' . $NAME . ' to Digg'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://ekstreme.com/socializer/?url=<?php echo $URL . '&title=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/Socializer16.png', 'Add ' . $NAME . ' to Ekstreme'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://www.facebook.com/share.php?u=<?php echo $URL . '&title=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/facebook.png', 'Add ' . $NAME . ' to Facebook'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://furl.net/storeIt.jsp?t=<?php echo $URL . '&title=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/furl.png', 'Add ' . $NAME . ' to Furl'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://www.google.com/bookmarks/mark?op=edit&bkmk=<?php echo $URL . '&title=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/google.png', 'Add ' . $NAME . ' to Google'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://www.newsvine.com/_tools/seed&save?u==<?php echo $URL . '&h=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/newsvine.png', 'Add ' . $NAME . ' to Newsvine'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://reddit.com/submit?url=<?php echo $URL . '&title=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/reddit.png', 'Add ' . $NAME . ' to Reddit'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://technorati.com/cosmos/search.html?url=<?php echo $URL . '&title=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/technorati.png', 'Add ' . $NAME . ' to Technorati'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://twitter.com/home?status=Check out <?php echo $URL . '&title=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/twitter.png', 'Add ' . $NAME . ' to Twitter'); ?></a></td>

  <td><a rel="nofollow" target="_blank" href="http://myweb.yahoo.com/myresults/bookmarklet?u=<?php echo $URL . '&t=' . $TITLE; ?>">
  <?php echo tep_image(DIR_WS_IMAGES . '/socialbookmark/yahoo.png', 'Add ' . $NAME . ' to Yahoo myWeb'); ?></a></td>

  </tr>
 </table></td>
</tr>