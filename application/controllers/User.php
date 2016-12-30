<?php
/**
 * User Controller
 */

class User extends CI_Controller
{

    public function index()
    {
        $data['user_list'] = $this->users->get_all_users();
        $data['title'] = "Users";
        $data['heading'] = "Users";
        $data['deleted'] ="no";
        $this->load->view('users/user_view', $data);
    }

    public function newUser()
    {
        $data['title'] = "Users | New";
        $data['heading'] = "Add New User";
        $this->load->view('users/user_new', $data);

    }
    public function editUser($user_id)
    {
        if($user_id){
            $user =$this->users->get_user($user_id);
            if($user){

                $title= $user[0]->title;
                $data['user_id']= $user_id;
                $data['user_fname']= $user[0]->firstName;
                $data['user_lname']= $user[0]->lastName;
                $data['$user_email']= $user[0]->email;
                $data['title'] = "$title | Edit";
                $data['heading'] = "Edit $title";
                $data['description']= $user[0]->description;
                $this->load->view('users/user_edit', $data);
            }
        }
    }

    public function deleteUser($user_id){
        if($user_id){
            $user =$this->users->get_user($user_id);
            if($user){
               $change = $this->users->delete_user($user_id);
                $data['change']=$change;
                $data['todo_list'] = $this->users->get_last_ten_users();
                $data['title'] = "Users";
                $data['heading'] = "Users to do";
                $data['deleted'] ="yes";
                $this->load->view('users/user_view', $data);
            }
        }
    }
}