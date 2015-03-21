<?php
/**
 * odTimeTracker CLI
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-cli for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace odTimeTrackerCliTest\Controller;

use Zend\Test\PHPUnit\Controller\AbstractConsoleControllerTestCase;

class IndexControllerTest extends AbstractConsoleControllerTestCase
{
	public function setUp()
	{
		$this->setApplicationConfig(
			include 'tests/phpunit_TestAppConfig.php'
		);
		parent::setUp();
	}

	public function testIndexActionCanBeAccessed()
	{
		$this->dispatch('info');
		$this->assertResponseStatusCode(0);
		$this->assertControllerName('odTimeTrackerCli\Controller\Index');
		$this->assertControllerClass('IndexController');
		$this->assertMatchedRouteName('odtimetrackercli_home');
		//$this->markTestIncomplete();
	}
}