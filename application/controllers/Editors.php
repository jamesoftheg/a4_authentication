<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Editors extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code

   $this->TPL['loggedin'] = $this->userauth->loggedin('editors');
   $this->TPL['active'] = array('home' => false,
                                'members'=>false,
                                'editors'=>true,
                                'admin' => false,
                                'login'=>false);

  }

  public function index()
  {
    $this->template->show('editors_view', $this->TPL);
  }
}