<?php

/*
 * $Date: 2015/02/09 22:05:52 $
 * Written by Kjeld Borch Egevang
 * E-mail: kjeld@mail4us.dk
 */


class TabTranslate extends Module
{
  public function __construct()
  {
    $this->v13 = _PS_VERSION_ >= "1.3.0.0";
    $this->v14 = _PS_VERSION_ >= "1.4.0.0";
    $this->v15 = _PS_VERSION_ >= "1.5.0.0";
    $this->v16 = _PS_VERSION_ >= "1.6.0.0";
    $this->later = _PS_VERSION_ >= "1.7.0.0";
    $this->name = 'tabtranslate';
    if ($this->v14)
      $this->tab = 'administration';
    else
      $this->tab = 'Admin';
    $this->author = 'Kjeld Borch Egevang';
    $this->version = '1.03';

    parent::__construct();

    $this->page = basename(__FILE__, '.php');
    $this->displayName = $this->l('Tab translation');
    $this->description = $this->l('Translate tab texts and a few other texts in the database');
  }

  public function install()
  {
    return parent::install();
  }

  public function uninstall()
  {
    return parent::uninstall();
  }

  public function getContent()
  {
    $this->_html = '<h2>'.$this->l('Tab translate').'</h2>';

    $this->displayTabTranslate();
    $this->displayFormSettings();
    return $this->_html;
  }

  public function l($string, $specific = false)
  {
    if ($specific == true)
      return $string;
    else
      return Module::l($string, $specific);
  }

  public function translateString($string, $id_lang)
  {
    global $_MODULES, $_MODULE;

    $file = _PS_MODULE_DIR_.$this->name.'/'.Language::getIsoById($id_lang).'.php';
    if (Tools::file_exists_cache($file) AND include_once($file))
      $_MODULES = !empty($_MODULES) ? array_merge($_MODULES, $_MODULE) : $_MODULE;

    if (!is_array($_MODULES))
      return (str_replace('"', '&quot;', $string));

    $source = Tools::strtolower(get_class($this));
    $string = str_replace('\\', '\\\\', $string);
    $currentKey = '<{'.$this->name.'}'._THEME_NAME_.'>'.$source.'_'.md5($string);
    $defaultKey = '<{'.$this->name.'}prestashop>'.$source.'_'.md5($string);

    if (key_exists($currentKey, $_MODULES))
      $ret = $_MODULES[$currentKey];
    elseif (key_exists($defaultKey, $_MODULES))
      $ret = $_MODULES[$defaultKey];
    else
      return NULL;
    $ret = str_replace('[nl]', "\r\n", $ret);
    $ret = stripslashes($ret);
    return $ret;
  }

  public function displayTabTranslate()
  {
    $this->_html .= '
      <img src="../modules/tabtranslate/logo.gif" style="float:left; margin-right:15px;" />
      <b>'.
      $this->l('This module can translate tab texts and a few other texts in the database.').
      '</b><br /><br /><br />';
  }

  public function displayFormSettings()
  {
    if (Tools::isSubmit('submitTabTranslate')) {
      $errors = array();
      self::translate();
      $this->_html .= '
	<br />
	<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
	<input type="submit" name="submitTabConfig" value="'.
	$this->l('Back').'" class="button" />
	</fieldset>
	</form><br /><br />';
      return;
    }

    if ($this->later) {
      $this->_html .= '
	<div class="error">'.
	$this->l('Version').' '._PS_VERSION_.' '.$this->l('not supported').'
	</div>';
      return;
    }
    $this->_html .= '
      <form action="'.$_SERVER['REQUEST_URI'].'" method="post">
      <fieldset>
      <legend><img src="../modules/tabtranslate/logo.gif" />'.$this->l('Available languages').'</legend>';
    $langs = Language::getLanguages();
    $this->_html .= '<table class="table">';
    foreach ($langs as $lang) {
      if ($lang['active']) {
	$this->_html .= '
	  <tr>
	  <td><input type="checkbox" name="lang_'.$lang['id_lang'].'"></td>
	  <td>'.$lang['iso_code'].'</td>
	  <td>'.$lang['name'].'</td>
	  </tr>';
      }
    }
    $this->_html .= "</table>\n";
    $this->_html .= '
      <br />
      <input type="submit" name="submitTabTranslate" value="'.
      $this->l('Translate').'" class="button" />
      </fieldset>
      </form><br /><br />';
  }

  public function dump($var, $name = NULL)
  {
    print "<pre>";
    if ($name)
      print "$name:\n";
    print_r($var);
    print "</pre>";
  }

