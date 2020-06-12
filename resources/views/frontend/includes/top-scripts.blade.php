<!-- Index scripts -->

    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src = '../www.googletagmanager.com/gtm5445.html?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5MQKQ58');
    </script>
    <script type="text/javascript">
        var G_LANG = '';
        var platform = 1;

        function select_lang(lang) {
            var serverUrl = "index.html";
            var requestUri = "index.html";
            var lang_cur = "en";
            if (lang_cur != lang) {
                if (lang != 'en') document.location = serverUrl + '/' + lang + requestUri;
                else document.location = serverUrl + requestUri;
            }
        }
    </script>

<!-- ! Index scripts -->