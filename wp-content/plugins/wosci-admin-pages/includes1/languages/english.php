<?php
/*
  $Id: english.php 1743 2007-12-20 18:02:36Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2007 osCommerce

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
//@setlocale(LC_TIME, 'en_US.ISO_8859-1' );
/**/
if(WPLANG == 'tr_TR'){
setlocale(LC_TIME, 'turkish'); 
}
define('DATE_FORMAT_SHORT', '%d/%m/%Y'); // this is used for strftime()
define('DATE_FORMAT_LONG',  '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y' ); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S' );

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY',  'USD' );

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="en"' );

// charset for web pages and emails
define('CHARSET',  'utf-8' );

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', __( 'Create an Account','wosci-language' ) );
define('HEADER_TITLE_MY_ACCOUNT', __( 'My Account','wosci-language' ) );
define('HEADER_TITLE_CART_CONTENTS', __( 'Cart Contents','wosci-language' ) );
define('HEADER_TITLE_CHECKOUT', __( 'Checkout','wosci-language' ) );
define('HEADER_TITLE_TOP', __( 'Top','wosci-language' ) );
define('HEADER_TITLE_CATALOG', __( 'Catalog','wosci-language' ) );
define('HEADER_TITLE_LOGOFF', __( 'Log Off','wosci-language' ) );
define('HEADER_TITLE_LOGIN', __( 'Log In','wosci-language' ) );

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', __( 'requests since','wosci-language' ) );

// text for gender
define('MALE', __( 'Male','wosci-language' ) );
define('FEMALE', __( 'Female','wosci-language' ) );
define('MALE_ADDRESS', __( 'Mr.','wosci-language' ) );
define('FEMALE_ADDRESS', __( 'Ms.','wosci-language' ) );

// text for date of birth example
define('DOB_FORMAT_STRING', __( 'mm/dd/yyyy','wosci-language' ) );

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', __( 'Categories','wosci-language' ) );

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', __( 'Manufacturers','wosci-language' ) );

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', __( 'What\'s New?','wosci-language' ) );

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', __( 'Quick Find','wosci-language' ) );
define('BOX_SEARCH_TEXT', __( 'Use keywords to find the product you are looking for.','wosci-language' ) );
define('BOX_SEARCH_ADVANCED_SEARCH', __( 'Advanced Search','wosci-language' ) );

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', __( 'Specials','wosci-language' ) );

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', __( 'Reviews','wosci-language' ) );
define('BOX_REVIEWS_WRITE_REVIEW', __( 'Write a review on this product!','wosci-language' ) );
define('BOX_REVIEWS_NO_REVIEWS', __( 'There are currently no product reviews','wosci-language' ) );
define('BOX_REVIEWS_TEXT_OF_5_STARS', __( '%s of 5 Stars!','wosci-language' ) );

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', __( 'Shopping Cart','wosci-language' ) );
define('BOX_SHOPPING_CART_EMPTY', __( '0 items','wosci-language' ) );

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', __( 'Order History','wosci-language' ) );

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', __( 'Bestsellers','wosci-language' ) );
define('BOX_HEADING_BESTSELLERS_IN', __( 'Bestsellers in<br>&nbsp;&nbsp;','wosci-language' ) );

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', __( 'Notifications','wosci-language' ) );
define('BOX_NOTIFICATIONS_NOTIFY', __( 'Notify me of updates to <b>%s</b>','wosci-language' ) );
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', __( 'Do not notify me of updates to <b>%s</b>','wosci-language' ) );

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', __( 'Manufacturer Info','wosci-language' ) );
define('BOX_MANUFACTURER_INFO_HOMEPAGE', __( '%s Homepage','wosci-language' ) );
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', __( 'Other products','wosci-language' ) );

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', __( 'Languages','wosci-language' ) );

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', __( 'Currencies','wosci-language' ) );

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', __( 'Information','wosci-language' ) );
define('BOX_INFORMATION_PRIVACY', __( 'Privacy Notice','wosci-language' ) );
define('BOX_INFORMATION_CONDITIONS', __( 'Conditions of Use','wosci-language' ) );
define('BOX_INFORMATION_SHIPPING', __( 'Shipping & Returns','wosci-language' ) );
define('BOX_INFORMATION_CONTACT', __( 'Contact Us','wosci-language' ) );

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', __( 'Tell A Friend','wosci-language' ) );
define('BOX_TELL_A_FRIEND_TEXT', __( 'Tell someone you know about this product.','wosci-language' ) );

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', __( 'Delivery Information','wosci-language' ) );
define('CHECKOUT_BAR_PAYMENT', __( 'Payment Information','wosci-language' ) );
define('CHECKOUT_BAR_CONFIRMATION', __( 'Confirmation','wosci-language' ) );
define('CHECKOUT_BAR_FINISHED', __( 'Finished!','wosci-language' ) );

