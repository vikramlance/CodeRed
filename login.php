<?php
ob_start();
session_start();
require('connect.php');
if(isset($_SESSION['username']))
{
	header('location:index.php');
}
else
{
}
require('header.php');
?>
		<center>
		<h1> LOGIN PANEL </h1>
		<?php
		if(isset($_POST['username'])&&isset($_POST['password'])&&isset($_POST['submit']))
		{
			$username=mysqli_real_escape_string($con, $_POST['username']);
			$password=mysqli_real_escape_string($con, $_POST['password']);

			if(!empty($username)&&!empty($password))
			{
				$str="SELECT username, password, customerNumber FROM customers WHERE username='$username'";
				$result = mysqli_query($con, $str);
				if(mysqli_num_rows($result)==1)
				{
					/*if (!$result) {
  					printf("Error: %s\n", mysqli_error($con));
    					exit();
				}*/
					$row=mysqli_fetch_array($result);
					if(($username===$row['username'])
					{
						if($password===$row['password'])
						{
							$_SESSION['username']=$row['username'];
							$_SESSION['userid']=$row['customerNumber'];
							echo 'Logged In';
							header('location:index.php');
						}
						else{
							echo 'Incorrect Password';
						}
					}
					else{
						echo 'Incorrect Username';
					}
				}
			}
		}
	}
}

?>

		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-sm-4">
						<div class="logo pull-left">
							<a href="index.html"><img src="images/home/logo.png" alt="" /></a>
						</div>
						<div class="btn-group pull-right">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-8">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href=""><i class="fa fa-user"></i> Account</a></li>
								<li><a href=""><i class="fa fa-star"></i> Wishlist</a></li>
								<li><a href="checkout.html"><i class="fa fa-crosshairs"></i> Checkout</a></li>
								<li><a href="cart.html"><i class="fa fa-shopping-cart"></i> Cart</a></li>
								<li><a href="login.php" class="active"><i class="fa fa-lock"></i> Login</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="index.php">Home</a></li>
								<li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.php" class="active">Login</a></li> 
                                    </ul>
                                </li> 
								<li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="blog.html">Blog List</a></li>
										<li><a href="blog-single.html">Blog Single</a></li>
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="contact-us.html">Contact</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<input type="text" placeholder="Search"/>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
						<h2>Login to your account</h2>
						<form action="login.php" method="post">
							<input type="text" name="username" id="username" size="20" maxlength="30" autofocus="" required="required" tabindex="1" accesskey="u" />
							<input type="password" name="password" id="password" size="20" maxlength="30" required="required" tabindex="2" accesskey="p" />
							<input type="submit" class="btn btn-default" value="Login" />
						</form>
					</div><!--/login form-->
				</div>
				<div class="col-sm-1">
					<h2 class="or">OR</h2>
				</div>
				<div class="col-sm-4">
					<div class="signup-form"><!--sign up form-->
						<h2>New User Signup!</h2>
						<form action="signup.php" method="post">
							<input type="text" placeholder="First name" name="fname" id="fname"/><br/>
							<input type="text" placeholder="Last name" name="lname" id="lname"/><br/>
							<input type="email" placeholder="Email address" name="email" id="email"/><br/>
							<input type="text" placeholder="User name" name="username" id="username"/><br/>
							<input type="password" placeholder="Password" name="password" id="password"/><br/>
							<input type="text" placeholder="Phone" name="phone" id="phone"/><br/>
							<textarea name="address" id="address" cols="30" rows="10">Address</textarea>
							<input type="text" placeholder="City" name="city" id="city"/><br/>
							<input type="text" placeholder="State" name="state" id="state"/><br/>
							<input type="text" placeholder="ZIP" name="zip" id="zip"/><br/>
							<input type="text" placeholder="Country" name="country" id="country"/><br/>
							<input type="submit" class="btn btn-default" value="Signup" name="submit" />
						</form>
					</div><!--/sign up form-->
				</div>
			</div>
		</div>
	</section><!--/form-->	

  <?php require('footer.php'); ?>
</body>
</html>