<?php
/**
 * Copyright © Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Helper;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
    public const XML_CONFIG_PREFIX = 'beehexa';

    /**
     * Get config value
     *
     * @param string $path
     * @param string $scopeId
     * @return mixed
     */
    public function getConfigValue(string $path, string $scopeId = ScopeConfigInterface::SCOPE_TYPE_DEFAULT): mixed
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
    public function getConfigFlag(string $path, null|int|string $scopeId = ScopeConfigInterface::SCOPE_TYPE_DEFAULT): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_CONFIG_PREFIX . '/' . $path, $scopeId);
    }
}
