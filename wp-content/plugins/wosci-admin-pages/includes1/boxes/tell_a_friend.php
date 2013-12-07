<?php
/*
  $Id: tell_a_friend.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- tell_a_friend //-->
        
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_TELL_A_FRIEND);

//  new infoBoxHeading($info_box_contents, false, false);

  $info_box_contents = array();
  $info_box_contents =  tep_draw_form('tell_a_friend', tep_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false), 'get').tep_draw_input_field('to_email_address', '', 'size="10"') . '&nbsp;' . tep_image_submit('button_tell_a_friend.gif', BOX_HEADING_TELL_A_FRIEND) . tep_draw_hidden_field('products_id', $HTTP_GET_VARS['products_id']) . tep_hide_session_id() . '</form><br>' . BOX_TELL_A_FRIEND_TEXT;

//  new infoBox($info_box_contents);
?>   
       <?php echo $info_box_contents; ?>
        
  


           
<!-- tell_a_friend_eof //-->
