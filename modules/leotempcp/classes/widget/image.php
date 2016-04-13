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

class LeoWidgetImage extends LeoWidgetBase {

		public $name = 'image';
		public $for_module = 'all';
		
		public function getWidgetInfo(){
			return array('label' => $this->l('Images Gallery Folder'), 'explain' => 'Create Images Mini Gallery From Folder' );
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
				'image_folder_path'   => '',
				'limit'	=> 12,
				'columns'=> 4,
			);

			$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	        $url = Tools::htmlentitiesutf8($protocol . $_SERVER['HTTP_HOST'] . __PS_BASE_URI__) ;


			$setting = array_merge( $t, $setting );
			$oimages  = array();
			if( $setting['image_folder_path'] ){
				$path = _PS_ROOT_DIR_.'/'.trim($setting['image_folder_path']).'/';
				$path = str_replace( "//", "/", $path );
				if( is_dir($path) ){
					$images = glob( $path.'*.*' );
					$exts = array('jpg','gif','png');
					
					foreach( $images as $cnt => $image ){
						$ext = Tools::substr( $image, Tools::strlen($image)-3, Tools::strlen($image) );

						if( in_array( strtolower($ext), $exts) ){
							
							if( $cnt < (int)$setting['limit'] ) {
								$i = str_replace( "\\",  "/" , ''.$setting['image_folder_path']."/".basename($image) );
								$i = str_replace( "//", "/", $i );
							 
								$oimages[] = $url.$i;
							}
						}
					}
				}
				 
			}

			$images= array();
			$setting['images'] = $oimages;
			$output = array('type'=>'image','data' => $setting );
	  		return $output;
		}
		

	}
?>