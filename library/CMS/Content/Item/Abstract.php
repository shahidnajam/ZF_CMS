<?php

/**
 * class CMS_Content_Item_Abstract
 * Base class for content types
 */
abstract class CMS_Content_Item_Abstract
{
	/**
	 * autoincrement id
	 * @access public
	 * @var int $id
	 */
	public $id;
	
	/**
	 * name of page
	 * @access public
	 * @var string $name
	 */
	public $name;
	
	/**
	 * autoincrement id of parent of page
	 * @access public
	 * @var int $parent
	 */
	public $parent_id=0;
	
	/**
	 * defines the "type" of content item
	 * @access protected
	 * @var string $_namespace
	 */
	protected $_namespace = 'page';
	
	/**
	 * instance of the Zend_Db_Table_Abstract descendant
	 * @access protected
	 */
	protected $_pageModel;
	
	
	const NO_SETTER = 'Setter method does not exist';
	
	/**
	 * instantiates new page model and loads page if ID is provided
	 * @param int $pageId
	 */
	function __construct($pageId = null)
	{
		$this->_pageModel = new Model_Page();
		if(null != $pageId)
		{
			$this->loadPageObject(intval($pageId));
		}
	}
	
	/**
	 * Loads the nodes and builds the page object
	 * @var int $id
	 */
	public function loadPageObject($id)
	{
		$this->id = $id;
		$row = $this->_getInnerRow();
		if($row)
		{
			if($row->namespace != $this->_namespace)
			{
				throw new Zend_Exception("Unable to cast page type: ".
					$row->namespace." to type ".$this->_namespace);
			}
			$this->name = $row->name;
			$this->parent_id = $row->parent_id;
			$contentNode = new Model_ContentNode();
			$nodes = $row->findDependentRowset($contentNode);
			if($nodes)
			{
				$properties = $this->_getProperties(); //get a list of all the public properties of the child class of $this
				foreach($nodes as $node)
				{
					$key = $node['node'];//node key describes the type of node i.e. headline
					if(in_array($key, $properties))//if the type of node (i.e. headline) is a property of the child class
					{
						$value = $this->_callSetterMethod($key, $nodes); //see if we have a setter method defined in the child class
						if($value === self::NO_SETTER) //if not, then we set the value (of the headline) directly from the content of the node
						{
							$value = $node['content'];
						}
						$this->$key = $value; //then we set the (headline) property of the child class of $this
					}
				}
			}
		}
		else
		{
			throw new Zend_Exception("Unable to load content item");
		}
	}
	
	/**
	 * Loads the page data
	 * @param int $id
	 * @return Zend_Db_Table_Row
	 */
	protected function _getInnerRow($id=null)
	{
		if($id == null)
		{
			$id = $this->id;
		}
		return $this->_pageModel->find($id)->current();
	}
	
	/**
	 * Get all the properties of subclasses
	 * @return array
	 */
	protected function _getProperties()
	{
		$propertyArray = array();
		$class = new Zend_Reflection_Class($this);
		$properties = $class->getProperties();
		foreach($properties as $p)
		{
			if($p->isPublic())
			{
				$propertyArray[] = $p->getName();
			}
		}
		
		return $propertyArray;
	}
	
	/**
	 * return setter method name if available for subclass properties
	 * @return string
	 */
	protected function _callSetterMethod($property, $data)
	{
		$method = Zend_Filter::filterstatic($property, 'Word_UnderscoreToCamelCase');
		
		$methodName = '_set'.$method;
		if(method_exists($this, $methodName))
		{
			return $this->$methodName($data);
		}
		else
		{
			return self::NO_SETTER;
		}
	}
	
	/**
	 * utility function 
	 * @return array
	 */
	public function toArray()
	{
		$properties = $this->_getProperties();
		foreach($properties as $p)
		{
			$array[$p] = $this->$p;
		}
		return $array;
	}
	
	/**
	 * Controls creation or update in db
	 * @return int
	 */
	public function save()
	{
		if(isset($this->id))
		{
			$id = $this->id;
			$this->_update();
		}
		else 
		{
			$id = $this->_insert();
		}
		
		return $id;
	}
	
	/**
	 * creates page in db
	 * @return int
	 */
	protected function _insert()
	{
		$pageId = $this->_pageModel->createPage($this->name, $this->_namespace, $this->parent_id);//create the page record
		$this->id = $pageId; //get the autoincrement id
		$id = $this->_update();
		return $id;
	}
	
	/**
	 * updates page
	 * @return int
	 */
	protected function _update()
	{
		$data = $this->toArray(); //get all of the properties of $this (e.g. headline, description, content, etc) and put them in a data array
		$this->_pageModel->updatePage($this->id, $data); //update the page nodes via the Page model method
		return $this->id;
	}
	
	/**
	 * deletes page
	 */
	public function delete()
	{
		if(isset($this->id))
		{
			$this->_pageModel->deletePage($this->id);
		}
		else
		{
			throw new Zend_Exception('Unable to delete item; the item is empty!');
		}
	}
	
	static public function txtBtwnTags($html, $tag='code', $strict=0)
	{
		$dom = new domDocument;
		if($strict == 1)
		{
			$dom->loadXML($html);
		}
		else
		{
			$dom->loadHTML($html);
		}
		$dom->preserveWhiteSpace = false;
		$content = $dom->getElementsByTagname($tag);
		
		$output = array();
		foreach($content as $item)
		{
			$output[] = $item->nodeValue;
		}
		return implode($output);
	}
}
?>