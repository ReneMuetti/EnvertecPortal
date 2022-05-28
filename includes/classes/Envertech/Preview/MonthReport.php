<?php
class Envertech_Preview_MonthReport
{
    /**
     * Datum im englichen Format 
     * yyyy-mm
     *
     * @var string
     */
    protected $_date;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setDate(date("Y-m"));
    }
    
    public function setDate($value)
    {
        $_v = trim($value);
        
        if ( !empty($_v) ) {
            $this->_date = $_v;
        }
        else {
            $this->_date = date("Y-m");
        }
        
        return $this;
    } 
    
    /**
     * get Preview-Data for Month
     *
     * @return json|array
     */
    public function sendRequest()
    {
        global $session;
        
        $session->deleteSessionFile();
        
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
                   array(
                       'url'    => 'https://www.envertecportal.com/ApiReport/PreviewMonthReport',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreport',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiReport/PreviewMonthReport',
                       'params' => array(
                           'stationId' => trim(StationID),
                           'date'      => $this->_date,
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
                        $return[$id][(string)$dValue->DateTime] = (string)$dValue->Energy;
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