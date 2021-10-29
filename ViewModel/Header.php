<?php
/**
 * Copyright © 2021 Studio Raz. All rights reserved.
 * See LICENCE file for license details.
 */

namespace SR\AdminView\ViewModel;

use Magento\Framework\View\Element\Block\ArgumentInterface;
use SR\AdminView\Model\Config;

class Header implements ArgumentInterface
{

    protected Config $config;

    public function __construct(
        Config $config
    )
    {
        $this->config = $config;
    }

    public function getLogoImageUrl($logoPath): ?string
    {
        $imageUrl = null;
        if ($this->config->getActive()) {
            $imageUrl = $this->config->getLogoImageUrl($logoPath);
        }
        return $imageUrl;
    }

    public function getEnvironmentName() {

        if ($this->config->getActive() && $name = $this->config->getEnvironmentName()) {
          return $name;
        }
        return '';
    }
}
