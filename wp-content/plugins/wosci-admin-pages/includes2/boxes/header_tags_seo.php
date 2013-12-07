<?php
/*
  $Id: header_tags_seo.php,v 1.00 2008/04/04 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- header_tags_seo //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_HEADER_TAGS_SEO,
                     'link'  => tep_href_link(FILENAME_HEADER_TAGS_SEO, 'selected_box=headertags'));

  if ($selected_box == 'headertags') {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_HEADER_TAGS_SEO, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_ADD_A_PAGE . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_HEADER_TAGS_SILO, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_SILO . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_HEADER_TAGS_FILL_TAGS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_FILL_TAGS . '</a><br>' .
                                   '<a href="' . tep_href_link(FILENAME_HEADER_TAGS_TEST, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADER_TAGS_TEST . '</a>');
 
                                   
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- header_tags_seo_eof //-->
