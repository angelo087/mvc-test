<form action="" method="post">
    <p><?php echo empty($this->registerError) ? "" : $this->registerError; ?></p>
    <div class="form-group">
        <label>Username</label>
        <input type="text" id="username" name="username" class="form-control">
    </div>    
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit" value="Register">
    </div>
    <p>You have account? <a href="?c=main&a=login">Sign in now</a>.</p>
</form>
