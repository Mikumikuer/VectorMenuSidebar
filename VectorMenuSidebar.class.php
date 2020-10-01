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
                echo '<script>window.toolbox=document.querySelector("#p-tb ul").innerHTML;var a=document.querySelectorAll("#mw-panel > *");for (var i=0;i<a.length;i++){if(a[i].id!="p-logo"){a[i].parentNode.removeChild(a[i])}}</script>';
                $MenuSidebar = wfMessage( 'MenuSidebar' )->parse();
                echo '<div id="MenuSidebar">'.$MenuSidebar;
                #echo '<div style="display:none">'.$wgOut->getSkin()->getSkinName().'</div>';
                echo '<p id="vmsTB">'.wfMessage( 'toolbox' )->plain().'</p><ul id="MSToolbox"></ul>';
                echo '<script>document.querySelector("#MSToolbox").innerHTML=window.toolbox;childlist = document.querySelectorAll("#MenuSidebar li>ul");for(var i=0;i<childlist.length;i++){childlist[i].parentElement.classList.add("child")};</script>';
                echo '<script>childlist = document.querySelectorAll("#MenuSidebar > ul#MSToolbox > li");for(var i=0;i<childlist.length;i++){if(childlist[i].innerHTML === ""){childlist[i].parentNode.removeChild(childlist[i])}};</script>';
		
		if ($wgShowAfterMenuSidebar===true) {
                        $MenuSidebarTail = wfMessage('MenuSidebarAfter')->parse();
                        echo '<div>'.$MenuSidebarTail.'</div>';
                }
                echo '</div>';
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
