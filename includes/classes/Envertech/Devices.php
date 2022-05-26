<?php
class Envertech_Devices
{
    /**
     * Set Phase-Mode
     */
    protected $_phaseMode;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setPhaseMode();
    }
    
    /**
     * Set Phase-Mode für Inverters
     *
     * @param string $mode   single|three
     */
    public function setPhaseMode($mode = 'single')
    {
        switch($mode) {
            case 'single': $this->_phaseMode = '';
                           break;
            case 'three' : $this->_phaseMode = 'ABC';
                           break;
            default      : $this->_phaseMode = '';
                           break;
        }
        
        return $this;
    }
    
    /**
     * list all Device-Ids
     *
     * @return json|array
     */
    public function sendRequest()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/ApiStations/GetDevices' . $this->_phaseMode,
                       'from'   => 'https://www.envertecportal.com/terminal/systemreal',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiStations/GetDevices' . $this->_phaseMode,
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
     * parse all Device-Informations
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
                $return[trim( (string)$data->GatewaySN )] = array(
                                                                'GatewayAlias' => trim( (string)$data->GatewayAlias ),
                                                                'Invertrers'   => $this->getInverterData($data)
                                                            );
            }
        }
     
        return $return;
    }
    
    /**
     * list all Interters
     * Format: array(SN => Alias)
     */
    public function getInverterData($invData)
    {
        $return = array();

        if( $this->_phaseMode == '' ) {
            $invData = $invData->Invs;
            foreach( $invData AS $key => $value ) {
                $return[trim((string)$value->SN)] = trim((string)$value->Alias);
            }
        }
        else {
            $_phaseArray = array('AA', 'BB', 'CC');
            foreach( $_phaseArray AS $index => $v ) {
                $_newKey = 'Invs' . $v;
                $_invArray = (array)$invData->$_newKey;
                foreach( $_invArray AS $_invData ) {
                    $return[$v][trim((string)$_invData->SN)] = trim((string)$_invData->Alias);
                }
            }
        }        

        return $return;
    }
}