<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Julius Härtl <jus@bitgrid.net>
 * @author Lukas Reschke <lukas@statuscode.ch>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 * @author Kate Döen <kate.doeen@nextcloud.com>
 *
 * @license AGPL-3.0
 *
 * This code is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License, version 3,
 * as published by the Free Software Foundation.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License, version 3,
 * along with this program. If not, see <http://www.gnu.org/licenses/>
 *
 */
namespace OCP\AppFramework\Http;

use OCP\AppFramework\Http;

/**
 * A generic 404 response showing an 404 error page as well to the end-user
 * @since 8.1.0
 * @template H of array<string, mixed>
 * @template-extends TemplateResponse<Http::STATUS_NOT_FOUND, H>
 */
class NotFoundResponse extends TemplateResponse {
	/**
	 * @since 8.1.0
	 */
	public function __construct() {
		parent::__construct('core', '404', [], 'guest');

		$this->setContentSecurityPolicy(new ContentSecurityPolicy());
		$this->setStatus(Http::STATUS_NOT_FOUND);
	}

	/**
	 * @inheritDoc
	 * @template NewH as array<string, mixed>
	 * @param NewH $headers value header pairs
	 * @psalm-this-out self<NewH>
	 * @return $this
	 * @since 8.0.0
	 */
	public function setHeaders(array $headers) {
		parent::setHeaders($headers);
		return $this;
	}

	/**
	 * @depreacted Do not use this method. It modifies the status code which you are not supposed to do on a NotFoundResponse
	 * @since 6.0.0 - return value was added in 7.0.0
	 */
	public function setStatus($status) {
		parent::setStatus($status);
		return $this;
	}
}
