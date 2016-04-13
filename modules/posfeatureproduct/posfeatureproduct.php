<?php

if (!defined('_PS_VERSION_'))
    exit;

class Posfeatureproduct extends Module {

    private $_html = '';
    private $_postErrors = array();

    function __construct() {
        $this->name = 'posfeatureproduct';
        $this->tab = 'front_office_features';
        $this->version = '1.1';
        $this->author = 'Posthemes';
        $this->need_instance = 0;
        $this->ps_versions_compliancy = array('min' => '1.5', 'max' => '1.6');
        parent::__construct();

        $this->displayName = $this->l('Pos Featured products on homepage.');
        $this->description = $this->l('Displays featured products in any where of your homepage.');
    }

    function install() {
        $this->_clearCache('posfeatureproduct.tpl');
        Configuration::updateValue('POSFEATUREPRODUCT', 20);
        Configuration::updateValue($this->name . '_qty_products', 20);

        if (!parent::install()
                || !$this->registerHook('header')
                || !$this->registerHook('BlockPosition3')
                || !$this->registerHook('addproduct')
                || !$this->registerHook('updateproduct')
                || !$this->registerHook('deleteproduct')
        )
            return false;
        return true;
    }

    public function uninstall() {
        Configuration::deleteByName($this->name . '_qty_products');
        $this->_clearCache('posfeatureproduct.tpl');
        return parent::uninstall();
    }

    public function getContent() {
        $output = '<h2>' . $this->displayName . '</h2>';
        if (Tools::isSubmit('submitPostFeaturedProduct')) {
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

    private function _postProcess() {
        Configuration::updateValue($this->name . '_qty_products', Tools::getValue('qty_products'));
        $this->_html .= '<div class="conf confirm">' . $this->l('Settings updated') . '</div>';
    }

    private function _displayForm() {
        $this->_html .= '
		<form action="' . $_SERVER['REQUEST_URI'] . '" method="post">
                  <fieldset>
                    <legend><img src="../img/admin/cog.gif" alt="" class="middle" />' . $this->l('Settings') . '</legend>';
        $this->_html .='<label>' . $this->l('Qty of Products: ') . '</label>
                    <div class="margin-form">
                            <input type = "text"  name="qty_products" value =' . (Tools::getValue('qty_products') ? Tools::getValue('qty_products') : Configuration::get($this->name . '_qty_products')) . ' ></input>
                    </div>
                    
                    <input type="submit" name="submitPostFeaturedProduct" value="' . $this->l('Update') . '" class="button" />
                     </fieldset>
		</form>';
        return $this->_html;
    }

    public function hookDisplayHeader($params) {
        $this->hookHeader($params);
    }

    public function hookHeader($params) {
			$this->context->controller->addCSS(($this->_path) . 'posfeatureproduct.css', 'all');
    }

    public function getSlideshowHtml() {

            $category = new Category(Context::getContext()->shop->getCategory(), (int) Context::getContext()->language->id);
            $nb = (int) Configuration::get($this->name . '_qty_products');
            $products = $category->getProducts((int) Context::getContext()->language->id, 1, ($nb ? $nb : 8));
            if(!$products) return ;
            $this->smarty->assign(array(
                'products' => $products,
                'add_prod_display' => Configuration::get('PS_ATTRIBUTE_CATEGORY_DISPLAY'),
                'homeSize' => Image::getSize(ImageType::getFormatedName('home'))
            ));
        return $this->display(__FILE__, 'posfeatureproduct.tpl', $this->getCacheId('posfeatureproduct'));
    }

    public function hookBlockPosition3($params) {
        return $this->getSlideshowHtml();
    }
    public function hookblockPosition1($params) {
        return $this->getSlideshowHtml();
    }
	
	public function hookblockPosition2($params) {
        return $this->getSlideshowHtml();
    }
	
	public function hookproductExtraRight($params) {
        return $this->getSlideshowHtml();
    }

    public function hookAddProduct($params) {
        $this->_clearCache('posfeatureproduct.tpl');
    }

    public function hookUpdateProduct($params) {
        $this->_clearCache('posfeatureproduct.tpl');
    }

    public function hookDeleteProduct($params) {
        $this->_clearCache('posfeatureproduct.tpl');
    }

}
