<?php
class Portal_Autoload
{
    /**
     * @var PortalAutoload
     */
    static protected $_instance;
    
    /**
     * Singleton implementation
     */
    static public function instance()
    {
        if( !self::$_instance ) {
            self::$_instance = new Portal_Autoload();
        }
        return self::$_instance;
    }
    
    /**
     * Register SPL autoload function
     */
    static public function register()
    {
        spl_autoload_register(array(self::instance(), 'autoload'));
    }
    
    /**
     * Load class source code
     *
     * @param string $class
     */
    public function autoload(string $class)
    {
        $fullFilename = realpath('.' . DS . 'includes' . DS . 'classes' . DS . str_replace('_', DS, ucwords($class) ) . '.php');
        
        if ( is_file($fullFilename) ) {
    		return @ include( $fullFilename );
    	}
    	else {
    		trigger_error("Classfile for $class can not loaded!!", E_USER_ERROR);
    	}
    }
}