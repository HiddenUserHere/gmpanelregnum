<?php

class LoginController extends Controller
{
	public function index()
	{
		$this->setModel('LoginModel');

		$this->view->render('Login',FALSE);

		//Handler Login
		if( Request::getFormCount() > 0 )
		{
			//Check if all field was filled
			if( Request::getForm('account') == '' || Request::getForm('password') == '' )
			{
				UI::ShowError('Account Invalid. Try again!');
				UI::RedirectPage('?page=Login',2);
				exit;
			}

			$this->LoginModel->HandleLogin(Request::getForm('account'),Request::getForm('password'));
		}
	}

	public function Logout()
	{
		$this->setModel('LoginModel');

		if( Request::getSession('account') && Request::getSession('token') )
		{
			$this->LoginModel->HandleLogout(Request::getSession('account'));

			UI::RedirectPage('?page=Login',2);

			$this->view->render('Loading',FALSE);
		}
		else
			$this->view->render('Login',FALSE);
	}
}

?>