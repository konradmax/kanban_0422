<form method="POST" name="zapisz">
    <input type="hidden" name="form_name" value="" />
    <h1 class="h3 mb-3 fw-normal"><?=$header;?></h1>
    <div class="form-floating">
        <input type="text" name="uzyszkodnik" value="testowy" class="form-control" id="floatingInput" placeholder="name@example.com">
        <label for="floatingInput">Email address</label>
    </div>
    <div class="form-floating">
        <input type="password" name="password" value="lubiemaslo" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>
    <input type="hidden" name="form_name" value="<?=$formName;?>">
</form>

<!--<form action="" method="POST" name="--><?//=$formName;?><!--">-->
<!--    <input type="text" name="uzyszkodnik" />-->
<!--    <input type="password" name="password" />-->
<!--    <input type="hidden" name="form_name" value="--><?//=$formName;?><!--" />-->
<!--    <input type="submit" />-->
<!--</form>-->