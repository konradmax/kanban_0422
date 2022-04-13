<h1><?=$content['page_title'];?></h1>
<p><?=$content['content'];?></p>
<?php if(array_key_exists('products',$content)&& !empty($content['products'])):?>
    <?php foreach($content['products'] as $product):?>
        <div class="row">
            <div class="col-sm-3">
                <img style="width:100%;" src="<?=$product['image'];?>" alt="" />
            </div>
            <div class="col-sm-9">
                <h3><?=$product['name'];?></h3>
                <ul>
                    <?php foreach(explode(';',$product['colours']) as $colour):?>
                        <li><?=$colour;?></li>
                    <?php endforeach;?>
                </ul>
                <h4>&pound;<?=money_format("%i",$product['price']);?></h4>
            </div>
        </div>
        <hr />
    <?php endforeach;?>
<?php else:?>
    <p>There is no products :/</p>
<?php endif;?>