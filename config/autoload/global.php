<?php
/**
 * odTimeTracker CLI Application (PHP version).
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-library for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 * @author Ondrej Donek, <ondrejd@gmail.com>
 */

/**
 * Global Configuration Override
 *
 * @note Here should be global configuration - independent on the current
 * environment.
 */

return array(
	'odTimeTracker' => array(
		'Db' => array(
			'Adapter' => array(
				'driver' => 'Pdo_Sqlite',
				'database' => '/home/ondrejd/.odtimetracker/storage.sqlite',
			),
		),
	),
);
