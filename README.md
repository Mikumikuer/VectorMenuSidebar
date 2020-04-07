## Installation

To install the extension, place the entire `VectorMenuSidebar` directory within your
MediaWiki `extensions` directory, then add the following line to your
`LocalSettings.php` file:

```php
wfLoadExtension( 'VectorMenuSidebar' );
```
## What is this extension

Create your own wikitext based sidebar for Vector skin

requirement:`Font-awesome`

add `$wgVectorMenuSidebar = true;` in `LocalSettings.php` to activate MenuSidebar.

Sidebar style is built in backend, edit ./resources/MenuSidebar.css to customize MenuSidebar.

example for `Mediawiki:MenuSidebar` by default style settings:

	MenuTitle #1
	* '''NotLink Item must use Boldtext tag''' 
	** [externalLink Item]
	*** [[Item]]
	MenuTitle #2
	* [[Link Item]]
	** '''NotLink Item'''
	*** [[Item]]
	**** [[item Level can be infinite]]
	{{#Parser Function Item}}

Example site with MenuSidebar: www.gfwiki.org
