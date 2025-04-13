<?php
/**
 * Copyright © 2021 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\AdminView\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class EnvName implements OptionSourceInterface
{
    const PRODUCTION  = 'production';
    const STAGE       = 'stage';
    const DEV = 'dev';

    /**
     * All available environment options (without placeholder)
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            ['value' => self::DEV, 'label' => __('Dev')],
            ['value' => self::STAGE, 'label' => __('Stage')],
            ['value' => self::PRODUCTION, 'label' => __('Production')],
        ];
    }

    /**
     * Returns options for system config select field, including a placeholder
     *
     * @return array
     */
    public function toOptionArray(): array
    {
        return array_merge(
            [['value' => '', 'label' => __('-- Select environment name to show it below logo --')]],
            $this->toArray()
        );
    }

    /**
     * Same as toOptionArray() – alias for clarity if used outside config context
     *
     * @return array
     */
    public function getAllOptions(): array
    {
        return $this->toOptionArray();
    }
}
