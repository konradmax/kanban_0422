<?php if(array_key_exists('messages',$content) && is_array($content['messages'])):?>
    <?php foreach($content['messages'] as $messageText):?>
        <?=$messageText;?> <br />
    <?php endforeach;?>
<?php endif;?>
