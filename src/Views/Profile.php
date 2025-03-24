<?php

require_once "../vendor/autoload.php";

require_once "Elements/header.php";


?>

<div id="searchModal" >
    <div class="content">
        <div class="title my-3 px-4 py-2 mx-auto mb-1" style="margin-top: 20px !important; color: rgb(96, 96, 245); font-size: 1.2em;">
            Mettre a jour votre profile
        </div>
        <form action="/update" method="POST" enctype="multipart/form-data">
            <div class="px-4  mx-auto my-3">
                <label class="form-label" for="username">Votre nom</label>
                <input type="text" name="username" id="search" value="<?= $username ?? '' ?>" class="form-control p-2 h-7 border shadow-none" >
            </div>
            <div class="px-4  mx-auto my-3">
                <label for="email">Votre email</label>
                <input type="email" name="email" class="p-2 form-control h-7 border shadow-none" value="<?= $email ?? '' ?>" >
            </div>
            <div class="px-4  mx-auto my-3">
                <label for="image">Choisir une image </label>
                <input type="file" name="image" class="p-2 form-control h-7 border shadow-none" >
            </div>
            <div class="px-4" style="margin-top: 25px; display: grid; place-items: center;">
                <button class="modalButton shadow-none" style="border: none; color: white; background-color: rgb(96, 96, 245); padding: 7px;">
                    mettre à jour
                </button> 
            </div>
        </form>

        <button class="closeButton" onclick="closeModal()" >
            <i class="fa-solid fa-x" style="font-size: .8em;"></i>
        </button>
    </div>  
</div>
<div id="searchModal3" >
    <div class="content">
        <div class="title my-3 mb-4 px-4 py-2 mx-auto mb-1" style="margin-top: 20px !important; color: rgb(96, 96, 245); font-size: 1.2em;">
            <i class="fa-solid fa-lock me-2"></i>Securisation du compte
        </div>
        <form action="/update-password" method="POST">
            <div class="px-4  mx-auto mt-2" style="position: relative;">
                <label class="form-label" for="username">Ancien mot de passe</label>
                <input type="password" name="old_password"  class="form-control p-2 h-7 border shadow-none" >
                <i class="fa-solid fa-eye-slash hide " style="position: absolute; top: 57%; left: 85%; color: rgb(96, 96, 245)"></i>
                <i class="fa-solid fa-eye see d-none"  style="position: absolute; top: 57%; left: 85%; color: rgb(96, 96, 245)"></i>
            </div>
            <div class="px-4  mx-auto mt-2" style="position: relative;">
                <label class="form-label" for="username">Nouveau mot de passe</label>
                <input type="password" name="new_password"  class="form-control p-2 h-7 border shadow-none" >
                <i class="fa-solid fa-eye-slash hide2 " style="position: absolute; top: 57%; left: 85%; color: rgb(96, 96, 245)"></i>
                <i class="fa-solid fa-eye see2 d-none"  style="position: absolute; top: 57%; left: 85%; color: rgb(96, 96, 245)"></i>
            </div>
            <div class="px-4" style="margin-top: 25px; display: grid; place-items: center;">
                <button class="modalButton shadow-none" style="border: none; color: white; background-color: rgb(96, 96, 245); padding: 7px;">
                    Changer le mot de passe
                </button> 
            </div>
        </form>

        <button class="closeButton" onclick="closeModal3()" >
            <i class="fa-solid fa-x" style="font-size: .8em;"></i>
        </button>
    </div>  
</div>

