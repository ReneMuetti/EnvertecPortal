<?php
class Model_App
{
    const DEFAULT_ERROR_HANDLER = 'portalErrorHandler';
    
    /**
     * Application configuration object
     *
     * @var Model_Config
     */
    protected $_config;

    
    /**
     * Constructor
     */
    public function __construct()
    {
    }
    
    /**
     * Initialize application without request processing
     *
     * @param  string|array $code
     * @param  string|array $options
     * @return $this
     */
    public function init($code, $options = array())
    {
        $this->_initEnvironment();
        
        if (is_string($options)) {
            $options = array('dir'=>$options);
        }
        
        $this->_config = Portal::getConfig();
        $this->_config->setOptions($options);
        $this->_config->init($options);
        
        return $this;
    }
    
    /**
     * Initialize PHP environment
     *
     * @return $this
     */
    protected function _initEnvironment()
    {
        $this->setErrorHandler(self::DEFAULT_ERROR_HANDLER);
        return $this;
    }
    
    /**
     * Redeclare custom error handler
     *
     * @param   string $handler
     * @return  $this
     */
    public function setErrorHandler($handler)
    {
        set_error_handler($handler);
        return $this;
    }
    
    /**
     * Retrieve configuration object
     *
     * @return Model_Config
     */
    public function getConfig()
    {
        return $this->_config;
    }
}