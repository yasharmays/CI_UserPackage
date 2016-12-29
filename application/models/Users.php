<?php
/**
 * User Controller
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Model
{

    public $id;
    public $firstName;
    public $lastName;
    public $email;
    public $username;
    public $password;
    public $address;
    public $phoneNumber;
    public $otp;
    public $appToken;
    public $socialMediaId;
    public $createdOn;
    public $updatedOn;

    public function __construct()
    {
        // Call the CI_Model constructor
        parent::__construct();
    }

    public function get_last_ten_users()
    {
        $query = $this->db->get('users', 10);
        return $query->result();
    }

    public function get_all_users()
    {
        $query = $this->db->get('users');
        return $query->result();
    }

    public function insert_user()
    {
        $this->firstName = $_POST['firstName'];
        $this->lastName = $_POST['lastName'];
        $this->email = $_POST['email'];
        $this->username = $_POST['username'];
        $this->phoneNumber = $_POST['phoneNumber'];
        $this->password = $_POST['password'];
        $this->address = $_POST['address'];
        $this->createdOn = date('Y-m-d H:i:s');
        $this->db->insert('users', $this);
        return true;
    }

    public function update_user($user_id)
    {
        $this->id = $user_id;
        $this->firstName = $_POST['firstName'];
        $this->lastName = $_POST['lastName'];
        $this->email = $_POST['email'];
        $this->username = $_POST['username'];
        $this->phoneNumber = $_POST['phoneNumber'];
        $this->password = $_POST['password'];
        $this->address = $_POST['address'];
        $this->updatedOn = date('Y-m-d H:i:s');
        $this->db->update('users', $this, array('id' => $user_id));
        return true;
    }

    public function get_user($user_id)
    {
        $user = $this->db->get_where('users', array('id' => $user_id));
        return $user->row();
    }

    public function delete_user($user_id)
    {
        $this->db->delete('users', array('id' => $user_id));
        return true;
    }

    //API Functions

    public function check_auth_client()
    {
        $auth_key = $this->input->get_request_header('Auth-Key', TRUE);
        if ($auth_key == 'simplerestapi') {
            return true;
        } else {
            return false;
        }
    }

    public function api_new_user($userdata)
    {
        $this->firstName = $userdata['firstName'];
        $this->lastName = $userdata['lastName'];
        $this->email = $userdata['email'];
        $this->password = $userdata['password'];
        $this->phoneNumber = $userdata['phoneNumber'];
        $this->address = $userdata['address'];
        $this->createdOn = date('Y-m-d H:i:s');
        $this->db->insert('users', $this);
        return true;
    }

    public function api_update_user($userdata)
    {
        $this->id = $userdata['id'];
        $this->firstName = $userdata['firstName'];
        $this->lastName = $userdata['lastName'];
        $this->email = $userdata['email'];
        $this->password = $userdata['password'];
        $this->phoneNumber = $userdata['phoneNumber'];
        $this->address = $userdata['address'];
        $this->updatedOn = date('Y-m-d H:i:s');
        $this->db->update('users', $this, array('id' => $userdata['id']));
        return true;
    }


}
