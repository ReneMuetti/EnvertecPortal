<?php
class Envertech_Station
{    
    /**
     * Constructor
     */
    public function __construct()
    {
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
                       'url'    => 'https://www.envertecportal.com/ApiStations/GetSunNavStationList',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreal',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiStations/GetSunNavStationList',
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
     * parse all Station-Informations
     *
     * @param json $jsonResult
     * @return array
     */
    public function parseJsonData($jsonResult)
    {
        $json   = json_decode($jsonResult);
        $return = array();

        if ( is_array($json->Data) AND count($json->Data) ) {
            foreach( $json->Data AS $id => $data ) {
                $return['Name']       = trim( (string)$data->Key );
                $return['StationID'] = trim( (string)$data->Val );
            }
        }
        
        return $return;
    }
}