<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * "StAuth10065: I James Gelfand, 000275852 certify that this material is my original work. 
 * No other person's work has been used without due acknowledgement. I have not made my work available to anyone else."
 */

class Admin extends CI_Controller {

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code

    // Load form validation
    $this->load->helper(array('form', 'url'));
    $this->load->library('form_validation');
    // Set validation rules
    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[userslab4.username]');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('accesslevel', 'Access Level', 'required|callback_access_check');

    // Validate form output
    $this->TPL['success'] = false;
    $this->TPL['error'] = false;

   $this->TPL['loggedin'] = $this->userauth->loggedin('admin');
   $this->TPL['active'] = array('home' => false,
                                'members'=>false,
                                'editors'=>false,
                                'admin' => true,
                                'login'=>false);

  }

  private function display()
  {
    // Display calls on our database to get our entries.
    $query = $this->db-> query("SELECT * FROM userslab4 ORDER BY compid ASC;");
    $this->TPL['listing'] = $query->result_array();

    $this->template->show('admin_view', $this->TPL);
  }

  public function index()
  {
    // Index just calls display.
    $this->display();
  }

  // Delete a user.
  public function delete($id)
  {
    $query = $this->db->query("DELETE FROM userslab4 where compid = '$id';");

    $this->display();
  }

  // Check if account has been frozen by ID.
  public function freeze($id)
  {
    $query = $this->db->query("SELECT frozen FROM userslab4 where compid = '$id';");
    $frozen = $query->row_array();

    if ($frozen['frozen'] == 'N') { 
      $query = $this->db->query("UPDATE userslab4 " .
      "SET frozen = 'Y'" .
      " WHERE compid = '$id';");
    }
    else {
      $query = $this->db->query("UPDATE userslab4 " .
      "SET frozen = 'N'" .
      " WHERE compid = '$id';");
    }
    // Update the display.
    $this->display();
  }

  public function newUser()
  {
    // perform form validation, if it fails, report failure
    if ($this->form_validation->run() == FALSE)
    {
      // set a template variable to report validation failure
      $this->TPL['error'] = true;
      $this->display();
    }
    else {
      $this->TPL['success'] = true;
      // This is processing a form, getting them into local variables.
      // Input and post to get the variables.
      $username = $this->input->post("username");
      $password = $this->input->post("password");
      $accesslevel = $this->input->post("accesslevel");
      // Use an insert query to put them into the database.
      $query = $this->db->query("INSERT INTO userslab4 VALUES (NULL, '$username', '$password', '$accesslevel', 'N');");
      redirect(current_url());
      $this->display();
    }
  }

  // Check string entry from user in form.
  public function access_check($str) 
  {
    if ($str === 'admin' || $str === 'member' || $str === 'editor') {
      return true;
    }
    else {
      $this->form_validation->set_message('access_check', 'Member access must be admin, member or editor in lowercase.');
      return false;
    }
  }

}