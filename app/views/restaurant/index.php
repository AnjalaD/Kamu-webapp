<?php 
use core\H;
?>

<?php $this->set_title('Restaurants'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<h3 class="text-center">Verified Restaurants</h3>
<table class="table table-striped table-bordered table-hover">
    <thead>
        <th>Name</th>
        <th>Image</th>
        <th>Telephone</th>
        <th>Address</th>
        <th>Email</th>
        <th></th>
    </thead>
    <tbody>
        <?php foreach($this->restaurants as $restaurant): ?>
            <tr>
                <td><a href="<?=SROOT.'restaurant/details/'.$restaurant->id?>"><?=$restaurant->restaurant_name?></td>
                <td><img src="<?=$restaurant->image_url?>" ></td>
                <td><?=$restaurant->telephone?></td>
                <td><?=$restaurant->address?></td>
                <td><?=$restaurant->email?></td>
                <td class="text-right">
                    <a href="<?=SROOT?>restaurant/edit/<?=$restaurant->id?>" class="btn btn-primary" onclick= "if(!confirm('Are you sure?')){return false;}">Edit</a>
                    <a href="<?=SROOT?>restaurant/delete/<?=$restaurant->id?>" class="btn btn-danger" onclick= "if(!confirm('Are you sure?')){return false;}">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?php $this->end(); ?>
