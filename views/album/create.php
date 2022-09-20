
<!DOCTYPE html>

<html>

    <head>

        <title> Create New Album of Your Family with You </title>

        <meta name="description" content="Draw My Album | Photo Album Manager">

    </head>

    <body>
    
        <?php require 'views/layout/layout.php' ?>


        <article>
            <section class="w-75">

                <?php
                    $token = md5(time());
                    $_SESSION['token'] = $token;
                ?>

                <div id="photos">

                </div>

                <h1 class="center-header">
                    Create New Album
                </h1>

                <form class="w3-container" action="album" method="POST" class="form"  enctype="multipart/form-data" >

                    <input class="w3-input m-auto" type="hidden" value="<?php echo $_SESSION['token'] ?>" >

                    <input class="w3-input m-auto" type="text" name="name" id="name" placeholder="Album Name">

                    <textarea name="memories" class="w3-input m-auto" id="a_memories" placeholder="About album memories"></textarea>

                    <input class="w3-input m-auto" type="file" 
                                        hidden onchange="uploadPhoto(event)" 
                                        placeholder="Upload photos for album" 
                                        id="album"
                                        accept=".jpeg,.jpg,.png,.GIF,.TIFF,.TIFF,"
                                        name="photos[]" multiple
                                    >

                    <button type="submit" value="Create" id="create_album_button" class="submit-btn">Create Album </button>

                </form>

            </section>

        </article>


        <script src="public/js/album.js">

        </script>


    </body>


</html>