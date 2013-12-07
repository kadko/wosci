<?php
/*
  $Id: best_sellers.php,v 1.21 2003/06/09 22:07:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
global $languages_id,$current_category_id;
  if (isset($current_category_id) && ($current_category_id > 0)) {
    $best_sellers_query = tep_db_query("select distinct p.products_id, p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and '" . (int)$current_category_id . "' in (c.categories_id, c.parent_id) order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  } else {
    $best_sellers_query = tep_db_query("select distinct p.products_id, p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_ordered > 0 and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by p.products_ordered desc, pd.products_name limit " . MAX_DISPLAY_BESTSELLERS);
  }

  if (tep_db_num_rows($best_sellers_query) >= MIN_DISPLAY_BESTSELLERS) {
?>
<!-- best_sellers //-->
         

            
<?php
    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_BESTSELLERS);

//    new infoBoxHeading($info_box_contents, true, true);

    $rows = 0;
    $bestsellers_list = '<table border="0" width="100%" cellspacing="0" cellpadding="4">';
    while ($best_sellers = tep_db_fetch_array($best_sellers_query)) {
      $rows++;
      
      $urun_resmi[$rows]= $best_sellers['products_image'];
       $birinci= tep_image(DIR_WS_IMAGES . $urun_resmi[$rows], $best_sellers['products_name'], 75, 75);

   
    $x = '<tr><td><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id'].'&p=' . $best_sellers['products_id']) . '">'. $birinci .'</a></td><td>&nbsp;</td><td><span class="sira">'.tep_row_number_format($rows).'.&nbsp;</span><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $best_sellers['products_id'].'&p=' . $best_sellers['products_id']) . '">' . $best_sellers['products_name'] .'</a></td></tr>';
    
//    tep_image(DIR_WS_IMAGES .$urun_resmi[1], 100, 100).'<br>'; 
    
      
      $bestsellers_list .= $x;    
      
   } 
    $bestsellers_list .= '</table>';

//    $info_box_contents = array();
//    $info_box_contents[] = array('text' => $bestsellers_list);

//    new infoBox($info_box_contents);
?>
    
        
    
        
       <?php  echo $bestsellers_list; ?>
        
   

    
    
    
    
    
    
          
<!-- best_sellers_eof //-->
<?php
  }
?>