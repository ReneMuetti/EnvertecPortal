<?php
class Envertech_Preview_DailyReport
{
    /**
     * Datum im englichen Format 
     * yyyy-mm-dd
     *
     * @var string
     */
    protected $_date;

    /**
     * Inverter-Serial
     *
     * @var string
     */
    protected $_inverter;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setRequestValue('date', date('Y-m-d'));
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
     * list all Gateway-Ids
     *
     * @return json|array
     */
    public function sendRequest()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/ApiReport/PreviewDailyReport',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreport',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiReport/PreviewDailyReport',
                       'params' => array(
                           'stationId' => trim(StationID),
                           'date'      => $this->_date,
                           'sn'        => $this->_inverter,
                       )
                   )
               );
        $result = $curl->sendCurlRequest();
        $result = $this->parseJsonData($result);
        
        return $result;
    }
    
    /**
     * parse all Json-Data
     *
     * @param json $jsonResult
     * @return array
     */
    public function parseJsonData($jsonResult)
    {
        $json   = json_decode($jsonResult);
        $return = array();

        if ( is_object($json->Data) ) {
            foreach( $json->Data AS $id => $data ) {
                if ( is_object($data) OR is_Array($data) ) {
                    $return[$id] = array();
                    
                    foreach( $data AS $_dId => $dValue ) {
                        $return[$id][(string)$dValue->UpdateTime] = array(
                                                                        'InverterNr'  => (string)$dValue->SN,
                                                                        'DCVoltage'   => (string)$dValue->PV,
                                                                        'ACVoltage'   => (string)$dValue->Vac,
                                                                        'Output'      => (string)$dValue->Power,
                                                                        'Frequency'   => (string)$dValue->Frq,
                                                                        'Temperature' => (string)$dValue->Temperature,
                                                                        'EnergyTotal' => (string)$dValue->ETotal,
                                                                    );
                    }
                }
                else {
                    $return[$id] = trim( $data );
                }
            }
        }
        
        return $return;
    }
}