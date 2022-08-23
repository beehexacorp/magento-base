<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Model\Message;

use Beehexa\Base\Service\Data\Wordpress\PostDataInterface;

class AdminAdminNotifier implements AdminNotifierInterface
{
    /**
     * @var \Magento\Framework\Notification\NotifierInterface
     */
    protected \Magento\Framework\Notification\NotifierInterface $notifier;

    /**
     * @param \Magento\Framework\Notification\NotifierInterface $notifier
     */
    public function __construct(\Magento\Framework\Notification\NotifierInterface $notifier)
    {
        $this->notifier = $notifier;
    }

    /**
     * Push WP post to admin notification
     *
     * @param PostDataInterface $post
     * @return void
     */
    public function push(PostDataInterface $post): void
    {
        $this->notifier->addMajor(
            __('Beehexa\'s News'),
            __($post->getTitle()),
            $post->getUrl(),
            false
        );
    }
}
