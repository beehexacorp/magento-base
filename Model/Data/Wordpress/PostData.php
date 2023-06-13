<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Model\Data\Wordpress;

use Beehexa\Base\Service\Data\Wordpress\PostDataInterface;

class PostData extends AbstractWPEntity implements PostDataInterface
{
    /**
     * @inheritdoc
     */
    public function getExcerptRendered() :?string
    {
        return $this->_getData(static::EXCERPT_RENDERED);
    }

    /**
     * @inheritDoc
     */
    public function toJson(array $keys = []): string
    {
        $usedKeys = [
            static::ENTITY_ID,
            static::TITLE,
            static::EXCERPT_RENDERED,
            static::URL,
            static::DATE_GMT,
            static::IS_READ,
        ];
        if ($result = parent::toJson($usedKeys)) {
            return $result;
        }
        return '{}';
    }

    /**
     * @inheritdoc
     */
    public function isRead():bool
    {
        return !!$this->_getData(static::IS_READ);
    }

    /**
     * @inheritDoc
     */
    public function setIsRead($isRead):void
    {
        $this->setData(static::IS_READ, $isRead);
    }
}