// pull down default text
define('PULL_DOWN_DEFAULT', __( 'Please Select','wosci-language' ) );
define('TYPE_BELOW', __( 'Type Below','wosci-language' ) );

// javascript messages
define('JS_ERROR', __( 'Errors have occured during the process of your form.\n\nPlease make the following corrections:\n\n','wosci-language' ) );

define('JS_REVIEW_TEXT', __( '* The \'Review Text\' must have at least ' . REVIEW_TEXT_MIN_LENGTH . ' characters.\n','wosci-language' ) );
define('JS_REVIEW_RATING', __( '* You must rate the product for your review.\n','wosci-language' ) );

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', __( '* Please select a payment method for your order.\n','wosci-language' ) );

define('JS_ERROR_SUBMITTED', __( 'This form has already been submitted. Please press Ok and wait for this process to be completed.','wosci-language' ) );

define('ERROR_NO_PAYMENT_MODULE_SELECTED', __( 'Please select a payment method for your order.','wosci-language' ) );

define('CATEGORY_COMPANY', __( 'Company Details','wosci-language' ) );
define('CATEGORY_PERSONAL', __( 'Your Personal Details','wosci-language' ) );
define('CATEGORY_ADDRESS', __( 'Your Address','wosci-language' ) );
define('CATEGORY_CONTACT', __( 'Your Contact Information','wosci-language' ) );
define('CATEGORY_OPTIONS', __( 'Options','wosci-language' ) );
define('CATEGORY_PASSWORD', __( 'Your Password','wosci-language' ) );

