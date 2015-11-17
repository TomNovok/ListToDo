<div class='footer__container'>
    <div id='alt' class='footer__alt'></div>
    <div id='clock' class='footer__clock'></div>
    <div id='clock_server' class='footer__clock' style='display: none;'>
        <?php if (isset($time_server)) echo "Server time: ".$time_server."   Client time: " ?>
    </div>
    <script type='text/javascript'>printTime();setInterval("printTime();",1000);</script>
</div>