<?php
/* 
  $Id: featured_sbox_products.php v1.12 03/10/2004 dd/mm/yyyy 10:00:00 surfalot.com Exp $
  
  Open Featured Sets products listing module

Made for:
  osCommerce, Open Source E-Commerce Solutions 
  http://www.oscommerce.com 
  Copyright (c) 2004 osCommerce 
  Released under the GNU General Public License 
  
*/

if (sizeof($featured_products_array) <> '0') { 
  
  $num_columns = (sizeof($featured_products_array)>(int)FEATURED_PRODUCTS_COLUMNS?FEATURED_PRODUCTS_COLUMNS:sizeof($featured_products_array));
  
  if (isset($featured_product_category_id) && tep_not_null($featured_product_category_id)) {
    $the_categories_name_query= tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id= '" . $featured_product_category_id . "' and language_id= '" . $languages_id . "'");

    $the_categories_name = tep_db_fetch_array($the_categories_name_query);
    $featured_product_category_name = $the_categories_name['categories_name'];
  }
  if ((FEATURED_SET_STYLE == '1') || (FEATURED_SET_STYLE == '3')) { 
   // echo '&nbsp;<br /><div align="left" class="pageHeading">'.(!empty($featured_product_category_name)?$featured_product_category_name.' ':'').OPEN_FEATURED_BOX_HEADING.'</div>&nbsp;<br />'."\n";
  }	
  
 
  echo '<div class="boxround bxpb box2 ui-corner-all ui-widget-content" id="prods_featured">
<table>';   
echo '<tr><td><div class="container"><h2 style="font-size:1.6em;margin:0  0 0 5px;color: #e47911;">'. BOX_HEADING_FEATURED2.'</h2>
<ul class="column">';
    
    
    
  for($i=0,$col=1; $i<sizeof($featured_products_array); $i++,$col++) { 
  
    if (($featured_products_array[$i]['specials_price']) && ($featured_products_array[$i]['specials_status'] == '1')) { 
      $products_price = '<s>' .  $currencies->display_price($featured_products_array[$i]['currency'], $featured_products_array[$i]['price'], tep_get_tax_rate($featured_products_array[$i]['tax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price($featured_products_array[$i]['currency'], $featured_products_array[$i]['specials_price'], tep_get_tax_rate($featured_products_array[$i]['tax_class_id'])) . '</span>'; 
    } else { 
      $products_price = $currencies->display_price($featured_products_array[$i]['currency'], $featured_products_array[$i]['price'], tep_get_tax_rate($featured_products_array[$i]['tax_class_id'])); 
    } 
	
    if ($featured_products_array[$i]['shortdescription'] != '') { 
      $current_description = $featured_products_array[$i]['shortdescription']; 
    } else { 
	  if (OPEN_FEATURED_LIMIT_DESCRIPTION_BY=='words') {
        $bah = explode(" ", $featured_products_array[$i]['description']); 
		$current_description = '';
        for($desc=0 ; $desc<MAX_FEATURED_WORD_DESCRIPTION ; $desc++) 
        { 
          $current_description .= $bah[$desc]." "; 
        }  
	  } else {
        $current_description = substr($featured_products_array[$i]['description'],0,MAX_FEATURED_WORD_DESCRIPTION)." "; 
	  }
    } 
		
  


 if (($featured_products_array[$i]['specials_price']) && ($featured_products_array[$i]['specials_status'] == '1')) { 
      $products_price = '<s>' .  $currencies->display_price($featured_products_array[$i]['currency'], $featured_products_array[$i]['price'], tep_get_tax_rate($featured_products_array[$i]['tax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price($featured_products_array[$i]['currency'], $featured_products_array[$i]['specials_price'], tep_get_tax_rate($featured_products_array[$i]['tax_class_id'])) . '</span>'; 
    } else { 
      $products_price = $currencies->display_price($featured_products_array[$i]['currency'], $featured_products_array[$i]['price'], tep_get_tax_rate($featured_products_array[$i]['tax_class_id'])); 
    }


echo '<li> 
            <div  style="background-color:#f7f7f7;" class="block">
              <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>
                <a style="font-size:12px;" href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">'.$featured_products_array[$i]['name'].'</a> 
                <p>'.$products_price.'</p> 
            </div>
        </li>';

	
  } // end: for()

 
 echo '</ul></div></td></tr><tr><td style="padding:10px;"></td></tr>';
 echo '</table></div>';
} // end: if()
?>