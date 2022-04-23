
<form method="POST" name="new_user" action="?page=newuser">
    <input type="hidden" name="form_name" value="" />
    <div class="form-floating">
        <input type="text" name="name" value="" class="form-control" id="floatingInput" placeholder="Username">
        <label for="floatingInput">Username</label>
    </div>
    <div class="form-floating">
        <input type="password" name="password[original]" value="" class="form-control" id="floatingPassword" placeholder="Password">
        <label for="floatingPassword">Password</label>
    </div>
    <div class="form-floating">
        <input type="password" name="password[confirm]" value="" class="form-control" id="floatingPassword" placeholder="Repeat password">
        <label for="floatingPassword">Repeat Password</label>
    </div>
    <button class="w-100 btn btn-lg btn-primary" type="submit">Create Account</button>
    <input type="hidden" name="form_name" value="<?=$content['form_name'];?>">
</form>

<!--<form action="" method="POST" name="--><?//=$formName;?><!--">-->
<!--    <input type="text" name="uzyszkodnik" />-->
<!--    <input type="password" name="password" />-->
<!--    <input type="hidden" name="form_name" value="--><?//=$formName;?><!--" />-->
<!--    <input type="submit" />-->
<!--</form>-->