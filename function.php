<?php
$default = array(

    //facebook
    "facebook-domain-verification" => "",
    "fb_app_id" => "2824369061207392",
    "fb_pages" => "",
    ///google
    "g_app_id" => "UA-120150821-5"
);

if (!isset($_SERVER['REQUEST_URI']) || $_SERVER['REQUEST_URI'] == '' || $_SERVER['REQUEST_URI'] == '/') {
    //if home
    $val = array(
        "lang" => "en-us",
        "site_name" => "HEIN SOE | A web developer",

        "title" => "Hein Soe",
        "url" => "https://www.heinsoe.com",
        "description" => "A web Developer",
        "keywords" => "heinsoe , hein soe , ဟိန်းစိုး",

        //og
        "image" => "https://api.heinsoe.com/v3/ogimg.jpg",
        "type" => "website",

    );
    myHeadTag(array_merge($default, $val));
} else {
    $path =  parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $paths = (explode("/", $path));
    if (isset($paths[1])) {
        switch ($paths[1]) {
            case 'blog':
                //heinsoe.com/blog
                if (isset($paths[2])) {
                    $url = "https://api.heinsoe.com/v3/?path=blog&id=" . $paths[2];
                    if ($data = json_decode(myCurl($url), true)) {
                        //heinsoe.com/blog/{id}
                        $val = array(
                            "lang" => "en-us",
                            "site_name" => "Code For You",

                            "title" => $data['title'],
                            "url" => "https://www.heinsoe.com/blog/" . $paths[2],
                            "description" => strip_tags($data['excerpt']),
                            "keywords" => strip_tags($data['excerpt']),

                            //og
                            "image" => $data['feature_image'],
                            "type" => "article",
                        );
                    } else {

                        http_response_code(404);
                        $val = array(
                            "lang" => "my",
                            "site_name" => "HEIN SOE | A web developer",

                            "title" => "404 - ရွာပျောက်၊",
                            "url" => "https://www.heinsoe.com/portfolio/" . $paths[2],
                            "description" => "ဤစာမျက်နာတွင် အချက်အလက်မရှိပါ",
                            "keywords" => "heinsoe , hein soe , ဟိန်းစိုး",

                            //og
                            "image" => "https://api.heinsoe.com/v3/heinsoe_404.jpg",
                            "type" => "website",

                        );
                    }
                } else {
                    $val = array(
                        "lang" => "en-us",
                        "site_name" => "Code For You",

                        "title" => "Code for you",
                        "url" => "https://www.heinsoe.com/blog",
                        "description" => "နည်းပညာ ဗဟုသုတများဝေမျှရာ",
                        "keywords" => "php, html, css, js, web development",

                        //og
                        "image" => "https://api.heinsoe.com/v3/heinsoe_blog.jpg",
                        "type" => "website",

                    );
                }
                myHeadTag(array_merge($default, $val));
                break;
            case 'contact':
                $val = array(
                    "lang" => "en-us",
                    "site_name" => "Hein Soe | A web developer",

                    "title" => "Contact to Hein Soe",
                    "url" => "https://www.heinsoe.com/contact",
                    "description" => "Hi, I'm a frontend & backend stack developer",
                    "keywords" => "heinsoe , hein soe , ဟိန်းစိုး",

                    //og
                    "image" => "https://api.heinsoe.com/v3/heinsoe_contact.jpg",
                    "type" => "website",

                );
                myHeadTag(array_merge($default, $val));
                break;
            case 'skills':
                $val = array(
                    "lang" => "en-us",
                    "site_name" => "HEIN SOE | A web developer",

                    "title" => "My Skills",
                    "url" => "https://www.heinsoe.com/skills",
                    "description" => "frontend & backend stack developer",
                    "keywords" => "heinsoe , hein soe , ဟိန်းစိုး",

                    //og
                    "image" => "https://api.heinsoe.com/v3/heinsoe_skills.jpg",
                    "type" => "website",

                );
                myHeadTag(array_merge($default, $val));
                break;
            case 'portfolio':
                $metas = null;
                if (isset($paths[2])) {
                    $url = "https://api.heinsoe.com/portfolio/" . $paths[2]."/";
                    $data = myFetcher('$url', []);
                    if (isset($data['title'])) {
                        $val = array(
                            "lang" => "en-us",
                            "site_name" => "Code For You",

                            "title" =>  $data['title'],
                            "url" => "https://api.heinsoe.com/portfolio/" . $paths[2],
                            "description" => strip_tags($data['description']),
                            "keywords" => strip_tags(@$data['keyword']),

                            //og
                            "image" => $data['images']['xl'],
                            "type" => "website",
                        );
                        $metas = $data['metas'] ? $data['metas'] : null;
                    } else {
                        http_response_code(404);
                        $val = array(
                            "lang" => "my",
                            "site_name" => "HEIN SOE | A web developer",

                            "title" => "404 - ရွာပျောက်၊",
                            "url" => "https://www.heinsoe.com/portfolio/" . $paths[2],
                            "description" => "ဤစာမျက်နာတွင် အချက်အလက်မရှိပါ",
                            "keywords" => "heinsoe , hein soe , ဟိန်းစိုး",

                            //og
                            "image" => "https://api.heinsoe.com/v3/heinsoe_404.jpg",
                            "type" => "website",

                        );
                    }
                } else {
                    $val = array(
                        "lang" => "en-us",
                        "site_name" => "HEIN SOE | A web developer",

                        "title" => "Portfolio",
                        "url" => "https://www.heinsoe.com/portfolio",
                        "description" => "These are my creation",
                        "keywords" => "heinsoe , hein soe , ဟိန်းစိုး",

                        //og
                        "image" => "https://api.heinsoe.com/v3/heinsoe_portfolio.jpg",
                        "type" => "website",

                    );
                }
                myHeadTag(array_merge($default, $val), $metas);
                break;

            default:
                http_response_code(404);
                $val = array(
                    "lang" => "my",
                    "site_name" => "HEIN SOE | A web developer",

                    "title" => "404 - ရွာပျောက်",
                    "url" => "https://www.heinsoe.com/" . $paths[1],
                    "description" => "ဤစာမျက်နာတွင် အချက်အလက်မရှိပါ",
                    "keywords" => "heinsoe , hein soe , ဟိန်းစိုး",

                    //og
                    "image" => "https://api.heinsoe.com/v3/heinsoe_404.jpg",
                    "type" => "website",

                );
                myHeadTag(array_merge($default, $val));
                break;
        }
    }
}

