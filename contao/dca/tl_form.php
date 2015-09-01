<?php


\Controller::loadDataContainer('tl_content');

$GLOBALS['TL_DCA']['tl_form']['fields']['newsletterModule'] = array
(
		'label'                   => &$GLOBALS['TL_LANG']['tl_form']['newsletterModule'],
		'exclude'                 => true,
		'inputType'               => 'select',
		'options_callback'        => array('tl_form_imi_newsletter', 'getModules'),
		'eval'                    => array('mandatory'=>false, 'chosen'=>true, 'submitOnChange'=>true, 'helpwizard'=>true,),
		'wizard'                  => array(array('tl_content', 'editModule')),
		'explanation'             => 'newsletterModule',
		'sql'                     => "int(10) unsigned NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_form']['palettes']['default'] =  str_replace('jumpTo', 'jumpTo,newsletterModule', $GLOBALS['TL_DCA']['tl_form']['palettes']['default'] );

class tl_form_imi_newsletter extends \Backend {
	/**
	 * Fetch all newsletter subscribe modules
	 * @return array
	 */
	public function getModules()
	{
		$arrModules = array(0 => $GLOBALS['TL_LANG']['tl_form']['newsletterModule_inactive']);
		$objModules = $this->Database->execute("
			SELECT m.id, m.name, t.name AS theme
				FROM tl_module m
				LEFT JOIN tl_theme t ON m.pid=t.id
				WHERE type = 'subscribe'
				ORDER BY t.name, m.name
		");

		while ($objModules->next())
		{
			$arrModules[$objModules->theme][$objModules->id] = $objModules->name . ' (ID ' . $objModules->id . ')';
		}

		return $arrModules;
	}

}