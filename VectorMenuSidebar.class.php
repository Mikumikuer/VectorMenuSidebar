<?php
class VectorMenuSidebar {
    
    public static function BeforePageDisplay( $out, $skin ) {
        global $wgEnableVMSCustomStyle, $wgOut, $wgVectorMenuSidebar, $wgShowAfterMenuSidebar;//defined in LocalSettings.php
        
        if ( $wgOut->getSkin()->getSkinName() === "vector" ) {
            if ( $wgEnableVMSCustomStyle === true ){
                $style = wfMessage( 'MenuSidebar.css' )->plain();
                $out->addHeadItems( '<style type="text/css">'.$style.'</style>' );
            } else {
                $out->addHeadItems( '<link rel="stylesheet" type="text/css" href="/extensions/VectorMenuSidebar/resources/baseStyle.css">' );
            }
            
            if ( $wgVectorMenuSidebar === true ) {
                $out->addHTML( '<div id="MenuSidebar" style="display:none">'. wfMessage('MenuSidebar')->parse() . '<p id="vmsTB">' . wfMessage('toolbox')->plain() . '</p><ul id="MSToolbox"></ul>' );
                if ( $wgShowAfterMenuSidebar === true ) {
                        $out->addHTML( '<div>' . wfMessage('MenuSidebarAfter')->parse() . '</div>' );
                }
                $out->addHTML( '</div>' );
	    	$out->addHTML( '<script>window.addEventListener("DOMContentLoaded",(function(){document.querySelector("#MSToolbox").innerHTML=document.querySelector("#p-tb ul").innerHTML,document.querySelectorAll("#mw-panel > *:not(#p-logo)").forEach((function(e){return e.remove()}));for(var e=document.querySelectorAll("#MenuSidebar li>ul"),n=0;n<e.length;n++)e[n].parentElement.classList.add("child");e=document.querySelectorAll("#MenuSidebar > ul#MSToolbox > li");for(var o=0;o<e.length;o++)""===e[o].innerHTML&&e[o].parentNode.removeChild(e[o]);var r=document.querySelector("#MenuSidebar");r.setAttribute("style",""),document.querySelector("#mw-panel").appendChild(r)}));</script>' );
	    }
        }
        
        return true;
    }
}
