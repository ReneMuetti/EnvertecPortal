<?php
class Envertech_Preview_YearReport
{
    /**
     * Jahr im 4-stelligen Format 
     * yyyy
     *
     * @var string
     */
    protected $_year;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->setYear(date("Y"));
    }
    
    public function setYear($value)
    {
        $_v = trim($value);
        
        if ( !empty($_v) ) {
            $this->_year = $_v;
        }
        else {
            $this->_year = date("Y");
        }
        
        return $this;
    } 
    
    /**
     * get Preview-Data for Year
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
                       'url'    => 'https://www.envertecportal.com/ApiReport/PreviewYearReport',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreport',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiReport/PreviewYearReport',
                       'params' => array(
                           'stationId' => trim(StationID),
                           'date'      => $this->_year,
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