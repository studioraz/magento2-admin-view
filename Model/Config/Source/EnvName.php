<?php
/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 * https://www.magepal.com | support@magepal.com
 */

namespace SR\AdminView\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class EnvName implements OptionSourceInterface
{
    const PRODUCTION = 'production';
    const STAGE = 'stage';

    /**
     * @inheritDoc
     */
    public function toOptionArray(): array
    {
        return [
            ['value' => '', 'label' => __('-- Select environment name to show it below logo --')],
            ['value' => self::STAGE, 'label' => __('Stage')],
            ['value' => self::PRODUCTION, 'label' => __('Production')]
        ];
    }

    /**
     * Returns options in "key-value" format
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            self::STAGE => __('Stage'),
            self::PRODUCTION => __('Production')
        ];
    }
}

