<?php

use Utils\Storage\Storage;

require_once "../vendor/autoload.php";

require_once "Elements/header.php";
?>
<div id="searchModal" >
    <div class="content">
        <div class="title my-3 px-4 py-2 mx-auto mb-1" style="margin-top: 20px !important; color: rgb(96, 96, 245); font-size: 1.2em;">
            Ajouter un utilisateur
        </div>
        <form action="/create" method="POST" enctype="multipart/form-data">
            <div class="px-4  mx-auto mt-2">
                <label class="form-label" for="username">Votre nom</label>
                <input type="text" name="username" id="search" value="" class="form-control p-2 h-7 border shadow-none" >
            </div>
            <div class="px-4  mx-auto mt-2">
                <label for="email">Votre email</label>
                <input type="email" name="email" class="p-2 form-control h-7 border shadow-none" value="" >
            </div>
            <div class="px-4  mx-auto mt-2">
                <label for="email">status</label>
                <select name="status" class="p-2 form-control h-7 border shadow-none" id="">
                    <option value="active">actif</option>
                    <option value="inactif">inactif</option>
                </select>
            </div>
            <div class="px-4  mx-auto mt-2">
                <label for="">Définir un role</label>
                <select name="role_id" class="p-2 form-control h-7 border shadow-none" id="">
                <?php foreach($roles as $role): ?>
                    <option value="<?= $role->getId() ?>" <?php if($role->getId()==2) echo "selected"; ?> ><?= $role->getName() ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="px-4  mx-auto mt-2">
                <label for="image">Choisir une image </label>
                <input type="file" name="image" class="p-2 form-control h-7 border shadow-none" >
            </div>
            <div class="px-4 mx-auto mt-2">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" class="form-control p-2 h-7 border shadow-none" >
            </div>
            <div class="px-4" style="margin-top: 10px; display: grid; place-items: center;">
                <button class="modalButton shadow-none" style="border: none; color: white; background-color: rgb(96, 96, 245); padding: 7px; padding-inline: 15px">
                    <b>ajouter</b>
                </button> 
            </div>
        </form>

        <button class="closeButton" onclick="closeModal()" >
            <i class="fa-solid fa-x" style="font-size: .8em;"></i>
        </button>
    </div>  
</div>

<div id="searchModal2" >
    <div class="content">
        <div class="title my-3 px-4 py-2 mx-auto mb-1" style="margin-top: 20px !important; color: rgb(96, 96, 245); font-size: 1.2em;">
            Modifier les informations de 
        </div>
        <form action="/admin/update" id="tryfetch" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="" name="id">
            <div class="px-4  mx-auto mt-2">
                <label class="form-label" for="username">Votre nom</label>
                <input type="text" name="username" value="" class="form-control p-2 h-7 border shadow-none" >
            </div>
            <div class="px-4  mx-auto mt-2">
                <label for="email">Votre email</label>
                <input type="email" name="email" class="p-2 form-control h-7 border shadow-none" value="" >
            </div>
            <div class="px-4  mx-auto mt-2">
                <label for="email">status</label>
                <select name="status" class="p-2 form-control h-7 border shadow-none" id="status">
                    <option value="active">active</option>
                    <option value="inactive">inactive</option>
                </select>
            </div>
            <div class="px-4  mx-auto mt-2">
                <label for="">Définir un role</label>
                <select name="role_id" class="p-2 form-control h-7 border shadow-none" id="role">
                <?php foreach($roles as $role): ?>
                    <option value="<?= $role->getId() ?>" <?php if($role->getId()==2) echo "selected"; ?> ><?= $role->getName() ?></option>
                <?php endforeach; ?>
                </select>
            </div>
            <div class="px-4  mx-auto mt-2">
                <label for="image">Choisir une image </label>
                <input type="file" name="image" class="p-2 form-control h-7 border shadow-none" >
            </div>
            <div class="px-4 mx-auto mt-2" style="position: relative;">
                <label for="password mx-1">Mot de passe </label><small class="text-danger" style="font-size: .6em; margin-left: 5px">le mot de passe par défaut est "password"</small>
                <input type="password" name="password" class="form-control p-2 h-7 border shadow-none" >
                <i class="fa-solid fa-eye-slash hide " style="position: absolute; top: 57%; left: 85%; color: rgb(96, 96, 245)"></i>
                <i class="fa-solid fa-eye see d-none"  style="position: absolute; top: 57%; left: 85%; color: rgb(96, 96, 245)"></i>
            </div>
            <div class="px-4" style="margin-top: 10px; display: grid; place-items: center;">
                <button  class="modalButton shadow-none" style="border: none; color: white; background-color: rgb(96, 96, 245); padding: 7px; padding-inline: 15px">
                    <b>Modifier</b>
                </button> 
            </div>
        </form>

        <button class="closeButton" onclick="closeModal2()" >
            <i class="fa-solid fa-x" style="font-size: .8em;"></i>
        </button>
    </div>  
</div>

<div class="a-title container">
    <div class="title message">
        <i class="fa-solid fa-group"></i>
        Gestion des utilisateurs
    </div>

    <div class="a-someactions">
        <div class="searching">
            <form action="" method="post">
                <input type="search" name="search" placeholder="rechercher...">
            </form>
        </div>
        <div class="adding">
            <button onclick="openModal()">
                <span>+</span>
                <span>Ajouter un utilisateur</span>
            </button>
        </div>
    </div>
</div>
<div class="a-usertable container">
    <div class="header">
        <div class="name">
            Nom
        </div>
        <div class="role">
            Role
        </div>
        <div class="status">
            Status
        </div>
        <div class="lastlogin">
            voir l'historique
        </div>
        <div class="actions">
            Actions
        </div>
    </div>
    <div class="result-number">
        affichage des <?= count($users) ?> derniers utilisateurs
    </div>
    <div class="tableUser">
        <?php foreach($users as $user): ?>
            <div class="item">
                <div class="name">
                    <div class="imgcon" style="--img: url('<?php if($user->getImage()) echo Storage::getUrl($user->getImage()); else echo 'images/defaultIcon.svg'; ?>') <?php if(!$user->getImage()) echo "; background-size: 25px";  ?>">

                    </div>
                    <div class="text">
                        <?= $user->getUsername() ?>
                    </div>
                </div>
                <div class="role  <?php if($user->roleName()==="admin") echo "admin"; else echo "client"; ?>">
                    <span>
                        <?= $user->roleName() ?>
                    </span>
                </div>
                <div class="status  <?php if($user->getStatus()==="active") echo "active"; else echo "inactive"; ?>">
                    <span>
                        <?= $user->getStatus() ?>
                    </span>
                </div>
                <div class="lastlogin">
                    <a href="/details?id=<?= $user->getId() ?>" style="text-decoration: none; color:rgb(96, 96, 245); padding: 5px">
                        consulter
                    </a>
                </div>
                <div class="action">
                    <div class="edit">
                        <form action="" method="post">
                            <input type="hidden" value="<?= $user->getId(); ?>">
                            <button type="submit" onclick="openModal2()">
                                <i class="fa-solid fa-gear"></i>
                                <span>modifier</span>
                            </button>
                        </form>
                    </div>
                    <div class="delete">
                        <form action="/delete" method="POST">
                            <input type="hidden" name="id" value="<?= $user->getId(); ?>">
                            <button type="submit">
                                <i class="fa-solid fa-x"></i>
                                <span>supprimer</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>





<?php
    require_once "Elements/footer.php";
?>