<?php

/**
 * Copyright © 2021 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\AdminView\Model;


use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;

class Config
{
    public const EXT_ALIAS = 'sradminview';

    const PATH_PATTERN = self::EXT_ALIAS . '/%s/%s';

    const GROUP_PATH_GENERAL = 'general';

    const DEFAULT_PATH_GROUP = self::GROUP_PATH_GENERAL;

    const LOGOS_PATH_GROUP = 'logos';

    const COLOR_SCHEMA_PATH_GROUP = 'color_schema';

    const ENVIRONMENT_PATH_GROUP = 'environment';

    const UPLOAD_DIR = self::EXT_ALIAS;


    /**#@+
     * XML Config parts
     * ex: '{self::EXT_ALIAS}/{self::GROUP_PATH_...}/{KEY_CONFIG_...}'
     */
    public const KEY_CONFIG_ACTIVE = 'active';
    const KEY_LOGIN_LOGO = 'login_logo';
    const KEY_MENU_LOGO = 'menu_logo';

    const KEY_ENVIRONMENT = 'environment';
    /**
     * @var ScopeConfigInterface
     */
    protected ScopeConfigInterface $scopeConfig;

    /**
     * @var StoreManagerInterface
     */
    private StoreManagerInterface $storeManager;


    /**
     * Config constructor.
     * @param ScopeConfigInterface $scopeConfig
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig,
        StoreManagerInterface $storeManager
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->storeManager = $storeManager;
    }


    /**
     * @inheritDoc
     */
    public function getValue($field, $group = null, $storeId = null)
    {

        return $this->scopeConfig->getValue(
            sprintf(self::PATH_PATTERN, $group ?: static::DEFAULT_PATH_GROUP, $field),
            ScopeInterface::SCOPE_STORE,
            $storeId
        );
    }


    /**
     * @inheritDoc
     */
    public function getActive($storeId = null)
    {
        return $this->getValue(self::KEY_CONFIG_ACTIVE, self::DEFAULT_PATH_GROUP);
    }


    public function getEnvironmentName() {
        return $this->getValue(self::KEY_ENVIRONMENT, self::ENVIRONMENT_PATH_GROUP);
    }

    /**
     * Returns Image Url
     *
     * @param mixed|null $storeId
     * @return null|string
     * @throws NoSuchEntityException
     */
    public function getImageUrl($fieldPath, $groupPath, $storeId = null)
    {
        $file = $this->getValue($fieldPath, $groupPath, $storeId);
        if (!$file) {
            return null;
        }

        return $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA) . self::UPLOAD_DIR . '/' . $file;
    }

    public function getLogoImageUrl($logoConfigPath): ?string
    {

        return $this->getImageUrl($logoConfigPath, self::LOGOS_PATH_GROUP);
    }

    public function getMenuBackground() {
        return $this->getValue('background', self::COLOR_SCHEMA_PATH_GROUP);
    }

    public function getMenuBackgroundHover() {
        return $this->getValue('background_hover', self::COLOR_SCHEMA_PATH_GROUP);
    }

    public function getMenuTextColor() {
        return $this->getValue('text_color', self::COLOR_SCHEMA_PATH_GROUP);
    }

    public function getMenuTextColorHover() {
        return $this->getValue('text_color_hover', self::COLOR_SCHEMA_PATH_GROUP);
    }

}
