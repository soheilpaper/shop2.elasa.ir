<?php
if (!defined('_PS_VERSION_'))
	exit;

class googlemaps extends Module
{
	public function __construct()
	{
		$this->name = 'googlemaps';
		$this->tab = 'advertising_marketing';
		$this->version = '1';
		$this->author = 'SmartProjects.pl';
		$this->need_instance = 0;

		parent::__construct();

		$this->displayName = $this->l('Google Maps by SmartProjects.pl');
		$this->description = $this->l('Show your localization on Google Map (Add on to the Contact Form page)');
	}

	public function install()
	    {
			if ($this->addhookContactFormHook() && parent::install() && $this->registerHook('header') && $this->registerHook('ContactForm')){
				return true;
			}else{
				return false;
			}
		}
		
		public function getContent()
		{
			$output = '<h2>'.$this->displayName.'</h2>';
			if (Tools::isSubmit('submitSpecials'))
			{
				Configuration::updateValue('PS_GOOGLEMAP_ADDRESS', (Tools::getValue('googlemap_address')));
				Configuration::updateValue('PS_GOOGLEMAP_KEY', (Tools::getValue('googlemap_key')));
				Configuration::updateValue('PS_GOOGLEMAP_ZOOM', (int)(Tools::getValue('googlemap_zoom')));
				
				$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l('Settings updated').'</div>';
			}
			return $output.$this->displayForm();
		}

		
		public function displayForm()
		{
			return '
			<form action="'.Tools::safeOutput($_SERVER['REQUEST_URI']).'" method="post">
			<fieldset>
			<legend>'.$this->l('Settings').'</legend>
			
			<p>
			'.$this->l('Type your address (be sure that your address is displayed directly on http://maps.google.com):').'<br/>
			<input type="text" name="googlemap_address" value="'.Tools::getValue('always_display', Configuration::get('PS_GOOGLEMAP_ADDRESS')).'" />
			</p>
			
			<p>
			<br/>'.$this->l('Enter Google Maps Key v3 for your domain:').'<br/>
			<input type="text" name="googlemap_key" value="'.Tools::getValue('always_display', Configuration::get('PS_GOOGLEMAP_KEY')).'" />
			</p>
			
			<p>
			'.$this->l('Map Zoom (values from 8 to 16):').'<br/>
			<input type="text" name="googlemap_zoom" value="'.Tools::getValue('always_display', Configuration::get('PS_GOOGLEMAP_ZOOM')).'" />
			</p>
			
			
			<center><input type="submit" name="submitSpecials" value="'.$this->l('Save').'" class="button" /></center>
			
			</fieldset>
			</form>';
		}
		
	public function uninstall()
		{
			return (parent::uninstall() AND $this->removehookContactformHook());
	}

	public function hookContactForm($params) 
	{
		return $this->display(__FILE__, 'googlemaps.tpl');
	}

	public function hookHeader($params)
	{
		
		global $smarty;
		
		$i = 1;
		
		$page[$i] = @file_get_contents("http://maps.google.com/maps/api/geocode/json?address=".urlencode(Tools::getValue('always_display', Configuration::get('PS_GOOGLEMAP_ADDRESS')))."&sensor=true");
		$ar[$i] = json_decode($page[$i],true);
		$c[$i][0]=$ar[$i]['results']['0']['geometry']['location']['lng'];
		$c[$i][1]=$ar[$i]['results']['0']['geometry']['location']['lat'];
		
		$cloud[$i] = Tools::getValue('always_display', Configuration::get('PS_GOOGLEMAP_ADDRESS'));
		$cloud[$i] = trim(preg_replace('/\s\s+/', ' ', $cloud[$i]));
		
		//TODO
		//$center = (trim($modx->getTemplateVarOutput(array('googlemap_center'),$modx->documentIdentifier,1,"",true)->{'googlemap_center'})=='') ? $c[1][1].','.$c[1][0] : trim($modx->getTemplateVarOutput(array('googlemap_center'),$modx->documentIdentifier,1,"",true)->{'googlemap_center'});
		
		$center = $c[1][1].','.$c[1][0];
		
		$smarty->assign(array(
				'center' => $center,
				'cloud' => $cloud[$i],
				'googlemapkey' => Tools::getValue('always_display', Configuration::get('PS_GOOGLEMAP_KEY')),
				'zoom' => Tools::getValue('always_display', Configuration::get('PS_GOOGLEMAP_ZOOM'))
				));
		
		return $this->display(__FILE__, 'googlemaps_head.tpl');
	}
	
	private function addhookContactformHook()
	{
		return Db::getInstance()->Execute('INSERT INTO `'._DB_PREFIX_.'hook` (`name`, `title`, `description`, `position`) VALUES (\'ContactForm\', \'Contact Form Block\', \'Display extra informations inside the "Contactform" block\', 1)');
	}
	
	private function removehookContactformHook()
	{
		return Db::getInstance()->Execute('DELETE FROM `'._DB_PREFIX_.'hook` WHERE `name` = \'ContactForm\'');
	}
	
}


