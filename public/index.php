<?php
/**
 * odTimeTracker CLI Application (PHP version).
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-library for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 * @author Ondrej Donek, <ondrejd@gmail.com>
 */

// Set-up default timezone
date_default_timezone_set('Europe/Prague');

/**#@+
 * @var string
 */

/**
 * Used environment.
 */
define('APPLICATION_ENV', getenv('APPLICATION_ENV') ?: 'development');

/**
 * Base path.
 */
define('APP_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

/**#@-*/

// This makes our life easier when dealing with paths. Everything is relative
// to the application root now.
chdir(APP_PATH);

// Decline static file requests back to the PHP built-in webserver
if (
	php_sapi_name() === 'cli-server' &&
	is_file(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))
) {
	return false;
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
