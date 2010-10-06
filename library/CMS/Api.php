<?php
class CMS_Api
{
	protected function _validateKey($apiKey)
	{
		//testing only
		return ($apiKey == 'test') ? true : false;
	}
	
	public function search($apiKey, $keywords)
	{
		if(!$this->_validateKey($apiKey)) { return array('error'=>'Invalid API Key', 'status'=>FALSE); }
		
		//fetch the index and run the search
		$query = Zend_Search_Lucene_Search_QueryParser::parse($keywords);
		$index = Zend_Search_Lucene::open(APPLICATION_PATH."/indexes");
		$hits = $index->find($query);
		
		//build response array
		if(is_array($hits) && count($hits) > 0)
		{
			$response['hits'] = count($hits);
			foreach($hits as $page)
			{
				$pageObj = new CMS_Content_Item_Page($page->page_id);
				$response['results']['page_'.$page->page_id] = $pageObj->toArray();
			}
		}
		else 
		{
			$response['hits'] = 0;
		}
		
		return $response;
	}
	
	public function createPage($apiKey, $name, $headline, $description, $content)
	{
		if(!$this->_validateKey($apiKey)) { return array('error'=>'Invalid API Key', 'status'=>FALSE); }
		
		//create new page
		$itemPage = new CMS_Content_Item_Page();
		$itemPage->name = $name;
		$itemPage->headline = $headline;
		$itemPage->description = $description;
		$itemPage->content = $content;
		$itemPage->save();
		return $itemPage->toArray();
	}
	
	public function editPage($apiKey, $id, $name, $headline, $description, $content)
	{
		if(!$this->_validateKey($apiKey)) { return array('error'=>'Invalid API Key', 'status'=>FALSE); }
		
		//open the page
		$itemPage = new CMS_Content_Item_Page($id);
		
		//update it
		$itemPage->name = $name;
		$itemPage->headline = $headline;
		$itemPage->description = $description;
		$itemPage->content = $content;
		$itemPage->save();
		return $itemPage->toArray();
	}
	
	public function deletePage($apiKey, $id)
	{
		if(!$this->_validateKey($apiKey)) { return array('error'=>'Invalid API Key', 'status'=>FALSE); }
		
		//open the page
		$itemPage = new CMS_Content_Item_Page($id);
		
		if($itemPage)
		{
			$itemPage->delete();
			return true;
		}
		return false;
	}
}
?>