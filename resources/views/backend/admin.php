<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Admin Home</title>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
</head>

<body>
<?php if(isset($_SESSION['username'])): ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
				<div class="navbar-header">
					 
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						 <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
					</button> <a class="navbar-brand" href="adminHome.php">RS Antam Admin</a>
				</div>
				
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li>
							<a href="editor.php">Change Description</a>
						</li>
						<li>
							<a href="editor2.php">Change Image</a>
						</li>
						<li>
							<a href="editDoctor.php">Edit Doctor</a>
						</li>
                        <li>
							<a href="insertDoctor.php">Insert Doctor</a>
						</li>
                        <li>
							<a href="viewDoctor.php">Doctor List</a>
						</li>
                        <li>
							<a href="#">Manage Ticketing</a>
						</li>
                        <li>
							<a href="#">Register Patient</a>
						</li>
                        <li>
							<a href="#">Upload Blood Test</a>
						</li>
                        <li>
							<a href="doLogout.php">Logout</a>
						</li>
					</ul>
				</div>
				
			</nav>
		</div>
	</div>
</div>

<div class="container-fluid" style="margin-top:20%; text-align:center;">
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
			<h3 class="text-primary">
				Welcome, <?php echo $_SESSION['username'] ?>
			</h3>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>
<?php else: ?>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4">
		</div>
		<div class="col-md-4" style="padding-top:10%;">
			<form role="form" action="doLogin.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>
						Username
					</label>
					<input type="text" class="form-control" name="username" />
				</div>
				<div class="form-group">
					<label for="exampleInputPassword1">
						Password
					</label>
					<input type="password" class="form-control" name="password" />
				</div>
				<button type="submit" class="btn btn-block btn-primary">
					Login
				</button>
			</form>
		</div>
		<div class="col-md-4">
		</div>
	</div>
    <div class="row" style="margin-top:10px;">
		<div class="col-md-4">
		</div>
		<div class="col-md-4">
        	<?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-dismissable alert-danger">
                            <h4>
                                Alert!
                            </h4> <strong>Warning!</strong> <?php echo $_GET['error']; ?>
                        </div>
            <?php endif; ?>
		</div>
		<div class="col-md-4">
		</div>
	</div>
</div>
<?php endif; ?>
</body>
</html>