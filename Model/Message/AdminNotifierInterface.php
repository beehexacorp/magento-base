<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Model\Message;

interface AdminNotifierInterface
{
    /**
     * Push WP post to admin notification
     *
     * @param \Beehexa\Base\Service\Data\Wordpress\PostDataInterface $post
     * @return void
     */
    public function push(\Beehexa\Base\Service\Data\Wordpress\PostDataInterface $post): void;
}
