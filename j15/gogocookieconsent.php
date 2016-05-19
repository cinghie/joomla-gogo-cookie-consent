<?php

/**
 * @copyright Copyright &copy; Gogodigital Srls
 * @company Gogodigital Srls - Wide ICT Solutions
 * @website http://www.gogodigital.it
 * @email info@gogodigital.it
 * @github https://github.com/cinghie/joomla-gogo-cookie-consent
 * @license GNU GENERAL PUBLIC LICENSE VERSION 2
 * @package Joomla Gogodigital Cookie Consent
 * @version 1.5.0
 */

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport('joomla.plugin.plugin');

class plgSystemGogocookieconsent extends JPlugin 
{
	function plgSystemGogocookieconsent( &$subject, $config ) 
	{	
		parent::__construct($subject, $config);
	}
	
	function onBeforeRender() 
	{
		$app = &JFactory::getApplication();		
		$doc = &JFactory::getDocument();
		
		if ($app->isAdmin()) {
			return;
		}
		
		$cookieScript = 'window.cookieconsent_options = {
			"message":"'.$this->params->get("cookieMessage","This website uses cookies to ensure you get the best experience on our website").'",
			"dismiss":"'.$this->params->get("cookieDismiss","Got It!").'",
			"learnMore":"'.$this->params->get("cookieMore","More Info").'",';

		if(!$this->params->get("cookieLink")) {
			$cookieScript .= '
				"link": null,';
		} else {
			$cookieScript .= '
				"link":"'.$this->params->get("cookieLink").'",';
		}

		$cookieScript .= '
			"theme":"'.$this->params->get("cookieTheme","dark-bottom").'"
		};';
		
		$doc->addScript('//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/1.0.9/cookieconsent.min.js');
		$doc->addScriptDeclaration($cookieScript);
	}	
	
}
	
