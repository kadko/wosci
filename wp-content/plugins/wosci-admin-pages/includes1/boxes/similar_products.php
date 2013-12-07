<?php
/*
  $Id: similar_products.php,v 1.0 2004/06/06 jck Exp $
    Based on whats_new.php,v 1.31 by hpdl

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
*/

$spt_prd_ids = $cart->get_product_id_list();
//print_r(explode(',', $spt_prd_ids));
$spt_prd_idsARRAY = explode(',', $spt_prd_ids);
$kac_urun = count($spt_prd_idsARRAY);

$i = 0;
while ($i < $kac_urun) {

$category_query = tep_db_query("select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$spt_prd_idsARRAY[$i] . "'");



$kategorisi[] = tep_db_fetch_array($category_query);
//echo '<br>';
$kats[] = $kategorisi[$i]['categories_id'];
//echo '<br>';

$i++;
}
 
// echo '<br>';
//print_r($kategorisi);
// echo '<br>';
//echo 'kats:' . print_r(array_unique($kats));
$kat_ARRU = array_unique($kats);
$kats_adet = count($kat_ARRU);
// echo '<br>';
//echo 'katicerik:' . print_r($kat_ARRU);
// echo '<br>';
//echo 'adet:' . count($kat_ARRU);




$x = 0; /* for illustrative purposes only */

foreach ($kat_ARRU as $v) {
    $yeni_K_A[$x] = $kat_ARRU[$x];
  //  echo $v.'<br>';
    $kat_index_ARR[] = $v;
    
    $categoryname_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '".(int)$kat_index_ARR[$x]."' and language_id = '". (int)$languages_id ."'");

$kategorisi_adi[] = tep_db_fetch_array($categoryname_query);
$kat_ad[] = $kategorisi_adi[$x]['categories_name'];
//echo 'asd'.$kat_ad[$x];
$x++;
}
//echo 'iki:'.$kat_index_ARR[2];


// Set the sort order for the display
define(SIMILAR_PRODUCTS_ORDER, 'Products Viewed');
  switch(SIMILAR_PRODUCTS_ORDER){
    case 'Random': 
      $sort_order = 'RAND() ';
      break;
    case 'Products ID': 
      $sort_order = 'p.products_id ';
      break;
    case 'Model Number': 
      $sort_order = 'p.products_model ';
      break;
    case 'Price': 
      $sort_order = 'p.products_price ';
      break;
    case 'Date Added': 
      $sort_order = 'p.products_date_added ';
      break;
    case 'Last Modified': 
      $sort_order = 'p.products_last_modified ';
      break;
    case 'Products Ordered': 
      $sort_order = 'p.products_ordered ';
      break;
    case 'Products Name': 
      $sort_order = 'pd.products_name ';
      break;
    case 'Products Viewed': 
      $sort_order = 'pd.products_viewed ';
      break;
    default:
      $sort_order = 'RAND() ';
  } // switch
	
  switch(SIMILAR_PRODUCTS_SORT_ORDER){
    case 'Ascending': 
      $sort_order .= 'asc';
      break;
    case 'Descending': 
      $sort_order .= 'desc';
      break;
    default:
      $sort_order .= 'asc';
  } // switch
	
// Find the id # of the category that the current product is in
    $category_query = tep_db_query("select categories_id 
	                                from " . TABLE_PRODUCTS_TO_CATEGORIES . " 
									where products_id = '" . (int)$products_id2 . "'"
                                  );
    $category = tep_db_fetch_array($category_query);
    $category_id = $category['categories_id'];
$k = 0;
while ($k < $kats_adet) {

// Count prods in category; if less than 2 dont display (removes empty infobox from pages)
	$product_count_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p,  
                                    " . TABLE_PRODUCTS_DESCRIPTION . " pd,  
                                    " . TABLE_PRODUCTS_TO_CATEGORIES . " pc  
                                    where p.products_id = pc.products_id
                                      and p.products_id = pd.products_id
                                      and p.products_status = '1'
                                      and pc.categories_id = '" . (int)$kat_index_ARR[$k] . "'
                                      and pd.language_id = '". (int)$languages_id ."'"
                                    );
	$product_count = tep_db_fetch_array($product_count_query);

// if less than total similar prods displayed exist in current category, dont display (empty) infobox
	
		// Select the other products in the same category
   		$products_query = tep_db_query("select p.products_id, 
                                   p.products_image,
                                   p.products_price,
                                   p.products_currency,
                                   p.products_model,
                                   pd.products_name,
										   p.products_tax_class_id
                                    from " . TABLE_PRODUCTS . " p,  
                                         " . TABLE_PRODUCTS_DESCRIPTION . " pd,  
                                         " . TABLE_PRODUCTS_TO_CATEGORIES . " pc  
                                    where p.products_id = pc.products_id
                                      and p.products_id = pd.products_id
                                      and p.products_status = '1'
                                      and pc.categories_id = '" . (int)$kat_index_ARR[$k] . "'
                                      and pd.language_id = '" . (int)$languages_id . "'
                                    order by " . $sort_order . " 
                                    limit " . 12
                                  );
		 // Write the output containing each of the products
		$products_string = '';
		$row = 0;
		$col = 0; 
	        $count_products = 0;
	        $info_box_contents = '';

	    while ($products = tep_db_fetch_array($products_query)) {


if (!in_array($products['products_id'], $spt_prd_idsARRAY)) {

  
		$resimi = tep_image(DIR_WS_IMAGES . $products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); 
		   if($count_products == 0){$tr_b='<tr>';}
	        $info_box_contents .=  $tr_b.'<td><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id'].'&p=' . $products['products_id']) . '">'. $resimi . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id'].'&p=' . $products['products_id']) . '">'.$products['products_name'].'</a>';
	        
	        if (SIMILAR_PRODUCTS_SHOW_MODEL == 'true' && tep_not_null($products['products_model'])) {
	          $products_string .= $products['products_model'] . '<br>';
	        }
	      
	          
	        
	   

$info_box_contents .= '<br>'.$currencies->display_price($products['products_currency'], $products['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '<br></td>'.$tr_s;
		
		
	      
	       
	$count_products++;	
	$col ++;
    if ($col > 2) {
	$col = 0;
	$tr_b ='</tr><tr>';
	
	$row ++;
	}else{
	$tr_b ='';
	$tr_s ='';
	}
		}//if 
		}

  $table = '<table>'.$info_box_contents.'</table>';

	?>
	<!-- similar_products //-->
	          
	<?php
	  if ($info_box_contents !=''){
	  echo '<div class="boxround bxpb box2 ui-corner-all ui-widget-content">
       
    <div id="from_same_category"><h2 style="font-size:1.6em;padding:10px;">'.
sprintf(OTHER_PRDS_CATEGORY, $kat_ad[$k]) . '</h2>'.$table.'</div></div>';
	 
	  	  
	}
	
	
	$k++;//bizim listedeki kategoriler için döndürüyoruz 
	}// END PROD TOTAL (WITHIN CURRENT CATEGORY) CHECK
	 
?>
<!-- similar_products_eof //-->
