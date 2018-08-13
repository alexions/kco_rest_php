<?php
/**
 * Copyright 2014 Klarna AB
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * File containing the Reports class.
 */

namespace Klarna\Rest\Settlements;

use GuzzleHttp\Exception\RequestException;
use Klarna\Exception\NonApplicableException;
use Klarna\Rest\Resource;
use Klarna\Rest\Transport\Connector;
use Klarna\Rest\Transport\Exception\ConnectorException;

/**
 * Reports resource.
 */
class Reports extends Resource
{
    /**
     * {@inheritDoc}
     */
    public static $path = '/settlements/v1/reports';

    /**
     * Constructs a Reports instance.
     *
     * @param Connector $connector HTTP transport connector
     */
    public function __construct(Connector $connector)
    {
        parent::__construct($connector);
    }

    /**
     * Not applicable.
     *
     * @throws NonApplicableException
     */
    public function fetch()
    {
        throw NonApplicableException('Not applicable');
    }

    /**
     * Returns payout report with transactions
     * 
     * @param string $payment_reference The reference id of the payout.
     *
     * @throws ConnectorException        When the API replies with an error response
     * @throws RequestException          When an error is encountered
     * @throws \RuntimeException         On an unexpected API response
     * @throws \RuntimeException         If the response content type is not JSON
     * @throws \InvalidArgumentException If the JSON cannot be parsed
     * @throws \LogicException           When Guzzle cannot populate the response
     *
     * @return array Payout report
     */
    public function getPayoutReport($payment_reference)
    {
        return $this->get(self::$path . "/payout-with-transactions?payment_reference={$payment_reference}")
            ->status('200')
            ->contentType('text/csv')
            ->getJson();
    }

    /**
     * Returns payouts summary report with transactions.
     * 
     * @param array $params Additional query params to filter payouts.
     *              https://developers.klarna.com/api/#settlements-api-get-payouts-summary-report-with-transactions
     *
     * @throws ConnectorException        When the API replies with an error response
     * @throws RequestException          When an error is encountered
     * @throws \RuntimeException         On an unexpected API response
     * @throws \RuntimeException         If the response content type is not JSON
     * @throws \InvalidArgumentException If the JSON cannot be parsed
     * @throws \LogicException           When Guzzle cannot populate the response
     *
     * @return array Summary report
     */
    public function getPayoutsSummaryReport(array $params = [])
    {
        return $this->get(self::$path . '/payouts-summary-with-transactions?' . http_build_query($params))
            ->status('200')
            ->contentType('text/csv')
            ->getJson();
    }
}