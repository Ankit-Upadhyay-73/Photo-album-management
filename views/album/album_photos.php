<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="public/css/masconry.css">
    <script src="public/js/masconry.js" defer></script>

</head>

<body>

    <?php require 'views/layout/layout.php' ?>

    <section>

        <h1>Photos in <?= $album; ?> album </h1>
        <div class="grid">

            <?php foreach($photos as $photo) : ?>
                <div class="item photo">
                    <div class="content">
                        <img class="w3-col s3 w3-center" 
                            style="padding: 1rem;background-color: #323232;" 
                            src="<?= "/uploads/".$photo['photo_url'] ?>"
                            >                    
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

    </section>


</body>

</html>