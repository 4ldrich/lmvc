<?php

namespace App\Controller\Core;

use \Lollipop\Config;
use \Lollipop\Log;
use \Lollipop\Page;
use \Lollipop\HTTP\Response;
use \Lollipop\HTTP\Request;
use \Lollipop\Session;

/**
 * Base Controller
 * 
 * @package Appogato
 * @author  John Aldrich Bernardo
 * @version 1.2
 * 
 */
class Base
{
    /**
     * @var     \stdClass    View variable holder
     * 
     */
    public $view = null;
    
    /**
     * Compress output
     *
     * @var bool
     */
    public $compress = false;

    /**
     * @var     array   Cookies
     * 
     */
    public $cookies = [];
    
    /**
     * @var     array   Headers
     * 
     */
    public $headers = [];

    /**
     * Class Construct
     * 
     */
    function __construct() {
        $this->view = new \stdClass();

        // Set all default view variables on class constuct
        $this->_setDefaultView();
    }
    
    /**
     * Set default view variables
     * 
     * @access  private
     * @return  void
     * 
     */
    private function _setDefaultView() {
        // Title
        $this->view->title = Config::get('app')->name;
        
        // Page name
        $this->view->page = 'home';
        
        // JS Files
        $this->view->js = [];
        
        // CSS Files
        $this->view->css = [];

        // Domain name
        $this->view->domain = \Lollipop\HTTP\URL::base();
        
        // Request URL
        $this->view->request_uri = \Lollipop\HTTP\URL::here();
    }
    
    /**
     * Generate data
     * 
     * @access  private
     * @return  array
     * 
     */
    private function _getViewData() {
        $d = [];
        
        // Build-up data
        foreach (get_object_vars($this->view) as $var => $val) {
            $d[$var] = $val;
        }
        
        return $d;
    }
    
    /**
     * Process response
     * 
     * @access  private
     * @
     * 
     */
    private function _createResponse($page) {
        // Render view
        $rendered = Page::render(APP_CORE_VIEW . $page . '.php', $this->_getViewData());
        
        // Create response
        $response = new Response($rendered);
        
        // Set response cookies
        $response->cookies($this->cookies);
        
        // Set response headers
        $response->header($this->headers);

        // Check if Debugger is enabled
        // Then let debugger turn-on the gzip compression
        $req = new Request();

        if (Config::get('debugger') && !$req->hasQuery('disable-debugger')) {
            Session::set('debugger-compress-output', $this->compress);
        } else {
            // else
            $response->compress($this->compress);
        }

        return $response;
    }

    /**
     * Compress output
     *
     * @param   boolean $enable
     * @return  void
     */
    public function compress($enable = true) {
        $this->compress = $enable;
    }
    
    /**
     * Render structure
     * 
     * @access  public
     * @param   string   $struct
     * @return  string
     * 
     */
    public function render($page) {
        return $this->_createResponse($page);
    }
}
