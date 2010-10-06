<?php
class CMS_Content_Item_Page extends CMS_Content_Item_Abstract
{
	/**
	 * These are the names of the nodes
	 */
	public $id;
	public $name;
	public $headline;
	//public $image;
	public $description;
	public $pageContent;
	protected $_namespace = "page";
}
?>