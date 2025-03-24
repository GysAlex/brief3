<?php

    require_once "../vendor/autoload.php";

    require_once "Elements/header.php";
    use App\Views\Helper\Form;
    use App\Views\Helper\Input;
    use App\Views\Helper\Label;

    if (isset($_GET['fail']) && $_GET['fail']=="form") 
    {
        $formError = true;

    }

    if (isset($_GET['fail']) && $_GET['fail']=="unactive") 
    {
        $unactive = true;

    }    

    if (isset($_GET['fail']) && $_GET['fail']=="login") 
    {
        $logError = true;
    }


    if (isset($_GET['forbi'])) 
    {
        $forbidden = true;
    }


    $form = new Form("/login", 'POST', '');
    $form->formOpen();

    if(isset($formError))
    {
        $input1 = new Input('', 'email', '', false, 'email', $formError); 
        $input2 = new Input('password', 'password', '', false, 'password', $formError); 
    }

    else if(isset($logError))
    {
        $input1 = new Input('', 'email', '', false, 'email'); 
        $input2 = new Input('password', 'password', '', false, 'password', $logError);  
        
        if (isset($_COOKIE['user_email'])) 
            $input1->setValValue($_COOKIE['user_email']);
            
    }
        
    else if(isset($unactive))
    {
        $input1 = new Input('', 'email', '', false, 'email'); 
        $input2 = new Input('password', 'password', '', false, 'password', $unactive);  
        
        if (isset($_COOKIE['user_email'])) 
            $input1->setValValue($_COOKIE['user_email']);
            
    }

    else
    {
        $input1 = new Input('', 'email', '', false, 'email');        
        $input2 = new Input('password', 'password', '', false, 'password');  

    }

    $label1 = new Label("Votre email", "email");
    $input1->addClass('shadow-none mb-3');
    
    $label2 = new Label("Votre mot de passe", "password");
    $input2->addClass('shadow-none');


    $button = new Input('submit', '', '', false, '');
    $button->addClass("btn mt-3");
    $button->setValValue('Soumettre');

    $form->addInput($label1, $input1, $label2, $input2, $button);

    $form->formClose();


    

?>

<?php if(isset($forbidden) && $forbidden) : ?>
    <div class="loginForm alert alert-danger" style="display: flex; margin-inline: auto; align-items: center; justify-content: center;">
        Vous n'avez pas le droit d'acceder à cette page. Veillez vous connectez
    </div>
<?php $forbidden=false; endif; ?>

<?php if(isset($formError) && $formError) : ?>
    <div class="loginForm alert alert-danger" style="display: flex; margin-inline: auto; align-items: center; justify-content: center;">
        Veuillez correctement remplir le formulaire
    </div>
<?php $formError=false; 
      $input2->addClass('is-invalid');
endif; ?>

<?php if(isset($unactive) && $unactive) : ?>
    <div class="loginForm alert alert-danger" style="display: flex; margin-inline: auto; align-items: center; justify-content: center;">
        Ce compte a été désactivé. Veuillez contacter l'administrateur
    </div>
<?php $formError=false; 
      $input2->addClass('is-invalid');
endif; ?>

<?php if(isset($logError) && $logError) : ?>
    <div class="loginForm alert alert-danger" style="display: flex; margin-inline: auto; align-items: center; justify-content: center;">
        identifiant ou mot de passe incorrecte
    </div>

<?php 
    $logError=false; 
    endif; 
?>

<div class="container loginForm " style="margin-bottom: 113px;">
    <h4 class="mb-3">Connectez vous !</h4>
    <?= $form->display() ?>
</div>


<?php
    require_once "Elements/footer.php";
?>
