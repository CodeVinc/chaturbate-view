<?php
if(!empty($_GET['username'])) {

    //remove white spaces
    $user = preg_replace('/\s+/', '', $_GET['username']);
    
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL, "https://chaturbate.com/get_edge_hls_url_ajax/");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, "room_slug=" . $user . "&bandwidth=high");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["X-Requested-With: XMLHttpRequest"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $info = json_decode(curl_exec($ch), true);
    curl_close($ch);

    $url = $info['url']; 
    $room_status = $info['room_status'];
} 
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charturbate View</title>
    <meta property="og:type" content="website" />
    <meta property="og:title" content="Charturbate View" />
    <meta property="og:description" content="free live webcam +18" />
    <link rel="icon" type="image/x-icon" href="https://ssl-ccstatic.highwebmedia.com/favicons/favicon.ico">
	<link rel="stylesheet" href="https://cdn.plyr.io/3.6.3/plyr.css"/>
	<link rel="stylesheet" type="text/css" href="files/style.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@100;300&display=swap" rel="stylesheet"> 
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/hls.js@latest"></script>
    <script src="https://cdn.plyr.io/3.6.3/plyr.js"></script>
</head>
<body>
<!-- ads -->
<div id="ads-conteiner">
	<div id="ads-box">
<?php
    //empty ou offline
    if(empty($room_status) || $room_status == "offline")
    { ?>
        <b>Camgirl não encontado ou offline</b>
<?php } else { ?>
		<div id="ads-close">Fechar</div><br> 
		<iframe src="https://syndication.realsrv.com/ads-iframe-display.php?idzone=4133448&output=noscript" width="300" height="250" scrolling="no" marginwidth="0" marginheight="0" frameborder="0"></iframe>
        <div id="xs-url" date-file="<?php echo $url ?>"></div>
<?php } ?>
    </div>
</div>
<!-- end ads -->
<!-- player -->
<div class="container-to-video">
    <video id="player" style="--plyr-color-main: #4a5464 !important;"  crossorigin playsinline controls></video>
</div>
<!-- end player -->
<div class="container">
    <form action="" method="get">
        <input type="text" placeholder="Nome de  usuario  da camgirl"  id="form-btn" name="username">
        <input type="submit" id="submit-btn" value="Procurar live">
    </form> 
</div>
<div class="footer">
 © Oltiz 2020
</div>
<script src="files/script.js" type="text/javascript"></script>
</body>
</html>
