<?php

    // require './views/register.php';

    class RegisterController{

        function create(){
            return require 'views/register.php';    
        }

        public function register(){

            /**
             * Sanatize Input
             */

            $validations = [
                "email"     => ['unique','email'],
                "fname"     => ['max'=>30,'min'=>4,'nonumber'],
                "lname"     => ['max'=>30,'min'=>4,'nonumber'],
                "password"  => ['min'=>8]
            ];

            $errors = [];

            $errors = validate($_REQUEST,$validations,$errors);

            if(count($errors) > 0){
                return require 'views/register.php';
            }

            // Fire to register user

            $_PAYLOAD = [];

            $_PAYLOAD['firstname'] = $_REQUEST['fname'];
            $_PAYLOAD['lastname'] = $_REQUEST['lname'];
            $_PAYLOAD['email'] = $_REQUEST['email'];
            $_PAYLOAD['password'] = password_hash($_REQUEST['password'],PASSWORD_DEFAULT);

            // unset($_DATA);

            $inserteredUser = App::get('database')->insert("users",$_PAYLOAD);
            
            if($inserteredUser){

                $user_id  = App::get('database')->selectWhere('users',
                        [
                            "first"=>'users.email',"condition"=>"=","second"=>$_PAYLOAD['email']
                        ],
                    'desc',false,['users.id'])['id'];                

                $errors  = [];

                unset($_PAYLOAD['password']);
                
                $_PAYLOAD['id'] = $user_id;

                $_SESSION['user'] = $_PAYLOAD;

                header('location: /album');

            }


        }
    }
