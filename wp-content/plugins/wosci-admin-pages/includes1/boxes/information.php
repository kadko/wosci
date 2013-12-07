<?php
/*
  $Id: information.php.tortoise.removed,v 1.1 2008/12/26 13:10:36 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- information //-->
         
<?php


//  new infoBoxHeading($info_box_contents, false, false);

echo '<div class="widget boxround bxpb box2 ui-corner-all ui-widget-content" style="list-style-type:none;"><h2 class="widgettitle" style="padding:5px 0;">'.BOX_HEADING_INFORMATION.'</h2>';
echo get_archives('postbypost','10','custom','<li>','</li>') .'<li><a href="' . tep_href_link(FILENAME_CONTACT_US) . '">' . BOX_INFORMATION_CONTACT . '</a></li>';
                                        
echo '</div>';

?>
          
<!-- information_eof //-->
