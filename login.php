<?php
$panel = false;
include_once('system/bahadir.php');

if($_POST){
    $username = $_POST["username"];
    $password = $_POST["password"];
    if(isset($_POST["remember"])){ $remember = $_POST["remember"]; }else{ $remember = "off"; }
    $message = $bahadir->LOGIN($username, $password, $remember);
}
?>

<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]-->
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $bahadir->TRANSLATE_WORD("Yönetim Paneli", 1); ?></title>
    <!-- Vendor CSS -->
    <link href="/panel/assets/plugins/bower_components/animate.css/animate.min.css" rel="stylesheet">
    <link href="/panel/assets/plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
    <!-- CSS -->
    <link href="/panel/assets/css/app_1.min.css" rel="stylesheet">
    <link href="/panel/assets/css/app_2.min.css" rel="stylesheet">
</head>

<body>
    <div class="login-content">
        <!-- Login -->
        <div class="lc-block toggled" id="l-login">
            <div class="lcb-form">
                <form method="post" enctype="multipart/form-data">
                    <h4><?php echo $bahadir->TRANSLATE_WORD("YÖNETİM PANELİ", 1); ?></h4>
                    <br />
                    <div class="input-group m-b-20">
                        <span class="input-group-addon">
                            <i class="zmdi zmdi-account"></i>
                        </span>
                        <div class="fg-line">
                            <input type="text" name="username" class="form-control" placeholder="<?php echo $bahadir->TRANSLATE_WORD("Kullanıcı Adı", 1); ?>" />
                        </div>
                    </div>
                    <div class="input-group m-b-20">
                        <span class="input-group-addon">
                            <i class="zmdi zmdi-male"></i>
                        </span>
                        <div class="fg-line">
                            <input type="password" name="password" class="form-control" placeholder="<?php echo $bahadir->TRANSLATE_WORD("Parola", 1); ?>" />
                        </div>
                    </div>
                    <div class="input-group m-b-20">
                        <span class="input-group-addon">
                        </span>
                        <span style="color:red;text-align:left;float:left;margin-left:3px;">
                            <?php
                            if(isset($message)){ echo $bahadir->TRANSLATE_WORD($message, 1); }
                            ?>
                        </span>
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="remember" />
                            <i class="input-helper"></i>
                            <?php echo $bahadir->TRANSLATE_WORD("oturumu sürekli açık tut", 1); ?>
                        </label>
                    </div>
                    <button type="submit" href="#" class="btn btn-login btn-success btn-float">
                        <i class="zmdi zmdi-arrow-forward"></i>
                    </button>
                </form>
            </div>

            <div class="lcb-navigation">
                <!--<a href="#" data-ma-action="login-switch" data-ma-block="#l-register"><i class="zmdi zmdi-plus"></i> <span>Register</span></a>-->
                <!--<a href="#" data-ma-action="login-switch" data-ma-block="#l-forget-password"><i>?</i> <span>Forgot Password</span></a>-->
            </div>
        </div>

        <!-- Forgot Password -->
        <!--<div class="lc-block" id="l-forget-password">
            <div class="lcb-form">
                <p class="text-left">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla eu risus. Curabitur commodo lorem fringilla enim feugiat commodo sed ac lacus.</p>
                <div class="input-group m-b-20">
                    <span class="input-group-addon"><i class="zmdi zmdi-email"></i></span>
                    <div class="fg-line">
                        <input type="text" class="form-control" placeholder="Email Address">
                    </div>
                </div>
                <a href="#" class="btn btn-login btn-success btn-float"><i class="zmdi zmdi-check"></i></a>
            </div>
            <div class="lcb-navigation">
                <a href="#" data-ma-action="login-switch" data-ma-block="#l-login"><i class="zmdi zmdi-long-arrow-right"></i> <span>Sign in</span></a>
                <a href="#" data-ma-action="login-switch" data-ma-block="#l-register"><i class="zmdi zmdi-plus"></i> <span>Register</span></a>
            </div>
        </div>-->
    </div>

    <!-- Older IE warning message -->
    <!--[if lt IE 9]>
        <div class="ie-warning">
            <h1 class="c-white">Warning!!</h1>
            <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
            <div class="iew-container">
                <ul class="iew-download">
                    <li>
                        <a href="http://www.google.com/chrome/">
                            <img src="img/browsers/chrome.png" alt="">
                            <div>Chrome</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.mozilla.org/en-US/firefox/new/">
                            <img src="img/browsers/firefox.png" alt="">
                            <div>Firefox</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                            <div>Opera</div>
                        </a>
                    </li>
                    <li>
                        <a href="https://www.apple.com/safari/">
                            <img src="img/browsers/safari.png" alt="">
                            <div>Safari</div>
                        </a>
                    </li>
                    <li>
                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                            <div>IE (New)</div>
                        </a>
                    </li>
                </ul>
            </div>
            <p>Sorry for the inconvenience!</p>
        </div>
    <![endif]-->
    <!-- Javascript Libraries -->
    <script src="/panel/assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/panel/assets/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/panel/assets/plugins/bower_components/Waves/dist/waves.min.js"></script>
    <!-- Placeholder for IE9 -->
    <!--[if IE 9 ]>
        <script src="/panel/assets/plugins/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
    <![endif]-->
    <script src="/panel/assets/js/app.min.js"></script>
</body>
</html>
