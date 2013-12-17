<?php
/*
  $Id: moneyorder.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_MONEYORDER_TEXT_TITLE', __( 'Check/Money Order','wosci-language' ) );
  define('MODULE_PAYMENT_MONEYORDER_TEXT_DESCRIPTION', __( 'Make Payable To','wosci-language' ) . ':&nbsp;' . MODULE_PAYMENT_MONEYORDER_PAYTO . '<br><br>Send To:<br>' . nl2br(STORE_NAME_ADDRESS) . '<br><br>' .  __( 'Your order will not ship until we receive payment.','wosci-language' ) );
  define('MODULE_PAYMENT_MONEYORDER_TEXT_EMAIL_FOOTER', __( 'Make Payable To:','wosci-language' ) .  MODULE_PAYMENT_MONEYORDER_PAYTO . '\n\n'. __( 'Send To','wosci-language' ) . ':\n' . STORE_NAME_ADDRESS . '\n\n' . __('Your order will not ship until we receive payment.','wosci-language' ) );
?>
