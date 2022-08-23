<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Model\Message;

use Magento\Framework\Notification\MessageInterface;
use Beehexa\Base\Model\PostManagement;

class Notification implements MessageInterface
{
    public const SEVERITY_FORCE_TO_DISPLAY = 0;

    /**
     * @var PostManagement
     */
    protected PostManagement $postManagement;

    /**
     * @param PostManagement $postManagement
     */
    public function __construct(PostManagement $postManagement)
    {
        $this->postManagement = $postManagement;
    }

    /**
     * Getter for Identity
     *
     * @return string
     */
    public function getIdentity() :string
    {
        return 'beehexa_news';
    }

    /**
     * Getter for isDisplayed
     *
     * @return bool
     */
    public function isDisplayed() :bool
    {
        //Always return true, always show the latest blog to the notification bar
        if ($this->postManagement->getSavedPost()->getId()) {
            return true;
        }
        return false;
    }

    /**
     * Getter for Text
     *
     * @return string
     */
    public function getText() :string
    {
        $post = $this->postManagement->getSavedPost();
        return implode(' ', [
            __('Beehexa\'s News: %1.', $post->getTitle()),
            __('<a href="%1" target="_blank">Read more</a>', $post->getUrl())
        ]);
    }

    /**
     * Getter for Severity
     *
     * @return int
     */
    public function getSeverity():int
    {
        return static::SEVERITY_FORCE_TO_DISPLAY;
    }
}
