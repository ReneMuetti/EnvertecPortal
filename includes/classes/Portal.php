<?php

final class Portal
{
    /**
     * Application model
     *
     * @var ModelApp
     */
    static private $_app;
    
    /**
     * Config Model
     *
     * @var Model_Config
     */
    static private $_config;
    
    /**
     * Application root absolute path
     *
     * @var string
     */
    static private $_appRoot;


    
    /**
     * Constructor
     */
    public function __construct()
    {
    }
    
    /**
     * Klasse freigeben
     */
    public function __destruct()
    {}

    /**
     * Get initialized application object.
     *
     * @param string $code
     * @param string|array $options
     * @return Model_App
     */
        
    public static function app($code = '', $options = array())
    {
        if ( is_null(self::$_app) ) {
            self::$_app = new Model_App();
            
            self::setRoot();            
            self::_setConfigModel($options);
            
            self::$_app->init($code, $options);
        }
        return self::$_app;
    }
    
    /**
     * @static
     * @param string $code
     * @param array $options
     */
    public static function init($code = '', $options = array())
    {
        try {
            self::setRoot();
            
            self::$_app = new Model_App();
            self::_setConfigModel($options);

            self::$_app->init($code, $options);
        } catch (Exception $e) {
            var_dump($e);
            die;
        }
    }

    /**
     * Retrieve model object
     *
     * @link    ModelConfig::getModelInstance
     * @param   string $modelClass
     * @param   array|object $arguments
     * @return  ModelAbstract|false
     */
    public static function getModel($modelClass = '', $arguments = array())
    {
       return self::getConfig()->getModelInstance($modelClass, $arguments);
    }
    
    /**
     * Retrieve a config instance
     *
     * @return Model_Config
     */
    public static function getConfig()
    {
        return self::$_config;
    }
    
    /**
     * Retrieve application root absolute path
     *
     * @return string
     */
    public static function getRoot()
    {
        return self::$_appRoot;
    }
    
    /**
     * Set application root absolute path
     *
     * @param string $appRoot
     * @throws Mage_Core_Exception
     */
    public static function setRoot($appRoot = '')
    {
        if (self::$_appRoot) {
            return ;
        }

        if ('' === $appRoot) {
            // automagically find application root by dirname of Portal.php
            $appRoot = dirname(__FILE__);
        }

        $appRoot = realpath($appRoot . DS . '..' . DS . '..' . DS);

        if (is_dir($appRoot) && is_readable($appRoot)) {
            self::$_appRoot = $appRoot;
        } else {
            self::throwException($appRoot . ' is not a directory or not readable by this user');
        }
    }
    
    /**
     * Retrieve application root absolute path
     *
     * @return string
     */
    public static function getBaseDir()
    {
        return self::$_appRoot;
    }
    
    /**
     * log facility (??)
     *
     * @param string $message
     * @param integer $level
     * @param string $file
     */
    public static function log($message, $level = null, $file = '')
    {
        static $loggers = array();
        
        $level  = is_null($level) ? Log_Writer::DEBUG : $level;

        $file = empty($file) ? 'error.log' : basename($file);

        try {
            if (!isset($loggers[$file])) {
                $logDir = self::getBaseDir() . DS . 'var' . DS . 'log';
                $logFile = $logDir . DS . $file;

                if (!is_dir($logDir)) {
                    mkdir($logDir);
                    chmod($logDir, 0750);
                }

                if (!file_exists($logFile)) {
                    file_put_contents($logFile, '');
                    chmod($logFile, 0640);
                }

                $format = '%timestamp% %priorityName% (%priority%): %message%' . PHP_EOL;
                $formatter = new Log_Formatter($format);
                $writer = new Log_Writer_Stream($logFile);
                $writer->setFormatter($formatter);
                $loggers[$file] = new Log_Writer($writer);
            }

            if (is_array($message) || is_object($message)) {
                $message = print_r($message, true);
            }

            $message = addcslashes($message, '<?');
            $loggers[$file]->log($message, $level);
        }
        catch (Exception $e) {
        }
    }
    
    
    
    
    
    /**
     * Set application Config model
     *
     * @param array $options
     */
    protected static function _setConfigModel($options = array())
    {
        if (isset($options['config_model']) && class_exists($options['config_model'])) {
            $alternativeConfigModelName = $options['config_model'];
            unset($options['config_model']);
            $alternativeConfigModel = new $alternativeConfigModelName($options);
        } else {
            $alternativeConfigModel = null;
        }

        if (!is_null($alternativeConfigModel) && ($alternativeConfigModel instanceof Model_Config)) {
            self::$_config = $alternativeConfigModel;
        } else {
            self::$_config = new Model_Config($options);
        }
    }
}