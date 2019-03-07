<form class="form-group" method="post" action=<?=$this->post_action?> >
    <?= FH::input_block('text', 'Name', 'name', $this->item->name, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= FH::input_block('text', 'Description', 'description', $this->item->description, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= FH::input_block('text', 'Price', 'price', $this->item->price, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= FH::input_block('submit', '', 'add', 'Add', ['class' => 'btn btn-primary'], ['class' => 'form-group col-md-6']); ?>
</form>