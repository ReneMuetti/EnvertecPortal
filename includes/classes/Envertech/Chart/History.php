<?php
class Envertech_Chart_History
{
    /**
     * ID des Gateways
     *
     * @var string
     */
    protected $_gateway;
    
    /**
     * ID des Wechselrichters
     *
     * @var string
     */
    protected $_inverter;
    
    /**
     * Datum im Format yyyy-mm-dd
     *
     * @var string
     */
    protected $_date;

    
    /**
     * Constructor
     */
    public function __construct()
    {
    }
    
    /**
     * setzen von Monat und Jahr für die Abfrage der Daten
     *
     * @var string $name
     * @var string $value
     */
    public function setRequestValue($name, $value)
    {
        if ( strlen($name) AND strlen($value) ) {
            $vTmp = '_' . trim($name);
            $this->$vTmp = trim($value);
        }
        
        return $this;
    }

    /**
     * Abfrage der History-Daten
     *
     * @return json|array
     */
    public function sendRequest()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/ApiStations/GetHistoryChartData',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreal',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiStations/GetHistoryChartData',
                       'params' => array(
                           'stationId' => trim(StationID),
                           'gatewaySN' => $this->_gateway,
                           'sn'        => $this->_inverter,
                           'date'      => $this->_date,
                           'dateType'  => 'day',
                           'field'     => 'POWER',
                       )
                   )
               );
        $result = $curl->sendCurlRequest();
        $result = $this->parseJsonData($result);
        
        return $result;
    }
    
    /**
     * parse all Energy-Data
     *
     * @param json $jsonResult
     * @return array
     */
    public function parseJsonData($jsonResult)
    {
        $json   = json_decode($jsonResult);
        $return = array();

        if ( is_object($json->Data) ) {
            $_dataArray = (array)$json->Data;
            $_subArrays = array('powers', 'frequency', 'energy', 'temperature', 'dcvoltage', 'acvoltage'); // , 'sitetime'

            foreach( $_dataArray['sitetime'] AS $id => $value ) {
                $return[$value] = array();
                foreach($_subArrays AS $arrKey) {
                    $return[$value][$arrKey] = $_dataArray[$arrKey][$id];
                }
            }
        }
     
        return $return;
    }

}