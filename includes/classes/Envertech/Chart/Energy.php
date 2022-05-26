<?php
class Envertech_Chart_Energy
{
    /**
     * RequestYear
     *
     * @var integer 4-Digits
     */
    protected $_year;
    
    /**
     * RequestVar
     *
     * @var string 2-Digits
     */
    protected $_month;

    
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
     * Abfrage der Energie-Daten
     *
     * @return json|array
     */
    public function sendRequest()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/ApiStations/GetEnergyChartData',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreal',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiStations/GetEnergyChartData',
                       'params' => array(
                           'stationId' => trim(StationID),
                           'year'      => $this->_year,
                           'month'     => $this->_month,
                           'chartType' => 'month',
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
        
        if ( is_array($json->Data) AND count($json->Data) ) {
            foreach($json->Data AS $id => $data) {
                $return[trim((string)$data->xAxis)] = trim((string)$data->yAxis);
            }
        }
     
        return $return;
    }
}