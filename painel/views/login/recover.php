<form class="form-signin" method="post" action="#">

    <div class="col-md-12 text-center">
        <img class="text-center mb-4" src="<?php echo back_url("/views/make/logo.png"); ?>" alt="" width="72" height="72">
    </div>

    <h3 class="text-center h3 mb-3 font-weight-normal">Insira seu e-mail</h3>

    <label for="inputEmail" class="sr-only">E-mail para recuperação...</label>
    <input type="text" name="user_email" id="inputEmail" class="form-control" placeholder="E-mail para recuperação..." >

    <button class="btn btn-lg btn-primary btn-block" type="submit">Recuperar</button>

    <p class="text-center mt-5 mb-3 text-muted">&copy; MVC-git / 2017-2018</p>

</form>
