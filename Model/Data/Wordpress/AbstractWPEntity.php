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
    public function getId()
    {
        return $this->_getData(static::ENTITY_ID);
    }

    /**
     * @inheritDoc
     */
    public function getUrl()
    {
        return $this->_getData(static::URL);
    }

    /**
     * @inheritDoc
     */
    public function getContent()
    {
        return $this->_getData(static::CONTENT);
    }

    /**
     * @inheritDoc
     */
    public function getTitle()
    {
        return $this->_getData(static::TITLE);
    }

    /**
     * @inheritDoc
     */
    public function getMetaDescription()
    {
        return $this->_getData(static::META_DESCRIPTION);
    }

    /**
     * @inheritDoc
     */
    public function getDateGmt()
    {
        return $this->_getData(static::DATE_GMT);
    }

    /**
     * @inheritDoc
     */
    public function getTimestamp()
    {
        $dateGmt = $this->getDateGmt();
        $date = \DateTime::createFromFormat(\DateTime::ATOM, $dateGmt);
        return $date->getTimestamp();
    }
}
