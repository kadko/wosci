<?php
/*
  $Id: box.php.tortoise.removed,v 1.1 2008/12/26 13:10:28 kako Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License

  Example usage:

  $heading = array();
  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_HEADING_TOOLS,
                     'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=tools'));

  $contents = array();
  $contents[] = array('text'  => SOME_TEXT);

  $box = new box;
  echo $box->infoBox($heading, $contents);
*/

  class box extends tableBlock {
    function box() {
      $this->heading = array();
      $this->contents = array();
    }

    function infoBox($heading, $contents, $buttons) {
      $this->table_row_parameters = 'class="infoBoxHeading"';
      $this->table_data_parameters = 'class="infoBoxHeading"';
      $this->heading = $this->tableBlock($heading);

      $this->table_row_parameters = '';
      $this->table_data_parameters = 'class="infoBoxContent"';
      $this->contents = $this->tableBlock($contents);

      $wpbox ='




<div style="margin:-10px 0  0 10px ;" class="metabox-holder has-right-sidebar">







<div id="postbox-container-1" class="postbox-container">
<div id="side-sortables" class="meta-box-sortables ui-sortable"><div id="submitdiv" class="postbox ">
<div class="handlediv" title="Click to toggle"><br></div><h3 class="hndle"><span>'.$heading[0][text].'</span></h3>
<div class="inside">
<div class="submitbox" id="submitpost">

<div id="minor-publishing">
<div id="minor-publishing-actions">

<!--
<div id="preview-action">
<a class="preview button" href="/" target="wp-preview" id="post-preview">Preview Changes</a>
</div>
-->

<div class="clear"></div>
</div><!-- #minor-publishing-actions -->






'.$this->contents.'



<!--<div class="misc-pub-section">Status:Published</div>--><!-- .misc-pub-section -->


<!-- #misc-module-values -->
<div class="clear"></div>

</div>

'.$buttons.'

</div>

</div>
</div>

</div></div>

























</div>


















';
      return $wpbox;
      
      
      
      
      
      
      
      
      
      
    }

    function menuBox($heading, $contents) {
      $this->table_data_parameters = 'class="menuBoxHeading"';
      if (isset($heading[0]['link'])) {
        $this->table_data_parameters .= ' onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . $heading[0]['link'] . '\'"';
        $heading[0]['text'] = '&nbsp;<a href="' . $heading[0]['link'] . '" class="menuBoxHeadingLink">' . $heading[0]['text'] . '</a>&nbsp;';
      } else {
        $heading[0]['text'] = '&nbsp;' . $heading[0]['text'] . '&nbsp;';
      }
      $this->heading = $this->tableBlock($heading);

      $this->table_data_parameters = 'class="menuBoxContent"';
      $this->contents = $this->tableBlock($contents);

      return $this->heading . $this->contents;
    }
  }
?>
