<?php
/**
 * odTimeTracker CLI
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-cli for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace odTimeTrackerCli\Controller;

use Zend\Console\Request as ConsoleRequest;
use Zend\Console\ColorInterface as ConsoleColor;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Main controller.
 *
 * @package odTimeTrackerCli
 * @subpackage Controller
 * @author Ondrej Donek, <ondrejd@gmail.com>
 */
class IndexController extends AbstractActionController
{
	/**
	 * Main action
	 *
	 * @return void
	 */
	public function indexAction()
	{
		$console = $this->getServiceLocator()->get('console');

		$console->writeLine('OK', ConsoleColor::LIGHT_GREEN);
	}
}
