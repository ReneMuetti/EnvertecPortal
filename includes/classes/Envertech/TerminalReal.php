<?php
class Envertech_TerminalReal
{
    /**
     * additional Query-Data
     */
    protected $_queryData;
    
    /**
     * Constructor
     */
    public function __construct()
    {
    }
    
    /**
     * zusätzlichen Wert für die Query-Data hinzufügen
     *
     * @param string $key
     * @param string $value
     * @return Envertech_TerminalReal
     */
    public function addQueryData($key, $value)
    {
        if ( strlen($key) AND strlen($value) ) {
            $this->_queryData[trim($key)] = trim($value);
        }
        
        return $this;
    }
    
    /**
     * list all Gateway-Ids
     *
     * @return json|array
     */
    public function sendRequest()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/ApiInverters/QueryTerminalReal',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreal',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiInverters/QueryTerminalReal',
                       'params' => array(
                           'page'    => 1,
                           'perPage' => 20,
                           'orderBy' => 'GATEWAYSN',
                           'whereCondition' => urlencode( json_encode($this->_queryData) )
                       )
                   )
               );
        $result = $curl->sendCurlRequest();
        $result = $this->parseJsonData($result);
        
        return $result;
    }
    
    public function parseJsonData($jsonResult)
    {
        $json   = json_decode($jsonResult);
        $return = array();

        if ( is_object($json->Data) ) {
            $_arrData = (array)$json->Data;
            
            foreach( $_arrData AS $key => $value ) {
                if ( is_array($value) OR is_object($value) ) {
                    $sub = array();
                    
                    // Sub-Objects
                    foreach( $value AS $skey => $sdata ) {
                        $sub[$skey] = array();
                        
                        // Daten aller Sub-Objects
                        $_addSub = (array)$sdata;
                        foreach( $_addSub AS $_soKey => $_soValue ) {
                            $sub[$skey][trim($_soKey)] = trim($_soValue);
                        }
                    }
                    
                    $return[trim($key)] = $sub;
                }
                else {
                    $return[trim($key)] = trim($value);
                }
            }
        }
        
        return $return;
    }
}