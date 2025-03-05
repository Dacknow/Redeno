<html>
    <head>
        <!-- Basic Page Info -->
        <meta charset="utf-8">
        <title>@yield('pageTitle')</title>

        <!-- Site favicon -->
        <link rel="apple-touch-icon" sizes="180x180" href="/back/vendors/images/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/back/vendors/images/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/back/vendors/images/favicon-16x16.png">

        <!-- Mobile Specific Metas -->
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <!-- Google Font -->
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&amp;display=swap" rel="stylesheet">
        <!-- CSS -->
        <link rel="stylesheet" type="text/css" href="/back/vendors/styles/core.css">
        <link rel="stylesheet" type="text/css" href="/back/vendors/styles/icon-font.min.css">
        <link rel="stylesheet" type="text/css" href="/back/vendors/styles/style.css">
        @stack('stylesheets')
    </head>
    <body class="login-page">
        <ins class="adsbygoogle adsbygoogle-noablate" data-adsbygoogle-status="done" style="display: none !important;" data-ad-status="unfilled"><div id="aswift_0_host" style="border: none; height: 0px; width: 0px; margin: 0px; padding: 0px; position: relative; visibility: visible; background-color: transparent; display: inline-block;"><iframe id="aswift_0" name="aswift_0" browsingtopics="true" style="left:0;position:absolute;top:0;border:0;width:undefinedpx;height:undefinedpx;" sandbox="allow-forms allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts allow-top-navigation-by-user-activation" frameborder="0" marginwidth="0" marginheight="0" vspace="0" hspace="0" allowtransparency="true" scrolling="no" allow="attribution-reporting; run-ad-auction" src="https://googleads.g.doubleclick.net/pagead/ads?client=ca-pub-2973766580778258&amp;output=html&amp;adk=1812271804&amp;adf=3025194257&amp;abgtt=6&amp;lmt=1682491481&amp;plat=1%3A16777216%2C3%3A16%2C4%3A16%2C9%3A32776%2C16%3A8388608%2C17%3A32%2C24%3A32%2C25%3A32%2C30%3A1081344%2C32%3A32%2C41%3A32%2C42%3A32&amp;format=0x0&amp;url=file%3A%2F%2F%2FC%3A%2FUsers%2Flenovo%2FDownloads%2Fdeskapp-master%2Flogin.html&amp;pra=5&amp;wgl=1&amp;aihb=0&amp;asro=0&amp;ailel=1~2~4~7~8~9~10~11~12~13~14~15~16~17~18~19~20~21~24~29~30~34&amp;aiael=1~2~3~4~7~8~9~10~11~12~13~14~15~16~17~18~19~20~21~24~29~30~34&amp;aicel=33~38&amp;aifxl=29_18~30_19&amp;aiixl=29_5~30_6&amp;aiapm=0.15&amp;aiapmi=0.33938&amp;aiact=0.3&amp;aicct=0.6&amp;ailct=0.5&amp;aiescf=1&amp;uach=WyJXaW5kb3dzIiwiMTAuMC4wIiwieDg2IiwiIiwiMTMzLjAuMzA2NS45MiIsbnVsbCwwLG51bGwsIjY0IixbWyJOb3QoQTpCcmFuZCIsIjk5LjAuMC4wIl0sWyJNaWNyb3NvZnQgRWRnZSIsIjEzMy4wLjMwNjUuOTIiXSxbIkNocm9taXVtIiwiMTMzLjAuNjk0My4xNDIiXV0sMF0.&amp;dt=1741142758298&amp;bpp=33&amp;bdt=95&amp;idt=209&amp;shv=r20250303&amp;mjsv=m202503030101&amp;ptt=9&amp;saldr=aa&amp;abxe=1&amp;nras=1&amp;correlator=8561543112076&amp;frm=20&amp;pv=2&amp;u_tz=-300&amp;u_his=2&amp;u_h=768&amp;u_w=1366&amp;u_ah=728&amp;u_aw=1366&amp;u_cd=24&amp;u_sd=1&amp;dmc=4&amp;adx=-12245933&amp;ady=-12245933&amp;biw=1358&amp;bih=650&amp;scr_x=0&amp;scr_y=0&amp;eid=31090699%2C31090735%2C31090747%2C42532523%2C95352076%2C95354315%2C95354324%2C95354337%2C31090774%2C95353782&amp;oid=2&amp;pvsid=3503211272531075&amp;tmod=182022893&amp;wsm=1&amp;uas=0&amp;nvt=1&amp;fsapi=1&amp;fc=1920&amp;brdim=0%2C0%2C0%2C0%2C1366%2C0%2C1366%2C728%2C1358%2C650&amp;vis=1&amp;rsz=%7C%7Cs%7C&amp;abl=NS&amp;fu=32768&amp;bc=31&amp;bz=1.01&amp;td=1&amp;tdf=2&amp;psd=W251bGwsbnVsbCxudWxsLDNd&amp;nt=1&amp;ifi=1&amp;uci=a!1&amp;fsb=1&amp;dtd=272" data-google-container-id="a!1" tabindex="0" title="Advertisement" aria-label="Advertisement" data-load-complete="true"></iframe></div></ins><div class="login-header box-shadow">
            <div class="container-fluid d-flex justify-content-between align-items-center">
                <div class="brand-logo">
                    <a href="login.html">
                        <img src="/back/vendors/images/deskapp-logo.svg" alt="">
                    </a>
                </div>
            </div>
        </div>
        <div class="login-wrap d-flex align-items-center flex-wrap justify-content-center">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 col-lg-7">
                        <img src="/back/vendors/images/login-page-img.png" alt="">
                    </div>
                    <div class="col-md-6 col-lg-5">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        <!-- js -->
        <script src="/back/vendors/scripts/core.js"></script>
        <script src="/back/vendors/scripts/script.min.js"></script>
        <script src="/back/vendors/scripts/process.js"></script>
        <script src="/back/vendors/scripts/layout-settings.js"></script>
        @stack('scripts')
    </body>
</html>