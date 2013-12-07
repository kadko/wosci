<?php
/*
  $Id: categories.php,v 1.25 2003/07/09 01:13:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

global $tree, $categories_string, $cPath_array, $languages_id;
  function PrintSubMenus( $parentID, $languageID, $start_path ){
      $returnval = '';
      if (($start_path == '') && ($parentID > 0)) {
        $start_path = $parentID;
      } else {
        if ($parentID > 0) $start_path .= "_" . $parentID;
      }
      if ($parentID != 0) {
        $returnval .= "<ul>";
      } else {
        $returnval .= "<div class='suckerdiv'>";
        $returnval .= "<ul id='suckertree1'>";
      }
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '".$parentID."' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languageID ."' order by sort_order, cd.categories_name");
      while ($categories = tep_db_fetch_array($categories_query))  {
        if ($start_path == "") {
          $grouppath = $categories['categories_id'];
        } else {
          $grouppath = $start_path . "_" . $categories['categories_id'];
        }
        $cPath_new = 'cPath=' . $grouppath;
        $categories_string = tep_href_link(FILENAME_DEFAULT, $cPath_new);
        $returnval .= "<li><a class=\"ui-corner-all fg-menu-indicator\"  href='".$categories_string."'>".$categories['categories_name']."</a>";
        if ( tep_has_category_subcategories($categories['categories_id'] ) ) {
           $returnval .= PrintSubMenus( $categories['categories_id'], $languageID, $start_path );
        }
        $returnval .= "</li>";
      }
      $returnval .= "</ul>";
      if ($parentID == 0) $returnval .= "</div>";
      return $returnval;
  }
  
  function PrintSubMenus2( $parentID, $languageID, $sutun ){
      $returnval = '';
     
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '".$parentID."' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languageID ."' order by sort_order, cd.categories_name");
     $m =0;
     
      while ($categories = tep_db_fetch_array($categories_query))  {
        $grouppath = $categories['categories_id'];
        $cPath_new = 'cPath=' . $grouppath;
        $categories_string = tep_href_link(FILENAME_DEFAULT, $cPath_new);
	
	if (SHOW_COUNTS == 'true') {
	$products_in_category = tep_count_products_in_category($categories['categories_id']);
	}
        $returnval .= '<li><a class="smLnkT" href="'.$categories_string.'">'.$categories['categories_name'].' (' . $products_in_category . ')</a>';
       
        $returnval .= '</li>';
    
        if(($m+1) % 2 == 0 && $m !=0){ $ul_list .= '<ul class="navColumn">'.$returnval.'</ul>';$returnval='';}

        $m++;
      }
      if($returnval !=''){$ul_list .= '<ul class="navColumn">'.$returnval.'</ul>';}   
   
      return $ul_list;
  }
  
?>
<!-- categories //-->
         
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_CATEGORIES);

//  new infoBoxHeading($info_box_contents, true, false);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => PrintSubMenus( 0, $languages_id, '' ));

//  new infoBox($info_box_contents);

?>
           
<!-- categories_eof //-->
