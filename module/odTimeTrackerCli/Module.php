<?php
/**
 * odTimeTracker CLI
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-cli for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace odTimeTrackerCli;

use Zend\Console\Adapter\AdapterInterface as Console;
use Zend\ModuleManager\Feature\ConsoleBannerProviderInterface;
use Zend\ModuleManager\Feature\ConsoleUsageProviderInterface;
use Zend\Mvc\MvcEvent;

/**
 * Main module's class.
 *
 * @package odTimeTrackerCli
 * @author Ondrej Donek, <ondrejd@gmail.com>
 */
class Module implements ConsoleBannerProviderInterface, ConsoleUsageProviderInterface
{
	/**
	 * @var \Zend\I18n\Translator\Translator $translator
	 */
	private $translator;

	/**
	 * Bootstrap module.
	 *
	 * @param MvcEvent $event
	 * @return void
	 * @todo Don't forgot to remove `setLocale('cs_CZ')`!
	 */
	public function onBootstrap(MvcEvent $event)
	{
		$this->translator = $event->getApplication()->getServiceManager()->get('translator');
		$this->translator->setLocale('cs_CZ');
	}

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
			$this->translator->translate('Main usage'),
			'info' => $this->translator->translate('Info about current application\'s state'),
			'install' => $this->translator->translate('Installation and configuration wizard'),
//			'help [<topic>]' => $this->translator->translate('Display help (general or on given topic)'),
//			array('<topic>', $this->translator->translate('Could be name of command or some other keywords (\'activity-string\' for example)')),
			'start <activityString>' => $this->translator->translate('Start new activity'),
			array('<activityString>', $this->translator->translate('Definition of a new activity')),
			'stop' => $this->translator->translate('Stop currently running activity'),
//			array('--verbose|-v', $this->translator->translate('Turn on verbose mode')),
		);
	}
}

