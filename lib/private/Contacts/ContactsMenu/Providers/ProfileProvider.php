<?php

/**
 * @copyright 2017 Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @author Christoph Wurst <christoph@winzerhof-wurst.at>
 *
 * @license GNU AGPL version 3 or any later version
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace OC\Contacts\ContactsMenu\Providers;

use OCP\Contacts\ContactsMenu\IActionFactory;
use OCP\Contacts\ContactsMenu\IEntry;
use OCP\Contacts\ContactsMenu\IProvider;
use OCP\IURLGenerator;
use OCP\L10N\IFactory as IL10NFactory;

class ProfileProvider implements IProvider {

	/** @var IActionFactory */
	private $actionFactory;

	/** @var IL10NFactory */
	private $l10nFactory;

	/** @var IURLGenerator */
	private $urlGenerator;

	/**
	 * @param IActionFactory $actionFactory
	 * @param IURLGenerator $urlGenerator
	 */
	public function __construct(
		IActionFactory $actionFactory,
		IL10NFactory $l10nFactory,
		IURLGenerator $urlGenerator
	) {
		$this->actionFactory = $actionFactory;
		$this->l10nFactory = $l10nFactory;
		$this->urlGenerator = $urlGenerator;
	}

	/**
	 * @param IEntry $entry
	 */
	public function process(IEntry $entry) {
		$iconUrl = $this->urlGenerator->getAbsoluteURL($this->urlGenerator->imagePath('core', 'actions/profile.svg'));
		$profileActionText = $this->l10nFactory->get('core')->t('Open profile of') . ' ' . $entry->getProperty('FN');
		$profileUrl = $this->urlGenerator->linkToRouteAbsolute('core.profile.index', ['userId' => $entry->getProperty('UID')]);
		$action = $this->actionFactory->newLinkAction($iconUrl, $profileActionText, $profileUrl);
		$entry->addAction($action);
	}
}
