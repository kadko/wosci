<?php
#July 11, 2005
#Version 1.0
#By Dan Sullivan
/*===============================================================================*/
	define('MAX_REVIEWS', 20); # Number of maximum reviews on front page
	define('NO_REVIEWS_TEXT', 'Yorum bulunamadı, Bu ürüne ilk yorumu yazmak için <a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params()) . '">tıklayınız</a>'); #Text
	define('BOX_REVIEWS_HEADER_TEXT', 'Ürün Yorumları'); #Text
/*================================================================================*/

$reviews_query = tep_db_query("select r.reviews_id, r.customers_name, r.date_added, rd.reviews_text, r.reviews_rating FROM reviews r, reviews_description rd WHERE r.reviews_id = rd.reviews_id AND r.products_id = '" . (int)$HTTP_GET_VARS['products_id'] . "' AND rd.languages_id = '" . (int)$languages_id . "' ORDER BY r.date_added DESC LIMIT " . MAX_REVIEWS);
//$info_box_header = array();
//$info_box_header[] = array('text' => BOX_REVIEWS_HEADER_TEXT);
//new contentBoxHeading($info_box_header);

//$info_box_contents = array();
$info_box_contents ='';
while ($reviews = tep_db_fetch_array($reviews_query)) {
  $info_box_contents .= '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . (int)$HTTP_GET_VARS['products_id'] . '&reviews_id=' . $reviews['reviews_id']) . '"><b>' . $reviews['customers_name'] . '</b>&nbsp;-&nbsp;' . tep_date_short($reviews['date_added']) . '&nbsp;' . tep_image(DIR_WS_IMAGES . 'stars_' . $reviews['reviews_rating'] . '.gif' , sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $reviews['reviews_rating'])) . '</a><br> ' . $reviews['reviews_text'].'<div style="padding:8px;"></div>';
}
 if(mysql_num_rows($reviews_query) > 0) {
$info_box_contents .= '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, 'products_id=' . (int)$HTTP_GET_VARS['products_id']) . '">Tüm yorumları okumak için tıklayınız</a><div style="padding:8px;"></div>';
} else {
  $info_box_contents = NO_REVIEWS_TEXT;
}
echo $info_box_contents;
?>