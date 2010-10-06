<?php
class Zend_View_Helper_LoadSkin extends Zend_View_Helper_Abstract 
{
	/**
	 * loads skins into the layout
	 *
	 * @param string $skin
	 */
	public function LoadSkin($skin)
	{
		//load the skin config file
		$skinData = new Zend_Config_Xml('./_skins/'.$skin.'/skin.xml');
		$stylesheets = $skinData->stylesheets->stylesheet->toArray();
		//append each stylesheet to the layout
		if(is_array($stylesheets))
		{
			foreach($stylesheets as $s)
			{
				$media = (strpos($s, 'print') === false) ? 'screen, projection' : 'print';
				
				if(strpos($s, 'ie.css') === false)
				{
					$this->view->headLink()->appendStylesheet('/_skins/'.$skin.'/_css/'.$s, $media);
				}
				else 
				{
					$this->view->headLink()->appendStylesheet('/_skins/'.$skin.'/_css/'.$s, $media, 'lt IE 8');
				}
			}
		}
		return $this->view->headLink();
	}
}
?>