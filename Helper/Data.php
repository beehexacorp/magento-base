<?php
/**
 * Copyright © Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Helper;

use Magento\Framework\App\ScopeInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public const XML_CONFIG_PREFIX = 'beehexa';
    public const XML_CONFIG_NEWS_ENABLE = 'beehexa/news/enable';

    /**
     * Get enabled
     *
     * @return bool
     */
    public function isEnabled() :bool
    {
        return $this->getConfigFlag(self::XML_CONFIG_NEWS_ENABLE);
    }

    /**
     * Get config value
     *
     * @param string $path
     * @param string $scopeId
     * @return mixed
     */
    public function getConfigValue(string $path, string $scopeId = ScopeInterface::SCOPE_DEFAULT): mixed
    {
        return $this->scopeConfig->getValue(self::XML_CONFIG_PREFIX . '/' . $path, $scopeId);
    }

    /**
     * Get config flag
     *
     * @param string $path
     * @param null|int|string $scopeId
     * @return bool
     */
    public function getConfigFlag(string $path, string $scopeId = ScopeInterface::SCOPE_DEFAULT): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONFIG_PREFIX . '/' . $path, $scopeId);
    }
}
