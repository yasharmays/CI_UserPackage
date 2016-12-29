<?php
//$users= $this->db->get('users');
if ($_POST) {
    if (!$_POST['firstName']) {
        $_POST['firstName'] = $user->firstName;
    }
    if (!$_POST['lastName']) {
        $_POST['lastName'] = $user->lastName;
    }
    if (!$_POST['phoneNumber']) {
        $_POST['phoneNumber'] = !empty($user->phoneNumber)?$user->phoneNumber:"";
    }
    if (!$_POST['email']) {
        $_POST['email'] = !empty($user->email)?$user->email:"";
    }
    if (!$_POST['address']) {
        $_POST['address'] = !empty($user->address)?$user->address:"";
    }
    if (!$_POST['password']){
        $_POST['password']=$user->password;
    }
    $change = $this->users->update_user($user->id);

    if($change == true){
        $message = array('message' => 'User updated successfully','class' => 'alert alert-success fade in');
        $this->session->set_flashdata('item', $message);

    }else{
        $message = array('message' => 'Oops! something went wrong','class' => 'alert alert-danger fade in');
        $this->session->set_flashdata('item',$message );
    }
    $this->load->helper('url');
    $url = prep_url('http://localhost/ci_user/');
    redirect($url);
}

?>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body  class="col-md-10">
<div class="container" >
    <h1 class="header"><?php echo $heading; ?></h1>
</div>
<form id="editUser" class="col-md-8" action="" method="post">
    <div class="form-group">
        <input class="form-control" type="text" name="firstName" value="<?php echo $user->firstName; ?>"/>
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="lastName" value="<?php echo $user->lastName; ?>"/>
    </div>
    <div class="form-group">
        <input class="form-control" type="text" name="username" value="<?php echo $user->username; ?>"/>
    </div>
    <div class="form-group">
        <input class="form-control" type="password" name="password" placeholder="Update Password"/>
    </div>
    <div class="form-group">
        <input class="form-control" type="email" name="email" value="<?php echo $user->email; ?>"/>
    </div>
    <div class="form-group">
        <input class="form-control" type="tel" name="phoneNumber" value="<?php echo $user->phoneNumber; ?>"/>
    </div>
    <div class="form-group">
        <textarea class="form-control" name="address"><?php echo $user->address; ?></textarea>
    </div>
<!--    <input type="hidden" name="id" value="--><?php //echo $user->id; ?><!--"/>-->
    <div class="form-group">
        <button class="btn btn-default" type="submit">Update</button>
    </div>
</form>
<script src="https://code.jquery.com/jquery-3.1.1.min.js" integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</body>
</html>
