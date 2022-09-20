<?php


    function dd($data){

        echo "<pre>";
            var_dump($data);
        echo "</pre>";
        die();

    }

    function validate($_DATA, $validations, $errors){

        $errors = [];
        foreach($validations as $field=>$rules){

            foreach($rules as $key=>$rule){

                switch($rule){

                    case 'unique':
                        $result = App::get('database')
                            ->selectWhere('users',
                                [
                                    'first'=>'users.email',
                                    'condition' => '=',
                                    'second' => $_DATA[$field]
                                ],'asc',false,
                                [ "users.email" , "users.password"]
                            );
                        
                        if(!empty($result))
                            $errors[$field][$rule] = "email already in use! Continue login";
                        break;

                    case 'email':   
                        if( !preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $_DATA[$field])) {
                            $errors[$field][$rule] = "Invalid Email";   
                        }
                        break;

                    case 'nonumber':
                        if( preg_match("/\d/", $_DATA[$field])) {
                            $errors[$field][$rule] = "Invalid Input";   
                        }
                        break;
    
                    default:
                        break;

                }

                switch ($key){
                    case 'min':
                        if( strlen($_DATA[$field]) < $rule ){
                            $errors[$field][$key] = "Minimum $rule characters required" ;
                        }
                        break;

                    case 'max':
                        if( strlen($_DATA[$field]) > $rule ){
                            $errors[$field][$key] = "Maximum $rule characters allowed" ;
                        } 
                        break;
                        
                    default:
                        break;
                }

            }

        }

        return $errors;

    }


