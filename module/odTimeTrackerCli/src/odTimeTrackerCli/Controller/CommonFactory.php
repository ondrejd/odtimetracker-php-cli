<?php
/**
 * odTimeTracker CLI
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-cli for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace odTimeTrackerCli\Controller;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Common factory for all our constructors.
 *
 * @package odTimeTrackerCli
 * @subpackage Controller
 * @author Ondrej Donek, <ondrejd@gmail.com>
 * @todo Use exceptions of our own namespace!
 */
class CommonFactory implements FactoryInterface
{
	/**
	 * @var ServiceLocatorInterface
	 */
	private $serviceLocator;

	/**
	 * @var \Zend\I18n\Translator\Translator
	 */
	private $translator;

	/**
	 * Create instance of correct controller.
	 *
	 * @param ServiceLocatorInterface $serviceLocator
	 * @return \epcz\Controller\CommonController
	 * @throws \InvalidArgumentException
	 * @throws \Exception
	 */
	public function createService(ServiceLocatorInterface $serviceLocator)
	{
		if (func_num_args() != 3) {
			throw new \InvalidArgumentException(
				'Unable to initialize controller using CommonFactory (wrong arguments)!'
			);
		}

		$this->serviceLocator = $serviceLocator;

		$args = func_get_args();
		$className = $args[2] . 'Controller';

		if (!class_exists($className)) {
			throw new \Exception(
				'Unable to initialize controller using CommonFactory (class "' .
				$className . '" does not exist)!'
			);
		}

		return new $className($this->getTranslator());
	}

	/**
	 * Retrieve translator.
	 *
	 * @return \Zend\I18n\Translator\Translator
	 */
	private function getTranslator()
	{
		if (!($this->translator instanceof \Zend\I18n\Translator\Translator)) {
			$this->translator = $this->serviceLocator->getServiceLocator()->get('translator');
		}

		return $this->translator;
	}
}
