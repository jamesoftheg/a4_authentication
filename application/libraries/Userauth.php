<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Userauth  { 
	  
    private $login_page = "";   
    private $logout_page = "";   
     
    private $username;
    private $password;
    private $accesslevel;

    /**
    * Turn off notices so we can have session_start run twice
    */
    function __construct() 
    {
      error_reporting(E_ALL & ~E_NOTICE);
      $this->login_page = base_url() . "index.php?/Login";
      $this->logout_page = base_url() . "index.php?/Home";
    }

    /**
    * @return string
    * @desc Login handling
    */
    public function login($username,$password) 
    {

      session_start();
        
      // User is already logged in if SESSION variables are good. 
      if ($this->validSessionExists() == true)
      {
        $this->redirect($_SESSION['basepage']);
      }

      // First time users don't get an error message.... 
      if ($_SERVER['REQUEST_METHOD'] == 'GET') return;
        
      // Check login form for well formedness.....if bad, send error message
      if ($this->formHasValidCharacters($username, $password) == false)
      {
         return "Username/password fields cannot be blank!";
      }
        
      // verify if form's data coresponds to database's data
      if ($this->userIsInDatabase($username, $password) == false)
      {
        return 'Invalid username/password!';
      }
      if ($this->accountFrozen($username) == false)
      {
        return 'Account frozen!';
      }
      else
      { 
        // We're in!
        // Redirect authenticated users to the correct landing page
        // ex: admin goes to admin, members go to members
	      $this->writeSession();
        $this->redirect($_SESSION['basepage']);
      }
    }
	
    /**
    * @return void
    * @desc Validate if user is logged in
    */
    public function loggedin($page) 
    {

      session_start();     
   
      // Users who are not logged in are redirected out
      if ($this->validSessionExists() == false)
      {
        $this->redirect($this->login_page);
      }
      
      // Access Control List checking goes here..
      // Does user have sufficient permissions to access page?
      // Ex. Can a bronze level access the Admin page?   

      $access = $_SESSION['accesslevel'];
      $CI =& get_instance();
      $acl = $CI->config->item('acl');

      // var_dump($acl['admin'][$access]);
      
      if ($acl[$page][$access] === false)
      {
        $this->redirect($_SESSION['basepage']);
      }

      return true;
    }
	
    /**
    * @return void
    * @desc The user will be logged out.
    */
    public function logout() 
    {
      session_start(); 
      $_SESSION = array();
      session_destroy();
      header("Location: ".$this->logout_page);
    }
    
    /**
    * @return bool
    * @desc Verify if user has got a session and if the user's IP corresonds to the IP in the session.
    */
    public function validSessionExists() 
    {
      session_start();
      if (!isset($_SESSION['username']))
      {
        return false;
      }
      else
      {
        return true;
      }
    }
    
    /**
    * @return void
    * @desc Verify if login form fields were filled out correctly
    */
    public function formHasValidCharacters($username, $password) 
    {
      // check form values for strange characters and length (3-12 characters).
      // if both values have values at this point, then basic requirements met
      if ( (empty($username) == false) && (empty($password) == false) )
      {
        $this->username = $username;
        $this->password = $password;
        return true;
      }
      else
      {
        return false;
      }
    }
	
    /**
    * @return bool
    * @desc Verify username and password with MySQL database.
    */
    public function userIsInDatabase($username, $password) 
    {
      // Remember: you can get CodeIgniter instance from within a library with:
      
      $CI =& get_instance();
      $CI->db->select('*');
      $CI->db->from('userslab4');
      $where = "username ='$username' AND password ='$password'";
      $CI->db->where($where);
      $query = $CI->db->get();
      $row = $query->row_array();
      
      // var_dump($row);

      if ($row > 0)  
      {  
        $this->accesslevel = $row['accesslevel'];
        return true;
      } 
      else 
      {
        return false; 
      }
    }
    
    public function accountFrozen($username) 
    {
      $CI =& get_instance();
      $CI->db->select('*');
      $CI->db->from('userslab4');
      $where = "username ='$username'";
      $CI->db->where($where);
      $frozen = $CI->db->get()->row()->frozen;

      if ($frozen == 'N')
      {
        return true;
      }
      else
      {
        return false;
      }
    }
    
    /**
    * @return void
    * @param string $page
    * @desc Redirect the browser to the value in $page.
    */
    public function redirect($page) 
    {
        header("Location: ".$page);
        exit();
    }
    
    /**
    * @return void
    * @desc Write username and other data into the session.
    */
    public function writeSession() 
    {
        $_SESSION['username'] = $this->username;
        $_SESSION['accesslevel'] = $this->accesslevel;
        //$_SESSION['basepage'] = base_url() . "index.php?/Members";
        
        $username = $this->username;

        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('userslab4');
        $where = "username ='$username'";
        $CI->db->where($where);
        $query = $CI->db->get()->row()->accesslevel;

        if ($query == 'member') {
          $_SESSION['basepage'] = base_url() . "index.php?/Members";
        }
        else if ($query == 'editor') {
          $_SESSION['basepage'] = base_url() . "index.php?/Editors";
        }
        else if ($query == 'admin') {
          $_SESSION['basepage'] = base_url() . "index.php?/Admin";
        }
        else {
          $_SESSION['basepage'] = base_url() . "index.php?/Admin";
        }

    }
	
    /**
    * @return string
    * @desc Username getter, not necessary 
    */
    public function getUsername() 
    {
        return $_SESSION['username'];
    }
		 
}
