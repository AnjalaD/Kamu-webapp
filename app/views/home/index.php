<?php $this->set_title('Home'); ?>

<?php $this->start('head'); ?>
<?php $this->end(); ?>

<?php $this->start('body'); ?>
<div onclick="ajax_test();">Click</div>
<script>
function ajax_test()
{
    $.ajax({
        type : "POST",
        url :'<?=SROOT?>home/test_ajax',
        data : {model_id:45},
        success : function(resp){
            console.log(resp);
        }
    });
}
</script>
<h1>Welcome to home</h1>
<?php $this->end(); ?>