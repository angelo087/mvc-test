<form action="" method="post">
    <p><?php echo empty($this->loginError) ? "" : $this->loginError; ?></p>
    <div class="form-group">
        <label>Username</label>
        <input type="text" id="username" name="username" class="form-control">
    </div>    
    <div class="form-group">
        <label>Password</label>
        <input type="password" name="password" id="password" class="form-control">
    </div>
    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="submit" value="Login">
    </div>
    <p>Don't have an account? <a href="?c=main&a=register">Sign up now</a>.</p>
</form>
