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

class LeoWidgetLinks extends LeoWidgetBase {

		public $name = 'link';
		public $for_module = 'all';
		
		public function getWidgetInfo(){
			return array('label' => $this->l('Block Links'), 'explain' => 'Create List Block Links' ) ;
		}


		public function renderForm( $args, $data ){

			$helper = $this->getFormHelper();

			$this->fields_form[1]['form'] = array(
	            'legend' => array(
	                'title' => $this->l('Widget Form.'),
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

 
		 	$default_lang = (int)Configuration::get('PS_LANG_DEFAULT');
			
			$helper->tpl_vars = array(
	                'fields_value' => $this->getConfigFieldsValues( $data  ),
	                'languages' => Context::getContext()->controller->getLanguages(),
	                'id_language' => $default_lang
        	);  
			return  $helper->generateForm( $this->fields_form );
		}
		
		public function renderContent(  $args, $setting ){
			
			$t  = array(
				'name'=> '',
				'html'   => '',
			);

			$setting = array_merge( $t, $setting );

	 		$ac = array();
	 		$languageID = Context::getContext()->language->id;

	 		for( $i=1; $i<=10; $i++ ){
	 			if( isset($setting['link_'.$i]) && trim($setting['link_'.$i]) )  { 
	 				$link = isset($setting['text_link_'.$i.'_'.$languageID])?html_entity_decode($setting['text_link_'.$i.'_'.$languageID],ENT_QUOTES,'UTF-8'): "No Link Title";

	 				$ac[] = array( 'text'=>$link, 'link' => trim($setting['link_'.$i]) );
	 			}
	 		}
 			
	 		$setting['id'] = rand();
	 	 	$setting['links'] = $ac; 
	 
			$output = array('type'=>'links','data' => $setting );

	  		return $output;
		}
		 
	}
?>