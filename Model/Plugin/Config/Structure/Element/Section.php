<?php
/**
 * Copyright © 2015 ShopGo. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace ShopGo\AdvancedAcl\Model\Plugin\Config\Structure\Element;

use \Magento\Config\Model\Config\Structure\Element\Section as ElementSection;

/**
 * Element section plugin
 */
class Section
{
    /**
     * @var \ShopGo\AdvancedBackendAcm\Model\System\Config
     */
    protected $_advAclModelSystemConfig;

    /**
     * @param \ShopGo\AdvancedAcl\Model\System\Config $advAclModelSystemConfig
     */
    public function __construct(
        \ShopGo\AdvancedAcl\Model\System\Config $advAclModelSystemConfig
    ) {
        $this->_advAclModelSystemConfig = $advAclModelSystemConfig;
    }

    /**
     * Check whether section is allowed for current user
     *
     * @param ElementSection $subject
     * @param boolean $result
     * @return boolean
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function afterIsAllowed(ElementSection $subject, $result)
    {
        $elementData = $subject->getData();

        $access = $this->_advAclModelSystemConfig
            ->getSystemConfigAccess(array(
                'tab'     => array('id' => $elementData['tab']),
                'section' => array('id' => $elementData['id'])
            ));

        return $result && $access;
    }
}
