<?php

    $uri = parse_url($_SERVER["REQUEST_URI"])["path"];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.17.2/dist/sweetalert2.min.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.0/css/bootstrap.min.css" integrity="sha512-NZ19NrT58XPK5sXqXnnvtf9T5kLXSzGQlVZL9taZWeTBtXoN3xIfTdxbkQh6QSoJfJgpojRqMfhyqBAAEeiXcA==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <?php if ($uri =="/admin" ) echo "<link rel='stylesheet' href='assets/admin.css'>" ?>
    <?php if ($uri =="/profile" ) echo "<link rel='stylesheet' href='assets/profile.css'>" ?> 
    <?php if ($uri =="/details" ) echo "<link rel='stylesheet' href='assets/details.css'>" ?> 



    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <header class="p-3 border-bottom">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/login" class="d-flex align-items-center me-5 mb-2 mb-lg-0 text-dark text-decoration-none" style="color: blue !important; font-weight: 600 !important;">
                     <span style="font-size: 1.6em; margin-right: 10px">MCC</span><span style="color: black;  font-size: 1.1em;">Gestion</span>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="login" class="nav-link px-2 mx-3 link-dark <?php if ($uri =="/login" )
                        echo "active" ?>" >Login</a></li>

                    <li><a href="/profile" class="nav-link mx-3 px-2 link-dark <?php if ($uri =="/profile" )
                        echo "active" ?> ">profile</a></li>

                    <li><a href="/admin" class="nav-link px-2 mx-3 link-dark <?php if ($uri =="/admin" || $uri =="/details"  )
                        echo "active" ?> ">Admininstration</a></li>
                </ul>
                <div class="dropdown text-end">
                    <a href="" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">

                    <?php if(isset($username)): ?>
                        <?php if(!$image): ?>
                            <img src="assets/images/defaultIcon.svg" class="rounded-circle"  width="30" height="30" alt="" srcset="">    
                        <?php else: ?>
                            <img src="assets/<?= $image ?>" class="rounded-circle"  width="30" height="30" alt="" srcset="">    
                        <?php endif; ?>    
                    <?php else: ?>   
                        <img src="assets/images/defaultIcon.svg" class="rounded-circle"  width="30" height="30" alt="" srcset="">  
                    <?php endif; ?>  
                        <span class="text-primary"><?php if(isset($username)) echo "Bienvenu(e) ".$username; else echo "se connecter" ?></span>
                    </a>

                    <ul class="dropdown-menu text-small" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="/profile">Profile</a></li>
                        <?php if(isset($username)): ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                            
                            <form action="/logout" method="post" style="margin-inline: auto;" >
                                <input type="submit" value="se deconnecter" style="border: none; width: 100%; height: 40px">
                            </form>
                            
                            </li>
                        <?php endif; ?>

                    </ul>
                </div>
            </div>
        </div>
    </header>