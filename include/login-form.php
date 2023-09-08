<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 bg-tranparent">
            <div class="card mt-3">
                <div class="card-header text-white bg-primary">Вхід у методичну базу</div>

                <div class="card-body">

                    <form method="POST" action="index.php">
                        <div class="row mb-3">
                            <div class="p-2 border border-2 border-danger rounded-2">
                                <p class="fs-2 text-danger text-center">Увага!</p>
                                <p class="fs-4 text-danger">Вхід студентів до методичної бази можливий тільки з використанням логіну та паролю від електронного журналу!</p>
                                <!--<p class="fs-4 text-danger">Вхід викладачів до методичної бази можливий через web-інтерфейс журналу з обліковими даними електронного журналу!</p>-->
                            </div>

                        </div>
                        <div class="row mb-3">
                            <label for="username" class="col-md-4 text-md-end">Логін</label>
                            <div class="col-md-8">
                                <input id="username" type="text" class="form-control " name="username" value="" required autofocus>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">Пароль</label>

                            <div class="col-md-8">
                                <input id="password" type="password" class="form-control " name="password" required>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Увійти
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>