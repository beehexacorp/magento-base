<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Model\Data\Wordpress;

use Beehexa\Base\Service\Data\Wordpress\WpEntityInterface;

abstract class AbstractWPEntity extends \Magento\Framework\DataObject implements WpEntityInterface
{
    /**
     * @inheritDoc
     */
    public function getId():int
    {
        return (int)$this->_getData(static::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function getUrl():string
    {
        return $this->_getData(static::URL);
    }

    /**
     * @inheritDoc
     */
    public function getContent():string
    {
        return $this->_getData(static::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function getTitle():string
    {
        return $this->_getData(static::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function getMetaDescription():string
    {
        return $this->_getData(static::META_DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function getDateGmt():string
    {
        return $this->_getData(static::DATE_GMT);
    }

    /**
     * @inheritDoc
     */
    public function getTimestamp():int
    {
        $dateGmt = $this->getDateGmt();
        $date = \DateTime::createFromFormat(\DateTime::ATOM, $dateGmt);
        return $date->getTimestamp();
    }
}
