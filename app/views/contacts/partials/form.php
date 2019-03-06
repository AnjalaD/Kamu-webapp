<form class="form-group" method="post" action=<?=$this->post_action?> >
    <?= input_block('text', 'Name', 'name', $this->contact->name, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= input_block('text', 'Email', 'email', $this->contact->email, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= input_block('text', 'Address', 'address', $this->contact->address, ['class' => 'form-control col-md-6'], ['class' => 'form-group']); ?>
    <?= input_block('submit', '', 'add', 'Add', ['class' => 'btn btn-primary'], ['class' => 'form-group col-md-6']); ?>
</form>