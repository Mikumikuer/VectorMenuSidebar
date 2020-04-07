<?php
class VectorMenuSidebar {
    public static function BeforePageDisplay($out, $skin) {
        $out->addHeadItems('<link rel="stylesheet" type="text/css" href="/extensions/VectorMenuSidebar/resources/baseStyle.css">');
        return true;
    } 
    public static function onVectorBeforeFooter() {
        global $wgVectorMenuSidebar,$wgShowAfterMenuSidebar;	
	if ($wgVectorMenuSidebar===true) {
        	echo '<script>window.toolbox=document.querySelector("#p-tb ul").innerHTML;var a=document.querySelectorAll("#mw-panel > *");for (var i=0;i<a.length;i++){if(a[i].id!="p-logo"){a[i].parentNode.removeChild(a[i])}}</script>';
		$MenuSidebar = wfMessage( 'MenuSidebar' )->parse();
        	echo '<div id="MenuSidebar">'.$MenuSidebar;
     	  	echo '<p id="vmsTB">'.wfMessage( 'toolbox' )->plain().'</p><ul id="MSToolbox"></ul></div>';
      		echo '<script>document.querySelector("#MSToolbox").innerHTML=window.toolbox;childlist = document.querySelectorAll("#MenuSidebar li>ul");for(var i=0;i<childlist.length;i++){childlist[i].parentElement.classList.add("child")};</script>';
    		echo '<script>childlist = document.querySelectorAll("#MenuSidebar > ul#MSToolbox > li");for(var i=0;i<childlist.length;i++){if(childlist[i].innerHTML === ""){childlist[i].parentNode.removeChild(childlist[i])}};</script>';
        	if ($wgShowAfterMenuSidebar===true) {
			$MenuSidebarTail = wfMessage('MenuSidebarAfter')->parse();
			echo $MenuSidebarTail;
		}
	return true;
        }

    }
}

