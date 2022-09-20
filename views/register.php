<!DOCTYPE html>

<?php require 'views/layout/layout.php' ?>


<html>

    <head>

        <title> Register - Album Management </title>

        <meta name="author" content="Ankit Upadhyay">
        <meta name="description" content="Register 
            yourself in Photo Album management site to upload and 
            store your photos">

        <script src="public/js/register.js" defer></script>


    </head>

    <body>

            <h1 class="center-header">
                Register, Start using
            </h1>

        <section>

            <?php
                $token = md5(time());
                $_SESSION['token'] = $token;
            ?>

            <div class="form">

                <form class="w3-container" action="register" method="POST">

                    <input class="w3-input m-auto" type="hidden" id="" value="<?php echo $_SESSION['token'] ?>">

                    <label for="fname">First Name</label>
                    <input class="w3-input m-auto" type="text" name="fname" id="fname" placeholder="First Name eg. Virat">
                    <span class="error"></span>
                    <span class="error" id="errors-fname">
                        <?php if(!empty($errors['fname'])) :?>
                            <?= ucwords(implode(",",$errors['fname'])); ?>
                        <?php endif; ?>
                    </span>                    

                    <label for="lname">Second Name</label>
                    <input class="w3-input m-auto" type="text" name="lname" id="lname" placeholder="Last Name eg. Kohli">                
                    <span class="error"></span>
                    <span class="error" id="errors-lname">
                        <?php if(!empty($errors['lname'])) :?>
                            <?= ucwords(implode(",",$errors['lname'])); ?>
                        <?php endif; ?>
                    </span>

                    <label for="uemail">Email ID</label>
                    <input class="w3-input m-auto" type="email" name="email"  id="uemail" placeholder="eg. ankit@gmail.com">
                    <span class="error"></span> 
                    <span class="error" id="errors-email">
                        <?php if(!empty($errors['email'])) :?>
                            <?= ucwords(implode(",",$errors['email'])); ?>
                        <?php endif; ?>
                    </span>

                    <label for="password">Password</label>
                    <input class="w3-input m-auto" type="password" name="password"  id="password" placeholder="Password (must be 8 digits long)">
                    <span class="error"></span> 

                    <span class="error" id="errors-password">
                        <?php if(!empty($errors['password'])) :?>
                            <?= ucwords(implode(",",$errors['password'])); ?>
                        <?php endif; ?>
                    </span>

                    <button class="w3-input m-auto" type="submit" class="submit-btn" value="Register">Register</button>

                </form>


            </div>


        </section>



    </body>

</html>