<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Service\Data\Wordpress;

interface PostDataInterface extends WpEntityInterface
{
    public const EXCERPT_RENDERED = 'excerpt_rendered';

    public const IS_READ = 'is_read';

    /**
     * Getter for excerpt rendered
     *
     * @return string
     */
    public function getExcerptRendered();

    /**
     * Getter is Read
     *
     * @return boolean
     */
    public function isRead();

    /**
     * Setter for Is Read
     *
     * @param bool $isRead
     * @return void
     */
    public function setIsRead($isRead);
}
