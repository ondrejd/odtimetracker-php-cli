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
	'modules' => array(
		'odTimeTrackerLib',
		'odTimeTrackerCli',
	),
	'module_listener_options' => array(
		'module_paths' => array(
			'module',
			'vendor',
		),
		'config_glob_paths' => array(
			'config/autoload/{,*.}{global,local}.php',
		),
	),
	'service_manager' => array(
		'factories' => array(
			'translator' => 'Zend\I18n\Translator\TranslatorServiceFactory',
		),
	),
);