function myCurl($url)
{
    $ch = curl_init($url);
    $headers = array('Content-Type: application/json');
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    //   curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    //    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec($ch);
    // $result = json_decode($rt, TRUE);
    return $result;
}

function myFetcher($endpoint, $query)
{
    $query = http_build_query($query);
    $opts = array(
        'http' => array(
            'method'  => 'GET',
            'ignore_errors' => true
        ),
        "ssl" => array(
            "verify_peer" => false,
            "verify_peer_name" => false,
        )
    );

    $context = stream_context_create($opts);
    $result = @file_get_contents("{$endpoint}&{$query}", false, $context);
    // var_dump($http_response_header);
    return json_decode($result, TRUE);
}



function myHeadTag($d, $metas = null)
{
?>
    <!DOCTYPE html>
    <html lang="<?= $d['lang']; ?>">

    <head>

        <title><?= $d['title']; ?></title>
        <meta charset="UTF-8">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
        <meta http-equiv="encoding" content="utf-8">
        <meta http-equiv="content-language" content="<?= $d['lang']; ?>" />

        <link rel="icon" href="/heinsoe.ico" />
        <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,user-scalable=no" />
        <link rel="apple-touch-icon" href="/logo192.png" />
        <link rel="manifest" href="/manifest.json" />


        <!-- robot -->
        <link type="text/plain" rel="author" href="humans.txt" />
        <meta name="robots" content="index , follow ">

        <!-- kiunk -->
        <link rel="canonical" href="<?= $d['url']; ?>" />

        <!-- meta data -->
        <meta name="description" content='<?= $d['description']; ?>' />
        <meta name="keywords" content="<?= $d['keywords']; ?>" />

        <!-- open graph -->
        <meta property="og:image" content="<?= $d['image']; ?>" />
        <meta property="og:image:type" content="image/jpg" />
        <meta property="og:image:width" content="400" />
        <meta property="og:image:height" content="300" />
        <meta property="og:description" content="<?= $d['description']; ?>" />
        <meta property="og:title" content="<?= $d['title']; ?>" />
        <meta property="og:url" content="<?= $d['url']; ?>" />
        <meta property="og:type" content="<?= $d['type']; ?>" />
        <meta property="og:site_name" content="<?= $d['site_name']; ?>" />

        <!-- twitter -->
        <meta name="twitter:title" content="<?= $d['title']; ?>" />
        <meta name="twitter:description" content="<?= $d['description']; ?>" />
        <meta name="twitter:url" content="<?= $d['url']; ?>" />
        <meta name="twitter:image" content="<?= $d['image']; ?>" />
        <meta name="twitter:card" content="summary_large_image" />

        <!-- vefifying & contact-->
        <meta name="facebook-domain-verification" content="<?= $d['facebook-domain-verification']; ?>" />
        <meta property="fb:app_id" content="<?= $d['fb_app_id']; ?>" />
        <!-- <meta property="fb:pages" content="<? //= $d['fb_pages']; 
                                                ?>" /> -->



        <?php 
        //တစ်ကယ်လို့ ဒေလာက်ထက် ပို အသေးစိတ်ချင်ကေ api က နေ meta key နဲ့ ထည့်ပေးလိုက်ကေ ဒေမှာပြ ပီးဖို့
        if ($metas !== null) {
            foreach ($metas as $m) {
        ?>
                <meta property="<?= $m['property']; ?>" content="<?= $m['content']; ?>" />
        <?php
            }
        } ?>






        <!-- <script async src="https://www.googletagmanager.com/gtag/js?id=<?//= $d['g_app_id']; ?>"></script>
        <script>
            function gtag() {
                dataLayer.push(arguments)
            }
            window.dataLayer = window.dataLayer || [],
                gtag("js", new Date),
                gtag("config", "<? //= $d['g_app_id']; 
                                ?>")
        </script> -->





        <script>
            window.fbAsyncInit = function() {
                FB.init({
                    appId: <?= $d['fb_app_id']; ?>,
                    autoLogAppEvents: true,
                    xfbml: true,
                    version: 'v13.0'
                });
            };
        </script>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>
    <?php
}
