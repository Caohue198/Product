<?php

namespace AHT\Product\Api\Data;

interface ProductInterface
{
    const ID = 'id';

    /**
     * Get product id
     *
     * @return int|null
     */
    public function getId();

    /**
     * Set product id
     *
     * @param int $id
     * @return @this
     */
    public function setId($id);

    /**
     * Get product title
     *
     * @return string|null
     */
    public function getTitle();

    /**
     * Set product title
     *
     * @param string $title
     * @return null
     */
    public function setTitle($title);

    /**
     * Get product images
     *
     * @return string|null
     */
    public function getImages();

    /**
     * Set product images
     *
     * @param string $images
     * @return null
     */
    public function setImages($images);

    /**
     * Get product categoryid
     *
     * @return int|null
     */
    public function getCategoryid();

    /**
     * Set product categoryid
     *
     * @param int $categoryid
     * @return @this
     */
    public function setCategoryid($categoryid);

    /**
     * Get product description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Set product description
     *
     * @param string $description
     * @return null
     */
    public function setDescription($description);

    /**
     * Get product price
     *
     * @return string|null
     */
    public function getPrice();

    /**
     * Set product price
     *
     * @param string $title
     * @return null
     */
    public function setPrice($price);

    /**
     * Get product content
     *
     * @return string|null
     */
    public function getContent();

    /**
     * Set product content
     *
     * @param string $content
     * @return null
     */
    public function setContent($content);
}
