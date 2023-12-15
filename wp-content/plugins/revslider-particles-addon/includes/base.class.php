<?php
/* 
 * @author    ThemePunch <info@themepunch.com>
 * @link      http://www.themepunch.com/
 * @copyright 2021 ThemePunch
*/

if(!defined('ABSPATH')) exit();

require_once(RS_PARTICLES_PLUGIN_PATH . 'framework/base.class.php');

class RsParticlesBase extends RsAddOnParticlesBase {
	
	protected static $_PluginPath    = RS_PARTICLES_PLUGIN_PATH,
					 $_PluginUrl     = RS_PARTICLES_PLUGIN_URL,
					 $_PluginTitle   = 'particles',
				     $_FilePath      = __FILE__,
				     $_Version       = '3.3.2';
	
	public function __construct() {
		
		//load the textdomain, if the plugin should be translateable
		parent::_loadPluginTextDomain();
		
		// check to make sure all requirements are met
		$notice = $this->systemsCheck();
		if($notice) {
			
			require_once(RS_PARTICLES_PLUGIN_PATH . 'framework/notices.class.php');
			
			new RsAddOnParticlesNotice($notice, static::$_PluginTitle, static::$_Version);
			return;
			
		}
		
		parent::loadClasses();

	}

}
?>