
<?php require 'views/layout/layout.php' ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List album</title>

</head>

<body>

    <article>

        <section>

            <h1>
                Albums
            </h1>

            <div class="w3-row-padding">

                <?php foreach ($albums as $album) : ?>
                    
                    <div class="w3-col s3">
                        <a href="album/show?id=<?= $album['id'] ?>" >
                            <div class="title">
                                <h3><?= $album['name'] ?> photos</h3>
                            </div>

                            <img class="photothumb" src="public/images/album.jpg" width="100px">

                            <div class="desc">
                                <p><?= $album['memories'] ?></p> 
                            </div>
                        </a>
                    </div>

                <?php endforeach; ?>

            </div>


        

        </section>


    </article>

</body>

</html>