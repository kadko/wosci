<?php
/* 
  $Id: featured_categories.php,v 1.01 03/10/2004 dd/mm/yyyyy 21:00:00 surfalot.com Exp $

  Open Featured Sets categories listing module

Made for:
  osCommerce, Open Source E-Commerce Solutions 
  http://www.oscommerce.com 
  Copyright (c) 2004 osCommerce 
  Released under the GNU General Public License 
  
*/

if (sizeof($featured_categories_array) <> '0') { 
  
  $num_columns = (sizeof($featured_categories_array)>(int)FEATURED_CATEGORIES_COLUMNS?FEATURED_CATEGORIES_COLUMNS:sizeof($featured_categories_array));
  
  if ((FEATURED_CATEGORIES_SET_STYLE == '5') || (FEATURED_CATEGORIES_SET_STYLE == '6')) {
    $info_box_heading = array();
    $info_box_heading[] = array('text' => OPEN_FEATURED_BOX_CATEGORY_HEADING);

    new infoBoxHeading($info_box_heading,true,true);
  }
  
  if ((FEATURED_CATEGORIES_SET_STYLE == '1') || (FEATURED_CATEGORIES_SET_STYLE == '3')) { 
    echo '&nbsp;<br /><div align="left" class="pageHeading">'.OPEN_FEATURED_BOX_CATEGORY_HEADING.'</div>&nbsp;<br />'."\n";
  }	

  $info_box_contents = array();
  $info_box_contents[] = array('text' => '<table border="0" width="100%"'.($num_columns==1?' cellspacing="0" cellpadding="0"':' cellspacing="4" cellpadding="2"').'><tr>' );
  
  for($i=0,$col=1; $i<sizeof($featured_categories_array); $i++,$col++) { 
  
    $special_price = tep_get_products_special_price($featured_categories_array[$i]['pid']);
	if ($special_price) {
      $products_price = '<s>' .  $currencies->display_price($featured_categories_array[$i]['pcurrency'], $featured_categories_array[$i]['pprice'], tep_get_tax_rate($featured_categories_array[$i]['ptax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price($featured_categories_array[$i]['pcurrency'], $special_price, tep_get_tax_rate($featured_categories_array[$i]['ptax_class_id'])) . '</span>'; 
    } else { 
      $products_price = $currencies->display_price($featured_categories_array[$i]['pcurrency'], $featured_categories_array[$i]['pprice'], tep_get_tax_rate($featured_categories_array[$i]['ptax_class_id'])); 
    } 
	
    if ($featured_categories_array[$i]['pshortdescription'] != '') { 
      $current_description = $featured_categories_array[$i]['pshortdescription']; 
    } else { 
	  if (OPEN_FEATURED_LIMIT_DESCRIPTION_BY=='words') {
        $bah = explode(" ", $featured_categories_array[$i]['pdescription']); 
        $current_description = '';
        for($desc=0 ; $desc<MAX_FEATURED_CATEGORIES_WORD_DESCRIPTION ; $desc++) 
        { 
          $current_description .= $bah[$desc]." "; 
        }  
	  } else {
        $current_description = substr($featured_categories_array[$i]['pdescription'],0,MAX_FEATURED_CATEGORIES_WORD_DESCRIPTION)." "; 
	  }
    } 
	
    $info_box_contents[0]['text'] .= '<td valign="top" align="center" width="'.floor(100/$num_columns).'%">';


echo $featured_categories_array[$i]['cid'].'-';
    if (FEATURED_SET_SHOW_BUY_NOW_BUTTONS=='true') {
      //original buy now button
      $buy_now_link = '<br><a href="' . tep_href_link(FILENAME_DEFAULT, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a>';
      //sid killer buy now button: http://www.oscommerce.com/community/contributions,952
      //$buy_now_link = '<br><form name="buy_now" method="post" action="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now', 'NONSSL') . '"><input type="hidden" name="products_id" value="' . $featured_categories_array[$i]['pid'] . '">' . tep_image_submit('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</form>';
    } else {
      //disabled
      $buy_now_link = '';
    }



  if ((FEATURED_CATEGORIES_SET == '1') && (FEATURED_CATEGORIES_SET_STYLE == '1')) { 
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25);
    $info_box_contents[0]['text'] .= '" align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredCategories">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '1') && ((FEATURED_CATEGORIES_SET_STYLE == '2') || (FEATURED_CATEGORIES_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredCategories">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '1') && (FEATURED_CATEGORIES_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25);
    $info_box_contents[0]['text'] .= '" align="center" valign="top" class="featuredCategories" style="height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredCategories">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td>'.(((FEATURED_CATEGORIES_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)))?'<td align="center" width="'.CATEGORIES_LINE_THICKNESS.'" style="height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.CATEGORIES_LINE_COLOR.'; height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px; width: '.CATEGORIES_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', CATEGORIES_LINE_THICKNESS, CATEGORIES_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '1') && ((FEATURED_CATEGORIES_SET_STYLE == '4') || (FEATURED_CATEGORIES_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredCategories">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table>';
  }




  if ((FEATURED_CATEGORIES_SET == '2') && (FEATURED_CATEGORIES_SET_STYLE == '1')) { 
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div></td></tr><tr><td valign="top" class="featuredCategories">';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr><tr><td align="left" valign="top" class="featuredCategories">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '2') && ((FEATURED_CATEGORIES_SET_STYLE == '2') || (FEATURED_CATEGORIES_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td align="center" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div></td></tr><tr><td valign="top" class="featuredCategories">';
    $info_box_contents[0]['text'] .= $current_description; 
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr><tr><td align="left" valign="top" class="featuredCategories">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '2') && (FEATURED_CATEGORIES_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredCategories" style="height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div></td></tr><tr><td align="left" valign="top" class="featuredCategories">';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '10', '6') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td>'.(((FEATURED_CATEGORIES_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)))?'<td align="center" width="'.CATEGORIES_LINE_THICKNESS.'" style="height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.CATEGORIES_LINE_COLOR.'; height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px; width: '.CATEGORIES_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', CATEGORIES_LINE_THICKNESS, CATEGORIES_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '2') && ((FEATURED_CATEGORIES_SET_STYLE == '4') || (FEATURED_CATEGORIES_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td align="center" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div></td></tr><tr><td valign="top" class="featuredCategories">';
    $info_box_contents[0]['text'] .= $current_description; 
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr><tr><td align="left" valign="top" class="featuredCategories">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table>';
  }




  if ((FEATURED_CATEGORIES_SET == '3') && (FEATURED_CATEGORIES_SET_STYLE == '1')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25);
    $info_box_contents[0]['text'] .= '" align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '3') && ((FEATURED_CATEGORIES_SET_STYLE == '2') || (FEATURED_CATEGORIES_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '3') && (FEATURED_CATEGORIES_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25);
    $info_box_contents[0]['text'] .= '" align="center" valign="top" class="featuredCategories" style="height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td>'.(((FEATURED_CATEGORIES_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)))?'<td align="center" width="'.CATEGORIES_LINE_THICKNESS.'" style="height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.CATEGORIES_LINE_COLOR.'; height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px; width: '.CATEGORIES_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', CATEGORIES_LINE_THICKNESS, CATEGORIES_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '3') && ((FEATURED_CATEGORIES_SET_STYLE == '4') || (FEATURED_CATEGORIES_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td><td align="left" valign="top" class="featuredCategories"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr></table>';
  }




  if ((FEATURED_CATEGORIES_SET == '4') && (FEATURED_CATEGORIES_SET_STYLE == '1')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . 
	  tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '6') . '<br><div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>' .  OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '4') && ((FEATURED_CATEGORIES_SET_STYLE == '2') || (FEATURED_CATEGORIES_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '6') . 
      '<br><div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>' .  OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '4') && (FEATURED_CATEGORIES_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td style="height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px;"><table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '6') . '<br><div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . 
	  $featured_categories_array[$i]['pname'] . '</a></div>' .  OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table></td>'.(((FEATURED_CATEGORIES_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)))?'<td align="center" width="'.CATEGORIES_LINE_THICKNESS.'" style="height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.CATEGORIES_LINE_COLOR.'; height: '.CATEGORIES_VLINE_IMAGE_HEIGHT.'px; width: '.CATEGORIES_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', CATEGORIES_LINE_THICKNESS, CATEGORIES_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>';
  }



  if ((FEATURED_CATEGORIES_SET == '4') && ((FEATURED_CATEGORIES_SET_STYLE == '4') || (FEATURED_CATEGORIES_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.CATEGORIES_CELLPADDING.'"><tr><td align="center" valign="top" class="featuredCategories"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . $featured_categories_array[$i]['pimage'], $featured_categories_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '6') . 
      '<br><div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_categories_array[$i]['pid'], 'NONSSL') . '">' . $featured_categories_array[$i]['pname'] . '</a></div>' .  OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table>';
  }


    $info_box_contents[0]['text'] .= '</td>'."\n";

    if (($col/$num_columns) == floor($col/$num_columns)) { 
      if ((((FEATURED_CATEGORIES_SET == '1') && (FEATURED_CATEGORIES_SET_STYLE == '3')) or ((FEATURED_CATEGORIES_SET == '2') && (FEATURED_CATEGORIES_SET_STYLE == '3')) or ((FEATURED_CATEGORIES_SET == '3') && (FEATURED_CATEGORIES_SET_STYLE == '3')) or ((FEATURED_CATEGORIES_SET == '4') && (FEATURED_CATEGORIES_SET_STYLE == '3'))) && (($i+1) != sizeof($featured_categories_array))){
        $info_box_contents[0]['text'] .= '</tr><tr><td colspan="' . $num_columns . '" align="centre" valign="top" class="featuredCategories"><div style="background-color: #'.CATEGORIES_LINE_COLOR.'; height: '.CATEGORIES_LINE_THICKNESS.'px; width: 100%;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', '1', CATEGORIES_LINE_THICKNESS) . '</div></td>'."\n"; 
      }elseif (FEATURED_CATEGORIES_SET_STYLE == '1'){
        $info_box_contents[0]['text'] .= '</tr><tr><td colspan="' . $num_columns . '" class="featuredCategories">'. tep_draw_separator('pixel_trans.gif', '10', '10') .'</td>'."\n"; 
      }else{
        $info_box_contents[0]['text'] .= '</tr><tr><td colspan="' . $num_columns . '" class="featuredCategories">'. tep_draw_separator('pixel_trans.gif', '6', '6') .'</td>'."\n"; 
      }
	  if (($i+1) != sizeof($featured_categories_array)) {
	    $info_box_contents[0]['text'] .= '</tr><tr>'."\n";
	  }
    }
	
  } // end: for()
  while (($i/$num_columns) != floor($i/$num_columns)) {
    $info_box_contents[0]['text'] .= '<td>&nbsp;</td>'."\n";
	$i++;
  }
  $info_box_contents[0]['text'] .= '</tr></table>'."\n";
  
  
  if ((FEATURED_CATEGORIES_SET_STYLE == '2') || (FEATURED_CATEGORIES_SET_STYLE == '4') || (FEATURED_CATEGORIES_SET_STYLE == '5') || (FEATURED_CATEGORIES_SET_STYLE == '6')) {
    new infoBox($info_box_contents);
  } else {
    echo $info_box_contents[0]['text'];
  }
  
  if ((FEATURED_CATEGORIES_SET_STYLE == '4') || (FEATURED_CATEGORIES_SET_STYLE == '6')) {
    echo '<IMG SRC="images/info_box_' . FEATURED_CATEGORIES_SET_STYLE_SHADOW . '_shadow.gif" WIDTH=100% HEIGHT=13>';
  }
  
} // end: if()
?>