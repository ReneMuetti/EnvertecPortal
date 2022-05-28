<?php
/**
 * http://sven.stormbind.net/blog/posts/iot_pv_envertecportal_monitoring/
 */
class Envertech_Session
{
    /**
     * Configuration options
     *
     * @var Envertech_Session_Config
     */
    protected $_config;
    
   
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->_config = new Model_Config();
        
        $this->setSessionName();
        
        if( defined('Username') ) {
            $this->setUsername(Username);
        }
        if( defined('Password') ) {
            $this->setPassword(Password);
        }
    }
    
    /**
     * @return Model_Config
     */
    public function getConfig()
    {
        return $this->_config;
    }
    
    /**
     * Set Username for Login
     *
     * @param string Username
     * @return Envertech_Session
     */
    public function setUsername($value)
    {
        $this->getConfig()->addData(array('username' => $value));
        return $this;
    }
    
    /**
     * Set Password for Login
     *
     * @param string Password
     * @return Envertech_Session
     */
    public function setPassword($value)
    {
        $this->getConfig()->addData(array('password' => $value));
        return $this;
    }
    
    /**
     * Set Filename for Session
     *
     * @param string sessionFileName
     * @return Envertech_Session
     */
    public function setSessionName($value = SessionFile)
    {
        $this->getConfig()->addData(array('session' => $value));
        return $this;
    }
    
    /**
     * new Session for Requests
     */
    public function renewEnvertechSession()
    {
        $this->setUsername(Username);
        $this->setPassword(Password);

        $this->logoutEnvertechSession();
        $this->startEnvertechSession();
    }
    
    /**
     * get current Session-File with full path
     */
    public function getSessionFile()
    {
        return $this->getConfig()->getOptions()->getData()['session'] . DS .
               $this->getConfig()->getData()['session'];
    }

    /**
     * Alter der aktuellen Session prüfen
     */
    public function checkCurrentSessionState()
    {
        $_sessionFile = $this->getSessionFile();
        
        if ( is_file($_sessionFile) ) {
            $stat = stat($_sessionFile);
            
            $lastAccess = $stat[8];
            $maxTime    = $lastAccess + 23 * 60 * 60;
            $currTime   = time();
            
            if ( $currTime >= $maxTime ) {
                // Session expired
                $this->logoutEnvertechSession($_sessionFile);                
                return false;
            }
        }
        else {
            // no Session
            return  false;
        }
        
        // Session ready
        return true;
    }
    
    /**
     * Start Login-Session
     */
    public function startEnvertechSession()
    {
        $_sessionFile = $this->getSessionFile();

        if ( $this->checkCurrentSessionState() ) {
            // Session ist 24h gültig
            // nach 23h wird ausgeloggt und neu angemeldet
            return true;
        }

        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
           array(
               'url'    => 'https://www.envertecportal.com/apiaccount/login',
               'from'   => 'https://www.envertecportal.com/',
               'host'   => 'www.envertecportal.com',
               'app'    => '/apiaccount/login',
               'params' => array(
                   'userName' => $this->getConfig()->getData()['username'],
                   'pwd'      => $this->getConfig()->getData()['password']
               )
           )
       );
       $result = $curl->sendCurlRequest(false);

       return is_file( $_sessionFile );
    }
    
    /**
     * Logout current Session
     */
    public function logoutEnvertechSession()
    {
        $curl = Portal::getModel('Http/Client');
        $curl ->setOptions(
           array(
               'url'    => 'https://www.envertecportal.com/apiAccount/Logout',
               'from'   => 'https://www.envertecportal.com/',
               'host'   => 'www.envertecportal.com',
               'app'    => '/apiAccount/Logout',
               'params' => array(
               )
           )
        );
        $curl->sendCurlRequest(false);

        $this->deleteSessionFile();
    }
    
    /**
     * Delete current Session-File
     *
     * @param string $sessionFile
     */
    public function deleteSessionFile($sessionFile = null)
    {
        if ( is_null($sessionFile) ) {
            $sessionFile = $this->getSessionFile();
        }

        if ( is_file($sessionFile) ) {
            $state = unlink($sessionFile);

            if ( $state === false ) {
                trigger_error("Session-File not deleted\n" . $sessionFile , E_USER_ERROR);
            }
        }
        else {
            trigger_error("Session-File not found\n" . $sessionFile , E_USER_ERROR);
        }
    }
}