<?php
/**
 * odTimeTracker CLI
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-cli for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace odTimeTrackerCli\Controller;

use odTimeTrackerLib\Db;
use Zend\Console\ColorInterface as ConsoleColor;

/**
 * Main controller.
 *
 * @package odTimeTrackerCli
 * @subpackage Controller
 * @author Ondrej Donek, <ondrejd@gmail.com>
 */
class IndexController extends CommonController
{
	/**
	 * Main action
	 *
	 * @return void
	 */
	public function indexAction()
	{
		$console = $this->getServiceLocator()->get('console');
		$activityTable = new Db\TableGateway\ActivityTable();

		try {
			$runningActivity = $activityTable->getRunningActivity();

			if ($runningActivity instanceof Db\Model\ActivityEntity) {
				\Zend\Debug\Debug::dump($runningActivity);
			} else {
				$console->writeLine(
					$this->translator->translate('There is no running activity.')
				);
			}
		} catch(\PDOException $exception) {
			if ($exception->getCode() == 'HY000') {
				$console->writeLine($this->translator->translate(
					'Error: Activity table does not exists! Please check your installation.'
					), ConsoleColor::RED
				);
			} else {
				$console->writeLine(
					sprintf($this->translator->translate(
						'Error: Unexpected error occured when trying access database. Error message: "%s".'
						), $exception->getMessage()
					),
					ConsoleColor::RED
				);
			}
		}
	}
}
