<?php
/**
 * Abstract configuration class
 *
 * Used to retrieve core configuration values
 */

class Model_Config_Base extends Portal_Object
{
    /**
     * @param string|null $sourceData
     */
    public function __construct($sourceData = null)
    {
        $this->_elementClass = 'Model_Config_Element';
        parent::__construct($sourceData);
    }
    
    
}