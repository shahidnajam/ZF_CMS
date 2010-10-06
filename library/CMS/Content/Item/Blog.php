<?php
class CMS_Content_Item_Blog extends CMS_Content_Item_Abstract
{
	/**
	 * These are the names of the nodes
	 */
	public $id;
	public $name;
	public $headline;
	public $category_id;
	public $image;
	public $description;
	public $blogContent;
	public $comments;
	
	protected $_namespace = "blog";
}
?>