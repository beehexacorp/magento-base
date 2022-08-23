<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Service;

interface WPServiceInterface
{
    /**
     * Fetch wordpress post
     *
     * Using WP API wp-json/wp/v2/posts, Default per_page wordpress is 10
     *
     * @param int $limit
     * @param int $page
     * @return \Beehexa\Base\Service\Data\Wordpress\PostDataInterface[]
     */
    public function getPosts(int $limit = 2, int $page = 1): array;
}
