<?php
/**
 * Menu
 *  
 * @author djheru
 * @version 
 */
class Model_Menu extends Zend_Db_Table_Abstract
{
	/**
	 * The default table name 
	 */
	protected $_name = 'menus';
	
	protected $_dependentTables = array('Model_MenuItem');
	
	protected $_referenceMap = array(
		'Menu'	=>array(
				'columns'		=>array('parent_id'),
				'refTableClass'	=>'Model_Menu',
				'refColumns'	=>array('id'),
				'onDelete'		=>self::CASCADE,
				'onUpdate'		=>self::RESTRICT
		)
	);
	
	
	public function createMenu($name)
	{
		$row = $this->createRow();
		$row->name = $name;
		return $row->save();
	}
	
	public function getMenus()
	{
		$select = $this->select();
		$select->order('name ASC');
		$menus = $this->fetchAll($select);
		if($menus->count() > 0)
		{
			return $menus;
		}
		return null;
	}
	
	public function updateMenu($id, $name)
	{
		$menu = $this->find($id)->current();
		if($menu)
		{
			//clear the cache entry for this menu
			$cache = Zend_Registry::get('cache');
			$id = "menu_".$id;
			$cache->remove($id);
			//update record
			$menu->name = $name;
			return $menu->save();
		}
		return false;
	}
	
	public function deleteMenu($id)
	{
		$row = $this->find($id)->current();
		if($row)
		{
			//clear the cache entry for this menu
			$cache = Zend_Registry::get('cache');
			$id = "menu_".$id;
			$cache->remove($id);
			return $row->delete;
		}
		else
		{
			throw new Zend_Exception("Error Loading Menu");
		}
	}
}
