<?php

namespace App\Controller\Sample;

use \Lollipop\Config;
use \Lollipop\HTTP\URL;

/**
 * Welcome Controller
 *
 * See `routes.php` on how this was working
 *
 */
class Welcome extends \App\Controller\Core\Base
{
    /**
     * @var string  Welcome message
     * 
     */
    private $messages = null;
    
    /**
     * Class construct
     * 
     */
    function __construct() {
        // Call parent construct function
        parent::__construct();
        
        // Instantiate model
        $this->messages = new \App\Model\Messages();
    }
    
    /**
     * Hello World!
     * 
     * @access  public
     * @param   \Lollipop\HTTP\Request  $req    HTTP Request Object
     * @param   \Lollipop\HTTP\Response $res    HTTP Response Object
     * @return  \Lollipop\HTTP\Response Response
     *
     */
    public function indexAction(\Lollipop\HTTP\Request $req, \Lollipop\HTTP\Response $res) {
        /**
         * Set meta tags
         * 
         */
        $this->view->title = 'Appogato: Affogato for the Web';
        $this->view->meta = [
            'author' => Config::get('app')->author,
            'description' => Config::get('app')->name,
            'keywords' => Config::get('app')->name
        ];

        $this->view->favicon = URL::base('static/img/favicon.ico');

        /**
         * Add CSS stylesheets
         * 
         */
        $this->view->css = [
            URL::base('static/css/normalize.css'),
            URL::base('static/css/skeleton.css'),
            URL::base('static/css/default.css')
        ];
        
        /**
         * JS to load
         * 
         * $this->view->js = [
         *       'https://code.jquery.com/jquery-3.2.1.min.js'
         *   ];
         * 
         */
        
        // Passing data to view
        $this->view->welcome_message = $this->messages->get('up');
        
        // If you want to compress application output uncomment code below
        //
        // ** ALREADY ENABLED VIA MIDDLEWARE GZIP **
        //
        //  $this->compress();

        // Start to render page
        return $this->render('welcome');
    }
}
