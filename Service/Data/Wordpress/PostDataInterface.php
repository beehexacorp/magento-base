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
     * @return null|string
     */
    public function getExcerptRendered() :?string;

    /**
     * Getter is Read
     *
     * @return boolean
     */
    public function isRead():bool;

    /**
     * Setter for Is Read
     *
     * @param bool $isRead
     * @return void
     */
    public function setIsRead(bool $isRead) :void;
}
