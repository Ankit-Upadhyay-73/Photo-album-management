<!DOCTYPE html> 

<html>

    <head>

    </head>

    <body class="w3-container">
    
        <header>
    
            <nav class="w3-bar w3-black w3-container" >
                <a href="/">Photo Album management</a>
               
                <ul class="nav navbar-nav">
                        <li style="display:<?=!empty($_SESSION['user']) ? 'inline' : 'none';?>"> <a class="w3-bar-item w3-button" href="/album">  Create Album  </a> </li>
                        <li style="display:<?=!empty($_SESSION['user']) ? 'inline' : 'none';?>" > <a class="w3-bar-item w3-button" href="/albums">  List Albums   </a>  </li>
                        <li style="display:<?=!empty($_SESSION['user']) ? 'none' : 'inline';?>"> <a class="w3-bar-item w3-button" href= "/login">  Login  </a>  </li>                        
                        <li style="display:<?=!empty($_SESSION['user']) ? 'none' : 'inline';?>"> <a class="w3-bar-item w3-button" href= "/register">  Register  </a>  </li>
                        <li style="display:<?=!empty($_SESSION['user']) ? 'inline' : 'none';?>">
                            <form action="logout" method="POST">
                                <button type="submit" class="w3-bar-item w3-button">
                                      Logout  
                                </button>
                            </form>
                        </li>

                </ul>
            </nav>        

        </header>


    </body>

</html>