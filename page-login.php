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
$coords = file_get_contents('https://ipinfo.io/' . $_SERVER['REMOTE_ADDR'] . '/json');
$coords = json_decode($coords, true)['loc'];
$coords = explode(',', $coords);
$coords = $coords[1] . ',' . $coords[0];
$backgroundImage = 'https://api.mapbox.com/styles/v1/bhsjacket/ck6zs9l5p142p1jmuiy7tkakg/static/' . $coords . ',13,0/1280x800?access_token=pk.eyJ1IjoiYmhzamFja2V0IiwiYSI6ImNrNnpyYzZpZTBkOWgzZW9ndXMybG01NXoifQ.dTHlIXLy2CKqQeNJyU-KWw';
?>

<body style="background-image:url(<?php echo $backgroundImage; ?>)">
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