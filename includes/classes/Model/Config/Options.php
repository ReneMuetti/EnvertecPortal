<?php
class Model_Config_Options extends Portal_Object
{
    /**
     * Initialize default values of the options
     */
    protected function _construct()
    {
        $appRoot = Portal::getRoot();
        $root    = dirname($appRoot);

        $this->_data['base_dir'] = $root;
        $this->_data['app_dir']  = $appRoot;
        $this->_data['var']      = $appRoot . DS . 'var';
        $this->_data['session']  = $appRoot . DS . 'var' . DS . 'session';
        $this->_data['log']      = $appRoot . DS . 'var' . DS . 'log';
    }
}