define('ENTRY_COMPANY', __( 'Company Name:','wosci-language' ) );
define('ENTRY_COMPANY_ERROR', __( 'Company Error','wosci-language' ) );
define('ENTRY_COMPANY_TEXT', __( 'Company','wosci-language' ) );
define('ENTRY_GENDER', __( 'Gender:','wosci-language' ) );
define('ENTRY_GENDER_ERROR', __( 'Please select your Gender.','wosci-language' ) );
define('ENTRY_GENDER_TEXT', __( 'Gender','wosci-language' ) );
define('ENTRY_FIRST_NAME', __( 'First Name:','wosci-language' ) );
define('ENTRY_FIRST_NAME_ERROR', __( 'Your First Name must contain a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_FIRST_NAME_TEXT', __( 'Name','wosci-language' ) );
define('ENTRY_LAST_NAME', __( 'Last Name:','wosci-language' ) );
define('ENTRY_LAST_NAME_ERROR', __( 'Your Last Name must contain a minimum of ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_LAST_NAME_TEXT', __( 'Last Name','wosci-language' ) );
define('ENTRY_DATE_OF_BIRTH', __( 'Date of Birth:','wosci-language' ) );
define('ENTRY_DATE_OF_BIRTH_ERROR', __( 'Your Date of Birth must be in this format: MM/DD/YYYY (eg 05/21/1970)','wosci-language' ) );
define('ENTRY_DATE_OF_BIRTH_TEXT', __( '* (eg. 05/21/1970)','wosci-language' ) );
define('ENTRY_EMAIL_ADDRESS', __( 'E-Mail Address:','wosci-language' ) );
define('ENTRY_EMAIL_ADDRESS_ERROR', __( 'Your E-Mail Address must contain a minimum of ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', __( 'Your E-Mail Address does not appear to be valid - please make any necessary corrections.','wosci-language' ) );
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', __( 'Your E-Mail Address already exists in our records - please log in with the e-mail address or create an account with a different address.','wosci-language' ) );
define('ENTRY_EMAIL_ADDRESS_TEXT', __( 'Address','wosci-language' ) );
define('ENTRY_STREET_ADDRESS', __( 'Street Address:','wosci-language' ) );
define('ENTRY_STREET_ADDRESS_ERROR', __( 'Your Street Address must contain a minimum of ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_STREET_ADDRESS_TEXT', __( 'Address','wosci-language' ) );
define('ENTRY_SUBURB', __( 'Suburb:','wosci-language' ) );
define('ENTRY_SUBURB_ERROR', __( 'Suburb Error','wosci-language' ) );
define('ENTRY_SUBURB_TEXT', __( 'Suburb','wosci-language' ) );
define('ENTRY_POST_CODE', __( 'Post Code:','wosci-language' ) );
define('ENTRY_POST_CODE_ERROR', __( 'Your Post Code must contain a minimum of ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_POST_CODE_TEXT', __( 'Post Code','wosci-language' ) );
define('ENTRY_CITY', __( 'City:','wosci-language' ) );
define('ENTRY_CITY_ERROR', __( 'Your City must contain a minimum of ' . ENTRY_CITY_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_CITY_TEXT', __( 'City','wosci-language' ) );
define('ENTRY_STATE', __( 'State/Province:','wosci-language' ) );
define('ENTRY_STATE_ERROR', __( 'Your State must contain a minimum of ' . ENTRY_STATE_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_STATE_ERROR_SELECT', __( 'Please select a state from the States pull down menu.','wosci-language' ) );
define('ENTRY_STATE_TEXT', __( 'State','wosci-language' ) );
define('ENTRY_COUNTRY', __( 'Country:','wosci-language' ) );
define('ENTRY_COUNTRY_ERROR', __( 'You must select a country from the Countries pull down menu.','wosci-language' ) );
define('ENTRY_COUNTRY_TEXT', __( 'Country','wosci-language' ) );
define('ENTRY_TELEPHONE_NUMBER', __( 'Telephone Number:','wosci-language' ) );
define('ENTRY_TELEPHONE_NUMBER_ERROR', __( 'Your Telephone Number must contain a minimum of ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_TELEPHONE_NUMBER_TEXT', __( 'Phone','wosci-language' ) );
define('ENTRY_FAX_NUMBER', __( 'Fax Number:','wosci-language' ) );
define('ENTRY_FAX_NUMBER_ERROR', __( 'Fax Number Error','wosci-language' ) );
define('ENTRY_FAX_NUMBER_TEXT', __( 'Fax Number','wosci-language' ) );
define('ENTRY_NEWSLETTER', __( 'Newsletter:','wosci-language' ) );
define('ENTRY_NEWSLETTER_TEXT', __( 'Newsletter','wosci-language' ) );
define('ENTRY_NEWSLETTER_YES', __( 'Subscribed','wosci-language' ) );
define('ENTRY_NEWSLETTER_NO', __( 'Unsubscribed','wosci-language' ) );
define('ENTRY_NEWSLETTER_ERROR', __( 'Newsletter Error','wosci-language' ) );
define('ENTRY_PASSWORD', __( 'Password:','wosci-language' ) );
define('ENTRY_PASSWORD_ERROR', __( 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', __( 'The Password Confirmation must match your Password.','wosci-language' ) );
define('ENTRY_PASSWORD_TEXT', __( 'Password','wosci-language' ) );
define('ENTRY_PASSWORD_CONFIRMATION', __( 'Password Confirmation:','wosci-language' ) );
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', __( 'Confirmation','wosci-language' ) );
define('ENTRY_PASSWORD_CURRENT', __( 'Current Password:','wosci-language' ) );
define('ENTRY_PASSWORD_CURRENT_TEXT', __( 'Password','wosci-language' ) );
define('ENTRY_PASSWORD_CURRENT_ERROR', __( 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_PASSWORD_NEW', __( 'New Password:','wosci-language' ) );
define('ENTRY_PASSWORD_NEW_TEXT', __( 'Password New','wosci-language' ) );
define('ENTRY_PASSWORD_NEW_ERROR', __( 'Your new Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.','wosci-language' ) );
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', __( 'The Password Confirmation must match your new Password.','wosci-language' ) );
define('PASSWORD_HIDDEN', __( '--HIDDEN--','wosci-language' ) );

define('FORM_REQUIRED_INFORMATION', __( '* Required information','wosci-language' ) );

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', __( 'Result Pages:','wosci-language' ) );
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', __( 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)','wosci-language' ) );
//define('TEXT_DISPLAY_NUMBER_OF_ORDERS', __( 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)','wosci-language' ) );
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', __( 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> reviews)','wosci-language' ) );
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', __( 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new products)','wosci-language' ) );
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', __( 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> specials)','wosci-language' ) );

define('PREVNEXT_TITLE_FIRST_PAGE', __( 'First Page','wosci-language' ) );
define('PREVNEXT_TITLE_PREVIOUS_PAGE', __( 'Previous Page','wosci-language' ) );
define('PREVNEXT_TITLE_NEXT_PAGE', __( 'Next Page','wosci-language' ) );
define('PREVNEXT_TITLE_LAST_PAGE', __( 'Last Page','wosci-language' ) );
define('PREVNEXT_TITLE_PAGE_NO', __( 'Page %d','wosci-language' ) );
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', __( 'Previous Set of %d Pages','wosci-language' ) );
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', __( 'Next Set of %d Pages','wosci-language' ) );
define('PREVNEXT_BUTTON_FIRST', __( '&lt;&lt;FIRST','wosci-language' ) );
define('PREVNEXT_BUTTON_PREV', __( '[&lt;&lt;&nbsp;Prev]','wosci-language' ) );
define('PREVNEXT_BUTTON_NEXT', __( '[Next&nbsp;&gt;&gt;]','wosci-language' ) );
define('PREVNEXT_BUTTON_LAST', __( 'LAST&gt;&gt;','wosci-language' ) );

define('IMAGE_BUTTON_ADD_ADDRESS', __( 'Add Address','wosci-language' ) );
define('IMAGE_BUTTON_ADDRESS_BOOK', __( 'Address Book','wosci-language' ) );
define('IMAGE_BUTTON_BACK', __( 'Back','wosci-language' ) );
define('IMAGE_BUTTON_BUY_NOW', __( 'Buy Now','wosci-language' ) );
define('IMAGE_BUTTON_CHANGE_ADDRESS', __( 'Change Address','wosci-language' ) );
define('IMAGE_BUTTON_CHECKOUT', __( 'Checkout','wosci-language' ) );
define('IMAGE_BUTTON_CONFIRM_ORDER', __( 'Confirm Order','wosci-language' ) );
define('IMAGE_BUTTON_CONTINUE', __( 'Continue','wosci-language' ) );
define('IMAGE_BUTTON_CONTINUE_SHOPPING', __( 'Continue Shopping','wosci-language' ) );
define('IMAGE_BUTTON_DELETE', __( 'Delete','wosci-language' ) );
define('IMAGE_BUTTON_EDIT_ACCOUNT', __( 'Edit Account','wosci-language' ) );
define('IMAGE_BUTTON_HISTORY', __( 'Order History','wosci-language' ) );
define('IMAGE_BUTTON_LOGIN', __( 'Sign In','wosci-language' ) );
define('IMAGE_BUTTON_IN_CART', __( 'Add to Cart','wosci-language' ) );
define('IMAGE_BUTTON_NOTIFICATIONS', __( 'Notifications','wosci-language' ) );
define('IMAGE_BUTTON_QUICK_FIND', __( 'Quick Find','wosci-language' ) );
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', __( 'Remove Notifications','wosci-language' ) );
define('IMAGE_BUTTON_REVIEWS', __( 'Reviews','wosci-language' ) );
define('IMAGE_BUTTON_SEARCH', __( 'Search','wosci-language' ) );
define('IMAGE_BUTTON_SHIPPING_OPTIONS', __( 'Shipping Options','wosci-language' ) );
define('IMAGE_BUTTON_TELL_A_FRIEND', __( 'Tell a Friend','wosci-language' ) );
define('IMAGE_BUTTON_UPDATE', __( 'Update','wosci-language' ) );
define('IMAGE_BUTTON_UPDATE_CART', __( 'Update Cart','wosci-language' ) );
define('IMAGE_BUTTON_WRITE_REVIEW', __( 'Write Review','wosci-language' ) );

define('SMALL_IMAGE_BUTTON_DELETE', __( 'Delete','wosci-language' ) );
define('SMALL_IMAGE_BUTTON_EDIT', __( 'Edit','wosci-language' ) );
define('SMALL_IMAGE_BUTTON_VIEW', __( 'View','wosci-language' ) );

define('ICON_ARROW_RIGHT', __( 'more','wosci-language' ) );
define('ICON_CART', __( 'In Cart','wosci-language' ) );
define('ICON_ERROR', __( 'Error','wosci-language' ) );
define('ICON_SUCCESS', __( 'Success','wosci-language' ) );
define('ICON_WARNING', __( 'Warning','wosci-language' ) );

define('TEXT_GREETING_PERSONAL', __( 'Welcome back <span class="greetUser">%s!</span> Would you like to see which <a href="%s"><u>new products</u></a> are available to purchase?','wosci-language' ) );
define('TEXT_GREETING_PERSONAL_RELOGON', __( '<small>If you are not %s, please <a href="%s"><u>log yourself in</u></a> with your account information.</small>','wosci-language' ) );
define('TEXT_GREETING_GUEST', __( 'Welcome <span class="greetUser">Guest!</span> Would you like to <a href="%s"><u>log yourself in</u></a>? Or would you prefer to <a href="%s"><u>create an account</u></a>?','wosci-language' ) );

define('TEXT_SORT_PRODUCTS', __( 'Sort products ','wosci-language' ) );
define('TEXT_DESCENDINGLY', __( 'descendingly','wosci-language' ) );
define('TEXT_ASCENDINGLY', __( 'ascendingly','wosci-language' ) );
define('TEXT_BY', __( ' by ','wosci-language' ) );

define('TEXT_REVIEW_BY', __( 'by %s','wosci-language' ) );
define('TEXT_REVIEW_WORD_COUNT', __( '%s words','wosci-language' ) );
define('TEXT_REVIEW_RATING', __( 'Rating: %s [%s]','wosci-language' ) );
define('TEXT_REVIEW_DATE_ADDED', __( 'Date Added: %s','wosci-language' ) );
define('TEXT_NO_REVIEWS', __( 'There are currently no product reviews.','wosci-language' ) );

define('TEXT_NO_NEW_PRODUCTS', __( 'There are currently no products.','wosci-language' ) );

define('TEXT_UNKNOWN_TAX_RATE', __( 'Unknown tax rate','wosci-language' ) );

define('TEXT_REQUIRED', __( '<span class="errorText">Required</span>','wosci-language' ) );

define('ERROR_TEP_MAIL', __( '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERROR:</small> Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</b></font>','wosci-language' ) );
define('WARNING_INSTALL_DIRECTORY_EXISTS', __( 'Warning: Installation directory exists at: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Please remove this directory for security reasons.','wosci-language' ) );
define('WARNING_CONFIG_FILE_WRITEABLE', __( 'Warning: I am able to write to the configuration file: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. This is a potential security risk - please set the right user permissions on this file.','wosci-language' ) );
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', __( 'Warning: The sessions directory does not exist: ' . tep_session_save_path() . '. Sessions will not work until this directory is created.','wosci-language' ) );
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', __( 'Warning: I am not able to write to the sessions directory: ' . tep_session_save_path() . '. Sessions will not work until the right user permissions are set.','wosci-language' ) );
define('WARNING_SESSION_AUTO_START', __( 'Warning: session.auto_start is enabled - please disable this php feature in php.ini and restart the web server.','wosci-language' ) );
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', __( 'Warning: The downloadable products directory does not exist: ' . DIR_FS_DOWNLOAD . '. Downloadable products will not work until this directory is valid.','wosci-language' ) );

define('TEXT_CCVAL_ERROR_INVALID_DATE', __( 'The expiry date entered for the credit card is invalid. Please check the date and try again.','wosci-language' ) );
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', __( 'The credit card number entered is invalid. Please check the number and try again.','wosci-language' ) );
//define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', __( 'The first four digits of the number entered are: %s. If that number is correct, we do not accept that type of credit card. If it is wrong, please try again.','wosci-language' ) );

//define('FOOTER_TEXT_BODY', __( 'Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br>Powered by <a href="http://www.oscommerce.com" target="_blank">osCommerce</a>','wosci-language' ) );
/*** Begin Header Tags SEO ***/ 
define('TEXT_SEE_MORE', __( 'See More','wosci-language' ) );
/*** End Header Tags SEO ***/ 
// BOF Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', __( 'Company\'s tax id number:','wosci-language' ) );
define('ENTRY_COMPANY_TAX_ID_ERROR', __( 'Tax ID Error','wosci-language' ) );
define('ENTRY_COMPANY_TAX_ID_TEXT', __( 'Tax ID','wosci-language' ) );
// EOF Separate Pricing Per Customer
define('ENTRY_CHANGE_PASSWORD', __( 'Change Password','wosci-language' ) );
define('HEADER_EDIT_MY_ACCOUNT', __( 'Edit Account','wosci-language' ) );
define('ENTRY_NEWSLETTER2', __( 'Newsletter Setting','wosci-language' ) );
define('BOX_HEADING_CUST_SERV', __( 'Customer Service','wosci-language' ) );
define('BOX_HEADING_COMPANY', __( 'Help Pages','wosci-language' ) );
define('IN_STOCK', __( 'In Stock','wosci-language' ) );
define('OUT_OF_STOCK', __('Out of Stok'));
define('SKU', __('SKU#'));
define('INC_TAX', __('Inc. Taxes'));
define('EX_TAX', __( 'Exl. Taxes','wosci-language' ) );
define('QUANTITY', __( 'Qty:','wosci-language' ) ); 

define('PROD_DESC', __('Product Description')); 	
define('REVIEWS', __('Reviews'));
define('INSTALLMENTS', __('Installments')); 
?>
