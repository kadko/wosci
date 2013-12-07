<?php
/*
  $Id: header_tags.php,v 1.6 2007/01/10 by Jack_mcs - http://www.oscommerce-solution.com

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce
  Portions Copyright 2009 oscommerce-solution.com

  Released under the GNU General Public License
*/ 

////
//used to add new pages without adding a lot of code
function tep_header_tag_page($file) {
  global $tmpTags, $languages_id;

  $header_tags_array = array();
  $sortOrder = array();
  
  $pageTags_query = tep_db_query("select * from " . TABLE_HEADERTAGS . " where page_name like '" . $file . "' and language_id = '" . (int)$languages_id . "'");
  $pageTags = tep_db_fetch_array($pageTags_query);
    
  if ($pageTags['append_root'])
  {
    $sortOrder['title'][$pageTags['sortorder_root']] = $pageTags['page_title']; 
    $sortOrder['description'][$pageTags['sortorder_root']] = $pageTags['page_description']; 
    $sortOrder['keywords'][$pageTags['sortorder_root']] = $pageTags['page_keywords']; 
    $sortOrder['logo'][$pageTags['sortorder_root']] = $pageTags['page_logo'];
    $sortOrder['logo_1'][$pageTags['sortorder_root_1']] = $pageTags['page_logo_1'];
    $sortOrder['logo_2'][$pageTags['sortorder_root_2']] = $pageTags['page_logo_2'];
    $sortOrder['logo_3'][$pageTags['sortorder_root_3']] = $pageTags['page_logo_3'];
    $sortOrder['logo_4'][$pageTags['sortorder_root_4']] = $pageTags['page_logo_4'];
  }
  
  if ($pageTags['append_default_title'] && tep_not_null($tmpTags['def_title'])) $sortOrder['title'][$pageTags['sortorder_title']] = $tmpTags['def_title'];
  if ($pageTags['append_default_description'] && tep_not_null($tmpTags['def_desc'])) $sortOrder['description'][$pageTags['sortorder_description']] = $tmpTags['def_desc'];
  if ($pageTags['append_default_keywords'] && tep_not_null($tmpTags['def_keywords'])) $sortOrder['keywords'][$pageTags['sortorder_keywords']] = $tmpTags['def_keywords'];
  if ($pageTags['append_default_logo'] && tep_not_null($tmpTags['def_logo_text']))  $sortOrder['logo'][$pageTags['sortorder_logo']] = $tmpTags['def_logo_text'];

  FillHeaderTagsArray($header_tags_array, $sortOrder);

  //if nothing else is set, force the page name and default settings, if present   
  $path_parts = pathinfo($_SERVER['PHP_SELF']);
  $pageName = substr($path_parts['basename'], 0,strpos($path_parts['basename'],'.')) . ' ';
  $pageName = ucwords(preg_replace("/[^A-Za-z0-9]/", " ", $pageName));

  if (! tep_not_null($header_tags_array['title'])) $header_tags_array['title'] = $pageName . (tep_not_null($tmpTags['def_title']) ? HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ' . $tmpTags['def_title'] : '');
  if (! tep_not_null($header_tags_array['description'])) $header_tags_array['description'] = $pageName . (tep_not_null($tmpTags['def_desc']) ? HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ' . $tmpTags['def_desc'] : '');
  if (! tep_not_null($header_tags_array['keywords'])) $header_tags_array['keywords'] = $pageName . (tep_not_null($tmpTags['def_keywords']) ? HEADER_TAGS_SEPARATOR_KEYWORD . ' ' . $tmpTags['def_keywords'] : '');
  if (! tep_not_null($header_tags_array['logo']))  $header_tags_array['logo'] = $pageName . (tep_not_null($tmpTags['def_logo_text']) ? HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ' . $tmpTags['def_logo_text'] : '');

  return $header_tags_array;
}

function FillHeaderTagsArray(&$header_tags_array, $sortOrder)
{
  if (count($sortOrder) == 0)
    return;
    
  $sortOrder = MultiKeySort($sortOrder);

  if (isset($sortOrder['title']))       $header_tags_array['title'] = ltrim(tep_db_prepare_input(implode(' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ', $sortOrder['title'])), ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION);
  if (isset($sortOrder['description'])) $header_tags_array['desc'] = ltrim(tep_db_prepare_input(implode(' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ', $sortOrder['description'])), ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION);
  if (isset($sortOrder['keywords']))    $header_tags_array['keywords'] = ltrim(tep_db_prepare_input(implode(' ' . HEADER_TAGS_SEPARATOR_KEYWORD . ' ', $sortOrder['keywords'])), ' ' . HEADER_TAGS_SEPARATOR_KEYWORD);
  if (isset($sortOrder['logo']))        $header_tags_array['logo_text'] = ltrim(tep_db_prepare_input(implode(' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ', $sortOrder['logo'])), ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION);
  if (isset($sortOrder['logo_1']))      $header_tags_array['logo_text_1'] = ltrim(tep_db_prepare_input(implode(' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ', $sortOrder['logo_1'])), ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION);
  if (isset($sortOrder['logo_2']))      $header_tags_array['logo_text_2'] = ltrim(tep_db_prepare_input(implode(' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ', $sortOrder['logo_2'])), ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION);
  if (isset($sortOrder['logo_3']))      $header_tags_array['logo_text_3'] = ltrim(tep_db_prepare_input(implode(' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ', $sortOrder['logo_3'])), ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION);
  if (isset($sortOrder['logo_4']))      $header_tags_array['logo_text_4'] = ltrim(tep_db_prepare_input(implode(' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ', $sortOrder['logo_4'])), ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION);
}
 
function GetCategoryAndManufacturer($sortOrder, $pageTags, $defaultTags, $catStr, $manStr, $product = false)
{
  global $category_depth, $current_category_id, $languages_id;;
  
  $type = 'top'; //not used
  if ($category_depth == 'nested' || $category_depth == 'products') 
    $type = 'cat';
  else if (isset($_GET['manufacturers_id'])) 
    $type = 'man';  

  if (($type == 'cat' || $type == 'top') && ($pageTags['append_category'] || $defaultTags['default_logo_append_group'] || $defaultTags['default_logo_append_category']))
  {
    if ($category_depth == 'nested' || $category_depth == 'products' || $product)
    {
      $the_category_query = tep_db_query($catStr);
      $parentStr = '';

      if (HEADER_TAGS_ADD_CATEGORY_PARENTS == 'Duplicate Categories' && $product && tep_db_num_rows($the_category_query) > 1) //selected product is in multiple categories
      {
        $ctr = 0;
        $lastCatPos = (tep_db_num_rows($the_category_query) - 1);
          
        while ($the_category = tep_db_fetch_array($the_category_query))
        {
          $parentStr .= $the_category['htc_title_tag'] . '  ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ';
          if ($ctr++ == $lastCatPos - 1) //don't add the last one since it will be done below
            break;
        }

        tep_db_data_seek($the_category_query, $lastCatPos);
        $the_category = tep_db_fetch_array($the_category_query);
        $header_tags_array['category'] = $the_category['htc_title_tag'];  //save for use on the logo
      }
      else 
      {
        $the_category = tep_db_fetch_array($the_category_query);
        $header_tags_array['category'] = $the_category['htc_title_tag'];  //save for use on the logo

        if (HEADER_TAGS_ADD_CATEGORY_PARENTS == 'Full Category Path') 
          $parentStr = GetCategoryParentString($current_category_id, $languages_id);
      }  
      
      if (tep_not_null($the_category['htc_title_tag']))
      {
        $catTitle = tep_not_null($parentStr) ? ($parentStr . $the_category['htc_title_tag']) : $the_category['htc_title_tag'];  
        $sortOrder['title'][$pageTags['sortorder_category']] = tep_not_null($sortOrder['title'][$pageTags['sortorder_category']]) ? $sortOrder['title'][$pageTags['sortorder_category']] . ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ' . $catTitle : $catTitle;
        $sortOrder['logo'][$pageTags['sortorder_category']] = tep_not_null($sortOrder['logo'][$pageTags['sortorder_category']]) ? $sortOrder['logo'][$pageTags['sortorder_category']] . ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ' . $catTitle : $catTitle;
      }
      if (tep_not_null($the_category['htc_desc_tag']))
      {
        $catDesc = tep_not_null($parentStr) ? ($parentStr . $the_category['htc_desc_tag']) : $the_category['htc_desc_tag'];  
        $sortOrder['description'][$pageTags['sortorder_category']] = tep_not_null($sortOrder['description'][$pageTags['sortorder_category']]) ? $sortOrder['description'][$pageTags['sortorder_category']] . ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ' . $catDesc : $catDesc;
      }
      if (tep_not_null($the_category['htc_keywords_tag']))
      {
        $catKeywords = tep_not_null($parentStr) ? (str_replace(HEADER_TAGS_SEPARATOR_DESCRIPTION, HEADER_TAGS_SEPARATOR_KEYWORD, $parentStr) . $the_category['htc_keywords_tag']) : $the_category['htc_keywords_tag'];  
        $sortOrder['keywords'][$pageTags['sortorder_category']] = tep_not_null($sortOrder['keywords'][$pageTags['sortorder_category']]) ? $sortOrder['keywords'][$pageTags['sortorder_category']] . ' ' . HEADER_TAGS_SEPARATOR_KEYWORD . ' ' . $catkeywords : $catKeywords;
      }
    }
  }

  if ($type == 'man' && ($pageTags['append_manufacturer'] || $defaultTags['default_logo_append_group'] || $defaultTags['default_logo_append_manufacturer']))
  {
    $the_manufacturer_query= tep_db_query($manStr);
    $the_manufacturer = tep_db_fetch_array($the_manufacturer_query);
    $header_tags_array['manufacturer'] = $the_manufacturer['htc_title_tag'];  //save for use on the logo

    $sortOrder['title'][$pageTags['sortorder_manufacturer']] = '';
    $sortOrder['logo'][$pageTags['sortorder_manufacturer']] = '';
    $sortOrder['description'][$pageTags['sortorder_manufacturer']] = '';
    $sortOrder['keywords'][$pageTags['sortorder_manufacturer']] = '';
   
    if (tep_not_null($the_manufacturer['htc_title_tag']))
    {
      $sortOrder['title'][$pageTags['sortorder_manufacturer']] = tep_not_null($sortOrder['title'][$pageTags['sortorder_manufacturer']]) ? $sortOrder['title'][$pageTags['sortorder_manufacturer']] . ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ' . $the_manufacturer['htc_title_tag'] : $the_manufacturer['htc_title_tag'];
      $sortOrder['logo'][$pageTags['sortorder_manufacturer']] = tep_not_null($sortOrder['logo'][$pageTags['sortorder_manufacturer']]) ? $sortOrder['title'][$pageTags['sortorder_manufacturer']] . ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ' . $the_manufacturer['htc_title_tag'] : $the_manufacturer['htc_title_tag'];
    }
    if (tep_not_null($the_manufacturer['htc_desc_tag']))
    {
      $sortOrder['description'][$pageTags['sortorder_manufacturer']] = tep_not_null($sortOrder['description'][$pageTags['sortorder_manufacturer']]) ? $sortOrder['title'][$pageTags['sortorder_manufacturer']] . ' ' . HEADER_TAGS_SEPARATOR_DESCRIPTION . ' ' . $the_manufacturer['htc_desc_tag'] : $the_manufacturer['htc_desc_tag'];
      $sortOrder['description'][$pageTags['sortorder_manufacturer']] = $the_manufacturer['htc_desc_tag'];
    }
    if (tep_not_null($the_manufacturer['htc_keywords_tag']))
    {
      $sortOrder['keywords'][$pageTags['sortorder_manufacturer']] = tep_not_null($sortOrder['keywords'][$pageTags['sortorder_manufacturer']]) ? $sortOrder['title'][$pageTags['sortorder_manufacturer']] . ' ' . HEADER_TAGS_SEPARATOR_KEYWORD . ' ' . $the_manufacturer['htc_keywords_tag'] : $the_manufacturer['htc_keywords_tag'];
    }
  }
  return $sortOrder;
}

function GetCanonicalURL()
{
  $parts = explode("&", $_SERVER['QUERY_STRING']);
  $cnt = count($parts);
  
  if ($cnt == 1 && basename($_SERVER['PHP_SELF']) === FILENAME_DEFAULT) //home page
     return StripSID(tep_href_link('/', $args, 'NONSSL', false) );

  $args = tep_get_all_get_params(array('action','currency', tep_session_name(),'sort','page'));
  return StripSID(tep_href_link(basename($_SERVER['PHP_SELF']), $args, 'NONSSL', false) );
}

function GetCategoryName($category_id, $language_id) {
  $category_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
  $category = tep_db_fetch_array($category_query);

  return $category['categories_name'];
}

function add_separators(&$item) 
{ 
  $item = $item . '  '. HEADER_TAGS_SEPARATOR_DESCRIPTION . '  '; 
} 

// Build a string of the parent categories properly separated
function GetCategoryParentString($current_category_id, $languages_id)
{
  $parentCats = array();
  $parentCatsNames = array();
  tep_get_parent_categories($parentCats, $current_category_id);
  $parentCats = array_reverse($parentCats);

  foreach ($parentCats as $pc)
    $parentCatsNames[] = GetCategoryName($pc, $languages_id);

  array_walk($parentCatsNames, 'add_separators'); 
  $csv = implode(" ", $parentCatsNames);
  return $csv;
}
  
function MultiKeySort($k)
{
  if (! is_array($k))
   $k = array();
  
  foreach ($k as $key => $val)  
  {  
    ksort($val);  
    $k[$key] = $val; 
  } 
  return $k;
}

//Remove the session ID for canonical tags
function StripSID($url)
{
  $sidName = tep_session_name();
  if (isset($_GET[ $sidName ]))
  {
    if (($sid = strpos($url, $_GET[ $sidName ])) !== FALSE)
    {
       $SidLength = strlen($_GET[ $sidName ]) + strlen( $sidName ) + 2; // to account for the "?" and "="     
       return substr($url , 0, - $SidLength );
    }
  }
  return $url;
}

function ReadCacheHeaderTags(&$header_tags_array, $filename, $languages, $id)
{
   global $language;
   return ( (HEADER_TAGS_ENABLE_CACHE == 'None') ? false :  ReadCacheFromDB($header_tags_array, 'header_tags_' . $filename . '_' . $language . '_cache_id_' . $id) ); 
//   return ( (HEADER_TAGS_ENABLE_CACHE == 'false') ? false :  read_cache($header_tags_array, 'header_tags_' . $filename . '_' . $language . '_cache_id_' . $id) ); 
}

function ReadCacheFromDB(&$data, $name, $gzip = 0)
{
   $gzip = ( HEADER_TAGS_ENABLE_CACHE == 'GZip' ? true : false );
   $name = serialize($name);
   $name = ( $gzip == 1 ? base64_encode(gzdeflate($name, 1)) : $name );
  
   $cache_query = tep_db_query("select * from " . TABLE_HEADERTAGS_CACHE . " where title = '" . $name . "' limit 1");
   
   if (tep_db_num_rows($cache_query) > 0)
   {
      $cache = tep_db_fetch_array($cache_query);
      $cache = ( $gzip == 1 ? @gzinflate(base64_decode($cache['data'])) : stripslashes($cache['data']) );
      $data = unserialize($cache);
      return $data;
   }
}

function WriteCacheHeaderTags($header_tags_array, $filename, $languages, $id)
{
   global $language;
   
   if (HEADER_TAGS_ENABLE_CACHE != 'None')
   {   
      ob_start();  
      $cache_output = $header_tags_array; //ob_get_contents();
      ob_end_clean();
      
      if (tep_not_null($cache_output))
          WriteCacheToDB($cache_output, 'header_tags_' . $filename . '_' . $language . '_cache_id_' . $id);
//      write_cache($cache_output, 'header_tags_' . $filename . '_' . $language . '_cache_id_' . $id);
   }
}

function WriteCacheToDB($data, $name)
{
   $gzip = ( HEADER_TAGS_ENABLE_CACHE == 'GZip' ? true : false );
   $name = serialize($name);
   $name = ( $gzip == 1 ? base64_encode(gzdeflate($name, 1)) : $name );
   
   $data = serialize($data);
   $data = ( $gzip == 1 ? base64_encode(gzdeflate($data, 1)) : addslashes($data) );

   $cache_query = tep_db_query("select 1 from " . TABLE_HEADERTAGS_CACHE . " where title = '" . $name . "' limit 1");

   if (tep_db_num_rows($cache_query) == 0)
       tep_db_query("insert into " . TABLE_HEADERTAGS_CACHE . " ( title, data ) values ('" . $name . "', '" . $data . "')");
   else
       tep_db_query("update " . TABLE_HEADERTAGS_CACHE . " set data = '" . $data . "'");
}
?>
