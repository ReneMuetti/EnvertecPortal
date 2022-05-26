<?php
class Envertech_StationId
{
    /**
     * StationID aus dem Portal von Envertec
     *
     * @var string 32-Zeichen
     */
    protected $_stationIdentifier;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_stationIdentifier = "var stationId = '";
    }
    
    /**
     * grab StationID from current User
     *
     * @return string
     */
    public function sendRequest()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/terminal/systemoverview',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreal',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/terminal/systemoverviewt',
                       'params' => array(
                       )
                   )
               );
        $result = $curl->sendCurlRequest();
        $result = $this->getCurrentStationId($result);
        
        return $result;
    }

    /**
     * extract StationID
     *
     * @param string $code
     * @return string
     */
    public function getCurrentStationId($code)
    {
        $tmp = 'StationID notr found!';
        
        if ( !strlen($code) ) {
            return 'Error ' . __CLASS__ . '::' . __FUNCTION__ . ' (' . __LINE__ . ')';
        }
        else {
            $page = explode("\n", $code);
            foreach( $page AS $id => $line ) {
                if ( strpos($line, $this->_stationIdentifier) !== false ) {
                    break;
                }
            }
            
            if ( strlen($line) AND (strpos($line, $this->_stationIdentifier) !== false) ) {
                $tmp = trim($line);
                $tmp = substr($tmp, strlen($this->_stationIdentifier));
                $tmp = substr($tmp, 0, -2);
            }
            
            return $tmp;
        }
    }
}