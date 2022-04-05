
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>


<div class="card draggable shadow-sm" id="cd1" draggable="true" ondragstart="drag(event)">
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
</div>
