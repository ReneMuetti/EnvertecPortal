<?php
class Envertech_StationInfo
{
    /**
     * Constructor
     */
    public function __construct()
    {
    }
    
    /**
     * list all Station Information
     *
     * @return json|array
     */
    public function sendRequest()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/ApiStations/getStationInfo',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreal',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiStations/getStationInfo',
                       'params' => array(
                           'stationId' => trim(StationID),
                       )
                   )
               );
        $result = $curl->sendCurlRequest();
        $result = $this->parseJsonData($result);
        
        return $result;
    }
    
    /**
     * parse all current Station-Information
     *
     * @param json $jsonResult
     * @return array
     */
    public function parseJsonData($jsonResult)
    {
        $json   = json_decode($jsonResult);
        $return = array();

        if ( is_object($json->Data) ) {
            $_arrayData = (array)$json->Data;

            foreach( $_arrayData AS $key => $value ) {
                $return[trim($key)] = trim($value);
            }
        }
        
        return $return;
    }
}