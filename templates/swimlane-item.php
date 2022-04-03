<div class="card draggable shadow-sm" id="cd1" draggable="true" ondragstart="drag(event)">
    <div class="card-body p-2">
        <div class="card-title">
            <img src="//placehold.it/30" class="rounded-circle float-right">
            <a href="" class="lead font-weight-light"><?=$zadanieTodo->title;?></a>
        </div>
        <p>
            <a> <?=$zadanieTodo->description;?></a>
        </p>

        <?php if(

                property_exists($zadanieTodo,'comments')

                && $zadanieTodo->comments != null

                ): ?>
            <p>Liczba komentarzy: <?=count($zadanieTodo->comments);?></p>

            <div class="ukryj-mnie">
                <?php foreach($zadanieTodo->comments as $komentarz):
                ?>
                <hr />
                <h5><?=$komentarz['text'];?></h5>
                <p><?=$komentarz['date_created'];?></p>
                <?php
                endforeach;
                ?>

            </div>


        <?php else:?>
            <p>Brak komentarzy</p>
        <?php endif;?>
        <button class="btn btn-primary btn-sm">View</button>
    </div>
</div>
<div class="dropzone rounded" ondrop="drop(event)" ondragover="allowDrop(event)" ondragleave="clearDrop(event)"> &nbsp; </div>