<?php
/**
 *  Leo Prestashop Blockleoblogs for Prestashop 1.6.x
 *
 * @package   blockleoblogs
 * @version   3.0
 * @author    http://www.leotheme.com
 * @copyright Copyright (C) October 2013 LeoThemes.com <@emai:leotheme@gmail.com>
 *               <info@leotheme.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!class_exists('LeoblogHelper'))
{

	class LeoblogHelper
	{

		/**
		 * Check file tpl for new library : Owl_carousel
		 */
		public static function processWidgetType($hook_name, $key_widget, $type, $data)
		{
			if (!isset($data['carousel_type']))
			{
				# validate module
				return $type; // version doesnt has owl carousel
			}

			if ($data['carousel_type'] == LeoblogOwlCarousel::CAROUSEL_OWL)
			{
				// widget_carousel_owl.tpl
				$type .= '_owl';
			}

			# validate module
			unset($hook_name);
			unset($key_widget);

			return $type;
		}

		public static function enableLoadOwlCarouselLib($data)
		{
			if (!isset($data['carousel_type']))
			{
				# validate module
				return false; // version doesnt has owl carousel
			}

			if ($data['carousel_type'] == LeoblogOwlCarousel::CAROUSEL_OWL)
			{
				# validate module
				return true;
			}
			return false;
		}

	}
}