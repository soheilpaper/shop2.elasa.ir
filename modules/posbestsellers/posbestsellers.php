<?php
if (!defined('_PS_VERSION_'))
	exit;

class posbestsellers extends Module
{
	protected static $cache_best_sellers;

	public function __construct()
	{
		$this->name = 'posbestsellers';
		$this->tab = 'front_office_features';
		$this->version = '1.6.2';
		$this->author = 'posthemes';
		$this->need_instance = 0;
		$this->bootstrap = true;

		parent::__construct();

		$this->displayName = $this->l('POS Top-sellers block');
		$this->description = $this->l('Adds a block displaying your store\'s top-selling products.');
		$this->ps_versions_compliancy = array('min' => '1.6', 'max' => _PS_VERSION_);
	}

	public function install()
	{
		$this->_clearCache('*');

		if (!parent::install()
			|| !$this->registerHook('header')
			|| !$this->registerHook('blockPosition3')
			|| !$this->registerHook('actionOrderStatusPostUpdate')
			|| !$this->registerHook('addproduct')
			|| !$this->registerHook('updateproduct')
			|| !$this->registerHook('deleteproduct')
			|| !ProductSale::fillProductSales()
		)
			return false;

		Configuration::updateValue('BESTSELLER_NBR', 20);

		return true;
	}

	public function uninstall()
	{
		$this->_clearCache('*');

		return parent::uninstall();
	}

	public function hookAddProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookUpdateProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookDeleteProduct($params)
	{
		$this->_clearCache('*');
	}

	public function hookActionOrderStatusPostUpdate($params)
	{
		$this->_clearCache('*');
	}

	public function _clearCache($template, $cache_id = null, $compile_id = null)
	{
		parent::_clearCache('posbestsellers.tpl', 'posbestsellers-col');
	}

	/**
	 * Called in administration -> module -> configure
	 */
	public function getContent()
	{
		$output = '';
		if (Tools::isSubmit('submitBestSellers'))
		{
			Configuration::updateValue('BESTSELLER_DPL', (int)Tools::getValue('BESTSELLER_DPL'));
			Configuration::updateValue('BESTSELLER_NBR', (int)Tools::getValue('BESTSELLER_NBR'));
			$this->_clearCache('*');
			$output .= $this->displayConfirmation($this->l('Settings updated'));
		}

		return $output.$this->renderForm();
	}

	public function renderForm()
	{
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Settings'),
					'icon' => 'icon-cogs'
				),
				'input' => array(
					array(
						'type' => 'text',
						'label' => $this->l('Products to display'),
						'name' => 'BESTSELLER_NBR',
						'desc' => $this->l('Determine the number of product to display in this block'),
						'class' => 'fixed-width-xs',
					),
					array(
						'type' => 'switch',
						'label' => $this->l('Always display this block'),
						'name' => 'BESTSELLER_DPL',
						'desc' => $this->l('Show the block even if no best sellers are available.'),
						'is_bool' => true,
						'values' => array(
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
						),
					)
				),
				'submit' => array(
					'title' => $this->l('Save')
				)
			)
		);

		$helper = new HelperForm();
		$helper->show_toolbar = false;
		$helper->table = $this->table;
		$lang = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form = array();

		$helper->identifier = $this->identifier;
		$helper->submit_action = 'submitBestSellers';
		$helper->currentIndex = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages' => $this->context->controller->getLanguages(),
			'id_language' => $this->context->language->id
		);

		return $helper->generateForm(array($fields_form));
	}

	public function getConfigFieldsValues()
	{
		return array(
			'BESTSELLER_NBR' => (int)Tools::getValue('BESTSELLER_NBR', Configuration::get('BESTSELLER_NBR')),
			'BESTSELLER_DPL' => (int)Tools::getValue('BESTSELLER_DPL', Configuration::get('BESTSELLER_DPL')),
		);
	}

	public function hookHeader($params)
	{
		if (Configuration::get('PS_CATALOG_MODE'))
			return;
		$this->context->controller->addCSS($this->_path.'posbestsellers.css', 'all');
	}

	public function hookblockPosition3($params)
	{
		if (!$this->isCached('posbestsellers.tpl', $this->getCacheId('posbestsellers-col')))
		{
			if (!isset(posbestsellers::$cache_best_sellers))
				posbestsellers::$cache_best_sellers = $this->getBestSellers($params);
			$this->smarty->assign(array(
				'best_sellers' => posbestsellers::$cache_best_sellers,
				'display_link_bestsellers' => Configuration::get('PS_DISPLAY_BEST_SELLERS'),
				'mediumSize' => Image::getSize(ImageType::getFormatedName('medium')),
				'smallSize' => Image::getSize(ImageType::getFormatedName('small'))
			));
		}
		
		if (posbestsellers::$cache_best_sellers === false)
			return false;

		return $this->display(__FILE__, 'posbestsellers.tpl', $this->getCacheId('posbestsellers-col'));
	}
	
	public function hookblockPosition2($params)
	{
		return $this->hookblockPosition3($params);
	}

	protected function getBestSellers($params)
	{
		if (Configuration::get('PS_CATALOG_MODE'))
			return false;

		if (!($result = ProductSale::getBestSalesLight((int)$params['cookie']->id_lang, 0, (int)Configuration::get('BESTSELLER_NBR'))))
			return (Configuration::get('BESTSELLER_DPL') ? array() : false);

		$currency = new Currency($params['cookie']->id_currency);
		$usetax = (Product::getTaxCalculationMethod((int)$this->context->customer->id) != PS_TAX_EXC);
		foreach ($result as &$row)
			$row['price'] = Tools::displayPrice(Product::getPriceStatic((int)$row['id_product'], $usetax), $currency);

		return $result;
	}
}