<div id="searchModal4" >
    <div class="content">
        <div class="title my-3 mb-4 px-4 py-2 mx-auto mb-1" style="margin-top: 20px !important; color: rgb(96, 96, 245); font-size: 1.2em;">
            <i class="fa-solid fa-history mx-2"></i>Mon historique
        </div>
        <div class="session-table px-4 mx-auto mt-3" style="margin-top: 50px !important; max-height: 400px; overflow-y: auto;">
            <div class="se-element">
                <div class="lib" style="text-transform: capitalize; font-weight: 600;">
                    connecté le
                </div>
                <div class="start" style="text-transform: capitalize; font-weight: 600;">
                    de
                </div>
                <div class="end" style="text-transform: capitalize; font-weight: 600;">
                    à
                </div>
            </div>

            <?php foreach($sessions as $session): ?>
                <div class="se-element">
                    <div class="lib" style="text-transform: capitalize; font-weight: 600;">
                        <?php $d = strtotime($session->getLogin_time()); echo date("Y-m-d", $d)?>
                    </div>
                    <div class="start" style="text-transform: capitalize; font-weight: 600;">
                        <?php $d = strtotime($session->getLogin_time()); echo date("H:i:sa", $d)?>
                    </div>
                    <div class="end" style="text-transform: capitalize; font-weight: 600;">
                        <?php 
                        
                        if(!$session->getLogout_time())
                            echo "maintenant";
                        else
                        {
                            $d = strtotime($session->getLogout_time()); 
                            echo date("H:i:sa", $d);
                        }                        
                        ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="px-4 mt-4" >
            <span style="color: rgb(96, 96, 245); font-weight:600; "> Nombre total de connexions : </span> <span style="color: rgb(96, 96, 245); font-weight:600; "> <?= count($sessions) ?> </span> 
        </div>

        <button class="closeButton" onclick="closeModal4()" >
            <i class="fa-solid fa-x" style="font-size: .8em;"></i>
        </button>
    </div>  
</div>

<div class="p-banner">
    <div class="p-inner">
        <div class="content container">
            <div class="greeting">
                Hello <?=$username?>
            </div>
            <div class="smalltext">
                Bienvenu sur votre profile, profiter de la digitatlisation des services informatiques
                Lorem ipsum dolor sit amet
            </div>
            <div class="cta">
                <button onclick="openModal()">
                    <i class="fa-solid fa-user"></i>modifier mon profile
                </button>
            </div>
        </div>
    </div>
    <div class="overlap">
        <div class="p-inner-overlap container">
            <div class="in_overlap">
                <div class="el-item">
                    <span>Mon compte</span>
                    <button onclick="openModal3()">
                        <i class="fa-solid fa-lock"></i>
                        changer de mot de passe
                    </button>
                </div>
                <div class="el-item">
                    <div class="title">Infomations Personnelles</div>
                </div>
                <div class="el-item">
                    <div class="p-info"> 
                        <div class="p-label">
                            Nom d'utilisateur
                        </div>
                        <div class="p-inside">
                            <?= $username  ?>
                        </div>
                    </div>
                    <div class="p-info"> 
                        <div class="p-label">
                            Email
                        </div>
                        <div class="p-inside">
                            <?= $email  ?>
                        </div>
                    </div>
                </div>
                <div class="el-item">
                    <div class="p-info"> 
                        <div class="p-label">
                            Type de compte
                        </div>
                        <div class="p-inside">
                            <?= $role_name  ?>
                        </div>
                    </div>
                    <div class="p-info"> 
                        <div class="p-label">
                            Mot de passe
                        </div>
                        <div class="p-inside">
                            *******
                        </div>
                    </div>
                </div>
            </div>
            <div class="in_overlap">
                    <?php if(!$image): ?>
                        <div class="img-container" style="--img: url('images/defaultIcon.svg')">

                        </div>
                    <?php else: ?>
                        <div class="img-container" style="--img: url('<?= $image  ?>')">

                        </div>
                    <?php endif; ?>  
                <div class="otherInfo">
                    <div class="name">
                        <?= $username  ?> 
                    </div>
                    <div class="status">
                        <span>status</span>
                        <span><?= $status  ?> </span>
                    </div>
                </div>
                <div class="history">
                    <button onclick="openModal4()">
                        <i class="fa-solid fa-history"></i>
                        <span>Voir mon historique</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
    require_once "Elements/footer.php";
?>




