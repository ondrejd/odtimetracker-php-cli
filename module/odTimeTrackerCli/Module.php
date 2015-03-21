<?php
/**
 * odTimeTracker CLI
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-cli for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace odTimeTrackerCli;

use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Console\Adapter\AdapterInterface as Console;

/**
 * Main module's class.
 *
 * @package odTimeTrackerCli
 * @author Ondrej Donek, <ondrejd@gmail.com>
 */
class Module implements ConsoleBannerProviderInterface, ConsoleUsageProviderInterface
{
	/**
	 * Returns module configuration.
	 *
	 * @return array
	 */
	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}

	/**
	 * Returns autoloader configuration.
	 *
	 * @return array
	 */
	public function getAutoloaderConfig()
	{
		return array(
			'Zend\Loader\StandardAutoloader' => array(
				'namespaces' => array(
					__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__
				),
			),
		);
	}

	/**
	 * Returns console banner.
	 *
	 * @param Console $console
	 * @return string
	 * @todo Print console banner allways! Should be doable through MVC events.
	 */
	public function getConsoleBanner(Console $console)
	{
		return 'odTimeTracker';
	}

	/**
	 * Returns script usage informations.
	 *
	 * @param Console $console
	 * @return array
	 */
	public function getConsoleUsage(Console $console)
	{
		return array(
			'Main usage',
			'info' => 'Info about current application\'s state',
//			'help [<topic>]' => 'Display help (general or on given topic)',
//			array('<topic>', 'Could be name of command or some other keywords (\'activity-string\' for example)'),
			'start <activityString>' => 'Start new activity',
			array('<activityString>', 'Definition of a new activity'),
			'stop' => 'Stop currently running activity',
//			array('--verbose|-v', 'Turn on verbose mode'),
		);
	}
}

