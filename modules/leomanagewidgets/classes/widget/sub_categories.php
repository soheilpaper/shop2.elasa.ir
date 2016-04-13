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

class LeoWidgetSub_categories extends LeoWidgetBase {
	public $name = 'sub_categories';
	public $for_module = 'all';
	
	public function getWidgetInfo(){
		return  array('label' => $this->l('Sub Categories In Parent'), 'explain' => 'Show List Of Categories Links Of Parent' );
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
			'category_id'=> '',
		);
		$setting = array_merge( $t, $setting );

		$category = new Category($setting['category_id'], $this->langID );
		$subCategories = $category->getSubCategories( $this->langID );	
 		$setting['title'] = $category->name;	


 		$setting['subcategories'] = $subCategories;
		$output = array('type'=>'sub_categories','data' => $setting );

		return $output;
	}
}
?>