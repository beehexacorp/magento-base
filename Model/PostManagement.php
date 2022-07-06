<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Model;

use Beehexa\Base\Model\Data\Wordpress\PostDataInterfaceFactory;
use Beehexa\Base\Service\Data\Wordpress\PostDataInterface;
use Magento\Framework\FlagManager;

class PostManagement
{
    public const FLAG_CODE_SAVED_POST = 'beehexa_last_post_data';

    /**
     * @var FlagManager
     */
    protected $flagManager;

    /**
     * @var WPService
     */
    protected $WPService;

    /**
     * @var PostDataInterfaceFactory
     */
    protected $postDataInterfaceFactory;

    /**
     * @param FlagManager              $flagManager
     * @param PostDataInterfaceFactory $postDataInterfaceFactory
     * @param WPService                $WPService
     */
    public function __construct(
        FlagManager              $flagManager,
        PostDataInterfaceFactory $postDataInterfaceFactory,
        WPService                $WPService
    ) {
        $this->flagManager = $flagManager;
        $this->WPService = $WPService;
        $this->postDataInterfaceFactory = $postDataInterfaceFactory;
    }

    /**
     * Getter for SavedPost
     *
     * @return PostDataInterface|null
     */
    public function getSavedPost()
    {
        $recentPost = $this->flagManager->getFlagData(static::FLAG_CODE_SAVED_POST);
        $post = $this->postDataInterfaceFactory->create();
        if ($recentPost) {
            $data = json_decode($recentPost, true);
            $post = $post->setData($data);
        }
        return $post;
    }

    /**
     * Store post to flag.
     *
     * @param PostDataInterface $post
     * @return PostManagement
     */
    public function savePost(PostDataInterface $post)
    {
        $this->flagManager->saveFlag(static::FLAG_CODE_SAVED_POST, $post->toJson());
        return $this;
    }

    /**
     * Mark read the Latest post
     *
     * @return bool
     */
    public function readLatestPost()
    {
        $post = $this->getSavedPost();
        if ($post->getId()) {
            $post->setIsRead(true);
            $this->savePost($post);
        }
        return true;
    }

    /**
     * Getter for the newest post
     *
     * @return PostDataInterface|null
     */
    public function getTheNewestPost()
    {
        $recentlyPostId = $this->getSavedPost()->getId() ?? 0;
        $postCollection = $this->WPService->getPosts();
        $newestPost = null;
        if (!empty($postCollection)) {
            //Getting the newest post only
            $current = current($postCollection);
            if ($current->getId() > $recentlyPostId) {
                $current->setIsRead(false);
                $this->savePost($current);
                $newestPost = $current;
            }
        }
        return $newestPost;
    }
}
