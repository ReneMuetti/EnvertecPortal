<?php

class Http_Client
{
    /**
     * Configuration options
     *
     * @var Http_Client_Options
     */
    protected $_options;
    
    /**
     * Configuration options
     *
     * @var Http_Client_Config
     */
    protected $_config;
    
    /**
     * current Responst while Session failed
     *
     * @var integer
     */
    private $_sessionCount = 0;
    
    /**
     * max Session Reload
     *
     * @var integer
     */
    private $_maxSessionCount = 3;

    /**
     * Substring in Valid Response
     *
     * @var string
     */
    private $_checkValifResponse = '"Status":"0"';
    
    /**
     * Substring in Response while Session is failed
     *
     * @var string
     */
    protected $_errorString = 'Web.Config Configuration File';
    
    /**
     * Substring in Valid Response
     *
     * @var bool
     */
    private $_lastResponseState;
    
    /**
     * UserAgent for cUrl
     *
     * @var bool
     */
    protected $_userAgentString;

    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_options = new Portal_Object();
        $this->_config  = new Model_Config();
        
        $this->_userAgentString = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:99.0) Gecko/20100101 Firefox/99.0';

    }
    
    /**
     * Destructor
     */
    public function __destruct()
    {
    }
    
    /**
     * @return Model_Config
     */
    public function getConfig()
    {
        return $this->_config;
    }
    
    /**
     * Initialization of core configuration
     *
     * @param array $options
     * @return $this
     */
    public function init($options = array())
    {
        $this->setOptions($options);
        return $this;
    }
    
    /**
     * Set configuration options
     *
     * @param array $options
     * @return $this
     */
    public function setOptions($options)
    {
        if (is_array($options)) {
            $this->getOptions()->addData($options);
        }
        return $this;
    }
    
    /**
     * Get configuration options object
     *
     * @return Model_Config_Options
     */
    public function getOptions()
    {
        return $this->_options;
    }
    
    /**
     * send CURL-Request
     */
    public function sendCurlRequest($checkResponse = true)
    {
        global $session;
 
        $_curl = curl_init();
        $_data = $this->_getFiledData();
        $_sessionFile = $this->getConfig()->getOptions()->getData()['session'] . DS . $session->getConfig()->getData()['session'];

        curl_setopt($_curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($_curl, CURLOPT_POST, true);
        curl_setopt($_curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($_curl, CURLOPT_CUSTOMREQUEST, "POST");
        
        curl_setopt($_curl, CURLOPT_COOKIEJAR,  $_sessionFile);
        curl_setopt($_curl, CURLOPT_COOKIEFILE, $_sessionFile);

        curl_setopt($_curl, CURLOPT_URL, $this->getOptions()->getData()['url']);
        
        curl_setopt($_curl, CURLOPT_USERAGENT, $this->_userAgentString);
        
        curl_setopt($_curl, CURLOPT_HTTPHEADER, array(
            'POST '        . $this->getOptions()->getData()['app'] . ' HTTP/1.1',
            'Host: '       . $this->getOptions()->getData()['host'],
            'Referer: '    . $this->getOptions()->getData()['from'],
            'User-Agent: ' . $this->_userAgentString,
            'Accept: application/json, text/javascript, */*; q=0.01',
            'Accept-Language: de,en-US;q=0.7,en;q=0.3',
            'Accept-Encoding: gzip, deflate, br',
            'Connection: keep-alive',
            'Upgrade-Insecure-Requests: 1',
        ));
        
        curl_setopt($_curl, CURLOPT_POSTFIELDS, $_data);

        $response = curl_exec($_curl);
        
        if ( $checkResponse === true ) {
            $this->_checkvalidResponse($_curl, $response);

            if ( $this->_lastResponseState === false ) {
                curl_close($_curl);
                
                if ( get_class($session) != 'Envertech_Session' ) {
                    $session = Portal::getModel('Envertech/Session');
                }

                $session->renewEnvertechSession();
                $this->sendCurlRequest();
            }
        }
        
        curl_close($_curl);
        
        return $response; 
    }
    
    /**
     * check if Response is valide
     *
     * @var cUrl $curl
     * @var string $response
     * @return bool
     */
    public function _checkvalidResponse($curl, $response)
    {
        $this->_sessionCount ++;

        // Max Repeat-Count
        if ( $this->_sessionCount > $this->_maxSessionCount ) {
            $this->_lastResponseState = true;
            return;
        }

        // Empty Response
        if ( !strlen($response) ) {
            $this->_lastResponseState = false;
            return;
        }
        
        // Session is expired
        if ( strpos($response, $this->_errorString) !== false ) {
            $this->_lastResponseState = false;
            return;
        }
        
        // No-Error-String in Response
        if ( strpos($response, $this->_checkValifResponse) !== false ) {
            $this->_lastResponseState = false;
            return;
        }
        
        // cUrl responde not HTMP-Code 200
        if ( curl_getinfo($curl, CURLINFO_RESPONSE_CODE) != 200 ) {
            $this->_lastResponseState = false;
            return;
        }
        
        // cUrl send Conncetion-Error
        if ( curl_getinfo($curl, CURLINFO_HTTP_CONNECTCODE) != 0 ) {
            $this->_lastResponseState = false;
            return;
        }
        
        $this->_lastResponseState = true;
    }
    
    /**
     * params for CURL-Request
     *
     * @param bool $urlencode
     * @return string
     */
    public function _getFiledData($urlencode = false)
    {
        $_data = $this->getOptions()->getData()['params'];

        $return = array();
        if ( is_array($_data) AND count($_data) ) {
            foreach( $_data AS $key => $value ) {
                $return[] = $key . '=' . $value;
            }
        }
        
        if ( $urlencode === true ) {
            return urlencode( implode("&", $return) );
        }
        else {
            return implode("&", $return);
        }
    }
}