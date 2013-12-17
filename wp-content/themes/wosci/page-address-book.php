<?php
/*
  $Id: shopping_cart.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

  if ( $current_user->ID == '0' ) {
   
    wp_redirect(esc_url( home_url( '/' ) ).'wp-login.php?redirect_to=address-book');
  }
get_header();

?>
<script type="text/javascript">
jQuery(document).ready(function(){

jQuery('.edit_address').click(function () {

	//jQuery('#myModal2 .modal-body').append('<img id="loading-line" src="<?php echo bloginfo('template_url'); ?>/loading-line.gif">');
	
	var spins = [
"■.",
"◢◣◤◥",
"▉▍▎▊",
"+ + +",
    "◐ ◓ ◑ ◒",
    "◡◡ ⊙⊙ ◠◠",
    ".oOo"
];

    var spin = spins[0],
        title = jQuery('#myModal2 .modal-body'),
        i=0;

    var aaa = setInterval(function() {
        i = i==spin.length-1 ? 0 : ++i;
        title.text( spin[i] );
    },50);
	
	jQuery('#editSAddress  #loading-line').remove();// üstteki yükleniyoru sonradan yüklenen modalde kalinti olmamasi için sildik
	
	var addrID2 =jQuery(this).data("edit");
	jQuery("#myModal2").modal({
	        remote: '<?php echo esc_url( home_url( '/' ) ); ?>edit-shipping-address?edit='+ addrID2 +'&from=Edit_Book_Address',
	        refresh: true
	});
	

	var target = '<?php echo esc_url( home_url( '/' ) ); ?>edit-shipping-address?edit='+ addrID2 +'&from=Edit_Book_Address';
	
	jQuery("#myModal2").load(target, function() { 
	jQuery("#myModal2").modal("show"); 
	
	});

});

});
</script>

<?php /* Template Name: Wosci - Account Page*/ ?>
<div class="well">
<h1><?php _e('Address Book', 'wosci-language');?></h1><div class="margin-top"></div>


                      <!-- Modal -->
  <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title"><?php echo __('Edit Address', 'wosci-language'); ?></h4>
        </div>
        <div class="modal-body">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __( 'Cancel', 'wosci-language' ); ?></button>
          <button type="button" class="btn btn-primary" data-dismiss="modal"><?php echo __( 'Save', 'wosci-language' ); ?></button>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


<?php

      $radio_buttons = 0;

      $addresses_query = tep_db_query("select address_book_id, entry_firstname as firstname, entry_lastname as lastname, entry_company as company, entry_street_address as street_address, entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$current_user->ID . "'");
      while ($addresses = tep_db_fetch_array($addresses_query)) {
        $format_id = tep_get_address_format_id($addresses['country_id']);

$cdai = get_user_meta($current_user->ID, 'customer_default_address_id');
$customer_default_address_id = $cdai[0]; //$check_customer['customers_default_address_id'];
	$disabled = ''; $default = '';
       if ($customer_default_address_id == $addresses['address_book_id']) { $disabled = 'disabled="disabled"'; $default= '<b>[ '. __('DEFAULT ADDRESS', 'wosci-language') . ' ]</b> ';}
       if ( $addresses['address_book_id'] ) {
     
         echo '<div data-adid="'.$addresses['address_book_id'].'"><button data-delete="'.$addresses['address_book_id'].'" type="button" class="btn btn-danger" style="margin-right:10px;" '.$disabled.'><span class="glyphicon glyphicon-remove"></span> Delete</button><a data-target="#myModal2" role="button" data-edit="'.$addresses['address_book_id'].'" data-toggle="modal" href="'. esc_url( home_url( '/' ) ).'edit-shipping-address/?edit='. $addresses['address_book_id'] .'&from=Edit_Book_Address" class="btn btn-primary edit_address" style="margin-right:20px;"><span class="glyphicon glyphicon-edit"></span> ' . __('Edit', 'wosci-language') . '</a>'. '<span data-labelid="'.$addresses['address_book_id'].'">'.$default.tep_address_label($current_user->ID, $addresses['address_book_id'], true, ' ', ' ').'</span><hr style="margin:10px;"></div>' ;//'<option value="'. $addresses['address_book_id'] .'">'. tep_address_label($current_user->ID, $addresses['address_book_id'], true, ' ', ' ') .'</option>';
        }
echo '';
                    
                    //echo tep_output_string_protected($addresses['firstname'] . ' ' . $addresses['lastname']); 
                    //echo tep_draw_radio_field('address', $addresses['address_book_id'], ($addresses['address_book_id'] == $sendto)); 
                    
                   //echo tep_address_format($format_id, $addresses, true, ' ', ', '); 

        //$radio_buttons++;
      }
      
?>
<a class="btn btn-success" href="<?php echo esc_url( home_url( '/' ) ); ?>account"><?php echo __('Back','wosci-language'); ?></a>

</div><!--.well-->
<?php get_footer(); ?>