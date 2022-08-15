<?php

?>
<div class="row">
    <form method="POST" action="index.php">
        <div class="row mb-3">
            <label for="username" class="col-md-4 text-md-end">Username</label>
            <div class="col-md-6">
                <input id="username" type="text" class="form-control " name="username" value="" required autofocus>
            </div>
        </div>
        <div class="row mb-3">
            <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>

            <div class="col-md-6">
                <input id="password" type="password" class="form-control " name="password" required>
            </div>
        </div>
        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    Login
                </button>
            </div>
        </div>
    </form>
</div>