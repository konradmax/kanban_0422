<form method="POST" name="zapisz" action="?page=edit&id=<?=$content['result']['id']?>" enctype="multipart/form-data">
    <input type="hidden" name="form_name" value="" />
    <h1 class="h3 mb-3 fw-normal"><?=$content['page_title'];?></h1>
    <div class="">
        <label for="floatingInput">Title</label>

        <input type="text" name="title" value="<?=$content['result']['title'];?>" class="form-control" id="floatingInput">

    </div>
    <div class="">
        <label for="txtDescription">Description</label>
        <br />
        <textarea name="description" id="txtDescription"><?=$content['result']['description'];?></textarea>
    </div>
    <div class="">
        <label for="imgImage">Image</label>
        <input type="file" name="image" id="imgImage" class="form-control" />
        <?=$content['result']['image'];?>
    </div>
    <div class="">
        <label for="cboStatus">Status</label>
        <select name="cboStatus">
            <option value="1" <?=($content['result']['status']==1)?'selected="selected"':null;?>>1</option>
            <option value="2" <?=($content['result']['status']==2)?'selected="selected"':null;?>>2</option>
            <option value="3" <?=($content['result']['status']==3)?'selected="selected"':null;?>>3</option>
            <option value="4" <?=($content['result']['status']==4)?'selected="selected"':null;?>>4</option>
        </select>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Zapisz</button>
    <input type="hidden" name="form_name" value="<?=$content['form_name'];?>">
</form>
<?php var_dump($content['result']);?>

<!--<form action="" method="POST" name="--><?//=$formName;?><!--">-->
<!--    <input type="text" name="uzyszkodnik" />-->
<!--    <input type="password" name="password" />-->
<!--    <input type="hidden" name="form_name" value="--><?//=$formName;?><!--" />-->
<!--    <input type="submit" />-->
<!--</form>-->