<form class="form-group" method="post" action=<?=$this->post_action?> >
    <?= input_block('text', 'Name', 'name', $this->item->name, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= input_block('text', 'Description', 'description', $this->item->description, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= input_block('text', 'Price', 'price', $this->item->price, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= input_block('submit', '', 'add', 'Add', ['class' => 'btn btn-primary'], ['class' => 'form-group col-md-6']); ?>
</form>