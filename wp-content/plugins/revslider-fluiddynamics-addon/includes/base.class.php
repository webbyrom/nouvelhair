<?php
/* 
 * @author    ThemePunch <info@themepunch.com>
 * @link      http://www.themepunch.com/
 * @copyright 2022 ThemePunch
*/

if(!defined('ABSPATH')) exit();

require_once(RS_FLUIDDYNAMICS_PLUGIN_PATH . 'framework/base.class.php');

class RsTheFluidDynamicsBase extends RsAddOnTheFluidDynamicsBase {
	
	protected static $_PluginPath    = RS_FLUIDDYNAMICS_PLUGIN_PATH,
					 $_PluginUrl     = RS_FLUIDDYNAMICS_PLUGIN_URL,
					 $_PluginTitle   = 'fluiddynamics',
				     $_FilePath      = __FILE__,
				     $_Version       = '1.0.0';
	
	public function __construct() {
		
		//load the textdomain, if the plugin should be translateable
		parent::_loadPluginTextDomain();
		
		// check to make sure all requirements are met
		$notice = $this->systemsCheck();
		if($notice) {
			
			require_once(RS_FLUIDDYNAMICS_PLUGIN_PATH . 'framework/notices.class.php');
			
			new RsAddOnTheFluidDynamicsNotice($notice, static::$_PluginTitle, static::$_Version);
			return;
			
		}
		
		parent::loadClasses();

	}

}
?>