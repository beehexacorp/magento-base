<?php
/*
 * Copyright © 2022 Beehexa All rights reserved.
 * See COPYING.txt for license details.
 */

namespace Beehexa\Base\Service\Data\Wordpress;

/**
 * Interface for all entities in the integration that are viewable on the frontend
 * (eg. posts, categories, tags, users etc)
 */
interface WpEntityInterface
{
    public const ENTITY_ID = 'id';
    public const TITLE = 'title';
    public const CONTENT = 'content';
    public const URL = 'link';
    public const META_DESCRIPTION = 'meta_description';
    public const DATE_GMT = 'date_gmt';

    /**
     * Getter for id
     *
     * @return int
     */
    public function getId();

    /**
     * Getter for URL
     *
     * @return  string
     */
    public function getUrl();

    /**
     * Getter for content
     *
     * @return  string
     */
    public function getContent();

    /**
     * Getter for title
     *
     * @return  string
     */
    public function getTitle();

    /**
     * Getter for meta description
     *
     * @return  string
     */
    public function getMetaDescription();

    /**
     * Getter for Date GMT
     *
     * @return string
     */
    public function getDateGmt();

    /**
     * Getter for timestamp
     *
     * @return int
     */
    public function getTimestamp();
}
