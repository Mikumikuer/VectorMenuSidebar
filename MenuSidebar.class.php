<?php
class MenuSidebar {
	public static function onSkinBuildSidebar ($skin, &$bar) {
		$toolbox = BaseTemplate::getToolbox();//get Toolbox links list
		$MenuSidebar = wfMessage( 'MenuSidebar' )->parse();//parse Mediawiki:MenuSidebar
		echo '<div id="MenuSidebar">'.$MenuSidebar;
		echo '<p>'.wfMessage( 'toolbox' )->plain().'</p><ul id="MSToolbox">';
		foreach ($toolbox as  $msg => $content) {//get Toolbox links
			if( $msg=='feeds' ){//detach atom feeds since I don't know how to echo this :(
				continue;
			} else {
				echo $this->renderMenuSidebarSpecialItem( $msg, $content, $toolbox[$msg]['text']);
			}
		}
		echo '</ul></div>';
		echo '<script id="navbarInit">childlist = document.querySelectorAll("#MenuSidebar li>ul");for(var i=0;i<childlist.length;i++){childlist[i].parentElement.classList.add("child")};$("#navbarInit").remove();</script>';//If a <li> contains <ul>, add "child" class to it
		echo '<script id="ToolboxInit">childlist = document.querySelectorAll("#MenuSidebar > ul#MSToolbox > li");for(var i=0;i<childlist.length;i++){if(childlist[i].innerHTML === ""){$(childlist[i]).remove()}};$("#ToolboxInit").remove();</script>';//dealwith toolbox parser bug
		return true;
	}
	protected function renderMenuSidebarSpecialItem( $name, $content, $text) {
		if ( !isset( $text ) ) {
			$innertext = wfMessage( $name )->text();
		} else {
			$innertext = $text;
		}
		return '<li><a href="'.$content['href'].'" id="'.$content['id'].'">'.$innertext.'</a><li>';
	}
}
