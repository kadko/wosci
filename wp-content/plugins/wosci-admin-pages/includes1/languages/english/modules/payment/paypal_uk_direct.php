<?php
/*
  $Id: paypal_uk_direct.php 1800 2008-01-11 16:33:02Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_TEXT_TITLE', __( 'PayPal Website Payments Pro (UK) Direct Payments','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_TEXT_PUBLIC_TITLE', __( 'Credit or Debit Card (Processed securely by PayPal)','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_TEXT_DESCRIPTION', __( '<b>Note: PayPal requires the PayPal Website Payments Pro (UK) Express Checkout payment module to be enabled if this module is activated.</b><br /><br /><img src="images/icon_popup.gif" border="0">&nbsp;<a href="https://www.paypal.com/mrb/pal=PS2X9Q773CKG4" target="_blank" style="text-decoration: underline; font-weight: bold;">Visit PayPal Website</a>&nbsp;<a href="javascript:toggleDivBlock(\'paypalDirectUKInfo\');">(info)</a><span id="paypalDirectUKInfo" style="display: none;"><br><i>Using the above link to signup at PayPal grants osCommerce a small financial bonus for referring a customer.</i></span>','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_CARD_OWNER', __( 'Card Owner:','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_CARD_TYPE', __( 'Card Type:','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_CARD_NUMBER', __( 'Card Number:','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_CARD_VALID_FROM', __( 'Card Valid From Date:','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_CARD_VALID_FROM_INFO', __( '(if available)','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_CARD_EXPIRES', __( 'Card Expiry Date:','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_CARD_CVC', __( 'Card Security Code (CVV2):','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_CARD_ISSUE_NUMBER', __( 'Card Issue Number:','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_CARD_ISSUE_NUMBER_INFO', __( '(for Maestro and Solo cards only)','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_ERROR_ALL_FIELDS_REQUIRED', __( 'Error: All payment information fields are required.','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_ERROR_GENERAL', __( 'Error: A general problem has occurred with the transaction. Please try again.','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_ERROR_CFG_ERROR', __( 'Error: Payment module configuration error. Please verify the login credentials.','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_ERROR_ADDRESS', __( 'Error: A match of the Shipping Address City, State, and Postal Code failed. Please try again.','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_ERROR_DECLINED', __( 'Error: This transaction has been declined. Please try again.','wosci-translation' ) );
  define('MODULE_PAYMENT_PAYPAL_UK_DIRECT_ERROR_INVALID_CREDIT_CARD', __( 'Error: The provided credit card information is invalid. Please try again.','wosci-translation' ) );
?>
