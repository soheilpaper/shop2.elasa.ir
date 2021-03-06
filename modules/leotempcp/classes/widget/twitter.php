<?php

/* * ****************************************************
 *  Leo Prestashop Theme Framework for Prestashop 1.5.x
 *
 * @package   leotempcp
 * @version   3.0
 * @author    http://www.leotheme.com
 * @copyright Copyright (C) October 2013 LeoThemes.com <@emai:leotheme@gmail.com>
 *               <info@leotheme.com>.All rights reserved.
 * @license   GNU General Public License version 2
 * ***************************************************** */

class LeoWidgetTwitter extends LeoWidgetBase {

    public $name = 'twitter';
	public $for_module = 'all';	
	
    public function getWidgetInfo() {
        return array('label' => $this->l('Twitter Widget'), 'explain' => 'Get Latest Twitter TimeLife');
    }

    public function renderForm($args, $data) {


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

        $default_lang = (int) Configuration::get('PS_LANG_DEFAULT');

        $helper->tpl_vars = array(
            'fields_value' => $this->getConfigFieldsValues($data),
            'languages' => Context::getContext()->controller->getLanguages(),
            'id_language' => $default_lang
        );
        return $helper->generateForm($this->fields_form);
    }

    public function renderContent($args, $setting) {

        $t = array(
            'name' => '',
            'twidget_id' => '477627952327188480',
            'count' => 2,
            'username' => 'leotheme',
            'theme' => 'light',
            'border_color' => '#000',
		'link_color' => '#000',
		'text_color' => '#000',
		'name_color' => '#000',
		'mail_color' => '#000',
            'width' => 180,
            'height' => 200,
            'show_replies' => 0,
            'show_header' => 0,
            'show_footer' => 0,
            'show_border' => 0,
            'show_scrollbar' => 0,
			'transparent' => 0,
        );

        $setting = array_merge($t, $setting);

        $setting['chrome'] = '';

        if (isset($setting['show_header']) && $setting['show_header'] == 0) {
            $setting['chrome'] .= 'noheader ';
        }
        if ($setting['show_footer'] == 0) {
            $setting['chrome'] .= 'nofooter ';
        }
        if ($setting['show_border'] == 0) {
            $setting['chrome'] .= 'noborders ';
        }

        if ($setting['transparent'] == 0) {
            $setting['chrome'] .= 'transparent';
        }
		$setting['iso_code'] = Context::getContext()->language->iso_code;
        $setting['js'] = '<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>';
        $output = array('type' => 'twitter', 'data' => $setting);
        return $output;
    }

}

?>