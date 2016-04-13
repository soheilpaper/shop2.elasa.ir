<?php

class postabcateslider extends Module {
	private $spacer_size = '5';	
	private $_postErrors  = array();
	private $_html= null;
	public function __construct() {
		$this->name 		= 'postabcateslider';
		$this->tab 			= 'front_office_features';
		$this->version 		= '1.5';
		$this->author 		= 'posthemes';
		$this->displayName 	= $this->l('Pos Category Tabs Slider');
		$this->description 	= $this->l('Category Slider with multiple tabs');
		parent :: __construct();
       
	}
	
	public function install() {
	
	$arrayDefault = array('CAT3,CAT4.CAT5');
	$cateDefault = implode(',',$arrayDefault);
	Configuration::updateGlobalValue($this->name . '_list_cate',$cateDefault);

		return parent :: install()
			&& $this->registerHook('blockPosition3')
			&& $this->registerHook('header')
			&& $this->registerHook('actionOrderStatusPostUpdate')
			&& $this->registerHook('addproduct')
			&& $this->registerHook('updateproduct')
			&& $this->registerHook('deleteproduct');
	}

      public function uninstall() {
		Configuration::deleteByName($this->name . '_list_cate');
        $this->_clearCache('postabcateslider.tpl');
        return parent::uninstall();
    }

  
	public function psversion() {
		$version=_PS_VERSION_;
		$exp=$explode=explode(".",$version);
		return $exp[1];
	}
    
    
    public function hookHeader($params){
            $this->context->controller->addCSS(($this->_path).'postabcateslider.css', 'all');
    }
    
    
    // Hook Home
	public function hookBlockPosition3($params) {
		    $arrayCategory = array();
			$catSelected = Configuration::get($this->name . '_list_cate');
			$cateArray = explode(',', $catSelected); 
			$id_lang =(int) Context::getContext()->language->id;
			$id_shop = (int) Context::getContext()->shop->id;
			$arrayProductCate = array();
			foreach($cateArray as $id_category) {
				$id_category = str_replace('CAT','',$id_category);
				$category = new Category((int) $id_category, (int) $id_lang, (int) $id_shop);
				$categoryProducts = $category->getProducts($this->context->language->id, 0, ($nb ? $nb : 25));
				if($categoryProducts) {
					$arrayProductCate[] = array('id' => $id_category, 'name'=> $category->name, 'product' => $categoryProducts);
				}
			}

            $this->smarty->assign(array(
				'productCates' => $arrayProductCate,
                'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
                'homeSize' => Image::getSize(ImageType::getFormatedName('home')),
				
            ));
		return $this->display(__FILE__, 'postabcateslider.tpl');
	}

	  public function getContent() {
        $output = '<h2>' . $this->displayName . '</h2>';
        if (Tools::isSubmit('submitPosTabCate')) {
            if (!sizeof($this->_postErrors))
                $this->_postProcess();
            else {
                foreach ($this->_postErrors AS $err) {
                    $this->_html .= '<div class="alert error">' . $err . '</div>';
                }
            }
        }
        return $output . $this->_displayForm();
    }

    public function getSelectOptionsHtml($options = NULL, $name = NULL, $selected = NULL) {
        $html = "";
        $html .='<select name =' . $name . ' style="width:130px">';
        if (count($options) > 0) {
            foreach ($options as $key => $val) {
                if (trim($key) == trim($selected)) {
                    $html .='<option value=' . $key . ' selected="selected">' . $val . '</option>';
                } else {
                    $html .='<option value=' . $key . '>' . $val . '</option>';
                }
            }
        }
        $html .= '</select>';
        return $html;
    }

    private function _postProcess() {
	
        Configuration::updateValue($this->name . '_list_cate', implode(',', Tools::getValue('list_cate')));

        $this->_html .= '<div class="conf confirm">' . $this->l('Settings updated') . '</div>';
    }
	
	private function _displayForm(){ 
		$spacer = str_repeat('&nbsp;', $this->spacer_size);
	
         $this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
                  <fieldset>';
					
					$this->_html .= '<label>' . $this->l('Show Link/Label Category: ') . '</label>';
					$this->_html .= '<div class="margin-form">';
					$this->_html .= '<select multiple="multiple" name ="list_cate[]" style="width: 200px; height: 160px;">';
					// BEGIN Categories
					$id_lang = (int) Context::getContext()->language->id;
					$this->getCategoryOption(1, (int) $id_lang, (int) Shop::getContextShopID());
					$this->_html .= '</select>
					</div>';
					$this->_html .='
                    <input type="submit" name="submitPosTabCate" value="'.$this->l('Update').'" class="button" />
                     </fieldset>
		</form>';
		return $this->_html;
	}
	
	
     private function getCategoryOption($id_category = 1, $id_lang = false, $id_shop = false, $recursive = true) {
		$cateCurrent = Configuration::get($this->name . '_list_cate');		
		$cateCurrent = explode(',', $cateCurrent);
		$id_lang = $id_lang ? (int)$id_lang : (int)Context::getContext()->language->id;
		$category = new Category((int)$id_category, (int)$id_lang, (int)$id_shop);

		if (is_null($category->id))
			return;

		if ($recursive)
		{
			$children = Category::getChildren((int)$id_category, (int)$id_lang, true, (int)$id_shop);
			$spacer = str_repeat('&nbsp;', $this->spacer_size * (int)$category->level_depth);
		}
		
		$shop = (object) Shop::getShop((int)$category->getShopID());
		        if (in_array('CAT'.(int)$category->id, $cateCurrent)) {
					$this->_html .= '<option value="CAT'.(int)$category->id.'" selected ="selected" >'.(isset($spacer) ? $spacer : '').$category->name.' ('.$shop->name.')</option>';
				} else {
					$this->_html .= '<option value="CAT'.(int)$category->id.'">'.(isset($spacer) ? $spacer : '').$category->name.' ('.$shop->name.')</option>';
				}

		if (isset($children) && count($children))
			foreach ($children as $child)
				$this->getCategoryOption((int)$child['id_category'], (int)$id_lang, (int)$child['id_shop']);
    }

   
	
}