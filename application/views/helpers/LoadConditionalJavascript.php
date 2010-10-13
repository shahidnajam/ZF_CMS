<?php
class Zend_View_Helper_LoadConditionalJavascript extends Zend_View_Helper_Abstract 
{
	/**
	 * loads TinyMCE Config
	 *
	 * @param string $skin
	 */
	public function LoadConditionalJavascript($flags=array())
	{
		if(in_array('tinymce', $flags))
		{
			$this->view->headScript()->offsetSetFile(98,'/_js/tiny_mce/jquery.tinymce.js');
			$this->view->headScript()->offsetSetFile(99,'/_js/tiny_mce/plugins/tinybrowser/tb_tinymce.js.php');
			$this->view->headScript()->offsetSetFile(100,'/_js/tinyMceConfig.js');
		}
        else
        {
            $this->view->headScript()->offsetSetFile(100,'/_js/jquery.beautyOfCode.js');
        }
		if(in_array('tagCloud', $flags))
		{
			$this->view->headScript()->offsetSetFile(101,'/_js/tagCloudForm.js');
		}
		return $this->view->headScript();
	}
}
?>