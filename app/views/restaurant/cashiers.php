<?php $this->set_title('Cashiers List'); ?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= SROOT ?>/css/croppie.css">
<?php $this->end(); ?>

<?php $this->start('body'); ?>

<div class="col-md-6" style=" margin-right:auto; margin-left:auto; padding:30px; font-family:Aclonica";>
    <table class="table text-center" style="padding:15px;">
        <thead style="margin-bottom:5px; background-color:#9d2525; color:white;">
            <th>Cashier Name</th>
            <th>Email</th>
            <th>Manage</th>
        </thead>
        <tbody style="font-size:1rem;">
            <?php if (!empty($this->cashiers)) : ?>
                <?php foreach ($this->cashiers as $cashier) : ?>
                    <tr style="border-bottom: 2px solid #999999;"id=<?= $cashier->id ?>>
                        <td id="name"><?= $cashier->first_name . ' ' . $cashier->last_name ?></td>
                        <td id="email"><?= $cashier->email ?></td>
                        <td id="manage">
                            <a style="font-size:0.8rem; margin:0px 5px 0px 5px" href="<?= SROOT ?>restaurant/cashier_status_toggle/<?= $cashier->id ?>" style="color:black;" class="btn btn-warning mt-1">
                            <?=$cashier->disabled? "Enable" :  "Disable" ;?>   
                            </a>
                            <a style="font-size:0.8rem; margin:0px 5px 0px 5px" href="<?= SROOT ?>restaurant/remove_cashier/<?= $cashier->id ?>" class="btn btn-danger mt-1" onclick="if(!confirm('Are you sure?')){return false;}">Delete</a>
                        </td>

                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>
</div>


<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= SROOT ?>js/croppie.js"></script>
<script src="<?= SROOT ?>js/croppie-function.js"></script>
<?php $this->end(); ?>