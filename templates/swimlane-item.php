<div class="card draggable shadow-sm" data-id="<?=$zadanieTodo->id;?>" draggable="true" ondragstart="drag(event);updateInputStatusDrag(this);">
    <div class="card-body p-2">
        <div class="card-title">
            <img src="//upload.wikimedia.org/wikipedia/commons/thumb/6/6d/Windows_Settings_app_icon.png/30px-Windows_Settings_app_icon.png" class="rounded-circle float-right">
            <a href="" class="lead font-weight-light"><?=$zadanieTodo->title;?></a>
        </div>

        <p>
            <a> <?=$zadanieTodo->description;?></a>
        </p>

        <?php if(property_exists($zadanieTodo,'comments')
                && !empty($zadanieTodo->comments)
                ): ?>
            <p>Liczba komentarzy: <?=count($zadanieTodo->comments);?></p>
                <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#ukryj-mnie">komentarze</button>
            <div id="ukryj-mnie" class="collapse">
                <?php foreach($zadanieTodo->comments as $komentarz):
                ?>
                <hr />
                <h5><?=$komentarz->getText();?></h5>
                    <p><?=$komentarz->getDate();?></p>
                <?php
                endforeach;
                ?>

            </div>


        <?php else:?>
            <p>Brak komentarzy</p>
        <?php endif;?>
    </div>
    <div class="hidden">
        <input type="hidden" name="zadanie[<?=$zadanieTodo->id;?>]" value="<?=$zadanieTodo->status;?>" />
    </div>
</div>
<!---->
<!---->
<!--<script type="javascript">-->
<!--    $( document ).ready(function() {-->
<!--        document.getElementById("myBtn").addEventListener("drop", myFunction);-->
<!---->
<!--        function myFunction() {-->
<!--            alert ("Hello World!");-->
<!--        }-->
<!--    });-->
<!--</script>-->