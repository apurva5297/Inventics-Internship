
<html>
    <head>
        <title>Secure connection to paytm server</title>
    </head>
    <body>
        <center><h1>Please do not refresh this page...</h1></center>
        <form method='post' action='https://securegw-stage.paytm.in/order/process' name='f1'>
            <?php
                foreach(json_decode($data->paytmParams) as $name => $value) {
                    echo '<input type="hidden" name="' . $name .'" value="' . $value . '">';
                }
            ?>
            <input type="hidden" name="CHECKSUMHASH" value="<?php echo $data->paytmChecksum; ?>">
        </form>
        <script type="text/javascript">
            document.f1.submit();
        </script>
    </body>
</html>