<?php

namespace Framework\Controllers;
use Framework\Lib\AbstractController;
use Framework\models\PrivilegesModel;
use Framework\Models\UsersModel;

class LoginController extends AbstractController
{
	public function DefaultAction()
	{
		if (isset($_POST['login-submit'])) {
			$username = htmlentities(strip_tags($_POST['username']), ENT_QUOTES, 'UTF-8');
			$password = md5(SAULT . md5($_POST['password']) . SAULT);

			$auth = UsersModel::auth($username, $password);
			if ($auth != false) {
			    if ($auth->role == 'admin') {
                    $_SESSION['loggedin'] = $auth;
			        $privileges = PrivilegesModel::getAll(" WHERE user_id = '$auth->user_id' ");
			        $_SESSION['privileges'] = array_shift($privileges);
			        $this->logger->info("Admin Login", array('username' => $auth->username));
					header("location: " . HOST_NAME . "admin");
				} elseif ($auth->role == 'customer') {
                    $_SESSION['loggedin'] = $auth;
					header("location: " . HOST_NAME);
				} else {
					echo "<label style='margin-left:37%'>Sorry, Something went wrong</label>";
				}
			} else {
				echo "<label style='margin-left:37%'>Sorry, username or password is not correct</label>";
			}
		}

		$this->SetView();
		$this->Render(['view' => $this->_view]);
	}

	public function RegisterAction()
	{
		if (isset($_POST['register-submit'])) {
			
			$user = new UsersModel;
			$user->fullname = htmlentities(strip_tags($_POST['fullname']), ENT_QUOTES, 'UTF-8');
			$user->username = htmlentities(strip_tags($_POST['username']), ENT_QUOTES, 'UTF-8');
			$user->email = htmlentities(strip_tags($_POST['email']), ENT_QUOTES, 'UTF-8');
			
			$password = $_POST['password'];
			$confirm_password = $_POST['confirm-password'];
			
			$user->phone = htmlentities(strip_tags($_POST['phone']), ENT_QUOTES, 'UTF-8');
			$user->governorate = htmlentities(strip_tags($_POST['country']), ENT_QUOTES, 'UTF-8');

			$user->role = 'user';

			$checkEmail = UsersModel::Count(" WHERE email = '$user->email'");
			$checkUsername = UsersModel::Count(" WHERE username = '$user->username'");
			
			if (!is_numeric($user->phone)) {
				echo "<label style='margin-left:37%'>Sorry, There's Something Wrong with your phone number.</label>";
			} elseif ($checkEmail > 0) {
				echo "<label style='margin-left:37%'>Sorry, Email already taken</label>";
			} elseif ($checkUsername > 0) {
				echo "<label style='margin-left:37%'>Sorry, username already taken</label>";
			} elseif ($password !== $confirm_password) {
				echo "<label style='margin-left:37%'>Sorry, Password and Confirm Password doesn't match</label>";
			} else {
				$user->password = md5(SAULT . md5($password) . SAULT);

				if ($user->Create()) {
					echo "<script>alert('You have regeitered Successfully')</script>";
					echo "<script>window.open('" .HOST_NAME. "login','_self')</script>";
				}
			}
		}

		if (file_exists(TEMPLATE_PATH . 'governorates.php')) {
			require TEMPLATE_PATH . 'governorates.php';
		} else {
			$gov = array();
		}

		$this->_data = ['countries' => $gov];
		$this->SetView();
        $this->Render(['view' => $this->_view]);
	}

	public function PasswordAction()
	{
		if (isset($_POST['submit'])) {
			$email = htmlentities(strip_tags($_POST['email']), ENT_QUOTES, 'UTF-8');
			$found = UsersModel::checkEmail($email);

			if ($found == 1) {
				mail($email, 'Reset Password Request', $this->ResetProcedure($email));
			} else {
				echo "<script>alert('Sorry, We can not find any user associated with your email address')</script>";
			}
		}

		$this->SetView();
        $this->Render(['view' => $this->_view]);
	}

	public static function ResetProcedure($email)
	{
		$random = substr(md5(mt_rand()), 0, 32);
		$resetURL = HOST_NAME . 'login/reset/?reset=' . $random;
		$message = "You have requested to reset your password.
					<br>
					If you didn't request to reset your password ignore this email.
					<br>
					If you want to create a new password now please click 
					<a href=" . $resetURL . ">Here</a>
					or copy and paste this URL to your browser: <br>" . $resetURL ."
					<br><br>";					

		$_SESSION['resetURL'] = $random;
		$_SESSION['resetEmail'] = $email;
		return $message;
	}	

	public function ResetAction()
	{
		$email = $_SESSION['resetEmail'];
		$resetURL = $_SESSION['resetURL'];
		$resetURLGet = $_GET['reset'];

		if (isset($_SESSION['resetEmail']) AND isset($_SESSION['resetURL'])) {
			if ($resetURL == $resetURLGet) {
				if (isset($_POST['submit'])) {
					$password = $_POST['password'];
					$passwordConfirmation = $_POST['confirm-password'];

					if ($password == $passwordConfirmation) {

						$user = new UsersModel;
						$user->password = md5(SAULT . md5($password) . SAULT);
						$user->Update(" email = '$email'");

						session_unset();
						session_destroy();
						header("location: ".HOST_NAME . 'login');
					} else {
						echo "<script>alert('Password and Repeat Password do not a match')</script>";						
					}
				}
			} else {
				header("location: ".HOST_NAME . 'login');
			}
		} else {
			header("location: ".HOST_NAME . 'login');
		}

		$this->SetView();
		$this->RenderOnlyView($this->_view);
	}	
}

?>