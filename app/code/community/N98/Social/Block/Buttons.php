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

    /**
     * Gets the current locale, for example "en_US"
     * 
     * @return string
     */
    public function getLocale()
    {
        return Mage::app()->getLocale()->getDefaultLocale();
    }

    /**
     * Gets the current language, for example "en"
     *
     * @return string
     */
    public function getLanguage()
    {
        return substr($this->getLocale(), 0, 2);
    }


    /**
     * Returns the filename of the dummy image for facebook
     *
     * @return string
     */
    public function getFacebookImage() {
        // for facebook we have only a English an German version
        return ($this->getLanguage() == 'de') ? 'dummy_facebook.png' : 'dummy_facebook_en.png';
    }


    /**
     * Returns the configured facebook app id
     *
     * @return string
     */
    public function getFacebookAppId() {
        return Mage::getStoreConfig('n98social/facebook/app_id');
    }


    /**
     * Returns the config for the socialshareprivacy plugin
     * The config will be JSON encoded in the template
     * 
     * @link http://www.heise.de/extras/socialshareprivacy/#options
     * @return array
     */
    public function getShareConfig()
    {
        $config = array();
        $config['services'] =
            array(
                'facebook' => array('status' => 'off'),
                'twitter' => array('status' => 'off'),
                'gplus' => array('status' => 'off')
            );

        if (Mage::getStoreConfig('n98social/facebook/enabled')) {
            $config['services']['facebook'] = array(
                'status' => 'on',
                'app_id' => $this->getFacebookAppId(),
                'dummy_img' => $this->getSkinUrl('/images/'.$this->getFacebookImage()),
                'language' => $this->getLocale(),
            );
        }
        
        if (Mage::getStoreConfig('n98social/twitter/enabled')) {
            $config['services']['twitter'] = array(
                'status' => 'on',
                'dummy_img' =>  $this->getSkinUrl('/images/dummy_twitter.png'),
            );
        }

        if (Mage::getStoreConfig('n98social/gplus/enabled')) {
            $config['services']['gplus'] = array(
                'status' => 'on',
                'dummy_img' =>  $this->getSkinUrl('/images/dummy_gplus.png'),
                'language' => $this->getLanguage(),
            );
        }

        return $config;
    }
}