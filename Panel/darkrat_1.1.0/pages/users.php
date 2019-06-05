
<div class="page-content" style="padding-bottom: 70px;">
        <!-- Page Header-->

        <!-- Breadcrumb-->
        <div class="container-fluid">
          <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="?p=dashboard">DarkRat</a></li>
            <li class="breadcrumb-item active">User Management            </li>
          </ul>
        </div>
        <section class="no-padding-top">
          <div class="container-fluid">

        <div class="row">

            <div class="col-sm">
            <?php
						if ($userperms == "user")
						{
                            echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.error('You do not have permission to view this page.')  });  </script> ";
							die();
						}
						if (isset($_POST['doAdd']))
						{
							$user = $_POST['username'];
							$pass = hash("sha256", $_POST['password']);
							$perm = $_POST['permissions'];
							if (ctype_alnum($user))
							{
								if (ctype_digit($perm))
								{
									switch ($perm)
									{
										case "1":
											$perm = "user";
											break;
										case "2":
											$perm = "moderator";
											break;
										case "3":
											$perm = "admin";
											break;
									}
									$i = $odb->prepare("INSERT INTO users VALUES(NULL, :u, :p, :pr, '1')");
									$i->execute(array(":u" => $user, ":p" => $pass, ":pr" => $perm));
									$i2 = $odb->prepare("INSERT INTO plogs VALUES(NULL, :u, :ip, :r, UNIX_TIMESTAMP())");
									$i2->execute(array(":u" => $username, ":ip" => $_SERVER['REMOTE_ADDR'], ":r" => "Created user ".$user));
                                    echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.success('Successfully added new user. ')  });  </script> ";
								}else{
                                    echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.error('Permissions was not a digit.')  });  </script> ";
								}
							}else{
                                echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.error('Username\'s must be alpha-numeric only.')  });  </script> ";
							}
						}
						if (isset($_GET['del']))
						{
							
							$del = $_GET['del'];
							if (!ctype_digit($del))
							{
                                echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.error('User ID was not a digit.')  });  </script> ";
							}else{
								if ($del != "1")
								{
									$un = $odb->query("SELECT username FROM users WHERE id = '".$del."'")->fetchColumn(0);
									$d = $odb->prepare("DELETE FROM users WHERE id = :i LIMIT 1");
									$d->execute(array(":i" => $del));
									$i3 = $odb->prepare("INSERT INTO plogs VALUES(NULL, :u, :ip, :r, UNIX_TIMESTAMP())");
									$i3->execute(array(":u" => $username, ":ip" => $_SERVER['REMOTE_ADDR'], ":r" => "Deleted user ".$un));
                                    echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.info('User has been deleted. Reloading... ')  });  </script> ";
								}else{
                                    echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.error('This user cannot be deleted. ')  });  </script> ";
								}
							}
						}
						if (isset($_GET['ban']))
						{
							$ban = $_GET['ban'];
							if (!ctype_digit($ban))
							{
                                echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.info('User ID was not a digit. ')  });  </script> ";
							}else{
								if ($ban != "1")
								{
									list($st,$un) = $odb->query("SELECT status,username FROM users WHERE id = '".$ban."'")->fetch();
									if ($st == "1")
									{
										$b = $odb->prepare("UPDATE users SET status = '2' WHERE id = :i LIMIT 1");
										$b->execute(array(":i" => $ban));
										$i4 = $odb->prepare("INSERT INTO plogs VALUES(NULL, :u, :ip, :r, UNIX_TIMESTAMP())");
										$i4->execute(array(":u" => $username, ":ip" => $_SERVER['REMOTE_ADDR'], ":r" => "Banned user ".$un));
                                        echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.info('User has been banned. ')  });  </script> ";
									}else{
										$b = $odb->prepare("UPDATE users SET status = '1' WHERE id = :i LIMIT 1");
										$b->execute(array(":i" => $ban));
										$i4 = $odb->prepare("INSERT INTO plogs VALUES(NULL, :u, :ip, :r, UNIX_TIMESTAMP())");
										$i4->execute(array(":u" => $username, ":ip" => $_SERVER['REMOTE_ADDR'], ":r" => "Unbanned user ".$un));
                                        echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.info('User has been unbanned. ')  });  </script> ";
									}
								}else{
                                    echo "<script>document.addEventListener('DOMContentLoaded', function() { toastr.error('This user cannot be banned. !')  });  </script> ";
								}
							}
						}
						?>
					</div>
					<div class="col-lg-12 col-xs-12">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs">
								<li class="active">
									<a href="#man" data-toggle="tab">Manage</a>
								</li>
								<li>
									<a href="#add" data-toggle="tab">Add User</a>
								</li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="man">
									<table class="table table-condensed table-bordered table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Username</th>
												<th>Permission</th>
												<th>Last Access Date</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$users = $odb->query("SELECT * FROM users");
											while ($us = $users->fetch(PDO::FETCH_ASSOC))
											{
												$lds = $odb->prepare("SELECT date FROM plogs WHERE username = :u AND action = 'Logged in' ORDER BY date LIMIT 1");
												$lds->execute(array(":u" => $us['username']));
												$ld = $lds->fetchColumn(0);
												if ($ld == NULL || $ld == "")
												{
													$ld = "Never";
												}else{
													$ld = date("m-d-Y, h:i A", $ld);
												}
												$stat = "";
												if ($us['status'] == "1")
												{
													$stat = '<a href="?p=users&ban='.$us['id'].'" title="Ban User"><i class="fa fa-lock"></i></a>';
												}else{
													$stat = '<a href="?p=users&ban='.$us['id'].'" title="Unban User"><i class="fa fa-unlock-alt"></i></a>';
												}
												echo '<tr><td>'.$us['id'].'</td><td>'.$us['username'].'</td><td>'.ucfirst($us['privileges']).'</td><td>'.$ld.'</td><td><center><a href="?p=edituser&id='.$us['id'].'" title="Edit User"><i class="fa fa-edit"></i></a>&nbsp;'.$stat.'&nbsp;<a href="?p=users&del='.$us['id'].'" title="Delete User"><i class="fa fa-times-circle"></i></a></center></td></tr>';
											}
											?>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="add">
									<form action="" method="POST" class="col-lg-6">
										<label>Username</label>
										<input type="text" class="form-control" name="username">
										<br>
										<label>Password</label>
										<input type="password" class="form-control" name="password">
										<br>
										<label>Permissions</label>
										<select class="form-control" name="permissions">
											<option value="1">User</option>
											<option value="2">Moderator</option>
											<option value="3">Admin</option>
										</select>
										<br>
										<center><input type="submit" name="doAdd" class="btn btn-danger" value="Add User"></center>
									</form>
									<div class="clearfix"></div>
								</div>
							</div>
					
            </div>


        </div>


          </div>
        </section>
