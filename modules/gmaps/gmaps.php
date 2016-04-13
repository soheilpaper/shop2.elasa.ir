<?php

if (!defined('_PS_VERSION_'))
	exit;

class Gmaps extends Module
{
	public function __construct()
	{
		$this->name = 'gmaps';
		if (_PS_VERSION_ < '1.4.0.0')

			$this->tab = 'Blocks';
		if (_PS_VERSION_ > '1.4.0.0' && _PS_VERSION_ < '1.5.0.0')

			$this->tab = 'front_office_features';

		if (_PS_VERSION_ > '1.5.0.0')

			$this->tab = 'front_office_features';

		if (_PS_VERSION_ > '1.6.0.0')

			$this->bootstrap = true;
		$this->version       = 1.0;
		$this->author        = 'RSI Sistemas';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('Gmaps');
		$this->description = $this->l('Show google maps');
		if (_PS_VERSION_ < '1.5')
			require(_PS_MODULE_DIR_.$this->name.'/backward_compatibility/backward.php');
	}

	public function install()
	{
		if (!parent::install() || !$this->registerHook('header') || !$this->registerHook('footer'))
			return false;

		if (!Configuration::updateValue('GMAPS_NBR', 200))
			return false;
		if (!Configuration::updateValue('GMAPS_MIN', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12150.410249667982!2d-3.7197912368977804!3d40.4176544821718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sMadrid!5e0!3m2!1ses-419!2s!4v1404076754054'))
			return false;
		if (!Configuration::updateValue('GMAPS_MAX', '200'))
			return false;

		return true;
	}

	public function postProcess()
	{
		$errors = '';
		if (Tools::isSubmit('submitGmaps'))
		{
			if ($nbr = Tools::getValue('nbr'))
				Configuration::updateValue('GMAPS_NBR', $nbr);
			elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP)
				Configuration::deleteFromContext('GMAPS_NBR');

			if ($min = Tools::getValue('min'))
				Configuration::updateValue('GMAPS_MIN', $min);
			elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP)
				Configuration::deleteFromContext('GMAPS_MIN');
				
			if ($max = Tools::getValue('max'))
				Configuration::updateValue('GMAPS_MAX', $max);
			elseif (Shop::getContext() == Shop::CONTEXT_SHOP || Shop::getContext() == Shop::CONTEXT_GROUP)
				Configuration::deleteFromContext('GMAPS_MAX');


			// Reset the module properties
			//	$this->initialize();


			if (!$errors)
				Tools::redirectAdmin(AdminController::$currentIndex.'&configure='.$this->name.'&token='.Tools::getAdminTokenLite('AdminModules').'&conf=6');
			echo $this->displayError($errors);
		}

	}

	public function getConfigFieldsValues()
	{
		return array(
			'nbr'     => Tools::getValue('nbr', Configuration::get('GMAPS_NBR')),
			'min'        => Tools::getValue('min', Configuration::get('GMAPS_MIN')),
			'max'       => Tools::getValue('max', Configuration::get('GMAPS_MAX')),
			
		);
	}

