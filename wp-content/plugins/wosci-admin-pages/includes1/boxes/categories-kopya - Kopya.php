<?php
/*
  $Id: categories.php,v 1.25 2003/07/09 01:13:58 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
?>
<style type="text/css">

/*Credits: Dynamic Drive CSS Library */
/*URL: http://www.dynamicdrive.com/style/ */

.suckerdiv ul{
margin: 0;
padding: 0;
list-style-type: none;
width: 143px; /* Width of Menu Items */
border-bottom: 1px solid #f8f8f9;
font-family: arial;
font-size: 11px;
font-weight: bold;
}
	
.suckerdiv ul li{
position: relative;
background-color: #f8f8f9;
}
	
/*1st level sub menu style */
.suckerdiv ul li ul{
left: 142px; /* Parent menu width - 1*/
position: absolute;
width: 120px; /*sub menu width*/
top: 0;
display: none;
}

/*All subsequent sub menu levels offset */
.suckerdiv ul li ul li ul{ 
left: 199px; /* Parent menu width - 1*/
}

/*All subsequent sub menu levels offset */
.suckerdiv ul li ul li a{ 
left: 199px; /* Parent menu width - 1*/
background-color: #f8f8f9;
}

/*All subsequent sub menu levels offset */
.suckerdiv ul li ul li ul li a{ 
background-color: #bbb;
}

/*All subsequent sub menu levels offset */
.suckerdiv ul li ul li ul li ul li a{ 
background-color: #aaa;
}

/* menu links style */
.suckerdiv ul li a{
display: block;
color: black;
text-decoration: none;
background-color: #f8f8f9;
padding: 1px 5px;
border: 1px solid #f8f8f9;
border-bottom: 0;
line-height: 2em;
}

.suckerdiv ul li a:visited{
color: black;
font-weight: bold;
}

.suckerdiv ul li a:hover{
background-color: #ffd800;
color: black;

font-weight: bold;
}

.suckerdiv ul li ul li a:hover{
background-color: #ffd800;
color: black;

font-weight: bold;
}

.suckerdiv ul li ul li ul li a:hover{
background-color: yellow;
color: black;
text-decoration: none;
}

/* The main categories with sub-categories */
.suckerdiv .subfolderstyle{
background: url(images/forward-arrow.png) no-repeat center right;

}

/* This one colors the sub-folder with other sub-folders */
.suckerdiv ul li ul .subfolderstyle {
background-color: #f8f8f9;
}

/* This one colors the sub-folder with other sub-folders */
.suckerdiv ul li ul li ul .subfolderstyle {
background-color: #bbb;
}

/* This one colors the sub-folder with other sub-folders */
.suckerdiv ul li ul li ul li ul .subfolderstyle {
background-color: #aaa;
}
#suckertree1 ul {border: 1px solid #000000;z-index: auto}	
/* Holly Hack for IE \*/
* html .suckerdiv ul li { float: left; height: 1%; }
* html .suckerdiv ul li a { height: 1%; }
/* End */

</style>

<script type="text/javascript">

//SuckerTree Vertical Menu (Aug 4th, 06)
//By Dynamic Drive: http://www.dynamicdrive.com/style/

var menuids=["suckertree1"] //Enter id(s) of SuckerTree UL menus, separated by commas

function buildsubmenus(){
for (var i=0; i<menuids.length; i++){
  var ultags=document.getElementById(menuids[i]).getElementsByTagName("ul")
    for (var t=0; t<ultags.length; t++){
    ultags[t].parentNode.getElementsByTagName("a")[0].className="subfolderstyle"
    ultags[t].parentNode.onmouseover=function(){
    this.getElementsByTagName("ul")[0].style.display="block"
    }
    ultags[t].parentNode.onmouseout=function(){
    this.getElementsByTagName("ul")[0].style.display="none"
    }
    }
  }
}

if (window.addEventListener)
window.addEventListener("load", buildsubmenus, false)
else if (window.attachEvent)
window.attachEvent("onload", buildsubmenus)

</script>
<?
global $tree, $categories_string, $cPath_array, $languages_id;
  function PrintSubMenus( $parentID, $languageID, $start_path ){
      $returnval = '';
      if (($start_path == '') && ($parentID > 0)) {
        $start_path = $parentID;
      } else {
        if ($parentID > 0) $start_path .= "_" . $parentID;
      }
      if ($parentID != 0) {
        $returnval .= "<ul>";
      } else {
        $returnval .= "<div class='suckerdiv'>";
        $returnval .= "<ul id='suckertree1'>";
      }
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '".$parentID."' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languageID ."' order by sort_order, cd.categories_name");
      while ($categories = tep_db_fetch_array($categories_query))  {
        if ($start_path == "") {
          $grouppath = $categories['categories_id'];
        } else {
          $grouppath = $start_path . "_" . $categories['categories_id'];
        }
        $cPath_new = 'cPath=' . $grouppath;
        $categories_string = tep_href_link(FILENAME_DEFAULT, $cPath_new);
        $returnval .= "<li><a href='".$categories_string."'>".$categories['categories_name']."</a>";
        if ( tep_has_category_subcategories($categories['categories_id'] ) ) {
           $returnval .= PrintSubMenus( $categories['categories_id'], $languageID, $start_path );
        }
        $returnval .= "</li>";
      }
      $returnval .= "</ul>";
      if ($parentID == 0) $returnval .= "</div>";
      return $returnval;
  }
?>
<!-- categories //-->
          <tr>
            <td>
<?php
  $info_box_contents = array();
  $info_box_contents[] = array('text' => BOX_HEADING_CATEGORIES);

  new infoBoxHeading($info_box_contents, true, false);

  $info_box_contents = array();
  $info_box_contents[] = array('text' => PrintSubMenus( 0, $languages_id, '' ));

  new infoBox($info_box_contents);

?>
            </td>
          </tr>
<!-- categories_eof //-->
