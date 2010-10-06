<?php
class Model_Tag extends Zend_Db_Table_Abstract
{
	protected $_name = 'tags';
	
	public function addTag($tag, $page_id)
	{
		$tag = strtolower($tag);
		$sql = $this->select()->where('tag=?', $tag);
		$res = $this->fetchRow($sql);
		if(!$res)
		{
			$this->insert(array('tag'=>$tag, 'page_id'=>$page_id));
		}
	}
	
	public function getTagCloud($page_id)
	{
		$weight = new Zend_Db_Expr('COUNT(tag)');
		$sql = $this->select()->
			from($this,array('tag', 'weight'=>$weight))->
			group('tag');
		if($page_id != 0) { $sql->where("page_id=?", $page_id); }
		$rows = $this->fetchAll($sql);
		
		if($rows)
		{
			$cloud = $this->buildCloud($rows);
			return $cloud;
		}
	}
	
	public function buildCloud($rows)
	{
		$cloud = new Zend_Tag_Cloud();
		foreach($rows as $row) 
		{
			$cloud->appendTag(array(
				'title'=>$row->tag,
				'weight'=>$row->weight,
				'params'=>array('url'=>'/search/index/tag/'.$row->tag)
			));
		}
		return $cloud;
	}
	
	public function getPagesByTag($tag)
	{
		$sql = $this->select()->where('tag=?',$tag);
		$rows = $this->fetchAll($sql);
		if($rows)
		{
			$pageIds = array();
			foreach($rows as $row)
			{
				$pageIds[] = $row->page_id;
			}
			
			return $pageIds;
		}
		return false;
	}
	
	public function getTagsByPage($page_id, $returnAsString=true)
	{
		$sql = $this->select()->where('page_id=?', $page_id);
		$rows = $this->fetchAll($sql);
		if($rows)
		{
			$str = '';
			$arr = array();
			foreach($rows as $row)
			{
				if($returnAsString === true)
				{
					$str .= ($str == '') ? $row->tag : ','.$row->tag;
				}
				else
				{
					$arr[] = $row->tag;
				}
			}
			if(!empty($arr)) { return $arr; } return $str;
		}
	}
	
	public function isTagOnPage($tag, $page)
	{
		$sql = $this->select()->where('tag=?', $tag)->where('page_id=?', $page);
		$row = $this->fetchRow($sql);
		if($row)
		{
			return true;
		}
		return false;
	}
	
	public function saveTags($tags, $page_id)
	{
		//remove spaces before and after commas
		$tagCSV = str_replace(', ', ',', str_replace(' ,', ',', $tags));
		//remove double commas
		$tagCSV = str_replace(',,', ',', $tagCSV);
		//remove dangling comma
		if(substr($tagCSV, -1) == ',') { $tagCSV = substr($tagCSV, 0, -1); }
		//turn into array
		$tags = explode(',', $tagCSV);
		
		//loop thru array: delete old tags and save new tags in tag table
		$sql = $this->select()->where('page_id=?',$page_id);
		$rows = $this->fetchAll($sql);
		if($rows)
		{
			foreach($rows as $row)
			{
				if(!in_array($row->tag, $tags))
				{
					$row->page_id = 0;
					$row->save();
				}
				$this->delete("page_id='0'");
			}
		}
		foreach($tags as $tag)
		{
			if($this->isTagOnPage($tag, $page_id) === false)
			{
				$this->insert(array('page_id'=>$page_id, 'tag'=>$tag));
			}
		}
	}
}
?>