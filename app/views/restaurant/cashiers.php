<?php $this->set_title('Cashiers List'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>/css/croppie.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div class="col-md-8 col-md-offset-2">
    <table>
        <thead>
            <th>Cashier Name</th>
            <th>Email</th>
            <th>Manage</th>
        </thead>
        <tbody>
            <?php if (!empty($this->cashiers)) : ?>
                <?php foreach ($this->cashiers as $cashier) : ?>
                    <tr id=<?= $cashier->id ?>>
                        <th id="name"><?= $cashier->first_name . ' ' . $cashier->last_name ?></th>
                        <th id="email"><?= $cashier->email ?></th>
                        <th id="manage">
                            <a href="<?= SROOT ?>restaurant/cashier_status_toggle/<?= $cashier->id ?>" style="color:black;" class="btn btn-warning mt-1">
                            <?=$cashier->disabled? "Enable" :  "Disable" ;?>   
                            </a>
                            <a href="<?= SROOT ?>restaurant/remove_cashier/<?= $cashier->id ?>" class="btn btn-danger mt-1" onclick="if(!confirm('Are you sure?')){return false;}">Delete</a>
                        </th>

                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>

</div>


<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script>
<?php $this->end(); ?>