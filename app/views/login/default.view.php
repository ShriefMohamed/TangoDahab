<div class="align-content-center flex-wrap" style="width: 60%;margin: 200px auto;">
    <div class="container">
        <div class="login-content">
            <div class="login-form">
                <form method="post">
                    <div class="form-group">
                        <label>Email address</label>
                        <input type="text" class="form-control" placeholder="Email/Username" name="username">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" placeholder="Password" name="password">
                    </div>
                    <div class="checkbox">
                        <label class="pull-right">
                            <a href="<?= HOST_NAME ?>login/password">Forgotten Password?</a>
                        </label>

                    </div>
                    <input name="login-submit" type="submit" value="Sign in" class="btn btn-success btn-flat m-b-30 m-t-30">
                    <br><br>
                    <div class="register-link m-t-15 text-center">
                        <p>Don't have account ? <a href="<?= HOST_NAME ?>login/register"> Sign Up Here</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

    <div id="status">
    </div>