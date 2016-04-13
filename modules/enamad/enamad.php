<?php
/**
 * @module		Enamad Module
 * @author		Shervin Matrix - Www.MatrixSoft.Ir
  *@published   Www.PrestaTools.Ir
**/
class enamad extends Module
{
    public function __construct()
    {
        $this->name = 'enamad';
        $this->tab = 'payment_security';
        $this->version = 1.0;
		$this->author = 'MatrixSoft';

        parent::__construct();
		$this->page = basename(__FILE__, '.php');
        $this->displayName = $this->l('Enamad Module');
        $this->description = $this->l('A free module to show e-namad trust seal.');
    	$this->confirmUninstall = $this->l('Are you sure, you want to delete your details?');

	}
   	public function install(){
		if (!parent::install())
			return false;
		if (!$this->registerHook('leftColumn') OR !$this->registerHook('rightColumn'))
			return false;
		return true;
	}
	public function uninstall(){
		if (!parent::uninstall())
			return false;
			Configuration::updateValue('Enamad_hook', Tools::getValue('hook'));
		return true;
	}

	public function displayFormSettings()
	{
		$this->_html .= '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset>
				<legend><img src="../img/admin/cog.gif" alt="" class="middle" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Which column do you want to show e-namad?').'</label>
				<input type="radio" name="hook" value="left" '.((Configuration::get('Enamad_hook') == 'left') ? "checked = 'checked'" : "").'>'.$this->l('Left').'</input>
				<input type="radio" name="hook" value="right" '.((Configuration::get('Enamad_hook') == 'right') ? "checked = 'checked'" : "").'>'.$this->l('Right').'</input>
				<center><input type="submit" name="submitenamad" value="'.$this->l('Update Settings').'" class="button" /></center>	
                <center><label>'.$this->l('Design & Setting By ').'<a href="www.prestatools.ir">Www.PrestaTools.Ir</a></label></center>
			</fieldset>
		</form>';
	}

	public function displayConf()
	{
		$this->_html .= '
		<div class="conf confirm">
			<img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />
			'.$this->l('Settings updated').'
		</div>';
	}
       	public function getContent()
	{
		$this->_html = '<h2>'.$this->l('Enamad Module').'</h2>';
		if(Tools::getValue('hook'))
		{ 
                Configuration::updateValue('Enamad_hook', Tools::getValue('hook'));
				$this->displayConf();
		}

		$this->displayFormSettings();
		return $this->_html;
	}

	public function hookLeftColumn()
	{
		if (Configuration::get('Enamad_hook') == 'left')
		return $this->display(__FILE__, 'enamad.tpl');
	}

	public function hookRightColumn()
	{
		if (Configuration::get('Enamad_hook') == 'right')
		return $this->display(__FILE__, 'enamad.tpl');
	}

}
/**
 * @module		Enamad Module
 * @author		Shervin Matrix - Www.MatrixSoft.Ir
  *@published   Www.PrestaTools.Ir
**/
?>
