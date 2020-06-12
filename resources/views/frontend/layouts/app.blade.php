<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns#" lang="en">

<meta http-equiv="content-type" content="text/html;charset=UTF-8" />

<head>
    <meta name="referrer" content="always">
    <meta charset="utf-8">
    <meta name="Author" content="SeaRates LLC">
    <meta property="og:site_name" content="SeaRates">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link rel="shortcut icon" href="design/images/favicon/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="design/images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="design/images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="design/images/favicon/favicon-16x16.png') }}">
    <link rel="mask-icon" href="design/images/favicon/safari-pinned-tab.svg') }}" color="#5bbad5">
    <meta name="application-name" content="SeaRates.com" />
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <meta property="og:image" content="design/images/apple-touch-icon-ipad-retina-152x152.png') }}">
    <meta property="og:type" content="website">

    <meta name="description"
        content="&amp;#9875;International digital freight broker with the most powerful network of independent freight agents all over the World. Digital provider of logistics services for transport companies. Calculation of distances and cost of transportation of goods">
    <meta name="keywords"
        content="international freight exchange,sea fright rates,online container tracking,container shipping,sea freight rates,international freight shipping company">
    
    <title> {{ isset($page_title) ? $page_title : 'LogistiQuote' }} </title>

    @include('frontend.includes.top-includes')
    @include('frontend.includes.top-scripts')

</head>

<body> 
    <noscript>
        <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5MQKQ58" height="0" width="0" style="display:none;visibility:hidden">
        </iframe>
    </noscript>

    @include('frontend.snippets.header')

    @yield('content')

    @include('frontend.snippets.footer')

    @include('frontend.includes.bottom-scripts')

</body>

</html>
