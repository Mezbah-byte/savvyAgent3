<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Load necessary libraries, helpers, and models
        $this->load->library(['session', 'form_validation']);
        $this->load->helper(['url', 'form']);
        $this->load->model('auth/Auth_model'); // Load the Auth model
    }

    public function index()
    {
        // Load the login view
        $this->load->view('auth/login');
    }

    public function login()
    {
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[6]');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login', [
                'validation' => validation_errors()
            ]);
            // echo "not getting these data";
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            $user = $this->Auth_model->can_login($email, $password);
            // echo $email;
            // echo $password;
            // echo $user;

            if ($user && $user['status'] == 1 && $user['email'] == $email && $user['password'] == $password) {
                $this->session->set_userdata([
                    'isLoggedIn' => true,
                    'userUnId' => $user['un_id'],
                    'name' => $user['name'],
                    'email' => $user['email'],
                    'phone_number' => $user['phone_number'],
                ]);
                redirect('dashboard');
            } else {
                $this->load->view('auth/login', [
                    'error' => 'Invalid email or password'
                ]);
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
