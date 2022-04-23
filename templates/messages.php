<?php if(array_key_exists('messages',$content)):?>
    <?php foreach($content['messages'] as $messageText):?>
        <?=$messageText;?> <br />
    <?php endforeach;?>
<?php endif;?>
