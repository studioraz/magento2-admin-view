<?php

/**
 * Copyright © MagePal LLC. All rights reserved.
 * See COPYING.txt for license details.
 * https://www.magepal.com | support@magepal.com
 */

namespace SR\AdminView\Block;

use Magento\Framework\View\Element\Template;
use SR\AdminView\Model\Config;

class Style extends Template
{

    private Config $config;

    public function __construct(
        Template\Context $context,
        Config $config,
        array $data = []
    )
    {
        parent::__construct($context, $data);
        $this->config = $config;
    }

    public function getConfigModel()
    {
        return $this->config;
    }

    protected function _afterToHtml($html)
    {
       if (!$this->config->getActive()) {
           return '';
       }
        return $html;
    }

}
