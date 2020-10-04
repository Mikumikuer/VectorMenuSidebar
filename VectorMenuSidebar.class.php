<?php
class VectorMenuSidebar {
    public static function BeforePageDisplay($out, $skin) {
        global $wgEnableVMSCustomStyle,$wgOut,$wgVectorMenuSidebar,$wgShowAfterMenuSidebar;//defined in LocalSettings.php
        
        if ($wgOut->getSkin()->getSkinName()!="vector"){
                return true;
        }
        
        if ($wgEnableVMSCustomStyle===true){
                $style=wfMessage('MenuSidebar.css')->plain();
                $out->addHeadItems('<style type="text/css">'.$style.'</style>');
        } else {
                $out->addHeadItems('<link rel="stylesheet" type="text/css" href="/extensions/VectorMenuSidebar/resources/baseStyle.css">');
        }
        
        if ($wgVectorMenuSidebar===true) {
                $out->addHTML('<div id="MenuSidebar" style="display:none">'. wfMessage('MenuSidebar')->parse() . '<p id="vmsTB">' . wfMessage('toolbox')->plain() . '</p><ul id="MSToolbox"></ul>');
                if ($wgShowAfterMenuSidebar === true) {
                        $out->addHTML('<div>' . wfMessage('MenuSidebarAfter')->parse() . '</div>');
                }
                $out->addHTML('</div>');
                $out->addHTML('<script>window.addEventListener("DOMContentLoaded",(function(){document.querySelector("#MSToolbox").innerHTML=document.querySelector("#p-tb ul").innerHTML,document.querySelectorAll("#mw-panel > *:not(#p-logo)").forEach((function(e){return e.remove()}));for(var e=document.querySelectorAll("#MenuSidebar li>ul"),n=0;n<e.length;n++)e[n].parentElement.classList.add("child");e=document.querySelectorAll("#MenuSidebar > ul#MSToolbox > li");for(var o=0;o<e.length;o++)""===e[o].innerHTML&&e[o].parentNode.removeChild(e[o]);var r=document.querySelector("#MenuSidebar");r.setAttribute("style",""),document.querySelector("#mw-panel").appendChild(r),window.__VECTOR_MENU_SIDE_BAR_MOUNTED__&&window.__VECTOR_MENU_SIDE_BAR_MOUNTED__()}));</script>');
        }
        return true;
    }
    
    public static function onBeforePageDisplayMobile( OutputPage $out, Skin $sk ) {
        $script = <<<'START_END_MARKER'
<script>function menuadjust(){var a = $("body").height()+"px";document.getElementById("mw-mf-page-left").style.height = a;};$(function(){menuadjust();});
$(window).resize(function(){menuadjust()});
var navbar = function(data, textStatus, jqxhr) {
    var navlist = data.parse.text["*"];
	$(navlist).insertBefore(".menu > .hlist")
  };
var mfSidebar = function() {
    var purl = "/api.php?action=parse&page=MediaWiki:MFSidebar&format=json";
    $.ajax({
      url: purl,
      success: navbar,
      error: function () {console.error("can\'t load customized navmenu")},
      dataType: "json"
    });
  };
$(function(){mfSidebar();});
</script>
START_END_MARKER;
        $out->addHeadItem('mfsidebar', $script);
		return true;
    }
}
