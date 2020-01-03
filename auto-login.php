<?php
/*
 * Build html form to redirect to webdirect hosted file 
 * and automatically log in.
 * 
 * @author Mike Duncan
 * @copyright 2019-12-13
 * 
 */
ini_set('log_errors', 0);
ini_set('display_errors',0);

/*
 * Set username and password that will allow for low level privilege set
 * that has ONLY webdirect enabled. These are effectively public credentials.
 */
$data = array();
$data['user'] = "low";
$data['pwd'] = "low";

/*
 * Optionally set additional parameters to redirect on session end, call 
 * a script and pass parameters
 */
// $data['homeurl'] = "/mylogout.php";
// $data['script'] = "myScript";
// $data['param'] = "myScriptParam";

/*
 * Update to the full url for your webdirect hosted file.
 */
$url = "https://your_domain_name/fmi/webd/FileName";

redirect_post($url, $data);

function redirect_post($url, array $data) { ?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <script type="text/javascript">
        function closethisasap() {
            document.forms["redirectpost"].submit();
        }
    </script>
</head>
<body onload="closethisasap();">
<form name="redirectpost" method="post" action="<?php echo $url; ?>">
<?php if ( !is_null($data) ) {
    foreach ($data as $k => $v) {
        echo '<input type="hidden" name="' . $k . '" value="' . $v . '"> ';
    }
} ?>
</form>
</body>
</html><?php
exit;
}

# eof
