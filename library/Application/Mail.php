 <?php

class Application_Mail Extends Zend_Mail
{
  /**
     * Transport adapter configuration array
     *
     * @var array
     */
    private     $_config;
  /**
     * Transport adapter 
     *
     * @var Zend_Mail_Transport adapter
     */
    private     $_transport;
  /**
     * Sending method
     *
     * @var string ( smtp|smtp/tls|phpmail)
     */
    private     $_method;


   /**
     * Constructor.
     *
     * @param  string $host OPTIONAL (Default: 127.0.0.1)
     * @param  array|null $config OPTIONAL (Default: null)
     * @return void
     */
    public function __construct( $method = 'mail', $charset = 'UTF-8' ) 
    {
        $this->_method              = $method;
        $this->_charset             = $charset;

        switch ( $this->_method ) {
            // Methode d'envoi par SMTP sécurisé TLS
            case 'smtp/tls' : 
                $this->_config      = array( 'auth' => 'login',
                                             'username' => Zend_Registry::get('config')->mailer->smtpUser,
                                             'password' => Zend_Registry::get('config')->mailer->smtpPwd,
                                             'ssl' => 'tls',
                                             'port' => Zend_Registry::get('config')->mailer->smtpPort
                                            );
                $this->_transport   = new Zend_Mail_Transport_Smtp( Zend_Registry::get('config')->mailer->smtpHost, $this->_config );
                Zend_Mail::setDefaultTransport( $this->_transport );
            break;
            // Méthode d'envoi par SMTP classique
            case 'smtp' :
                $this->_config      = array( 'port' => Zend_Registry::get('config')->mailer->smtpPort );
                $this->_transport   = new Zend_Mail_Transport_Smtp( Zend_Registry::get('config')->mailer->smtpHost, $this->_config );
                Zend_Mail::setDefaultTransport( $this->_transport );
            break;
            // Méthode d'envoi par fonction mail() ( fonctionnement par défaut)
            case 'mail' :
                // nothing 
            break;
            default :
                // nothing 
            break;
        }
        
    }
}