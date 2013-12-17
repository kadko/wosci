--
-- Tablo için tablo yap?s? `address_book`
--

CREATE TABLE IF NOT EXISTS `address_book` (
  `address_book_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `entry_gender` char(1) NOT NULL,
  `entry_company` varchar(32) DEFAULT NULL,
  `entry_firstname` varchar(32) NOT NULL,
  `entry_lastname` varchar(32) NOT NULL,
  `entry_street_address` varchar(64) NOT NULL,
  `entry_suburb` varchar(32) DEFAULT NULL,
  `entry_postcode` varchar(10) NOT NULL,
  `entry_city` varchar(32) NOT NULL,
  `entry_state` varchar(32) DEFAULT NULL,
  `entry_country_id` int(11) NOT NULL DEFAULT '0',
  `entry_zone_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`address_book_id`),
  KEY `idx_address_book_customers_id` (`customers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Tablo döküm verisi `address_book`
--

INSERT INTO `address_book` (`address_book_id`, `customers_id`, `entry_gender`, `entry_company`, `entry_firstname`, `entry_lastname`, `entry_street_address`, `entry_suburb`, `entry_postcode`, `entry_city`, `entry_state`, `entry_country_id`, `entry_zone_id`) VALUES
(1, 1, '', 'ACME Inc.', 'Roger', 'Waters', '1 Way Street One...', 'Hi! Way district', '12345', 'Never - Never', 'CA', 223, 12),
(2, 1, '', 'ASN', 'kadir', 'korkmaz', 'Ã–merpaÅŸa cad Ã¶zlem apt 53A D1', 'GÃ¶ztepe', '34730', 'KadÄ±kÃ¶y', '1', 215, 182),
(3, 1, '', 'ASN', 'kadir', 'korkmaz', 'Ã¶merpaÅŸa cad Ã¶zlem', 'gÃ¶ztepe', '34730', 'kadÄ±kÃ¶y', '1', 215, 182),
(4, 1, '', 'ASN-2', 'Kadir', 'Korkmaz', 'Ã¶merpaÅŸa cad Ã¶zlem apt', 'gÃ¶ztepe', '34730', 'kadÄ±kÃ¶y', '27', 215, 214),
(9, 1, '', 'ASN 7', 'Kadir', 'Korkmaz', 'Ã–merpaÅŸa Cad. Ã–zlem Apt 53A D1', 'GÃ¶ztepe', '34730', 'KadÄ±kÃ¶y', '34', 215, 221),
(16, 1, '', 'ASN9', 'kadir13', 'korkmaz', 'aaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaa', '4444444', 'aaaaaaaaaaaaaa', 'unknown', 199, 0),
(20, 1, 'm', 'aaaaaaaaaaaa', 'kadir18', 'korkmaz', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaa', '3333333333', 'aaaaaaaaaaaaa', '', 223, 29),
(21, 1, '', 'ASN-J', 'KADiR2', 'korkmaz', 'aaaaaaaaaaaa sdsd', 'aaaaaaa', '3333333333', 'aaaaaaaaaaaaaaa', '27', 215, 214),
(24, 1, '', 'aaaaaaaaaaa', 'KADiR5', 'korkmaz', 'aaaaaaaaaaaaaaa', 'aaaaaaaaaaaaa', '4444444444', 'aaaaaaaaaaaaaa', 'FL', 223, 18),
(25, 1, '', 'ooooooooooooooooo', 'KadirYeni', 'Korkmaz', 'ooooooooooooooooo', 'aaaaa', '3333333', 'aaaaaaaaaa', '', 223, 19),
(26, 1, '', 'AAA', 'Kad', 'Korkmaz', 'aaaaaaaaaaaaaaaa', 'aaaaaaaaaaa', '2222222', 'aaaaaaa', '', 223, 7),
(27, 1, '', 'AAA', 'Kad2', 'Korkmaz', 'aaaaaaaaaaaaaaaa', 'aaaaaaaaaaa', '2222222', 'aaaaaaa', '', 223, 7),
(28, 1, '', 'AAB', 'KAD3', 'Korkmaz', 'akakakakaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaa', '', 223, 7),
(29, 1, '', 'AAB', 'KAD3', 'Korkmaz', 'akakakakaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaa', '', 223, 7),
(30, 1, '', 'A...', 'Kadir6Y', 'Korkmaz', 'aaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaa', '33333333', 'aaaaaaaa', '', 223, 4),
(31, 1, '', 'A...a', 'Kadir6Y', 'Korkmaz', 'aaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'aaaaaaaaaaaaaaaaa', '3333333333', 'aaaaaaaaaa', '', 223, 4),
(35, 1, '', 'asdsdsadsad', 'Kadir7Y', 'asdsadsa', 'asdsadsadsadasdasdasd', 'asdsadsad', '34343', 'adsda', '', 223, 1),
(36, 1, '', 'asdsdsadsad', 'Kadir7Y', 'asdsadsa', 'asdsadsadsadasdasdasd asd', 'asdsadsad', '34343', 'asdsadsadas', '', 223, 1),
(37, 1, '', 'asdsdsadsad', 'Kadir7Y', 'asdsadsa', 'asdsadsadsadasdasdasd asd', 'asdsadsad', '34343', 'asdsadsadas', '', 223, 1),
(38, 1, '', 'ABC Inc.', 'Kadir-R', 'Korkmaz', 'a a a aa a a a aa a aa a', 'vvvvv', '4334343', 'assadsadad', '', 223, 43),
(39, 1, '', 'A-B-C', 'KadirP', 'Korkmaz', 'asda dasd adsaas sd adsaasd', 'asdasdasda', '3333333', 'aaaaaaa', 'DC', 223, 16),
(40, 1, '', 'YENI', 'Kadir', 'Korkmaz', 'omerpasa cad ozlem', 'goztepe', '2222222', 'kadikoy', '', 215, 209),
(42, 3, '-', '----------------', '---', '---', '---', '---', '---', '---', '---', 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `address_format`
--

CREATE TABLE IF NOT EXISTS `address_format` (
  `address_format_id` int(11) NOT NULL AUTO_INCREMENT,
  `address_format` varchar(128) NOT NULL,
  `address_summary` varchar(48) NOT NULL,
  PRIMARY KEY (`address_format_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Tablo döküm verisi `address_format`
--

INSERT INTO `address_format` (`address_format_id`, `address_format`, `address_summary`) VALUES
(1, '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country', '$city / $country'),
(2, '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country'),
(3, '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$state / $country'),
(4, '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country'),
(5, '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `administrators`
--

CREATE TABLE IF NOT EXISTS `administrators` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(32) CHARACTER SET latin1 COLLATE latin1_bin NOT NULL,
  `user_password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `banners`
--

CREATE TABLE IF NOT EXISTS `banners` (
  `banners_id` int(11) NOT NULL AUTO_INCREMENT,
  `banners_title` varchar(64) NOT NULL,
  `banners_url` varchar(255) NOT NULL,
  `banners_image` varchar(64) NOT NULL,
  `banners_group` varchar(10) NOT NULL,
  `banners_html_text` text,
  `expires_impressions` int(7) DEFAULT '0',
  `expires_date` datetime DEFAULT NULL,
  `date_scheduled` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`banners_id`),
  KEY `idx_banners_group` (`banners_group`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `banners`
--

INSERT INTO `banners` (`banners_id`, `banners_title`, `banners_url`, `banners_image`, `banners_group`, `banners_html_text`, `expires_impressions`, `expires_date`, `date_scheduled`, `date_added`, `date_status_change`, `status`) VALUES
(1, 'osCommerce', 'http://www.oscommerce.com', 'banners/oscommerce.gif', '468x50', '', 0, NULL, NULL, '2013-08-07 14:38:03', NULL, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `banners_history`
--

CREATE TABLE IF NOT EXISTS `banners_history` (
  `banners_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `banners_id` int(11) NOT NULL,
  `banners_shown` int(5) NOT NULL DEFAULT '0',
  `banners_clicked` int(5) NOT NULL DEFAULT '0',
  `banners_history_date` datetime NOT NULL,
  PRIMARY KEY (`banners_history_id`),
  KEY `idx_banners_history_banners_id` (`banners_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `categories`
--

CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_image` varchar(64) DEFAULT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `sort_order` int(3) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`categories_id`),
  KEY `idx_categories_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Tablo döküm verisi `categories`
--



-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `categories_description`
--

CREATE TABLE IF NOT EXISTS `categories_description` (
  `categories_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `categories_name` varchar(32) NOT NULL,
  `categories_htc_title_tag` varchar(80) DEFAULT NULL,
  `categories_htc_desc_tag` longtext,
  `categories_htc_keywords_tag` longtext,
  `categories_htc_description` longtext,
  PRIMARY KEY (`categories_id`,`language_id`),
  KEY `idx_categories_name` (`categories_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `categories_description`
--



-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `configuration`
--

CREATE TABLE IF NOT EXISTS `configuration` (
  `configuration_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_title` varchar(255) NOT NULL,
  `configuration_key` varchar(255) NOT NULL,
  `configuration_value` varchar(255) NOT NULL,
  `configuration_description` varchar(255) NOT NULL,
  `configuration_group_id` int(11) NOT NULL,
  `sort_order` int(5) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `use_function` varchar(255) DEFAULT NULL,
  `set_function` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`configuration_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=584 ;

--
-- Tablo döküm verisi `configuration`
--

INSERT INTO `configuration` (`configuration_id`, `configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
(1, 'Store Name', 'STORE_NAME', 'WOSCI SHOP', 'The name of my store', 1, 1, '2013-11-07 00:39:20', '2013-08-07 14:38:03', NULL, NULL),
(2, 'Store Owner', 'STORE_OWNER', 'Harald Ponce de Leon', 'The name of my store owner', 1, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(3, 'E-Mail Address', 'STORE_OWNER_EMAIL_ADDRESS', 'root@localhostza', 'The e-mail address of my store owner', 1, 3, '2013-11-05 19:36:44', '2013-08-07 14:38:03', NULL, NULL),
(4, 'E-Mail From', 'EMAIL_FROM', 'osCommerce <root@localhost>', 'The e-mail address used in (sent) e-mails', 1, 4, NULL, '2013-08-07 14:38:03', NULL, NULL),
(5, 'Country', 'STORE_COUNTRY', '199', 'The country my store is located in <br><br><b>Note: Please remember to update the store zone.</b>', 1, 6, '2013-11-05 19:29:19', '2013-08-07 14:38:03', 'tep_get_country_name', 'tep_cfg_pull_down_country_list('),
(6, 'Zone', 'STORE_ZONE', '182', 'The zone my store is located in', 1, 7, '2013-11-05 19:28:39', '2013-08-07 14:38:03', 'tep_cfg_get_zone_name', 'tep_cfg_pull_down_zone_list('),
(7, 'Expected Sort Order', 'EXPECTED_PRODUCTS_SORT', 'desc', 'This is the sort order used in the expected products box.', 1, 8, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''asc'', ''desc''), '),
(8, 'Expected Sort Field', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'The column to sort by in the expected products box.', 1, 9, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''products_name'', ''date_expected''), '),
(9, 'Switch To Default Language Currency', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Automatically switch to the language''s currency when it is changed', 1, 10, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(10, 'Send Extra Order Emails To', 'SEND_EXTRA_ORDER_EMAILS_TO', '', 'Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', 1, 11, NULL, '2013-08-07 14:38:03', NULL, NULL),
(11, 'Use Search-Engine Safe URLs (still in development)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', 'Use search-engine safe urls for all site links', 1, 12, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(12, 'Display Cart After Adding Product', 'DISPLAY_CART', 'true', 'Display the shopping cart after adding a product (or return back to their origin)', 1, 14, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(13, 'Allow Guest To Tell A Friend', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', 'Allow guests to tell a friend about a product', 1, 15, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(14, 'Default Search Operator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Default search operators', 1, 17, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''and'', ''or''), '),
(15, 'Store Address and Phone', 'STORE_NAME_ADDRESS', 'Store Name\r\nAddress\r\nCountry\r\nPhone &#9742;', 'This is the Store Name, Address and Phone used on printable documents and displayed online', 1, 18, '2013-11-06 21:53:15', '2013-08-07 14:38:03', NULL, 'tep_cfg_textarea('),
(16, 'Show Category Counts', 'SHOW_COUNTS', 'true', 'Count recursively how many products are in each category', 1, 19, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(17, 'Tax Decimal Places', 'TAX_DECIMAL_PLACES', '0', 'Pad the tax value this amount of decimal places', 1, 20, NULL, '2013-08-07 14:38:03', NULL, NULL),
(18, 'Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'true', 'Display prices with tax included (true) or add the tax at the end (false)', 1, 21, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(19, 'First Name', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Minimum length of first name', 2, 1, NULL, '2013-08-07 14:38:03', NULL, NULL),
(20, 'Last Name', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Minimum length of last name', 2, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(21, 'Date of Birth', 'ENTRY_DOB_MIN_LENGTH', '10', 'Minimum length of date of birth', 2, 3, NULL, '2013-08-07 14:38:03', NULL, NULL),
(22, 'E-Mail Address', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Minimum length of e-mail address', 2, 4, NULL, '2013-08-07 14:38:03', NULL, NULL),
(23, 'Street Address', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Minimum length of street address', 2, 5, NULL, '2013-08-07 14:38:03', NULL, NULL),
(24, 'Company', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Minimum length of company name', 2, 6, NULL, '2013-08-07 14:38:03', NULL, NULL),
(25, 'Post Code', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Minimum length of post code', 2, 7, NULL, '2013-08-07 14:38:03', NULL, NULL),
(26, 'City', 'ENTRY_CITY_MIN_LENGTH', '3', 'Minimum length of city', 2, 8, NULL, '2013-08-07 14:38:03', NULL, NULL),
(27, 'State', 'ENTRY_STATE_MIN_LENGTH', '2', 'Minimum length of state', 2, 9, NULL, '2013-08-07 14:38:03', NULL, NULL),
(28, 'Telephone Number', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Minimum length of telephone number', 2, 10, NULL, '2013-08-07 14:38:03', NULL, NULL),
(29, 'Password', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Minimum length of password', 2, 11, NULL, '2013-08-07 14:38:03', NULL, NULL),
(30, 'Credit Card Owner Name', 'CC_OWNER_MIN_LENGTH', '3', 'Minimum length of credit card owner name', 2, 12, NULL, '2013-08-07 14:38:03', NULL, NULL),
(31, 'Credit Card Number', 'CC_NUMBER_MIN_LENGTH', '10', 'Minimum length of credit card number', 2, 13, NULL, '2013-08-07 14:38:03', NULL, NULL),
(32, 'Review Text', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Minimum length of review text', 2, 14, NULL, '2013-08-07 14:38:03', NULL, NULL),
(33, 'Best Sellers', 'MIN_DISPLAY_BESTSELLERS', '1', 'Minimum number of best sellers to display', 2, 15, NULL, '2013-08-07 14:38:03', NULL, NULL),
(34, 'Also Purchased', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Minimum number of products to display in the ''This Customer Also Purchased'' box', 2, 16, NULL, '2013-08-07 14:38:03', NULL, NULL),
(35, 'Address Book Entries', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Maximum address book entries a customer is allowed to have', 3, 1, NULL, '2013-08-07 14:38:03', NULL, NULL),
(36, 'Search Results', 'MAX_DISPLAY_SEARCH_RESULTS', '20', 'Amount of products to list', 3, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(37, 'Page Links', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Number of ''number'' links use for page-sets', 3, 3, NULL, '2013-08-07 14:38:03', NULL, NULL),
(38, 'Special Products', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '9', 'Maximum number of products on special to display', 3, 4, NULL, '2013-08-07 14:38:03', NULL, NULL),
(39, 'New Products Module', 'MAX_DISPLAY_NEW_PRODUCTS', '9', 'Maximum number of new products to display in a category', 3, 5, NULL, '2013-08-07 14:38:03', NULL, NULL),
(40, 'Products Expected', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '10', 'Maximum number of products expected to display', 3, 6, NULL, '2013-08-07 14:38:03', NULL, NULL),
(41, 'Manufacturers List', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', 'Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list', 3, 7, NULL, '2013-08-07 14:38:03', NULL, NULL),
(42, 'Manufacturers Select Size', 'MAX_MANUFACTURERS_LIST', '1', 'Used in manufacturers box; when this value is ''1'' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.', 3, 7, NULL, '2013-08-07 14:38:03', NULL, NULL),
(43, 'Length of Manufacturers Name', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Used in manufacturers box; maximum length of manufacturers name to display', 3, 8, NULL, '2013-08-07 14:38:03', NULL, NULL),
(44, 'New Reviews', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Maximum number of new reviews to display', 3, 9, NULL, '2013-08-07 14:38:03', NULL, NULL),
(45, 'Selection of Random Reviews', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'How many records to select from to choose one random product review', 3, 10, NULL, '2013-08-07 14:38:03', NULL, NULL),
(46, 'Selection of Random New Products', 'MAX_RANDOM_SELECT_NEW', '10', 'How many records to select from to choose one random new product to display', 3, 11, NULL, '2013-08-07 14:38:03', NULL, NULL),
(47, 'Selection of Products on Special', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'How many records to select from to choose one random product special to display', 3, 12, NULL, '2013-08-07 14:38:03', NULL, NULL),
(48, 'Categories To List Per Row', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', 'How many categories to list per row', 3, 13, NULL, '2013-08-07 14:38:03', NULL, NULL),
(49, 'New Products Listing', 'MAX_DISPLAY_PRODUCTS_NEW', '10', 'Maximum number of new products to display in new products page', 3, 14, NULL, '2013-08-07 14:38:03', NULL, NULL),
(50, 'Best Sellers', 'MAX_DISPLAY_BESTSELLERS', '10', 'Maximum number of best sellers to display', 3, 15, NULL, '2013-08-07 14:38:03', NULL, NULL),
(51, 'Also Purchased', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Maximum number of products to display in the ''This Customer Also Purchased'' box', 3, 16, NULL, '2013-08-07 14:38:03', NULL, NULL),
(52, 'Customer Order History Box', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Maximum number of products to display in the customer order history box', 3, 17, NULL, '2013-08-07 14:38:03', NULL, NULL),
(53, 'Order History', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Maximum number of orders to display in the order history page', 3, 18, NULL, '2013-08-07 14:38:03', NULL, NULL),
(54, 'Product Quantities In Shopping Cart', 'MAX_QTY_IN_CART', '99', 'Maximum number of product quantities that can be added to the shopping cart (0 for no limit)', 3, 19, NULL, '2013-08-07 14:38:03', NULL, NULL),
(55, 'Small Image Width', 'SMALL_IMAGE_WIDTH', '100', 'The pixel width of small images', 4, 1, NULL, '2013-08-07 14:38:03', NULL, NULL),
(56, 'Small Image Height', 'SMALL_IMAGE_HEIGHT', '80', 'The pixel height of small images', 4, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(57, 'Heading Image Width', 'HEADING_IMAGE_WIDTH', '57', 'The pixel width of heading images', 4, 3, NULL, '2013-08-07 14:38:03', NULL, NULL),
(58, 'Heading Image Height', 'HEADING_IMAGE_HEIGHT', '40', 'The pixel height of heading images', 4, 4, NULL, '2013-08-07 14:38:03', NULL, NULL),
(59, 'Subcategory Image Width', 'SUBCATEGORY_IMAGE_WIDTH', '100', 'The pixel width of subcategory images', 4, 5, NULL, '2013-08-07 14:38:03', NULL, NULL),
(60, 'Subcategory Image Height', 'SUBCATEGORY_IMAGE_HEIGHT', '57', 'The pixel height of subcategory images', 4, 6, NULL, '2013-08-07 14:38:03', NULL, NULL),
(61, 'Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', 4, 7, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(62, 'Image Required', 'IMAGE_REQUIRED', 'true', 'Enable to display broken images. Good for development.', 4, 8, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(63, 'Gender', 'ACCOUNT_GENDER', 'true', 'Display gender in the customers account', 5, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(64, 'Date of Birth', 'ACCOUNT_DOB', 'true', 'Display date of birth in the customers account', 5, 2, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(65, 'Company', 'ACCOUNT_COMPANY', 'true', 'Display company in the customers account', 5, 3, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(66, 'Suburb', 'ACCOUNT_SUBURB', 'true', 'Display suburb in the customers account', 5, 4, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(67, 'State', 'ACCOUNT_STATE', 'true', 'Display state in the customers account', 5, 5, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(68, 'Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'authorizenet_cc_aim.php;cc.php;chronopay.php;cod.php;moneyorder.php;nochex.php;paypal_standard.php', 'List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cc.php;cod.php;paypal.php)', 6, 0, '2013-10-11 23:15:08', '2013-08-07 14:38:03', NULL, NULL),
(69, 'Installed Modules', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_shipping.php;ot_tax.php;ot_total.php;ot_fixed_payment_chg.php', 'List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', 6, 0, '2013-10-09 07:14:52', '2013-08-07 14:38:03', NULL, NULL),
(70, 'Installed Modules', 'MODULE_SHIPPING_INSTALLED', 'flat.php;item.php;table.php;usps.php;zones.php', 'List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)', 6, 0, '2013-11-17 00:46:56', '2013-08-07 14:38:03', NULL, NULL),
(71, 'Enable Cash On Delivery Module', 'MODULE_PAYMENT_COD_STATUS', 'True', 'Do you want to accept Cash On Delevery payments?', 6, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(72, 'Payment Zone', 'MODULE_PAYMENT_COD_ZONE', '1', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2013-08-07 14:38:03', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(73, 'Sort order of display.', 'MODULE_PAYMENT_COD_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2013-08-07 14:38:03', NULL, NULL),
(74, 'Set Order Status', 'MODULE_PAYMENT_COD_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2013-08-07 14:38:03', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses('),
(80, 'Enable Flat Shipping', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Do you want to offer flat rate shipping?', 6, 0, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(81, 'Shipping Cost', 'MODULE_SHIPPING_FLAT_COST', '15.00', 'The shipping cost for all orders using this shipping method.', 6, 0, NULL, '2013-08-07 14:38:03', NULL, NULL),
(82, 'Tax Class', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', 6, 0, NULL, '2013-08-07 14:38:03', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes('),
(83, 'Shipping Zone', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', 6, 0, NULL, '2013-08-07 14:38:03', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(84, 'Sort Order', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '0', 'Sort order of display.', 6, 0, NULL, '2013-08-07 14:38:03', NULL, NULL),
(85, 'Default Currency', 'DEFAULT_CURRENCY', 'USD', 'Default Currency', 6, 0, NULL, '2013-08-07 14:38:03', NULL, NULL),
(86, 'Default Language', 'DEFAULT_LANGUAGE', 'en', 'Default Language', 6, 0, NULL, '2013-08-07 14:38:03', NULL, NULL),
(87, 'Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', 6, 0, NULL, '2013-08-07 14:38:03', NULL, NULL),
(88, 'Display Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', 'Do you want to display the order shipping cost?', 6, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(89, 'Sort Order', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '2', 'Sort order of display.', 6, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(90, 'Allow Free Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'true', 'Do you want to allow free shipping?', 6, 3, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(91, 'Free Shipping For Orders Over', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '600', 'Provide free shipping for orders over the set amount.', 6, 4, NULL, '2013-08-07 14:38:03', 'currencies->format', NULL),
(92, 'Provide Free Shipping For Orders Made', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'Provide free shipping for orders sent to the set destination.', 6, 5, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''national'', ''international'', ''both''), '),
(93, 'Display Sub-Total', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', 'Do you want to display the order sub-total cost?', 6, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(94, 'Sort Order', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', 'Sort order of display.', 6, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(95, 'Display Tax', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', 'Do you want to display the order tax value?', 6, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(96, 'Sort Order', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '3', 'Sort order of display.', 6, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(97, 'Display Total', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', 'Do you want to display the total order value?', 6, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(98, 'Sort Order', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '4', 'Sort order of display.', 6, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(99, 'Country of Origin', 'SHIPPING_ORIGIN_COUNTRY', '223', 'Select the country of origin to be used in shipping quotes.', 7, 1, NULL, '2013-08-07 14:38:03', 'tep_get_country_name', 'tep_cfg_pull_down_country_list('),
(100, 'Postal Code', 'SHIPPING_ORIGIN_ZIP', 'NONE', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.', 7, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(101, 'Enter the Maximum Package Weight you will ship', 'SHIPPING_MAX_WEIGHT', '50', 'Carriers have a max weight limit for a single package. This is a common one for all.', 7, 3, NULL, '2013-08-07 14:38:03', NULL, NULL),
(102, 'Package Tare weight.', 'SHIPPING_BOX_WEIGHT', '3', 'What is the weight of typical packaging of small to medium packages?', 7, 4, NULL, '2013-08-07 14:38:03', NULL, NULL),
(103, 'Larger packages - percentage increase.', 'SHIPPING_BOX_PADDING', '10', 'For 10% enter 10', 7, 5, NULL, '2013-08-07 14:38:03', NULL, NULL),
(104, 'Display Product Image', 'PRODUCT_LIST_IMAGE', '1', 'Do you want to display the Product Image?', 8, 1, NULL, '2013-08-07 14:38:03', NULL, NULL),
(105, 'Display Product Manufaturer Name', 'PRODUCT_LIST_MANUFACTURER', '0', 'Do you want to display the Product Manufacturer Name?', 8, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(106, 'Display Product Model', 'PRODUCT_LIST_MODEL', '0', 'Do you want to display the Product Model?', 8, 3, NULL, '2013-08-07 14:38:03', NULL, NULL),
(107, 'Display Product Name', 'PRODUCT_LIST_NAME', '2', 'Do you want to display the Product Name?', 8, 4, NULL, '2013-08-07 14:38:03', NULL, NULL),
(108, 'Display Product Price', 'PRODUCT_LIST_PRICE', '3', 'Do you want to display the Product Price', 8, 5, NULL, '2013-08-07 14:38:03', NULL, NULL),
(109, 'Display Product Quantity', 'PRODUCT_LIST_QUANTITY', '0', 'Do you want to display the Product Quantity?', 8, 6, NULL, '2013-08-07 14:38:03', NULL, NULL),
(110, 'Display Product Weight', 'PRODUCT_LIST_WEIGHT', '0', 'Do you want to display the Product Weight?', 8, 7, NULL, '2013-08-07 14:38:03', NULL, NULL),
(111, 'Display Buy Now column', 'PRODUCT_LIST_BUY_NOW', '4', 'Do you want to display the Buy Now column?', 8, 8, NULL, '2013-08-07 14:38:03', NULL, NULL),
(112, 'Display Category/Manufacturer Filter (0=disable; 1=enable)', 'PRODUCT_LIST_FILTER', '1', 'Do you want to display the Category/Manufacturer Filter?', 8, 9, NULL, '2013-08-07 14:38:03', NULL, NULL),
(113, 'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 'PREV_NEXT_BAR_LOCATION', '2', 'Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 8, 10, NULL, '2013-08-07 14:38:03', NULL, NULL),
(114, 'Check stock level', 'STOCK_CHECK', 'false', 'Check to see if sufficent stock is available', 9, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(115, 'Subtract stock', 'STOCK_LIMITED', 'true', 'Subtract product in stock by product orders', 9, 2, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(116, 'Allow Checkout', 'STOCK_ALLOW_CHECKOUT', 'true', 'Allow customer to checkout even if there is insufficient stock', 9, 3, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(117, 'Mark product out of stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Display something on screen so customer can see which product has insufficient stock', 9, 4, NULL, '2013-08-07 14:38:03', NULL, NULL),
(118, 'Stock Re-order level', 'STOCK_REORDER_LEVEL', '5', 'Define when stock needs to be re-ordered', 9, 5, NULL, '2013-08-07 14:38:03', NULL, NULL),
(119, 'Store Page Parse Time', 'STORE_PAGE_PARSE_TIME', 'false', 'Store the time it takes to parse a page', 10, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(120, 'Log Destination', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/tep/page_parse_time.log', 'Directory and filename of the page parse time log', 10, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(121, 'Log Date Format', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'The date format', 10, 3, NULL, '2013-08-07 14:38:03', NULL, NULL),
(122, 'Display The Page Parse Time', 'DISPLAY_PAGE_PARSE_TIME', 'true', 'Display the page parse time (store page parse time must be enabled)', 10, 4, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(123, 'Store Database Queries', 'STORE_DB_TRANSACTIONS', 'false', 'Store the database queries in the page parse time log (PHP4 only)', 10, 5, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(124, 'Use Cache', 'USE_CACHE', 'false', 'Use caching features', 11, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(125, 'Cache Directory', 'DIR_FS_CACHE', '/tmp/', 'The directory where the cached files are saved', 11, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(126, 'E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.', 12, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''sendmail'', ''smtp''),'),
(127, 'E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', 12, 2, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''LF'', ''CRLF''),'),
(128, 'Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', 12, 3, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''),'),
(129, 'Verify E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verify e-mail address through a DNS server', 12, 4, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(130, 'Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', 12, 5, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(131, 'Enable download', 'DOWNLOAD_ENABLED', 'false', 'Enable the products download functions.', 13, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(132, 'Download by redirect', 'DOWNLOAD_BY_REDIRECT', 'false', 'Use browser redirection for download. Disable on non-Unix systems.', 13, 2, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(133, 'Expiry delay (days)', 'DOWNLOAD_MAX_DAYS', '7', 'Set number of days before the download link expires. 0 means no limit.', 13, 3, NULL, '2013-08-07 14:38:03', NULL, ''),
(134, 'Maximum number of downloads', 'DOWNLOAD_MAX_COUNT', '5', 'Set the maximum number of downloads. 0 means no download authorized.', 13, 4, NULL, '2013-08-07 14:38:03', NULL, ''),
(135, 'Enable GZip Compression', 'GZIP_COMPRESSION', 'false', 'Enable HTTP GZip compression.', 14, 1, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(136, 'Compression Level', 'GZIP_LEVEL', '5', 'Use this compression level 0-9 (0 = minimum, 9 = maximum).', 14, 2, NULL, '2013-08-07 14:38:03', NULL, NULL),
(137, 'Session Directory', 'SESSION_WRITE_DIRECTORY', '/tmp', 'If sessions are file based, store them in this directory.', 15, 1, NULL, '2013-08-07 14:38:03', NULL, NULL),
(138, 'Force Cookie Use', 'SESSION_FORCE_COOKIE_USE', 'False', 'Force the use of sessions when cookies are only enabled.', 15, 2, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(139, 'Check SSL Session ID', 'SESSION_CHECK_SSL_SESSION_ID', 'False', 'Validate the SSL_SESSION_ID on every secure HTTPS page request.', 15, 3, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(140, 'Check User Agent', 'SESSION_CHECK_USER_AGENT', 'False', 'Validate the clients browser user agent on every page request.', 15, 4, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(141, 'Check IP Address', 'SESSION_CHECK_IP_ADDRESS', 'False', 'Validate the clients IP address on every page request.', 15, 5, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(142, 'Prevent Spider Sessions', 'SESSION_BLOCK_SPIDERS', 'True', 'Prevent known spiders from starting a session.', 15, 6, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(143, 'Recreate Session', 'SESSION_RECREATE', 'False', 'Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).', 15, 7, NULL, '2013-08-07 14:38:03', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(144, 'Automatically Add New Pages', 'HEADER_TAGS_AUTO_ADD_PAGES', 'true', 'Adds any new pages when Page Control is accessed<br>(true=on false=off)', 543, 3, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(145, 'Check for Missing Tags', 'HEADER_TAGS_CHECK_TAGS', 'true', 'Check to see if any products, categories or manufacturers contain empty meta tag fields<br>(true=on false=off)', 543, 6, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(146, 'Clear Cache', 'HEADER_TAGS_CLEAR_CACHE', 'false', 'Remove all Header Tags cache entries from the database.', 543, 9, NULL, '2013-08-07 14:38:05', 'header_tags_reset_cache', 'tep_cfg_select_option(array(''clear'', ''false''), '),
(147, 'Display Category Parents in Title and Tags', 'HEADER_TAGS_ADD_CATEGORY_PARENTS', 'Standard', 'Adds all categories in the current path (Full), all immediate categories if the product is in more than one category (Duplicate) or only the immediate category (Standard). These settings only work if the Category checkbox is enabled in Page Control.', 543, 12, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''Full Category Path'', ''Duplicate Categories'', ''Standard''), '),
(148, 'Display Column Box', 'HEADER_TAGS_DISPLAY_COLUMN_BOX', 'false', 'Display product box in column while on product page<br>(true=on false=off)', 543, 15, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(149, 'Disable Permission Warning', 'HEADER_TAGS_DIABLE_PERMISSION_WARNING', 'false', 'Prevent the warning that appears if the permissions for the includes/header_tags.php file appear to be incoorect.<br>(true=on false=off)', 543, 18, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(150, 'Display Help Popups', 'HEADER_TAGS_DISPLAY_HELP_POPUPS', 'true', 'Display short popup messages that describes a feature<br>(true=on false=off)', 543, 21, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(151, 'Display Silo Links', 'HEADER_TAGS_DISPLAY_SILO_BOX', 'false', 'Display a box displaying links based on the settings in Silo Control<br>(true=on false=off)', 543, 24, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(152, 'Display Social Bookmark', 'HEADER_TAGS_DISPLAY_SOCIAL_BOOKMARKS', 'false', 'Display social bookmarks on the product page<br>(true=on false=off)', 543, 27, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(153, 'Enable Cache', 'HEADER_TAGS_ENABLE_CACHE', 'GZip', 'Enables cache for Header Tags. The GZip option will use gzip to try to increase speed but may be a little slower if the Header Tags data is small.', 543, 30, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''None'', ''Normal'', ''GZip''),'),
(154, 'Enable an HTML Editor', 'HEADER_TAGS_ENABLE_HTML_EDITOR', 'No Editor', 'Use an HTML editor, if selected. !!! Warning !!! The selected editor must be installed for it to work!!!)', 543, 34, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''CKEditor'', ''FCKEditor'', ''TinyMCE'', ''No Editor''),'),
(155, 'Enable HTML Editor for Category Descriptions', 'HEADER_TAGS_ENABLE_EDITOR_CATEGORIES', 'false', 'Enables the selected HTML editor for the categories description box. The editor must be installed for this to work.', 543, 39, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(156, 'Enable HTML Editor for Meta Descriptions', 'HEADER_TAGS_ENABLE_EDITOR_META_DESC', 'false', 'Enables the selected HTML editor for the meta tag description box. The editor must be installed for this to work.', 543, 43, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(157, 'Enable HTML Editor for Products', 'HEADER_TAGS_ENABLE_EDITOR_PRODUCTS', 'false', 'Enables the selected HTML editor for the products description box. The editor must be installed for this to work.', 543, 47, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(158, 'Enable Version Checker', 'HEADER_TAGS_ENABLE_VERSION_CHECKER', 'false', 'Enables the code that checks if updates are available.', 543, 51, NULL, '2013-08-07 14:38:05', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(159, 'Keyword Density Range', 'HEADER_TAGS_KEYWORD_DENSITY_RANGE', '0.02,0.06', 'Set the limits for the keyword density use to dynamically select the keywords. Enter two figures, separated by a comma', 543, 54, NULL, '2013-08-07 14:38:05', NULL, NULL),
(160, 'Separator - Description', 'HEADER_TAGS_SEPARATOR_DESCRIPTION', '-', 'Set the separator to be used for the description (and titles and logo).', 543, 57, NULL, '2013-08-07 14:38:05', NULL, NULL),
(161, 'Separator - Keywords', 'HEADER_TAGS_SEPARATOR_KEYWORD', ',', 'Set the separator to be used for the keywords.', 543, 60, NULL, '2013-08-07 14:38:05', NULL, NULL),
(162, 'Enable Credit Card Module', 'MODULE_PAYMENT_CC_STATUS', 'True', 'Do you want to accept credit card payments?', 6, 0, NULL, '2013-09-20 12:32:29', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(163, 'Split Credit Card E-Mail Address', 'MODULE_PAYMENT_CC_EMAIL', '', 'If an e-mail address is entered, the middle digits of the credit card number will be sent to the e-mail address (the outside digits are stored in the database with the middle digits censored)', 6, 0, NULL, '2013-09-20 12:32:29', NULL, NULL),
(164, 'Sort order of display.', 'MODULE_PAYMENT_CC_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2013-09-20 12:32:29', NULL, NULL),
(165, 'Payment Zone', 'MODULE_PAYMENT_CC_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2013-09-20 12:32:29', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(166, 'Set Order Status', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2013-09-20 12:32:29', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses('),
(198, 'Installed Modules', '', '', 'This is automatically updated. No need to edit.', 6, 0, NULL, '2013-10-08 20:42:57', NULL, NULL),
(396, 'Enable Check/Money Order Module', 'MODULE_PAYMENT_MONEYORDER_STATUS', 'True', 'Do you want to accept Check/Money Order payments?', 6, 1, NULL, '2013-10-09 01:23:01', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(397, 'Make Payable to:', 'MODULE_PAYMENT_MONEYORDER_PAYTO', '', 'Who should payments be made payable to?', 6, 1, NULL, '2013-10-09 01:23:01', NULL, NULL),
(398, 'Sort order of display.', 'MODULE_PAYMENT_MONEYORDER_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2013-10-09 01:23:01', NULL, NULL),
(399, 'Payment Zone', 'MODULE_PAYMENT_MONEYORDER_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2013-10-09 01:23:01', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(400, 'Set Order Status', 'MODULE_PAYMENT_MONEYORDER_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2013-10-09 01:23:01', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses('),
(401, 'Enable ChronoPay', 'MODULE_PAYMENT_CHRONOPAY_STATUS', 'False', 'Do you want to accept ChronoPay payments?', 6, 3, NULL, '2013-10-09 01:23:46', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(402, 'ChronoPay Product ID', 'MODULE_PAYMENT_CHRONOPAY_PRODUCT_ID', '', 'The product ID to assign transactions to.', 6, 4, NULL, '2013-10-09 01:23:46', NULL, NULL),
(403, 'MD5 Hash Signature', 'MODULE_PAYMENT_CHRONOPAY_MD5_HASH', '', 'Use this value to verify transactions with.', 6, 4, NULL, '2013-10-09 01:23:46', NULL, NULL),
(404, 'Payment Zone', 'MODULE_PAYMENT_CHRONOPAY_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2013-10-09 01:23:46', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(405, 'Set Preparing Order Status', 'MODULE_PAYMENT_CHRONOPAY_PREPARE_ORDER_STATUS_ID', '4', 'Set the status of prepared orders made with this payment module to this value', 6, 0, NULL, '2013-10-09 01:23:46', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses('),
(406, 'Set ChronoPay Acknowledged Order Status', 'MODULE_PAYMENT_CHRONOPAY_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2013-10-09 01:23:46', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses('),
(407, 'Sort order of display.', 'MODULE_PAYMENT_CHRONOPAY_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2013-10-09 01:23:46', NULL, NULL),
(428, 'Enable NOCHEX Module', 'MODULE_PAYMENT_NOCHEX_STATUS', 'True', 'Do you want to accept NOCHEX payments?', 6, 3, NULL, '2013-10-09 06:38:16', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(429, 'E-Mail Address', 'MODULE_PAYMENT_NOCHEX_ID', 'you@yourbuisness.com', 'The e-mail address to use for the NOCHEX service', 6, 4, NULL, '2013-10-09 06:38:16', NULL, NULL),
(430, 'Sort order of display.', 'MODULE_PAYMENT_NOCHEX_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2013-10-09 06:38:16', NULL, NULL),
(431, 'Payment Zone', 'MODULE_PAYMENT_NOCHEX_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2013-10-09 06:38:16', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(432, 'Set Order Status', 'MODULE_PAYMENT_NOCHEX_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2013-10-09 06:38:16', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses('),
(455, 'Enable PayPal Website Payments Standard', 'MODULE_PAYMENT_PAYPAL_STANDARD_STATUS', 'False', 'Do you want to accept PayPal Website Payments Standard payments?', 6, 3, NULL, '2013-10-09 06:47:36', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(456, 'E-Mail Address', 'MODULE_PAYMENT_PAYPAL_STANDARD_ID', '', 'The PayPal seller e-mail address to accept payments for', 6, 4, NULL, '2013-10-09 06:47:36', NULL, NULL),
(457, 'Sort order of display.', 'MODULE_PAYMENT_PAYPAL_STANDARD_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2013-10-09 06:47:36', NULL, NULL),
(458, 'Payment Zone', 'MODULE_PAYMENT_PAYPAL_STANDARD_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2013-10-09 06:47:36', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(459, 'Set Preparing Order Status', 'MODULE_PAYMENT_PAYPAL_STANDARD_PREPARE_ORDER_STATUS_ID', '5', 'Set the status of prepared orders made with this payment module to this value', 6, 0, NULL, '2013-10-09 06:47:36', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses('),
(460, 'Set PayPal Acknowledged Order Status', 'MODULE_PAYMENT_PAYPAL_STANDARD_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2013-10-09 06:47:36', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses('),
(461, 'Gateway Server', 'MODULE_PAYMENT_PAYPAL_STANDARD_GATEWAY_SERVER', 'Live', 'Use the testing (sandbox) or live gateway server for transactions?', 6, 6, NULL, '2013-10-09 06:47:36', NULL, 'tep_cfg_select_option(array(''Live'', ''Sandbox''), '),
(462, 'Transaction Method', 'MODULE_PAYMENT_PAYPAL_STANDARD_TRANSACTION_METHOD', 'Sale', 'The processing method to use for each transaction.', 6, 0, NULL, '2013-10-09 06:47:36', NULL, 'tep_cfg_select_option(array(''Authorization'', ''Sale''), '),
(463, 'Page Style', 'MODULE_PAYMENT_PAYPAL_STANDARD_PAGE_STYLE', '', 'The page style to use for the transaction procedure (defined at your PayPal Profile page)', 6, 4, NULL, '2013-10-09 06:47:36', NULL, NULL),
(464, 'Debug E-Mail Address', 'MODULE_PAYMENT_PAYPAL_STANDARD_DEBUG_EMAIL', '', 'All parameters of an Invalid IPN notification will be sent to this email address if one is entered.', 6, 4, NULL, '2013-10-09 06:47:36', NULL, NULL),
(465, 'Enable Encrypted Web Payments', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_STATUS', 'False', 'Do you want to enable Encrypted Web Payments?', 6, 3, NULL, '2013-10-09 06:47:36', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(466, 'Your Private Key', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PRIVATE_KEY', '', 'The location of your Private Key to use for signing the data. (*.pem)', 6, 4, NULL, '2013-10-09 06:47:36', NULL, NULL),
(467, 'Your Public Certificate', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PUBLIC_KEY', '', 'The location of your Public Certificate to use for signing the data. (*.pem)', 6, 4, NULL, '2013-10-09 06:47:36', NULL, NULL),
(468, 'PayPals Public Certificate', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_PAYPAL_KEY', '', 'The location of the PayPal Public Certificate for encrypting the data.', 6, 4, NULL, '2013-10-09 06:47:36', NULL, NULL),
(469, 'Your PayPal Public Certificate ID', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_CERT_ID', '', 'The Certificate ID to use from your PayPal Encrypted Payment Settings Profile.', 6, 4, NULL, '2013-10-09 06:47:36', NULL, NULL),
(470, 'Working Directory', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_WORKING_DIRECTORY', '', 'The working directory to use for temporary files. (trailing slash needed)', 6, 4, NULL, '2013-10-09 06:47:36', NULL, NULL),
(471, 'OpenSSL Location', 'MODULE_PAYMENT_PAYPAL_STANDARD_EWP_OPENSSL', '/usr/bin/openssl', 'The location of the openssl binary file.', 6, 4, NULL, '2013-10-09 06:47:36', NULL, NULL),
(490, 'ToplamÄ± GÃ¶ster', 'MODULE_FIXED_PAYMENT_CHG_STATUS', 'true', 'Ã–deme ÅŸekli masrafÄ± gÃ¶sterilsin mi?', 6, 1, NULL, '2013-10-09 07:14:51', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(491, 'SÄ±ralama DÃ¼zeni', 'MODULE_FIXED_PAYMENT_CHG_SORT_ORDER', '10', 'GÃ¶rÃ¼ntÃ¼leme iÃ§in sÄ±ralama dÃ¼zeni.', 6, 2, NULL, '2013-10-09 07:14:51', NULL, NULL),
(492, 'Ä°ndirim YÃ¼zdesi', 'MODULE_FIXED_PAYMENT_CHG_AMOUNT', '2', 'Ä°ndirim TutarÄ±.', 6, 7, NULL, '2013-10-09 07:14:51', NULL, NULL),
(493, 'Ã–deme Tipi FarkÄ±', 'MODULE_FIXED_PAYMENT_CHG_TYPE', 'garanti:0:%0', 'Ã–deme ÅŸekli masrafÄ± iÃ§in Ã¶deme ÅŸekillerine ait tanÄ±mlama', 6, 2, NULL, '2013-10-09 07:14:51', NULL, NULL),
(494, 'Fark TanÄ±mlarÄ±', 'MODULE_FIXED_PAYMENT_CHG_TYPE_DESCRIPTION', 'garanti:Taksitli Vade FarkÄ±', 'Ã–deme ÅŸekli masrafÄ± aÃ§Ä±klamasÄ±', 6, 3, NULL, '2013-10-09 07:14:51', NULL, NULL),
(495, 'Vergi Ekle', 'MODULE_FIXED_PAYMENT_CHG_TAX_CLASS', '0', 'Ã–deme ÅŸekli masrafÄ± iÃ§in aÅŸaÄŸÄ±daki vergi oranÄ± kullanÄ±lsÄ±n', 6, 6, NULL, '2013-10-09 07:14:51', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes('),
(496, 'DÃ¼ÅŸÃ¼k sipariÅŸ marjÄ±nÄ± gÃ¶ster', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'true', 'DÃ¼ÅŸÃ¼k sipariÅŸler iÃ§in ilave marj gÃ¶sterilsin mi?', 6, 1, NULL, '2013-10-09 08:10:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(497, 'SÄ±ralama DÃ¼zeni', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', '4', 'SÄ±ralama DÃ¼zeni.', 6, 2, NULL, '2013-10-09 08:10:22', NULL, NULL),
(498, 'DÃ¼ÅŸÃ¼k SipariÅŸ MarjÄ±nÄ± Aktif Et', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'false', 'DÃ¼ÅŸÃ¼k SipariÅŸ Marjini Aktif Etmek Ä°stiyormusunuz?', 6, 3, NULL, '2013-10-09 08:10:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''), '),
(499, 'Bu MiktarÄ± GeÃ§meyen SipariÅŸler Ä°Ã§in Ä°lave Marj', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', '50', 'Bu tutarÄ±n altÄ±ndaki sipariÅŸler iÃ§in ilave marj ekle.', 6, 4, NULL, '2013-10-09 08:10:22', 'currencies->format', NULL),
(500, 'SipariÅŸ Ek Marj', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', '5', 'DÃ¼ÅŸÃ¼k SipariÅŸ Ãœcreti.', 6, 5, NULL, '2013-10-09 08:10:22', 'currencies->format', NULL),
(501, 'DÃ¼ÅŸÃ¼k SipariÅŸ MarjÄ±nÄ± YalnÄ±z Åžuralar Ä°Ã§in GÃ¶ster', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'both', 'DÃ¼ÅŸÃ¼k sipariÅŸ marjÄ± hangi muÅŸteri bÃ¶lgeleri iÃ§in aktif olsun.', 6, 6, NULL, '2013-10-09 08:10:22', NULL, 'tep_cfg_select_option(array(''national'', ''international'', ''both''), '),
(502, 'Vergi', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', '0', 'Ä°lave marj iÃ§in aÅŸaÄŸÄ±daki vergi oranÄ±nÄ± kullan.', 6, 7, NULL, '2013-10-09 08:10:22', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes('),
(503, 'Enable Authorize.net Credit Card AIM', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_STATUS', 'False', 'Do you want to accept Authorize.net Credit Card AIM payments?', 6, 0, NULL, '2013-10-11 23:15:06', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(504, 'Login ID', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_LOGIN_ID', '', 'The login ID used for the Authorize.net service', 6, 0, NULL, '2013-10-11 23:15:06', NULL, NULL),
(505, 'Transaction Key', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_KEY', '', 'Transaction key used for encrypting data', 6, 0, NULL, '2013-10-11 23:15:06', NULL, NULL),
(506, 'MD5 Hash', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_MD5_HASH', '', 'The MD5 hash value to verify transactions with', 6, 0, NULL, '2013-10-11 23:15:06', NULL, NULL),
(507, 'Transaction Server', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_SERVER', 'Live', 'Perform transactions on the live or test server. The test server should only be used by developers with Authorize.net test accounts.', 6, 0, NULL, '2013-10-11 23:15:06', NULL, 'tep_cfg_select_option(array(''Live'', ''Test''), '),
(508, 'Transaction Mode', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_MODE', 'Live', 'Transaction mode used for processing orders', 6, 0, NULL, '2013-10-11 23:15:06', NULL, 'tep_cfg_select_option(array(''Live'', ''Test''), '),
(509, 'Transaction Method', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_METHOD', 'Authorization', 'The processing method to use for each transaction.', 6, 0, NULL, '2013-10-11 23:15:06', NULL, 'tep_cfg_select_option(array(''Authorization'', ''Capture''), '),
(510, 'Sort order of display.', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2013-10-11 23:15:06', NULL, NULL),
(511, 'Payment Zone', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2013-10-11 23:15:06', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(512, 'Set Order Status', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2013-10-11 23:15:06', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses('),
(513, 'cURL Program Location', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CURL', '/usr/bin/curl', 'The location to the cURL program application.', 6, 0, NULL, '2013-10-11 23:15:06', NULL, NULL),
(514, 'ParÃ§a BazÄ±nda Kargo', 'MODULE_SHIPPING_ITEM_STATUS', 'True', 'ParÃ§a bazÄ±nda kargo Ã¼cretlendirmesi aktif olsun mu?', 6, 0, NULL, '2013-11-17 00:35:17', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(515, 'Kargo Ãœcreti', 'MODULE_SHIPPING_ITEM_COST', '2.50', 'ParÃ§a baÅŸÄ± kargo seÃ§eneÄŸi tutarÄ± hesaplanÄ±rken  satÄ±n alÄ±nan Ã¼rÃ¼n adeti ile burada girilen tutar Ã§arpÄ±lacaktÄ±r.', 6, 0, NULL, '2013-11-17 00:35:17', NULL, NULL),
(516, 'HazÄ±rlama Ãœcreti', 'MODULE_SHIPPING_ITEM_HANDLING', '0', 'SipariÅŸe hazÄ±rlama Ã¼creti.', 6, 0, NULL, '2013-11-17 00:35:17', NULL, NULL),
(517, 'Vergi (KDV)', 'MODULE_SHIPPING_ITEM_TAX_CLASS', '0', 'Kargo tutarÄ±na aÅŸaÄŸÄ±daki vergi oranÄ±nÄ± ekle.', 6, 0, NULL, '2013-11-17 00:35:17', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes('),
(518, 'Kargo BÃ¶lgesi', 'MODULE_SHIPPING_ITEM_ZONE', '0', 'Kargo bÃ¶lgesi seÃ§ildiÄŸinde bu kargo ÅŸekli sadece seÃ§ilen bÃ¶lgede aktif olacaktÄ±r.', 6, 0, NULL, '2013-11-17 00:35:17', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(519, 'SÄ±ralama DÃ¼zeni', 'MODULE_SHIPPING_ITEM_SORT_ORDER', '0', 'GÃ¶rÃ¼ntÃ¼leme iÃ§in sÄ±ralama dÃ¼zeni.', 6, 0, NULL, '2013-11-17 00:35:17', NULL, NULL),
(552, 'Tablo Fiyat OranlarÄ±', 'MODULE_SHIPPING_TABLE_STATUS', 'True', 'Tablo fiyatÄ±ndan kargo Ã¼creti seÃ§eneÄŸi aktif olsun mu?', 6, 0, NULL, '2013-11-17 00:39:49', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(553, 'Tablo OranÄ±', 'MODULE_SHIPPING_TABLE_COST', '25:8.50,50:5.50,10000:0.00', 'Kargo Ã¼creti aÄŸÄ±rlÄ±k veya toplam sipariÅŸ tutarÄ±na gÃ¶re hesaplanÄ±r. Ã–rnek: 25:8.50,50:5.50,vb.. 25''e 8.5 hesaplar, oradan 50'' ye kadar 5.50 hesaplar, gibi...', 6, 0, NULL, '2013-11-17 00:39:49', NULL, NULL),
(554, 'Tablo OranÄ±', 'MODULE_SHIPPING_TABLE_MODE', 'weight', 'Kargo tutarÄ± aÄŸÄ±rlÄ±ÄŸa gÃ¶re veya toplam sipariÅŸ tutarÄ±na gÃ¶redir.', 6, 0, NULL, '2013-11-17 00:39:49', NULL, 'tep_cfg_select_option(array(''weight'', ''price''), '),
(555, 'HazÄ±rlÄ±k Ãœcreti', 'MODULE_SHIPPING_TABLE_HANDLING', '0', 'SipariÅŸ hazÄ±rlÄ±k Ã¼creti.', 6, 0, NULL, '2013-11-17 00:39:49', NULL, NULL),
(556, 'Vergi (KDV)', 'MODULE_SHIPPING_TABLE_TAX_CLASS', '0', 'Kargo tutarÄ± iÃ§in aÅŸaÄŸÄ±daki vergi oranÄ±nÄ± kullan.', 6, 0, NULL, '2013-11-17 00:39:49', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes('),
(557, 'Kargo BÃ¶lgesi', 'MODULE_SHIPPING_TABLE_ZONE', '0', 'Kargo bÃ¶lgesi seÃ§ildiÄŸinde bu kargo ÅŸekli sadece seÃ§ilen bÃ¶lgede aktif olacaktÄ±r.', 6, 0, NULL, '2013-11-17 00:39:49', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(558, 'SÄ±ralama DÃ¼zeni', 'MODULE_SHIPPING_TABLE_SORT_ORDER', '0', 'GÃ¶rÃ¼ntÃ¼leme iÃ§in sÄ±ralama dÃ¼zeni.', 6, 0, NULL, '2013-11-17 00:39:49', NULL, NULL),
(559, 'Enable USPS Shipping', 'MODULE_SHIPPING_USPS_STATUS', 'True', 'Do you want to offer USPS shipping?', 6, 0, NULL, '2013-11-17 00:40:09', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(560, 'Enter the USPS User ID', 'MODULE_SHIPPING_USPS_USERID', 'NONE', 'Enter the USPS USERID assigned to you.', 6, 0, NULL, '2013-11-17 00:40:09', NULL, NULL),
(561, 'Enter the USPS Password', 'MODULE_SHIPPING_USPS_PASSWORD', 'NONE', 'See USERID, above.', 6, 0, NULL, '2013-11-17 00:40:09', NULL, NULL),
(562, 'Handling Fee', 'MODULE_SHIPPING_USPS_HANDLING', '0', 'Handling fee for this shipping method.', 6, 0, NULL, '2013-11-17 00:40:09', NULL, NULL),
(563, 'Tax Class', 'MODULE_SHIPPING_USPS_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', 6, 0, NULL, '2013-11-17 00:40:09', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes('),
(564, 'Shipping Zone', 'MODULE_SHIPPING_USPS_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', 6, 0, NULL, '2013-11-17 00:40:09', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes('),
(565, 'Sort Order', 'MODULE_SHIPPING_USPS_SORT_ORDER', '0', 'Sort order of display.', 6, 0, NULL, '2013-11-17 00:40:09', NULL, NULL),
(566, 'Åžehir BazÄ±nda Tablo OranlarÄ± - (BÃ¶lge Åžehirleri BazÄ±nda, TÃ¼rkiye ve DÃ¼nya Geneli)', 'MODULE_SHIPPING_ZONES_STATUS', 'True', 'BÃ¶lge ÅŸehirleri bazÄ±nda kargo etkinleÅŸtirilsin mi?', 6, 0, NULL, '2013-11-17 00:46:54', NULL, 'tep_cfg_select_option(array(''True'', ''False''), '),
(567, 'Vergi', 'MODULE_SHIPPING_ZONES_TAX_CLASS', '0', 'Kargo fiyatÄ±na aÅŸaÄŸÄ±daki vergiyi ekle.', 6, 0, NULL, '2013-11-17 00:46:54', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes('),
(568, 'SÄ±ralama DÃ¼zeni', 'MODULE_SHIPPING_ZONES_SORT_ORDER', '0', 'GÃ¶rÃ¼ntÃ¼leme iÃ§in sÄ±ralama dÃ¼zeni.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL);
INSERT INTO `configuration` (`configuration_id`, `configuration_title`, `configuration_key`, `configuration_value`, `configuration_description`, `configuration_group_id`, `sort_order`, `last_modified`, `date_added`, `use_function`, `set_function`) VALUES
(569, 'Bolge 1 Sehirleri', 'MODULE_SHIPPING_ZONES_COUNTRIES_1', '192,193,237', 'Virgullerle ayrilmis bolge sehirleri. Her numara sehir ID sini temsil etmektedir. Sehir ID leri Sehirler/Bolgeler kismindan kontrol edilebilir. Bolge - 1.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(570, 'Bolge 1 e ait fiyat tablosu', 'MODULE_SHIPPING_ZONES_COST_1', '1:4.09,2:4.11,3:4.58,4:5.07,5:5.66,6:6.35,7:7.03,8:7.76,9:8.51,10:9.27', 'Bu fiyat tablosu Bolge 1 sehirlerine uygulanacak fiyatlari gosterir. Maksimum siparis agirligina gore hesaplanir. Ornek yazim: 3:8.50,7:10.50,... Bu ornekte 3 ve altindaki siparis agirliklari 8.5 olarak fiyatlandirilir. Bolge - 1 sehirleri icindir.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(571, 'Bolge 1 siparis hazirlik ucreti', 'MODULE_SHIPPING_ZONES_HANDLING_1', '0', 'Siparis hazirlama ucreti varsa giriniz', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(572, 'Bolge 2 Sehirleri', 'MODULE_SHIPPING_ZONES_COUNTRIES_2', '', 'Virgullerle ayrilmis bolge sehirleri. Her numara sehir ID sini temsil etmektedir. Sehir ID leri Sehirler/Bolgeler kismindan kontrol edilebilir. Bolge - 2.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(573, 'Bolge 2 e ait fiyat tablosu', 'MODULE_SHIPPING_ZONES_COST_2', '1:4.09,2:4.11,3:4.58,4:5.07,5:5.66,6:6.35,7:7.03,8:7.76,9:8.51,10:9.27', 'Bu fiyat tablosu Bolge 2 sehirlerine uygulanacak fiyatlari gosterir. Maksimum siparis agirligina gore hesaplanir. Ornek yazim: 3:8.50,7:10.50,... Bu ornekte 3 ve altindaki siparis agirliklari 8.5 olarak fiyatlandirilir. Bolge - 2 sehirleri icindir.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(574, 'Bolge 2 siparis hazirlik ucreti', 'MODULE_SHIPPING_ZONES_HANDLING_2', '0', 'Siparis hazirlama ucreti varsa giriniz', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(575, 'Bolge 3 Sehirleri', 'MODULE_SHIPPING_ZONES_COUNTRIES_3', '', 'Virgullerle ayrilmis bolge sehirleri. Her numara sehir ID sini temsil etmektedir. Sehir ID leri Sehirler/Bolgeler kismindan kontrol edilebilir. Bolge - 3.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(576, 'Bolge 3 e ait fiyat tablosu', 'MODULE_SHIPPING_ZONES_COST_3', '1:4.09,2:4.11,3:4.58,4:5.07,5:5.66,6:6.35,7:7.03,8:7.76,9:8.51,10:9.27', 'Bu fiyat tablosu Bolge 3 sehirlerine uygulanacak fiyatlari gosterir. Maksimum siparis agirligina gore hesaplanir. Ornek yazim: 3:8.50,7:10.50,... Bu ornekte 3 ve altindaki siparis agirliklari 8.5 olarak fiyatlandirilir. Bolge - 3 sehirleri icindir.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(577, 'Bolge 3 siparis hazirlik ucreti', 'MODULE_SHIPPING_ZONES_HANDLING_3', '0', 'Siparis hazirlama ucreti varsa giriniz', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(578, 'Bolge 4 Sehirleri', 'MODULE_SHIPPING_ZONES_COUNTRIES_4', '', 'Virgullerle ayrilmis bolge sehirleri. Her numara sehir ID sini temsil etmektedir. Sehir ID leri Sehirler/Bolgeler kismindan kontrol edilebilir. Bolge - 4.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(579, 'Bolge 4 e ait fiyat tablosu', 'MODULE_SHIPPING_ZONES_COST_4', '1:4.09,2:4.11,3:4.58,4:5.07,5:5.66,6:6.35,7:7.03,8:7.76,9:8.51,10:9.27', 'Bu fiyat tablosu Bolge 4 sehirlerine uygulanacak fiyatlari gosterir. Maksimum siparis agirligina gore hesaplanir. Ornek yazim: 3:8.50,7:10.50,... Bu ornekte 3 ve altindaki siparis agirliklari 8.5 olarak fiyatlandirilir. Bolge - 4 sehirleri icindir.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(580, 'Bolge 4 siparis hazirlik ucreti', 'MODULE_SHIPPING_ZONES_HANDLING_4', '0', 'Siparis hazirlama ucreti varsa giriniz', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(581, 'Bolge 5 Sehirleri', 'MODULE_SHIPPING_ZONES_COUNTRIES_5', '', 'Virgullerle ayrilmis bolge sehirleri. Her numara sehir ID sini temsil etmektedir. Sehir ID leri Sehirler/Bolgeler kismindan kontrol edilebilir. Bolge - 5.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(582, 'Bolge 5 e ait fiyat tablosu', 'MODULE_SHIPPING_ZONES_COST_5', '1:4.09,2:4.11,3:4.58,4:5.07,5:5.66,6:6.35,7:7.03,8:7.76,9:8.51,10:9.27', 'Bu fiyat tablosu Bolge 5 sehirlerine uygulanacak fiyatlari gosterir. Maksimum siparis agirligina gore hesaplanir. Ornek yazim: 3:8.50,7:10.50,... Bu ornekte 3 ve altindaki siparis agirliklari 8.5 olarak fiyatlandirilir. Bolge - 5 sehirleri icindir.', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL),
(583, 'Bolge 5 siparis hazirlik ucreti', 'MODULE_SHIPPING_ZONES_HANDLING_5', '0', 'Siparis hazirlama ucreti varsa giriniz', 6, 0, NULL, '2013-11-17 00:46:54', NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `configuration_group`
--

CREATE TABLE IF NOT EXISTS `configuration_group` (
  `configuration_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `configuration_group_title` varchar(64) NOT NULL,
  `configuration_group_description` varchar(255) NOT NULL,
  `sort_order` int(5) DEFAULT NULL,
  `visible` int(1) DEFAULT '1',
  PRIMARY KEY (`configuration_group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=544 ;

--
-- Tablo döküm verisi `configuration_group`
--

INSERT INTO `configuration_group` (`configuration_group_id`, `configuration_group_title`, `configuration_group_description`, `sort_order`, `visible`) VALUES
(1, 'My Store', 'General information about my store', 1, 1),
(2, 'Minimum Values', 'The minimum values for functions / data', 2, 1),
(3, 'Maximum Values', 'The maximum values for functions / data', 3, 1),
(4, 'Images', 'Image parameters', 4, 1),
(5, 'Customer Details', 'Customer account configuration', 5, 1),
(6, 'Module Options', 'Hidden from configuration', 6, 0),
(7, 'Shipping/Packaging', 'Shipping options available at my store', 7, 1),
(8, 'Product Listing', 'Product Listing    configuration options', 8, 1),
(9, 'Stock', 'Stock configuration options', 9, 1),
(10, 'Logging', 'Logging configuration options', 10, 1),
(11, 'Cache', 'Caching configuration options', 11, 1),
(12, 'E-Mail Options', 'General setting for E-Mail transport and HTML E-Mails', 12, 1),
(13, 'Download', 'Downloadable products options', 13, 1),
(14, 'GZip Compression', 'GZip compression options', 14, 1),
(15, 'Sessions', 'Session options', 15, 1),
(543, 'Header Tags SEO', 'Header Tags SEO site wide options', 20, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `counter`
--

CREATE TABLE IF NOT EXISTS `counter` (
  `startdate` char(8) DEFAULT NULL,
  `counter` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `counter_history`
--

CREATE TABLE IF NOT EXISTS `counter_history` (
  `month` char(8) DEFAULT NULL,
  `counter` int(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `countries_id` int(11) NOT NULL AUTO_INCREMENT,
  `countries_name` varchar(64) NOT NULL,
  `countries_iso_code_2` char(2) NOT NULL,
  `countries_iso_code_3` char(3) NOT NULL,
  `address_format_id` int(11) NOT NULL,
  PRIMARY KEY (`countries_id`),
  KEY `IDX_COUNTRIES_NAME` (`countries_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

--
-- Tablo döküm verisi `countries`
--

INSERT INTO `countries` (`countries_id`, `countries_name`, `countries_iso_code_2`, `countries_iso_code_3`, `address_format_id`) VALUES
(1, 'Afghanistan', 'AF', 'AFG', 1),
(2, 'Albania', 'AL', 'ALB', 1),
(3, 'Algeria', 'DZ', 'DZA', 1),
(4, 'American Samoa', 'AS', 'ASM', 1),
(5, 'Andorra', 'AD', 'AND', 1),
(6, 'Angola', 'AO', 'AGO', 1),
(7, 'Anguilla', 'AI', 'AIA', 1),
(8, 'Antarctica', 'AQ', 'ATA', 1),
(9, 'Antigua and Barbuda', 'AG', 'ATG', 1),
(10, 'Argentina', 'AR', 'ARG', 1),
(11, 'Armenia', 'AM', 'ARM', 1),
(12, 'Aruba', 'AW', 'ABW', 1),
(13, 'Australia', 'AU', 'AUS', 1),
(14, 'Austria', 'AT', 'AUT', 5),
(15, 'Azerbaijan', 'AZ', 'AZE', 1),
(16, 'Bahamas', 'BS', 'BHS', 1),
(17, 'Bahrain', 'BH', 'BHR', 1),
(18, 'Bangladesh', 'BD', 'BGD', 1),
(19, 'Barbados', 'BB', 'BRB', 1),
(20, 'Belarus', 'BY', 'BLR', 1),
(21, 'Belgium', 'BE', 'BEL', 1),
(22, 'Belize', 'BZ', 'BLZ', 1),
(23, 'Benin', 'BJ', 'BEN', 1),
(24, 'Bermuda', 'BM', 'BMU', 1),
(25, 'Bhutan', 'BT', 'BTN', 1),
(26, 'Bolivia', 'BO', 'BOL', 1),
(27, 'Bosnia and Herzegowina', 'BA', 'BIH', 1),
(28, 'Botswana', 'BW', 'BWA', 1),
(29, 'Bouvet Island', 'BV', 'BVT', 1),
(30, 'Brazil', 'BR', 'BRA', 1),
(31, 'British Indian Ocean Territory', 'IO', 'IOT', 1),
(32, 'Brunei Darussalam', 'BN', 'BRN', 1),
(33, 'Bulgaria', 'BG', 'BGR', 1),
(34, 'Burkina Faso', 'BF', 'BFA', 1),
(35, 'Burundi', 'BI', 'BDI', 1),
(36, 'Cambodia', 'KH', 'KHM', 1),
(37, 'Cameroon', 'CM', 'CMR', 1),
(38, 'Canada', 'CA', 'CAN', 1),
(39, 'Cape Verde', 'CV', 'CPV', 1),
(40, 'Cayman Islands', 'KY', 'CYM', 1),
(41, 'Central African Republic', 'CF', 'CAF', 1),
(42, 'Chad', 'TD', 'TCD', 1),
(43, 'Chile', 'CL', 'CHL', 1),
(44, 'China', 'CN', 'CHN', 1),
(45, 'Christmas Island', 'CX', 'CXR', 1),
(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1),
(47, 'Colombia', 'CO', 'COL', 1),
(48, 'Comoros', 'KM', 'COM', 1),
(49, 'Congo', 'CG', 'COG', 1),
(50, 'Cook Islands', 'CK', 'COK', 1),
(51, 'Costa Rica', 'CR', 'CRI', 1),
(52, 'Cote D''Ivoire', 'CI', 'CIV', 1),
(53, 'Croatia', 'HR', 'HRV', 1),
(54, 'Cuba', 'CU', 'CUB', 1),
(55, 'Cyprus', 'CY', 'CYP', 1),
(56, 'Czech Republic', 'CZ', 'CZE', 1),
(57, 'Denmark', 'DK', 'DNK', 1),
(58, 'Djibouti', 'DJ', 'DJI', 1),
(59, 'Dominica', 'DM', 'DMA', 1),
(60, 'Dominican Republic', 'DO', 'DOM', 1),
(61, 'East Timor', 'TP', 'TMP', 1),
(62, 'Ecuador', 'EC', 'ECU', 1),
(63, 'Egypt', 'EG', 'EGY', 1),
(64, 'El Salvador', 'SV', 'SLV', 1),
(65, 'Equatorial Guinea', 'GQ', 'GNQ', 1),
(66, 'Eritrea', 'ER', 'ERI', 1),
(67, 'Estonia', 'EE', 'EST', 1),
(68, 'Ethiopia', 'ET', 'ETH', 1),
(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1),
(70, 'Faroe Islands', 'FO', 'FRO', 1),
(71, 'Fiji', 'FJ', 'FJI', 1),
(72, 'Finland', 'FI', 'FIN', 1),
(73, 'France', 'FR', 'FRA', 1),
(74, 'France, Metropolitan', 'FX', 'FXX', 1),
(75, 'French Guiana', 'GF', 'GUF', 1),
(76, 'French Polynesia', 'PF', 'PYF', 1),
(77, 'French Southern Territories', 'TF', 'ATF', 1),
(78, 'Gabon', 'GA', 'GAB', 1),
(79, 'Gambia', 'GM', 'GMB', 1),
(80, 'Georgia', 'GE', 'GEO', 1),
(81, 'Germany', 'DE', 'DEU', 5),
(82, 'Ghana', 'GH', 'GHA', 1),
(83, 'Gibraltar', 'GI', 'GIB', 1),
(84, 'Greece', 'GR', 'GRC', 1),
(85, 'Greenland', 'GL', 'GRL', 1),
(86, 'Grenada', 'GD', 'GRD', 1),
(87, 'Guadeloupe', 'GP', 'GLP', 1),
(88, 'Guam', 'GU', 'GUM', 1),
(89, 'Guatemala', 'GT', 'GTM', 1),
(90, 'Guinea', 'GN', 'GIN', 1),
(91, 'Guinea-bissau', 'GW', 'GNB', 1),
(92, 'Guyana', 'GY', 'GUY', 1),
(93, 'Haiti', 'HT', 'HTI', 1),
(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1),
(95, 'Honduras', 'HN', 'HND', 1),
(96, 'Hong Kong', 'HK', 'HKG', 1),
(97, 'Hungary', 'HU', 'HUN', 1),
(98, 'Iceland', 'IS', 'ISL', 1),
(99, 'India', 'IN', 'IND', 1),
(100, 'Indonesia', 'ID', 'IDN', 1),
(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1),
(102, 'Iraq', 'IQ', 'IRQ', 1),
(103, 'Ireland', 'IE', 'IRL', 1),
(104, 'Israel', 'IL', 'ISR', 1),
(105, 'Italy', 'IT', 'ITA', 1),
(106, 'Jamaica', 'JM', 'JAM', 1),
(107, 'Japan', 'JP', 'JPN', 1),
(108, 'Jordan', 'JO', 'JOR', 1),
(109, 'Kazakhstan', 'KZ', 'KAZ', 1),
(110, 'Kenya', 'KE', 'KEN', 1),
(111, 'Kiribati', 'KI', 'KIR', 1),
(112, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 1),
(113, 'Korea, Republic of', 'KR', 'KOR', 1),
(114, 'Kuwait', 'KW', 'KWT', 1),
(115, 'Kyrgyzstan', 'KG', 'KGZ', 1),
(116, 'Lao People''s Democratic Republic', 'LA', 'LAO', 1),
(117, 'Latvia', 'LV', 'LVA', 1),
(118, 'Lebanon', 'LB', 'LBN', 1),
(119, 'Lesotho', 'LS', 'LSO', 1),
(120, 'Liberia', 'LR', 'LBR', 1),
(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1),
(122, 'Liechtenstein', 'LI', 'LIE', 1),
(123, 'Lithuania', 'LT', 'LTU', 1),
(124, 'Luxembourg', 'LU', 'LUX', 1),
(125, 'Macau', 'MO', 'MAC', 1),
(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 1),
(127, 'Madagascar', 'MG', 'MDG', 1),
(128, 'Malawi', 'MW', 'MWI', 1),
(129, 'Malaysia', 'MY', 'MYS', 1),
(130, 'Maldives', 'MV', 'MDV', 1),
(131, 'Mali', 'ML', 'MLI', 1),
(132, 'Malta', 'MT', 'MLT', 1),
(133, 'Marshall Islands', 'MH', 'MHL', 1),
(134, 'Martinique', 'MQ', 'MTQ', 1),
(135, 'Mauritania', 'MR', 'MRT', 1),
(136, 'Mauritius', 'MU', 'MUS', 1),
(137, 'Mayotte', 'YT', 'MYT', 1),
(138, 'Mexico', 'MX', 'MEX', 1),
(139, 'Micronesia, Federated States of', 'FM', 'FSM', 1),
(140, 'Moldova, Republic of', 'MD', 'MDA', 1),
(141, 'Monaco', 'MC', 'MCO', 1),
(142, 'Mongolia', 'MN', 'MNG', 1),
(143, 'Montserrat', 'MS', 'MSR', 1),
(144, 'Morocco', 'MA', 'MAR', 1),
(145, 'Mozambique', 'MZ', 'MOZ', 1),
(146, 'Myanmar', 'MM', 'MMR', 1),
(147, 'Namibia', 'NA', 'NAM', 1),
(148, 'Nauru', 'NR', 'NRU', 1),
(149, 'Nepal', 'NP', 'NPL', 1),
(150, 'Netherlands', 'NL', 'NLD', 1),
(151, 'Netherlands Antilles', 'AN', 'ANT', 1),
(152, 'New Caledonia', 'NC', 'NCL', 1),
(153, 'New Zealand', 'NZ', 'NZL', 1),
(154, 'Nicaragua', 'NI', 'NIC', 1),
(155, 'Niger', 'NE', 'NER', 1),
(156, 'Nigeria', 'NG', 'NGA', 1),
(157, 'Niue', 'NU', 'NIU', 1),
(158, 'Norfolk Island', 'NF', 'NFK', 1),
(159, 'Northern Mariana Islands', 'MP', 'MNP', 1),
(160, 'Norway', 'NO', 'NOR', 1),
(161, 'Oman', 'OM', 'OMN', 1),
(162, 'Pakistan', 'PK', 'PAK', 1),
(163, 'Palau', 'PW', 'PLW', 1),
(164, 'Panama', 'PA', 'PAN', 1),
(165, 'Papua New Guinea', 'PG', 'PNG', 1),
(166, 'Paraguay', 'PY', 'PRY', 1),
(167, 'Peru', 'PE', 'PER', 1),
(168, 'Philippines', 'PH', 'PHL', 1),
(169, 'Pitcairn', 'PN', 'PCN', 1),
(170, 'Poland', 'PL', 'POL', 1),
(171, 'Portugal', 'PT', 'PRT', 1),
(172, 'Puerto Rico', 'PR', 'PRI', 1),
(173, 'Qatar', 'QA', 'QAT', 1),
(174, 'Reunion', 'RE', 'REU', 1),
(175, 'Romania', 'RO', 'ROM', 1),
(176, 'Russian Federation', 'RU', 'RUS', 1),
(177, 'Rwanda', 'RW', 'RWA', 1),
(178, 'Saint Kitts and Nevis', 'KN', 'KNA', 1),
(179, 'Saint Lucia', 'LC', 'LCA', 1),
(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1),
(181, 'Samoa', 'WS', 'WSM', 1),
(182, 'San Marino', 'SM', 'SMR', 1),
(183, 'Sao Tome and Principe', 'ST', 'STP', 1),
(184, 'Saudi Arabia', 'SA', 'SAU', 1),
(185, 'Senegal', 'SN', 'SEN', 1),
(186, 'Seychelles', 'SC', 'SYC', 1),
(187, 'Sierra Leone', 'SL', 'SLE', 1),
(188, 'Singapore', 'SG', 'SGP', 4),
(189, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 1),
(190, 'Slovenia', 'SI', 'SVN', 1),
(191, 'Solomon Islands', 'SB', 'SLB', 1),
(192, 'Somalia', 'SO', 'SOM', 1),
(193, 'South Africa', 'ZA', 'ZAF', 1),
(194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 1),
(195, 'Spain', 'ES', 'ESP', 3),
(196, 'Sri Lanka', 'LK', 'LKA', 1),
(197, 'St. Helena', 'SH', 'SHN', 1),
(198, 'St. Pierre and Miquelon', 'PM', 'SPM', 1),
(199, 'Sudan', 'SD', 'SDN', 1),
(200, 'Suriname', 'SR', 'SUR', 1),
(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1),
(202, 'Swaziland', 'SZ', 'SWZ', 1),
(203, 'Sweden', 'SE', 'SWE', 1),
(204, 'Switzerland', 'CH', 'CHE', 1),
(205, 'Syrian Arab Republic', 'SY', 'SYR', 1),
(206, 'Taiwan', 'TW', 'TWN', 1),
(207, 'Tajikistan', 'TJ', 'TJK', 1),
(208, 'Tanzania, United Republic of', 'TZ', 'TZA', 1),
(209, 'Thailand', 'TH', 'THA', 1),
(210, 'Togo', 'TG', 'TGO', 1),
(211, 'Tokelau', 'TK', 'TKL', 1),
(212, 'Tonga', 'TO', 'TON', 1),
(213, 'Trinidad and Tobago', 'TT', 'TTO', 1),
(214, 'Tunisia', 'TN', 'TUN', 1),
(215, 'TURKIYE', 'TR', 'TUR', 1),
(216, 'Turkmenistan', 'TM', 'TKM', 1),
(217, 'Turks and Caicos Islands', 'TC', 'TCA', 1),
(218, 'Tuvalu', 'TV', 'TUV', 1),
(219, 'Uganda', 'UG', 'UGA', 1),
(220, 'Ukraine', 'UA', 'UKR', 1),
(221, 'United Arab Emirates', 'AE', 'ARE', 1),
(222, 'United Kingdom', 'GB', 'GBR', 1),
(223, 'United States', 'US', 'USA', 2),
(224, 'United States Minor Outlying Islands', 'UM', 'UMI', 1),
(225, 'Uruguay', 'UY', 'URY', 1),
(226, 'Uzbekistan', 'UZ', 'UZB', 1),
(227, 'Vanuatu', 'VU', 'VUT', 1),
(228, 'Vatican City State (Holy See)', 'VA', 'VAT', 1),
(229, 'Venezuela', 'VE', 'VEN', 1),
(230, 'Viet Nam', 'VN', 'VNM', 1),
(231, 'Virgin Islands (British)', 'VG', 'VGB', 1),
(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1),
(233, 'Wallis and Futuna Islands', 'WF', 'WLF', 1),
(234, 'Western Sahara', 'EH', 'ESH', 1),
(235, 'Yemen', 'YE', 'YEM', 1),
(236, 'Yugoslavia', 'YU', 'YUG', 1),
(237, 'Zaire', 'ZR', 'ZAR', 1),
(238, 'Zambia', 'ZM', 'ZMB', 1),
(239, 'Zimbabwe', 'ZW', 'ZWE', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `currencies`
--

CREATE TABLE IF NOT EXISTS `currencies` (
  `currencies_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) NOT NULL,
  `code` char(3) NOT NULL,
  `symbol_left` varchar(12) DEFAULT NULL,
  `symbol_right` varchar(12) DEFAULT NULL,
  `decimal_point` char(1) DEFAULT NULL,
  `thousands_point` char(1) DEFAULT NULL,
  `decimal_places` char(1) DEFAULT NULL,
  `value` float(13,8) DEFAULT NULL,
  `last_updated` datetime DEFAULT NULL,
  PRIMARY KEY (`currencies_id`),
  KEY `idx_currencies_code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Tablo döküm verisi `currencies`
--

INSERT INTO `currencies` (`currencies_id`, `title`, `code`, `symbol_left`, `symbol_right`, `decimal_point`, `thousands_point`, `decimal_places`, `value`, `last_updated`) VALUES
(1, 'US Dollar', 'USD', '$', '', '.', ',', '2', 0.49346164, '2013-11-08 16:42:37'),
(2, 'Euro', 'EUR', '', 'EUR', '.', ',', '2', 0.36768761, '2013-11-08 16:42:37'),
(3, 'TÃ¼rk LirasÄ±', 'TL', '', 'Â TL', ',', '.', '2', 1.00000000, '2013-11-08 16:42:37');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `customers_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_gender` char(1) NOT NULL,
  `customers_firstname` varchar(32) NOT NULL,
  `customers_lastname` varchar(32) NOT NULL,
  `customers_dob` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `customers_email_address` varchar(96) NOT NULL,
  `customers_default_address_id` int(11) DEFAULT NULL,
  `customers_telephone` varchar(32) NOT NULL,
  `customers_fax` varchar(32) DEFAULT NULL,
  `customers_password` varchar(40) NOT NULL,
  `customers_newsletter` char(1) DEFAULT NULL,
  `customers_group_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `customers_group_ra` enum('0','1') NOT NULL,
  `customers_payment_allowed` varchar(255) NOT NULL DEFAULT '',
  `customers_shipment_allowed` varchar(255) NOT NULL DEFAULT '',
  `customers_order_total_allowed` varchar(255) NOT NULL DEFAULT '',
  `customers_specific_taxes_exempt` varchar(255) NOT NULL DEFAULT '',
  `entry_company_tax_id` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`customers_id`),
  KEY `idx_customers_email_address` (`customers_email_address`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `customers`
--

INSERT INTO `customers` (`customers_id`, `customers_gender`, `customers_firstname`, `customers_lastname`, `customers_dob`, `customers_email_address`, `customers_default_address_id`, `customers_telephone`, `customers_fax`, `customers_password`, `customers_newsletter`, `customers_group_id`, `customers_group_ra`, `customers_payment_allowed`, `customers_shipment_allowed`, `customers_order_total_allowed`, `customers_specific_taxes_exempt`, `entry_company_tax_id`) VALUES
(1, '', 'Kadir', 'Korkmaz', '1943-01-01 00:00:00', 'root@localhost', 9, '12345', '', 'd95e8fa7f20a009372eb3477473fcd34:1c', '0', 0, '0', '', '', '', '', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `customers_basket`
--

CREATE TABLE IF NOT EXISTS `customers_basket` (
  `customers_basket_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` tinytext NOT NULL,
  `customers_basket_quantity` int(2) NOT NULL,
  `final_price` decimal(15,4) DEFAULT NULL,
  `customers_basket_date_added` char(8) DEFAULT NULL,
  PRIMARY KEY (`customers_basket_id`),
  KEY `idx_customers_basket_customers_id` (`customers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=120 ;

--
-- Tablo döküm verisi `customers_basket`
--

INSERT INTO `customers_basket` (`customers_basket_id`, `customers_id`, `products_id`, `customers_basket_quantity`, `final_price`, `customers_basket_date_added`) VALUES
(116, 1, '53{3}9{4}4', 1, NULL, '20131118'),
(117, 1, '53{3}7{4}1', 1, NULL, '20131120'),
(118, 1, '53{3}9{4}1', 1, NULL, '20131120'),
(119, 3, '75', 1, NULL, '20131120');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `customers_basket_attributes`
--

CREATE TABLE IF NOT EXISTS `customers_basket_attributes` (
  `customers_basket_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `products_id` tinytext NOT NULL,
  `products_options_id` int(11) NOT NULL,
  `products_options_value_id` int(11) NOT NULL,
  PRIMARY KEY (`customers_basket_attributes_id`),
  KEY `idx_customers_basket_att_customers_id` (`customers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=155 ;

--
-- Tablo döküm verisi `customers_basket_attributes`
--

INSERT INTO `customers_basket_attributes` (`customers_basket_attributes_id`, `customers_id`, `products_id`, `products_options_id`, `products_options_value_id`) VALUES
(149, 1, '53{3}9{4}4', 3, 9),
(150, 1, '53{3}9{4}4', 4, 4),
(151, 1, '53{3}7{4}1', 3, 7),
(152, 1, '53{3}7{4}1', 4, 1),
(153, 1, '53{3}9{4}1', 3, 9),
(154, 1, '53{3}9{4}1', 4, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `customers_groups`
--

CREATE TABLE IF NOT EXISTS `customers_groups` (
  `customers_group_id` smallint(5) unsigned NOT NULL,
  `customers_group_name` varchar(32) NOT NULL DEFAULT '',
  `customers_group_show_tax` enum('1','0') NOT NULL,
  `customers_group_tax_exempt` enum('0','1') NOT NULL,
  `group_payment_allowed` varchar(255) NOT NULL DEFAULT '',
  `group_shipment_allowed` varchar(255) NOT NULL DEFAULT '',
  `group_order_total_allowed` varchar(255) NOT NULL DEFAULT '',
  `group_specific_taxes_exempt` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`customers_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `customers_groups`
--

INSERT INTO `customers_groups` (`customers_group_id`, `customers_group_name`, `customers_group_show_tax`, `customers_group_tax_exempt`, `group_payment_allowed`, `group_shipment_allowed`, `group_order_total_allowed`, `group_specific_taxes_exempt`) VALUES
(0, 'Retail', '1', '0', '', '', '', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `customers_info`
--

CREATE TABLE IF NOT EXISTS `customers_info` (
  `customers_info_id` int(11) NOT NULL,
  `customers_info_date_of_last_logon` datetime DEFAULT NULL,
  `customers_info_number_of_logons` int(5) DEFAULT NULL,
  `customers_info_date_account_created` datetime DEFAULT NULL,
  `customers_info_date_account_last_modified` datetime DEFAULT NULL,
  `global_product_notifications` int(1) DEFAULT '0',
  PRIMARY KEY (`customers_info_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `customers_info`
--

INSERT INTO `customers_info` (`customers_info_id`, `customers_info_date_of_last_logon`, `customers_info_number_of_logons`, `customers_info_date_account_created`, `customers_info_date_account_last_modified`, `global_product_notifications`) VALUES
(1, NULL, 0, '2013-08-07 14:38:04', NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `geo_zones`
--

CREATE TABLE IF NOT EXISTS `geo_zones` (
  `geo_zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `geo_zone_name` varchar(32) NOT NULL,
  `geo_zone_description` varchar(255) NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`geo_zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `geo_zones`
--

INSERT INTO `geo_zones` (`geo_zone_id`, `geo_zone_name`, `geo_zone_description`, `last_modified`, `date_added`) VALUES
(1, 'TÃ¼rkiye Geneli', 'TÃ¼rkiye Geneli KDV', '2013-11-08 19:10:32', '2013-08-07 14:38:05');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `headertags`
--

CREATE TABLE IF NOT EXISTS `headertags` (
  `page_name` varchar(64) NOT NULL DEFAULT '',
  `page_title` varchar(120) NOT NULL DEFAULT '',
  `page_description` varchar(255) NOT NULL DEFAULT '',
  `page_keywords` varchar(255) NOT NULL DEFAULT '',
  `page_logo` varchar(255) NOT NULL DEFAULT '',
  `page_logo_1` varchar(255) NOT NULL DEFAULT '',
  `page_logo_2` varchar(255) NOT NULL DEFAULT '',
  `page_logo_3` varchar(255) NOT NULL DEFAULT '',
  `page_logo_4` varchar(255) NOT NULL DEFAULT '',
  `append_default_title` tinyint(1) NOT NULL DEFAULT '0',
  `append_default_description` tinyint(1) NOT NULL DEFAULT '0',
  `append_default_keywords` tinyint(1) NOT NULL DEFAULT '0',
  `append_default_logo` tinyint(1) NOT NULL DEFAULT '0',
  `append_category` tinyint(1) NOT NULL DEFAULT '0',
  `append_manufacturer` tinyint(1) NOT NULL DEFAULT '0',
  `append_product` tinyint(1) NOT NULL DEFAULT '1',
  `append_root` tinyint(1) NOT NULL DEFAULT '1',
  `sortorder_title` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_description` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_keywords` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo_1` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo_2` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo_3` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_logo_4` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_category` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_manufacturer` tinyint(2) NOT NULL DEFAULT '0',
  `sortorder_product` tinyint(2) NOT NULL DEFAULT '10',
  `sortorder_root` tinyint(2) NOT NULL DEFAULT '1',
  `sortorder_root_1` tinyint(2) NOT NULL DEFAULT '1',
  `sortorder_root_2` tinyint(2) NOT NULL DEFAULT '1',
  `sortorder_root_3` tinyint(2) NOT NULL DEFAULT '1',
  `sortorder_root_4` tinyint(2) NOT NULL DEFAULT '1',
  `language_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`page_name`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `headertags`
--



-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `headertags_cache`
--

CREATE TABLE IF NOT EXISTS `headertags_cache` (
  `title` text,
  `data` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `headertags_default`
--

CREATE TABLE IF NOT EXISTS `headertags_default` (
  `default_title` varchar(255) NOT NULL DEFAULT '',
  `default_description` varchar(255) NOT NULL DEFAULT '',
  `default_keywords` varchar(255) NOT NULL DEFAULT '',
  `default_logo_text` varchar(255) NOT NULL DEFAULT '',
  `default_logo_append_group` tinyint(1) NOT NULL DEFAULT '1',
  `default_logo_append_category` tinyint(1) NOT NULL DEFAULT '1',
  `default_logo_append_manufacturer` tinyint(1) NOT NULL DEFAULT '1',
  `default_logo_append_product` tinyint(1) NOT NULL DEFAULT '1',
  `meta_google` tinyint(1) NOT NULL DEFAULT '0',
  `meta_language` tinyint(1) NOT NULL DEFAULT '0',
  `meta_noodp` tinyint(1) NOT NULL DEFAULT '1',
  `meta_noydir` tinyint(1) NOT NULL DEFAULT '1',
  `meta_replyto` tinyint(1) NOT NULL DEFAULT '0',
  `meta_revisit` tinyint(1) NOT NULL DEFAULT '0',
  `meta_robots` tinyint(1) NOT NULL DEFAULT '0',
  `meta_unspam` tinyint(1) NOT NULL DEFAULT '0',
  `meta_canonical` tinyint(1) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`default_title`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `headertags_default`
--

INSERT INTO `headertags_default` (`default_title`, `default_description`, `default_keywords`, `default_logo_text`, `default_logo_append_group`, `default_logo_append_category`, `default_logo_append_manufacturer`, `default_logo_append_product`, `meta_google`, `meta_language`, `meta_noodp`, `meta_noydir`, `meta_replyto`, `meta_revisit`, `meta_robots`, `meta_unspam`, `meta_canonical`, `language_id`) VALUES
('Default title', 'Default description', 'Default Keywords', 'Default Logo Text', 0, 0, 0, 0, 0, 0, 1, 1, 0, 0, 0, 0, 1, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `headertags_silo`
--

CREATE TABLE IF NOT EXISTS `headertags_silo` (
  `category_id` int(11) NOT NULL DEFAULT '0',
  `box_heading` varchar(60) NOT NULL,
  `is_disabled` tinyint(1) NOT NULL DEFAULT '0',
  `max_links` int(11) NOT NULL DEFAULT '6',
  `sorton` tinyint(2) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`category_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `languages_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `code` char(2) NOT NULL,
  `image` varchar(64) DEFAULT NULL,
  `directory` varchar(32) DEFAULT NULL,
  `sort_order` int(3) DEFAULT NULL,
  PRIMARY KEY (`languages_id`),
  KEY `IDX_LANGUAGES_NAME` (`name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Tablo döküm verisi `languages`
--

INSERT INTO `languages` (`languages_id`, `name`, `code`, `image`, `directory`, `sort_order`) VALUES
(1, 'English', 'en', 'icon.gif', 'english', 2),
(2, 'Deutsch', 'de', 'icon.gif', 'german', 3),
(3, 'Español', 'es', 'icon.gif', 'espanol', 4),
(4, 'Türkçe', 'tr', 'icon.gif', 'turkish', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `manufacturers`
--

CREATE TABLE IF NOT EXISTS `manufacturers` (
  `manufacturers_id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturers_name` varchar(32) NOT NULL,
  `manufacturers_image` varchar(64) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`manufacturers_id`),
  KEY `IDX_MANUFACTURERS_NAME` (`manufacturers_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Tablo döküm verisi `manufacturers`
--

INSERT INTO `manufacturers` (`manufacturers_id`, `manufacturers_name`, `manufacturers_image`, `date_added`, `last_modified`) VALUES
(1, 'Matrox', 'manufacturer_matrox.gif', '2013-08-07 14:38:04', NULL),
(2, 'Microsoft', 'manufacturer_microsoft.gif', '2013-08-07 14:38:04', NULL),
(3, 'Warner', 'manufacturer_warner.gif', '2013-08-07 14:38:04', NULL),
(4, 'Fox', 'manufacturer_fox.gif', '2013-08-07 14:38:04', NULL),
(5, 'Logitech', 'manufacturer_logitech.gif', '2013-08-07 14:38:04', NULL),
(6, 'Canon', 'manufacturer_canon.gif', '2013-08-07 14:38:04', NULL),
(7, 'Sierra', 'manufacturer_sierra.gif', '2013-08-07 14:38:04', NULL),
(8, 'GT Interactive', 'manufacturer_gt_interactive.gif', '2013-08-07 14:38:04', NULL),
(9, 'Hewlett Packard', 'manufacturer_hewlett_packard.gif', '2013-08-07 14:38:04', NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `manufacturers_info`
--

CREATE TABLE IF NOT EXISTS `manufacturers_info` (
  `manufacturers_id` int(11) NOT NULL,
  `languages_id` int(11) NOT NULL,
  `manufacturers_url` varchar(255) NOT NULL,
  `url_clicked` int(5) NOT NULL DEFAULT '0',
  `date_last_click` datetime DEFAULT NULL,
  `manufacturers_htc_title_tag` varchar(80) DEFAULT NULL,
  `manufacturers_htc_desc_tag` longtext,
  `manufacturers_htc_keywords_tag` longtext,
  `manufacturers_htc_description` longtext,
  PRIMARY KEY (`manufacturers_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `manufacturers_info`
--

INSERT INTO `manufacturers_info` (`manufacturers_id`, `languages_id`, `manufacturers_url`, `url_clicked`, `date_last_click`, `manufacturers_htc_title_tag`, `manufacturers_htc_desc_tag`, `manufacturers_htc_keywords_tag`, `manufacturers_htc_description`) VALUES
(1, 1, 'http://www.matrox.com', 0, NULL, NULL, NULL, NULL, NULL),
(1, 2, 'http://www.matrox.de', 0, NULL, NULL, NULL, NULL, NULL),
(1, 3, 'http://www.matrox.com', 0, NULL, NULL, NULL, NULL, NULL),
(2, 1, 'http://www.microsoft.com', 0, NULL, NULL, NULL, NULL, NULL),
(2, 2, 'http://www.microsoft.de', 0, NULL, NULL, NULL, NULL, NULL),
(2, 3, 'http://www.microsoft.es', 0, NULL, NULL, NULL, NULL, NULL),
(3, 1, 'http://www.warner.com', 0, NULL, NULL, NULL, NULL, NULL),
(3, 2, 'http://www.warner.de', 0, NULL, NULL, NULL, NULL, NULL),
(3, 3, 'http://www.warner.com', 0, NULL, NULL, NULL, NULL, NULL),
(4, 1, 'http://www.fox.com', 0, NULL, NULL, NULL, NULL, NULL),
(4, 2, 'http://www.fox.de', 0, NULL, NULL, NULL, NULL, NULL),
(4, 3, 'http://www.fox.com', 0, NULL, NULL, NULL, NULL, NULL),
(5, 1, 'http://www.logitech.com', 0, NULL, NULL, NULL, NULL, NULL),
(5, 2, 'http://www.logitech.com', 0, NULL, NULL, NULL, NULL, NULL),
(5, 3, 'http://www.logitech.com', 0, NULL, NULL, NULL, NULL, NULL),
(6, 1, 'http://www.canon.com', 0, NULL, NULL, NULL, NULL, NULL),
(6, 2, 'http://www.canon.de', 0, NULL, NULL, NULL, NULL, NULL),
(6, 3, 'http://www.canon.es', 0, NULL, NULL, NULL, NULL, NULL),
(7, 1, 'http://www.sierra.com', 0, NULL, NULL, NULL, NULL, NULL),
(7, 2, 'http://www.sierra.de', 0, NULL, NULL, NULL, NULL, NULL),
(7, 3, 'http://www.sierra.com', 0, NULL, NULL, NULL, NULL, NULL),
(8, 1, 'http://www.infogrames.com', 0, NULL, NULL, NULL, NULL, NULL),
(8, 2, 'http://www.infogrames.de', 0, NULL, NULL, NULL, NULL, NULL),
(8, 3, 'http://www.infogrames.com', 0, NULL, NULL, NULL, NULL, NULL),
(9, 1, 'http://www.hewlettpackard.com', 0, NULL, NULL, NULL, NULL, NULL),
(9, 2, 'http://www.hewlettpackard.de', 0, NULL, NULL, NULL, NULL, NULL),
(9, 3, 'http://welcome.hp.com/country/es/spa/welcome.htm', 0, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `newsletters`
--

CREATE TABLE IF NOT EXISTS `newsletters` (
  `newsletters_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `module` varchar(255) NOT NULL,
  `date_added` datetime NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `locked` int(1) DEFAULT '0',
  `send_to_customer_groups` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`newsletters_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `orders_id` int(11) NOT NULL AUTO_INCREMENT,
  `customers_id` int(11) NOT NULL,
  `customers_name` varchar(64) NOT NULL,
  `customers_company` varchar(32) DEFAULT NULL,
  `customers_street_address` varchar(64) NOT NULL,
  `customers_suburb` varchar(32) DEFAULT NULL,
  `customers_city` varchar(32) NOT NULL,
  `customers_postcode` varchar(10) NOT NULL,
  `customers_state` varchar(32) DEFAULT NULL,
  `customers_country` varchar(32) NOT NULL,
  `customers_telephone` varchar(32) NOT NULL,
  `customers_email_address` varchar(96) NOT NULL,
  `customers_address_format_id` int(5) NOT NULL,
  `delivery_name` varchar(64) NOT NULL,
  `delivery_company` varchar(32) DEFAULT NULL,
  `delivery_street_address` varchar(64) NOT NULL,
  `delivery_suburb` varchar(32) DEFAULT NULL,
  `delivery_city` varchar(32) NOT NULL,
  `delivery_postcode` varchar(10) NOT NULL,
  `delivery_state` varchar(32) DEFAULT NULL,
  `delivery_country` varchar(32) NOT NULL,
  `delivery_address_format_id` int(5) NOT NULL,
  `billing_name` varchar(64) NOT NULL,
  `billing_company` varchar(32) DEFAULT NULL,
  `billing_street_address` varchar(64) NOT NULL,
  `billing_suburb` varchar(32) DEFAULT NULL,
  `billing_city` varchar(32) NOT NULL,
  `billing_postcode` varchar(10) NOT NULL,
  `billing_state` varchar(32) DEFAULT NULL,
  `billing_country` varchar(32) NOT NULL,
  `billing_address_format_id` int(5) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `cc_type` varchar(20) DEFAULT NULL,
  `cc_owner` varchar(64) DEFAULT NULL,
  `cc_number` varchar(32) DEFAULT NULL,
  `cc_expires` varchar(4) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_purchased` datetime DEFAULT NULL,
  `orders_status` int(5) NOT NULL,
  `orders_date_finished` datetime DEFAULT NULL,
  `currency` char(3) DEFAULT NULL,
  `currency_value` decimal(14,6) DEFAULT NULL,
  PRIMARY KEY (`orders_id`),
  KEY `idx_orders_customers_id` (`customers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;



--
-- Tablo için tablo yap?s? `orders_products`
--

CREATE TABLE IF NOT EXISTS `orders_products` (
  `orders_products_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `products_model` varchar(12) DEFAULT NULL,
  `products_name` varchar(64) NOT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `final_price` decimal(15,4) NOT NULL,
  `products_tax` decimal(7,4) NOT NULL,
  `products_quantity` int(2) NOT NULL,
  `products_currency` varchar(3) NOT NULL,
  `currency_value` decimal(14,6) DEFAULT NULL,
  PRIMARY KEY (`orders_products_id`),
  KEY `idx_orders_products_orders_id` (`orders_id`),
  KEY `idx_orders_products_products_id` (`products_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;



-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `orders_products_attributes`
--

CREATE TABLE IF NOT EXISTS `orders_products_attributes` (
  `orders_products_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `orders_products_id` int(11) NOT NULL,
  `products_options` varchar(32) NOT NULL,
  `products_options_values` varchar(32) NOT NULL,
  `options_values_price` decimal(15,4) NOT NULL,
  `price_prefix` char(1) NOT NULL,
  PRIMARY KEY (`orders_products_attributes_id`),
  KEY `idx_orders_products_att_orders_id` (`orders_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `orders_products_attributes`
--


-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `orders_products_download`
--

CREATE TABLE IF NOT EXISTS `orders_products_download` (
  `orders_products_download_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL DEFAULT '0',
  `orders_products_id` int(11) NOT NULL DEFAULT '0',
  `orders_products_filename` varchar(255) NOT NULL DEFAULT '',
  `download_maxdays` int(2) NOT NULL DEFAULT '0',
  `download_count` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`orders_products_download_id`),
  KEY `idx_orders_products_download_orders_id` (`orders_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `orders_status`
--

CREATE TABLE IF NOT EXISTS `orders_status` (
  `orders_status_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `orders_status_name` varchar(32) NOT NULL,
  `public_flag` int(11) DEFAULT '1',
  `downloads_flag` int(11) DEFAULT '0',
  PRIMARY KEY (`orders_status_id`,`language_id`),
  KEY `idx_orders_status_name` (`orders_status_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `orders_status`
--

INSERT INTO `orders_status` (`orders_status_id`, `language_id`, `orders_status_name`, `public_flag`, `downloads_flag`) VALUES
(1, 1, 'Pending', 1, 0),
(1, 2, 'Offen', 1, 0),
(1, 3, 'Pendiente', 1, 0),
(1, 4, 'Beklemede', 1, 0),
(2, 1, 'Processing', 1, 1),
(2, 2, 'In Bearbeitung', 1, 1),
(2, 3, 'Proceso', 1, 1),
(2, 4, 'Ä°ÅŸleme AlÄ±ndÄ±', 1, 1),
(3, 1, 'Delivered', 1, 1),
(3, 2, 'Versendet', 1, 1),
(3, 3, 'Entregado', 1, 1),
(3, 4, 'Kargoya Verildi', 1, 1),
(4, 1, 'Preparing [ChronoPay]', 0, 0),
(4, 2, 'Preparing [ChronoPay]', 0, 0),
(4, 3, 'Preparing [ChronoPay]', 0, 0),
(4, 4, 'Preparing [ChronoPay]', 0, 0),
(5, 1, 'Preparing [PayPal Standard]', 0, 0),
(5, 2, 'Preparing [PayPal Standard]', 0, 0),
(5, 3, 'Preparing [PayPal Standard]', 0, 0),
(5, 4, 'Preparing [PayPal Standard]', 0, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `orders_status_history`
--

CREATE TABLE IF NOT EXISTS `orders_status_history` (
  `orders_status_history_id` int(11) NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `orders_status_id` int(5) NOT NULL,
  `date_added` datetime NOT NULL,
  `customer_notified` int(1) DEFAULT '0',
  `comments` text,
  PRIMARY KEY (`orders_status_history_id`),
  KEY `idx_orders_status_history_orders_id` (`orders_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Tablo döküm verisi `orders_status_history`
--



-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `orders_total`
--

CREATE TABLE IF NOT EXISTS `orders_total` (
  `orders_total_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orders_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `value` decimal(15,4) NOT NULL,
  `class` varchar(32) NOT NULL,
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`orders_total_id`),
  KEY `idx_orders_total_orders_id` (`orders_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;



-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_quantity` int(4) NOT NULL,
  `products_model` varchar(12) DEFAULT NULL,
  `products_image` varchar(64) DEFAULT NULL,
  `products_price` decimal(15,4) NOT NULL,
  `products_date_added` datetime NOT NULL,
  `products_last_modified` datetime DEFAULT NULL,
  `products_date_available` datetime DEFAULT NULL,
  `products_weight` decimal(5,2) NOT NULL,
  `products_status` tinyint(1) NOT NULL,
  `products_tax_class_id` int(11) NOT NULL,
  `manufacturers_id` int(11) DEFAULT NULL,
  `products_ordered` int(11) NOT NULL DEFAULT '0',
  `products_currency` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`products_id`),
  KEY `idx_products_model` (`products_model`),
  KEY `idx_products_date_added` (`products_date_added`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`products_id`, `products_quantity`, `products_model`, `products_image`, `products_price`, `products_date_added`, `products_last_modified`, `products_date_available`, `products_weight`, `products_status`, `products_tax_class_id`, `manufacturers_id`, `products_ordered`, `products_currency`) VALUES
(1, 32, 'MG200MMS', 'matrox/mg200mms.gif', 299.9900, '2013-08-07 14:38:04', NULL, NULL, 23.00, 1, 1, 1, 0, 'USD'),
(2, 32, 'MG400-32MB', 'matrox/mg400-32mb.gif', 499.9900, '2013-08-07 14:38:04', NULL, NULL, 23.00, 1, 1, 1, 0, 'USD'),
(3, 2, 'MSIMPRO', 'microsoft/msimpro.gif', 49.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(4, 13, 'DVD-RPMK', 'dvd/replacement_killers.gif', 42.0000, '2013-08-07 14:38:04', NULL, NULL, 23.00, 1, 1, 2, 0, 'USD'),
(5, 17, 'DVD-BLDRNDC', 'dvd/blade_runner.gif', 35.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(6, 10, 'DVD-MATR', 'dvd/the_matrix.gif', 39.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(7, 10, 'DVD-YGEM', 'dvd/youve_got_mail.gif', 34.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(8, 10, 'DVD-ABUG', 'dvd/a_bugs_life.gif', 35.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(9, 10, 'DVD-UNSG', 'dvd/under_siege.gif', 29.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(10, 10, 'DVD-UNSG2', 'dvd/under_siege2.gif', 29.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(11, 10, 'DVD-FDBL', 'dvd/fire_down_below.gif', 29.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(12, 10, 'DVD-DHWV', 'dvd/die_hard_3.gif', 39.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 4, 0, 'USD'),
(13, 10, 'DVD-LTWP', 'dvd/lethal_weapon.gif', 34.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(14, 10, 'DVD-REDC', 'dvd/red_corner.gif', 32.0000, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(15, 10, 'DVD-FRAN', 'dvd/frantic.gif', 35.0000, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 0, 'USD'),
(16, 10, 'DVD-CUFI', 'dvd/courage_under_fire.gif', 38.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 4, 0, 'USD'),
(17, 10, 'DVD-SPEED', 'dvd/speed.gif', 39.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 4, 0, 'USD'),
(18, 10, 'DVD-SPEED2', 'dvd/speed_2.gif', 42.0000, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 4, 0, 'USD'),
(19, 10, 'DVD-TSAB', 'dvd/theres_something_about_mary.gif', 49.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 4, 0, 'USD'),
(20, 8, 'DVD-BELOVED', 'dvd/beloved.gif', 54.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 3, 2, 'USD'),
(21, 16, 'PC-SWAT3', 'sierra/swat_3.gif', 79.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 7, 0, 'USD'),
(22, 13, 'PC-UNTM', 'gt_interactive/unreal_tournament.gif', 89.9900, '2013-08-07 14:38:04', NULL, NULL, 7.00, 1, 1, 8, 0, 'USD'),
(23, 16, 'PC-TWOF', 'gt_interactive/wheel_of_time.gif', 99.9900, '2013-08-07 14:38:04', NULL, NULL, 10.00, 1, 1, 8, 0, 'USD'),
(24, 17, 'PC-DISC', 'gt_interactive/disciples.gif', 90.0000, '2013-08-07 14:38:04', NULL, NULL, 8.00, 1, 1, 8, 0, 'USD'),
(25, 16, 'MSINTKB', 'microsoft/intkeyboardps2.gif', 69.9900, '2013-08-07 14:38:04', NULL, NULL, 8.00, 1, 1, 2, 0, 'USD'),
(26, 10, 'MSIMEXP', 'microsoft/imexplorer.gif', 64.9500, '2013-08-07 14:38:04', NULL, NULL, 8.00, 1, 1, 2, 0, 'USD'),
(27, 8, 'HPLJ1100XI', 'hewlett_packard/lj1100xi.gif', 499.9900, '2013-08-07 14:38:04', NULL, NULL, 45.00, 1, 1, 9, 0, 'USD');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_attributes`
--

CREATE TABLE IF NOT EXISTS `products_attributes` (
  `products_attributes_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `options_id` int(11) NOT NULL,
  `options_values_id` int(11) NOT NULL,
  `options_values_price` decimal(15,4) NOT NULL,
  `price_prefix` char(1) NOT NULL,
  PRIMARY KEY (`products_attributes_id`),
  KEY `idx_products_attributes_products_id` (`products_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=34 ;

--
-- Tablo döküm verisi `products_attributes`
--

INSERT INTO `products_attributes` (`products_attributes_id`, `products_id`, `options_id`, `options_values_id`, `options_values_price`, `price_prefix`) VALUES
(26, 22, 5, 10, 0.0000, '+'),
(27, 22, 5, 13, 0.0000, '+'),
(29, 53, 4, 3, 0.0000, '+'),
(30, 53, 3, 9, 12.0000, '+'),
(31, 53, 4, 1, 0.0000, '+'),
(32, 53, 4, 4, 21.0000, '+'),
(33, 53, 3, 7, 15.0000, '+');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_attributes_download`
--

CREATE TABLE IF NOT EXISTS `products_attributes_download` (
  `products_attributes_id` int(11) NOT NULL,
  `products_attributes_filename` varchar(255) NOT NULL DEFAULT '',
  `products_attributes_maxdays` int(2) DEFAULT '0',
  `products_attributes_maxcount` int(2) DEFAULT '0',
  PRIMARY KEY (`products_attributes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `products_attributes_download`
--

INSERT INTO `products_attributes_download` (`products_attributes_id`, `products_attributes_filename`, `products_attributes_maxdays`, `products_attributes_maxcount`) VALUES
(26, 'unreal.zip', 7, 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_attributes_groups`
--

CREATE TABLE IF NOT EXISTS `products_attributes_groups` (
  `products_attributes_id` int(11) NOT NULL DEFAULT '0',
  `customers_group_id` smallint(5) NOT NULL DEFAULT '0',
  `options_values_price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `price_prefix` char(1) NOT NULL DEFAULT '',
  `products_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customers_group_id`,`products_attributes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_description`
--

CREATE TABLE IF NOT EXISTS `products_description` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_id` int(11) NOT NULL DEFAULT '1',
  `products_name` varchar(64) NOT NULL DEFAULT '',
  `products_description` text,
  `products_url` varchar(255) DEFAULT NULL,
  `products_viewed` int(5) DEFAULT '0',
  `products_head_title_tag` varchar(80) DEFAULT NULL,
  `products_head_desc_tag` longtext,
  `products_head_keywords_tag` longtext,
  PRIMARY KEY (`products_id`,`language_id`),
  KEY `products_name` (`products_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Tablo döküm verisi `products_description`
--

INSERT INTO `products_description` (`products_id`, `language_id`, `products_name`, `products_description`, `products_url`, `products_viewed`, `products_head_title_tag`, `products_head_desc_tag`, `products_head_keywords_tag`) VALUES
(1, 1, 'Matrox G200 MMS', 'Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8&quot; PCI board.<br><br>With continuing demand for digital flat panels in the financial workplace, the Matrox G200 MMS is the ultimate in flexible solutions. The Matrox G200 MMS also supports the new digital video interface (DVI) created by the Digital Display Working Group (DDWG) designed to ease the adoption of digital flat panels. Other configurations include composite video capture ability and onboard TV tuner, making the Matrox G200 MMS the complete solution for business needs.<br><br>Based on the award-winning MGA-G200 graphics chip, the Matrox G200 Multi-Monitor Series provides superior 2D/3D graphics acceleration to meet the demanding needs of business applications such as real-time stock quotes (Versus), live video feeds (Reuters & Bloombergs), multiple windows applications, word processing, spreadsheets and CAD.', 'www.matrox.com/mga/products/g200_mms/home.cfm', 0, NULL, NULL, NULL),
(1, 2, 'Matrox G200 MMS', '<b>Unterstützung für zwei bzw. vier analoge oder digitale Monitore</b><br><br>\r\nDie Matrox G200 Multi-Monitor-Serie führt die bewährte Matrox Tradition im Multi-Monitor- Bereich fort und bietet flexible und fortschrittliche Lösungen.Matrox stellt als erstes Unternehmen einen vierfachen digitalen PanelLink® DVI Flachbildschirm Ausgang zur Verfügung. Mit den optional erhältlichen TV Tuner und Video-Capture Möglichkeiten stellt die Matrox G200 MMS eine alles umfassende Mehrschirm-Lösung dar.<br><br>\r\n<b>Leistungsmerkmale:</b>\r\n<ul>\r\n<li>Preisgekrönter Matrox G200 128-Bit Grafikchip</li>\r\n<li>Schneller 8 MB SGRAM-Speicher pro Kanal</li>\r\n<li>Integrierter, leistungsstarker 250 MHz RAMDAC</li>\r\n<li>Unterstützung für bis zu 16 Bildschirme über 4 Quad-Karten (unter Win NT,ab Treiber 4.40)</li>\r\n<li>Unterstützung von 9 Monitoren unter Win 98</li>\r\n<li>2 bzw. 4 analoge oder digitale Ausgabekanäle pro PCI-Karte</li>\r\n<li>Desktop-Darstellung von 1800 x 1440 oder 1920 x 1200 pro Chip</li>\r\n<li>Anschlußmöglichkeit an einen 15-poligen VGA-Monitor oder an einen 30-poligen digitalen DVI-Flachbildschirm plus integriertem Composite-Video-Eingang (bei der TV-Version)</li>\r\n<li>PCI Grafikkarte, kurze Baulänge</li>\r\n<li>Treiberunterstützung: Windows® 2000, Windows NT® und Windows® 98</li>\r\n<li>Anwendungsbereiche: Börsenumgebung mit zeitgleich großem Visualisierungsbedarf, Videoüberwachung, Video-Conferencing</li>\r\n</ul>', 'www.matrox.com/mga/deutsch/products/g200_mms/home.cfm', 0, NULL, NULL, NULL),
(1, 3, 'Matrox G200 MMS', 'Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8&quot; PCI board.<br><br>With continuing demand for digital flat panels in the financial workplace, the Matrox G200 MMS is the ultimate in flexible solutions. The Matrox G200 MMS also supports the new digital video interface (DVI) created by the Digital Display Working Group (DDWG) designed to ease the adoption of digital flat panels. Other configurations include composite video capture ability and onboard TV tuner, making the Matrox G200 MMS the complete solution for business needs.<br><br>Based on the award-winning MGA-G200 graphics chip, the Matrox G200 Multi-Monitor Series provides superior 2D/3D graphics acceleration to meet the demanding needs of business applications such as real-time stock quotes (Versus), live video feeds (Reuters & Bloombergs), multiple windows applications, word processing, spreadsheets and CAD.', 'www.matrox.com/mga/products/g200_mms/home.cfm', 0, NULL, NULL, NULL),
(1, 4, 'Matrox G200 MMS', 'Reinforcing its position as a multi-monitor trailblazer, Matrox Graphics Inc. has once again developed the most flexible and highly advanced solution in the industry. Introducing the new Matrox G200 Multi-Monitor Series; the first graphics card ever to support up to four DVI digital flat panel displays on a single 8&quot; PCI board.<br><br>With continuing demand for digital flat panels in the financial workplace, the Matrox G200 MMS is the ultimate in flexible solutions. The Matrox G200 MMS also supports the new digital video interface (DVI) created by the Digital Display Working Group (DDWG) designed to ease the adoption of digital flat panels. Other configurations include composite video capture ability and onboard TV tuner, making the Matrox G200 MMS the complete solution for business needs.<br><br>Based on the award-winning MGA-G200 graphics chip, the Matrox G200 Multi-Monitor Series provides superior 2D/3D graphics acceleration to meet the demanding needs of business applications such as real-time stock quotes (Versus), live video feeds (Reuters & Bloombergs), multiple windows applications, word processing, spreadsheets and CAD.', 'www.matrox.com/mga/products/g200_mms/home.cfm', 0, NULL, NULL, NULL),
(2, 1, 'Matrox G400 32MB', '<b>Dramatically Different High Performance Graphics</b><br><br>Introducing the Millennium G400 Series - a dramatically different, high performance graphics experience. Armed with the industry''s fastest graphics chip, the Millennium G400 Series takes explosive acceleration two steps further by adding unprecedented image quality, along with the most versatile display options for all your 3D, 2D and DVD applications. As the most powerful and innovative tools in your PC''s arsenal, the Millennium G400 Series will not only change the way you see graphics, but will revolutionize the way you use your computer.<br><br><b>Key features:</b><ul><li>New Matrox G400 256-bit DualBus graphics chip</li><li>Explosive 3D, 2D and DVD performance</li><li>DualHead Display</li><li>Superior DVD and TV output</li><li>3D Environment-Mapped Bump Mapping</li><li>Vibrant Color Quality rendering </li><li>UltraSharp DAC of up to 360 MHz</li><li>3D Rendering Array Processor</li><li>Support for 16 or 32 MB of memory</li></ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', 0, NULL, NULL, NULL),
(2, 2, 'Matrox G400 32 MB', '<b>Neu! Matrox G400 &quot;all inclusive&quot; und vieles mehr...</b><br><br>\r\nDie neue Millennium G400-Serie - Hochleistungsgrafik mit dem sensationellen Unterschied. Ausgestattet mit dem neu eingeführten Matrox G400 Grafikchip, bietet die Millennium G400-Serie eine überragende Beschleunigung inklusive bisher nie dagewesener Bildqualitat und enorm flexibler Darstellungsoptionen bei allen Ihren 3D-, 2D- und DVD-Anwendungen.<br><br>\r\n<ul>\r\n<li>DualHead Display und TV-Ausgang</li>\r\n<li>Environment Mapped Bump Mapping</li>\r\n<li>Matrox G400 256-Bit DualBus</li>\r\n<li>3D Rendering Array Prozessor</li>\r\n<li>Vibrant Color Quality² (VCQ²)</li>\r\n<li>UltraSharp DAC</li>\r\n</ul>\r\n<i>&quot;Bleibt abschließend festzustellen, daß die Matrox Millennium G400 Max als Allroundkarte für den Highend-PC derzeit unerreicht ist. Das ergibt den Testsieg und unsere wärmste Empfehlung.&quot;</i><br>\r\n<b>GameStar 8/99 (S.184)</b>', 'www.matrox.com/mga/deutsch/products/mill_g400/home.cfm', 0, NULL, NULL, NULL),
(2, 3, 'Matrox G400 32MB', '<b>Dramatically Different High Performance Graphics</b><br><br>Introducing the Millennium G400 Series - a dramatically different, high performance graphics experience. Armed with the industry''s fastest graphics chip, the Millennium G400 Series takes explosive acceleration two steps further by adding unprecedented image quality, along with the most versatile display options for all your 3D, 2D and DVD applications. As the most powerful and innovative tools in your PC''s arsenal, the Millennium G400 Series will not only change the way you see graphics, but will revolutionize the way you use your computer.<br><br><b>Key features:</b><ul><li>New Matrox G400 256-bit DualBus graphics chip</li><li>Explosive 3D, 2D and DVD performance</li><li>DualHead Display</li><li>Superior DVD and TV output</li><li>3D Environment-Mapped Bump Mapping</li><li>Vibrant Color Quality rendering </li><li>UltraSharp DAC of up to 360 MHz</li><li>3D Rendering Array Processor</li><li>Support for 16 or 32 MB of memory</li></ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', 0, NULL, NULL, NULL),
(2, 4, 'Matrox G400 32MB', '<b>Dramatically Different High Performance Graphics</b><br><br>Introducing the Millennium G400 Series - a dramatically different, high performance graphics experience. Armed with the industry''s fastest graphics chip, the Millennium G400 Series takes explosive acceleration two steps further by adding unprecedented image quality, along with the most versatile display options for all your 3D, 2D and DVD applications. As the most powerful and innovative tools in your PC''s arsenal, the Millennium G400 Series will not only change the way you see graphics, but will revolutionize the way you use your computer.<br><br><b>Key features:</b><ul><li>New Matrox G400 256-bit DualBus graphics chip</li><li>Explosive 3D, 2D and DVD performance</li><li>DualHead Display</li><li>Superior DVD and TV output</li><li>3D Environment-Mapped Bump Mapping</li><li>Vibrant Color Quality rendering </li><li>UltraSharp DAC of up to 360 MHz</li><li>3D Rendering Array Processor</li><li>Support for 16 or 32 MB of memory</li></ul>', 'www.matrox.com/mga/products/mill_g400/home.htm', 0, NULL, NULL, NULL),
(3, 1, 'Microsoft IntelliMouse Pro', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft''s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.', 'www.microsoft.com/hardware/mouse/intellimouse.asp', 0, NULL, NULL, NULL),
(3, 2, 'Microsoft IntelliMouse Pro', 'Die IntelliMouse Pro hat mit der IntelliRad-Technologie einen neuen Standard gesetzt. Anwenderfreundliche Handhabung und produktiveres Arbeiten am PC zeichnen die IntelliMouse aus. Die gewölbte Oberseite paßt sich natürlich in die Handfläche ein, die geschwungene Form erleichtert das Bedienen der Maus. Sie ist sowohl für Rechts- wie auch für Linkshänder geeignet. Mit dem Rad der IntelliMouse kann der Anwender einfach und komfortabel durch Dokumente navigieren.<br><br>\r\n<b>Eigenschaften:</b>\r\n<ul>\r\n<li><b>ANSCHLUSS:</b> PS/2</li>\r\n<li><b>FARBE:</b> weiß</li>\r\n<li><b>TECHNIK:</b> Mauskugel</li>\r\n<li><b>TASTEN:</b> 3 (incl. Scrollrad)</li>\r\n<li><b>SCROLLRAD:</b> Ja</li>\r\n</ul>', '', 0, NULL, NULL, NULL),
(3, 3, 'Microsoft IntelliMouse Pro', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft''s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.', 'www.microsoft.com/hardware/mouse/intellimouse.asp', 0, NULL, NULL, NULL),
(3, 4, 'Microsoft IntelliMouse Pro', 'Every element of IntelliMouse Pro - from its unique arched shape to the texture of the rubber grip around its base - is the product of extensive customer and ergonomic research. Microsoft''s popular wheel control, which now allows zooming and universal scrolling functions, gives IntelliMouse Pro outstanding comfort and efficiency.', 'www.microsoft.com/hardware/mouse/intellimouse.asp', 0, NULL, NULL, NULL),
(4, 1, 'The Replacement Killers', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 80 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.replacement-killers.com', 0, NULL, NULL, NULL),
(4, 2, 'Die Ersatzkiller', 'Originaltitel: &quot;The Replacement Killers&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 80 minutes.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\n(USA 1998). Til Schweiger schießt auf Hongkong-Star Chow Yun-Fat (&quot;Anna und der König&quot;) ­ ein Fehler ...', 'www.replacement-killers.com', 0, NULL, NULL, NULL),
(4, 3, 'The Replacement Killers', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 80 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.replacement-killers.com', 0, NULL, NULL, NULL),
(4, 4, 'The Replacement Killers', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 80 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.replacement-killers.com', 0, NULL, NULL, NULL),
(5, 1, 'Blade Runner - Director''s Cut', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.bladerunner.com', 0, NULL, NULL, NULL),
(5, 2, 'Blade Runner - Director''s Cut', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 112 minutes.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\n<b>Sci-Fi-Klassiker, USA 1983, 112 Min.</b><br><br>\r\nLos Angeles ist im Jahr 2019 ein Hexenkessel. Dauerregen und Smog tauchen den überbevölkerten Moloch in ewige Dämmerung. Polizeigleiter schwirren durch die Luft und überwachen das grelle Ethnogemisch, das sich am Fuße 400stöckiger Stahlbeton-Pyramiden tummelt. Der abgehalfterte Ex-Cop und "Blade Runner" Rick Deckard ist Spezialist für die Beseitigung von Replikanten, künstlichen Menschen, geschaffen für harte Arbeit auf fremden Planeten. Nur ihm kann es gelingen, vier flüchtige, hochintelligente "Nexus 6"-Spezialmodelle zu stellen. Die sind mit ihrem starken und brandgefährlichen Anführer Batty auf der Suche nach ihrem Schöpfer. Er soll ihnen eine längere Lebenszeit schenken. Das muß Rick Deckard verhindern.  Als sich der eiskalte Jäger in Rachel, die Sekretärin seines Auftraggebers, verliebt, gerät sein Weltbild jedoch ins Wanken. Er entdeckt, daß sie - vielleicht wie er selbst - ein Replikant ist ...<br><br>\r\nDie Konfrontation des Menschen mit "Realität" und "Virtualität" und das verstrickte Spiel mit getürkten Erinnerungen zieht sich als roter Faden durch das Werk von Autor Philip K. Dick ("Die totale Erinnerung"). Sein Roman "Träumen Roboter von elektrischen Schafen?" liefert die Vorlage für diesen doppelbödigen Thriller, der den Zuschauer mit faszinierenden\r\nZukunftsvisionen und der gigantischen Kulisse des Großstadtmolochs gefangen nimmt.', 'www.bladerunner.com', 0, NULL, NULL, NULL),
(5, 3, 'Blade Runner - Director''s Cut', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.bladerunner.com', 0, NULL, NULL, NULL),
(5, 4, 'Blade Runner - Director''s Cut', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>Languages: English, Deutsch.<br>Subtitles: English, Deutsch, Spanish.<br>Audio: Dolby Surround 5.1.<br>Picture Format: 16:9 Wide-Screen.<br>Length: (approx) 112 minutes.<br>Other: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.bladerunner.com', 0, NULL, NULL, NULL),
(6, 1, 'The Matrix', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch.\r<br>\nAudio: Dolby Surround.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 131 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Making Of.', 'www.thematrix.com', 0, NULL, NULL, NULL),
(6, 2, 'Matrix', 'Originaltitel: &quot;The Matrix&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 136 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\n(USA 1999) Der Geniestreich der Wachowski-Brüder. In dieser technisch perfekten Utopie kämpft Hacker Keanu Reeves gegen die Diktatur der Maschinen...', 'www.whatisthematrix.com', 0, NULL, NULL, NULL),
(6, 3, 'The Matrix', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch.\r<br>\nAudio: Dolby Surround.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 131 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Making Of.', 'www.thematrix.com', 0, NULL, NULL, NULL),
(6, 4, 'The Matrix', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch.\r<br>\nAudio: Dolby Surround.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 131 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Making Of.', 'www.thematrix.com', 0, NULL, NULL, NULL),
(7, 1, 'You''ve Got Mail', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch, Spanish.\r<br>\nSubtitles: English, Deutsch, Spanish, French, Nordic, Polish.\r<br>\nAudio: Dolby Digital 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 115 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.youvegotmail.com', 0, NULL, NULL, NULL),
(7, 2, 'e-m@il für Dich', 'Original: &quot;You''ve got mail&quot;<br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 112 minutes.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\n(USA 1998) von Nora Ephron (&qout;Schlaflos in Seattle&quot;). Meg Ryan und Tom Hanks knüpfen per E-Mail zarte Bande. Dass sie sich schon kennen, ahnen sie nicht ...', 'www.youvegotmail.com', 0, NULL, NULL, NULL),
(7, 3, 'You''ve Got Mail', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch, Spanish.\r<br>\nSubtitles: English, Deutsch, Spanish, French, Nordic, Polish.\r<br>\nAudio: Dolby Digital 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 115 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.youvegotmail.com', 0, NULL, NULL, NULL),
(7, 4, 'You''ve Got Mail', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch, Spanish.\r<br>\nSubtitles: English, Deutsch, Spanish, French, Nordic, Polish.\r<br>\nAudio: Dolby Digital 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 115 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.youvegotmail.com', 0, NULL, NULL, NULL),
(8, 1, 'A Bug''s Life', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Digital 5.1 / Dobly Surround Stereo.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 91 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', 0, NULL, NULL, NULL),
(8, 2, 'Das Große Krabbeln', 'Originaltitel: &quot;A Bug''s Life&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\n(USA 1998). Ameise Flik zettelt einen Aufstand gegen gefräßige Grashüpfer an ... Eine fantastische Computeranimation des "Toy Story"-Teams. ', 'www.abugslife.com', 0, NULL, NULL, NULL),
(8, 3, 'A Bug''s Life', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Digital 5.1 / Dobly Surround Stereo.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 91 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', 0, NULL, NULL, NULL),
(8, 4, 'A Bug''s Life', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Digital 5.1 / Dobly Surround Stereo.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 91 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', 'www.abugslife.com', 0, NULL, NULL, NULL),
(9, 1, 'Under Siege', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 98 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(9, 2, 'Alarmstufe: Rot', 'Originaltitel: &quot;Under Siege&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\n<b>Actionthriller. Smutje Steven Seagal versalzt Schurke Tommy Lee Jones die Suppe</b><br><br>\r\nKatastrophe ahoi: Kurz vor Ausmusterung der "U.S.S. Missouri" kapert die High-tech-Bande von Ex-CIA-Agent Strannix (Tommy Lee Jones) das Schlachtschiff. Strannix will die Nuklearraketen des Kreuzers klauen und verscherbeln. Mit Hilfe des irren Ersten Offiziers Krill (lustig: Gary Busey) killen die Gangster den Käpt’n und sperren seine Crew unter Deck. Blöd, dass sie dabei Schiffskoch Rybak (Steven Seagal) vergessen. Der Ex-Elitekämpfer knipst einen Schurken nach dem anderen aus. Eine Verbündete findet er in Stripperin Jordan (Ex-"Baywatch"-Biene Erika Eleniak). Die sollte eigentlich aus Käpt’ns Geburtstagstorte hüpfen ... Klar: Seagal ist kein Edelmime. Dafür ist Regisseur Andrew Davis ("Auf der Flucht") ein Könner: Er würzt die Action-Orgie mit Ironie und nutzt die imposante Schiffskulisse voll aus. Für Effekte und Ton gab es 1993 Oscar-Nominierungen. ', '', 0, NULL, NULL, NULL),
(9, 3, 'Under Siege', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 98 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(9, 4, 'Under Siege', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 98 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(10, 1, 'Under Siege 2 - Dark Territory', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 98 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(10, 2, 'Alarmstufe: Rot 2', 'Originaltitel: &quot;Under Siege 2: Dark Territory&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\n(USA ’95). Von einem gekaperten Zug aus übernimmt Computerspezi Dane die Kontrolle über einen Kampfsatelliten und erpresst das Pentagon. Aber auch Ex-Offizier Ryback (Steven Seagal) ist im Zug ...\r\n', '', 0, NULL, NULL, NULL),
(10, 3, 'Under Siege 2 - Dark Territory', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 98 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(10, 4, 'Under Siege 2 - Dark Territory', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 98 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(11, 1, 'Fire Down Below', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 100 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(11, 2, 'Fire Down Below', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\nEin mysteriöser Mordfall führt den Bundesmarschall Jack Taggert in eine Kleinstadt im US-Staat Kentucky. Doch bei seinen Ermittlungen stößt er auf eine Mauer des Schweigens. Angst beherrscht die Stadt, und alle Spuren führen zu dem undurchsichtigen Minen-Tycoon Orin Hanner. Offenbar werden in der friedlichen Berglandschaft gigantische Mengen Giftmülls verschoben, mit unkalkulierbaren Risiken. Um eine Katastrophe zu verhindern, räumt Taggert gnadenlos auf ...', '', 0, NULL, NULL, NULL),
(11, 3, 'Fire Down Below', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 100 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(11, 4, 'Fire Down Below', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 100 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(12, 1, 'Die Hard With A Vengeance', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 122 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(12, 2, 'Stirb Langsam - Jetzt Erst Recht', 'Originaltitel: &quot;Die Hard With A Vengeance&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\nSo explosiv, so spannend, so rasant wie nie zuvor: Bruce Willis als Detectiv John McClane in einem Action-Thriller der Superlative! Das ist heute nicht McClanes Tag. Seine Frau hat ihn verlassen, sein Boß hat ihn vom Dienst suspendiert und irgendein Verrückter hat ihn gerade zum Gegenspieler in einem teuflischen Spiel erkoren - und der Einsatz ist New York selbst. Ein Kaufhaus ist explodiert, doch das ist nur der Auftakt. Der geniale Superverbrecher Simon droht, die ganze Stadt Stück für Stück in die Luft zu sprengen, wenn McClane und sein Partner wider Willen seine explosiven" Rätsel nicht lösen. Eine mörderische Hetzjagd quer durch New York beginnt - bis McClane merkt, daß der Bombenterror eigentlich nur ein brillantes Ablenkungsmanöver ist...!<br><i>"Perfekt gemacht und stark besetzt. Das Action-Highlight des Jahres!"</i> <b>(Bild)</b>', '', 0, NULL, NULL, NULL),
(12, 3, 'Die Hard With A Vengeance', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 122 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(12, 4, 'Die Hard With A Vengeance', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 122 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(13, 1, 'Lethal Weapon', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 100 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(13, 2, 'Zwei stahlharte Profis', 'Originaltitel: &quot;Lethal Weapon&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\nSie sind beide Cops in L.A.. Sie haben beide in Vietnam für eine Spezialeinheit gekämpft. Und sie hassen es beide, mit einem Partner arbeiten zu müssen. Aber sie sind Partner: Martin Riggs, der Mann mit dem Todeswunsch, für wen auch immer. Und Roger Murtaugh, der besonnene Polizist. Gemeinsam enttarnen sie einen gigantischen Heroinschmuggel, hinter dem sich eine Gruppe ehemaliger CIA-Söldner verbirgt. Eine Killerbande gegen zwei Profis ...', '', 0, NULL, NULL, NULL),
(13, 3, 'Lethal Weapon', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 100 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(13, 4, 'Lethal Weapon', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 100 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(14, 1, 'Red Corner', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 117 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(14, 2, 'Labyrinth ohne Ausweg', 'Originaltitel: &quot;Red Corner&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\nDem Amerikaner Jack Moore wird in China der bestialische Mord an einem Fotomodel angehängt. Brutale Gefängnisschergen versuchen, ihn durch Folter zu einem Geständnis zu zwingen. Vor Gericht fordert die Anklage die Todesstrafe - Moore''s Schicksal scheint besiegelt. Durch einen Zufall gelingt es ihm, aus der Haft zu fliehen, doch aus der feindseligen chinesischen Hauptstadt gibt es praktisch kein Entkommen ...', '', 0, NULL, NULL, NULL),
(14, 3, 'Red Corner', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 117 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(14, 4, 'Red Corner', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 117 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(15, 1, 'Frantic', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 115 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(15, 2, 'Frantic', 'Originaltitel: &quot;Frantic&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\nEin romantischer Urlaub in Paris, der sich in einen Alptraum verwandelt. Ein Mann auf der verzweifelten Suche nach seiner entführten Frau. Ein düster-bedrohliches Paris, in dem nur ein Mensch Licht in die tödliche Affäre bringen kann.', '', 0, NULL, NULL, NULL),
(15, 3, 'Frantic', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 115 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(15, 4, 'Frantic', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 115 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(16, 1, 'Courage Under Fire', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 112 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(16, 2, 'Mut Zur Wahrheit', 'Originaltitel: &quot;Courage Under Fire&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\nLieutenant Colonel Nathaniel Serling (Denzel Washington) lässt während einer Schlacht im Golfkrieg versehentlich auf einen US-Panzer schießen, dessen Mannschaft dabei ums Leben kommt. Ein Jahr nach diesem Vorfall wird Serling, der mittlerweile nach Washington D.C. versetzt wurde, die Aufgabe übertragen, sich um einen Kandidaten zu kümmern, der während des Krieges starb und dem der höchste militärische Orden zuteil werden soll. Allerdings sind sowohl der Fall und als auch der betreffende Soldat ein politisch heißes Eisen -- Captain Karen Walden (Meg Ryan) ist Amerikas erster weiblicher Soldat, der im Kampf getötet wurde.<br><br>\r\nSerling findet schnell heraus, dass es im Fall des im felsigen Gebiet von Kuwait abgestürzten Rettungshubschraubers Diskrepanzen gibt. In Flashbacks werden von unterschiedlichen Personen verschiedene Versionen von Waldens Taktik, die Soldaten zu retten und den Absturz zu überleben, dargestellt (à la Kurosawas Rashomon). Genau wie in Glory erweist sich Regisseur Edward Zwicks Zusammenstellung von bekannten und unbekannten Schauspielern als die richtige Mischung. Waldens Crew ist besonders überzeugend. Matt Damon als der Sanitäter kommt gut als der leichtfertige Typ rüber, als er Washington seine Geschichte erzählt. Im Kampf ist er ein mit Fehlern behafteter, humorvoller Soldat.<br><br>\r\nDie erstaunlichste Arbeit in Mut zur Wahrheit leistet Lou Diamond Phillips (als der Schütze der Gruppe), dessen Karriere sich auf dem Weg in die direkt für den Videomarkt produzierten Filme befand. Und dann ist da noch Ryan. Sie hat sich in dramatischen Filmen in der Vergangenheit gut behauptet (Eine fast perfekte Liebe, Ein blutiges Erbe), es aber nie geschafft, ihrem Image zu entfliehen, das sie in die Ecke der romantischen Komödie steckte. Mit gefärbtem Haar, einem leichten Akzent und der von ihr geforderten Darstellungskunst hat sie endlich einen langlebigen dramatischen Film. Obwohl sie nur halb so oft wie Washington im Film zu sehen ist, macht ihre mutige und beeindruckend nachhaltige Darstellung Mut zur Wahrheit zu einem speziellen Film bis hin zu dessen seltsamer, aber lohnender letzter Szene.', '', 0, NULL, NULL, NULL),
(16, 3, 'Courage Under Fire', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 112 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(16, 4, 'Courage Under Fire', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 112 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(17, 1, 'Speed', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 112 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(17, 2, 'Speed', 'Originaltitel: &quot;Speed&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\nEr ist ein Cop aus der Anti-Terror-Einheit von Los Angeles. Und so ist der Alarm für Jack Traven nichts Ungewöhnliches: Ein Terrorist will drei Millionen Dollar erpressen, oder die zufälligen Geiseln in einem Aufzug fallen 35 Stockwerke in die Tiefe. Doch Jack schafft das Unmögliche - die Geiseln werden gerettet und der Terrorist stirbt an seiner eigenen Bombe. Scheinbar. Denn schon wenig später steht Jack (Keanu Reeves) dem Bombenexperten Payne erneut gegenüber. Diesmal hat sich der Erpresser eine ganz perfide Mordwaffe ausgedacht: Er plaziert eine Bombe in einem öffentlichen Bus. Der Mechanismus der Sprengladung schaltet sich automatisch ein, sobald der Bus schneller als 50 Meilen in der Stunde fährt und detoniert sofort, sobald die Geschwindigkeit sinkt. Plötzlich wird für eine Handvoll ahnungsloser Durchschnittsbürger der Weg zur Arbeit zum Höllentrip - und nur Jack hat ihr Leben in der Hand. Als der Busfahrer verletzt wird, übernimmt Fahrgast Annie (Sandra Bullock) das Steuer. Doch wohin mit einem Bus, der nicht bremsen kann in der Stadt der Staus? Doch es kommt noch schlimmer: Payne (Dennis Hopper) will jetzt nicht nur seine drei Millionen Dollar. Er will Jack. Um jeden Preis.', '', 0, NULL, NULL, NULL),
(17, 3, 'Speed', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 112 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(17, 4, 'Speed', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 112 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(18, 1, 'Speed 2: Cruise Control', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 120 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(18, 2, 'Speed 2: Cruise Control', 'Originaltitel: &quot;Speed 2 - Cruise Control&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\nHalten Sie ihre Schwimmwesten bereit, denn die actiongeladene Fortsetzung von Speed begibt sich auf Hochseekurs. Erleben Sie Sandra Bullock erneut in ihrer Star-Rolle als Annie Porter. Die Karibik-Kreuzfahrt mit ihrem Freund Alex entwickelt sich unaufhaltsam zur rasenden Todesfahrt, als ein wahnsinniger Computer-Spezialist den Luxusliner in seine Gewalt bringt und auf einen mörderischen Zerstörungskurs programmiert. Eine hochexplosive Reise, bei der kein geringerer als Action-Spezialist Jan De Bont das Ruder in die Hand nimmt. Speed 2: Cruise Controll läßt ihre Adrenalin-Wellen in rasender Geschwindigkeit ganz nach oben schnellen.', '', 0, NULL, NULL, NULL),
(18, 3, 'Speed 2: Cruise Control', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 120 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(18, 4, 'Speed 2: Cruise Control', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 120 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(19, 1, 'There''s Something About Mary', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 114 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(19, 2, 'Verrückt nach Mary', 'Originaltitel: &quot;There''s Something About Mary&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\n13 Jahre nachdem Teds Rendezvous mit seiner angebeteten Mary in einem peinlichen Fiasko endete, träumt er immer noch von ihr und engagiert den windigen Privatdetektiv Healy um sie aufzuspüren. Der findet Mary in Florida und verliebt sich auf den ersten Blick in die atemberaubende Traumfrau. Um Ted als Nebenbuhler auszuschalten, tischt er ihm dicke Lügen über Mary auf. Ted läßt sich jedoch nicht abschrecken, eilt nach Miami und versucht nun alles, um Healy die Balztour zu vermasseln. Doch nicht nur Healy ist verrückt nach Mary und Ted bekommt es mit einer ganzen Legion liebeskranker Konkurrenten zu tun ...', '', 0, NULL, NULL, NULL),
(19, 3, 'There''s Something About Mary', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 114 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(19, 4, 'There''s Something About Mary', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 114 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(20, 1, 'Beloved', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 164 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL);
INSERT INTO `products_description` (`products_id`, `language_id`, `products_name`, `products_description`, `products_url`, `products_viewed`, `products_head_title_tag`, `products_head_desc_tag`, `products_head_keywords_tag`) VALUES
(20, 2, 'Menschenkind', 'Originaltitel: &quot;Beloved&quot;<br><br>\r\nRegional Code: 2 (Japan, Europe, Middle East, South Africa).<br>\r\nSprachen: English, Deutsch.<br>\r\nUntertitel: English, Deutsch, Spanish.<br>\r\nAudio: Dolby Surround 5.1.<br>\r\nBildformat: 16:9 Wide-Screen.<br>\r\nDauer: (approx) 96 minuten.<br>\r\nAußerdem: Interaktive Menus, Kapitelauswahl, Untertitel.<br><br>\r\nDieser vielschichtige Film ist eine Arbeit, die Regisseur Jonathan Demme und dem amerikanischen Talkshow-Star Oprah Winfrey sehr am Herzen lag. Der Film deckt im Verlauf seiner dreistündigen Spielzeit viele Bereiche ab. Menschenkind ist teils Sklavenepos, teils Mutter-Tochter-Drama und teils Geistergeschichte.<br><br>\r\nDer Film fordert vom Publikum höchste Aufmerksamkeit, angefangen bei seiner dramatischen und etwas verwirrenden Eingangssequenz, in der die Bewohner eines Hauses von einem niederträchtigen übersinnlichen Angriff heimgesucht werden. Aber Demme und seine talentierte Besetzung bereiten denen, die dabei bleiben ein unvergessliches Erlebnis. Der Film folgt den Spuren von Sethe (in ihren mittleren Jahren von Oprah Winfrey dargestellt), einer ehemaligen Sklavin, die sich scheinbar ein friedliches und produktives Leben in Ohio aufgebaut hat. Aber durch den erschreckenden und sparsamen Einsatz von Rückblenden deckt Demme, genau wie das literarische Meisterwerk von Toni Morrison, auf dem der Film basiert, langsam die Schrecken von Sethes früherem Leben auf und das schreckliche Ereignis, dass dazu führte, dass Sethes Haus von Geistern heimgesucht wird.<br><br>\r\nWährend die Gräuel der Sklaverei und das blutige Ereignis in Sethes Familie unleugbar tief beeindrucken, ist die Qualität des Film auch in kleineren, genauso befriedigenden Details sichtbar. Die geistlich beeinflusste Musik von Rachel Portman ist gleichzeitig befreiend und bedrückend, und der Einblick in die afro-amerikanische Gemeinschaft nach der Sklaverei -- am Beispiel eines Familienausflugs zu einem Jahrmarkt, oder dem gospelsingenden Nähkränzchen -- machen diesen Film zu einem speziellen Vergnügen sowohl für den Geist als auch für das Herz. Die Schauspieler, besonders Kimberley Elise als Sethes kämpfende Tochter und Thandie Newton als der mysteriöse Titelcharakter, sind sehr rührend. Achten Sie auch auf Danny Glover (Lethal Weapon) als Paul D.', '', 0, NULL, NULL, NULL),
(20, 3, 'Beloved', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 164 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(20, 4, 'Beloved', 'Regional Code: 2 (Japan, Europe, Middle East, South Africa).\r<br>\nLanguages: English, Deutsch.\r<br>\nSubtitles: English, Deutsch, Spanish.\r<br>\nAudio: Dolby Surround 5.1.\r<br>\nPicture Format: 16:9 Wide-Screen.\r<br>\nLength: (approx) 164 minutes.\r<br>\nOther: Interactive Menus, Chapter Selection, Subtitles (more languages).', '', 0, NULL, NULL, NULL),
(21, 1, 'SWAT 3: Close Quarters Battle', '<b>Windows 95/98</b><br><br>211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and "When needed" to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!', 'www.swat3.com', 0, NULL, NULL, NULL),
(21, 2, 'SWAT 3: Elite Edition', '<b>KEINE KOMPROMISSE!</b><br><i>Kämpfen Sie Seite an Seite mit Ihren LAPD SWAT-Kameraden gegen das organisierte Verbrechen!</i><br><br>\r\nEine der realistischsten 3D-Taktiksimulationen der letzten Zeit jetzt mit Multiplayer-Modus, 5 neuen Missionen und jede Menge nützliche Tools!<br><br>\r\nLos Angeles, 2005. In wenigen Tagen steht die Unterzeichnung des Abkommens der Vereinten Nationen zur Atom-Ächtung durch Vertreter aller Nationen der Welt an. Radikale terroristische Vereinigungen machen sich in der ganzen Stadt breit. Verantwortlich für die Sicherheit der Delegierten zeichnet sich eine Eliteeinheit der LAPD: das SWAT-Team. Das Schicksal der Stadt liegt in Ihren Händen.<br><br>\r\n<b>Neue Features:</b>\r\n<ul>\r\n<li>Multiplayer-Modus (Co op-Modus, Deathmatch in den bekannten Variationen)</li>\r\n<li>5 neue Missionen an original Örtlichkeiten Las (U-Bahn, Whitman Airport, etc.)</li>\r\n<li>neue Charakter</li>\r\n<li>neue Skins</li>\r\n<li>neue Waffen</li>\r\n<li>neue Sounds</li>\r\n<li>verbesserte KI</li>\r\n<li>Tools-Package</li>\r\n<li>Scenario-Editor</li>\r\n<li>Level-Editor</li>\r\n</ul>\r\nDie dritte Folge der Bestseller-Reihe im Bereich der 3D-Echtzeit-Simulationen präsentiert sich mit einer neuen Spielengine mit extrem ausgeprägtem Realismusgrad. Der Spieler übernimmt das Kommando über eine der besten Polizei-Spezialeinheiten oder einer der übelsten Terroristen-Gangs der Welt. Er durchläuft - als "Guter" oder "Böser" - eine der härtesten und elitärsten Kampfausbildungen, in der er lernt, mit jeder Art von Krisensituationen umzugehen. Bei diesem Action-Abenteuer geht es um das Leben prominenter Vertreter der Vereinten Nationen und bei 16 Missionen an Originalschauplätzen in LA gibt die "lebensechte" KI den Protagonisten jeder Seite so einige harte Nüsse zu knacken.', 'www.swat3.com', 0, NULL, NULL, NULL),
(21, 3, 'SWAT 3: Close Quarters Battle', '<b>Windows 95/98</b><br><br>211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and "When needed" to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!', 'www.swat3.com', 0, NULL, NULL, NULL),
(21, 4, 'SWAT 3: Close Quarters Battle', '<b>Windows 95/98</b><br><br>211 in progress with shots fired. Officer down. Armed suspects with hostages. Respond Code 3! Los Angles, 2005, In the next seven days, representatives from every nation around the world will converge on Las Angles to witness the signing of the United Nations Nuclear Abolishment Treaty. The protection of these dignitaries falls on the shoulders of one organization, LAPD SWAT. As part of this elite tactical organization, you and your team have the weapons and all the training necessary to protect, to serve, and "When needed" to use deadly force to keep the peace. It takes more than weapons to make it through each mission. Your arsenal includes C2 charges, flashbangs, tactical grenades. opti-Wand mini-video cameras, and other devices critical to meeting your objectives and keeping your men free of injury. Uncompromised Duty, Honor and Valor!', 'www.swat3.com', 0, NULL, NULL, NULL),
(22, 1, 'Unreal Tournament', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br><br>This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It''s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of ''bots'' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.', 'www.unrealtournament.net', 0, NULL, NULL, NULL),
(22, 2, 'Unreal Tournament', '2341: Die Gewalt ist eine Lebensweise, die sich ihren Weg durch die dunklen Risse der Gesellschaft bahnt. Sie bedroht die Macht und den Einfluss der regierenden Firmen, die schnellstens ein Mittel finden müssen, die tobenden Massen zu besänftigen - ein profitables Mittel ... Gladiatorenkämpfe sind die Lösung. Sie sollen den Durst der Menschen nach Blut stillen und sind die perfekte Gelegenheit, die Aufständischen, Kriminellen und Aliens zu beseitigen, die die Firmenelite bedrohen.<br><br>\r\nDas Turnier war geboren - ein Kampf auf Leben und Tod. Galaxisweit live und in Farbe! Kämpfen Sie für Freiheit, Ruhm und Ehre. Sie müssen stark, schnell und geschickt sein ... oder Sie bleiben auf der Strecke.<br><br>\r\nKämpfen Sie allein oder kommandieren Sie ein Team gegen Armeen unbarmherziger Krieger, die alle nur ein Ziel vor Augen haben: Die Arenen lebend zu verlassen und sich dem Grand Champion zu stellen ... um ihn dann zu bezwingen!<br><br>\r\n<b>Features:</b>\r\n<ul>\r\n<li>Auf dem PC mehrfach als Spiel des Jahres ausgezeichnet!</li>\r\n<li>Mehr als 50 faszinierende Level - verlassene Raumstationen, gotische Kathedralen und graffitibedeckte Großstädte.</li>\r\n<li>Vier actionreiche Spielmodi - Deathmatch, Capture the Flag, Assault und Domination werden Ihren Adrenalinpegel in die Höhe schnellen lassen.</li>\r\n<li>Dramatische Mehrspieler-Kämpfe mit 2, 3 und 4 Spielern, auch über das Netzwerk</li>\r\n<li>Gnadenlos aggressive Computergegner verlangen Ihnen das Äußerste ab.</li>\r\n<li>Neuartiges Benutzerinterface und verbesserte Steuerung - auch mit USB-Maus und -Tastatur spielbar.</li>\r\n</ul>\r\nDer Nachfolger des Actionhits "Unreal" verspricht ein leichtes, intuitives Interface, um auch Einsteigern schnellen Zugang zu den Duellen gegen die Bots zu ermöglichen. Mit diesen KI-Kriegern kann man auch Teams bilden und im umfangreichen Multiplayermodus ohne Onlinekosten in den Kampf ziehen. 35 komplett neue Arenen und das erweiterte Waffenangebot bilden dazu den würdigen Rahmen.', 'www.unrealtournament.net', 0, NULL, NULL, NULL),
(22, 3, 'Unreal Tournament', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br><br>This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It''s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of ''bots'' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.', 'www.unrealtournament.net', 0, NULL, NULL, NULL),
(22, 4, 'Unreal Tournament', 'From the creators of the best-selling Unreal, comes Unreal Tournament. A new kind of single player experience. A ruthless multiplayer revolution.<br><br>This stand-alone game showcases completely new team-based gameplay, groundbreaking multi-faceted single player action or dynamic multi-player mayhem. It''s a fight to the finish for the title of Unreal Grand Master in the gladiatorial arena. A single player experience like no other! Guide your team of ''bots'' (virtual teamates) against the hardest criminals in the galaxy for the ultimate title - the Unreal Grand Master.', 'www.unrealtournament.net', 0, NULL, NULL, NULL),
(23, 1, 'The Wheel Of Time', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan''s pages; it''s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you''re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter''angreal, Portal Stones, and the Ways. However you move around, though, you''ll quickly discover that means of locomotion can easily become the least of the your worries...<br><br>During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time''s main characters. Some of these places are ripped directly from the pages of Jordan''s books, made flesh with Legend''s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you''ll have this year.', 'www.wheeloftime.com', 0, NULL, NULL, NULL),
(23, 2, 'The Wheel Of Time', '<b><i>"Wheel Of Time"(Das Rad der Zeit)</i></b> basiert auf den Fantasy-Romanen von Kultautor Robert Jordan und stellt einen einzigartigen Mix aus Strategie-, Action- und Rollenspielelementen dar. Obwohl die Welt von "Wheel of Time" eng an die literarische Vorlage der Romane angelehnt ist, erzählt das Spiel keine lineare Geschichte. Die Story entwickelt sich abhängig von den Aktionen der Spieler, die jeweils die Rollen der Hauptcharaktere aus dem Roman übernehmen. Jede Figur hat den Oberbefehl über eine große Gefolgschaft, militärische Einheiten und Ländereien. Die Spieler können ihre eigenen Festungen konstruieren, individuell ausbauen, von dort aus das umliegende Land erforschen, magische Gegenstände sammeln oder die gegnerischen Zitadellen erstürmen. Selbstverständlich kann man sich auch über LAN oder Internet gegenseitig Truppen auf den Hals hetzen und die Festungen seiner Mitspieler in Schutt und Asche legen. Dreh- und Anlegepunkt von "Wheel of Time" ist der Kampf um die finstere Macht "The Dark One", die vor langer Zeit die Menschheit beinahe ins Verderben stürzte und nur mit Hilfe gewaltiger magischer Energie verbannt werden konnte. "The Amyrlin Seat" und "The Children of the Night" kämpfen nur gegen "The Forsaken" und "The Hound" um den Besitz des Schlüssels zu "Shayol Ghul" - dem magischen Siegel, mit dessen Hilfe "The Dark One" seinerzeit gebannt werden konnte.<br><br>\r\n<b>Features:</b> \r\n<ul>\r\n<li>Ego-Shooter mit Strategie-Elementen</li>\r\n<li>Spielumgebung in Echtzeit-3D</li>\r\n<li>Konstruktion aud Ausbau der eigenen Festung</li>\r\n<li>Einsatz von über 100 Artefakten und Zaubersprüchen</li>\r\n<li>Single- und Multiplayermodus</li>\r\n</ul>\r\nIm Mittelpunkt steht der Kampf gegen eine finstere Macht namens The Dark One. Deren Schergen müssen mit dem Einsatz von über 100 Artefakten und Zaubereien wie Blitzschlag oder Teleportation aus dem Weg geräumt werden. Die opulente 3D-Grafik verbindet Strategie- und Rollenspielelemente. \r\n\r\n<b>Voraussetzungen</b>\r\nmind. P200, 32MB RAM, 4x CD-Rom, Win95/98, DirectX 5.0 komp.Grafikkarte und Soundkarte. ', 'www.wheeloftime.com', 0, NULL, NULL, NULL),
(23, 3, 'The Wheel Of Time', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan''s pages; it''s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you''re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter''angreal, Portal Stones, and the Ways. However you move around, though, you''ll quickly discover that means of locomotion can easily become the least of the your worries...<br><br>During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time''s main characters. Some of these places are ripped directly from the pages of Jordan''s books, made flesh with Legend''s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you''ll have this year.', 'www.wheeloftime.com', 0, NULL, NULL, NULL),
(23, 4, 'The Wheel Of Time', 'The world in which The Wheel of Time takes place is lifted directly out of Jordan''s pages; it''s huge and consists of many different environments. How you navigate the world will depend largely on which game - single player or multipayer - you''re playing. The single player experience, with a few exceptions, will see Elayna traversing the world mainly by foot (with a couple notable exceptions). In the multiplayer experience, your character will have more access to travel via Ter''angreal, Portal Stones, and the Ways. However you move around, though, you''ll quickly discover that means of locomotion can easily become the least of the your worries...<br><br>During your travels, you quickly discover that four locations are crucial to your success in the game. Not surprisingly, these locations are the homes of The Wheel of Time''s main characters. Some of these places are ripped directly from the pages of Jordan''s books, made flesh with Legend''s unparalleled pixel-pushing ways. Other places are specific to the game, conceived and executed with the intent of expanding this game world even further. Either way, they provide a backdrop for some of the most intense first person action and strategy you''ll have this year.', 'www.wheeloftime.com', 0, NULL, NULL, NULL),
(24, 1, 'Disciples: Sacred Lands', 'A new age is dawning...<br><br>Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br><br>The day of reckoning has come... and only the chosen will survive.', '', 0, NULL, NULL, NULL),
(24, 2, 'Disciples: Sacred Land', 'Rundenbasierende Fantasy/RTS-Strategie mit gutem Design (vor allem die Levels, 4 versch. Rassen, tolle Einheiten), fantastischer Atmosphäre und exzellentem Soundtrack. Grafisch leider auf das Niveau von 1990.', 'www.strategyfirst.com/disciples/welcome.html', 0, NULL, NULL, NULL),
(24, 3, 'Disciples: Sacred Lands', 'A new age is dawning...<br><br>Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br><br>The day of reckoning has come... and only the chosen will survive.', '', 0, NULL, NULL, NULL),
(24, 4, 'Disciples: Sacred Lands', 'A new age is dawning...<br><br>Enter the realm of the Sacred Lands, where the dawn of a New Age has set in motion the most momentous of wars. As the prophecies long foretold, four races now clash with swords and sorcery in a desperate bid to control the destiny of their gods. Take on the quest as a champion of the Empire, the Mountain Clans, the Legions of the Damned, or the Undead Hordes and test your faith in battles of brute force, spellbinding magic and acts of guile. Slay demons, vanquish giants and combat merciless forces of the dead and undead. But to ensure the salvation of your god, the hero within must evolve.<br><br>The day of reckoning has come... and only the chosen will survive.', '', 0, NULL, NULL, NULL),
(25, 1, 'Microsoft Internet Keyboard PS/2', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!', '', 0, NULL, NULL, NULL),
(25, 2, 'Microsoft Internet Tastatur PS/2', '<i>Microsoft Internet Keyboard,Windows-Tastatur mit 10 zusätzl. Tasten,2 selbst programmierbar, abnehmbareHandgelenkauflage. Treiber im Lieferumfang.</i><br><br>\r\nEin-Klick-Zugriff auf das Internet und vieles mehr! Das Internet Keyboard verfügt über 10 zusätzliche Abkürzungstasten auf einer benutzerfreundlichen Standardtastatur, die darüber hinaus eine abnehmbare Handballenauflage aufweist. Über die Abkürzungstasten können Sie durch das Internet surfen oder direkt von der Tastatur aus auf E-Mails zugreifen. Die IntelliType Pro-Software ermöglicht außerdem das individuelle Belegen der Tasten.', '', 0, NULL, NULL, NULL),
(25, 3, 'Microsoft Internet Keyboard PS/2', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!', '', 0, NULL, NULL, NULL),
(25, 4, 'Microsoft Internet Keyboard PS/2', 'The Internet Keyboard has 10 Hot Keys on a comfortable standard keyboard design that also includes a detachable palm rest. The Hot Keys allow you to browse the web, or check e-mail directly from your keyboard. The IntelliType Pro software also allows you to customize your hot keys - make the Internet Keyboard work the way you want it to!', '', 0, NULL, NULL, NULL),
(26, 1, 'Microsoft IntelliMouse Explorer', 'Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!', 'www.microsoft.com/hardware/mouse/explorer.asp', 0, NULL, NULL, NULL),
(26, 2, 'Microsof IntelliMouse Explorer', 'Die IntelliMouse Explorer überzeugt durch ihr modernes Design mit silberfarbenem Gehäuse, sowie rot schimmernder Unter- und Rückseite. Die neuartige IntelliEye-Technologie sorgt für eine noch nie dagewesene Präzision, da statt der beweglichen Teile (zum Abtasten der Bewegungsänderungen an der Unterseite der Maus) ein optischer Sensor die Bewegungen der Maus erfaßt. Das Herzstück der Microsoft IntelliEye-Technologie ist ein kleiner Chip, der einen optischen Sensor und einen digitalen Signalprozessor (DSP) enthält.<br><br>\r\nDa auf bewegliche Teile, die Staub, Schmutz und Fett aufnehmen können, verzichtet wurde, muß die IntelliMouse Explorer nicht mehr gereinigt werden. Darüber hinaus arbeitet die IntelliMouse Explorer auf nahezu jeder Arbeitsoberfläche, so daß kein Mauspad mehr erforderlich ist. Mit dem Rad und zwei neuen zusätzlichen Maustasten ermöglicht sie effizientes und komfortables Arbeiten am PC.<br><br>\r\n<b>Eigenschaften:</b>\r\n<ul>\r\n<li><b>ANSCHLUSS:</b> USB (PS/2-Adapter enthalten)</li>\r\n<li><b>FARBE:</b> metallic-grau</li>\r\n<li><b>TECHNIK:</b> Optisch (Akt.: ca. 1500 Bilder/s)</li>\r\n<li><b>TASTEN:</b> 5 (incl. Scrollrad)</li>\r\n<li><b>SCROLLRAD:</b> Ja</li>\r\n</ul>\r\n<i><b>BEMERKUNG:</b><br>Keine Reinigung bewegter Teile mehr notwendig, da statt der Mauskugel ein Fotoempfänger benutzt wird.</i>', '', 0, NULL, NULL, NULL),
(26, 3, 'Microsoft IntelliMouse Explorer', 'Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!', 'www.microsoft.com/hardware/mouse/explorer.asp', 0, NULL, NULL, NULL),
(26, 4, 'Microsoft IntelliMouse Explorer', 'Microsoft introduces its most advanced mouse, the IntelliMouse Explorer! IntelliMouse Explorer features a sleek design, an industrial-silver finish, a glowing red underside and taillight, creating a style and look unlike any other mouse. IntelliMouse Explorer combines the accuracy and reliability of Microsoft IntelliEye optical tracking technology, the convenience of two new customizable function buttons, the efficiency of the scrolling wheel and the comfort of expert ergonomic design. All these great features make this the best mouse for the PC!', 'www.microsoft.com/hardware/mouse/explorer.asp', 0, NULL, NULL, NULL),
(27, 1, 'Hewlett Packard LaserJet 1100Xi', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP''s Resolution Enhancement technology (REt) makes every document more professional.<br><br>Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br><br>HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0, NULL, NULL, NULL),
(27, 2, 'Hewlett-Packard LaserJet 1100Xi', '<b>HP LaserJet für mehr Produktivität und Flexibilität am Arbeitsplatz</b><br><br>\r\nDer HP LaserJet 1100Xi Drucker verbindet exzellente Laserdruckqualität mit hoher Geschwindigkeit für mehr Effizienz.<br><br>\r\n<b>Zielkunden</b>\r\n<ul><li>Einzelanwender, die Wert auf professionelle Ausdrucke in Laserqualität legen und schnelle Ergebnisse auch bei komplexen Dokumenten erwarten.</li>\r\n<li>Der HP LaserJet 1100 sorgt mit gestochen scharfen Texten und Grafiken für ein professionelles Erscheinungsbild Ihrer Arbeit und Ihres Unternehmens. Selbst bei komplexen Dokumenten liefert er schnelle Ergebnisse. Andere Medien - wie z.B. Transparentfolien und Briefumschläge, etc. - lassen sich problemlos bedrucken. Somit ist der HP LaserJet 1100 ein Multifunktionstalent im Büroalltag.</li>\r\n</ul>\r\n<b>Eigenschaften</b>\r\n<ul>\r\n<li><b>Druckqualität</b> Schwarzweiß: 600 x 600 dpi</li>\r\n<li><b>Monatliche Druckleistung</b> Bis zu 7000 Seiten</li>\r\n<li><b>Speicher</b> 2 MB Standardspeicher, erweiterbar auf 18 MB</li>\r\n<li><b>Schnittstelle/gemeinsame Nutzung</b> Parallel, IEEE 1284-kompatibel</li>\r\n<li><b>Softwarekompatibilität</b> DOS/Win 3.1x/9x/NT 4.0</li>\r\n<li><b>Papierzuführung</b> 125-Blatt-Papierzuführung</li>\r\n<li><b>Druckmedien</b> Normalpapier, Briefumschläge, Transparentfolien, kartoniertes Papier, Postkarten und Etiketten</li>\r\n<li><b>Netzwerkfähig</b> Über HP JetDirect PrintServer</li>\r\n<li><b>Lieferumfang</b> HP LaserJet 1100Xi Drucker (Lieferumfang: Drucker, Tonerkassette, 2 m Parallelkabel, Netzkabel, Kurzbedienungsanleitung, Benutzerhandbuch, CD-ROM, 3,5"-Disketten mit Windows® 3.1x, 9x, NT 4.0 Treibern und DOS-Dienstprogrammen)</li>\r\n<li><b>Gewährleistung</b> Ein Jahr</li>\r\n</ul>\r\n', 'www.hp.com', 0, NULL, NULL, NULL),
(27, 3, 'Hewlett Packard LaserJet 1100Xi', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP''s Resolution Enhancement technology (REt) makes every document more professional.<br><br>Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br><br>HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0, NULL, NULL, NULL),
(27, 4, 'Hewlett Packard LaserJet 1100Xi', 'HP has always set the pace in laser printing technology. The new generation HP LaserJet 1100 series sets another impressive pace, delivering a stunning 8 pages per minute print speed. The 600 dpi print resolution with HP''s Resolution Enhancement technology (REt) makes every document more professional.<br><br>Enhanced print speed and laser quality results are just the beginning. With 2MB standard memory, HP LaserJet 1100xi users will be able to print increasingly complex pages. Memory can be increased to 18MB to tackle even more complex documents with ease. The HP LaserJet 1100xi supports key operating systems including Windows 3.1, 3.11, 95, 98, NT 4.0, OS/2 and DOS. Network compatibility available via the optional HP JetDirect External Print Servers.<br><br>HP LaserJet 1100xi also features The Document Builder for the Web Era from Trellix Corp. (featuring software to create Web documents).', 'www.pandi.hp.com/pandi-db/prodinfo.main?product=laserjet1100', 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_groups`
--

CREATE TABLE IF NOT EXISTS `products_groups` (
  `customers_group_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `customers_group_price` varchar(255) NOT NULL DEFAULT '0.0000',
  `products_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`customers_group_id`,`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_notifications`
--

CREATE TABLE IF NOT EXISTS `products_notifications` (
  `products_id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`products_id`,`customers_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_options`
--

CREATE TABLE IF NOT EXISTS `products_options` (
  `products_options_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `products_options_name` varchar(32) NOT NULL DEFAULT '',
  PRIMARY KEY (`products_options_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `products_options`
--

INSERT INTO `products_options` (`products_options_id`, `language_id`, `products_options_name`) VALUES
(1, 1, 'Color'),
(1, 2, 'Farbe'),
(1, 3, 'Color'),
(1, 4, 'Renk'),
(2, 1, 'Size'),
(2, 2, 'Größe'),
(2, 3, 'Talla'),
(2, 4, 'Ebat'),
(3, 1, 'Model'),
(3, 2, 'Modell'),
(3, 3, 'Modelo'),
(3, 4, 'Model'),
(4, 1, 'Memory'),
(4, 2, 'Speicher'),
(4, 3, 'Memoria'),
(4, 4, 'Haf?za'),
(5, 1, 'Version'),
(5, 2, 'Version'),
(5, 3, 'Version'),
(5, 4, 'Versiyon');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_options_values`
--

CREATE TABLE IF NOT EXISTS `products_options_values` (
  `products_options_values_id` int(11) NOT NULL DEFAULT '0',
  `language_id` int(11) NOT NULL DEFAULT '1',
  `products_options_values_name` varchar(64) NOT NULL DEFAULT '',
  PRIMARY KEY (`products_options_values_id`,`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `products_options_values`
--

INSERT INTO `products_options_values` (`products_options_values_id`, `language_id`, `products_options_values_name`) VALUES
(1, 1, '4 mb'),
(1, 2, '4 MB'),
(1, 3, '4 mb'),
(1, 4, '4mb'),
(2, 1, '8 mb'),
(2, 2, '8 MB'),
(2, 3, '8 mb'),
(2, 4, '8 mb'),
(3, 1, '16 mb'),
(3, 2, '16 MB'),
(3, 3, '16 mb'),
(3, 4, '16 mb'),
(4, 1, '32 mb'),
(4, 2, '32 MB'),
(4, 3, '32 mb'),
(4, 4, '32 mb'),
(5, 1, 'Value'),
(5, 2, 'Value Ausgabe'),
(5, 3, 'Value'),
(5, 4, 'Value'),
(6, 1, 'Premium'),
(6, 2, 'Premium Ausgabe'),
(6, 3, 'Premium'),
(6, 4, 'Premium'),
(7, 1, 'Deluxe'),
(7, 2, 'Deluxe Ausgabe'),
(7, 3, 'Deluxe'),
(7, 4, 'Deluxe'),
(8, 1, 'PS/2'),
(8, 2, 'PS/2 Anschluss'),
(8, 3, 'PS/2'),
(8, 4, 'PS/2'),
(9, 1, 'USB'),
(9, 2, 'USB Anschluss'),
(9, 3, 'USB'),
(9, 4, 'USB'),
(10, 1, 'Download: Windows - English'),
(10, 2, 'Download: Windows - Englisch'),
(10, 3, 'Download: Windows - Inglese'),
(10, 4, '?ndir: Windows - ?ngilizce'),
(13, 1, 'Box: Windows - English'),
(13, 2, 'Box: Windows - Englisch'),
(13, 3, 'Box: Windows - Inglese'),
(13, 4, 'Kutu: Windows - ?ngilizce');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_options_values_to_products_options`
--

CREATE TABLE IF NOT EXISTS `products_options_values_to_products_options` (
  `products_options_values_to_products_options_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_options_id` int(11) NOT NULL,
  `products_options_values_id` int(11) NOT NULL,
  PRIMARY KEY (`products_options_values_to_products_options_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Tablo döküm verisi `products_options_values_to_products_options`
--

INSERT INTO `products_options_values_to_products_options` (`products_options_values_to_products_options_id`, `products_options_id`, `products_options_values_id`) VALUES
(1, 4, 1),
(2, 4, 2),
(3, 4, 3),
(4, 4, 4),
(5, 3, 5),
(6, 3, 6),
(7, 3, 7),
(8, 3, 8),
(9, 3, 9),
(10, 5, 10),
(13, 5, 13);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `products_to_categories`
--

CREATE TABLE IF NOT EXISTS `products_to_categories` (
  `products_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  PRIMARY KEY (`products_id`,`categories_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `products_to_categories`
--

INSERT INTO `products_to_categories` (`products_id`, `categories_id`) VALUES
(1, 4),
(2, 4),
(3, 9),
(4, 10),
(5, 11),
(6, 10),
(7, 12),
(8, 13),
(9, 10),
(10, 10),
(11, 10),
(12, 10),
(13, 10),
(14, 15),
(15, 14),
(16, 15),
(17, 10),
(18, 10),
(19, 12),
(20, 15),
(21, 18),
(22, 19),
(23, 20),
(24, 20),
(25, 8),
(26, 9),
(27, 5);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `reviews`
--

CREATE TABLE IF NOT EXISTS `reviews` (
  `reviews_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `customers_id` int(11) DEFAULT NULL,
  `customers_name` varchar(64) NOT NULL,
  `reviews_rating` int(1) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `reviews_read` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`reviews_id`),
  KEY `idx_reviews_products_id` (`products_id`),
  KEY `idx_reviews_customers_id` (`customers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Tablo döküm verisi `reviews`
--

INSERT INTO `reviews` (`reviews_id`, `products_id`, `customers_id`, `customers_name`, `reviews_rating`, `date_added`, `last_modified`, `reviews_read`) VALUES
(1, 19, 1, 'Roger Waters', 5, '2013-08-07 14:38:05', NULL, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `reviews_description`
--

CREATE TABLE IF NOT EXISTS `reviews_description` (
  `reviews_id` int(11) NOT NULL,
  `languages_id` int(11) NOT NULL,
  `reviews_text` text NOT NULL,
  PRIMARY KEY (`reviews_id`,`languages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `reviews_description`
--

INSERT INTO `reviews_description` (`reviews_id`, `languages_id`, `reviews_text`) VALUES
(1, 1, 'this has to be one of the funniest movies released for 1999!');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `sessions`
--

CREATE TABLE IF NOT EXISTS `sessions` (
  `sesskey` varchar(32) NOT NULL,
  `expiry` int(11) unsigned NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`sesskey`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `sessions`
--

INSERT INTO `sessions` (`sesskey`, `expiry`, `value`) VALUES
('18cm7u85029hncns30nuglaj17', 1810819476, 'cart|N;language|N;languages_id|N;currency|N;navigation|N;new_products_id_in_cart|s:2:"53";'),
('1ia6r3fcc0vn1efb91m8guqm71', 1810819473, 'cart|N;language|N;languages_id|N;currency|N;navigation|N;new_products_id_in_cart|s:2:"53";'),
('1u94tgvhfmof2kim3lh76dm1r7', 1810819481, 'cart|N;language|N;languages_id|N;currency|N;navigation|N;'),
('bse88vnrs6n3aq5oiqnia9s731', 1385010485, 'cart|O:12:"shoppingCart":6:{s:8:"contents";a:0:{}s:5:"total";i:0;s:6:"weight";i:0;s:6:"cartID";N;s:12:"content_type";b:0;s:5:"cg_id";i:0;}language|s:7:"english";languages_id|i:1;currency|s:3:"USD";navigation|O:17:"navigationHistory":2:{s:4:"path";a:2:{i:0;a:4:{s:4:"page";s:9:"index.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:0:{}s:4:"post";a:0:{}}i:1;a:4:{s:4:"page";s:14:"admin-ajax.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:0:{}s:4:"post";a:14:{s:6:"action";s:13:"myajax-submit";s:8:"meta_key";s:0:"";s:10:"meta_value";s:11:"           ";s:7:"orderby";s:5:"title";s:5:"order";s:4:"DESC";s:5:"paged";s:0:"";s:14:"posts_per_page";s:1:"9";s:3:"rgb";s:0:"";s:6:"mratio";s:0:"";s:16:"product_category";s:8:"kitaplar";s:10:"price_from";s:1:"0";s:8:"price_to";s:2:"87";s:7:"page_id";s:0:"";s:16:"postCommentNonce";s:10:"1cef9833a8";}}}s:8:"snapshot";a:0:{}}selected_box|s:13:"configuration";'),
('l68t19fd1quvjgglp0hifqjlf2', 1384990431, ''),
('lld37l8q10m885ghoqakch2i14', 1384940100, 'cart|O:12:"shoppingCart":6:{s:8:"contents";a:1:{s:10:"53{3}9{4}1";a:2:{s:3:"qty";i:1;s:10:"attributes";a:2:{i:3;s:1:"9";i:4;s:1:"1";}}}s:5:"total";d:54.719999999999998863131622783839702606201171875;s:6:"weight";i:0;s:6:"cartID";s:5:"63102";s:12:"content_type";s:8:"physical";s:5:"cg_id";i:0;}language|s:7:"english";languages_id|i:1;currency|s:3:"USD";navigation|O:17:"navigationHistory":2:{s:4:"path";a:3:{i:0;a:4:{s:4:"page";s:14:"admin-ajax.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:0:{}s:4:"post";a:4:{s:6:"action";s:19:"wp-remove-post-lock";s:8:"_wpnonce";s:10:"7f8c05b575";s:7:"post_ID";s:2:"75";s:16:"active_post_lock";s:12:"1384937269:1";}}i:1;a:4:{s:4:"page";s:9:"index.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:0:{}s:4:"post";a:0:{}}i:2;a:4:{s:4:"page";s:12:"wp-login.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:1:{s:9:"loggedout";s:4:"true";}s:4:"post";a:0:{}}}s:8:"snapshot";a:0:{}}selected_box|s:13:"configuration";customer_default_address_id|s:1:"9";new_products_id_in_cart|s:2:"53";sendto|s:1:"9";cartID|s:5:"63102";osc_comments|N;billto|s:1:"9";payment|s:10:"moneyorder";shipping|a:3:{s:2:"id";s:9:"flat_flat";s:5:"title";s:20:"Flat Rate (Best Way)";s:4:"cost";s:5:"15.00";}'),
('mjnpuk58pt2k6gjkod0isur3l3', 1810819470, 'cart|N;language|N;languages_id|N;currency|N;navigation|N;'),
('moe2b5a88ej54ljugfc27ulre7', 1385040501, 'cart|O:12:"shoppingCart":6:{s:8:"contents";a:1:{i:18;a:1:{s:3:"qty";i:1;}}s:5:"total";d:32;s:6:"weight";i:0;s:6:"cartID";s:5:"01613";s:12:"content_type";s:8:"physical";s:5:"cg_id";i:0;}language|s:7:"english";languages_id|i:1;currency|s:3:"USD";navigation|O:17:"navigationHistory":2:{s:4:"path";a:1:{i:0;a:4:{s:4:"page";s:9:"index.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:0:{}s:4:"post";a:0:{}}}s:8:"snapshot";a:4:{s:4:"page";s:9:"index.php";s:4:"mode";s:6:"NONSSL";s:3:"get";a:0:{}s:4:"post";a:0:{}}}selected_box|s:13:"configuration";new_products_id_in_cart|s:2:"18";customer_default_address_id|s:1:"9";sendto|s:1:"9";cartID|s:5:"01613";osc_comments|N;billto|s:1:"9";shipping|a:3:{s:2:"id";s:9:"item_item";s:5:"title";s:19:"Per Item (Per Item)";s:4:"cost";d:2.5;}'),
('rs5c7ag1bdbbi3ihfq7l6ik3k1', 1384975940, ''),
('uslqge204qkoadq9gbhnvt5gs7', 1385037233, '');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `specials`
--

CREATE TABLE IF NOT EXISTS `specials` (
  `specials_id` int(11) NOT NULL AUTO_INCREMENT,
  `products_id` int(11) NOT NULL,
  `specials_new_products_price` decimal(15,4) NOT NULL,
  `specials_date_added` datetime DEFAULT NULL,
  `specials_last_modified` datetime DEFAULT NULL,
  `expires_date` datetime DEFAULT NULL,
  `date_status_change` datetime DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '1',
  `customers_group_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`specials_id`),
  KEY `idx_specials_products_id` (`products_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Tablo döküm verisi `specials`
--

INSERT INTO `specials` (`specials_id`, `products_id`, `specials_new_products_price`, `specials_date_added`, `specials_last_modified`, `expires_date`, `date_status_change`, `status`, `customers_group_id`) VALUES
(1, 3, 39.9900, '2013-08-07 14:38:05', NULL, NULL, NULL, 1, 0),
(2, 5, 30.0000, '2013-08-07 14:38:05', NULL, NULL, NULL, 1, 0),
(3, 6, 30.0000, '2013-08-07 14:38:05', NULL, NULL, NULL, 1, 0),
(4, 16, 29.9900, '2013-08-07 14:38:05', NULL, NULL, NULL, 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `specials_retail_prices`
--

CREATE TABLE IF NOT EXISTS `specials_retail_prices` (
  `products_id` int(11) NOT NULL DEFAULT '0',
  `specials_new_products_price` decimal(15,4) NOT NULL DEFAULT '0.0000',
  `status` tinyint(4) DEFAULT NULL,
  `customers_group_id` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`products_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `specials_retail_prices`
--

INSERT INTO `specials_retail_prices` (`products_id`, `specials_new_products_price`, `status`, `customers_group_id`) VALUES
(3, 39.9900, 1, 0),
(5, 30.0000, 1, 0),
(6, 30.0000, 1, 0),
(16, 29.9900, 1, 0);

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `tax_class`
--

CREATE TABLE IF NOT EXISTS `tax_class` (
  `tax_class_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_class_title` varchar(32) NOT NULL,
  `tax_class_description` varchar(255) NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`tax_class_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Tablo döküm verisi `tax_class`
--

INSERT INTO `tax_class` (`tax_class_id`, `tax_class_title`, `tax_class_description`, `last_modified`, `date_added`) VALUES
(1, 'KDV %18', 'Katma Deger Vergisi', '2013-08-07 14:38:05', '2013-08-07 14:38:05'),
(2, 'KDV %8', 'Katma Deger Vergisi', '2013-08-07 14:38:05', '2013-08-07 14:38:05'),
(3, 'KDV %1', 'Katma Deger Vergisi', '2013-08-07 14:38:05', '2013-08-07 14:38:05');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `tax_rates`
--

CREATE TABLE IF NOT EXISTS `tax_rates` (
  `tax_rates_id` int(11) NOT NULL AUTO_INCREMENT,
  `tax_zone_id` int(11) NOT NULL,
  `tax_class_id` int(11) NOT NULL,
  `tax_priority` int(5) DEFAULT '1',
  `tax_rate` decimal(7,4) NOT NULL,
  `tax_description` varchar(255) NOT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`tax_rates_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Tablo döküm verisi `tax_rates`
--

INSERT INTO `tax_rates` (`tax_rates_id`, `tax_zone_id`, `tax_class_id`, `tax_priority`, `tax_rate`, `tax_description`, `last_modified`, `date_added`) VALUES
(1, 1, 1, 1, 18.0000, 'K.D.V %18', '2013-11-08 18:35:56', '2013-08-07 14:38:05'),
(2, 1, 2, 1, 8.0000, 'KDV %8', '2013-08-07 14:38:05', '2013-08-07 14:38:05'),
(3, 1, 3, 1, 1.0000, 'KDV %1', '2013-08-07 14:38:05', '2013-08-07 14:38:05');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `whos_online`
--

CREATE TABLE IF NOT EXISTS `whos_online` (
  `customer_id` int(11) DEFAULT NULL,
  `full_name` varchar(64) NOT NULL,
  `session_id` varchar(128) NOT NULL,
  `ip_address` varchar(15) NOT NULL,
  `time_entry` varchar(14) NOT NULL,
  `time_last_click` varchar(14) NOT NULL,
  `last_page_url` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Tablo döküm verisi `whos_online`
--

INSERT INTO `whos_online` (`customer_id`, `full_name`, `session_id`, `ip_address`, `time_entry`, `time_last_click`, `last_page_url`) VALUES
(0, 'Guest', 'moe2b5a88ej54ljugfc27ulre7', '127.0.0.1', '1385035789', '1385039061', '/eticaret/product/yeni-urun/');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `zones`
--

CREATE TABLE IF NOT EXISTS `zones` (
  `zone_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_country_id` int(11) NOT NULL,
  `zone_code` varchar(32) NOT NULL,
  `zone_name` varchar(32) NOT NULL,
  PRIMARY KEY (`zone_id`),
  KEY `idx_zones_country_id` (`zone_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=263 ;

--
-- Tablo döküm verisi `zones`
--

INSERT INTO `zones` (`zone_id`, `zone_country_id`, `zone_code`, `zone_name`) VALUES
(1, 223, 'AL', 'Alabama'),
(2, 223, 'AK', 'Alaska'),
(3, 223, 'AS', 'American Samoa'),
(4, 223, 'AZ', 'Arizona'),
(5, 223, 'AR', 'Arkansas'),
(6, 223, 'AF', 'Armed Forces Africa'),
(7, 223, 'AA', 'Armed Forces Americas'),
(8, 223, 'AC', 'Armed Forces Canada'),
(9, 223, 'AE', 'Armed Forces Europe'),
(10, 223, 'AM', 'Armed Forces Middle East'),
(11, 223, 'AP', 'Armed Forces Pacific'),
(12, 223, 'CA', 'California'),
(13, 223, 'CO', 'Colorado'),
(14, 223, 'CT', 'Connecticut'),
(15, 223, 'DE', 'Delaware'),
(16, 223, 'DC', 'District of Columbia'),
(17, 223, 'FM', 'Federated States Of Micronesia'),
(18, 223, 'FL', 'Florida'),
(19, 223, 'GA', 'Georgia'),
(20, 223, 'GU', 'Guam'),
(21, 223, 'HI', 'Hawaii'),
(22, 223, 'ID', 'Idaho'),
(23, 223, 'IL', 'Illinois'),
(24, 223, 'IN', 'Indiana'),
(25, 223, 'IA', 'Iowa'),
(26, 223, 'KS', 'Kansas'),
(27, 223, 'KY', 'Kentucky'),
(28, 223, 'LA', 'Louisiana'),
(29, 223, 'ME', 'Maine'),
(30, 223, 'MH', 'Marshall Islands'),
(31, 223, 'MD', 'Maryland'),
(32, 223, 'MA', 'Massachusetts'),
(33, 223, 'MI', 'Michigan'),
(34, 223, 'MN', 'Minnesota'),
(35, 223, 'MS', 'Mississippi'),
(36, 223, 'MO', 'Missouri'),
(37, 223, 'MT', 'Montana'),
(38, 223, 'NE', 'Nebraska'),
(39, 223, 'NV', 'Nevada'),
(40, 223, 'NH', 'New Hampshire'),
(41, 223, 'NJ', 'New Jersey'),
(42, 223, 'NM', 'New Mexico'),
(43, 223, 'NY', 'New York'),
(44, 223, 'NC', 'North Carolina'),
(45, 223, 'ND', 'North Dakota'),
(46, 223, 'MP', 'Northern Mariana Islands'),
(47, 223, 'OH', 'Ohio'),
(48, 223, 'OK', 'Oklahoma'),
(49, 223, 'OR', 'Oregon'),
(50, 223, 'PW', 'Palau'),
(51, 223, 'PA', 'Pennsylvania'),
(52, 223, 'PR', 'Puerto Rico'),
(53, 223, 'RI', 'Rhode Island'),
(54, 223, 'SC', 'South Carolina'),
(55, 223, 'SD', 'South Dakota'),
(56, 223, 'TN', 'Tennessee'),
(57, 223, 'TX', 'Texas'),
(58, 223, 'UT', 'Utah'),
(59, 223, 'VT', 'Vermont'),
(60, 223, 'VI', 'Virgin Islands'),
(61, 223, 'VA', 'Virginia'),
(62, 223, 'WA', 'Washington'),
(63, 223, 'WV', 'West Virginia'),
(64, 223, 'WI', 'Wisconsin'),
(65, 223, 'WY', 'Wyoming'),
(66, 38, 'AB', 'Alberta'),
(67, 38, 'BC', 'British Columbia'),
(68, 38, 'MB', 'Manitoba'),
(69, 38, 'NF', 'Newfoundland'),
(70, 38, 'NB', 'New Brunswick'),
(71, 38, 'NS', 'Nova Scotia'),
(72, 38, 'NT', 'Northwest Territories'),
(73, 38, 'NU', 'Nunavut'),
(74, 38, 'ON', 'Ontario'),
(75, 38, 'PE', 'Prince Edward Island'),
(76, 38, 'QC', 'Quebec'),
(77, 38, 'SK', 'Saskatchewan'),
(78, 38, 'YT', 'Yukon Territory'),
(79, 81, 'NDS', 'Niedersachsen'),
(80, 81, 'BAW', 'Baden-Württemberg'),
(81, 81, 'BAY', 'Bayern'),
(82, 81, 'BER', 'Berlin'),
(83, 81, 'BRG', 'Brandenburg'),
(84, 81, 'BRE', 'Bremen'),
(85, 81, 'HAM', 'Hamburg'),
(86, 81, 'HES', 'Hessen'),
(87, 81, 'MEC', 'Mecklenburg-Vorpommern'),
(88, 81, 'NRW', 'Nordrhein-Westfalen'),
(89, 81, 'RHE', 'Rheinland-Pfalz'),
(90, 81, 'SAR', 'Saarland'),
(91, 81, 'SAS', 'Sachsen'),
(92, 81, 'SAC', 'Sachsen-Anhalt'),
(93, 81, 'SCN', 'Schleswig-Holstein'),
(94, 81, 'THE', 'Thüringen'),
(95, 14, 'WI', 'Wien'),
(96, 14, 'NO', 'Niederösterreich'),
(97, 14, 'OO', 'Oberösterreich'),
(98, 14, 'SB', 'Salzburg'),
(99, 14, 'KN', 'Kärnten'),
(100, 14, 'ST', 'Steiermark'),
(101, 14, 'TI', 'Tirol'),
(102, 14, 'BL', 'Burgenland'),
(103, 14, 'VB', 'Voralberg'),
(104, 204, 'AG', 'Aargau'),
(105, 204, 'AI', 'Appenzell Innerrhoden'),
(106, 204, 'AR', 'Appenzell Ausserrhoden'),
(107, 204, 'BE', 'Bern'),
(108, 204, 'BL', 'Basel-Landschaft'),
(109, 204, 'BS', 'Basel-Stadt'),
(110, 204, 'FR', 'Freiburg'),
(111, 204, 'GE', 'Genf'),
(112, 204, 'GL', 'Glarus'),
(113, 204, 'JU', 'Graubünden'),
(114, 204, 'JU', 'Jura'),
(115, 204, 'LU', 'Luzern'),
(116, 204, 'NE', 'Neuenburg'),
(117, 204, 'NW', 'Nidwalden'),
(118, 204, 'OW', 'Obwalden'),
(119, 204, 'SG', 'St. Gallen'),
(120, 204, 'SH', 'Schaffhausen'),
(121, 204, 'SO', 'Solothurn'),
(122, 204, 'SZ', 'Schwyz'),
(123, 204, 'TG', 'Thurgau'),
(124, 204, 'TI', 'Tessin'),
(125, 204, 'UR', 'Uri'),
(126, 204, 'VD', 'Waadt'),
(127, 204, 'VS', 'Wallis'),
(128, 204, 'ZG', 'Zug'),
(129, 204, 'ZH', 'Zürich'),
(130, 195, 'A Coruña', 'A Coruña'),
(131, 195, 'Alava', 'Alava'),
(132, 195, 'Albacete', 'Albacete'),
(133, 195, 'Alicante', 'Alicante'),
(134, 195, 'Almeria', 'Almeria'),
(135, 195, 'Asturias', 'Asturias'),
(136, 195, 'Avila', 'Avila'),
(137, 195, 'Badajoz', 'Badajoz'),
(138, 195, 'Baleares', 'Baleares'),
(139, 195, 'Barcelona', 'Barcelona'),
(140, 195, 'Burgos', 'Burgos'),
(141, 195, 'Caceres', 'Caceres'),
(142, 195, 'Cadiz', 'Cadiz'),
(143, 195, 'Cantabria', 'Cantabria'),
(144, 195, 'Castellon', 'Castellon'),
(145, 195, 'Ceuta', 'Ceuta'),
(146, 195, 'Ciudad Real', 'Ciudad Real'),
(147, 195, 'Cordoba', 'Cordoba'),
(148, 195, 'Cuenca', 'Cuenca'),
(149, 195, 'Girona', 'Girona'),
(150, 195, 'Granada', 'Granada'),
(151, 195, 'Guadalajara', 'Guadalajara'),
(152, 195, 'Guipuzcoa', 'Guipuzcoa'),
(153, 195, 'Huelva', 'Huelva'),
(154, 195, 'Huesca', 'Huesca'),
(155, 195, 'Jaen', 'Jaen'),
(156, 195, 'La Rioja', 'La Rioja'),
(157, 195, 'Las Palmas', 'Las Palmas'),
(158, 195, 'Leon', 'Leon'),
(159, 195, 'Lleida', 'Lleida'),
(160, 195, 'Lugo', 'Lugo'),
(161, 195, 'Madrid', 'Madrid'),
(162, 195, 'Malaga', 'Malaga'),
(163, 195, 'Melilla', 'Melilla'),
(164, 195, 'Murcia', 'Murcia'),
(165, 195, 'Navarra', 'Navarra'),
(166, 195, 'Ourense', 'Ourense'),
(167, 195, 'Palencia', 'Palencia'),
(168, 195, 'Pontevedra', 'Pontevedra'),
(169, 195, 'Salamanca', 'Salamanca'),
(170, 195, 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife'),
(171, 195, 'Segovia', 'Segovia'),
(172, 195, 'Sevilla', 'Sevilla'),
(173, 195, 'Soria', 'Soria'),
(174, 195, 'Tarragona', 'Tarragona'),
(175, 195, 'Teruel', 'Teruel'),
(176, 195, 'Toledo', 'Toledo'),
(177, 195, 'Valencia', 'Valencia'),
(178, 195, 'Valladolid', 'Valladolid'),
(179, 195, 'Vizcaya', 'Vizcaya'),
(180, 195, 'Zamora', 'Zamora'),
(181, 195, 'Zaragoza', 'Zaragoza'),
(182, 215, '1', 'Adana'),
(183, 215, '2', 'Ad?yaman'),
(184, 215, '3', 'Afyon'),
(185, 215, '4', 'A?r?'),
(186, 215, '68', 'Aksaray'),
(187, 215, '5', 'Amasya'),
(188, 215, '6', 'Ankara'),
(189, 215, '7', 'Antalya'),
(190, 215, '75', 'Ardahan'),
(191, 215, '8', 'Artvin'),
(192, 215, '9', 'Ayd?n'),
(193, 215, '10', 'Bal?kesir'),
(194, 215, '74', 'Bart?n'),
(195, 215, '72', 'Batman'),
(196, 215, '69', 'Bayburt'),
(197, 215, '11', 'Bilecik'),
(198, 215, '12', 'Bingöl'),
(199, 215, '13', 'Bitlis'),
(200, 215, '14', 'Bolu'),
(201, 215, '15', 'Burdur'),
(202, 215, '16', 'Bursa'),
(203, 215, '17', 'Çanakkale'),
(204, 215, '18', 'Çank?r?'),
(205, 215, '19', 'Çorum'),
(206, 215, '20', 'Denizli'),
(207, 215, '21', 'Diyarbak?r'),
(208, 215, '81', 'Düzce'),
(209, 215, '22', 'Edirne'),
(210, 215, '23', 'Elaz??'),
(211, 215, '24', 'Erzincan'),
(212, 215, '25', 'Erzurum'),
(213, 215, '26', 'Eski?ehir'),
(214, 215, '27', 'Gaziantep'),
(215, 215, '28', 'Giresun'),
(216, 215, '29', 'Gümü?hane'),
(217, 215, '30', 'Hakkari'),
(218, 215, '31', 'Hatay'),
(219, 215, '32', 'I?d?r'),
(220, 215, '33', 'Isparta'),
(221, 215, '34', '?stanbul'),
(222, 215, '35', '?zmir'),
(223, 215, '46', 'Kahramanmara?'),
(224, 215, '78', 'Karabük'),
(225, 215, '70', 'Karaman'),
(226, 215, '36', 'Kars'),
(227, 215, '37', 'Kastamonu'),
(228, 215, '38', 'Kayseri'),
(229, 215, '71', 'K?r?kkale'),
(230, 215, '39', 'K?rklareli'),
(231, 215, '40', 'K?r?ehir'),
(232, 215, '79', 'Kilis'),
(233, 215, '41', 'Kocaeli'),
(234, 215, '42', 'Konya'),
(235, 215, '43', 'Kütahya'),
(236, 215, '44', 'Malatya'),
(237, 215, '45', 'Manisa'),
(238, 215, '46', 'Mardin'),
(239, 215, '47', 'Mersin'),
(240, 215, '48', 'Mu?la'),
(241, 215, '49', 'Mu?'),
(242, 215, '50', 'Nev?ehir'),
(243, 215, '51', 'Ni?de'),
(244, 215, '52', 'Ordu'),
(245, 215, '80', 'Osmaniye'),
(246, 215, '53', 'Rize'),
(247, 215, '54', 'Sakarya'),
(248, 215, '55', 'Samsun'),
(249, 215, '56', 'Siirt'),
(250, 215, '57', 'Sinop'),
(251, 215, '58', 'Sivas'),
(252, 215, '63', '?anl?urfa'),
(253, 215, '73', '??rnak'),
(254, 215, '59', 'Tekirda?'),
(255, 215, '60', 'Tokat'),
(256, 215, '61', 'Trabzon'),
(257, 215, '62', 'Tunceli'),
(258, 215, '64', 'U?ak'),
(259, 215, '65', 'Van'),
(260, 215, '77', 'Yalova'),
(261, 215, '66', 'Yozgat'),
(262, 215, '67', 'Zonguldak');

-- --------------------------------------------------------

--
-- Tablo için tablo yap?s? `zones_to_geo_zones`
--

CREATE TABLE IF NOT EXISTS `zones_to_geo_zones` (
  `association_id` int(11) NOT NULL AUTO_INCREMENT,
  `zone_country_id` int(11) NOT NULL,
  `zone_id` int(11) DEFAULT NULL,
  `geo_zone_id` int(11) DEFAULT NULL,
  `last_modified` datetime DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`association_id`),
  KEY `idx_zones_to_geo_zones_country_id` (`zone_country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `zones_to_geo_zones`
--

INSERT INTO `zones_to_geo_zones` (`association_id`, `zone_country_id`, `zone_id`, `geo_zone_id`, `last_modified`, `date_added`) VALUES
(1, 215, 0, 1, NULL, '2013-08-07 14:38:05'),
(2, 215, 187, 1, NULL, '2013-11-08 21:22:15');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
