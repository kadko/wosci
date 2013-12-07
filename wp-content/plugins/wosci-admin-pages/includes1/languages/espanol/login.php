<?php
/*
  $Id: login.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Entrar');
define('HEADING_TITLE', 'Dejame Entrar!');

define('HEADING_NEW_CUSTOMER', 'Nuevo Cliente');
define('TEXT_NEW_CUSTOMER', 'Soy un nuevo cliente.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Al crear una cuenta en ' . STORE_NAME . ' podrá realizar sus compras rapidamente, revisar el estado de sus pedidos y consultar sus operaciones anteriores.');

define('HEADING_RETURNING_CUSTOMER', 'Ya Soy Cliente');
define('TEXT_RETURNING_CUSTOMER', 'He comprado otras veces.');

define('TEXT_PASSWORD_FORGOTTEN', '&iquest;Ha olvidado su contrase&ntilde;a? Siga este enlace y se la enviamos.');

define('TEXT_LOGIN_ERROR', 'Error: El E-Mail y/o Contrase&ntilde;a no figuran en nuestros datos.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>Nota:</b></font> El contenido de su &quot;Cesta de Visitante&quot; ser&aacute; a&ntilde;adido a su &quot;Cesta de Asociado&quot; una vez que haya entrado. <a href="javascript:session_win();">[M&aacute;s Informaci&oacute;n]</a>');
// BOF Separate Pricing Per Customer
// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', 'root@localhost');
// **TIP:** The above root@localhost entry should be replaced with the site Admin's email address. This enables him to log-in as a member of each group for testing purposes. This email address must be defined in the osC Admin section called Configuration. 
//EOF Separate Pricing Per Customer
?>