  public function getTables13()
  {
    $now = date('Y-m-d');
    $tables = array();

    $table = new StdClass();
    $table->name = 'configuration_lang';
    $table->fields = array('id_configuration', 'id_lang', 'value', 'date_upd');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(36, 1, $this->l('IN', true), $now),
      array(38, 1, $this->l('DE', true), $now),
      array(46, 1, $this->l('a|the|of|on|in|and|to', true), $now),
      array(720, 1, $this->l('SL', true), $now));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'lang';
    $table->fields = array('id_lang', 'name', 'active', 'iso_code');
    $table->flags = array(0, 1, 0, 0);
    $table->data = array(
      array(1, $this->l('English (English)', true), 1, 'en'));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'category_lang';
    $table->fields = array('id_category', 'id_lang', 'name', 'description', 'link_rewrite', 'meta_title', 'meta_keywords', 'meta_description');
    $table->flags = array(0, 0, 1, 1, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Home', true), '', $this->l('home', true), NULL, NULL, NULL));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'order_state_lang';
    $table->fields = array('id_order_state', 'id_lang', 'name', 'template');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Awaiting cheque payment', true), 'cheque'),
      array(2, 1, $this->l('Payment accepted', true), 'payment'),
      array(3, 1, $this->l('Preparation in progress', true), 'preparation'),
      array(4, 1, $this->l('Shipped', true), 'shipped'),
      array(5, 1, $this->l('Delivered', true), ''),
      array(6, 1, $this->l('Canceled', true), 'order_canceled'),
      array(7, 1, $this->l('Refund', true), 'refund'),
      array(8, 1, $this->l('Payment error', true), 'payment_error'),
      array(9, 1, $this->l('On backorder', true), 'outofstock'),
      array(10, 1, $this->l('Awaiting bank wire payment', true), 'bankwire'),
      array(11, 1, $this->l('Awaiting PayPal payment', true), ''));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'country_lang';
    $table->fields = array('id_country', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Germany', true)),
      array(2, 1, $this->l('Austria', true)),
      array(3, 1, $this->l('Belgium', true)),
      array(4, 1, $this->l('Canada', true)),
      array(5, 1, $this->l('China', true)),
      array(6, 1, $this->l('Spain', true)),
      array(7, 1, $this->l('Finland', true)),
      array(8, 1, $this->l('France', true)),
      array(9, 1, $this->l('Greece', true)),
      array(10, 1, $this->l('Italy', true)),
      array(11, 1, $this->l('Japan', true)),
      array(12, 1, $this->l('Luxemburg', true)),
      array(13, 1, $this->l('Netherlands', true)),
      array(14, 1, $this->l('Poland', true)),
      array(15, 1, $this->l('Portugal', true)),
      array(16, 1, $this->l('Czech Republic', true)),
      array(17, 1, $this->l('United Kingdom', true)),
      array(18, 1, $this->l('Sweden', true)),
      array(19, 1, $this->l('Switzerland', true)),
      array(20, 1, $this->l('Denmark', true)),
      array(21, 1, $this->l('USA', true)),
      array(22, 1, $this->l('HongKong', true)),
      array(23, 1, $this->l('Norway', true)),
      array(24, 1, $this->l('Australia', true)),
      array(25, 1, $this->l('Singapore', true)),
      array(26, 1, $this->l('Ireland', true)),
      array(27, 1, $this->l('New Zealand', true)),
      array(28, 1, $this->l('South Korea', true)),
      array(29, 1, $this->l('Israel', true)),
      array(30, 1, $this->l('South Africa', true)),
      array(31, 1, $this->l('Nigeria', true)),
      array(32, 1, $this->l('Ivory Coast', true)),
      array(33, 1, $this->l('Togo', true)),
      array(34, 1, $this->l('Bolivia', true)),
      array(35, 1, $this->l('Mauritius', true)),
      array(143, 1, $this->l('Hungary', true)),
      array(36, 1, $this->l('Romania', true)),
      array(37, 1, $this->l('Slovakia', true)),
      array(38, 1, $this->l('Algeria', true)),
      array(39, 1, $this->l('American Samoa', true)),
      array(40, 1, $this->l('Andorra', true)),
      array(41, 1, $this->l('Angola', true)),
      array(42, 1, $this->l('Anguilla', true)),
      array(43, 1, $this->l('Antigua and Barbuda', true)),
      array(44, 1, $this->l('Argentina', true)),
      array(45, 1, $this->l('Armenia', true)),
      array(46, 1, $this->l('Aruba', true)),
      array(47, 1, $this->l('Azerbaijan', true)),
      array(48, 1, $this->l('Bahamas', true)),
      array(49, 1, $this->l('Bahrain', true)),
      array(50, 1, $this->l('Bangladesh', true)),
      array(51, 1, $this->l('Barbados', true)),
      array(52, 1, $this->l('Belarus', true)),
      array(53, 1, $this->l('Belize', true)),
      array(54, 1, $this->l('Benin', true)),
      array(55, 1, $this->l('Bermuda', true)),
      array(56, 1, $this->l('Bhutan', true)),
      array(57, 1, $this->l('Botswana', true)),
      array(58, 1, $this->l('Brazil', true)),
      array(59, 1, $this->l('Brunei', true)),
      array(60, 1, $this->l('Burkina Faso', true)),
      array(61, 1, $this->l('Burma (Myanmar)', true)),
      array(62, 1, $this->l('Burundi', true)),
      array(63, 1, $this->l('Cambodia', true)),
      array(64, 1, $this->l('Cameroon', true)),
      array(65, 1, $this->l('Cape Verde', true)),
      array(66, 1, $this->l('Central African Republic', true)),
      array(67, 1, $this->l('Chad', true)),
      array(68, 1, $this->l('Chile', true)),
      array(69, 1, $this->l('Colombia', true)),
      array(70, 1, $this->l('Comoros', true)),
      array(71, 1, $this->l('Congo, Dem. Republic', true)),
      array(72, 1, $this->l('Congo, Republic', true)),
      array(73, 1, $this->l('Costa Rica', true)),
      array(74, 1, $this->l('Croatia', true)),
      array(75, 1, $this->l('Cuba', true)),
      array(76, 1, $this->l('Cyprus', true)),
      array(77, 1, $this->l('Djibouti', true)),
      array(78, 1, $this->l('Dominica', true)),
      array(79, 1, $this->l('Dominican Republic', true)),
      array(80, 1, $this->l('East Timor', true)),
      array(81, 1, $this->l('Ecuador', true)),
      array(82, 1, $this->l('Egypt', true)),
      array(83, 1, $this->l('El Salvador', true)),
      array(84, 1, $this->l('Equatorial Guinea', true)),
      array(85, 1, $this->l('Eritrea', true)),
      array(86, 1, $this->l('Estonia', true)),
      array(87, 1, $this->l('Ethiopia', true)),
      array(88, 1, $this->l('Falkland Islands', true)),
      array(89, 1, $this->l('Faroe Islands', true)),
      array(90, 1, $this->l('Fiji', true)),
      array(91, 1, $this->l('Gabon', true)),
      array(92, 1, $this->l('Gambia', true)),
      array(93, 1, $this->l('Georgia', true)),
      array(94, 1, $this->l('Ghana', true)),
      array(95, 1, $this->l('Grenada', true)),
      array(96, 1, $this->l('Greenland', true)),
      array(97, 1, $this->l('Gibraltar', true)),
      array(98, 1, $this->l('Guadeloupe', true)),
      array(99, 1, $this->l('Guam', true)),
      array(100, 1, $this->l('Guatemala', true)),
      array(101, 1, $this->l('Guernsey', true)),
      array(102, 1, $this->l('Guinea', true)),
      array(103, 1, $this->l('Guinea-Bissau', true)),
      array(104, 1, $this->l('Guyana', true)),
      array(105, 1, $this->l('Haiti', true)),
      array(106, 1, $this->l('Heard Island and McDonald Islands', true)),
      array(107, 1, $this->l('Vatican City State', true)),
      array(108, 1, $this->l('Honduras', true)),
      array(109, 1, $this->l('Iceland', true)),
      array(110, 1, $this->l('India', true)),
      array(111, 1, $this->l('Indonesia', true)),
      array(112, 1, $this->l('Iran', true)),
      array(113, 1, $this->l('Iraq', true)),
      array(114, 1, $this->l('Isle of Man', true)),
      array(115, 1, $this->l('Jamaica', true)),
      array(116, 1, $this->l('Jersey', true)),
      array(117, 1, $this->l('Jordan', true)),
      array(118, 1, $this->l('Kazakhstan', true)),
      array(119, 1, $this->l('Kenya', true)),
      array(120, 1, $this->l('Kiribati', true)),
      array(121, 1, $this->l('Korea, Dem. Republic of', true)),
      array(122, 1, $this->l('Kuwait', true)),
      array(123, 1, $this->l('Kyrgyzstan', true)),
      array(124, 1, $this->l('Laos', true)),
      array(125, 1, $this->l('Latvia', true)),
      array(126, 1, $this->l('Lebanon', true)),
      array(127, 1, $this->l('Lesotho', true)),
      array(128, 1, $this->l('Liberia', true)),
      array(129, 1, $this->l('Libya', true)),
      array(130, 1, $this->l('Liechtenstein', true)),
      array(131, 1, $this->l('Lithuania', true)),
      array(132, 1, $this->l('Macau', true)),
      array(133, 1, $this->l('Macedonia', true)),
      array(134, 1, $this->l('Madagascar', true)),
      array(135, 1, $this->l('Malawi', true)),
      array(136, 1, $this->l('Malaysia', true)),
      array(137, 1, $this->l('Maldives', true)),
      array(138, 1, $this->l('Mali', true)),
      array(139, 1, $this->l('Malta', true)),
      array(140, 1, $this->l('Marshall Islands', true)),
      array(141, 1, $this->l('Martinique', true)),
      array(142, 1, $this->l('Mauritania', true)),
      array(144, 1, $this->l('Mayotte', true)),
      array(145, 1, $this->l('Mexico', true)),
      array(146, 1, $this->l('Micronesia', true)),
      array(147, 1, $this->l('Moldova', true)),
      array(148, 1, $this->l('Monaco', true)),
      array(149, 1, $this->l('Mongolia', true)),
      array(150, 1, $this->l('Montenegro', true)),
      array(151, 1, $this->l('Montserrat', true)),
      array(152, 1, $this->l('Morocco', true)),
      array(153, 1, $this->l('Mozambique', true)),
      array(154, 1, $this->l('Namibia', true)),
      array(155, 1, $this->l('Nauru', true)),
      array(156, 1, $this->l('Nepal', true)),
      array(157, 1, $this->l('Netherlands Antilles', true)),
      array(158, 1, $this->l('New Caledonia', true)),
      array(159, 1, $this->l('Nicaragua', true)),
      array(160, 1, $this->l('Niger', true)),
      array(161, 1, $this->l('Niue', true)),
      array(162, 1, $this->l('Norfolk Island', true)),
      array(163, 1, $this->l('Northern Mariana Islands', true)),
      array(164, 1, $this->l('Oman', true)),
      array(165, 1, $this->l('Pakistan', true)),
      array(166, 1, $this->l('Palau', true)),
      array(167, 1, $this->l('Palestinian Territories', true)),
      array(168, 1, $this->l('Panama', true)),
      array(169, 1, $this->l('Papua New Guinea', true)),
      array(170, 1, $this->l('Paraguay', true)),
      array(171, 1, $this->l('Peru', true)),
      array(172, 1, $this->l('Philippines', true)),
      array(173, 1, $this->l('Pitcairn', true)),
      array(174, 1, $this->l('Puerto Rico', true)),
      array(175, 1, $this->l('Qatar', true)),
      array(176, 1, $this->l('Réunion', true)),
      array(177, 1, $this->l('Russian Federation', true)),
      array(178, 1, $this->l('Rwanda', true)),
      array(179, 1, $this->l('Saint Barthélemy', true)),
      array(180, 1, $this->l('Saint Kitts and Nevis', true)),
      array(181, 1, $this->l('Saint Lucia', true)),
      array(182, 1, $this->l('Saint Martin', true)),
      array(183, 1, $this->l('Saint Pierre and Miquelon', true)),
      array(184, 1, $this->l('Saint Vincent and the Grenadines', true)),
      array(185, 1, $this->l('Samoa', true)),
      array(186, 1, $this->l('San Marino', true)),
      array(187, 1, $this->l('São Tomé and Príncipe', true)),
      array(188, 1, $this->l('Saudi Arabia', true)),
      array(189, 1, $this->l('Senegal', true)),
      array(190, 1, $this->l('Serbia', true)),
      array(191, 1, $this->l('Seychelles', true)),
      array(192, 1, $this->l('Sierra Leone', true)),
      array(193, 1, $this->l('Slovenia', true)),
      array(194, 1, $this->l('Solomon Islands', true)),
      array(195, 1, $this->l('Somalia', true)),
      array(196, 1, $this->l('South Georgia and the South Sandwich Islands', true)),
      array(197, 1, $this->l('Sri Lanka', true)),
      array(198, 1, $this->l('Sudan', true)),
      array(199, 1, $this->l('Suriname', true)),
      array(200, 1, $this->l('Svalbard and Jan Mayen', true)),
      array(201, 1, $this->l('Swaziland', true)),
      array(202, 1, $this->l('Syria', true)),
      array(203, 1, $this->l('Taiwan', true)),
      array(204, 1, $this->l('Tajikistan', true)),
      array(205, 1, $this->l('Tanzania', true)),
      array(206, 1, $this->l('Thailand', true)),
      array(207, 1, $this->l('Tokelau', true)),
      array(208, 1, $this->l('Tonga', true)),
      array(209, 1, $this->l('Trinidad and Tobago', true)),
      array(210, 1, $this->l('Tunisia', true)),
      array(211, 1, $this->l('Turkey', true)),
      array(212, 1, $this->l('Turkmenistan', true)),
      array(213, 1, $this->l('Turks and Caicos Islands', true)),
      array(214, 1, $this->l('Tuvalu', true)),
      array(215, 1, $this->l('Uganda', true)),
      array(216, 1, $this->l('Ukraine', true)),
      array(217, 1, $this->l('United Arab Emirates', true)),
      array(218, 1, $this->l('Uruguay', true)),
      array(219, 1, $this->l('Uzbekistan', true)),
      array(220, 1, $this->l('Vanuatu', true)),
      array(221, 1, $this->l('Venezuela', true)),
      array(222, 1, $this->l('Vietnam', true)),
      array(223, 1, $this->l('Virgin Islands (British)', true)),
      array(224, 1, $this->l('Virgin Islands (U.S.)', true)),
      array(225, 1, $this->l('Wallis and Futuna', true)),
      array(226, 1, $this->l('Western Sahara', true)),
      array(227, 1, $this->l('Yemen', true)),
      array(228, 1, $this->l('Zambia', true)),
      array(229, 1, $this->l('Zimbabwe', true)),
      array(230, 1, $this->l('Albania', true)),
      array(231, 1, $this->l('Afghanistan', true)),
      array(232, 1, $this->l('Antarctica', true)),
      array(233, 1, $this->l('Bosnia and Herzegovina', true)),
      array(234, 1, $this->l('Bouvet Island', true)),
      array(235, 1, $this->l('British Indian Ocean Territory', true)),
      array(236, 1, $this->l('Bulgaria', true)),
      array(237, 1, $this->l('Cayman Islands', true)),
      array(238, 1, $this->l('Christmas Island', true)),
      array(239, 1, $this->l('Cocos (Keeling) Islands', true)),
      array(240, 1, $this->l('Cook Islands', true)),
      array(241, 1, $this->l('French Guiana', true)),
      array(242, 1, $this->l('French Polynesia', true)),
      array(243, 1, $this->l('French Southern Territories', true)),
      array(244, 1, $this->l('Åland Islands', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'tax_lang';
    $table->fields = array('id_tax', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('VAT 19.6%', true)),
      array(2, 1, $this->l('VAT 5.5%', true)),
      array(3, 1, $this->l('VAT 17.5%', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'contact_lang';
    $table->fields = array('id_contact', 'id_lang', 'name', 'description');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Webmaster', true), $this->l('If a technical problem occurs on this website', true)),
      array(2, 1, $this->l('Customer service', true), $this->l('For any question about a product, an order', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'discount_type_lang';
    $table->fields = array('id_discount_type', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Discount on order (%)', true)),
      array(2, 1, $this->l('Discount on order (amount)', true)),
      array(3, 1, $this->l('Free shipping', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'profile_lang';
    $table->fields = array('id_profile', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Administrator', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'tab_lang';
    $table->fields = array('id_lang', 'id_tab', 'name');
    $table->flags = array(0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Catalog', true)),
      array(1, 2, $this->l('Customers', true)),
      array(1, 3, $this->l('Orders', true)),
      array(1, 4, $this->l('Payment', true)),
      array(1, 5, $this->l('Shipping', true)),
      array(1, 6, $this->l('Stats', true)),
      array(1, 7, $this->l('Modules', true)),
      array(1, 8, $this->l('Preferences', true)),
      array(1, 9, $this->l('Tools', true)),
      array(1, 10, $this->l('Manufacturers', true)),
      array(1, 11, $this->l('Attributes and groups', true)),
      array(1, 12, $this->l('Addresses', true)),
      array(1, 13, $this->l('Statuses', true)),
      array(1, 14, $this->l('Vouchers', true)),
      array(1, 15, $this->l('Currencies', true)),
      array(1, 16, $this->l('Taxes', true)),
      array(1, 17, $this->l('Carriers', true)),
      array(1, 18, $this->l('Countries', true)),
      array(1, 19, $this->l('Zones', true)),
      array(1, 20, $this->l('Price ranges', true)),
      array(1, 21, $this->l('Weight ranges', true)),
      array(1, 22, $this->l('Positions', true)),
      array(1, 23, $this->l('Database', true)),
      array(1, 24, $this->l('Email', true)),
      array(1, 26, $this->l('Image', true)),
      array(1, 27, $this->l('Products', true)),
      array(1, 28, $this->l('Contacts', true)),
      array(1, 29, $this->l('Employees', true)),
      array(1, 30, $this->l('Profiles', true)),
      array(1, 31, $this->l('Permissions', true)),
      array(1, 32, $this->l('Languages', true)),
      array(1, 33, $this->l('Translations', true)),
      array(1, 34, $this->l('Suppliers', true)),
      array(1, 35, $this->l('Tabs', true)),
      array(1, 36, $this->l('Features', true)),
      array(1, 37, $this->l('Quick Accesses', true)),
      array(1, 38, $this->l('Appearance', true)),
      array(1, 39, $this->l('Contact', true)),
      array(1, 40, $this->l('Aliases', true)),
      array(1, 41, $this->l('Import', true)),
      array(1, 42, $this->l('Invoices', true)),
      array(1, 43, $this->l('Search', true)),
      array(1, 44, $this->l('Localization', true)),
      array(1, 46, $this->l('States', true)),
      array(1, 47, $this->l('Merchandise return', true)),
      array(1, 48, $this->l('PDF', true)),
      array(1, 49, $this->l('Credit slips', true)),
      array(1, 50, $this->l('Modules', true)),
      array(1, 51, $this->l('Settings', true)),
      array(1, 52, $this->l('Subdomains', true)),
      array(1, 53, $this->l('DB backup', true)),
      array(1, 54, $this->l('Order Messages', true)),
      array(1, 55, $this->l('Delivery slips', true)),
      array(1, 56, $this->l('Meta-Tags', true)),
      array(1, 57, $this->l('CMS', true)),
      array(1, 58, $this->l('Image mapping', true)),
      array(1, 59, $this->l('Customer messages', true)),
      array(1, 60, $this->l('Tracking', true)),
      array(1, 61, $this->l('Search engines', true)),
      array(1, 62, $this->l('Referrers', true)),
      array(1, 63, $this->l('Groups', true)),
      array(1, 64, $this->l('Generators', true)),
      array(1, 65, $this->l('Carts', true)),
      array(1, 66, $this->l('Tags', true)),
      array(1, 67, $this->l('Search', true)),
      array(1, 68, $this->l('Attachments', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'quick_access_lang';
    $table->fields = array('id_quick_access', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Home', true)),
      array(2, 1, $this->l('My Shop', true)),
      array(3, 1, $this->l('New category', true)),
      array(4, 1, $this->l('New product', true)),
      array(5, 1, $this->l('New voucher', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'order_return_state_lang';
    $table->fields = array('id_order_return_state', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Waiting for confirmation', true)),
      array(2, 1, $this->l('Waiting for package', true)),
      array(3, 1, $this->l('Package received', true)),
      array(4, 1, $this->l('Return denied', true)),
      array(5, 1, $this->l('Return completed', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'meta_lang';
    $table->fields = array('id_meta', 'id_lang', 'title', 'description', 'keywords');
    $table->flags = array(0, 0, 1, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('404 error', true), $this->l('This page cannot be found', true), $this->l('error, 404, not found', true)),
      array(2, 1, $this->l('Best sales', true), $this->l('Our best sales', true), $this->l('best sales', true)),
      array(3, 1, $this->l('Contact us', true), $this->l('Use our form to contact us', true), $this->l('contact, form, e-mail', true)),
      array(4, 1, '', $this->l('Shop powered by PrestaShop', true), $this->l('shop, prestashop', true)),
      array(5, 1, $this->l('Manufacturers', true), $this->l('Manufacturers list', true), $this->l('manufacturer', true)),
      array(6, 1, $this->l('New products', true), $this->l('Our new products', true), $this->l('new, products', true)),
      array(7, 1, $this->l('Forgot your password', true), $this->l('Enter your e-mail address used to register in goal to get e-mail with your new password', true), $this->l('forgot, password, e-mail, new, reset', true)),
      array(8, 1, $this->l('Specials', true), $this->l('Our special products', true), $this->l('special, prices drop', true)),
      array(9, 1, $this->l('Sitemap', true), $this->l('Lost ? Find what your are looking for', true), $this->l('sitemap', true)),
      array(10, 1, $this->l('Suppliers', true), $this->l('Suppliers list', true), $this->l('supplier', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'carrier_lang';
    $table->fields = array('id_carrier', 'id_lang', 'delay');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Pick up in-store', true)),
      array(2, 1, $this->l('Delivery next day!', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'group_lang';
    $table->fields = array('id_group', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Default', true)));
    $tables[] = $table;

    return $tables;
  }

  public function getTables14()
  {
    $now = date('Y-m-d');
    $tables = array();

    $table = new StdClass();
    $table->name = 'configuration_lang';
    $table->fields = array('id_configuration', 'id_lang', 'value', 'date_upd');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(36, 1, $this->l('IN', true), $now),
      array(38, 1, $this->l('DE', true), $now),
      array(46, 1, $this->l('a|the|of|on|in|and|to', true), $now),
      array(68, 1, 0, $now),
      array(74, 1, $this->l('Dear Customer,[nl][nl]Regards,[nl]Customer service', true), $now));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'lang';
    $table->fields = array('id_lang', 'name', 'active', 'iso_code', 'language_code', 'date_format_lite', 'date_format_full');
    $table->flags = array(0, 1, 0, 0, 0, 0, 0);
    $table->data = array(
      array(1, $this->l('English (English)', true), 1, 'en', 'en-us', 'm/j/Y', 'm/j/Y H:i:s'));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'category_lang';
    $table->fields = array('id_category', 'id_lang', 'name', 'description', 'link_rewrite', 'meta_title', 'meta_keywords', 'meta_description');
    $table->flags = array(0, 0, 1, 1, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Home', true), '', $this->l('home', true), NULL, NULL, NULL));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'order_state_lang';
    $table->fields = array('id_order_state', 'id_lang', 'name', 'template');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Awaiting cheque payment', true), 'cheque'),
      array(2, 1, $this->l('Payment accepted', true), 'payment'),
      array(3, 1, $this->l('Preparation in progress', true), 'preparation'),
      array(4, 1, $this->l('Shipped', true), 'shipped'),
      array(5, 1, $this->l('Delivered', true), ''),
      array(6, 1, $this->l('Canceled', true), 'order_canceled'),
      array(7, 1, $this->l('Refund', true), 'refund'),
      array(8, 1, $this->l('Payment error', true), 'payment_error'),
      array(9, 1, $this->l('On backorder', true), 'outofstock'),
      array(10, 1, $this->l('Awaiting bank wire payment', true), 'bankwire'),
      array(11, 1, $this->l('Awaiting PayPal payment', true), ''),
      array(12, 1, $this->l('Payment remotely accepted', true), 'payment'));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'country_lang';
    $table->fields = array('id_country', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Germany', true)),
      array(2, 1, $this->l('Austria', true)),
      array(3, 1, $this->l('Belgium', true)),
      array(4, 1, $this->l('Canada', true)),
      array(5, 1, $this->l('China', true)),
      array(6, 1, $this->l('Spain', true)),
      array(7, 1, $this->l('Finland', true)),
      array(8, 1, $this->l('France', true)),
      array(9, 1, $this->l('Greece', true)),
      array(10, 1, $this->l('Italy', true)),
      array(11, 1, $this->l('Japan', true)),
      array(12, 1, $this->l('Luxemburg', true)),
      array(13, 1, $this->l('Netherlands', true)),
      array(14, 1, $this->l('Poland', true)),
      array(15, 1, $this->l('Portugal', true)),
      array(16, 1, $this->l('Czech Republic', true)),
      array(17, 1, $this->l('United Kingdom', true)),
      array(18, 1, $this->l('Sweden', true)),
      array(19, 1, $this->l('Switzerland', true)),
      array(20, 1, $this->l('Denmark', true)),
      array(21, 1, $this->l('United States', true)),
      array(22, 1, $this->l('HongKong', true)),
      array(23, 1, $this->l('Norway', true)),
      array(24, 1, $this->l('Australia', true)),
      array(25, 1, $this->l('Singapore', true)),
      array(26, 1, $this->l('Ireland', true)),
      array(27, 1, $this->l('New Zealand', true)),
      array(28, 1, $this->l('South Korea', true)),
      array(29, 1, $this->l('Israel', true)),
      array(30, 1, $this->l('South Africa', true)),
      array(31, 1, $this->l('Nigeria', true)),
      array(32, 1, $this->l('Ivory Coast', true)),
      array(33, 1, $this->l('Togo', true)),
      array(34, 1, $this->l('Bolivia', true)),
      array(35, 1, $this->l('Mauritius', true)),
      array(36, 1, $this->l('Romania', true)),
      array(37, 1, $this->l('Slovakia', true)),
      array(38, 1, $this->l('Algeria', true)),
      array(39, 1, $this->l('American Samoa', true)),
      array(40, 1, $this->l('Andorra', true)),
      array(41, 1, $this->l('Angola', true)),
      array(42, 1, $this->l('Anguilla', true)),
      array(43, 1, $this->l('Antigua and Barbuda', true)),
      array(44, 1, $this->l('Argentina', true)),
      array(45, 1, $this->l('Armenia', true)),
      array(46, 1, $this->l('Aruba', true)),
      array(47, 1, $this->l('Azerbaijan', true)),
      array(48, 1, $this->l('Bahamas', true)),
      array(49, 1, $this->l('Bahrain', true)),
      array(50, 1, $this->l('Bangladesh', true)),
      array(51, 1, $this->l('Barbados', true)),
      array(52, 1, $this->l('Belarus', true)),
      array(53, 1, $this->l('Belize', true)),
      array(54, 1, $this->l('Benin', true)),
      array(55, 1, $this->l('Bermuda', true)),
      array(56, 1, $this->l('Bhutan', true)),
      array(57, 1, $this->l('Botswana', true)),
      array(58, 1, $this->l('Brazil', true)),
      array(59, 1, $this->l('Brunei', true)),
      array(60, 1, $this->l('Burkina Faso', true)),
      array(61, 1, $this->l('Burma (Myanmar)', true)),
      array(62, 1, $this->l('Burundi', true)),
      array(63, 1, $this->l('Cambodia', true)),
      array(64, 1, $this->l('Cameroon', true)),
      array(65, 1, $this->l('Cape Verde', true)),
      array(66, 1, $this->l('Central African Republic', true)),
      array(67, 1, $this->l('Chad', true)),
      array(68, 1, $this->l('Chile', true)),
      array(69, 1, $this->l('Colombia', true)),
      array(70, 1, $this->l('Comoros', true)),
      array(71, 1, $this->l('Congo, Dem. Republic', true)),
      array(72, 1, $this->l('Congo, Republic', true)),
      array(73, 1, $this->l('Costa Rica', true)),
      array(74, 1, $this->l('Croatia', true)),
      array(75, 1, $this->l('Cuba', true)),
      array(76, 1, $this->l('Cyprus', true)),
      array(77, 1, $this->l('Djibouti', true)),
      array(78, 1, $this->l('Dominica', true)),
      array(79, 1, $this->l('Dominican Republic', true)),
      array(80, 1, $this->l('East Timor', true)),
      array(81, 1, $this->l('Ecuador', true)),
      array(82, 1, $this->l('Egypt', true)),
      array(83, 1, $this->l('El Salvador', true)),
      array(84, 1, $this->l('Equatorial Guinea', true)),
      array(85, 1, $this->l('Eritrea', true)),
      array(86, 1, $this->l('Estonia', true)),
      array(87, 1, $this->l('Ethiopia', true)),
      array(88, 1, $this->l('Falkland Islands', true)),
      array(89, 1, $this->l('Faroe Islands', true)),
      array(90, 1, $this->l('Fiji', true)),
      array(91, 1, $this->l('Gabon', true)),
      array(92, 1, $this->l('Gambia', true)),
      array(93, 1, $this->l('Georgia', true)),
      array(94, 1, $this->l('Ghana', true)),
      array(95, 1, $this->l('Grenada', true)),
      array(96, 1, $this->l('Greenland', true)),
      array(97, 1, $this->l('Gibraltar', true)),
      array(98, 1, $this->l('Guadeloupe', true)),
      array(99, 1, $this->l('Guam', true)),
      array(100, 1, $this->l('Guatemala', true)),
      array(101, 1, $this->l('Guernsey', true)),
      array(102, 1, $this->l('Guinea', true)),
      array(103, 1, $this->l('Guinea-Bissau', true)),
      array(104, 1, $this->l('Guyana', true)),
      array(105, 1, $this->l('Haiti', true)),
      array(106, 1, $this->l('Heard Island and McDonald Islands', true)),
      array(107, 1, $this->l('Vatican City State', true)),
      array(108, 1, $this->l('Honduras', true)),
      array(109, 1, $this->l('Iceland', true)),
      array(110, 1, $this->l('India', true)),
      array(111, 1, $this->l('Indonesia', true)),
      array(112, 1, $this->l('Iran', true)),
      array(113, 1, $this->l('Iraq', true)),
      array(114, 1, $this->l('Man Island', true)),
      array(115, 1, $this->l('Jamaica', true)),
      array(116, 1, $this->l('Jersey', true)),
      array(117, 1, $this->l('Jordan', true)),
      array(118, 1, $this->l('Kazakhstan', true)),
      array(119, 1, $this->l('Kenya', true)),
      array(120, 1, $this->l('Kiribati', true)),
      array(121, 1, $this->l('Korea, Dem. Republic of', true)),
      array(122, 1, $this->l('Kuwait', true)),
      array(123, 1, $this->l('Kyrgyzstan', true)),
      array(124, 1, $this->l('Laos', true)),
      array(125, 1, $this->l('Latvia', true)),
      array(126, 1, $this->l('Lebanon', true)),
      array(127, 1, $this->l('Lesotho', true)),
      array(128, 1, $this->l('Liberia', true)),
      array(129, 1, $this->l('Libya', true)),
      array(130, 1, $this->l('Liechtenstein', true)),
      array(131, 1, $this->l('Lithuania', true)),
      array(132, 1, $this->l('Macau', true)),
      array(133, 1, $this->l('Macedonia', true)),
      array(134, 1, $this->l('Madagascar', true)),
      array(135, 1, $this->l('Malawi', true)),
      array(136, 1, $this->l('Malaysia', true)),
      array(137, 1, $this->l('Maldives', true)),
      array(138, 1, $this->l('Mali', true)),
      array(139, 1, $this->l('Malta', true)),
      array(140, 1, $this->l('Marshall Islands', true)),
      array(141, 1, $this->l('Martinique', true)),
      array(142, 1, $this->l('Mauritania', true)),
      array(143, 1, $this->l('Hungary', true)),
      array(144, 1, $this->l('Mayotte', true)),
      array(145, 1, $this->l('Mexico', true)),
      array(146, 1, $this->l('Micronesia', true)),
      array(147, 1, $this->l('Moldova', true)),
      array(148, 1, $this->l('Monaco', true)),
      array(149, 1, $this->l('Mongolia', true)),
      array(150, 1, $this->l('Montenegro', true)),
      array(151, 1, $this->l('Montserrat', true)),
      array(152, 1, $this->l('Morocco', true)),
      array(153, 1, $this->l('Mozambique', true)),
      array(154, 1, $this->l('Namibia', true)),
      array(155, 1, $this->l('Nauru', true)),
      array(156, 1, $this->l('Nepal', true)),
      array(157, 1, $this->l('Netherlands Antilles', true)),
      array(158, 1, $this->l('New Caledonia', true)),
      array(159, 1, $this->l('Nicaragua', true)),
      array(160, 1, $this->l('Niger', true)),
      array(161, 1, $this->l('Niue', true)),
      array(162, 1, $this->l('Norfolk Island', true)),
      array(163, 1, $this->l('Northern Mariana Islands', true)),
      array(164, 1, $this->l('Oman', true)),
      array(165, 1, $this->l('Pakistan', true)),
      array(166, 1, $this->l('Palau', true)),
      array(167, 1, $this->l('Palestinian Territories', true)),
      array(168, 1, $this->l('Panama', true)),
      array(169, 1, $this->l('Papua New Guinea', true)),
      array(170, 1, $this->l('Paraguay', true)),
      array(171, 1, $this->l('Peru', true)),
      array(172, 1, $this->l('Philippines', true)),
      array(173, 1, $this->l('Pitcairn', true)),
      array(174, 1, $this->l('Puerto Rico', true)),
      array(175, 1, $this->l('Qatar', true)),
      array(176, 1, $this->l('Reunion Island', true)),
      array(177, 1, $this->l('Russian Federation', true)),
      array(178, 1, $this->l('Rwanda', true)),
      array(179, 1, $this->l('Saint Barthelemy', true)),
      array(180, 1, $this->l('Saint Kitts and Nevis', true)),
      array(181, 1, $this->l('Saint Lucia', true)),
      array(182, 1, $this->l('Saint Martin', true)),
      array(183, 1, $this->l('Saint Pierre and Miquelon', true)),
      array(184, 1, $this->l('Saint Vincent and the Grenadines', true)),
      array(185, 1, $this->l('Samoa', true)),
      array(186, 1, $this->l('San Marino', true)),
      array(187, 1, $this->l('São Tomé and Príncipe', true)),
      array(188, 1, $this->l('Saudi Arabia', true)),
      array(189, 1, $this->l('Senegal', true)),
      array(190, 1, $this->l('Serbia', true)),
      array(191, 1, $this->l('Seychelles', true)),
      array(192, 1, $this->l('Sierra Leone', true)),
      array(193, 1, $this->l('Slovenia', true)),
      array(194, 1, $this->l('Solomon Islands', true)),
      array(195, 1, $this->l('Somalia', true)),
      array(196, 1, $this->l('South Georgia and the South Sandwich Islands', true)),
      array(197, 1, $this->l('Sri Lanka', true)),
      array(198, 1, $this->l('Sudan', true)),
      array(199, 1, $this->l('Suriname', true)),
      array(200, 1, $this->l('Svalbard and Jan Mayen', true)),
      array(201, 1, $this->l('Swaziland', true)),
      array(202, 1, $this->l('Syria', true)),
      array(203, 1, $this->l('Taiwan', true)),
      array(204, 1, $this->l('Tajikistan', true)),
      array(205, 1, $this->l('Tanzania', true)),
      array(206, 1, $this->l('Thailand', true)),
      array(207, 1, $this->l('Tokelau', true)),
      array(208, 1, $this->l('Tonga', true)),
      array(209, 1, $this->l('Trinidad and Tobago', true)),
      array(210, 1, $this->l('Tunisia', true)),
      array(211, 1, $this->l('Turkey', true)),
      array(212, 1, $this->l('Turkmenistan', true)),
      array(213, 1, $this->l('Turks and Caicos Islands', true)),
      array(214, 1, $this->l('Tuvalu', true)),
      array(215, 1, $this->l('Uganda', true)),
      array(216, 1, $this->l('Ukraine', true)),
      array(217, 1, $this->l('United Arab Emirates', true)),
      array(218, 1, $this->l('Uruguay', true)),
      array(219, 1, $this->l('Uzbekistan', true)),
      array(220, 1, $this->l('Vanuatu', true)),
      array(221, 1, $this->l('Venezuela', true)),
      array(222, 1, $this->l('Vietnam', true)),
      array(223, 1, $this->l('Virgin Islands (British)', true)),
      array(224, 1, $this->l('Virgin Islands (U.S.)', true)),
      array(225, 1, $this->l('Wallis and Futuna', true)),
      array(226, 1, $this->l('Western Sahara', true)),
      array(227, 1, $this->l('Yemen', true)),
      array(228, 1, $this->l('Zambia', true)),
      array(229, 1, $this->l('Zimbabwe', true)),
      array(230, 1, $this->l('Albania', true)),
      array(231, 1, $this->l('Afghanistan', true)),
      array(232, 1, $this->l('Antarctica', true)),
      array(233, 1, $this->l('Bosnia and Herzegovina', true)),
      array(234, 1, $this->l('Bouvet Island', true)),
      array(235, 1, $this->l('British Indian Ocean Territory', true)),
      array(236, 1, $this->l('Bulgaria', true)),
      array(237, 1, $this->l('Cayman Islands', true)),
      array(238, 1, $this->l('Christmas Island', true)),
      array(239, 1, $this->l('Cocos (Keeling) Islands', true)),
      array(240, 1, $this->l('Cook Islands', true)),
      array(241, 1, $this->l('French Guiana', true)),
      array(242, 1, $this->l('French Polynesia', true)),
      array(243, 1, $this->l('French Southern Territories', true)),
      array(244, 1, $this->l('Åland Islands', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'contact_lang';
    $table->fields = array('id_contact', 'id_lang', 'name', 'description');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Webmaster', true), $this->l('If a technical problem occurs on this website', true)),
      array(2, 1, $this->l('Customer service', true), $this->l('For any question about a product, an order', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'discount_type_lang';
    $table->fields = array('id_discount_type', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Discount on order (%)', true)),
      array(2, 1, $this->l('Discount on order (amount)', true)),
      array(3, 1, $this->l('Free shipping', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'profile_lang';
    $table->fields = array('id_profile', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Administrator', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'tab_lang';
    $table->fields = array('id_lang', 'id_tab', 'name');
    $table->flags = array(0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Catalog', true)),
      array(1, 2, $this->l('Customers', true)),
      array(1, 3, $this->l('Orders', true)),
      array(1, 4, $this->l('Payment', true)),
      array(1, 5, $this->l('Shipping', true)),
      array(1, 6, $this->l('Stats', true)),
      array(1, 7, $this->l('Modules', true)),
      array(1, 8, $this->l('Preferences', true)),
      array(1, 9, $this->l('Tools', true)),
      array(1, 10, $this->l('Manufacturers', true)),
      array(1, 11, $this->l('Attributes and Groups', true)),
      array(1, 12, $this->l('Addresses', true)),
      array(1, 13, $this->l('Statuses', true)),
      array(1, 14, $this->l('Vouchers', true)),
      array(1, 15, $this->l('Currencies', true)),
      array(1, 16, $this->l('Taxes', true)),
      array(1, 17, $this->l('Carriers', true)),
      array(1, 18, $this->l('Countries', true)),
      array(1, 19, $this->l('Zones', true)),
      array(1, 20, $this->l('Price Ranges', true)),
      array(1, 21, $this->l('Weight Ranges', true)),
      array(1, 22, $this->l('Positions', true)),
      array(1, 23, $this->l('Database', true)),
      array(1, 24, $this->l('E-mail', true)),
      array(1, 26, $this->l('Images', true)),
      array(1, 27, $this->l('Products', true)),
      array(1, 28, $this->l('Contacts', true)),
      array(1, 29, $this->l('Employees', true)),
      array(1, 30, $this->l('Profiles', true)),
      array(1, 31, $this->l('Permissions', true)),
      array(1, 32, $this->l('Languages', true)),
      array(1, 33, $this->l('Translations', true)),
      array(1, 34, $this->l('Suppliers', true)),
      array(1, 35, $this->l('Tabs', true)),
      array(1, 36, $this->l('Features', true)),
      array(1, 37, $this->l('Quick Access', true)),
      array(1, 38, $this->l('Appearance', true)),
      array(1, 39, $this->l('Contact Information', true)),
      array(1, 40, $this->l('Keyword Typos', true)),
      array(1, 41, $this->l('CSV Import', true)),
      array(1, 42, $this->l('Invoices', true)),
      array(1, 43, $this->l('Search', true)),
      array(1, 44, $this->l('Localization', true)),
      array(1, 46, $this->l('States', true)),
      array(1, 47, $this->l('Merchandise Returns', true)),
      array(1, 48, $this->l('PDF', true)),
      array(1, 49, $this->l('Credit Slips', true)),
      array(1, 51, $this->l('Settings', true)),
      array(1, 52, $this->l('Subdomains', true)),
      array(1, 53, $this->l('DB Backup', true)),
      array(1, 54, $this->l('Order Messages', true)),
      array(1, 55, $this->l('Delivery Slips', true)),
      array(1, 56, $this->l('SEO & URLs', true)),
      array(1, 57, $this->l('CMS', true)),
      array(1, 58, $this->l('Image Mapping', true)),
      array(1, 59, $this->l('Customer Messages', true)),
      array(1, 60, $this->l('Monitoring', true)),
      array(1, 61, $this->l('Search Engines', true)),
      array(1, 62, $this->l('Referrers', true)),
      array(1, 63, $this->l('Groups', true)),
      array(1, 64, $this->l('Generators', true)),
      array(1, 65, $this->l('Shopping Carts', true)),
      array(1, 66, $this->l('Tags', true)),
      array(1, 67, $this->l('Search', true)),
      array(1, 68, $this->l('Attachments', true)),
      array(1, 69, $this->l('Configuration Information', true)),
      array(1, 70, $this->l('Performance', true)),
      array(1, 71, $this->l('Customer Service', true)),
      array(1, 72, $this->l('Webservice', true)),
      array(1, 73, $this->l('Stock Movement', true)),
      array(1, 80, $this->l('Modules & Themes Catalog', true)),
      array(1, 81, $this->l('My Account', true)),
      array(1, 82, $this->l('Stores', true)),
      array(1, 83, $this->l('Themes', true)),
      array(1, 84, $this->l('Geolocation', true)),
      array(1, 85, $this->l('Tax Rules', true)),
      array(1, 86, $this->l('Logs', true)),
      array(1, 87, $this->l('Counties', true)),
      array(1, 88, $this->l('Home', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'quick_access_lang';
    $table->fields = array('id_quick_access', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Home', true)),
      array(2, 1, $this->l('My Shop', true)),
      array(3, 1, $this->l('New category', true)),
      array(4, 1, $this->l('New product', true)),
      array(5, 1, $this->l('New voucher', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'order_return_state_lang';
    $table->fields = array('id_order_return_state', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Waiting for confirmation', true)),
      array(2, 1, $this->l('Waiting for package', true)),
      array(3, 1, $this->l('Package received', true)),
      array(4, 1, $this->l('Return denied', true)),
      array(5, 1, $this->l('Return completed', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'meta_lang';
    $table->fields = array('id_meta', 'id_lang', 'title', 'description', 'keywords', 'url_rewrite');
    $table->flags = array(0, 0, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('404 error', true), $this->l('This page cannot be found', true), $this->l('error, 404, not found', true), $this->l('page-not-found', true)),
      array(2, 1, $this->l('Best sales', true), $this->l('Our best sales', true), $this->l('best sales', true), $this->l('best-sales', true)),
      array(3, 1, $this->l('Contact us', true), $this->l('Use our form to contact us', true), $this->l('contact, form, e-mail', true), $this->l('contact-us', true)),
      array(4, 1, '', $this->l('Shop powered by PrestaShop', true), $this->l('shop, prestashop', true), ''),
      array(5, 1, $this->l('Manufacturers', true), $this->l('Manufacturers list', true), $this->l('manufacturer', true), $this->l('manufacturers', true)),
      array(6, 1, $this->l('New products', true), $this->l('Our new products', true), $this->l('new, products', true), $this->l('new-products', true)),
      array(7, 1, $this->l('Forgot your password', true), $this->l('Enter your e-mail address used to register in goal to get e-mail with your new password', true), $this->l('forgot, password, e-mail, new, reset', true), $this->l('password-recovery', true)),
      array(8, 1, $this->l('Prices drop', true), $this->l('Our special products', true), $this->l('special, prices drop', true), $this->l('prices-drop', true)),
      array(9, 1, $this->l('Sitemap', true), $this->l('Lost ? Find what your are looking for', true), $this->l('sitemap', true), $this->l('sitemap', true)),
      array(10, 1, $this->l('Suppliers', true), $this->l('Suppliers list', true), $this->l('supplier', true), $this->l('supplier', true)),
      array(11, 1, $this->l('Address', true), '', '', $this->l('address', true)),
      array(12, 1, $this->l('Addresses', true), '', '', $this->l('addresses', true)),
      array(13, 1, $this->l('Authentication', true), '', '', $this->l('authentication', true)),
      array(14, 1, $this->l('Cart', true), '', '', $this->l('cart', true)),
      array(15, 1, $this->l('Discount', true), '', '', $this->l('discount', true)),
      array(16, 1, $this->l('Order history', true), '', '', $this->l('order-history', true)),
      array(17, 1, $this->l('Identity', true), '', '', $this->l('identity', true)),
      array(18, 1, $this->l('My account', true), '', '', $this->l('my-account', true)),
      array(19, 1, $this->l('Order follow', true), '', '', $this->l('order-follow', true)),
      array(20, 1, $this->l('Order slip', true), '', '', $this->l('order-slip', true)),
      array(21, 1, $this->l('Order', true), '', '', $this->l('order', true)),
      array(22, 1, $this->l('Search', true), '', '', $this->l('search', true)),
      array(23, 1, $this->l('Stores', true), '', '', $this->l('stores', true)),
      array(24, 1, $this->l('Order', true), '', '', $this->l('quick-order', true)),
      array(25, 1, $this->l('Guest tracking', true), '', '', $this->l('guest-tracking', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'cms_category_lang';
    $table->fields = array('id_cms_category', 'id_lang', 'name', 'description', 'link_rewrite', 'meta_title', 'meta_keywords', 'meta_description');
    $table->flags = array(0, 0, 1, 1, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Home', true), '', $this->l('home', true), NULL, NULL, NULL));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'carrier_lang';
    $table->fields = array('id_carrier', 'id_lang', 'delay');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Pick up in-store', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'group_lang';
    $table->fields = array('id_group', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Default', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'stock_mvt_reason_lang';
    $table->fields = array('id_stock_mvt_reason', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Increase', true)),
      array(2, 1, $this->l('Decrease', true)),
      array(3, 1, $this->l('Order', true)),
      array(4, 1, $this->l('Missing Stock Movement', true)),
      array(5, 1, $this->l('Restocking', true)));
    $tables[] = $table;

    return $tables;
  }

  public function getTables15()
  {
    $now = date('Y-m-d');
    $tables = array();

    $table = new StdClass();
    $table->name = 'configuration_lang';
    $table->fields = array('id_configuration', 'id_lang', 'value', 'date_upd');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(40, 1, $this->l('IN', true), $now),
      array(42, 1, $this->l('DE', true), $now),
      array(49, 1, $this->l('a|the|of|on|in|and|to', true), $now),
      array(71, 1, $this->l('0', true), $now),
      array(77, 1, $this->l('Dear Customer,[nl][nl]Regards,[nl]Customer service', true), $now));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'lang';
    $table->fields = array('id_lang', 'name', 'active', 'iso_code', 'language_code', 'date_format_lite', 'date_format_full', 'is_rtl');
    $table->flags = array(0, 1, 0, 0, 0, 0, 0, 0);
    $table->data = array(
      array(1, $this->l('English (English)', true), 1, 'en', 'en', 'm/j/Y', 'm/j/Y H:i:s', 0));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'category_lang';
    $table->fields = array('id_category', 'id_shop', 'id_lang', 'name', 'description', 'link_rewrite', 'meta_title', 'meta_keywords', 'meta_description');
    $table->flags = array(0, 0, 0, 1, 1, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, 1, $this->l('Root', true), '', $this->l('root', true), '', '', ''),
      array(2, 1, 1, $this->l('Home', true), '', $this->l('home', true), '', '', ''),
      array(3, 1, 1, $this->l('iPods', true), $this->l('Now that you can buy movies from the iTunes Store and sync them to your iPod, the whole world is your theater.', true), $this->l('music-ipods', true), '', '', ''),
      array(4, 1, 1, $this->l('Accessories', true), $this->l('Wonderful accessories for your iPod', true), $this->l('accessories-ipod', true), '', '', ''),
      array(5, 1, 1, $this->l('Laptops', true), $this->l('The latest Intel processor, a bigger hard drive, plenty of memory, and even more new features all fit inside just one liberating inch. The new Mac laptops have the performance, power, and connectivity of a desktop computer. Without the desk part.', true), $this->l('laptops', true), $this->l('Apple laptops', true), $this->l('Apple laptops MacBook Air', true), $this->l('Powerful and chic Apple laptops', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'order_state_lang';
    $table->fields = array('id_order_state', 'id_lang', 'name', 'template');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Awaiting cheque payment', true), 'cheque'),
      array(2, 1, $this->l('Payment accepted', true), 'payment'),
      array(3, 1, $this->l('Preparation in progress', true), 'preparation'),
      array(4, 1, $this->l('Shipped', true), 'shipped'),
      array(5, 1, $this->l('Delivered', true), ''),
      array(6, 1, $this->l('Canceled', true), 'order_canceled'),
      array(7, 1, $this->l('Refund', true), 'refund'),
      array(8, 1, $this->l('Payment error', true), 'payment_error'),
      array(9, 1, $this->l('On backorder', true), 'outofstock'),
      array(10, 1, $this->l('Awaiting bank wire payment', true), 'bankwire'),
      array(11, 1, $this->l('Awaiting PayPal payment', true), ''),
      array(12, 1, $this->l('Payment remotely accepted', true), 'payment'));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'country_lang';
    $table->fields = array('id_country', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Germany', true)),
      array(2, 1, $this->l('Austria', true)),
      array(3, 1, $this->l('Belgium', true)),
      array(4, 1, $this->l('Canada', true)),
      array(5, 1, $this->l('China', true)),
      array(6, 1, $this->l('Spain', true)),
      array(7, 1, $this->l('Finland', true)),
      array(8, 1, $this->l('France', true)),
      array(9, 1, $this->l('Greece', true)),
      array(10, 1, $this->l('Italy', true)),
      array(11, 1, $this->l('Japan', true)),
      array(12, 1, $this->l('Luxemburg', true)),
      array(13, 1, $this->l('Netherlands', true)),
      array(14, 1, $this->l('Poland', true)),
      array(15, 1, $this->l('Portugal', true)),
      array(16, 1, $this->l('Czech Republic', true)),
      array(17, 1, $this->l('United Kingdom', true)),
      array(18, 1, $this->l('Sweden', true)),
      array(19, 1, $this->l('Switzerland', true)),
      array(20, 1, $this->l('Denmark', true)),
      array(21, 1, $this->l('United States', true)),
      array(22, 1, $this->l('HongKong', true)),
      array(23, 1, $this->l('Norway', true)),
      array(24, 1, $this->l('Australia', true)),
      array(25, 1, $this->l('Singapore', true)),
      array(26, 1, $this->l('Ireland', true)),
      array(27, 1, $this->l('New Zealand', true)),
      array(28, 1, $this->l('South Korea', true)),
      array(29, 1, $this->l('Israel', true)),
      array(30, 1, $this->l('South Africa', true)),
      array(31, 1, $this->l('Nigeria', true)),
      array(32, 1, $this->l('Ivory Coast', true)),
      array(33, 1, $this->l('Togo', true)),
      array(34, 1, $this->l('Bolivia', true)),
      array(35, 1, $this->l('Mauritius', true)),
      array(36, 1, $this->l('Romania', true)),
      array(37, 1, $this->l('Slovakia', true)),
      array(38, 1, $this->l('Algeria', true)),
      array(39, 1, $this->l('American Samoa', true)),
      array(40, 1, $this->l('Andorra', true)),
      array(41, 1, $this->l('Angola', true)),
      array(42, 1, $this->l('Anguilla', true)),
      array(43, 1, $this->l('Antigua and Barbuda', true)),
      array(44, 1, $this->l('Argentina', true)),
      array(45, 1, $this->l('Armenia', true)),
      array(46, 1, $this->l('Aruba', true)),
      array(47, 1, $this->l('Azerbaijan', true)),
      array(48, 1, $this->l('Bahamas', true)),
      array(49, 1, $this->l('Bahrain', true)),
      array(50, 1, $this->l('Bangladesh', true)),
      array(51, 1, $this->l('Barbados', true)),
      array(52, 1, $this->l('Belarus', true)),
      array(53, 1, $this->l('Belize', true)),
      array(54, 1, $this->l('Benin', true)),
      array(55, 1, $this->l('Bermuda', true)),
      array(56, 1, $this->l('Bhutan', true)),
      array(57, 1, $this->l('Botswana', true)),
      array(58, 1, $this->l('Brazil', true)),
      array(59, 1, $this->l('Brunei', true)),
      array(60, 1, $this->l('Burkina Faso', true)),
      array(61, 1, $this->l('Burma (Myanmar)', true)),
      array(62, 1, $this->l('Burundi', true)),
      array(63, 1, $this->l('Cambodia', true)),
      array(64, 1, $this->l('Cameroon', true)),
      array(65, 1, $this->l('Cape Verde', true)),
      array(66, 1, $this->l('Central African Republic', true)),
      array(67, 1, $this->l('Chad', true)),
      array(68, 1, $this->l('Chile', true)),
      array(69, 1, $this->l('Colombia', true)),
      array(70, 1, $this->l('Comoros', true)),
      array(71, 1, $this->l('Congo, Dem. Republic', true)),
      array(72, 1, $this->l('Congo, Republic', true)),
      array(73, 1, $this->l('Costa Rica', true)),
      array(74, 1, $this->l('Croatia', true)),
      array(75, 1, $this->l('Cuba', true)),
      array(76, 1, $this->l('Cyprus', true)),
      array(77, 1, $this->l('Djibouti', true)),
      array(78, 1, $this->l('Dominica', true)),
      array(79, 1, $this->l('Dominican Republic', true)),
      array(80, 1, $this->l('East Timor', true)),
      array(81, 1, $this->l('Ecuador', true)),
      array(82, 1, $this->l('Egypt', true)),
      array(83, 1, $this->l('El Salvador', true)),
      array(84, 1, $this->l('Equatorial Guinea', true)),
      array(85, 1, $this->l('Eritrea', true)),
      array(86, 1, $this->l('Estonia', true)),
      array(87, 1, $this->l('Ethiopia', true)),
      array(88, 1, $this->l('Falkland Islands', true)),
      array(89, 1, $this->l('Faroe Islands', true)),
      array(90, 1, $this->l('Fiji', true)),
      array(91, 1, $this->l('Gabon', true)),
      array(92, 1, $this->l('Gambia', true)),
      array(93, 1, $this->l('Georgia', true)),
      array(94, 1, $this->l('Ghana', true)),
      array(95, 1, $this->l('Grenada', true)),
      array(96, 1, $this->l('Greenland', true)),
      array(97, 1, $this->l('Gibraltar', true)),
      array(98, 1, $this->l('Guadeloupe', true)),
      array(99, 1, $this->l('Guam', true)),
      array(100, 1, $this->l('Guatemala', true)),
      array(101, 1, $this->l('Guernsey', true)),
      array(102, 1, $this->l('Guinea', true)),
      array(103, 1, $this->l('Guinea-Bissau', true)),
      array(104, 1, $this->l('Guyana', true)),
      array(105, 1, $this->l('Haiti', true)),
      array(106, 1, $this->l('Heard Island and McDonald Islands', true)),
      array(107, 1, $this->l('Vatican City State', true)),
      array(108, 1, $this->l('Honduras', true)),
      array(109, 1, $this->l('Iceland', true)),
      array(110, 1, $this->l('India', true)),
      array(111, 1, $this->l('Indonesia', true)),
      array(112, 1, $this->l('Iran', true)),
      array(113, 1, $this->l('Iraq', true)),
      array(114, 1, $this->l('Man Island', true)),
      array(115, 1, $this->l('Jamaica', true)),
      array(116, 1, $this->l('Jersey', true)),
      array(117, 1, $this->l('Jordan', true)),
      array(118, 1, $this->l('Kazakhstan', true)),
      array(119, 1, $this->l('Kenya', true)),
      array(120, 1, $this->l('Kiribati', true)),
      array(121, 1, $this->l('Korea, Dem. Republic of', true)),
      array(122, 1, $this->l('Kuwait', true)),
      array(123, 1, $this->l('Kyrgyzstan', true)),
      array(124, 1, $this->l('Laos', true)),
      array(125, 1, $this->l('Latvia', true)),
      array(126, 1, $this->l('Lebanon', true)),
      array(127, 1, $this->l('Lesotho', true)),
      array(128, 1, $this->l('Liberia', true)),
      array(129, 1, $this->l('Libya', true)),
      array(130, 1, $this->l('Liechtenstein', true)),
      array(131, 1, $this->l('Lithuania', true)),
      array(132, 1, $this->l('Macau', true)),
      array(133, 1, $this->l('Macedonia', true)),
      array(134, 1, $this->l('Madagascar', true)),
      array(135, 1, $this->l('Malawi', true)),
      array(136, 1, $this->l('Malaysia', true)),
      array(137, 1, $this->l('Maldives', true)),
      array(138, 1, $this->l('Mali', true)),
      array(139, 1, $this->l('Malta', true)),
      array(140, 1, $this->l('Marshall Islands', true)),
      array(141, 1, $this->l('Martinique', true)),
      array(142, 1, $this->l('Mauritania', true)),
      array(143, 1, $this->l('Hungary', true)),
      array(144, 1, $this->l('Mayotte', true)),
      array(145, 1, $this->l('Mexico', true)),
      array(146, 1, $this->l('Micronesia', true)),
      array(147, 1, $this->l('Moldova', true)),
      array(148, 1, $this->l('Monaco', true)),
      array(149, 1, $this->l('Mongolia', true)),
      array(150, 1, $this->l('Montenegro', true)),
      array(151, 1, $this->l('Montserrat', true)),
      array(152, 1, $this->l('Morocco', true)),
      array(153, 1, $this->l('Mozambique', true)),
      array(154, 1, $this->l('Namibia', true)),
      array(155, 1, $this->l('Nauru', true)),
      array(156, 1, $this->l('Nepal', true)),
      array(157, 1, $this->l('Netherlands Antilles', true)),
      array(158, 1, $this->l('New Caledonia', true)),
      array(159, 1, $this->l('Nicaragua', true)),
      array(160, 1, $this->l('Niger', true)),
      array(161, 1, $this->l('Niue', true)),
      array(162, 1, $this->l('Norfolk Island', true)),
      array(163, 1, $this->l('Northern Mariana Islands', true)),
      array(164, 1, $this->l('Oman', true)),
      array(165, 1, $this->l('Pakistan', true)),
      array(166, 1, $this->l('Palau', true)),
      array(167, 1, $this->l('Palestinian Territories', true)),
      array(168, 1, $this->l('Panama', true)),
      array(169, 1, $this->l('Papua New Guinea', true)),
      array(170, 1, $this->l('Paraguay', true)),
      array(171, 1, $this->l('Peru', true)),
      array(172, 1, $this->l('Philippines', true)),
      array(173, 1, $this->l('Pitcairn', true)),
      array(174, 1, $this->l('Puerto Rico', true)),
      array(175, 1, $this->l('Qatar', true)),
      array(176, 1, $this->l('Reunion Island', true)),
      array(177, 1, $this->l('Russian Federation', true)),
      array(178, 1, $this->l('Rwanda', true)),
      array(179, 1, $this->l('Saint Barthelemy', true)),
      array(180, 1, $this->l('Saint Kitts and Nevis', true)),
      array(181, 1, $this->l('Saint Lucia', true)),
      array(182, 1, $this->l('Saint Martin', true)),
      array(183, 1, $this->l('Saint Pierre and Miquelon', true)),
      array(184, 1, $this->l('Saint Vincent and the Grenadines', true)),
      array(185, 1, $this->l('Samoa', true)),
      array(186, 1, $this->l('San Marino', true)),
      array(187, 1, $this->l('São Tomé and Príncipe', true)),
      array(188, 1, $this->l('Saudi Arabia', true)),
      array(189, 1, $this->l('Senegal', true)),
      array(190, 1, $this->l('Serbia', true)),
      array(191, 1, $this->l('Seychelles', true)),
      array(192, 1, $this->l('Sierra Leone', true)),
      array(193, 1, $this->l('Slovenia', true)),
      array(194, 1, $this->l('Solomon Islands', true)),
      array(195, 1, $this->l('Somalia', true)),
      array(196, 1, $this->l('South Georgia and the South Sandwich Islands', true)),
      array(197, 1, $this->l('Sri Lanka', true)),
      array(198, 1, $this->l('Sudan', true)),
      array(199, 1, $this->l('Suriname', true)),
      array(200, 1, $this->l('Svalbard and Jan Mayen', true)),
      array(201, 1, $this->l('Swaziland', true)),
      array(202, 1, $this->l('Syria', true)),
      array(203, 1, $this->l('Taiwan', true)),
      array(204, 1, $this->l('Tajikistan', true)),
      array(205, 1, $this->l('Tanzania', true)),
      array(206, 1, $this->l('Thailand', true)),
      array(207, 1, $this->l('Tokelau', true)),
      array(208, 1, $this->l('Tonga', true)),
      array(209, 1, $this->l('Trinidad and Tobago', true)),
      array(210, 1, $this->l('Tunisia', true)),
      array(211, 1, $this->l('Turkey', true)),
      array(212, 1, $this->l('Turkmenistan', true)),
      array(213, 1, $this->l('Turks and Caicos Islands', true)),
      array(214, 1, $this->l('Tuvalu', true)),
      array(215, 1, $this->l('Uganda', true)),
      array(216, 1, $this->l('Ukraine', true)),
      array(217, 1, $this->l('United Arab Emirates', true)),
      array(218, 1, $this->l('Uruguay', true)),
      array(219, 1, $this->l('Uzbekistan', true)),
      array(220, 1, $this->l('Vanuatu', true)),
      array(221, 1, $this->l('Venezuela', true)),
      array(222, 1, $this->l('Vietnam', true)),
      array(223, 1, $this->l('Virgin Islands (British)', true)),
      array(224, 1, $this->l('Virgin Islands (U.S.)', true)),
      array(225, 1, $this->l('Wallis and Futuna', true)),
      array(226, 1, $this->l('Western Sahara', true)),
      array(227, 1, $this->l('Yemen', true)),
      array(228, 1, $this->l('Zambia', true)),
      array(229, 1, $this->l('Zimbabwe', true)),
      array(230, 1, $this->l('Albania', true)),
      array(231, 1, $this->l('Afghanistan', true)),
      array(232, 1, $this->l('Antarctica', true)),
      array(233, 1, $this->l('Bosnia and Herzegovina', true)),
      array(234, 1, $this->l('Bouvet Island', true)),
      array(235, 1, $this->l('British Indian Ocean Territory', true)),
      array(236, 1, $this->l('Bulgaria', true)),
      array(237, 1, $this->l('Cayman Islands', true)),
      array(238, 1, $this->l('Christmas Island', true)),
      array(239, 1, $this->l('Cocos (Keeling) Islands', true)),
      array(240, 1, $this->l('Cook Islands', true)),
      array(241, 1, $this->l('French Guiana', true)),
      array(242, 1, $this->l('French Polynesia', true)),
      array(243, 1, $this->l('French Southern Territories', true)),
      array(244, 1, $this->l('Åland Islands', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'contact_lang';
    $table->fields = array('id_contact', 'id_lang', 'name', 'description');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Webmaster', true), $this->l('If a technical problem occurs on this website', true)),
      array(2, 1, $this->l('Customer service', true), $this->l('For any question about a product, an order', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'profile_lang';
    $table->fields = array('id_lang', 'id_profile', 'name');
    $table->flags = array(0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('SuperAdmin', true)),
      array(1, 2, $this->l('Administrator', true)),
      array(1, 3, $this->l('Logistician', true)),
      array(1, 4, $this->l('Translator', true)),
      array(1, 5, $this->l('Salesman', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'tab_lang';
    $table->fields = array('id_tab', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Home', true)),
      array(2, 1, $this->l('CMS Pages', true)),
      array(3, 1, $this->l('CMS Categories', true)),
      array(4, 1, $this->l('Combinations Generator', true)),
      array(5, 1, $this->l('Search', true)),
      array(6, 1, $this->l('Login', true)),
      array(7, 1, $this->l('Shops', true)),
      array(8, 1, $this->l('Shop URLs', true)),
      array(9, 1, $this->l('Catalog', true)),
      array(10, 1, $this->l('Orders', true)),
      array(11, 1, $this->l('Customers', true)),
      array(12, 1, $this->l('Price Rules', true)),
      array(13, 1, $this->l('Shipping', true)),
      array(14, 1, $this->l('Localization', true)),
      array(15, 1, $this->l('Modules', true)),
      array(16, 1, $this->l('Preferences', true)),
      array(17, 1, $this->l('Advanced Parameters', true)),
      array(18, 1, $this->l('Administration', true)),
      array(19, 1, $this->l('Stats', true)),
      array(20, 1, $this->l('Stock', true)),
      array(21, 1, $this->l('Products', true)),
      array(22, 1, $this->l('Categories', true)),
      array(23, 1, $this->l('Monitoring', true)),
      array(24, 1, $this->l('Attributes and Values', true)),
      array(25, 1, $this->l('Features', true)),
      array(26, 1, $this->l('Manufacturers', true)),
      array(27, 1, $this->l('Suppliers', true)),
      array(28, 1, $this->l('Image Mapping', true)),
      array(29, 1, $this->l('Tags', true)),
      array(30, 1, $this->l('Attachments', true)),
      array(31, 1, $this->l('Orders', true)),
      array(32, 1, $this->l('Invoices', true)),
      array(33, 1, $this->l('Merchandise Returns', true)),
      array(34, 1, $this->l('Delivery Slips', true)),
      array(35, 1, $this->l('Credit Slips', true)),
      array(36, 1, $this->l('Statuses', true)),
      array(37, 1, $this->l('Order Messages', true)),
      array(38, 1, $this->l('Customers', true)),
      array(39, 1, $this->l('Addresses', true)),
      array(40, 1, $this->l('Groups', true)),
      array(41, 1, $this->l('Shopping Carts', true)),
      array(42, 1, $this->l('Customer Service', true)),
      array(43, 1, $this->l('Contacts', true)),
      array(44, 1, $this->l('Titles', true)),
      array(45, 1, $this->l('Outstanding', true)),
      array(46, 1, $this->l('Cart Rules', true)),
      array(47, 1, $this->l('Catalog Price Rules', true)),
      array(48, 1, $this->l('Marketing', true)),
      array(49, 1, $this->l('Preferences', true)),
      array(50, 1, $this->l('Carriers', true)),
      array(51, 1, NULL),
      array(52, 1, $this->l('Localization', true)),
      array(53, 1, $this->l('Languages', true)),
      array(54, 1, $this->l('Zones', true)),
      array(55, 1, $this->l('Countries', true)),
      array(56, 1, $this->l('States', true)),
      array(57, 1, $this->l('Currencies', true)),
      array(58, 1, $this->l('Taxes', true)),
      array(59, 1, $this->l('Tax Rules', true)),
      array(60, 1, $this->l('Translations', true)),
      array(61, 1, $this->l('Modules', true)),
      array(62, 1, $this->l('Modules & Themes Catalog', true)),
      array(63, 1, $this->l('Positions', true)),
      array(64, 1, $this->l('Payment', true)),
      array(65, 1, $this->l('General', true)),
      array(66, 1, $this->l('Orders', true)),
      array(67, 1, $this->l('Products', true)),
      array(68, 1, $this->l('Customers', true)),
      array(69, 1, $this->l('Themes', true)),
      array(70, 1, $this->l('SEO & URLs', true)),
      array(71, 1, $this->l('CMS', true)),
      array(72, 1, $this->l('Images', true)),
      array(73, 1, $this->l('Store Contacts', true)),
      array(74, 1, $this->l('Search', true)),
      array(75, 1, $this->l('Maintenance', true)),
      array(76, 1, $this->l('Geolocation', true)),
      array(77, 1, $this->l('Configuration Information', true)),
      array(78, 1, $this->l('Performance', true)),
      array(79, 1, $this->l('E-mail', true)),
      array(80, 1, $this->l('Multistore', true)),
      array(81, 1, $this->l('CSV Import', true)),
      array(82, 1, $this->l('DB Backup', true)),
      array(83, 1, $this->l('SQL Manager', true)),
      array(84, 1, $this->l('Logs', true)),
      array(85, 1, $this->l('Webservice', true)),
      array(86, 1, $this->l('Preferences', true)),
      array(87, 1, $this->l('Quick Access', true)),
      array(88, 1, $this->l('Employees', true)),
      array(89, 1, $this->l('Profiles', true)),
      array(90, 1, $this->l('Permissions', true)),
      array(91, 1, $this->l('Menus', true)),
      array(92, 1, $this->l('Stats', true)),
      array(93, 1, $this->l('Search Engines', true)),
      array(94, 1, $this->l('Referrers', true)),
      array(95, 1, $this->l('Warehouses', true)),
      array(96, 1, $this->l('Stock Management', true)),
      array(97, 1, $this->l('Stock Movement', true)),
      array(98, 1, $this->l('Instant Stock Status', true)),
      array(99, 1, $this->l('Stock Coverage', true)),
      array(100, 1, $this->l('Supply orders', true)),
      array(101, 1, $this->l('Configuration', true)),
      array(102, 1, $this->l('Merchant Expertise', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'quick_access_lang';
    $table->fields = array('id_quick_access', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Home', true)),
      array(2, 1, $this->l('My Shop', true)),
      array(3, 1, $this->l('New category', true)),
      array(4, 1, $this->l('New product', true)),
      array(5, 1, $this->l('New voucher', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'order_return_state_lang';
    $table->fields = array('id_order_return_state', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Waiting for confirmation', true)),
      array(2, 1, $this->l('Waiting for package', true)),
      array(3, 1, $this->l('Package received', true)),
      array(4, 1, $this->l('Return denied', true)),
      array(5, 1, $this->l('Return completed', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'meta_lang';
    $table->fields = array('id_meta', 'id_shop', 'id_lang', 'title', 'description', 'keywords', 'url_rewrite');
    $table->flags = array(0, 0, 0, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, 1, $this->l('404 error', true), $this->l('This page cannot be found', true), '', $this->l('page-not-found', true)),
      array(2, 1, 1, $this->l('Best sales', true), $this->l('Our best sales', true), '', $this->l('best-sales', true)),
      array(3, 1, 1, $this->l('Contact us', true), $this->l('Use our form to contact us', true), '', $this->l('contact-us', true)),
      array(4, 1, 1, '', $this->l('Shop powered by PrestaShop', true), '', ''),
      array(5, 1, 1, $this->l('Manufacturers', true), $this->l('Manufacturers list', true), '', $this->l('manufacturers', true)),
      array(6, 1, 1, $this->l('New products', true), $this->l('Our new products', true), '', $this->l('new-products', true)),
      array(7, 1, 1, $this->l('Forgot your password', true), $this->l('Enter your e-mail address used to register in goal to get e-mail with your new password', true), '', $this->l('password-recovery', true)),
      array(8, 1, 1, $this->l('Prices drop', true), $this->l('Our special products', true), '', $this->l('prices-drop', true)),
      array(9, 1, 1, $this->l('Sitemap', true), $this->l('Lost ? Find what your are looking for', true), '', $this->l('sitemap', true)),
      array(10, 1, 1, $this->l('Suppliers', true), $this->l('Suppliers list', true), '', $this->l('supplier', true)),
      array(11, 1, 1, $this->l('Address', true), '', '', $this->l('address', true)),
      array(12, 1, 1, $this->l('Addresses', true), '', '', $this->l('addresses', true)),
      array(13, 1, 1, $this->l('Login', true), '', '', $this->l('login', true)),
      array(14, 1, 1, $this->l('Cart', true), '', '', $this->l('cart', true)),
      array(15, 1, 1, $this->l('Discount', true), '', '', $this->l('discount', true)),
      array(16, 1, 1, $this->l('Order history', true), '', '', $this->l('order-history', true)),
      array(17, 1, 1, $this->l('Identity', true), '', '', $this->l('identity', true)),
      array(18, 1, 1, $this->l('My account', true), '', '', $this->l('my-account', true)),
      array(19, 1, 1, $this->l('Order follow', true), '', '', $this->l('order-follow', true)),
      array(20, 1, 1, $this->l('Order slip', true), '', '', $this->l('order-slip', true)),
      array(21, 1, 1, $this->l('Order', true), '', '', $this->l('order', true)),
      array(22, 1, 1, $this->l('Search', true), '', '', $this->l('search', true)),
      array(23, 1, 1, $this->l('Stores', true), '', '', $this->l('stores', true)),
      array(24, 1, 1, $this->l('Order', true), '', '', $this->l('quick-order', true)),
      array(25, 1, 1, $this->l('Guest tracking', true), '', '', $this->l('guest-tracking', true)),
      array(26, 1, 1, $this->l('Order confirmation', true), '', '', $this->l('order-confirmation', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'cms_category_lang';
    $table->fields = array('id_cms_category', 'id_lang', 'name', 'description', 'link_rewrite', 'meta_title', 'meta_keywords', 'meta_description');
    $table->flags = array(0, 0, 1, 1, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Home', true), '', $this->l('home', true), '', '', ''));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'carrier_lang';
    $table->fields = array('id_carrier', 'id_shop', 'id_lang', 'delay');
    $table->flags = array(0, 0, 0, 1);
    $table->data = array(
      array(1, 1, 1, $this->l('Pick up in-store', true)),
      array(2, 1, 1, $this->l('Delivery next day!', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'group_lang';
    $table->fields = array('id_group', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Visitor', true)),
      array(2, 1, $this->l('Guest', true)),
      array(3, 1, $this->l('Customer', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'stock_mvt_reason_lang';
    $table->fields = array('id_stock_mvt_reason', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Increase', true)),
      array(2, 1, $this->l('Decrease', true)),
      array(3, 1, $this->l('Customer Order', true)),
      array(4, 1, $this->l('Regulation following an inventory of stock', true)),
      array(5, 1, $this->l('Regulation following an inventory of stock', true)),
      array(6, 1, $this->l('Transfer to another warehouse', true)),
      array(7, 1, $this->l('Transfer from another warehouse', true)),
      array(8, 1, $this->l('Supply Order', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'gender_lang';
    $table->fields = array('id_gender', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Mr.', true)),
      array(2, 1, $this->l('Ms.', true)));
    $tables[] = $table;

    return $tables;
  }

  public function getTables16()
  {
    $now = date('Y-m-d');
    $tables = array();

    $table = new StdClass();
    $table->name = 'configuration_lang';
    $table->fields = array('id_configuration', 'id_lang', 'value', 'date_upd');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(41, 1, $this->l('IN', true), $now),
      array(42, 1, $this->l('DE', true), $now),
      array(49, 1, $this->l('a|the|of|on|in|and|to', true), $now),
      array(71, 1, $this->l('0', true), $now),
      array(77, 1, $this->l('Dear Customer,[nl][nl]Regards,[nl]Customer service', true), $now),
      array(276, 1, $this->l('sale70.png', true), $now),
      array(277, 1, '', $now),
      array(278, 1, '', $now));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'lang';
    $table->fields = array('id_lang', 'name', 'active', 'iso_code', 'language_code', 'date_format_lite', 'date_format_full', 'is_rtl');
    $table->flags = array(0, 1, 0, 0, 0, 0, 0, 0);
    $table->data = array(
      array(1, $this->l('English (English)', true), 1, 'en', 'en-us', 'm/d/Y', 'm/d/Y H:i:s', 0));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'category_lang';
    $table->fields = array('id_category', 'id_shop', 'id_lang', 'name', 'description', 'link_rewrite', 'meta_title', 'meta_keywords', 'meta_description');
    $table->flags = array(0, 0, 0, 1, 1, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, 1, $this->l('Root', true), '', $this->l('root', true), '', '', ''),
      array(2, 1, 1, $this->l('Home', true), '', $this->l('home', true), '', '', ''));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'order_state_lang';
    $table->fields = array('id_order_state', 'id_lang', 'name', 'template');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Awaiting cheque payment', true), 'cheque'),
      array(2, 1, $this->l('Payment accepted', true), 'payment'),
      array(3, 1, $this->l('Preparation in progress', true), 'preparation'),
      array(4, 1, $this->l('Shipped', true), 'shipped'),
      array(5, 1, $this->l('Delivered', true), ''),
      array(6, 1, $this->l('Canceled', true), 'order_canceled'),
      array(7, 1, $this->l('Refund', true), 'refund'),
      array(8, 1, $this->l('Payment error', true), 'payment_error'),
      array(9, 1, $this->l('On backorder', true), 'outofstock'),
      array(10, 1, $this->l('Awaiting bank wire payment', true), 'bankwire'),
      array(11, 1, $this->l('Awaiting PayPal payment', true), ''),
      array(12, 1, $this->l('Remote payment accepted', true), 'payment'),
      array(13, 1, $this->l('On backorder (not paid)', true), 'outofstock'));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'country_lang';
    $table->fields = array('id_country', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Germany', true)),
      array(2, 1, $this->l('Austria', true)),
      array(3, 1, $this->l('Belgium', true)),
      array(4, 1, $this->l('Canada', true)),
      array(5, 1, $this->l('China', true)),
      array(6, 1, $this->l('Spain', true)),
      array(7, 1, $this->l('Finland', true)),
      array(8, 1, $this->l('France', true)),
      array(9, 1, $this->l('Greece', true)),
      array(10, 1, $this->l('Italy', true)),
      array(11, 1, $this->l('Japan', true)),
      array(12, 1, $this->l('Luxemburg', true)),
      array(13, 1, $this->l('Netherlands', true)),
      array(14, 1, $this->l('Poland', true)),
      array(15, 1, $this->l('Portugal', true)),
      array(16, 1, $this->l('Czech Republic', true)),
      array(17, 1, $this->l('United Kingdom', true)),
      array(18, 1, $this->l('Sweden', true)),
      array(19, 1, $this->l('Switzerland', true)),
      array(20, 1, $this->l('Denmark', true)),
      array(21, 1, $this->l('United States', true)),
      array(22, 1, $this->l('HongKong', true)),
      array(23, 1, $this->l('Norway', true)),
      array(24, 1, $this->l('Australia', true)),
      array(25, 1, $this->l('Singapore', true)),
      array(26, 1, $this->l('Ireland', true)),
      array(27, 1, $this->l('New Zealand', true)),
      array(28, 1, $this->l('South Korea', true)),
      array(29, 1, $this->l('Israel', true)),
      array(30, 1, $this->l('South Africa', true)),
      array(31, 1, $this->l('Nigeria', true)),
      array(32, 1, $this->l('Ivory Coast', true)),
      array(33, 1, $this->l('Togo', true)),
      array(34, 1, $this->l('Bolivia', true)),
      array(35, 1, $this->l('Mauritius', true)),
      array(36, 1, $this->l('Romania', true)),
      array(37, 1, $this->l('Slovakia', true)),
      array(38, 1, $this->l('Algeria', true)),
      array(39, 1, $this->l('American Samoa', true)),
      array(40, 1, $this->l('Andorra', true)),
      array(41, 1, $this->l('Angola', true)),
      array(42, 1, $this->l('Anguilla', true)),
      array(43, 1, $this->l('Antigua and Barbuda', true)),
      array(44, 1, $this->l('Argentina', true)),
      array(45, 1, $this->l('Armenia', true)),
      array(46, 1, $this->l('Aruba', true)),
      array(47, 1, $this->l('Azerbaijan', true)),
      array(48, 1, $this->l('Bahamas', true)),
      array(49, 1, $this->l('Bahrain', true)),
      array(50, 1, $this->l('Bangladesh', true)),
      array(51, 1, $this->l('Barbados', true)),
      array(52, 1, $this->l('Belarus', true)),
      array(53, 1, $this->l('Belize', true)),
      array(54, 1, $this->l('Benin', true)),
      array(55, 1, $this->l('Bermuda', true)),
      array(56, 1, $this->l('Bhutan', true)),
      array(57, 1, $this->l('Botswana', true)),
      array(58, 1, $this->l('Brazil', true)),
      array(59, 1, $this->l('Brunei', true)),
      array(60, 1, $this->l('Burkina Faso', true)),
      array(61, 1, $this->l('Burma (Myanmar)', true)),
      array(62, 1, $this->l('Burundi', true)),
      array(63, 1, $this->l('Cambodia', true)),
      array(64, 1, $this->l('Cameroon', true)),
      array(65, 1, $this->l('Cape Verde', true)),
      array(66, 1, $this->l('Central African Republic', true)),
      array(67, 1, $this->l('Chad', true)),
      array(68, 1, $this->l('Chile', true)),
      array(69, 1, $this->l('Colombia', true)),
      array(70, 1, $this->l('Comoros', true)),
      array(71, 1, $this->l('Congo, Dem. Republic', true)),
      array(72, 1, $this->l('Congo, Republic', true)),
      array(73, 1, $this->l('Costa Rica', true)),
      array(74, 1, $this->l('Croatia', true)),
      array(75, 1, $this->l('Cuba', true)),
      array(76, 1, $this->l('Cyprus', true)),
      array(77, 1, $this->l('Djibouti', true)),
      array(78, 1, $this->l('Dominica', true)),
      array(79, 1, $this->l('Dominican Republic', true)),
      array(80, 1, $this->l('East Timor', true)),
      array(81, 1, $this->l('Ecuador', true)),
      array(82, 1, $this->l('Egypt', true)),
      array(83, 1, $this->l('El Salvador', true)),
      array(84, 1, $this->l('Equatorial Guinea', true)),
      array(85, 1, $this->l('Eritrea', true)),
      array(86, 1, $this->l('Estonia', true)),
      array(87, 1, $this->l('Ethiopia', true)),
      array(88, 1, $this->l('Falkland Islands', true)),
      array(89, 1, $this->l('Faroe Islands', true)),
      array(90, 1, $this->l('Fiji', true)),
      array(91, 1, $this->l('Gabon', true)),
      array(92, 1, $this->l('Gambia', true)),
      array(93, 1, $this->l('Georgia', true)),
      array(94, 1, $this->l('Ghana', true)),
      array(95, 1, $this->l('Grenada', true)),
      array(96, 1, $this->l('Greenland', true)),
      array(97, 1, $this->l('Gibraltar', true)),
      array(98, 1, $this->l('Guadeloupe', true)),
      array(99, 1, $this->l('Guam', true)),
      array(100, 1, $this->l('Guatemala', true)),
      array(101, 1, $this->l('Guernsey', true)),
      array(102, 1, $this->l('Guinea', true)),
      array(103, 1, $this->l('Guinea-Bissau', true)),
      array(104, 1, $this->l('Guyana', true)),
      array(105, 1, $this->l('Haiti', true)),
      array(106, 1, $this->l('Heard Island and McDonald Islands', true)),
      array(107, 1, $this->l('Vatican City State', true)),
      array(108, 1, $this->l('Honduras', true)),
      array(109, 1, $this->l('Iceland', true)),
      array(110, 1, $this->l('India', true)),
      array(111, 1, $this->l('Indonesia', true)),
      array(112, 1, $this->l('Iran', true)),
      array(113, 1, $this->l('Iraq', true)),
      array(114, 1, $this->l('Man Island', true)),
      array(115, 1, $this->l('Jamaica', true)),
      array(116, 1, $this->l('Jersey', true)),
      array(117, 1, $this->l('Jordan', true)),
      array(118, 1, $this->l('Kazakhstan', true)),
      array(119, 1, $this->l('Kenya', true)),
      array(120, 1, $this->l('Kiribati', true)),
      array(121, 1, $this->l('Korea, Dem. Republic of', true)),
      array(122, 1, $this->l('Kuwait', true)),
      array(123, 1, $this->l('Kyrgyzstan', true)),
      array(124, 1, $this->l('Laos', true)),
      array(125, 1, $this->l('Latvia', true)),
      array(126, 1, $this->l('Lebanon', true)),
      array(127, 1, $this->l('Lesotho', true)),
      array(128, 1, $this->l('Liberia', true)),
      array(129, 1, $this->l('Libya', true)),
      array(130, 1, $this->l('Liechtenstein', true)),
      array(131, 1, $this->l('Lithuania', true)),
      array(132, 1, $this->l('Macau', true)),
      array(133, 1, $this->l('Macedonia', true)),
      array(134, 1, $this->l('Madagascar', true)),
      array(135, 1, $this->l('Malawi', true)),
      array(136, 1, $this->l('Malaysia', true)),
      array(137, 1, $this->l('Maldives', true)),
      array(138, 1, $this->l('Mali', true)),
      array(139, 1, $this->l('Malta', true)),
      array(140, 1, $this->l('Marshall Islands', true)),
      array(141, 1, $this->l('Martinique', true)),
      array(142, 1, $this->l('Mauritania', true)),
      array(143, 1, $this->l('Hungary', true)),
      array(144, 1, $this->l('Mayotte', true)),
      array(145, 1, $this->l('Mexico', true)),
      array(146, 1, $this->l('Micronesia', true)),
      array(147, 1, $this->l('Moldova', true)),
      array(148, 1, $this->l('Monaco', true)),
      array(149, 1, $this->l('Mongolia', true)),
      array(150, 1, $this->l('Montenegro', true)),
      array(151, 1, $this->l('Montserrat', true)),
      array(152, 1, $this->l('Morocco', true)),
      array(153, 1, $this->l('Mozambique', true)),
      array(154, 1, $this->l('Namibia', true)),
      array(155, 1, $this->l('Nauru', true)),
      array(156, 1, $this->l('Nepal', true)),
      array(157, 1, $this->l('Netherlands Antilles', true)),
      array(158, 1, $this->l('New Caledonia', true)),
      array(159, 1, $this->l('Nicaragua', true)),
      array(160, 1, $this->l('Niger', true)),
      array(161, 1, $this->l('Niue', true)),
      array(162, 1, $this->l('Norfolk Island', true)),
      array(163, 1, $this->l('Northern Mariana Islands', true)),
      array(164, 1, $this->l('Oman', true)),
      array(165, 1, $this->l('Pakistan', true)),
      array(166, 1, $this->l('Palau', true)),
      array(167, 1, $this->l('Palestinian Territories', true)),
      array(168, 1, $this->l('Panama', true)),
      array(169, 1, $this->l('Papua New Guinea', true)),
      array(170, 1, $this->l('Paraguay', true)),
      array(171, 1, $this->l('Peru', true)),
      array(172, 1, $this->l('Philippines', true)),
      array(173, 1, $this->l('Pitcairn', true)),
      array(174, 1, $this->l('Puerto Rico', true)),
      array(175, 1, $this->l('Qatar', true)),
      array(176, 1, $this->l('Reunion Island', true)),
      array(177, 1, $this->l('Russian Federation', true)),
      array(178, 1, $this->l('Rwanda', true)),
      array(179, 1, $this->l('Saint Barthelemy', true)),
      array(180, 1, $this->l('Saint Kitts and Nevis', true)),
      array(181, 1, $this->l('Saint Lucia', true)),
      array(182, 1, $this->l('Saint Martin', true)),
      array(183, 1, $this->l('Saint Pierre and Miquelon', true)),
      array(184, 1, $this->l('Saint Vincent and the Grenadines', true)),
      array(185, 1, $this->l('Samoa', true)),
      array(186, 1, $this->l('San Marino', true)),
      array(187, 1, $this->l('São Tomé and Príncipe', true)),
      array(188, 1, $this->l('Saudi Arabia', true)),
      array(189, 1, $this->l('Senegal', true)),
      array(190, 1, $this->l('Serbia', true)),
      array(191, 1, $this->l('Seychelles', true)),
      array(192, 1, $this->l('Sierra Leone', true)),
      array(193, 1, $this->l('Slovenia', true)),
      array(194, 1, $this->l('Solomon Islands', true)),
      array(195, 1, $this->l('Somalia', true)),
      array(196, 1, $this->l('South Georgia and the South Sandwich Islands', true)),
      array(197, 1, $this->l('Sri Lanka', true)),
      array(198, 1, $this->l('Sudan', true)),
      array(199, 1, $this->l('Suriname', true)),
      array(200, 1, $this->l('Svalbard and Jan Mayen', true)),
      array(201, 1, $this->l('Swaziland', true)),
      array(202, 1, $this->l('Syria', true)),
      array(203, 1, $this->l('Taiwan', true)),
      array(204, 1, $this->l('Tajikistan', true)),
      array(205, 1, $this->l('Tanzania', true)),
      array(206, 1, $this->l('Thailand', true)),
      array(207, 1, $this->l('Tokelau', true)),
      array(208, 1, $this->l('Tonga', true)),
      array(209, 1, $this->l('Trinidad and Tobago', true)),
      array(210, 1, $this->l('Tunisia', true)),
      array(211, 1, $this->l('Turkey', true)),
      array(212, 1, $this->l('Turkmenistan', true)),
      array(213, 1, $this->l('Turks and Caicos Islands', true)),
      array(214, 1, $this->l('Tuvalu', true)),
      array(215, 1, $this->l('Uganda', true)),
      array(216, 1, $this->l('Ukraine', true)),
      array(217, 1, $this->l('United Arab Emirates', true)),
      array(218, 1, $this->l('Uruguay', true)),
      array(219, 1, $this->l('Uzbekistan', true)),
      array(220, 1, $this->l('Vanuatu', true)),
      array(221, 1, $this->l('Venezuela', true)),
      array(222, 1, $this->l('Vietnam', true)),
      array(223, 1, $this->l('Virgin Islands (British)', true)),
      array(224, 1, $this->l('Virgin Islands (U.S.)', true)),
      array(225, 1, $this->l('Wallis and Futuna', true)),
      array(226, 1, $this->l('Western Sahara', true)),
      array(227, 1, $this->l('Yemen', true)),
      array(228, 1, $this->l('Zambia', true)),
      array(229, 1, $this->l('Zimbabwe', true)),
      array(230, 1, $this->l('Albania', true)),
      array(231, 1, $this->l('Afghanistan', true)),
      array(232, 1, $this->l('Antarctica', true)),
      array(233, 1, $this->l('Bosnia and Herzegovina', true)),
      array(234, 1, $this->l('Bouvet Island', true)),
      array(235, 1, $this->l('British Indian Ocean Territory', true)),
      array(236, 1, $this->l('Bulgaria', true)),
      array(237, 1, $this->l('Cayman Islands', true)),
      array(238, 1, $this->l('Christmas Island', true)),
      array(239, 1, $this->l('Cocos (Keeling) Islands', true)),
      array(240, 1, $this->l('Cook Islands', true)),
      array(241, 1, $this->l('French Guiana', true)),
      array(242, 1, $this->l('French Polynesia', true)),
      array(243, 1, $this->l('French Southern Territories', true)),
      array(244, 1, $this->l('Åland Islands', true)),
      array(245, 1, $this->l('Online', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'contact_lang';
    $table->fields = array('id_contact', 'id_lang', 'name', 'description');
    $table->flags = array(0, 0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Webmaster', true), $this->l('If a technical problem occurs on this website', true)),
      array(2, 1, $this->l('Customer service', true), $this->l('For any question about a product, an order', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'profile_lang';
    $table->fields = array('id_lang', 'id_profile', 'name');
    $table->flags = array(0, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('SuperAdmin', true)),
      array(1, 2, $this->l('Logistician', true)),
      array(1, 3, $this->l('Translator', true)),
      array(1, 4, $this->l('Salesman', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'quick_access_lang';
    $table->fields = array('id_quick_access', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('New category', true)),
      array(2, 1, $this->l('New product', true)),
      array(3, 1, $this->l('New voucher', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'order_return_state_lang';
    $table->fields = array('id_order_return_state', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Waiting for confirmation', true)),
      array(2, 1, $this->l('Waiting for package', true)),
      array(3, 1, $this->l('Package received', true)),
      array(4, 1, $this->l('Return denied', true)),
      array(5, 1, $this->l('Return completed', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'meta_lang';
    $table->fields = array('id_meta', 'id_shop', 'id_lang', 'title', 'description', 'keywords', 'url_rewrite');
    $table->flags = array(0, 0, 0, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, 1, $this->l('404 error', true), $this->l('This page cannot be found', true), '', $this->l('page-not-found', true)),
      array(2, 1, 1, $this->l('Best sales', true), $this->l('Our best sales', true), '', $this->l('best-sales', true)),
      array(3, 1, 1, $this->l('Contact us', true), $this->l('Use our form to contact us', true), '', $this->l('contact-us', true)),
      array(4, 1, 1, '', $this->l('Shop powered by PrestaShop', true), '', ''),
      array(5, 1, 1, $this->l('Manufacturers', true), $this->l('Manufacturers list', true), '', $this->l('manufacturers', true)),
      array(6, 1, 1, $this->l('New products', true), $this->l('Our new products', true), '', $this->l('new-products', true)),
      array(7, 1, 1, $this->l('Forgot your password', true), $this->l('Enter your e-mail address used to register in goal to get e-mail with your new password', true), '', $this->l('password-recovery', true)),
      array(8, 1, 1, $this->l('Prices drop', true), $this->l('Our special products', true), '', $this->l('prices-drop', true)),
      array(9, 1, 1, $this->l('Sitemap', true), $this->l('Lost ? Find what your are looking for', true), '', $this->l('sitemap', true)),
      array(10, 1, 1, $this->l('Suppliers', true), $this->l('Suppliers list', true), '', $this->l('supplier', true)),
      array(11, 1, 1, $this->l('Address', true), '', '', $this->l('address', true)),
      array(12, 1, 1, $this->l('Addresses', true), '', '', $this->l('addresses', true)),
      array(13, 1, 1, $this->l('Login', true), '', '', $this->l('login', true)),
      array(14, 1, 1, $this->l('Cart', true), '', '', $this->l('cart', true)),
      array(15, 1, 1, $this->l('Discount', true), '', '', $this->l('discount', true)),
      array(16, 1, 1, $this->l('Order history', true), '', '', $this->l('order-history', true)),
      array(17, 1, 1, $this->l('Identity', true), '', '', $this->l('identity', true)),
      array(18, 1, 1, $this->l('My account', true), '', '', $this->l('my-account', true)),
      array(19, 1, 1, $this->l('Order follow', true), '', '', $this->l('order-follow', true)),
      array(20, 1, 1, $this->l('Order slip', true), '', '', $this->l('order-slip', true)),
      array(21, 1, 1, $this->l('Order', true), '', '', $this->l('order', true)),
      array(22, 1, 1, $this->l('Search', true), '', '', $this->l('search', true)),
      array(23, 1, 1, $this->l('Stores', true), '', '', $this->l('stores', true)),
      array(24, 1, 1, $this->l('Order', true), '', '', $this->l('quick-order', true)),
      array(25, 1, 1, $this->l('Guest tracking', true), '', '', $this->l('guest-tracking', true)),
      array(26, 1, 1, $this->l('Order confirmation', true), '', '', $this->l('order-confirmation', true)),
      array(27, 0, 1, NULL, NULL, NULL, ''),
      array(28, 0, 1, NULL, NULL, NULL, ''),
      array(29, 0, 1, NULL, NULL, NULL, ''),
      array(30, 0, 1, NULL, NULL, NULL, ''),
      array(31, 0, 1, NULL, NULL, NULL, ''),
      array(32, 0, 1, NULL, NULL, NULL, ''),
      array(33, 0, 1, NULL, NULL, NULL, ''),
      array(34, 1, 1, $this->l('Products Comparison', true), '', '', $this->l('products-comparison', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'cms_category_lang';
    $table->fields = array('id_cms_category', 'id_lang', 'name', 'description', 'link_rewrite', 'meta_title', 'meta_keywords', 'meta_description');
    $table->flags = array(0, 0, 1, 1, 1, 1, 1, 1);
    $table->data = array(
      array(1, 1, $this->l('Home', true), '', $this->l('home', true), '', '', ''));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'carrier_lang';
    $table->fields = array('id_carrier', 'id_shop', 'id_lang', 'delay');
    $table->flags = array(0, 0, 0, 1);
    $table->data = array(
      array(1, 1, 1, $this->l('Pick up in-store', true)),
      array(2, 1, 1, $this->l('Delivery next day!', true)),
      array(3, 1, 1, $this->l('Pick up in-store', true)),
      array(4, 1, 1, $this->l('Pick up in-store', true)),
      array(5, 1, 1, $this->l('Delivery next day!', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'group_lang';
    $table->fields = array('id_group', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Visitor', true)),
      array(2, 1, $this->l('Guest', true)),
      array(3, 1, $this->l('Customer', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'stock_mvt_reason_lang';
    $table->fields = array('id_stock_mvt_reason', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Increase', true)),
      array(2, 1, $this->l('Decrease', true)),
      array(3, 1, $this->l('Customer Order', true)),
      array(4, 1, $this->l('Regulation following an inventory of stock', true)),
      array(5, 1, $this->l('Regulation following an inventory of stock', true)),
      array(6, 1, $this->l('Transfer to another warehouse', true)),
      array(7, 1, $this->l('Transfer from another warehouse', true)),
      array(8, 1, $this->l('Supply Order', true)));
    $tables[] = $table;

    $table = new StdClass();
    $table->name = 'gender_lang';
    $table->fields = array('id_gender', 'id_lang', 'name');
    $table->flags = array(0, 0, 1);
    $table->data = array(
      array(1, 1, $this->l('Mr.', true)),
      array(2, 1, $this->l('Mrs.', true)));
    $tables[] = $table;

    return $tables;
  }

  public function translate()
  {
    if ($this->later)
      die('Unhandled version');
    elseif ($this->v16) {
      if (_PS_VERSION_ < "1.6.0.11")
	die('Unhandled version');
      $tables = self::getTables16();
    }
    elseif ($this->v15)
      $tables = self::getTables15();
    elseif ($this->v14)
      $tables = self::getTables14();
    elseif ($this->v13)
      $tables = self::getTables13();
    else
      die('Unhandled version');
    $langs = language::getlanguages();
    $this->_html .= '<table class="table">';
    $this->_html .= '<tr>';
    $this->_html .= '<th>'.$this->l('Language').'</th>';
    $this->_html .= '<th>'.$this->l('Table name').'</th>';
    $this->_html .= '<th>'.$this->l('Texts total').'</th>';
    $this->_html .= '<th>'.$this->l('Texts translated').'</th>';
    $this->_html .= '<th>'.$this->l('Texts updated').'</th>';
    $this->_html .= '</tr>';
    foreach ($langs as $lang) {
      $id_lang = $lang['id_lang'];
      if (tools::getisset('lang_'.$id_lang)) {
	foreach ($tables as $table) {
	  $totalTexts = 0;
	  $validTexts = 0;
	  $updatedTexts = 0;
	  foreach ($table->data as $data) {
	    if ($table->name == 'lang') {
	      $data[0] = $id_lang;
	      $row = Db::getInstance()->getRow("SELECT * FROM `".
		_DB_PREFIX_.$table->name."` WHERE `".
		$table->fields[0]."` = ".$data[0]);
	    }
	    elseif ($table->fields[0] == 'id_lang') {
	      $data[0] = $id_lang;
	      $row = Db::getInstance()->getRow("SELECT * FROM `".
		_DB_PREFIX_.$table->name."` WHERE `".
		$table->fields[0]."` = ".$data[0]." AND `".
		$table->fields[1]."` = ".$data[1]);
	    }
	    elseif ($table->fields[1] == 'id_lang') {
	      $data[1] = $id_lang;
	      $row = Db::getInstance()->getRow("SELECT * FROM `".
		_DB_PREFIX_.$table->name."` WHERE `".
		$table->fields[0]."` = ".$data[0]." AND `".
		$table->fields[1]."` = ".$data[1]);
	    }
	    elseif ($table->fields[2] == 'id_lang') {
	      $data[2] = $id_lang;
	      $row = Db::getInstance()->getRow("SELECT * FROM `".
		_DB_PREFIX_.$table->name."` WHERE `".
		$table->fields[0]."` = ".$data[0]." AND `".
		$table->fields[1]."` = ".$data[1]." AND `".
		$table->fields[2]."` = ".$data[2]);
	    }
	    else {
	      die("Mismatch");
	    }
	    $v = 0;
	    for ($i = 0; $i < count($table->flags); $i++) {
	      if ($table->flags[$i]) {
		$totalTexts++;
		$t = self::translateString($data[$i], $id_lang);
		if (!empty($row[$table->fields[$i]]))
		  $data[$i] = $row[$table->fields[$i]];
		if ($t) {
		  $validTexts++;
		  if ($data[$i] != $t) {
		    $data[$i] = pSQL($t);
		    $v++;
		  }
		}
	      }
	      else {
		if (!empty($row[$table->fields[$i]]))
		  $data[$i] = $row[$table->fields[$i]];
	      }
	    }
	    if ($table->name == 'lang') {
	      Db::getInstance()->Execute("DELETE FROM `".
		_DB_PREFIX_.$table->name."` WHERE `".
		$table->fields[0]."` = ".$data[0]);
	    }
	    elseif ($table->fields[0] == 'id_lang') {
	      Db::getInstance()->Execute("DELETE FROM `".
		_DB_PREFIX_.$table->name."` WHERE `".
		$table->fields[0]."` = ".$data[0]." AND `".
		$table->fields[1]."` = ".$data[1]);
	    }
	    elseif ($table->fields[1] == 'id_lang') {
	      Db::getInstance()->Execute("DELETE FROM `".
		_DB_PREFIX_.$table->name."` WHERE `".
		$table->fields[0]."` = ".$data[0]." AND `".
		$table->fields[1]."` = ".$data[1]);
	    }
	    elseif ($table->fields[2] == 'id_lang') {
	      Db::getInstance()->Execute("DELETE FROM `".
		_DB_PREFIX_.$table->name."` WHERE `".
		$table->fields[0]."` = ".$data[0]." AND `".
		$table->fields[1]."` = ".$data[1]." AND `".
		$table->fields[2]."` = ".$data[2]);
	    }
	    else {
	      die("Mismatch");
	    }
	    $result = Db::getInstance()->Execute("INSERT INTO `".
	      _DB_PREFIX_.$table->name."` (`".
	      implode("`, `", $table->fields).
	      "`) VALUES ('".
	      implode("', '", $data).
	      "')");
	    if ($result)
	      $updatedTexts += $v;
	  }
	  $this->_html .= '<tr>';
	  $this->_html .= '<td>'.$lang['iso_code'].'</td>';
	  $this->_html .= '<td>'.$table->name.'</td>';
	  $this->_html .= '<td class="right">'.$totalTexts.'</td>';
	  $this->_html .= '<td class="right">'.$validTexts.'</td>';
	  $this->_html .= '<td class="right">'.$updatedTexts.'</td>';
	  $this->_html .= '</tr>';
	}
      }
    }
    $this->_html .= "</table>\n";
  }
}

?>
