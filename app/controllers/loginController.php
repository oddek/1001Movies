<?php
class loginController extends Controller
{

	#GET LoginPage
	public function index($id = '', $name= '')
	{
		$this->view('login' . DIRECTORY_SEPARATOR . 'index', 
		[
			'name' => $name,
			'id' => $id
		]);
		$this->view->page_title = 'index';
		$this->view->render();
	}
	#POST for loginpage. Redirects to homepage and gives user a cookie if successful
	public function post_index($id = '', $name='')
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!is_null($username) && !is_null($password))
		{
			$res = $this->core->sql->select_specified('users', 'Email', $username);
			if($res && $res->num_rows != 0)
			{
				$row = $res->fetch_assoc();
				$user = User::withRow($row);

				if(password_verify($password, $user->Password))
				{
					$_SESSION['UID'] = $user->Id;
					header("location: /home/index");
				}
				else
				{
					$_SESSION['message'] = '<div class="alert alert-danger" role="alert">
  					Wrong Password!
					</div>';
				}
			}
			else
			{
				$_SESSION['message'] = '<div class="alert alert-danger" role="alert">
  				Username not found!
				</div>';
			}
		}

		$this->view('login' . DIRECTORY_SEPARATOR . 'index', 
		[
			'name' => $name,
			'id' => $id
		]);
		$this->view->page_title = 'index';
		$this->view->render();
	}
	//Logout function. Deletes cookie and redirects to loginpage
	public function logout($id = '', $name='')
	{
		unset($_SESSION['UID']);
		session_destroy();
		header("location: /login/index");
	}
	//GET registerpage
	public function register($id='', $name='')
	{
		$this->view('login' . DIRECTORY_SEPARATOR . 'register', 
		[
			'name' => $name,
			'id' => $id
		]);
		$this->view->page_title = 'Register';
		$this->view->render();
	}
	//POST Registerpage
	public function post_register($id='', $name='')
	{
		$firstName = $_POST['FirstName'];
		$lastName = $_POST['LastName'];
		$email = $_POST['username'];
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirmPassword'];

		if($password == $confirmPassword)
		{
			if($this->core->sql->addUser($firstName, $lastName, $email, password_hash($password, PASSWORD_DEFAULT)))
			{
				$_SESSION['message'] = '<div class="alert alert-success" role="alert">
  				Your account has been created!
				</div>';
				header("location: /login/index");
				die();
			}
			else
			{
				$_SESSION['message'] = '<div class="alert alert-danger" role="alert">
  				An error has occured!
				</div>';
			}
		}
		else
		{
			$_SESSION['message'] = '<div class="alert alert-danger" role="alert">
  				Passwords do not match!
				</div>';
		}
		header("location: /login/register");
	}
	//GET forgotpasswordpage
	public function forgotPassword($id ='', $name='')
	{
		$this->view('login' . DIRECTORY_SEPARATOR . 'forgotPassword', 
		[
			'name' => $name,
			'id' => $id
		]);
		$this->view->page_title = 'Forgot Password';
		$this->view->render();
	}

	#POST for forgotPassword
	public function post_forgotPassword($id ='', $name='')
	{
		$email = $_POST['email'];

		if(isset($email))
		{
			$res = $this->core->sql->select_specified("users", "Email", $email);

			if($res && $res->num_rows != 0)
			{
				$row = $res->fetch_assoc();
				$user = User::withRow($row);		

				$token = bin2hex(random_bytes(50));

				$this->core->sql->save_token($user, $token);

				MailGenerator::resetPassword($user, $token);

				$_SESSION['message'] = '<div class="alert alert-success" role="alert">
  				A mail has to been sent to the requested address!
				</div>';

				header("location: /login/index");
				die();
			}
			else
			{
				$_SESSION['message'] = '<div class="alert alert-danger" role="alert">
  				Mailaddress not found!
				</div>';
			}
		}
		header("location: /login/forgotPassword");
	}
	//GEt for resetpassword
	public function resetPassword ($id ='', $name='')
	{
		//Finner token
		$res = $this->core->sql->select_specified("passwordResets", "Token", $id);
		//Sjekker om token eksisterer, og returnerer til login med feilmelding hvis ikke.
		if(!$res || $res->num_rows == 0)
		{
			$_SESSION['message'] = '<div class="alert alert-danger" role="alert">
  				Token not valid!
				</div>';
			header("location: /login/index");

			die();	
		}
		//Dersom token eksisterer gå til view:
		$this->view('login' . DIRECTORY_SEPARATOR . 'resetPassword', 
		[
			'name' => $name,
			'id' => $id
		]);
		$this->view->page_title = 'Reset Password';
		$this->view->render();
	}
	//Post for resetPassword
	public function post_resetPassword($id='', $name='')
	{
		$password = $_POST['password'];
		$confirmPassword = $_POST['confirmPassword'];
		//Send tilbake ved feil ikke like passord
		if($password != $confirmPassword)
		{
			$_SESSION['message'] = '<div class="alert alert-danger" role="alert">
  				Passwords do not match!
				</div>';
			header("location: /login/post_resetPassword/" . $id);
			die();
		}

		$user = User::withToken($id);

		$hash = password_hash($password, PASSWORD_DEFAULT);

		$this->core->sql->update_field_where("users", "Password", $hash, "Id", $user->Id);

		$_SESSION['message'] = '<div class="alert alert-success" role="alert">
  				Password Successfully Updated!
				</div>';

		$this->core->sql->delete_row_where("passwordResets", "Token", $id);

		header("location: /login/index");

	}
}
?>
