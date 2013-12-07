<?php
/*
  $Id: categories.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Categorias / Productos');
define('HEADING_TITLE_SEARCH', 'Buscar:');
define('HEADING_TITLE_GOTO', 'Ir A:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorias / Productos');
define('TABLE_HEADING_ACTION', 'Acci&oacute;n');
define('TABLE_HEADING_STATUS', 'Estado');

define('TEXT_NEW_PRODUCT', 'Nuevo Producto en &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categorias:');
define('TEXT_SUBCATEGORIES', 'Subcategorias:');
define('TEXT_PRODUCTS', 'Productos:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Precio:');
define('TEXT_PRODUCTS_PARA_BIRIMI', 'Moneda:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tipo Impuesto:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Evaluaci&oacute;n Media:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Cantidad:');
define('TEXT_DATE_ADDED', 'A&ntilde;adido el:');
define('TEXT_DATE_AVAILABLE', 'Fecha Disponibilidad:');
define('TEXT_LAST_MODIFIED', 'Modificado el:');
define('TEXT_IMAGE_NONEXISTENT', 'NO EXISTE IMAGEN');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Inserte una nueva categoria o producto.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Si quiere mas informaci&oacute;n, visite la <a href="http://%s" target="blank"><u>p&aacute;gina</u></a> de este producto.');
define('TEXT_PRODUCT_DATE_ADDED', 'Este producto fue a&ntilde;adido el %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este producto estar&aacute; disponible el %s.');

define('TEXT_EDIT_INTRO', 'Haga los cambios necesarios');
define('TEXT_EDIT_CATEGORIES_ID', 'ID Categoria:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nombre Categoria:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Imagen Categoria:');
define('TEXT_EDIT_SORT_ORDER', 'Orden:');

define('TEXT_INFO_COPY_TO_INTRO', 'Elija la categoria hacia donde quiera copiar este producto');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Categorias:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nueva Categoria');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editar Categoria');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Eliminar Categoria');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover Categoria');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Eliminar Producto');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover Producto');
define('TEXT_INFO_HEADING_COPY_TO', 'Copiar A');

define('TEXT_DELETE_CATEGORY_INTRO', 'Seguro que desea eliminar esta categoria?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Es usted seguro usted desea suprimir permanentemente este producto?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ADVERTENCIA:</b> Hay %s categorias que pertenecen a esta categoria!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ADVERTENCIA:</b> Hay %s productos en esta categoria!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Elija la categoria hacia donde quiera mover <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Elija la categoria hacia donde quiera mover <b>%s</b>');
define('TEXT_MOVE', 'Mover <b>%s</b> a:');

define('TEXT_NEW_CATEGORY_INTRO', 'Rellene los siguientes datos de la nueva categoria');
define('TEXT_CATEGORIES_NAME', 'Nombre Categoria:');
define('TEXT_CATEGORIES_IMAGE', 'Imagen Categoria:');
define('TEXT_SORT_ORDER', 'Orden:');

define('TEXT_PRODUCTS_STATUS', 'Estado de los Productos:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Fecha Disponibilidad:');
define('TEXT_PRODUCT_AVAILABLE', 'Disponible');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Agotado');
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricante del producto:');
define('TEXT_PRODUCTS_NAME', 'Nombre del Producto:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Descripci&oacute;n del producto:');
define('TEXT_PRODUCTS_QUANTITY', 'Cantidad:');
define('TEXT_PRODUCTS_MODEL', 'M&oacute;delo:');
define('TEXT_PRODUCTS_IMAGE', 'Imagen:');
define('TEXT_PRODUCTS_URL', 'URL del Producto:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sin http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Precio de los Productos (Net):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Precio de los Productos (Gross):');
define('TEXT_PRODUCTS_WEIGHT', 'Peso:');

define('EMPTY_CATEGORY', 'Categoria Vacia');

define('TEXT_HOW_TO_COPY', 'Metodo de Copia:');
define('TEXT_COPY_AS_LINK', 'Enlazar el producto');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicar el producto');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: No se pueden enlazar productos en la misma categoria.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de imagenes del cat&aacute;logo: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de imagenes del cat&aacute;logo: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Category cannot be moved into child category.');
/*** Begin Header Tags SEO ***/
define('TEXT_PRODUCT_METTA_INFO', '<b>Meta Tag Information</b>');
define('TEXT_PRODUCTS_PAGE_TITLE', 'Product Title Tag:');
define('TEXT_PRODUCTS_HEADER_DESCRIPTION', 'Product Description Tag:');
define('TEXT_PRODUCTS_KEYWORDS', 'Product Keywords Tag:');
/*** End Header Tags SEO ***/
// BOF Separate Pricing Per Customer
define('TEXT_CUSTOMERS_GROUPS_NOTE', 'Note that if a field is left empty, no price for that customer group will be inserted in the database.<br />
If a field is filled, but the checkbox is unchecked no price will be inserted either.<br />
If a price is already inserted in the database, but the checkbox unchecked it will be removed from the database.<div style="font-size:1.2em;padding-top:10px;">If you want to assign quantity price breaks for your customer group please use below format otherwise write only price.Below sample: 0 to 5 qty of that product price will 19</div>
<div style="font-size:1.4em;">0-5=>19, 6-10=>9, 11-20=>8, 21-30=>7</div>');
// EOF Separate Pricing Per Customer
?>