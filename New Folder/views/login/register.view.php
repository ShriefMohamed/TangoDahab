<div class="align-content-center flex-wrap" style="width: 60%;margin: 200px auto;">
    <div class="container">
        <div class="login-content">
            <div class="login-form">
                <form method="post">
                    <div class="form-group">
                        <label>Full Name</label> *
                        <input type="text" class="form-control" required placeholder="Full Name" name="fullname">
                    </div>
                    <div class="form-group">
                        <label>User Name</label> *
                        <input type="text" class="form-control" required placeholder="User Name" name="username">
                    </div>
                    <div class="form-group">
                        <label>Email address</label> *
                        <input type="email" class="form-control" required placeholder="Email" name="email">
                    </div>
                    <div class="form-group">
                        <label>Password</label> *
                        <input type="password" class="form-control" required placeholder="Password" name="password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label> *
                        <input type="password" class="form-control" required placeholder="Confirm Password" name="confirm-password">
                    </div>
                    <div class="form-group">
                        <label>Phone</label> *
                        <input type="number" class="form-control" required placeholder="Phone" name="phone">
                    </div>

                    <div class="form-group">
                        <label>Governorate</label> *
                        <select name="country" id="select" class="form-control">
                            <?php if (isset($countries) && $countries != null) : ?>
                                <?php for ($i=0; $i < sizeof($countries); $i++) : ?>
                                    <option value="<?= $countries[$i] ?>"><?= $countries[$i] ?></option>
                                <?php endfor; ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <input type="submit" value="Register" name="register-submit" class="btn btn-primary btn-flat m-b-30 m-t-30">
                    <br><br>
                    <div class="register-link m-t-15 text-center">
                        <p>Already have account ? <a href="<?= HOST_NAME ?>login"> Sign in</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
