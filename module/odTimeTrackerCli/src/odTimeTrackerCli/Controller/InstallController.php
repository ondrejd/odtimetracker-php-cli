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
use Zend\Console\Prompt;
use Zend\I18n\Translator\Translator;

/**
 * Controller for installer.
 *
 * @package odTimeTrackerCli
 * @subpackage Controller
 * @author Ondrej Donek, <ondrejd@gmail.com>
 * @todo Translate all strings!
 */
class InstallController extends CommonController
{
	/**
	 * @const string
	 */
	const CONFIG_FILE_NAME = '.odtimetracker.config.php';

	/**
	 * Installation wizard action.
	 *
	 * @return void
	 */
	public function installAction()
	{
		$console = $this->getServiceLocator()->get('console');
		//$activityTable = new Db\TableGateway\ActivityTable();

		// 1) Just "Do you want to proceed" question...
		$result1 = Prompt\Confirm::prompt(
			$this->translator->translate('Do you want to proceed with installation? [y/n]:'),
			$this->translator->translate('y'),
			$this->translator->translate('n')
		);
		if (!$result1) {
			// User doesn't want to proceed...
			return;
		}

		// 2) Pick up location of the configuration file
		$homeDir = $this->getUserHomeDir() ?: '';
		$suggestedPath = $homeDir . self::CONFIG_FILE_NAME;

		if (file_exists($suggestedPath)) {
			// If configuration file already exists user can use it ...
			$result2 = Prompt\Confirm::prompt(
				sprintf($this->translator->translate(
					'Do you want to use existing configuration file (%s)? [y/n]'
					), $suggestedPath
				),
				$this->translator->translate('y'),
				$this->translator->translate('n')
			);

			if ($result2) {
				// ... We just have to check this existing file.
				die('TODO Check existing configuration file!');
			} else {
				// Otherwise just delete this file.
				// Note: Maybe would better to create backup file first!
				unlink($suggestedPath);
			}
		}

		// 3) Ask if user want to enter own path or want to use the default
		$result3 = Prompt\Confirm::prompt(
			sprintf($this->translator->translate(
				'Do you want to use default location for configuration file (%s)? [y/n]'
				), $suggestedPath
			),
			$this->translator->translate('y'),
			$this->translator->translate('n')
		);

		if ($result3) {
			$configFilePath = $suggestedPath;
		} else {
			// Let user enter own path to the new configuration file
			$userDirPath = Prompt\Line::prompt($this->translator->translate(
				'Enter full path to directory for configuration file:'
			));

			if (!is_dir($userDirPath)) {
				$console->writeLine($this->translator->translate(
					'Entered path is not a valid directory! Exiting...'
				), ConsoleColor::RED);
				return;
			}

			$configFilePath = $this->normalizePath($userDirPath) . self::CONFIG_FILE_NAME;
		}

		// 4) Confirm the configuration file creation
		$result4 = Prompt\Confirm::prompt(
			sprintf($this->translator->translate(
				'Do you really want to create configuration file (%s)? [y/n]'
				), $suggestedPath
			),
			$this->translator->translate('y'),
			$this->translator->translate('n')
		);

		if (!$result4) {
			// Can not continue...
			$console->writeLine($this->translator->translate(
				'Can\'t continue without creating a configuration file! Exiting...'
			), ConsoleColor::WHITE);
			return;
		}

		// 5) Ask if user want to prepare default database file (and configuration)

		

		// ...


		// Finish (write configuration into the file)

		$console->writeLine(
			'TODO Create configuration file ' . $configFilePath . '!', ConsoleColor::RED
		);
	}



	/**
	 * Normalize given path.
	 *
	 * Ensure that the path ends with separator.
	 *
	 * @param string $path
	 * @return string
	 */
	protected function normalizePath($path)
	{
		if (!in_array(substr($path, -1), ['/', '\\'])) {
			return $path . DIRECTORY_SEPARATOR;
		}

		return $path;
	}

	/**
	 * Retrieve user's home directory.
	 *
	 * Returns `FALSE` when script was not able to retrieve user's home dir.
	 *
	 * @return boolean|string
	 */
	protected function getUserHomeDir()
	{
		// Have home env var
		if (getenv('HOME')) {
			return $this->normalizePath(getenv('HOME'));
		}

		// *nix OS
		if (function_exists('posix_getuid')) {
			$uid = posix_getuid();
			$uinfo = posix_getpwuid($uid) ?: array();
			$home = array_key_exists('dir', $uinfo) ? $uinfo['dir'] : '';

			if (is_dir($uinfo['dir'])) {
				return $this->normalizePath($home);
			}
		} elseif (!defined('PHP_WINDOWS_VERSION_BUILD')) {
			$username = get_current_user() ?: getenv('USERNAME');
			$home = '/home/' . ($username ? $username . '/' : '');

			if (is_dir($home)) {
				return $home; // no need to normalize path here...
			}
		}

		// Have drive and path env vars
		if (getenv('HOMEDRIVE') && getenv('HOMEPATH')) {
			$home = getenv('HOMEDRIVE') . getenv('HOMEPATH');

			return $this->normalizePath($home);
		}

		// Windows
		$username = get_current_user() ?: getenv('USERNAME');
		if (!$username) {
			return false;
		}

		$win7Path = 'C:\Users\\' . $username . '\\';
		if (is_dir($win7Path) ) {
			return $win7Path;
		}

		$winXpPath = 'C:\Documents and Settings\\' . $username . '\\';
		if (is_dir($winXpPath)) {
			return $winXpPath;
		}

		return false;
	}
}