	public function renderForm()
	{
		$this->postProcess();

		$options1 = array(
			array(
				'id_option' => 'col-sm-4',
				// The value of the 'value' attribute of the <option> tag.
				'name'      => 'col-sm-4'
				// The value of the text content of the  <option> tag.
			),
			array(
				'id_option' => 'col-sm-2',
				'name'      => 'col-sm-2'
			),
			array(
				'id_option' => 'col-sm-6',
				'name'      => 'col-sm-6'
			),
			array(
				'id_option' => 'col-xs-2',
				'name'      => 'col-xs-2'
			),

		);
		$fields_form = array(
			'form' => array(
				'legend' => array(
					'title' => $this->l('Configuration'),
					'icon'  => 'icon-cogs'
				),
				'input'  => array(
					array(
						'type'  => 'textarea',
						'label' => $this->l('Maps code'),
						'name'  => 'min',
						'desc'  => $this->l('Like https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d12150.410249667982!2d-3.7197912368977804!3d40.4176544821718!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd422997800a3c81%3A0xc436dec1618c2269!2sMadrid!5e0!3m2!1ses-419!2s!4v1404076754054'),


					),
						array(
						'type'    => 'select',
						'label'   => $this->l('Format'),
						'name'    => 'max',
						'desc'    => $this->l('Set the with of the module with the format'),
						'options' => array(
							'query' => $options1,
							'id'    => 'id_option',
							'name'  => 'name'
						)
					),
					array(
						'type'  => 'text',
						'label' => $this->l('Height'),
						'name'  => 'nbr',
						'desc'  => $this->l('Set the height like 100% or 100px. or set to auto'),

					),
				


				),
				'submit' => array(
					'title' => $this->l('Save'),
				)
			),
		);

		$helper                           = new HelperForm();
		$helper->show_toolbar             = false;
		$helper->table                    = $this->table;
		$lang                             = new Language((int)Configuration::get('PS_LANG_DEFAULT'));
		$helper->default_form_language    = $lang->id;
		$helper->allow_employee_form_lang = Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') ? Configuration::get('PS_BO_ALLOW_EMPLOYEE_FORM_LANG') : 0;
		$this->fields_form                = array();
		$helper->identifier               = $this->identifier;
		$helper->submit_action            = 'submitGmaps';
		$helper->currentIndex             = $this->context->link->getAdminLink('AdminModules', false).'&configure='.$this->name.'&tab_module='.$this->tab.'&module_name='.$this->name;
		$helper->token                    = Tools::getAdminTokenLite('AdminModules');
		$helper->tpl_vars                 = array(
			'fields_value' => $this->getConfigFieldsValues(),
			'languages'    => $this->context->controller->getLanguages(),
			'id_language'  => $this->context->language->id
		);

		return $helper->generateForm(array($fields_form));
	}

	
	public function getContent()
	{
		$errors = '';
		if (_PS_VERSION_ < '1.6.0.0')
		{
			$output = '<h2>'.$this->displayName.'</h2>';
			if (Tools::isSubmit('submitGmaps'))
			{
			
					$nbr        = Tools::getValue('nbr');
					$min       = Tools::getValue('min');
					$max      = Tools::getValue('max');
		
					Configuration::updateValue('GMAPS_NBR', $nbr);
					Configuration::updateValue('GMAPS_MIN', $min);
					Configuration::updateValue('GMAPS_MAX', $max);
	
				

					$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l('Settings updated').'</div>';
				
			}
			return $output.$this->displayForm();
		}
		else
		return $this->postProcess().$this->_displayInfo().$this->renderForm().$this->_displayAdds();
	}

	private function _displayInfo()
	{
		return $this->display(__FILE__, 'views/templates/hook/infos.tpl');
	}

	private function _displayAdds()
	{
		return $this->display(__FILE__, 'views/templates/hook/adds.tpl');
	}

