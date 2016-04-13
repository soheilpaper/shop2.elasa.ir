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

class LeoWidgetFacebook extends LeoWidgetBase {

		public $name = 'facebook';
		public $for_module = 'all';
		
		public function getWidgetInfo(){
			return array('label' => $this->l('Facebook'), 'explain' => 'Facebook Like Box' );
		}


		public function renderForm( $args, $data ){
			$helper = $this->getFormHelper();
		 	$soption = array(
	            array(
	                'id' => 'active_on',
	                'value' => 1,
	                'label' => $this->l('Enabled')
	            ),
	            array(
	                'id' => 'active_off',
	                'value' => 0,
	                'label' => $this->l('Disabled')
	            )
	        );




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
	                'fields_value' => $this->getConfigFieldsValues( $data ),
	                'languages' => Context::getContext()->controller->getLanguages(),
	                'id_language' => $default_lang
        	);  


			return  $helper->generateForm( $this->fields_form );
 

		}

		public function renderContent(  $args, $setting ){
			$t  = array(
				'name'=> '',
				'application_id'	=> '',
				'page_url'	=> 'https://www.facebook.com/LeoTheme',
				'border'	=> 0,
				'color'		=> 'light',
				'width'		=> 290,
				'height'	=> 200,
				'show_stream'	=> 0,
				'show_faces'	=> 1,
				'show_header'	=> 0,
				'displaylanguage'=> 'en'

			);
			$setting = array_merge( $t, $setting );
			  
			$output = array('type'=>'facebook','data' => $setting );
	  		return $output;
		}
	}
?>