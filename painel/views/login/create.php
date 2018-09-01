<form class="form-signin" method="post" action="#">

    <div class="col-md-12 text-center">
        <img class="text-center mb-4" src="<?php echo back_url("/views/make/logo.png"); ?>" alt="" width="72" height="72">
    </div>

    <h3 class="text-center h3 mb-3 font-weight-normal">Insira seus dados para o cadastro</h3>

    <label for="inputName" class="sr-only">Nome...</label>
    <input type="text" name="user_name" id="inputName" class="form-control" placeholder="Nome"  autofocus>

    <label for="inputEmail" class="sr-only">Email...</label>
    <input type="text" name="user_email" id="inputEmail" class="form-control" placeholder="E-mail"  autofocus>

    <label for="inputPassword" class="sr-only">Senha...</label>
    <input type="password" name="user_password" id="inputPassword" class="form-control" placeholder="Password" >

    <div class="checkbox mb-3">
        <label>
            <a href="#">Login</a>
        </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>

    <p class="text-center mt-5 mb-3 text-muted">&copy; MVC-git / 2017-2018</p>

</form>
