<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

set_include_path(
    '.'
    . PATH_SEPARATOR
    . realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..')
    . PATH_SEPARATOR
    . get_include_path()
);

// include magento libs
require_once 'app/Mage.php';
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . 'config.php';

/**
 * Pseudo error handler. If function returns false the
 * default PHP error handler will be triggered.
 *
 * @return boolean
 */
function n98TestErrorHandler()
{
    return false;
}

umask(0);

Mage::setIsDeveloperMode(true);
Mage::app('admin')
    ->setUseSessionInUrl(false)
    ->setErrorHandler('n98TestErrorHandler') // restore default php error handler
    ->cleanCache(); // remove magento cache files. This must be to use test store configs
