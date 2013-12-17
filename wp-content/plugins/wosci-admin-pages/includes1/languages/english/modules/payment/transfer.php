<?php

define('MODULE_PAYMENT_TRANSFER_TEXT_TITLE', __( 'Bank Wire Transfer', 'wosci-language' ) );

define('MODULE_PAYMENT_TRANSFER_TEXT_DESCRIPTION', __( 'Bank account details for wire transfer', 'wosci-language' ).' <br> ' . __( 'Account Owner','wosci-language' ) . ': <b>' . MODULE_PAYMENT_TRANSFER_PAYTO . '</b> <br>' . __( 'Account Number','wosci-language' ).': <b>#' . MODULE_PAYMENT_TRANSFER_ACCOUNT.'</b> <br> ' . __( 'Bank Name','wosci-language' ) . ': <b>' . MODULE_PAYMENT_TRANSFER_BANK . '</b> <br>'. __( 'Branch Name','wosci-language' ).': <b>' . MODULE_PAYMENT_TRANSFER_BRANCH . '</b>' );

define('MODULE_PAYMENT_TRANSFER_TEXT_EMAIL_FOOTER', __( 'Your order will not processed until payment arrived to our account.', 'wosci-language' ) );

?>