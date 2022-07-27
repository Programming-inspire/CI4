<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Libraries\Hash;
use App\Models\UserModel;

class Auth extends BaseController
{
   
    public function __construct()
    {
        helper(['url', 'form']);
        
    }
    //Register 
    public function register()
    {
        return view('auth/register');
    }

    //Login
    public function login()
    {
        return view('auth/login');
    }

    //RegisterUser
    public function registerUser()
    {
        //Validate user input

       $validated = $this->validate([
        'Name' => [
            'rules' => 'required',
            'errors' => [
                'required' => 'Your Full Name is required',
            ]
            ],
        'email' => [
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Your Email is required',
                    'valid_email' => 'Email Id is already used.',
                ]
                ],
        'Password' => [
            'rules' => 'required|min_length[5]|max_length[10]',
            'errors' => [
                'required' => 'Your Password is required',
                'min_length[5]' => 'Password must be 5 character long.',
                'max_length[10]' => 'Password cannot be longer than 10 character.',
            ]
            ],
        'PasswordConf' => [
                'rules' => 'required|matches[Password]',
                'errors' => [
                    'required' => 'Your Confirm Password is required',
                    'matches[Password]' => 'Password does not match',
                ]
                ]

            ]);

        if(!$validated)
        {
            return view('auth/register', ['validation' => $this->validator]);
        }

        //save user

        $Name = $this->request->getPost('Name');
        $email = $this->request->getPost('email');
        $Password = $this->request->getPost('Password');
        $PasswordConf = $this->request->getPost('PasswordConf');

        $data = [
          'Name' => $Name,
          'email' => $email,
          'Password' => Hash::encrypt($Password)
        ];

        //Storing data

        $userModel = new \App\Models\UserModel();
        $query = $userModel->insert($data);
      
        if(!$query)
        {
            return redirect()->back()->with('fail', 'Saving user failed');
        }
        else
        {
            return redirect()->back()->with('success', 'User Register Successfully');
        }
    }

    //loginUser
    public function loginUser()
    {
        //validating user input
        $validated = $this->validate([
            'email' => [
                    'rules' => 'required|valid_email',
                    'errors' => [
                        'required' => 'Your Email is required',
                        'valid_email' => 'Email Id is already used.',
                    ]
                    ],
            'Password' => [
                'rules' => 'required|min_length[5]|max_length[10]',
                'errors' => [
                    'required' => 'Your Password is required',
                    'min_length[5]' => 'Password must be 5 character long.',
                    'max_length[10]' => 'Password cannot be longer than 10 character.',
                ]
                ],
    
                ]);

                if(!$validated)
                {
                    return view('auth/login', ['validation' => $this->validator]);
                }
                else{
                    //checking user details in db
                    $email = $this->request->getPost('email');
                    $Password = $this->request->getPost('Password');

                    $userModel = new UserModel();
                    $userInfo = $userModel->where('email', $email)->first();

                    $checkPassword = Hash::check($Password, $userInfo['Password']);

                    if(!$checkPassword)
                    {
                        session()->setFlashdata('fail', 'Incorrect password provided');
                        return redirect()->to('login');
                    }
                    else
                    {
                        // Process user info

                        $userId = $userInfo['id'];

                        session()->set('loggedInUser', $userId);
                        return redirect()->to('/dashboard');
                    }
                }
    

    }

    //Upload Image
    public function uploadImage()
    {
      try
      {

          $loggedInUserId = session()->get('loggedInUser');
          $config['upload_path'] = getcwd().'/images';
          $imageName = $this->request->getFile('userImage')->getName();

          // if Directory not present then create.

          if(!is_dir( $config['upload_path']))
          {
              mkdir( $config['upload_path'], 0777 );
          }

          // Get image.

          $img = $this->request->getFile('userImage');
            
          if(!$img->hasMoved() && $loggedInUserId)
          {
              
              $img->move($config['upload_path'], $imageName);

              $data = [
                  'avatar' => $imageName,
              ];

              $userModel = new UserModel();
              $userModel->update($loggedInUserId, $data);

              return redirect()->to('dashboard')->with('notification',
                'Image uploaded successfully'
            );

          }
          else
          {
            return redirect()->to('dashboard')->with('notification',
            'Image uploaded failed');
          }


      }
      catch(Exception $e)
      {
          echo $e->getMessage();
      }
    }

     //logout
      public function logout()
      {
          if(session()->has('loggedInUser'))
          {
              session()->remove('loggedInUser');
          }

          return redirect()->to('/login?access=loggedout')->with('fail',
          'You are logged out');
      }
}
