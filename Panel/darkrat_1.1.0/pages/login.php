<?php
if (isset($_POST['doLogin']))
{
		$username = $_POST['username'];
		$password = hash("sha256", $_POST['password']);
		if (ctype_alnum($username))
		{
			$sel = $odb->prepare("SELECT id,password FROM users WHERE username = :user");
			$sel->execute(array(":user" => $username));
			list($userid,$pass) = $sel->fetch();
			if ($pass != "" || $pass != NULL)
			{
				if ($password == $pass)
				{
					$i = $odb->prepare("INSERT INTO plogs VALUES(NULL, :user, :ip, :act, UNIX_TIMESTAMP())");
					$i->execute(array(":user" => $username, ":ip" => $_SERVER['REMOTE_ADDR'], ":act" => "Logged in"));
					$_SESSION['DarkRat'] = $username.":".$userid;
					header("Location: ?p=dashboard");
				}
			}
		}
	
}
?>
<div class="login-page" style="    width: 100%;">
      <div class="container d-flex align-items-center">
        <div class="form-holder has-shadow">
          <div class="row">
            <!-- Logo & Information Panel-->
            <div class="col-lg-6">
              <div class="info d-flex align-items-center">
                <div class="content">
                  <div class="logo">
                    <h1>DarkRat</h1>
                  </div>
                  <p>Please enter your login for acess to dashboard</p>
                </div>
              </div>
            </div>
            <!-- Form Panel    -->
            <div class="col-lg-6 bg-white">
              <div class="form d-flex align-items-center">
                <div class="content">
                  <form method="post" class="form-validate">
                    <div class="form-group">
                      <input id="username" type="text" name="username" required data-msg="Please enter your username" class="input-material">
                      <label for="username" class="label-material">User Name</label>
                    </div>
                    <div class="form-group">
                      <input id="password" type="password" name="password" required data-msg="Please enter your password" class="input-material">
                      <label for="password" class="label-material">Password</label>
                    </div>
        
                    <button type="submit" name="doLogin" class="btn btn-primary">Login</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<?php

include("partials/scripts.php");?>