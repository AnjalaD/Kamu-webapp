<?php $this->set_title('Error'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="text-center" style="padding-top:100px; padding-bottom:20rem; background-image:url(<?= SROOT ?>assets/img/Sauce-8-blur.jpg); background-attachment:fixed; background-size:cover;">
<i class="fas fa-ban" style="font-size:10rem; padding-bottom:20px; color:#9d2525; text-shadow: -1px 0 red, 0 1px red, 1px 0 red, 0 -1px red;"></i>
<h2 class="text-center" style="padding:20px 10px 10px 10px; color:white; text-shadow: -1px 0 #888888, 0 1px #555555, 1px 0 #555555, 0 -1px #555555; font-size:2rem; font-family:Aclonica">You don't have ACCESS to view this page !!</h2>
</div>
<?php $this->end(); ?>