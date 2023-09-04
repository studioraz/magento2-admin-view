<?php
/*
 * Copyright © 2023 Studio Raz. All rights reserved.
 * See LICENSE.txt for license details.
 */

declare(strict_types=1);

namespace SR\AdminView\Plugin\Model\Locale;

use Magento\Backend\Model\Locale\Manager;

class   ManagerPlugin
{

    /**
     * @param Manager $subject
     * @param $result
     * @return string
     */
    public function afterGetGeneralLocale(Manager $subject, $result)
    {
        return \Magento\Framework\Locale\Resolver::DEFAULT_LOCALE;
    }

}
