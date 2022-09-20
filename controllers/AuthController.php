<?php

    // require './views/login.php';


    class AuthController
    {

        public function create()
        {
            return require 'views/login.php';
        }

        public function attempt(){
        
            $validations = [
                "email"     => ['email'],
                "password"  => ['min'=>8]
            ];

            $errors = [];

            $errors = validate($_REQUEST,$validations,$errors);

            if(count($errors) > 0){

                return require 'views/login.php';

            }

        
            $user_name = $_REQUEST['email'];

            $columns =  [
                            "users.id",
                            "users.email",
                            "users.password",
                            "users.firstname",
                            "users.lastname"
                        ];
            
            $v_user = App::get('database')
                ->selectWhere('users',[
                                "first" => "users.email",
                                "condition" => "=",
                                "second" => "$user_name"
                            ],'asc',false,$columns
                );
            
            $v_password = password_verify($_REQUEST['password'],!empty($v_user['password']) ? $v_user['password'] : null);
            
            // unset($v_user);
    
            if($v_user && $v_password){
                $errors = [];

                unset($v_user['password']);

                $_SESSION['user'] = $v_user;

                header('location: /album');
            }else{
                if(empty($v_user))
                    $errors["email"][] = "Account doesn't exists, Register Yourself";
                else 
                    $errors["email"][] = "email or password incorrect";                
                    return require 'views/login.php';
            }            

        }

        public function logout(){

            unset($_SESSION['user']);

            header('location: /');

        }


    }