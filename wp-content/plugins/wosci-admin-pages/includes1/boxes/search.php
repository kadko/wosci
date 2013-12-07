<?php
/*
  $Id: search.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- search //-->
         
<?php
//  $info_box_contents = array();
//  $info_box_contents[] = array('text' => BOX_HEADING_SEARCH);

//  new infoBoxHeading($info_box_contents, false, false);

 // $info_box_contents = array();
  $info_box_contents =  tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get').tep_draw_input_field('keywords', '', 'size="10" maxlength="30" style="width: ' . (BOX_WIDTH-30) . 'px"') . '&nbsp;' . tep_hide_session_id() . tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH) . '<br>' . BOX_SEARCH_TEXT . '<br><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '"><b>' . BOX_SEARCH_ADVANCED_SEARCH . '</b></a></form>';

//  new infoBox($info_box_contents);
?>

<?php echo $info_box_contents; ?>
      
<!-- search_eof //-->
