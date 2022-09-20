
<?php

use LDAP\Result;

    class AlbumController
    {
        
        public function create(){
            if(Request::user())
                return require 'views/album/create.php';
            
            header('location: /login');
        }

        public function store(){
            
            if(!Request::user())
                header('location: /login');                        

            $validations = [
                "name"     => ['required'],
                "memories" => ['required','min'=>1]
            ];

            $_INPUT = array_map(function($item){
                return htmlspecialchars($item);
            },$_REQUEST);

            $errors = [];

            $errors = validate($_INPUT,$validations,$errors);
           
            if(count($errors) > 0){
                return require 'views/album/create.php';
            }

            $photos = $_FILES['photos'];

            $fname = Request::user()['firstname'];
            $key = md5(Request::user()['email']);
            $ablum_key = md5($_INPUT['name']);

            $album_created = App::get('database')->insert('albums',
                        [
                            "name"      =>  $_INPUT['name'],
                            "memories"  =>  $_INPUT['memories'],
                            "user_id"   =>  Request::user()['id']
                        ]
                );
            
            if(!$album_created){

                dd("Failed to create album");

            }

            $album_id = App::get('database')->selectWhere('albums',
                            [
                                "first"      =>  "albums.user_id",
                                "condition"  =>  "=",
                                "second"   =>  Request::user()['id']
                            ],'desc',false,["albums.id"]
                        );            

            $users_specific_path = "$fname-$key/$ablum_key/";

            $base_upload_path = "uploads/$users_specific_path";
            
            if(! file_exists($base_upload_path)){
                mkdir($base_upload_path,0777,true);
            }

            foreach($photos as $category=>$array_value){

                if($category !== 'name'){
                    continue;
                }

                foreach($array_value as $index=>$fileName){
                    if($photos["error"][$index])
                        continue;

                    $extension = strtolower(pathinfo($fileName,PATHINFO_EXTENSION));
                    $targetFile = $base_upload_path.md5(basename($fileName)).".$extension";                    
                    $fileSize = $photos["size"][$index];
                    $fileType = $photos["type"][$index];

                    $response = [];

                    if( !in_array($fileType, ["image/png", "image/jpeg", "image/webp", "image/jpg"] ) ){
                        $response["message"] = "Invalid Image Type";
                    }

                    if($fileSize > 5120000){
                        $response["message"] = "Max. size 5MB supported";
                    }
                    
                    if(move_uploaded_file( $photos["tmp_name"][$index], $targetFile)){
                        $album_created = App::get('database')->insert('album_photos',
                            [
                                "album_id"  => $album_id['id'],
                                "photo_url" => $users_specific_path.md5(basename($fileName)).".$extension"
                            ]
                        );

                        $response["uploaded"][$fileName] = "Uploaded Successfully";

                    }

                }

                header('location: /albums');

            }

            // .basename($_FILES);
        }

        public function show(){

            if(!Request::user())
                header('location: /login');            

            $album_id = $_REQUEST['id'];

            $album = App::get('database')
                        ->selectWhere('albums',
                            [
                                "first" => "albums.id",
                                "condition" => "=",
                                "second" => "$album_id"
                            ],'desc',false,['albums.name'])['name'];            

            $photos = App::get('database')
                        ->selectWhere('album_photos',
                            [
                                "first" => "album_photos.album_id",
                                "condition" => "=",
                                "second" => "$album_id"
                            ],'desc',true,['album_photos.photo_url']);        

            return require 'views/album/album_photos.php';            

        }

        public function list(){

            if(!Request::user())
                header('location: /login');                        

            $user_id = Request::user()['id'];
            $albums = App::get('database')
                        ->selectWhere('albums',
                            [
                                "first" => "albums.user_id",
                                "condition" => "=",
                                "second" => "$user_id"
                            ],'desc',true,['albums.name','albums.memories','albums.id']);        

            return require 'views/album/list.php';

        }

    }
    
