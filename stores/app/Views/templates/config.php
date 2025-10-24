<?php

$myConfig = config('AccessProperties');
$request = service('request');

$base = $myConfig->b_url;
$site_url = $myConfig->site_url;
$img_url = $myConfig->img_url;

$api_url = $myConfig->api_url;
$api_key = $myConfig->key;

$img_url = $myConfig->uploads . 'images/';
$image_url = $myConfig->uploads . 'images/';
$img_sat = $myConfig->uploads . 'staticimage/';

$url = $myConfig->api_url;
$burl = $myConfig->site_url;

$shop_name = $myConfig->shop_name ?? '';

$shop_url_name = $request->getUri()->getSegment(1);

$shop_url = $base . $shop_url_name;
$shop_id = $myConfig->shop_id ?? 0;
$color =  "#233a95";

$lColor = '#233a95';
$tcolor = "rgb(211, 235, 239)";
$label = "rgb(43, 190, 249)";


// $page = $request->getUri()->getSegment($request->getUri()->getTotalSegments());

// if ($request->getUri()->getPath()) {
//     $page = $request->getUri()->getPath();
//     print_r($page); die;
// }



// print_r($page);die;




?>

<style>
    .location-header, .lo-option{
        background : rgb(211, 235, 239);
    }
    #locationModalLabel{
        color : #233a95
    }
    .hfooter a{
        color : #ffb300;
    }
</style>

<p id="screenSize"></p>

<script>
    function updateScreenSize() {
        const width = window.innerWidth;
        const height = window.innerHeight;
        document.getElementById("screenSize").textContent = width + " x " + height + " pixels";
    }
 
    updateScreenSize();       
    window.onresize = updateScreenSize; 
</script>


<style>
    #screenSize{
        z-index: 9999;
        position: fixed;
        top: 10%;
        right: 10%;
        background: #000;
        color: #fff;
        padding: 5px;
        font-size: 12px;
    }
</style>