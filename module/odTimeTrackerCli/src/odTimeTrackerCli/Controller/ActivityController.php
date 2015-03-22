<?php
/**
 * odTimeTracker CLI
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-cli for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace odTimeTrackerCli\Controller;

//use Zend\Console\Request as ConsoleRequest;
use Zend\Console\ColorInterface as ConsoleColor;

/**
 * Activity controller.
 *
 * @package odTimeTrackerCli
 * @subpackage Controller
 * @author Ondrej Donek, <ondrejd@gmail.com>
 */
class ActivityController extends CommonController
{
	/**
	 * Start activity
	 *
	 * @return void
	 */
	public function startAction()
	{
		$console = $this->getServiceLocator()->get('console');

		$console->writeLine('OK', ConsoleColor::GREEN);
	}

	/**
	 * Stop activity
	 *
	 * @return void
	 */
	public function stopAction()
	{
		$console = $this->getServiceLocator()->get('console');

		$console->writeLine('OK', ConsoleColor::GREEN);
	}
}
