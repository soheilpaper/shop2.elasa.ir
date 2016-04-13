Google Maps PrestaShop 1.5 Module by SmartProjects.pl - Version 1.0

1. Unzip 'googlemaps' in 'modules' directory of your PrestaShop 1.5

2. In file: /themes/YOUR-THEME-NAME/contact-form.tpl insert code:

{$HOOK_CONTACT_FORM}

in place where shoud appear a map.

3. In file: controllers/front/ContactController.php insert the code:

$this->context->smarty->assign(array('HOOK_CONTACT_FORM' => Module::hookExec('Contactform')));

right before line with this code (about 256 line):

$this->setTemplate(_PS_THEME_DIR_.'contact-form.tpl');

4. Install module as usual (ignore errors when appear durring the installation)

5. Join ContactForm hook with this module on AdminModulesPositions page.

6. In the configuration page of this module fill all 3 Fields


Any suggestions or questions: 
maciejkardas [~/at/ /~] smartprojects.pl

____________________________________
by www.smartprojects.pl 2014

This module is released under the MIT, BSD, and GPL Licenses, so you can share, redistribute, sell, modify etc. this code whatever you want.

This module is provided without guarantee. This is a prototype version for private use now available for public. 

All Google's names used in this module are propety of Google Inc.

Enjoy
