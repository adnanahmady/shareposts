<?php
	/**
	 * Created by PhpStorm.
	 * User: adnan
	 * Date: 01/03/2018
	 * Time: 05:11 AM
	 */

	class Users extends Controller {

		public function __construct() {

			$this->userModel = $this->model('User');

		}

		public function logout() {
		    unset( $_SESSION[ 'user_id' ] );
		    unset( $_SESSION[ 'user_name' ] );
		    unset( $_SESSION[ 'user_email' ] );
		    redirect( 'users/login' );
        }

		public function register() {

			$data     = [
				'title'       => 'Create an account',
				'name'        => '',
				'email'       => '',
				'password'    => '',
				'password_confirm' => '',
				'name_err'    => '',
				'email_err'   => '',
				'password_err'=> '',
				'password_confirm_err' => ''
			];
			// Check if the user has sent register form or not
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				// confirm post
				$_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

				foreach($data as $key => $value) {
					if (strpos($key, '_err') === false && $key !== 'title') {
						if ( empty(trim($_POST[$key])) ) {
							$data[$key . '_err'] = $key . ' Should not be empty!';
						} else {
							$data[ $key ] = trim($_POST[ $key ]);
						}
					}
				}

				if ( ! preg_match('/(.+)@(.+)\.(.+)/', $data['email']) && empty($data['email_err'])) {
					$data['email_err'] = 'Email is invalid';
				} else if ( $this->userModel->findUserByEmail($data['email'])) {
				    $data['email_err'] = 'Email Already taken';
                }

				if ( empty($data['password_err']) && strlen($data['password']) < 6 ) {
					$data['password_err'] = 'Password is too short';
				}
				if ( empty( $data['password_confirm_err'] ) && $data['password'] != $data['password_confirm'] ) {
					$data['password_confirm_err'] = 'password and confirm must be the same';
				}

				if (empty($data['password_confirm_err']) && empty($data['password_err']) && empty($data['email_err']) && empty($data['name_err']) ) {

				    // Hash password
                    $data['password'] = password_hash( $data['password'], PASSWORD_DEFAULT);

                    if ( $this->userModel->register($data) ) {
                        msg( 'register_success', 'you have successfully registered. Now you can log in ...');
                        redirect('users/login');
                    } else {
                        die ( 'Something went wrong');
                    }
				} else {
					return $this->view('users/register', $data);
				}
			} else {
				// if user didn't sent form yet
				return $this->view('users/register', $data);
			}

		}

		public function login() {

			$data     = [
				'title'       => 'Welcome back',
				'email'       => '',
				'password'    => '',
				'email_err'   => '',
				'password_err'=> '',
			];

			// Check if the user has sent register form or not
			if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
				// confirm post
				$_POST = filter_input_array( INPUT_POST, FILTER_SANITIZE_STRING );

				foreach($data as $key => $value) {
					if (strpos($key, '_err') === false && $key !== 'title') {
						if ( empty(trim($_POST[$key])) ) {
							$data[$key . '_err'] = $key . ' Should not be empty!';
						} else {
							$data[ $key ] = trim($_POST[ $key ]);
						}
					}
				}

				if ( ! preg_match('/([a-zA-Z0-9\.]+)@(.+)\.(.+)/', $data['email']) && empty($data['email_err'])) {
					$data['email_err'] = 'Email is invalid';
				}

				if ( empty($data['password_err']) && strlen($data['password']) < 6 ) {
					$data['password_err'] = 'Password is too short';
				}

				if (empty($data['password_err']) && empty($data['email_err'])) {

				    // Check if user is right so logging in
                    $user = $this->userModel->login( $data['email'], $data['password'] );
                    if ( $user !== false ) {

                        // user login
                        setSessionUser( $user );

                    } else {
                        $data['password_err'] = 'Password is incorract';
                        return $this->view('users/login', $data);
                    }


				} else {
					return $this->view('users/login', $data);
				}
			} else {
				// if user didnt sent form yet

				return $this->view('users/login', $data);
			}

		}

	}