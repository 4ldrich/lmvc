<?php

namespace LMVC\Controller;

/**
 * {name} Controller
 * 
 * @package     {package}
 * @version     1.0
 * @author      {author}
 * @email       {email}
 * 
 */
class {name} extends \LMVC\Controller\Core\Base
{
    /**
     * Class construct
     * 
     * @access  public
     * @return  void
     * 
     */
    function __construct() {
        // Call parent construct function
        parent::__construct();
        
        // @todo    Load helpers and models here
    }
    
    /**
     * Index Action
     * 
     * @access  public
     * @return  void
     * 
     */
    public function indexAction() {
        // @todo    Insert actions here
        return 'Hello World!';
    }
}