	public function displayForm()
	{
		$output = '
			<link rel="stylesheet" href="../modules/gmaps/css/colorpicker.css" type="text/css" />
	
		<script type="text/javascript" src="../modules/gmaps/js/colorpicker.js"></script>
		<script type="text/javascript" src="../modules/gmaps/js/eye.js"></script>
		<script type="text/javascript" src="../modules/gmaps/js/utils.js"></script>
		<script type="text/javascript" src="../modules/gmaps/js/layout.js?ver=1.0.2"></script>
		<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Maps code').'</label>
				<div class="margin-form">
					<textarea name="min" cols="15" rows="5" >'.(Configuration::get('GMAPS_MIN')).'</textarea>
					
				</div>
				<label>'.$this->l('Height').'</label>
				<div class="margin-form">
					<input type="text" name="nbr" value="'.(Configuration::get('GMAPS_NBR')).'" />
									<p>'.$this->l('Set the height like 100% or 100px. or set to auto').'</p>

				</div>
				<label>'.$this->l('Format').'</label>
				<div class="margin-form">
					<input type="text" name="max" value="'.(Configuration::get('GMAPS_MAX')).'" />
					<p>'.$this->l('Set the with of the module').'</p>

				</div>
				
				<center><input type="submit" name="submitGmaps" value="'.$this->l('Save').'" class="button" /></center><br/>
				<p>'.$this->l('To get the google maps code, go to google maps, and search the location. and click on share / insert, and select insert. You only need to put the code of the url http, not the full iframe.You can transplant the module to home or columns too').'</p><br/>
						<center><a href="../modules/gmaps/moduleinstall.pdf">README</a></center><br/>
						<center><a href="../modules/gmaps/termsandconditions.pdf">TERMS</a></center><br/>
			</fieldset>
		</form>
	<object type="text/html" data="http://catalogo-onlinersi.net/modules/productsanywhere/images.php?idproduct=&desc=yes&buy=yes&type=home_default&price=yes&style=false&color=10&color2=40&bg=ffffff&width=800&height=310&lc=000000&speed=5&qty=15&skip=29,14,42,44,45&sort=1" width="800" height="310" style="border:0px #066 solid;"></object>
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Contribute').'</legend>
				<p class="clear">'.$this->l('You can contribute with a donation if our free modules and themes are usefull for you. Clic on the link and support us!').'</p>
				<p class="clear">'.$this->l('For more modules & themes visit: www.catalogo-onlinersi.com.ar').'</p>
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="HMBZNQAHN9UMJ">
<input type="image" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/WEBSCR-640-20110401-1/en_US/i/scr/pixel.gif" width="1" height="1">
	</fieldset>
</form>';
		return $output;
	}


public function hookFooter($params)
	{
					$nbr = Configuration::get('GMAPS_NBR');
					$min = Configuration::get('GMAPS_MIN');
					$max = Configuration::get('GMAPS_MAX');
$this->context->smarty->assign(array(
			'nbr'      => $nbr,
			'min'    => $min,
			'max'      => $max,
			'psversion'      => _PS_VERSION_,
		
		));
	return $this->display(__FILE__, 'views/templates/front/gmaps-footer.tpl');

	}
	public function hookRightColumn($params)
	{
					$nbr = Configuration::get('GMAPS_NBR');
					$min = Configuration::get('GMAPS_MIN');
					$max = Configuration::get('GMAPS_MAX');

$this->context->smarty->assign(array(
			'nbr'      => $nbr,
			'min'    => $min,
			'max'      => $max,
			'psversion'      => _PS_VERSION_,
		
		));
	return $this->display(__FILE__, 'views/templates/front/gmaps-header.tpl');

	}

		public function hookLeftColumn($params)
		{
			return $this->hookRightColumn($params);
		}
	public function hookHome($params)
	{
					$nbr = Configuration::get('GMAPS_NBR');
					$min = Configuration::get('GMAPS_MIN');
					$max = Configuration::get('GMAPS_MAX');
		
	
$this->context->smarty->assign(array(
			'nbr'      => $nbr,
			'min'    => $min,
			'max'      => $max,
			'psversion'      => _PS_VERSION_,
		
		));
	return $this->display(__FILE__, 'views/templates/front/gmaps-home.tpl');

	}
		public function hookHeader($params)
	{
		if (_PS_VERSION_ > '1.4.0.0' && _PS_VERSION_ < '1.5.0.0')
		
			Tools::addCSS(__PS_BASE_URI__.'modules/gmaps/css/gmaps.css', 'all');
		
		if (_PS_VERSION_ > '1.5.0.0' && _PS_VERSION_ < '1.6.0.0')

			$this->context->controller->addCSS(($this->_path).'css/gmaps.css', 'all');

		
	}
}
