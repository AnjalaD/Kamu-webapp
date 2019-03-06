<?php $this->set_title('Contacts'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<h3 class="center">Contacts</h3>
<table class="table table-striped table-borderd">
    <thead>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->contacts as $conctact): ?>
            <tr>
                <td><?=$conctact->name?> </td>
                <td><?=$conctact->email?></td>
                <td><?=$conctact->address?></td>
                <td></td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php $this->end(); ?>