<?php
/**
 * odTimeTracker CLI
 *
 * @link https://github.com/odTimeTracker/odtimetracker-php-cli for the canonical source repository
 * @copyright Copyright (c) 2015 Ondrej Donek (https://ondrejdonek.blogspot.com).
 * @license https://www.mozilla.org/MPL/2.0/ Mozilla Public License 2.0
 */

namespace odTimeTrackerCli\Controller;

use Zend\I18n\Translator\Translator;
use Zend\Mvc\Controller\AbstractActionController;

/**
 * Common controller class.
 *
 * @package odTimeTrackerCli
 * @subpackage Controller
 * @author Ondrej Donek, <ondrejd@gmail.com>
 */
class CommonController extends AbstractActionController
{
	/**
	 * @var Translator $translator
	 */
	protected $translator;

	/**
	 * Constructor.
	 *
	 * @param Translator $translator
	 * @return void
	 * @todo Don't forgot to remove `setLocale('cs_CZ')`!
	 */
	public function __construct(Translator $translator)
	{
		$this->translator = $translator;
		$this->translator->setLocale('cs_CZ');
	}
}
