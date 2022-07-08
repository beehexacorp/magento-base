<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Model\Wordpress;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\HTTP\ClientInterface;
use Psr\Log\LoggerInterface;

class WPEntityApi
{
    public const BEEHEXA_BASE_URL = 'https://www.beehexa.com/';

    public const ENTITY_POST = 'post';

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var null
     */
    protected $orderBy = null;

    /**
     * @var int
     */
    protected $limit = 10;

    /**
     * @var int
     */
    protected $page = 1;

    /**
     * @var int|LoggerInterface
     */
    protected $logger = 10;

    /**
     * @var array
     */
    protected $filters = [];

    /**
     * @param ClientInterface $httpClient
     * @param LoggerInterface $logger
     */
    public function __construct(
        ClientInterface $httpClient,
        LoggerInterface $logger
    ) {
        $this->client = $httpClient;
        $this->logger = $logger;
    }

    /**
     * Setter for limit
     *
     * @param int $limit
     * @return void
     */
    public function limit(int $limit = 10)
    {
        $this->limit = $limit;
    }

    /**
     * Setter for page
     *
     * @param int $page
     * @return void
     */
    public function page(int $page = 1)
    {
        $this->page = $page;
    }

    /**
     * Add field to filter
     *
     * @param string $field
     * @param mixed  $value
     * @return $this
     */
    public function addFieldToFilter($field, $value)
    {
        $this->filters[$field] = $value;
        return $this;
    }

    /**
     * Set order by author, date, id, include, modified, parent, relevance, slug, include_slugs, title
     *
     * @param string $field
     * @param string $order = 'desc'
     * @return WPEntityApi
     */
    public function order(string $field, string $order = 'desc')
    {
        $this->orderBy = [
            'order'   => $order,
            'orderby' => $field
        ];
        return $this;
    }

    /**
     * Getter for request params
     *
     * @return array
     */
    public function getRequestParams()
    {
        $requestParams = [];

        if (!empty($this->filters)) {
            $requestParams = array_merge_recursive($requestParams, $this->filters);
        }

        if ($this->orderBy) {
            $requestParams = array_merge_recursive($requestParams, $this->orderBy);
        }

        if ($this->limit) {
            $requestParams['per_page'] = $this->limit;
        }

        if ($this->page) {
            $requestParams['page'] = $this->page;
        }
        return $requestParams;
    }

    /**
     * Implement get and filter because we use the API for fetching post only
     *
     * @param string $entityType
     * @return mixed
     * @throws LocalizedException
     * @throws \HttpResponseException
     */
    public function get($entityType)
    {
        $baseURL = static::BEEHEXA_BASE_URL;
        $params = $this->getRequestParams();
        $url = implode('', [
            $baseURL,
            $this->getRequestPath($entityType),
            '?',
            http_build_query($params)
        ]);
        $this->client->get($url);
        $responseStatus = $this->client->getStatus();
        if ($responseStatus !== 200) {
            $this->logger->info("Beehexa API Response ERROR", [
                'status' => $responseStatus
            ]);

            throw new \HttpResponseException(__("Has an error while calling the API, Status %s", $responseStatus));
        }
        return json_decode($this->client->getBody(), true);
    }

    /**
     * Return API Path
     *
     * @param string $entityType
     * @return string
     * @throws LocalizedException
     */
    public function getRequestPath(string $entityType)
    {
        switch ($entityType) {
            case self::ENTITY_POST:
                return '/wp-json/wp/v2/posts';
        }
        throw new LocalizedException(__("Unsupported entity %s", $entityType));
    }
}
