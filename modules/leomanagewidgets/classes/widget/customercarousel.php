<?php 
/******************************************************
 *  Leo Prestashop Theme Framework for Prestashop 1.5.x
 *
 * @package   leotempcp
 * @version   3.0
 * @author    http://www.leotheme.com
 * @copyright Copyright (C) October 2013 LeoThemes.com <@emai:leotheme@gmail.com>
 *               <info@leotheme.com>.All rights reserved.
 * @license   GNU General Public License version 2
 * ******************************************************/

class LeoWidgetCustomerCarousel extends LeoWidgetBase {

		public $name = 'customercarousel';
		public $for_module  = 'manage';
		
		public function getWidgetInfo(){
			return array( 'label' => $this->l('Customer HTML Carousel'), 'explain' =>$this->l('Create Customer HTML Carousel'));
		}


		public function renderForm( $args, $data ){

			
			$helper = $this->getFormHelper();

			$this->fields_form[1]['form'] = array(
	            'legend' => array(
	                'title' => $this->l('Widget Form'),
	            ),
	            'input' => array(
	                array(
		                'type' => 'html',
		                'html_content' => 'Please access <a href="http://apollotheme.com/" target="_blank" title="apollo site">Apollotheme.com</a> to buy professional version to use this ',
		            ),
		            array(
		                'type' => 'html',
		                'html_content' => '<a target="_blank" href="http://apollotheme.com/how-to-buy-pro-version/" target="_blank" title="How to buy">How to buy Professional Version</a>',
		            ),
		            array(
		                'type' => 'html',
		                'html_content' => '<a target="_blank" href="http://apollotheme.com/different-between-free-pro-version/" target="_blank" title="Why should use">Why should use Professional Version</a>',
		            )
	            ),
                    'buttons' => array(
                        array(
                            'title' => $this->l('Save And Stay'),
                            'icon' => 'process-icon-save',
                            'class' => 'pull-right',
                            'type' => 'submit',
                            'name' => 'saveandstayleotempcp'
                        ),
                        array(
                            'title' => $this->l('Save'),
                            'icon' => 'process-icon-save',
                            'class' => 'pull-right',
                            'type' => 'submit',
                            'name' => 'saveleotempcp'
                        ),
                    )
	        );
			//$this->fields_form[1]['form']['input'][] = $tmpArray;
			
		 	$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
		
			$helper->tpl_vars = array(
	                'fields_value' => $this->getConfigFieldsValues( $data  ),
	                'languages' => Context::getContext()->controller->getLanguages(),
	                'id_language' => $default_lang
        	);  
        	// echo "<pre>";print_r($nbcusthtml);die;
			return  $helper->generateForm( $this->fields_form );

		}
		public function renderContent(  $args, $setting ){
	 		$header = '';
	 		$content = '';	

	 		$cs = array();
	 		$languageID = Context::getContext()->language->id;
	 		for( $i=1; $i<=$setting['nbcusthtml']; $i++ ){
	 			$title =  isset($setting['title_'.$i."_".$languageID])?$setting['title_'.$i."_".$languageID]: "";
	 			$header = isset($setting['header_'.$i."_".$languageID])?$setting['header_'.$i."_".$languageID]: "";
	 			
	 			if(!empty($header) && !empty($title)) {
	 				$content = isset($setting['content_'.$i."_".$languageID])?$setting['content_'.$i."_".$languageID]: "";
	 				$cs[] = array( 'title' => trim($title), 'header'=> trim($header), 'content' => trim($content) );
	 			}
	 		}
	 		if($setting['auto_play']){
				$setting['interval']	= 	(isset($setting['interval'])) ? (int)($setting['interval']) : 4000;
	 		}else{
	 			$setting['interval'] = "false";
	 		}
	 		$setting['startSlide'] = ($setting['startSlide']) ? $setting['startSlide'] : "0";
	 	 	$setting['customercarousel'] = $cs; 
	 	 	$setting['id']	 = rand()+count($cs);
			
			$output = array('type'=>'customercarousel','data' => $setting );
	  		return $output;
		}
		 
	}
?>