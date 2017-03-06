<?php
$panel = true;
include_once 'includes.php';
?>
<!DOCTYPE html>
<!--[if IE 9 ]><html class="ie9"><![endif]--> 
<html lang="tr">
<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo $bahadir->TRANSLATE_WORD("Bahadır Tıbbi Aletler A.Ş"); ?></title>
        <link href="/panel/assets/plugins/bower_components/fullcalendar/dist/fullcalendar.min.css" rel="stylesheet">
        <link href="/panel/assets/plugins/bower_components/animate.css/animate.min.css" rel="stylesheet">
        <link href="/panel/assets/plugins/bower_components/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet">
        <link href="/panel/assets/plugins/bower_components/material-design-iconic-font/dist/css/material-design-iconic-font.min.css" rel="stylesheet">
        <link href="/panel/assets/plugins/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet">
    
        <link href="/panel/assets/plugins/summernote/dist/summernote.css" rel="stylesheet" />
        <link href="/panel/assets/plugins/bower_components/bootstrap-select/dist/css/bootstrap-select.css" rel="stylesheet" />

        <link href="/panel/assets/css/app_1.min.css" rel="stylesheet">
        <link href="/panel/assets/css/app_2.min.css" rel="stylesheet">


 
        <script src="/panel/assets/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    </head>
    <body>
       <?php include_once("header.php"); ?>
        <section id="main">
            <aside id="sidebar" class="sidebar c-overflow">
                <?php include_once("nav.php"); ?>
            </aside> 
            <section id="content">
                <?php
                if(isset($_GET["view"])){
                    $view = $_GET["view"];
                }else{
                    $view = "dashboard";
                }
                switch ($view)
                {
                    case 'dashboard':
                        include_once("pages/dashboard/dashboard.php");
                        break;
                    case 'slaytlar':
                        include_once("pages/slaytlar/slaytlar.php");
                        break;
                	default:
                        include_once("pages/dashboard.php");
                        break;
                }
                ?>
            </section>
        </section>       
        <?php include_once("footer.php"); ?>
       <div class="page-loader">
            <div class="preloader pls-blue">
                <svg class="pl-circular" viewBox="25 25 50 50">
                    <circle class="plc-path" cx="50" cy="50" r="20" />
                </svg>

                <p><?php echo $bahadir->TRANSLATE_WORD("Lütfen Bekleyin..."); ?></p>
            </div>
        </div>
       <!--[if lt IE 9]>
            <div class="ie-warning">
                <h1 class="c-white">Warning!!</h1>
                <p>You are using an outdated version of Internet Explorer, please upgrade <br/>to any of the following web browsers to access this website.</p>
                <div class="iew-container">
                    <ul class="iew-download">
                        <li>
                            <a href="http://www.google.com/chrome/">
                                <img src="/panel/assets/img/browsers/chrome.png" alt="">
                                <div>Chrome</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.mozilla.org/en-US/firefox/new/">
                                <img src="/panel/assets/img/browsers/firefox.png" alt="">
                                <div>Firefox</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://www.opera.com">
                                <img src="/panel/assets/img/browsers/opera.png" alt="">
                                <div>Opera</div>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.apple.com/safari/">
                                <img src="/panel/assets/img/browsers/safari.png" alt="">
                                <div>Safari</div>
                            </a>
                        </li>
                        <li>
                            <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                                <img src="/panel/assets/img/browsers/ie.png" alt="">
                                <div>IE (New)</div>
                            </a>
                        </li>
                    </ul>
                </div>
                <p>Sorry for the inconvenience!</p>
            </div>
        <![endif]-->

      
        <script src="/panel/assets/plugins/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

        <script src="/panel/assets/plugins/bower_components/flot/jquery.flot.js"></script>
        <script src="/panel/assets/plugins/bower_components/flot/jquery.flot.resize.js"></script>
        <script src="/panel/assets/plugins/bower_components/flot.curvedlines/curvedLines.js"></script>
        <script src="/panel/assets/plugins/sparklines/jquery.sparkline.min.js"></script>
        <script src="/panel/assets/plugins/bower_components/jquery.easy-pie-chart/dist/jquery.easypiechart.min.js"></script>

        <script src="/panel/assets/plugins/bower_components/moment/min/moment.min.js"></script>
        <script src="/panel/assets/plugins/bower_components/fullcalendar/dist/fullcalendar.min.js"></script>
        <script src="/panel/assets/plugins/bower_components/simpleWeather/jquery.simpleWeather.min.js"></script>
        <script src="/panel/assets/plugins/bower_components/Waves/dist/waves.min.js"></script>
        <script src="/panel/assets/plugins/bootstrap-growl/bootstrap-growl.min.js"></script>
        <script src="/panel/assets/plugins/bower_components/sweetalert2/dist/sweetalert2.min.js"></script>
        <script src="/panel/assets/plugins/bower_components/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>


        <script src="/panel/assets/plugins/summernote/dist/summernote-updated.min.js"></script>

        <script src="/panel/assets/plugins/bower_components/bootstrap-select/dist/js/bootstrap-select.js"></script>
        <script src="/panel/assets/plugins/fileinput/fileinput.min.js"></script>


        <!-- Placeholder for IE9 -->
        <!--[if IE 9 ]>
            <script src="/panel/assets/plugins/bower_components/jquery-placeholder/jquery.placeholder.min.js"></script>
        <![endif]-->

        <script src="/panel/assets/js/app.min.js"></script>
    </body>
 
</html>
