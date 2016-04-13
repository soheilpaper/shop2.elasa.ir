<?php
/**
 *  Leo Theme for Prestashop 1.6.x
 *
 * @author    http://www.leotheme.com
 * @copyright Copyright (C) October 2013 LeoThemes.com <@emai:leotheme@gmail.com>
 *               <info@leotheme.com>.All rights reserved.
 * @license   GNU General Public License version 2
 */

if (!class_exists('LeomanagewidgetsHelper'))
{

	class LeomanagewidgetsHelper
	{
		const NUMBER_CACHE_FILE = 4;
		/**
		 * Check file tpl for new library : Owl_carousel
		 */
		public static function processWidgetType($hook_name, $key_widget, $type, $data)
		{
			if (!isset($data['carousel_type']))
				return $type; // version doesnt has owl carousel

			if ($data['carousel_type'] == LeomanagewidgetsOwlCarousel::CAROUSEL_OWL)
			{
				// widget_carousel_owl.tpl
				$type .= '_owl';
			}

			return $type;
		}

		public static function enableLoadOwlCarouselLib($data)
		{
			if (!isset($data['carousel_type']))
				return false; // version doesnt has owl carousel

			if ($data['carousel_type'] == LeomanagewidgetsOwlCarousel::CAROUSEL_OWL)
				return true;

			return false;
		}
		
		public static function getCookie()
		{
			$data = $_COOKIE;
			return $data;
		}

		public static function getPost(){
			$data = $_POST;
			return $data;
		}

		public static function getGet(){
			$data = $_GET;
			return $data;
		}

	}
}	
