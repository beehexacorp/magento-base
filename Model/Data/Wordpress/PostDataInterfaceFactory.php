<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Model\Data\Wordpress;

use Beehexa\Base\Service\Data\Wordpress\WpEntityInterface;
use Magento\Framework\ObjectManagerInterface;
use Beehexa\Base\Service\Data\Wordpress\PostDataInterface;

class PostDataInterfaceFactory
{

    /**
     * Object Manager instance
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * @param ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(ObjectManagerInterface $objectManager, $instanceName = \Beehexa\Base\Service\Data\Wordpress\PostDataInterface::class)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Origin json data from WP API
     *
     * @param array $data
     * @return \Beehexa\Base\Service\Data\Wordpress\PostDataInterface
     */
    public function create(array $data = [])
    {
        if (isset($data['excerpt']) && isset($data['excerpt']['rendered'])) {
            $data[PostDataInterface::EXCERPT_RENDERED] = $data['excerpt']['rendered'];
            unset($data['excerpt']);
        }

        if (isset($data['yoast_head_json']) && isset($data['yoast_head_json']['og_description'])) {
            $data[WpEntityInterface::META_DESCRIPTION] = $data['yoast_head_json']['og_description'];
            unset($data['yoast_head_json']);
        }
        //Move rendered to top level with exists key.
        $data = array_map(function ($value) {
            if (is_array($value) && isset($value['rendered'])) {
                $value = $value['rendered'];
            }
            return $value;
        }, $data);

        return $this->_objectManager->create($this->_instanceName, ['data' => $data]);
    }
}
