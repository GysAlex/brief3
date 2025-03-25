<?php

use Utils\Storage\Storage;

require_once "../vendor/autoload.php";

require_once "Elements/header.php";




?>

<div class="container" style="margin-top: 30px;">
    <div class="back">
        <a href="/admin">
            <i class="fa-solid fa-arrow-left" style="color: rgb(96, 96, 245); font-size: 2em"></i>
        </a>
    </div>
</div>
<div class="container last">
    <div class="left-side">
        <div class="imgcon" style="--img: url('<?php if($user->getImage()) echo Storage::getUrl($user->getImage()); else echo 'images/defaultIcon.svg'; ?>') <?php if(!$user->getImage()) echo ";";  ?>">

        </div>
        <div class="user-info">
            <div class="name mt-2">
                <?= $user->getUsername() ?>
            </div>
            <div class="role  <?php if($user->roleName()==="admin") echo "admin"; else echo "client"; ?>">
                <span><?= $user->roleName() ?></span>
            </div>
            <div class="email">
                <?= $user->getEmail() ?>
            </div>
            <div class="status  <?php if($user->getStatus()==="active") echo "active"; else echo "inactive"; ?>">
                <span><?= $user->getStatus() ?></span>
            </div>
        </div>
    </div>
    <div class="right-side">
        <div class="content" style="width: 100%;">
            <div class="title my-3 mb-4 px-4 py-2 mx-auto mb-1" style="margin-top: 20px !important; color: rgb(96, 96, 245); font-size: 1.2em;">
                <i class="fa-solid fa-history mx-2"></i> historique de connexion de <?= $user->getUsername() ?>
            </div>
            <div class="session-table px-4 mx-auto my-3" style="margin-top: 50px !important; max-height: 800px; overflow-y: auto;">
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
                            <?php $d = strtotime($session->getLogin_time()); echo date("H:i:s", $d)?>
                        </div>
                        <div class="end" style="text-transform: capitalize; font-weight: 600;">
                            <?php 
                            
                            if(!$session->getLogout_time())
                                echo "<span style='color: yellowgreen; font-weight: 500;'>maintenant</span>";
                            else
                            {
                                $d = strtotime($session->getLogout_time()); 
                                echo date("H:i:s", $d);
                            }                        
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="px-4 mt-4" >
                <span style="color: rgb(96, 96, 245); font-weight:600; "> Nombre total de connexions : </span> <span style="color: rgb(96, 96, 245); font-weight:600; "> <?= count($sessions) ?> </span> 
            </div>
        </div>
    </div>
</div>



<?php

    require_once "Elements/footer.php";
?>