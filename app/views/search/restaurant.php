<?php
use core\FH;

$token = FH::generate_token();
?>
<?php $this->set_title('Restaurants'); ?>
<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<h3 class="center">Restaurants</h3>
<?php $this->end(); ?>