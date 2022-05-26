<?php
class Envertech_Gatways
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
    public function getGatewayList()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/ApiStations/GetWayCount',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreal',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiStations/GetWayCount',
                       'params' => array(
                           'stationId' => trim(StationID),
                       )
                   )
               );
        $result = $curl->sendCurlRequest();
        $result = $this->getGatwayData($result);
        
        return $result;
    }
    
    /**
     * parse all Gateway-Informations
     *
     * @param json $jsonResult
     * @return array
     */
    public function getGatwayData($jsonResult)
    {
        $json   = json_decode($jsonResult);
        $return = array();

        if ( is_array($json->Data) AND count($json->Data) ) {
            foreach( $json->Data AS $id => $data ) {
                $return[$id] = trim( (string)$data->GATEWAYSN );
            }
        }
        
        return $return;
    }
}