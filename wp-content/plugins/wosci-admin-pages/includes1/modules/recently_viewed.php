<?php
/*
recently_viewed.php
*/
/////////// change the following lines if you would like:

$recently_viewed_box_max_lines = 5;  // maximum number of lines in recently viewed box
$recently_viewed_box_max_characters_per_line = 30;  // maximum number of characters per line in recently viewed box
/////////// change the above lines if you would like:
?>
<!-- recently_viewed //-->

<?php


  if (strlen(trim($recently_viewed)>0)) {   // only display recently viewed box if there are items to be displayed
    $info_box_contents = array();
    $info_box_contents[] = array('align' => 'left',
                                 'text'  => RECENTLY_VIEWED_BOX_HEADING);
  //  new infoBoxHeading($info_box_contents, true, true);
      $row = 0;
      $col = 0;
    $counter = 0;
    $info_box_contents = array();
     $recent_products = split(';',$recently_viewed);


foreach($recent_products as $key => $value) {
if($value == "" || $value == " " || is_null($value)) {
unset($recent_products[$key]);
}
}

     for($i=0;$i<count($recent_products);$i++) {
       
     
        $info_box_contents[$row][$col] = array('align' => 'center',
                                               'params' => 'class="smallText" width="33%" valign="top"',
                                               'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $recent_products[$i].'&p=' . $recent_products[$i], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES.tep_get_products_image($recent_products[$i]),tep_get_products_name($recent_products[$i]),80,80) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $recent_products[$i].'&p=' . $recent_products[$i], 'NONSSL') . '">' . tep_get_products_name($recent_products[$i]) .'</a>');

        $col ++;
        if ($col > 2) {
          $col = 0;
          $row ++;
        }
      }


?>
<!-- also_purchased_products_eof //-->

<?php
    }
  if(count($recent_products)>0 && $recent_products['0'] !=''){
?>



<div style="background-color:#f8f8f8;margin:0px 10px 10px 10px;">
<!-- enalt_starttag bof //-->
<div id="enalt"  style="padding:14px;border:solid 1px #ccc;" class="boxround" >   
    <div id="ea-1">
    <div class="boxround bxpb box ui-corner-all ui-widget-content">
<h2 style="padding: 0px 0px 20px 5px; font-size: 1.6em; color: rgb(228, 121, 17);"><?php echo SON_INCELENEN; ?></h2><?php
    
        new contentBox($info_box_contents);
?>
    </div>
    </div>
    </div>
<!-- enalt_endtag eof //-->
</div><?php } ?>