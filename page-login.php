<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In - Berkeley High Jacket</title>
    <link href="<?php echo get_template_directory_uri(); ?>/css/login.css?version=<?php echo uniqid(); ?>" rel="stylesheet">
    <meta name='robots' content='noindex,noarchive'>
</head>
<?php
$patterns = [
    'topo',
    'arch',
    'moti',
    'circ'
];
$patterns = $patterns[array_rand($patterns)];
?>
<body class="<?php echo $patterns; ?>">
    <div class="form">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/logos/logo-dark.svg">
        <form id="login" action="/wp-login.php" method="POST">
            <input type="text" name="log" placeholder="Username or Email" required autofocus>
            <input type="password" name="pwd" placeholder="Password" required>
            <input type="submit" value="Login">
            <input type="hidden" name="redirect_to" value="/">
            <div class="bottom">
                <div class="remember">
                    <input type="checkbox" value="forever" name="rememberme" id="rememberme">
                    <label for="rememberme">Remember me</label>
                </div>
                <a class="forgot-password" href="mailto:web@bhsjacket.com">Forgot password?</a>
            </div>
        </form>
    </div>
</body>
</html>