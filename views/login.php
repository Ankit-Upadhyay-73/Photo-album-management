
<?php require 'views/layout/layout.php' ?>

<!Doctype html>

<html>

    <head>

        <meta name="author" content="Ankit Upadhyay">
        <meta name="description" content="Login | Photo Albums management | Manager Photos Album">

        <title> Login | Photo Album Manager </title>

    </head>

    <body>

        <?php
            $token = md5(time());
            $_SESSION['token'] = $token;
        ?>

        <h1 class="center-header"> Start using Album management System </h1>


        <div class="form">
            
            <form action="login" class="w3-container" method="POST">

                <input class="w3-input" type="hidden" value="<?php echo $_SESSION['token'] ?>" >

                <label for="uemail">Email</label>
                <input class="w3-input" type="email" name="email" placeholder="Email" id="uemail">
                <span class="error" id="errors-email">
                    <?php if(!empty($errors['email'])) :?>
                        <?= ucwords(implode(",",$errors['email'])); ?>
                    <?php endif; ?>
                </span>

                <label for="password">Password</label>
                <input class="w3-input" type="password" name="password" placeholder="password" id="password">
                <span class="error" id="errors-password">
                    <?php if(!empty($errors['password'])) :?>
                        <?= ucwords(implode(",",$errors['password'])); ?>
                    <?php endif; ?>
                </span>

                <button class="submit-btn" type="submit" value="Login">Login</button>

            </form>        


        </div>

    </body>

    <script type="text/javascript" src="public/js/login.js">        
    </script>

</html>