<script language="javascript">


jQuery(document).ready(function() {

<?php $zid =  tep_get_zone_code($entry ['entry_country_id'],$entry ['entry_zone_id'],''); ?>
<?php if($zid == ''){ $zid = $entry ['entry_state']; } ?>

//loadXMLDocNewp("<?php if($entry['entry_country_id'] == ''){echo STORE_COUNTRY;}else{echo $entry['entry_country_id'];} ?>"<?php echo ', "'.$zid.'"'; ?>);

});

</script>


<?php  if (!isset($_GET['delete'])) echo tep_draw_form('Edit_Payment_Address', '', 'post', 'target="_parent"'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><<?php if (isset($_GET['edit'])) { echo HEADING_TITLE_MODIFY_ENTRY; } elseif (isset($_GET['delete'])) { echo HEADING_TITLE_DELETE_ENTRY; } else { echo HEADING_TITLE_ADD_ENTRY; } ?></td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
 
<?php
  if ($messageStack->size('addressbook') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('addressbook'); ?></td>
      </tr>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
<?php
  }

  if (isset($_GET['delete'])) {
?>
      <tr>
        <td class="main"><b><?php echo DELETE_ADDRESS_TITLE; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><hr style="color:#ffffff" id="pixel_trans"></td>
                <td class="main" width="50%" valign="top"><?php echo DELETE_ADDRESS_DESCRIPTION; ?></td>
                <td align="right" width="50%" valign="top"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main" align="center" valign="top"><b><?php echo SELECTED_ADDRESS; ?></b><br><img src="<?php echo bloginfo('template_url'); ?>/images/arrow_south_east.gif"/></td>
                    <td><hr style="color:#ffffff" id="pixel_trans"></td>
                    <td class="main" valign="top"><?php echo tep_address_label($current_user->ID, $_GET['delete'], true, ' ', '<br>'); ?></td>
                    <td><hr style="color:#ffffff" id="pixel_trans"></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><hr style="color:#ffffff" id="pixel_trans"></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
                <td></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'] . '&action=deleteconfirm', 'SSL') . '" class="sbutton big bo">' . __('Delete','wosci-language') . '</a>'; ?></td>
                <td width="10"><hr style="color:#ffffff" id="pixel_trans"></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
?>
      <tr>
        <td><?php include('address/address_book_details_p.php'); ?></td>
      </tr>
     
<?php
    if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
               
                <td></td>
                <td align="right"><?php //echo '<input value="' . _('Güncelle') . '" class="btn btn-primary btn-success" type="submit">'; ?></td>
                
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
    } else {
      if (sizeof($navigation->snapshot) > 0) {
        $back_link = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
      } else {
        $back_link = tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL');
      }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
               
                <td></td>
                <td><div style="margin:0 auto;width:120px;"><?php echo tep_draw_hidden_field('action', 'process'); ?><?php echo '<input value="' . __('Save', 'wosci-language') . '" class="btn btn-primary btn-success" type="submit">'; ?></div></td>
               
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>

<?php
    }
  }
?>
    </table><?php if (!isset($_GET['delete'])) echo '</form>'; ?>