<?php
/**
 * @copyright Copyright (c) 2016, ownCloud, Inc.
 *
 * @author Christoph Wurst <christoph@winzerhof-wurst.at>
 * @author Julius Härtl <jus@bitgrid.net>
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
 * Class DataDisplayResponse
 *
 * @since 8.1.0
 * @template S of int
 * @template H of array<string, mixed>
 * @template-extends Response<S, H>
 */
class DataDisplayResponse extends Response {
	/**
	 * response data
	 * @var string
	 */
	protected $data;


	/**
	 * @param string $data the data to display
	 * @param S $statusCode the Http status code, defaults to 200
	 * @param H $headers additional key value based headers
	 * @since 8.1.0
	 */
	public function __construct($data = '', $statusCode = Http::STATUS_OK,
								$headers = []) {
		parent::__construct();

		$this->data = $data;
		$this->setStatus($statusCode);
		$this->setHeaders(array_merge($this->getHeaders(), $headers));
		$this->addHeader('Content-Disposition', 'inline; filename=""');
	}

	/**
	 * Outputs data. No processing is done.
	 * @return string
	 * @since 8.1.0
	 */
	public function render() {
		return $this->data;
	}


	/**
	 * Sets values in the data
	 * @param string $data the data to display
	 * @return DataDisplayResponse Reference to this object
	 * @since 8.1.0
	 */
	public function setData($data) {
		$this->data = $data;

		return $this;
	}


	/**
	 * Used to get the set parameters
	 * @return string the data
	 * @since 8.1.0
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @inheritDoc
	 * @template NewH as array<string, mixed>
	 * @param NewH $headers value header pairs
	 * @psalm-this-out self<S, NewH>
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
	 * @psalm-this-out self<NewS, H>
	 * @return $this
	 * @since 6.0.0 - return value was added in 7.0.0
	 */
	public function setStatus($status) {
		parent::setStatus($status);
		return $this;
	}
}
