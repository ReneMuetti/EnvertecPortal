<?php
class Envertech_Chart_DayPower
{
    /**
     * Datum im englichen Format 
     * yyyy-mm-dd
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
     * Datum für die Energie-Status-Abfrage setzen
     *
     * @var string $value
     */
    public function setDate($value)
    {
        $this->_date = trim($value);
        return $this;
    }
    
    /**
     * abfrage aller Eneriedaten eines bestimmten Tages
     *
     * @return json|array
     */
    public function sendRequest()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/ApiStations/GetDayPowerChartDate',
                       'from'   => 'https://www.envertecportal.com/terminal/systemoverview',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiStations/GetDayPowerChartDate',
                       'params' => array(
                           'stationId' => trim(StationID),
                           'date'      => $this->_date,
                           'chartType' => 'day',
                       )
                   )
               );
        $result = $curl->sendCurlRequest();
        $result = $this->parseJsonData($result);
        
        return $result;
    }
    
    /**
     * parse all Energy-Informations
     *
     * @param json $jsonResult
     * @return array
     */
    public function parseJsonData($jsonResult)
    {
        $json   = json_decode($jsonResult);
        $return = array();
        
        if ( is_array($json->Data) AND count($json->Data) ) {
            foreach($json->Data AS $id => $data) {
                $return[trim((string)$data->DateTime)] = trim((string)$data->Value);
            }
        }
     
        return $return;
    }
}