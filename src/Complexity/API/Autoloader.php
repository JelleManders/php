<?php

/**
 * @license         Berkeley Software Distribution License (BSD-License 2) http://www.opensource.org/licenses/bsd-license.php
 * @author          Roemer Bakker
 * @copyright       Complexity Software
 */

namespace SpryngPaymentsApiPhp;

/**
 * PSR-0 Autoloader for Composer
 *
 * Class Spryng_Payments_Api_Autoloader
 * @package SpryngPaymentsApiHttpPhp
 */
class Spryng_Payments_Api_Autoloader
{
    /**
     * Finds all classes and requires them
     *
     * @param string $class_name
     */
    public static function autoload ($class_name)
    {
        if (strpos($class_name, "Spryng_Payments_") === 0)
        {
            $file_name = str_replace("_", "/", $class_name);
            $file_name = realpath(dirname(__FILE__) . "/../../{$file_name}.php");
            if ($file_name !== false)
            {
                require_once($file_name);
            }
        }
    }

    /**
     * Register all classes
     *
     * @return bool
     */
    public static function register ()
    {
        return spl_autoload_register(array(__CLASS__, "autoload"));
    }

    /**
     * Unregister all classes
     *
     * @return bool
     */
    public static function unregister ()
    {
        return spl_autoload_unregister(array(__CLASS__, "autoload"));
    }
}