<?php

/**
 * netz98 Social magento module
 *
 * LICENSE
 *
 * Copyright © 2011.
 * netz98 new media GmbH. Alle Rechte vorbehalten.
 *
 * Die Nutzung und Weiterverbreitung dieser Software in kompilierter oder nichtkompilierter Form, mit oder ohne Veränderung, ist unter den folgenden Bedingungen zulässig:
 *
 * 1. Weiterverbreitete kompilierte oder nichtkompilierte Exemplare müssen das obere Copyright, die Liste der Bedingungen und den folgenden Verzicht im Sourcecode enthalten.
 * 2. Alle Werbematerialien, die sich auf die Eigenschaften oder die Benutzung der Software beziehen, müssen die folgende Bemerkung enthalten: "Dieses Produkt enthält Software, die von der netz98 new media GmbH entwickelt wurde."
 * 3. Der Name der netz98 new media GmbH darf nicht ohne vorherige ausdrückliche, schriftliche Genehmigung zur Kennzeichnung oder Bewerbung von Produkten, die von dieser Software abgeleitet wurden, verwendet werden.
 * 4. Es ist Lizenznehmern der netz98 new media GmbH nur dann erlaubt die veränderte Software zu verbreiten, wenn jene zu den Bedingungen einer Lizenz, die eine Copyleft-Klausel enthält, lizenziert wird.
 *
 * Diese Software wird von der netz98 new media GmbH ohne jegliche spezielle oder implizierte Garantien zur Verfügung gestellt. So übernimmt die netz98 new media GmbH keine Gewährleistung für die Verwendbarkeit der Software für einen speziellen Zweck oder die generelle Nutzbarkeit. Unter keinen Umständen ist netz98 haftbar für indirekte oder direkte Schäden, die aus der Verwendung der Software resultieren. Jegliche Schadensersatzansprüche sind ausgeschlossen.
 *
 *
 * Copyright © 2011
 * netz98 new media GmbH. All rights reserved.
 *
 * The use and redistribution of this software, either compiled or uncompiled, with or without modifications are permitted provided that the following conditions are met:
 *
 * 1. Redistributions of compiled or uncompiled source must contain the above copyright notice, this list of the conditions and the following disclaimer:
 * 2. All advertising materials mentioning features or use of this software must display the following acknowledgement: “This product includes software developed by the netz98 new media GmbH, Mainz.”
 * 3. The name of the netz98 new media GmbH may not be used to endorse or promote products derived from this software without specific prior written permission.
 * 4. License holders of the netz98 new media GmbH are only permitted to redistribute altered software, if this is licensed under conditions that contain a copyleft-clause.
 * This software is provided by the netz98 new media GmbH without any express or implied warranties. netz98 is under no condition liable for the functional capability of this software for a certain purpose or the general usability. netz98 is under no condition liable for any direct or indirect damages resulting from the use of the software. Liability and Claims for damages of any kind are excluded.
 *
 * @copyright Copyright (c) 2011 netz98 new media GmbH (http://www.netz98.de)
 * @author netz98 new media GmbH <info@netz98.de>
 * @category N98
 * @package N98_Social
 */

/**
 * Provides social publishing buttons
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
    public function getFacebookImage()
    {
        // for facebook we have only a English an German version
        return ($this->getLanguage() == 'de') ? 'dummy_facebook.png' : 'dummy_facebook_en.png';
    }

    /**
     * Returns the configured facebook app id
     *
     * @return string
     */
    public function getFacebookAppId()
    {
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
        $config = array(
            'css_path' => $this->getSkinUrl('/css/socialshareprivacy.css'),
            'txt_help' => $this->__("When you activate this buttons by clicking, data will be send to the Facebook, Twitter or Google located in the USA. Data also might be stored. For more information click <em>i</em>."),
            'settings_perma' => $this->__("Activate permanently and accept that data is been send"),
            'info_link' => Mage::getStoreConfig('n98social/general/info_link'),
        );
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
                'dummy_img' => $this->getSkinUrl('/images/' . $this->getFacebookImage()),
                'language' => $this->getLocale(),
                'txt_info' => $this->__("2 clicks to protect your privacy: Only when you click here, the button will be activated and you can send your recommendation to Facebook. When you activate the button, data will be send to Facebook. See also <em>i</em>."),
                'txt_fb_off' => $this->__("not connected to Facebook"),
                'txt_fb_on' => $this->__("connected to Facebook"),
            );
        }

        if (Mage::getStoreConfig('n98social/twitter/enabled')) {
            $config['services']['twitter'] = array(
                'status' => 'on',
                'dummy_img' => $this->getSkinUrl('/images/dummy_twitter.png'),
                'txt_info' => $this->__("2 clicks to protect your privacy: Only when you click here, the button will be activated and you can send your recommendation to Twitter. When you activate the button, data will be send to Twitter. See also <em>i</em>."),
                'txt_twitter_off' => $this->__("not connected to Twitter"),
                'txt_twitter_on' => $this->__("connected to Twitter"),
            );
        }

        if (Mage::getStoreConfig('n98social/gplus/enabled')) {
            $config['services']['gplus'] = array(
                'status' => 'on',
                'dummy_img' => $this->getSkinUrl('/images/dummy_gplus.png'),
                'language' => $this->getLanguage(),
                'txt_info' => $this->__("2 clicks to protect your privacy: Only when you click here, the button will be activated and you can send your recommendation to Google+. When you activate the button, data will be send to Google. See also <em>i</em>."),
                'txt_gplus_off' => $this->__("not connected to Google"),
                'txt_gplus_on' => $this->__("connected to Google"),
            );
        }

        return $config;
    }

}