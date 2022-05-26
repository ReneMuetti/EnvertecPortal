<?php
class Model_Config extends Model_Config_Base
{
    /**
     * Configuration options
     *
     * @var Model_Config_Options
     */
    protected $_options;
    
    /**
     * Class construct
     *
     * @param mixed $sourceData
     */
    public function __construct($sourceData = null)
    {
        $this->_options = new Model_Config_Options($sourceData);
        parent::__construct($sourceData);
    }
    
    /**
     * Initialization of core configuration
     *
     * @param array $options
     * @return $this
     */
    public function init($options = array())
    {
        $this->setOptions($options);

        //$this->loadModules();
        //$this->loadDbConfig();
        //$this->saveCache();
        return $this;
    }
    
    /**
     * Set configuration options
     *
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        if (is_array($options)) {
            $this->getOptions()->addData($options);
        }
        return $this;
    }
    
    /**
     * Get configuration options object
     *
     * @return Model_Config_Options
     */
    public function getOptions()
    {
        return $this->_options;
    }
    
    /**
     * Get model class instance.
     *
     * @param string $modelClass
     * @param array|object $constructArguments
     * @return Model_Abstract|false
     */
    public function getModelInstance($modelClass = '', $constructArguments = array())
    {
        $className = $this->getModelClassName($modelClass);
        if (class_exists($className)) {
            return new $className($constructArguments);
        } else {
            return false;
        }
    }
    
    /**
     * Retrieve module class name
     *
     * @param   string $modelClass
     * @return  string
     */
    public function getModelClassName($modelClass)
    {
        $modelClass = trim($modelClass);

        if (strpos($modelClass, '/') === false) {
            return $modelClass;
        }
        return $this->getGroupedClassName($modelClass);
    }
    
    /**
     * Retrieve class name by XPath
     *
     * @param   string $classId slash separated class identifier, ex. group/class
     * @return  string
     */
    public function getGroupedClassName($classId)
    {
        $classArr = explode('/', trim($classId));
        $group = $classArr[0];
        $class = !empty($classArr[1]) ? $classArr[1] : null;

        $className = '';
        
        if (empty($classArr)) {
            $className = 'Portal_' . $classId;
        }
        if (!empty($class)) {
            $className = $group . '_' . $class;
        }
        $className = ucwords($className);

        return $className;
    }
}