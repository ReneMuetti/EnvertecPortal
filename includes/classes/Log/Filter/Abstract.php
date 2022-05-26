<?php
abstract class Log_Filter_Abstract implements Log_Filter_Interface
{
    /**
     * Validate and optionally convert the config to array
     *
     * @param  array $config
     * @return array
     * @throws Zend_Log_Exception
     */
    static protected function _parseConfig($config)
    {
        if (!is_array($config)) {
            trigger_error('Configuration must be an array', E_USER_ERROR);
        }

        return $config;
    }
}