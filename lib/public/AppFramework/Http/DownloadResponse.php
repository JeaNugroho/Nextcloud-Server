<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Bernhard Posselt <dev@bernhard-posselt.com>
 * @author Lukas Reschke <lukas@statuscode.ch>
 * @author Morris Jobke <hey@morrisjobke.de>
 * @author Roeland Jago Douma <roeland@famdouma.nl>
 * @author Thomas Müller <thomas.mueller@tmit.eu>
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

/**
 * Prompts the user to download the a file
 * @since 7.0.0
 * @template S of int
 * @template C of string
 * @template H of array<string, mixed>
 * @template-extends Response<S, H>
 */
class DownloadResponse extends Response {
	/**
	 * Creates a response that prompts the user to download the file
	 * @param string $filename the name that the downloaded file should have
	 * @param C $contentType the mimetype that the downloaded file should have
	 * @since 7.0.0
	 */
	public function __construct(string $filename, string $contentType) {
		parent::__construct();

		$filename = strtr($filename, ['"' => '\\"', '\\' => '\\\\']);

		$this->addHeader('Content-Disposition', 'attachment; filename="' . $filename . '"');
		$this->addHeader('Content-Type', $contentType);
	}

	/**
	 * @inheritDoc
	 * @template NewH as array<string, mixed>
	 * @param NewH $headers value header pairs
	 * @psalm-this-out self<S, C, NewH>
	 * @return $this
	 * @since 8.0.0
	 */
	public function setHeaders(array $headers) {
		parent::setHeaders($headers);
		return $this;
	}

	/**
	 * @inheritDoc
	 * @template NewS as int
	 * @param NewS $status
	 * @psalm-this-out self<NewS, C, H>
	 * @return $this
	 * @since 6.0.0 - return value was added in 7.0.0
	 */
	public function setStatus($status) {
		parent::setStatus($status);
		return $this;
	}
}
