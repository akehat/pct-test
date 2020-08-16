<?php

class Users extends Controller
{
    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function index()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }

        $users = $this->userModel->getUsersAtoK();
        $data = [
            'title' => 'Users A to K',
            'description' => 'List of users by last name starting A to K',
            'users' => $users,
        ];

        $this->view('users/index', $data);
    }

    public function register()
    {
        // check for posted data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form

            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // init data
            $data = [
                'first_name' => trim($_POST['first_name']),
                'last_name' => trim($_POST['last_name']),
                'email' => trim($_POST['email']),
                'phone_number' => trim($_POST['phone_number']),
                'birth_year' => trim($_POST['birth_year']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'first_name_error' => '',
                'last_name_error' => '',
                'email_error' => '',
                'phone_number_error' => '',
                'birth_year_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Pleae enter email';
            } else {
                // check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_error'] = 'email already taken';
                }
            }

            // validate first_name
            if (empty($data['first_name'])) {
                $data['first_name_error'] = 'Please enter your first name';
            }

            // validate last_name
            if (empty($data['last_name'])) {
                $data['last_name_error'] = 'Please enter your last name';
            }

            // assign 0 to empty birth_year
            $data['birth_year'] = (!empty($data['birth_year'])) ? $data['birth_year'] : 0;

            // validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Pleae enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_error'] = 'Password must be at least 6 characters';
            }

            // validate confirm password
            if (empty($data['confirm_password'])) {
                $data['confirm_password_error'] = 'Pleae confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_error'] = 'Passwords do not match';
                }
            }

            // ensure errors are empty
            if (empty($data['email_error']) && empty($data['name_error']) && empty($data['password_error']) && empty($data['confirm_password_error'])) {
                // validated
                // hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // register the user
                if ($this->userModel->register($data)) {
                    flash('register_success', 'You are registered and can log in');
                    redirect('users/login');
                } else {
                    die('oops. something went wrong');
                }
            } else {
                // load view with errors
                $this->view('users/register', $data);
            }
        } else {
            // load form
            // init data
            $data = [
                'first_name' => '',
                'last_name' => '',
                'email' => '',
                'phone_number' => '',
                'birth_year' => '',
                'password' => '',
                'confirm_password' => '',
                'first_name_error' => '',
                'last_name_error' => '',
                'email_error' => '',
                'phone_number_error' => '',
                'birth_year_error' => '',
                'password_error' => '',
                'confirm_password_error' => ''
            ];

            // load view
            $this->view('users/register', $data);
        }
    }

    public function login()
    {
        // check for POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // process form
            // sanitize POST data
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // init data
            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_error' => '',
                'password_error' => '',
            ];

            // validate email
            if (empty($data['email'])) {
                $data['email_error'] = 'Pleae enter email';
            }

            // validate password
            if (empty($data['password'])) {
                $data['password_error'] = 'Please enter password';
            }

            // make sure errors are empty
            if (empty($data['email_error']) && empty($data['password_error'])) {
                // validated
                // check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);

                if ($loggedInUser) {
                    // create session
                    $this->createUserSession($loggedInUser);
                } else {
                    flash('login_danger', 'The email or password you provided is incorrect', 'alert alert-danger');
                    $this->view('users/login', $data);
                }
            } else {
                // load view with errors
                $this->view('users/login', $data);
            }
        } else {
            // load form
            // init data
            $data = [
                'email' => '',
                'password' => '',
                'email_error' => '',
                'password_error' => '',
            ];

            // load view
            $this->view('users/login', $data);
        }
    }

    public function createUserSession($user)
    {
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] = $user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('users');
    }

    public function logout()
    {
        unset($_SESSION['user_id']);
        unset($_SESSION['user_email']);
        unset($_SESSION['user_name']);
        session_destroy();
        redirect('users/login');
    }
}
