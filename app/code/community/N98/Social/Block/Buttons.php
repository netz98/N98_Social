<?php
/**
 * netz98 Social magento module
 *
 * LICENSE
 *
 * This source file is subject of netz98.
 * You may be not allowed to change the sources
 * without authorization of netz98 new media GmbH.
 *
 * @copyright Copyright (c) 2011 netz98 new media GmbH (http://www.netz98.de)
 * @author netz98 new media GmbH <info@netz98.de>
 * @category Netz98
 * @package Netz98_XXXX
 */

/**
 * XXXX
 *
 * @category N98
 * @package N98_Social
 */


class N98_Social_Block_Buttons extends Mage_Core_Block_Template
{

    protected function _toHtml()
    {
        $headBlock = $this->getLayout()->getBlock('head');
        $headBlock->addJs('jquery/jquery-1.6.3.min.js');
        $content = parent::_toHtml();
        return $content;

    }
}