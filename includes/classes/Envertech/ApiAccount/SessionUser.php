<?php
class Envertech_ApiAccount_SessionUser
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
                       'url'    => 'https://www.envertecportal.com/ApiAccount/GetSessionUser',
                       'from'   => 'https://www.envertecportal.com/terminal/systemreport',
                       'host'   => 'www.envertecportal.com',
                       'app'    => '/ApiAccount/GetSessionUser',
                       'params' => array(
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

        if ( is_object($json->Data) ) {
            foreach( $json->Data AS $id => $data ) {
                $return[$id] = $data;
            }
        }
        
        return $return;
    }
}