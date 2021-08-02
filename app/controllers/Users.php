<?php
    class Users extends Controller
    {
        public function __construct ()
        {
            $this->userModel = $this->model ('User');
        }

        public function login ()
        {
            if (isLoggedIn ())
            {
                redirect ('cms');
            }
            elseif ($_SERVER ['REQUEST_METHOD'] == 'POST')
            {
                // Process form

                // // Sanitize POST data
                // $_POST = filter_input_array (INPUT_POST, FILTER_SANITIZE_STRING);

                // Encrypt password
                $password = test_input ($_POST ['password']);

                // Init data
                $data = [
                    'search' => '',
                    'email' => test_input ($_POST ['email']),
                    'password' => $password,
                    'email_err' => '',
                    'password_err' => '',
                    'user_err' => ''
                ];

                // Validate Email
                if (empty ($data ['email']))
                {
                    $data ['email_err'] = 'Please enter email';
                }

                // Validate Password
                if (empty ($data ['password']))
                {
                    $data ['password_err'] = 'Please enter password';
                }
                elseif (strlen ($data ['password']) < 6)
                {
                    $data ['password_err'] = 'Password must be at least 6 characters';
                }

                 // Make sure errors are empty
                 if (empty ($data ['email_err']) && empty ($data ['password_err']))
                 {
                    // Validated
                    // Encrypt to match password
                    $data ['password'] = secure_encrypt ($data ['password']);

                    // Check and set logged in user
                    $loggedInUser = $this->userModel->login ($data ['email'], $data ['password']);

                    if ($loggedInUser)
                    {
                        // Create Session
                        $this->createUserSession ($loggedInUser);

                        flash ('login_message', 'Welcome, ' . $_SESSION ['user_name']);
                    }
                    else
                    {
                        $data ['user_err'] = 'Invalid email or password';

                        $this->view ('users/login', $data);
                    }
                 }
                 else
                 {
                    // Load view with errors
                    $this->view ('users/login', $data);
                 }
            }
            else
            {
                // Init data
                $data = [
                    'title' => 'Web Lore',
                    'search' => '',
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'user_err' => '',
                ];

                // Load view
                $this->view ('users/login', $data);
            }
            
        }

        public function createUserSession ($user)
        {
            $_SESSION ['user_id'] = $user->id;
            $_SESSION ['user_email'] = $user->email;
            $_SESSION ['user_name'] = $user->name;

            if (isset ($_SESSION ['trackUrl']))
            {
                redirect ($_SESSION ['trackUrl']);
            }
            else
            {
                redirect ('cms');
            }
        }

        public function logout ()
        {
            unset ($_SESSION ['user_id']);        
            unset ($_SESSION ['user_email']);        
            unset ($_SESSION ['user_name']);

            redirect ('users/login');        
        }
    }