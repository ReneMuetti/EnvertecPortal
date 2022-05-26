<?php
interface Log_FactoryInterface
{
    /**
     * Construct a Zend_Log driver
     *
     * @param  array $config
     * @return Log_FactoryInterface
     */
    static public function factory($config);
}