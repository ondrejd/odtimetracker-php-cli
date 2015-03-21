<?php
/**
 * odTimeTracker CLI Application (PHP version).
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-library for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 * @author Ondrej Donek, <ondrejd@gmail.com>
 */

return array(
	'console' => array(
		'router' => array(
			'routes' => array(
				'odtimetrackercli_home' => array(
					'options' => array(
						'route' => 'info',
						'defaults' => array(
							'controller' => 'odTimeTrackerCli\Controller\Index',
							'action' => 'index',
						),
					),
				),
				'odtimetrackercli_start' => array(
					'options' => array(
						'route' => 'start <activityString>',
						'defaults' => array(
							'controller' => 'odTimeTrackerCli\Controller\Activity',
							'action' => 'start',
						),
					),
				),
				'odtimetrackercli_stop' => array(
					'options' => array(
						'route' => 'stop',
						'defaults' => array(
							'controller' => 'odTimeTrackerCli\Controller\Activity',
							'action' => 'stop',
						),
					),
				),
			),
		),
	),
	'controllers' => array(
		'invokables' => array(
			'odTimeTrackerCli\Controller\Index' => 'odTimeTrackerCli\Controller\IndexController',
			'odTimeTrackerCli\Controller\Activity' => 'odTimeTrackerCli\Controller\ActivityController',
		),
	),
);
