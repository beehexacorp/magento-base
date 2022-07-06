<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Model;

use Beehexa\Base\Model\Data\Wordpress\PostDataInterfaceFactory;
use Beehexa\Base\Model\Wordpress\WPEntityApi;
use Beehexa\Base\Model\Wordpress\WPEntityApiFactory;
use Beehexa\Base\Service\WPServiceInterface;

class WPService implements WPServiceInterface
{

    /**
     * @var PostDataInterfaceFactory
     */
    protected $postDataInterfaceFactory;

    /**
     * @var WPEntityApiFactory
     */
    protected $WPEntityApiFactory;

    /**
     * @param WPEntityApiFactory       $WPEntityApiFactory
     * @param PostDataInterfaceFactory $postDataInterfaceFactory
     */
    public function __construct(
        WPEntityApiFactory       $WPEntityApiFactory,
        PostDataInterfaceFactory $postDataInterfaceFactory
    ) {
        $this->postDataInterfaceFactory = $postDataInterfaceFactory;
        $this->WPEntityApiFactory = $WPEntityApiFactory;
    }

    /**
     * @inheritDoc
     */
    public function getPosts($limit = 2, $page = 1)
    {
        /**
         * @var $postApi \Beehexa\Base\Model\Wordpress\WPEntityApi
         */
        $postApi = $this->WPEntityApiFactory->create();
        $postApi->limit($limit);
        $postApi->page($limit);
        $postApi->order('id');
        $response = $postApi->get(WPEntityApi::ENTITY_POST);
        $postCollection = [];
        foreach ($response as $post) {
            $postCollection[] = $this->postDataInterfaceFactory->create($post);
        }
        return $postCollection;
    }
}
