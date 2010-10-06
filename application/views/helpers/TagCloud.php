<?php
class Zend_View_Helper_TagCloud extends Zend_View_Helper_Abstract
{
	public function tagCloud($page_id=0)
	{
		$model = new Model_Tag();
		return $model->getTagCloud($page_id);
	}
}
?>