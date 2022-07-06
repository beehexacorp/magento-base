<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Cron;

use Beehexa\Base\Model\Message\AdminNotifierInterface;
use Beehexa\Base\Model\PostManagement;

class FetchingNews
{
    /**
     * @var PostManagement
     */
    protected $postManagement;

    /**
     * @var AdminNotifierInterface
     */
    protected $notifier;

    /**
     * @param AdminNotifierInterface $notifier
     * @param PostManagement         $postManagement
     */
    public function __construct(
        AdminNotifierInterface $notifier,
        PostManagement         $postManagement
    ) {
        $this->postManagement = $postManagement;
        $this->notifier = $notifier;
    }

    /**
     * Fetching new message
     *
     * @return void
     */
    public function fetchNewMessage()
    {
        $newestPost = $this->postManagement->getTheNewestPost();
        if ($newestPost && $newestPost->getId()) {
            $this->postManagement->savePost($newestPost);
            $this->notifier->push($newestPost);
        }
    }
}
