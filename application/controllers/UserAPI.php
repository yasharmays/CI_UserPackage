<?php

/**
 * Created by YS
 * Date: 26-12-2016
 *
 * User APIs are written in this file providing CRUD operations
 *
 */
require APPPATH . '/libraries/REST_Controller.php';

class UserAPI extends REST_Controller
{
    public $check_auth_client;

    function __construct()
    {
        // Construct the parent class
        parent::__construct();

        $this->check_auth_client = $this->users->check_auth_client();

    }

    public function getUsers_get()
    {
        if ($this->check_auth_client == true) {
            $users = $this->users->get_all_users();
            $this->response($users, 200);
        }
        else{
            $this->response(array('status' => 'failed','message' => 'Unauthorized.'));
        }

    }

    public function newUser_post()
    {
        if ($this->check_auth_client == true) {
            $userdata['firstName'] = $this->post('firstName');
            $userdata['lastName'] = $this->post('lastName');
            $userdata['email'] = !empty($this->post('email')) ? $this->post('email') : "";
            $userdata['phoneNumber'] = !empty($this->post('phoneNumber')) ? $this->post('phoneNumber') : "";
            $userdata['username'] = !empty($this->post('username')) ? $this->post('username') : "";
            $userdata['password'] = !empty($this->post('password')) ? $this->post('password') : "";
            $userdata['address'] = !empty($this->post('address')) ? $this->post('address') : "";

            $result = $this->users->api_new_user($userdata);

            if ($result === FALSE) {
                $this->response(array('status' => 'failed'));
            } else {
                $this->response(array('status' => 'success', 'message' => ' User created successfully'));
            }
        }
        else{
            $this->response(array('status' => 'failed','message' => 'Unauthorized.'), 401);
        }
    }

    public function editUser_post($user_id)
    {
        if ($this->check_auth_client == true) {
            $user =$this->users->get_user($user_id);
            if($user){
                $userdata = array(
                    'id'=> $user_id,
                    'firstName' => !empty($this->post('firstName')) ? $this->post('firstName') : $user->firstName,
                    'lastName' => !empty($this->post('lastName')) ? $this->post('lastName') : $user->lastName,
                    'email' => !empty($this->post('email')) ? $this->post('email') : $user->email,
                    'phoneNumber' => !empty($this->post('phoneNumber')) ? $this->post('phoneNumber') : $user->phoneNumber,
                    'username' => !empty($this->post('username')) ? $this->post('username') : $user->username,
                    'password' => !empty($this->post('password')) ? $this->post('password') : $user->password,
                    'address' => !empty($this->post('address')) ? $this->post('address') : $user->address,
                );

                $result = $this->users->api_update_user($userdata);
                $updatedUser = $this->users->get_user($user_id);
                if ($result === FALSE) {
                    $this->response(array('status' => 'failed'));
                } elseif ($result = true) {
                    $this->response(array('status' => 'success', 'message' => ' User updated successfully', 'updated user' => $updatedUser));
                } else {
                    $this->response(array('status' => 'failed', 'message' => ' Oops something went wrong'));
                }
            }
            else{
                $this->response(array('status' => 'failed', 'message' => ' No such user found'));
            }
        }
        else{
            $this->response(array('status' => 'failed','message' => 'Unauthorized.'), 401);
        }

    }

    public function deleteUser_post($user_id)
    {
        if ($this->check_auth_client == true) {
            $user =$this->users->get_user($user_id);
            if($user){
                $result = $this->users->delete_user($user_id);

                if ($result === FALSE) {
                    $this->response(array('status' => 'failed'));
                } else {
                    $this->response(array('status' => 'success', 'message' => ' User removed successfully'));
                }
            }
            else{
                $this->response(array('status' => 'failed', 'message' => ' No such user found'));

            }

        }
        else{
            $this->response(array('status' =>'failed' ,'message' => 'Unauthorized.'), 401);
        }
    }


}