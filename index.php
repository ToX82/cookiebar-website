<?php
header("Last-Modified: " . date("Y-m-d H:i:s", getlastmod()) . " GMT");
$params = $_SERVER['QUERY_STRING'];
$params = preg_replace('/[^a-z0-9\-\.\:\/%&=]/i', '', $params);
if ($params === '') {
    // Il parametro always è preimpostato di default
    $_GET['always'] = 1;
    $params = "always=1";
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>cookieBAR - A free and easy cookie law plugin</title>
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="cookieBAR is a free and easy solution to the EU cookie law. Paste one line of script tag and you're done. Even a kid could install it.">
    <meta name="keywords" content="cookie,localstorage,law,plugin,script,javascript,jquery,easy,solution">

    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/materialize-css@1/dist/css/materialize.min.css">

    <?php if ($_SERVER['SERVER_NAME'] == 'localhost') { ?>
        <link rel="stylesheet" href="style.css">
    <?php } else { ?>
        <link rel="stylesheet" href="style.min.css">
    <?php } ?>

    <script type="application/ld+json">
        [
            {
                "@context": "http://schema.org",
                "@type": "SoftwareApplication",
                "applicationCategory": "http://schema.org/OtherApplication",
                "name": "cookieBAR",
                "description": "a free &amp; easy solution to the EU cookie law.",
                "softwareVersion": "1.7.0",
                "downloadUrl": "https:\/\/cookie-bar.eu\/#installation",
                "dateModified": "<?= date("Y-m-d H:i:s", getlastmod()) ?>",
                "operatingSystem": "Web Browser",
                "url": "https://cookie-bar.eu",
                "offers": {
                    "@type": "Offer",
                    "price": "0.00",
                    "priceCurrency": "EUR",
                    "seller": {
                        "@type": "Organization",
                        "name": "cookie-bar.eu",
                        "url": "https://cookie-bar.eu"
                    }
                }
            }
        ]
    </script>


</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('set', 'anonymizeIp', true);
  ga('create', 'UA-96441912-1', 'auto');
  ga('send', 'pageview');
</script>

    <div class="main container z-depth-5">

        <div class="section">
            <div class="row header">
                <h1>
                    <a href='./'><img src="logo_big.png" alt="cookieBAR" width="247" height="64" /></a>
                </h1>
                <p>a free &amp; easy solution to the EU cookie law.</p>
            </div>
            <a id="why-use-cookiebar"></a>
            <h5>Why cookieBAR?</h5>
            <p>There is a lot of mystery and fuss surrounding the EU cookie legislation, but it's essentially really simple. Cookies are files used to track site activity and most websites use them. Site owners need to make the use of cookies very obvious to visitors.</p>
            <p>cookieBAR makes it simple and clear to visitors that cookies are in use and tells them how to adjust their browser settings if they are concerned.</p>

            <span class="badge left red white-text" style="margin: 0 10px 0 0;">New version!</span>
            cookieBAR v. 1.10 is out! While most of the functionality remains the same, there is a new cookiebarConsent event listener that allows advanced users to detect the user's choices and act accordingly.
            <br><br>

            <div class="row">
                <div class="col s12">
                    <div class="card-panel grey lighten-2">
                        <span class="grey-text text-darken-3">
                            <span class="badge blue white-text">TIP</span> If you want to give the user the possibility to block the cookies again, thus showing the cookiebar, you can add this link somewhere on your page.
                            <code><pre><span style='color:#905;'>&lt;a</span> <span style='color:#690'>href=</span><span style='color:#07a'>"#"</span> <span style='color:#690'>onclick=</span><span style='color:#07a'>"document.cookie='cookiebar=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/'; setupCookieBar(); return false;"</span><span style='color:#905'>&gt;</span>Click here to revoke the Cookie consent<span style='color:#905'>&lt;/a&gt;</span></pre></code>
                            Test: <a href="#" onclick="document.cookie='cookiebar=;expires=Thu, 01 Jan 1970 00:00:01 GMT;path=/'; setupCookieBar(); return false;">Click here to revoke the Cookie consent</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>


        <div class="section row">
            <br><div class="divider"></div><br>

            <div class="col s12">
                <ul class="tabs">
                    <li class="tab"><a href="#configuration">Configuration</a></li>
                    <li class="tab"><a href="#cookiebar">About</a></li>
                    <li class="tab"><a href="#news">News</a></li>
                    <li class="tab"><a href="#preventive-block">Preventive block</a></li>
                    <li class="tab"><a href="#logging">Logging</a></li>
                    <li class="tab"><a href="#legal-notes">Legal notes</a></li>
                    <li class="tab"><a href="#contributors">Contributors</a></li>
                </ul>

            </div>

            <br><br><br><div class="divider"></div><br>

            <!-- start #cookiebar -->
            <div id="cookiebar" class="col s12 m10 offset-m1">
                <div class="section">
                    <a id="how-it-works"></a>
                    <h5>How it works</h5>

                    <p>cookieBAR is drop-in and forget. Written in vanilla Javascript code, no jQuery or other dependencies are required. It shows up when needed and stays silent when not: If a website has some cookies or localStorage data set, then the bar is shown, otherwise nothing happens. This is configurable, anyway.</p>

                    <p>Once the user clicks 'Allow Cookies', cookieBAR will set a cookie for that domain with the name 'cookiebar' that will expire in 30 days. What this means is that the plugin will only show up once per domain (per month).</p>

                    <p>If a user decides to click "Disallow Cookies", cookieBAR will remove all the cookies and localStorage data (but it will show up again the first time a cookie is detected).</p>

                    <p>Please note that the cookieBAR itself (or similar solutions) can't deal with external services, secure or HTTP-only cookies. You will probably need to deal with them preventively. Please read more about the preventive block <a class="tabopener" href="https://cookie-bar.eu/#preventive-block">here</a>.</p>
                </div>

                <div class="divider"></div>

                <div class="section">
                    <a id="why-did-i-wrote-this"></a>
                    <h5>Why did I write this?</h5>
                    <p>Because I needed it. I got the idea from <a href="http://permissionbar.com/">Studio NEC's permissionbar</a>, which was beautiful, but I needed something more configurable, multilingual and not dependent upon jQuery or any other Javascript framework. So I forked the original project on GitHub and started to add what I needed, concluding with a pull-request whose code was completely rewritten. Sadly, the original project seems to have stopped, and nobody has probably even seen my modifications. Several months later, I decided to add even more things and to give this plugin a place to be, which is why it became cookieBAR.
                </div>

                <div class="divider"></div>

                <div class="section">
                    <a id="languages"></a>
                    <h5>How many languages are supported?</h5>
                    <p>Currently, the supported languages for cookieBAR are:</p>
                    <ul class="browser-default">
                        <li>Bulgarian</li>
                        <li>Brazilian portuguese</li>
                        <li>Catalan</li>
                        <li>Czech</li>
                        <li>Danish</li>
                        <li>Dutch</li>
                        <li>English</li>
                        <li>Estonian</li>
                        <li>Finnish</li>
                        <li>French</li>
                        <li>German</li>
                        <li>Greek</li>
                        <li>Hungarian</li>
                        <li>Italian</li>
                        <li>Norwegian</li>
                        <li>Occitan</li>
                        <li>Polish</li>
                        <li>Portuguese</li>
                        <li>Romanian</li>
                        <li>Russian</li>
                        <li>Slovak</li>
                        <li>Slovenian</li>
                        <li>Spanish</li>
                        <li>Swedish</li>
                        <li>Swedish</li>
                    </ul>
                    <p>The user's language is automatically detected by the browser, but you can force a specific language by passing an optional parameter (see <a class="tabopener" href="#configuration">Configuration</a>).</p>
                    <p>If you want to help me with the translations or add another language, please fork my <a href="https://github.com/ToX82/cookie-bar">Github</a> repository and make a pull request with your additions.</p>
                </div>

                <div class="divider"></div>

                <div class="section">
                    <a id="instructions"></a>
                    <h5>Installation</h5>

                    <p>You have at least three options if you decide to give cookieBAR a try:</p>
                    <ul class="browser-default">
                        <li>The easy-peasy (and probably better) one: grab the code in the "Configuration" page and use the hosted version</li>
                        <li>Or, you can self-host it by yourself:
                            <ol>
                                <li>Checkout the <a href="https://github.com/ToX82/cookie-bar">Github</a> repository and place it somewhere in a folder within your website or your server. All of the files, including images and stylesheets, need to maintain it's relative structure - that is be in the same directory - for the plugin to work correctly.</li>
                                <li>Grab the code you will find below and adjust the path.</li>
                            </ol>
                        </li>
                        <li>
                            If you use npm, you can even install the cookieBAR with a simple <code class="purple-text">npm -i cookie-bar</code>.
                        </li>
                    </ul>

                    <h6>If you need to add some configuration to it, please use the configurator below.</h6>
                </div>
            </div>
            <!-- end #cookiebar -->


            <!-- start #news -->
            <div id="news" class="col s12 m10 offset-m1">
                <div class="section">
                    <a id="aggiornamenti"></a>
                    <h5>News</h5>
                    <ul>
                        <li><strong>17.10.2022</strong> - 1.10.0: Added the cookiebarConsent event listener.</li>
                        <li><strong>02.08.2022</strong> - 1.9.4: Added Estonian translation.</li>
                        <li><strong>12.08.2021</strong> - 1.9.0: Added "customize cookies" options.</li>
                        <li><strong>12.08.2021</strong> - 1.8.4: Added Occitan translation.</li>
                        <li><strong>01.02.2021</strong> - 1.8.3: Added Turkish translation.</li>
                        <li><strong>17.12.2020</strong> - 1.8.2: Fixed broken safari link.</li>
                        <li><strong>25.11.2020</strong> - 1.8.1: Updated Finnish translation.</li>
                        <li><strong>19.11.2020</strong> - 1.8.0: Made the DENY confirmation alert optional.</li>
                        <li><strong>28.08.2020</strong> - 1.7.13: Updated Catalan translation.</li>
                        <li><strong>25.03.2020</strong> - 1.7.12: Added Croatian translation.</li>
                        <li><strong>03.03.2020</strong> - 1.7.11: Updated PL, Added Norway to cookieLawStates.</li>
                        <li><strong>08.02.2020</strong> - 1.7.10: Updated RU, DE translation.</li>
                        <li><strong>09.07.2019</strong> - 1.7.9: Added BR translation, updated Danish, Czech, Hungarian translations.</li>
                        <li><strong>14.03.2019</strong> - 1.7.6: Added Bulgarian translation.</li>
                        <li><strong>04.03.2019</strong> - 1.7.6: Updated Romanian translation.</li>
                        <li><strong>11.12.2018</strong> - 1.7.5: Added Norwegian and Finnish translations.</li>
                        <li><strong>02.09.2018</strong> - 1.7.1: Fixed typo in Romanian translation.</li>
                        <li><strong>06.08.2018</strong> - 1.7.0: New option: show the cookie policy link in the main bar.</li>
                        <li><strong>30.07.2018</strong> - 1.6.4: New ICO link for english language, missing closing 'p' tags.</li>
                        <li><strong>21.07.2018</strong> - 1.6.3: Added Greek translation.</li>
                        <li><strong>12.07.2018</strong> - 1.6.2: Auto opt-in for non EEA users</li>
                        <li><strong>12.07.2018</strong> - 1.6.1: Switched to freegeoip.app, new theme "momh"</li>
                        <li><strong>20.06.2018</strong> - 1.6.0: All of the images are now css sprites. CSS moved in a themes folder. Code cleanup</li>
                        <li><strong>16.06.2018</strong> - 1.5.36: Fixed bug in cookies detection</li>
                        <li><strong>16.06.2018</strong> - 1.5.35: Switched from freegeoip to ipdata.co</li>
                        <li><strong>16.06.2018</strong> - 1.5.34: Small corrections in ro.html</li>
                        <li><strong>10.04.2018</strong> - 1.5.33: Updated version numbers, updated README.md, updated package.json</li>
                        <li><strong>10.04.2018</strong> - 1.5.32: Small corrections in de.html</li>
                        <li><strong>30.03.2018</strong> - 1.5.31: Switched to freegeoip.net.</li>
                        <li><strong>19.02.2018</strong> - 1.5.30: Updated Dutch translation.</li>
                        <li><strong>13.01.2018</strong> - 1.5.29: Added Russian translation.</li>
                        <li><strong>11.09.2017</strong> - 1.5.28: Added package.json.</li>
                        <li><strong>14.08.2017</strong> - 1.5.27: Updated Polish translation.</li>
                        <li><strong>27.05.2017</strong> - 1.5.26: Bugfix in CSS - default theme.</li>
                        <li><strong>05.05.2017</strong> - 1.5.25: Fixed Slovenian translation.</li>
                        <li><strong>02.05.2017</strong> - 1.5.24: Added Polish translation.</li>
                        <li><strong>27.04.2017</strong> - 1.5.23: Added Slovenian translation.</li>
                        <li><strong>06.04.2017</strong> - 1.5.22: Modified GeoIP lookups, added "skip GeoIp" option, added "hide details" option, new "Flying" theme.</li>
                        <li><strong>28.03.2017</strong> - 1.5.21: Added Swedish translation.</li>
                        <li><strong>17.03.2017</strong> - 1.5.20: Fix loading of language files, fix invalid CSS in altblack css</li>
                        <li><strong>25.11.2016</strong> - 1.5.19: Update nl.html</li>
                        <li><strong>25.11.2016</strong> - 1.5.19: Update nl.html</li>
                        <li><strong>12.10.2016</strong> - 1.5.18: Fixed typo in en.html, updated fr.html, added Slovak translation, added Czech translation.</li>
                        <li><strong>02.10.2016</strong> - 1.5.17: Optionally refresh page on CookieAllowed.</li>
                        <li><strong>30.06.2016</strong> - 1.5.16: Add Croatia to EU list.</li>
                        <li><strong>19.05.2016</strong> - 1.5.15: Added Danish translation.</li>
                        <li><strong>14.04.2016</strong> - 1.5.14: Switched from freegeoip.net to freegeoip.io.</li>
                        <li><strong>05.04.2016</strong> - 1.5.13: Added Romanian translation.</li>
                        <li><strong>13.03.2016</strong> - 1.5.12: Added "scroll window to confirm" option.</li>
                        <li><strong>01.02.2016</strong> - 1.5.11: Minor enhancements.</li>
                        <li><strong>28.12.2015</strong> - 1.5.10: Added Portuguese translation.</li>
                        <li><strong>24.12.2015</strong> - 1.5.9: Added Catalan and Spanish translation.</li>
                        <li><strong>20.12.2015</strong> - 1.5.8: Added Dutch translation.</li>
                        <li><strong>10.12.2015</strong> - 1.5.7: Switched back to freegeoip.</li>
                        <li><strong>03.11.2015</strong> - 1.5.6: Improved French translation.</li>
                        <li><strong>19.09.2015</strong> - 1.5.5: Removed the 'http' prefix for telize api.</li>
                        <li><strong>10.09.2015</strong> - 1.5.4: Switched from freegeoip to telize.</li>
                        <li><strong>06.09.2015</strong> - 1.5.3: Added minified CSS and JS, set GB and not UK for the cookieLaw states, fixed a bug when hiding the bar (margins were not correctly reset).</li>
                        <li><strong>04.08.2015</strong> - 1.5.2: Added Hungarian and German, better English translation. Some other minor fixes.</li>
                        <li><strong>29.06.2015</strong> - 1.5.0: You can specify wether third party or tracking cookies are in use, the bar is shown only in the countries affected by this law.</li>
                        <li><strong>30.05.2015</strong> - 1.4.0: Show cookieBAR even when no cookies nor localStorage is detected (always show), added a "remember choice" duration config.</li>
                        <li><strong>27.05.2015</strong> - 1.3.0: Both bar and modal box are now themeable. If you want to use your own theme, make a pull request on GitHub.</li>
                        <li><strong>25.05.2015</strong> - 1.2.1: I have moved the cookieBAR plugin to jsDelivr, a shiny Content Delivery Network (CDN). It should be faster and more reliable. If you are still using the old <strong>//cookie-bar.eu</strong> path, you really should switch to the new path.</li>
                        <li><strong>20.05.2015</strong> - 1.2.0: Fixed a nasty CSS bug that made the bar's text strange or even invisible at all.</li>
                    </ul>
                </div>
            </div>
            <!-- end #news -->


            <!-- start #preventive-block -->
            <div id="preventive-block" class="col s12 m10 offset-m1">
                <div class="section">
                    <a id="important-reading"></a>
                    <h5>Customize cookies (1.9)</h5>
                    <p>
                    Starting from version 1.9, the user may want to choose whether to accept technical or third-party cookies. This choice creates a new state for the `cookiebar` cookie, which is "CookieCustomized".
                    In this case, in your backend, it will be necessary to make two new checks to verify the value of the cookies `cookiebar-tracking` and `cookiebar-third-barty` (whose value can be true or false), and to instantiate the services, in a similar way to the following examples.
                    </p>

                    <h5>Preventive blocking of external services</h5>
                    Please note that in some countries, the cookie law wants you to preventively block cookies before they are set, in an opt-in choice for the user.<br>
                    Doing so is a bit more technical than just having a banner like the cookieBAR, and there is not a unique solution for that. It depends on your website
                    and its technology.<br>
                    By using cookieBAR anyway, it is easy to detect if a user has accepted cookies by checking the presence of a cookie named "cookiebar".<br>
                    That cookie can have two values: "CookieAllowed" or "CookieDisallowed".<br>
                    These are some examples of this kind of check before loading a script:<br><br>

                    <h6>In JavaScript:</h6>
                    <pre class="z-depth-1"><span style='color:#808030; '>&lt;</span>script type<span style='color:#808030; '>=</span><span style='color:#800000; '>"</span><span style='color:#0000e6; '>text/javascript</span><span style='color:#800000; '>"</span><span style='color:#808030; '>></span>
    cookieValue <span style='color:#808030; '>=</span> document<span style='color:#808030; '>.</span>cookie<span style='color:#808030; '>.</span><span style='color:#800000; font-weight:bold; '>match</span><span style='color:#808030; '>(</span><span style='color:#800000; '>/</span><span style='color:#808030; '>(</span><span style='color:#0000e6; '>;</span><span style='color:#808030; '>)</span><span style='color:#808030; '>?</span><span style='color:#0000e6; '>cookiebar=</span><span style='color:#808030; '>(</span><span style='color:#808030; '>[</span><span style='color:#808030; '>^</span><span style='color:#0000e6; '>;</span><span style='color:#808030; '>]</span><span style='color:#808030; '>*</span><span style='color:#808030; '>)</span><span style='color:#0000e6; '>;</span><span style='color:#808030; '>?</span><span style='color:#800000; '>/</span><span style='color:#808030; '>)</span><span style='color:#808030; '>[</span><span style='color:#008c00; '>2</span><span style='color:#808030; '>]</span><span style='color:#800080; '>;</span>
    <span style='color:#800000; font-weight:bold; '>if</span> <span style='color:#808030; '>(</span>cookieValue <span style='color:#808030; '>==</span> <span style='color:#800000; '>'</span><span style='color:#0000e6; '>CookieAllowed</span><span style='color:#800000; '>'</span><span style='color:#808030; '>)</span> <span style='color:#800080; '>{</span>
        <span style='color:#696969; '>// The user has allowed cookies, let's load our external services</span>
    <span style='color:#800080; '>}</span>
<span style='color:#808030; '>&lt;</span><span style='color:#808030; '>/</span>script<span style='color:#808030; '>></span>
</pre>

                    <h6>or PHP</h6>
                    <pre class="z-depth-1"><span style='color:#5f5035;'>&lt;?php</span><span style='color:#000000;'></span>
<span style='color:#800000;font-weight:bold; '>if</span><span style='color:#000000;'> </span><span style='color:#808030;'>(</span><span style='color:#797997;'>$_COOKIE</span><span style='color:#808030;'>[</span><span style='color:#0000e6;'>'cookiebar'</span><span style='color:#808030;'>]</span><span style='color:#000000;'> </span><span style='color:#808030;'>=</span><span style='color:#808030;'>=</span><span style='color:#000000;'> </span><span style='color:#0000e6;'>"CookieAllowed"</span><span style='color:#808030;'>)</span><span style='color:#000000;'> </span><span style='color:#800080;'>{</span><span style='color:#000000;'></span>
<span style='color:#000000;'>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#696969;'>// The user has allowed cookies, let's load our external services</span><span style='color:#000000;'></span>
<span style='color:#800080;'>}</span><span style='color:#000000;'></span>
<span style='color:#5f5035;'>?></span>
</pre>

                    <h6>or Classic ASP VBScript</h6>
                    <pre class="z-depth-1"><span style='color:#5f5035; '>&lt;%</span><span style='color:#000000; '></span>
<span style='color:#800000; font-weight:bold; '>If</span><span style='color:#000000; '> Request</span><span style='color:#008c00; '>.</span><span style='color:#000000; '>Cookies</span><span style='color:#808030; '>(</span><span style='color:#808030; '>"</span><span style='color:#0000e6; '>cookiebar</span><span style='color:#808030; '>"</span><span style='color:#808030; '>)</span><span style='color:#000000; '> </span><span style='color:#808030; '>=</span><span style='color:#000000; '> </span><span style='color:#808030; '>"</span><span style='color:#0000e6; '>CookieAllowed</span><span style='color:#808030; '>"</span><span style='color:#000000; '> </span><span style='color:#800000; font-weight:bold; '>Then</span><span style='color:#000000; '></span>
<span style='color:#000000; '>&#xa0;&#xa0;&#xa0;&#xa0;</span><span style='color:#696969; '>' The user has allowed cookies, let's load our external services</span><span style='color:#000000; '></span>
<span style='color:#800000; font-weight:bold; '>End If</span><span style='color:#000000; '></span>
<span style='color:#5f5035; '>%></span>
</pre>

                    <h6>or Rails - Haml version</h6>
                    <pre class="z-depth-1"><span style='color:#808030; '>-</span> <span style='color:#800000; font-weight:bold; '>if</span> cookies<span style='color:#808030; '>[</span><span style='color:#800000; '>"</span><span style='color:#0000e6; '>accept_cookies_policy</span><span style='color:#800000; '>"</span><span style='color:#808030; '>]</span> <span style='color:#808030; '>==</span> <span style='color:#800000; '>'</span><span style='color:#0000e6; '>1</span><span style='color:#800000; '>'</span>
        <span style='color:#696969; '>//DO YOUR STUFF</span>
</pre>

                    <h6>or Rails - ERB version</h6>
                    <pre class="z-depth-1"><span style='color:#808030; '>&lt;</span><span style='color:#808030; '>%</span> <span style='color:#800000; font-weight:bold; '>if</span> cookies<span style='color:#808030; '>[</span><span style='color:#800000; '>"</span><span style='color:#0000e6; '>accept_cookies_policy</span><span style='color:#800000; '>"</span><span style='color:#808030; '>]</span> <span style='color:#808030; '>==</span> <span style='color:#800000; '>'</span><span style='color:#0000e6; '>1</span><span style='color:#800000; '>'</span> <span style='color:#808030; '>%</span><span style='color:#808030; '>></span>
    <span style='color:#808030; '>&lt;</span><span style='color:#808030; '>--</span><span style='color:#808030; '>!</span>DO YOUR STUFF <span style='color:#808030; '>--</span><span style='color:#808030; '>></span>
<span style='color:#808030; '>&lt;</span><span style='color:#808030; '>%</span> end <span style='color:#808030; '>%</span><span style='color:#808030; '>></span>
</pre>

                    <br><br>

                    If you have some snippets in other languages that could be useful to the users, please drop me a line.
                </div>
            </div>
            <!-- end #preventive-block -->


            <!-- start #logging -->
            <div id="logging" class="col s12 m10 offset-m1">
                <div class="section">
                    <a id="important-reading"></a>
                    <h5>Logging user choices</h5>
                    <p>
                    In some countries it is necessary to keep a record of the user's choices regarding cookies.<br>
                    CookieBAR is a frontend-only tool, and for now it doesn't provide this functionality, but it's easy to get the result of a user's choice and save the record in your own database.<br><br>

                    When a user sets a preference, a cookie is in fact recorded, called `cookiebar`, which can contain one of these values:<br>

                    <ul class='list'>
                    <li><span class='keyword'>CookieAllowed</span> (the user has chosen to accept all cookies),</li>
                    <li><span class='keyword'>CookieDisallowed</span> (the user has chosen to refuse all cookies),</li>
                    <li><span class='keyword'>CookieCustomized</span> (the user has chosen to accept only certain types of cookies).</li>
                    </ul>
                    <br>

                    In the event that the user has chosen to customize cookies, it will be possible to find one or two additional cookies:
                    <ul class='list'>
                    <li><span class='keyword'>cookiebar-tracking</span> (the user has accepted the tracking cookies),</li>
                    <li><span class='keyword'>cookiebar-third-party</span> (the user has accepted third-party cookies).</li>
                    </ul>
                    <br>
                    With this information you should be able to create your own function for saving user choices, without relying on external services.
                    </p>
                    
                </div>
            </div>
            <!-- end #logging -->

            <!-- start #legal-notes -->
            <div id="legal-notes" class="col s12 m10 offset-m1">
                <div class="section">
                    <a id="legal-reading"></a>
                    <h5>Legal Notes</h5>
                    <p>Please note that using cookieBAR (or any similar tool) might not be sufficient to fully accomplish
                        your country's cookie law. Please read the following links to find out more.</p>

                    <ul class="browser-default">
                        <li>
                            Belgio: Commission de la protection de la vie priv&eacute;e (&nbsp;<a rel="noreferrer" href="http://www.privacycommission.be/sites/privacycommission/files/documents/Projet_de_recommandation_cookies.pdf" target="_blank">French</a>&nbsp;
                            |&nbsp;<a rel="noreferrer" href="http://www.privacycommission.be/sites/privacycommission/files/documents/Ontwerp_aanbeveling_cookies.pdf" target="_blank">Dutch</a>&nbsp;)
                        </li>
                        <li>Czech Republic:&nbsp;<a rel="noreferrer" href="http://www.uoou.cz/vismo/zobraz_dok.asp?id_org=200144&amp;id_ktg=1853&amp;n=cookies-prechod-z-principu-opt-out-na-opt-in&amp;query=cookie" target="_blank">&Uacute;řad pro ochranu osobn&iacute;ch &uacute;dajů</a></li>
                        <li>France:&nbsp;<a rel="noreferrer" href="http://www.cnil.fr/vos-obligations/sites-web-cookies-et-autres-traceurs/" target="_blank">Commission Nationale de l&#39;Informatique et des Libert&eacute;s</a></li>
                        <li>Germany:&nbsp;<a rel="noreferrer" href="http://www.bfdi.bund.de/DE/Home/home_node.html" target="_blank">Bundesbeauftragten für den Datenschutz und die Informationsfreiheit</a></li>
                        <li>Italy:&nbsp;<a rel="noreferrer" href="http://www.garanteprivacy.it/web/guest/home/docweb/-/docweb-display/docweb/3118884" target="_blank">Garante per la protezione dei dati personali</a></li>
                        <li>Luxembourg:&nbsp;<a rel="noreferrer" href="http://www.cnpd.public.lu/fr/actualites/international/2012/06/G29-avis-cookies/index.html?highlight=cookies" target="_blank">Commission nationale pour la protection des donn&eacute;es</a></li>
                        <li>Netherlands:&nbsp;<a rel="noreferrer" href="https://www.acm.nl/nl/publicaties/publicatie/12768/Veelgestelde-vragen-over-de-cookiebepaling/" target="_blank">Autoriteit Consument en Markt</a></li>
                        <li>Norway:&nbsp; <a rel="noreferrer" href="https://www.datatilsynet.no/Teknologi/Internett/cookies/" target="_blank">Datatilsynet</a></li>
                        <li>Spain:&nbsp;<a rel="noreferrer" href="http://www.agpd.es/portalwebAGPD/canaldocumentacion/publicaciones/common/Guias/Guia_Cookies.pdf" target="_blank">Agencia de Protecci&oacute;n de Datos</a></li>
                        <li>UK:&nbsp;<a rel="noreferrer" href="http://ico.org.uk/for_organisations/privacy_and_electronic_communications/the_guide/cookies" target="_blank">Information Commissioner&#39;s Office</a></li>
                    </ul>
                </div>
            </div>
            <!-- end #legal-notes -->

            <!-- start #configuration -->
            <div id="configuration" class="col s12 m10 offset-m1">
                <div class="section">
                    <h5>Configurator</h5>

                    <div class="row">
                    <form class="col s12">
                            <div class="row">
                                <div class="col s12 m6">
                                    <label for='forceLang'>Use language autodetection or force a specific language</label>
                                    <select class='configurator' id='forceLang'>
                                        <option <?= (@$_GET['forceLang'] == "") ? "selected" : "" ?> value=''>Autodetect</option>
                                        <option <?= (@$_GET['forceLang'] == "br") ? "selected" : "" ?> value='br'>Brazilian portuguese</option>
                                        <option <?= (@$_GET['forceLang'] == "bg") ? "selected" : "" ?> value='bg'>Bulgarian</option>
                                        <option <?= (@$_GET['forceLang'] == "ca") ? "selected" : "" ?> value='ca'>Catalan</option>
                                        <option <?= (@$_GET['forceLang'] == "hr") ? "selected" : "" ?> value='hr'>Croatian</option>
                                        <option <?= (@$_GET['forceLang'] == "cs") ? "selected" : "" ?> value='cs'>Czech</option>
                                        <option <?= (@$_GET['forceLang'] == "da") ? "selected" : "" ?> value='da'>Danish</option>
                                        <option <?= (@$_GET['forceLang'] == "nl") ? "selected" : "" ?> value='nl'>Dutch</option>
                                        <option <?= (@$_GET['forceLang'] == "en") ? "selected" : "" ?> value='en'>English</option>
                                        <option <?= (@$_GET['forceLang'] == "et") ? "selected" : "" ?> value='et'>Estonian</option>
                                        <option <?= (@$_GET['forceLang'] == "fr") ? "selected" : "" ?> value='fr'>French</option>
                                        <option <?= (@$_GET['forceLang'] == "fi") ? "selected" : "" ?> value='fi'>Finnish</option>
                                        <option <?= (@$_GET['forceLang'] == "de") ? "selected" : "" ?> value='de'>German</option>
                                        <option <?= (@$_GET['forceLang'] == "el") ? "selected" : "" ?> value='el'>Greek</option>
                                        <option <?= (@$_GET['forceLang'] == "hu") ? "selected" : "" ?> value='hu'>Hungarian</option>
                                        <option <?= (@$_GET['forceLang'] == "it") ? "selected" : "" ?> value='it'>Italian</option>
                                        <option <?= (@$_GET['forceLang'] == "no") ? "selected" : "" ?> value='no'>Norwegian</option>
                                        <option <?= (@$_GET['forceLang'] == "es") ? "selected" : "" ?> value='es'>Spanish</option>
                                        <option <?= (@$_GET['forceLang'] == "se") ? "selected" : "" ?> value='se'>Swedish</option>
                                        <option <?= (@$_GET['forceLang'] == "oc") ? "selected" : "" ?> value='oc'>Occitan</option>
                                        <option <?= (@$_GET['forceLang'] == "pl") ? "selected" : "" ?> value='pl'>Polish</option>
                                        <option <?= (@$_GET['forceLang'] == "pt") ? "selected" : "" ?> value='pt'>Portuguese</option>
                                        <option <?= (@$_GET['forceLang'] == "ro") ? "selected" : "" ?> value='ro'>Romanian</option>
                                        <option <?= (@$_GET['forceLang'] == "ru") ? "selected" : "" ?> value='ru'>Russian</option>
                                        <option <?= (@$_GET['forceLang'] == "sk") ? "selected" : "" ?> value='sk'>Slovak</option>
                                        <option <?= (@$_GET['forceLang'] == "sl") ? "selected" : "" ?> value='sl'>Slovenian</option>
                                        <option <?= (@$_GET['forceLang'] == "sw") ? "selected" : "" ?> value='sw'>Swedish</option>
                                        <option <?= (@$_GET['forceLang'] == "tr") ? "selected" : "" ?> value='tr'>Turkish</option>
                                    </select>
                                </div>
                                <div class="col s12 m6">
                                    <label for='theme'>Choose a theme</label>
                                    <select class='configurator' id='theme'>
                                        <option <?= (@$_GET['theme'] == "") ? "selected" : "" ?> value=''>Default (black)</option>
                                        <option <?= (@$_GET['theme'] == "altblack") ? "selected" : "" ?> value='altblack'>Alternative black</option>
                                        <option <?= (@$_GET['theme'] == "momh") ? "selected" : "" ?> value='momh'>Momh</option>
                                        <option <?= (@$_GET['theme'] == "flying") ? "selected" : "" ?> value='flying'>FlyingBAR</option>
                                        <option <?= (@$_GET['theme'] == "grey") ? "selected" : "" ?> value='grey'>Plain grey</option>
                                        <option <?= (@$_GET['theme'] == "white") ? "selected" : "" ?> value='white'>Thick white</option>
                                        <option <?= (@$_GET['theme'] == "minimal") ? "selected" : "" ?> value='minimal'>Minimal white</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='customize'>
                                        <input type='checkbox' class='configurator validate' id='customize' value='1' <?= (@$_GET['customize']) ? "checked" : "" ?>>
                                        <span>Let the users customize their cookie preferences (technical, third party, tracking)</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='tracking'>
                                        <input type='checkbox' class='configurator validate' id='tracking' value='1' <?= (@$_GET['tracking']) ? "checked" : "" ?>>
                                        <span>The website uses tracking cookies</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='thirdparty'>
                                        <input type='checkbox' class='configurator validate' id='thirdparty' value='1' <?= (@$_GET['thirdparty']) ? "checked" : "" ?>>
                                        <span>The website uses third party cookies</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='always'>
                                        <input type='checkbox' class='configurator validate' id='always' value='1' <?= (@$_GET['always']) ? "checked" : "" ?>>
                                        <span>Always show cookieBAR (show cookieBAR even if no cookies are detected)</span><span class="badge orange white-text tooltipped" data-tooltip="The cookieBAR has the possibility to stay silent if there are no javascript readable cookies or localstorage.<br>This could be an issue if you have non HTTP or SECURE cookies, which are not detectable by Javascript.<br><br>If unsure, keep this checkbox checked :)">READ ME</span></span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='noGeoIp'>
                                        <input type='checkbox' class='configurator validate' id='noGeoIp' value='1' <?= (@$_GET['noGeoIp']) ? "checked" : "" ?>>
                                        <span>No GeoIP lookup (show cookieBAR regardless of the user's location)</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='scrolling'>
                                        <input type='checkbox' class='configurator validate' id='scrolling' value='1' <?= (@$_GET['scrolling']) ? "checked" : "" ?>>
                                        <span>Accept cookies by scrolling window</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='refreshPage'>
                                        <input type='checkbox' class='configurator validate' id='refreshPage' value='1' <?= (@$_GET['refreshPage']) ? "checked" : "" ?>>
                                        <span>Refresh page on CookieAllowed</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='top'>
                                        <input type='checkbox' class='configurator validate' id='top' value='1' <?= (@$_GET['top']) ? "checked" : "" ?>>
                                        <span>Show cookieBAR on top</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='showNoConsent'>
                                        <input type='checkbox' class='configurator validate' id='showNoConsent' value='1' <?= (@$_GET['showNoConsent']) ? "checked" : "" ?>>
                                        <span>Show DENY button</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='noConfirm'>
                                        <input type='checkbox' class='configurator validate' id='noConfirm' value='1' <?= (@$_GET['noConfirm']) ? "checked" : "" ?>>
                                        <span>Don't show the confirmation dialog when a user clicks on the DENY button</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='hideDetailsBtn'>
                                        <input type='checkbox' class='configurator validate' id='hideDetailsBtn' value='1' <?= (@$_GET['hideDetailsBtn']) ? "checked" : "" ?>>
                                        <span>Hide the "Details" button from the main bar</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='showPolicyLink'>
                                        <input type='checkbox' class='configurator validate' id='showPolicyLink' value='1' <?= (@$_GET['showPolicyLink']) ? "checked" : "" ?>>
                                        <span>Show the policy page link in the main bar <small>(you must specify the URL of your custom Privacy Page)</small>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for='blocking'>
                                        <input type='checkbox' class='configurator validate' id='blocking' value='1' <?= (@$_GET['blocking']) ? "checked" : "" ?>>
                                        <span>Blocking (forces a user to select whether to accept or decline cookies)</span>
                                    </label>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12 m5">
                                    <input type='text' class='configurator validate' id='remember' value='<?= @$_GET['remember']; ?>'>
                                    <label for='remember'>Remember choice for X days (default 30)</label>
                                </div>

                                <div class="input-field col s12 m7">
                                    <input type='text' class='configurator validate' id='privacyPage' value='<?= @$_GET['privacyPage'] ?>'>
                                    <label for='privacyPage'>URL of your custom Privacy Page</label>
                                </div>
                            </div>
                        </form>
                    </div>

                    <p class="blue-grey-text text-darken-3">When you are satisfied with the look and feel of the cookieBAR, just paste the following script tag into your website. That's it!</p>
                    <pre class="z-depth-1"><code class="language-markup configuratorTag"><span style='color:#905;'>&lt;script</span> <span style='color:#690'>type=</span>&quot;text/javascript&quot; <span style='color:#690'>src=</span>&quot;https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?<?=$params?>&quot;<span style='color:#905;'>&gt;&lt;/script&gt;</span></code></pre>

                    <br><a class='configuratorDemo blue darken-3 waves-effect waves-light btn' href='https://cdn.jsdelivr.net/npm/cookie-bar/'><i class="mdi-content-send left"></i>Update demo</a>

                    <p>Please note: If you select an option with the "NEW" tag, and you see it's not working on your website, please wait for a few
                        days before reporting it: the changes may still be propagating through the CDN and should be visible in a maximum of 10 days.</p>


                    <hr>
                    <h3><span class="badge red white-text">NEW v.1.10.0</span>Custom events</h3>
                    <p>
                        Advanced users might want to track the user's choice about the cookie consent. Did the user accept, decline, or customize the cookie consent?
                        <br>
                        There is a way to "intercept" the user's choice. All you have to do is to start with this code and write your own logic:
                        <code><pre>
document.addEventListener('cookiebarConsent', (e) => {
    console.log(e.detail.consent);
});</pre></code>
                        The code above will asynchronously subscribe to the <code>cookiebarConsent</code> event, logging the user's choice in the console.
                        <br>
                        The <code>cookiebarConsent</code> event will contain one of the following values:
                        <ul>
                            <li><code style="font-style: italic;">CookieAllowed</code>: The user agreed to accept cookies;</li>
                            <li><code style="font-style: italic;">CookieDisallowed</code>: The user refused cookies;</li>
                            <li><code style="font-style: italic;">CookieCustomized</code>: The user customized the cookie consent.</li>
                        </ul>
                    </p>

                    <div class='hidden configuratorBaseUrlOpen'><span style='color:#905;'>&lt;script</span> <span style='color:#690'>type=</span>&quot;text/javascript&quot; <span style='color:#690'>src=</span>&quot;</div>
                    <div class='hidden configuratorBaseUrl'>https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js</div>
                    <div class='hidden configuratorBaseUrlClose'>&quot;<span style='color:#905;'>&gt;&lt;/script&gt;</span></div>
                </div>
            </div>
            <!-- end #installation -->

            <!-- start #contributors -->
            <div id="contributors" class="col s12 m10 offset-m1">
                <div class="section">
                    <a id="github"></a>
                    <h5>Code contributors</h5>
                    <p>Code reviews, new functionalities, themes, languages... everything that can be useful for the users is very welcome. Plus, your name will be shown in the GitHub list :-)</p>
                    <p>ToX82, pinhead84, michael-simons, utilsites, frantique, hrvoj3e, emanuelcanuto, bricebou, LucaRainone, xterr, timoleon, pridumkuvatyj, ominty, jacmaes, dskarasev, dan-szabo, catalin-tudor, burzka, buildcomplete, andreidumi, MartinKolarik, MarcCeleiro, MZOG, LukasDrgon, Hexodus, Fredrik82, D9ping, Commander238, AlexxIV, Adsidera...</p>

                    <a href='https://github.com/ToX82/cookie-bar/graphs/contributors' target="_blank" rel="nofollow">See the full GitHub's list</a>
                </div>

                <div class="divider"></div>

                <div class="section">
                    <a id="special-thanks-to-the-donors"></a>
                    <h5>Special thanks to the donors</h5>
                    <ul>
                        <li>Marco Frabetti, Marc Sellier, Bastian Scheefe, Martin J Powell, Gilles Nguyen, Ulrich Wende,
                        Luca Gilardoni, Simen Ness, Monika Mosch, CompuSense Communication, John Stevens,
                        Agriturismo Villa Podernovo Siena, Gottfried Weber, Jussi Ruuskanen, Alex Roberts,
                        Adam Wojtanek, Software Studio ing. Di Marco, Miroslav Svoboda, Adrian Döring, Dieter Walckiers</li>
                    </ul>
                </div>
            </div>
            <!-- end #contributors -->
        </div>

        <div class="divider"></div>

        <div class="section">
            <a id="disclaimer"></a>
            <h5>Disclaimer</h5>
            <p>This program is free software. It comes without any warranty, to the extent permitted by applicable law. Use it at your own risk and double check your local laws before using it.</p>
        </div>
    </div>


    <footer class="page-footer blue-grey darken-3">
        <div class="container">
            <div class="row">
                <div class="col l6 s12">
                    <h5 class="white-text">cookieBAR</h5>
                    <div class="grey-text text-lighten-4">
                        I hope that you will try and enjoy cookieBAR as much as I did writing it. If so, please drop me a line at <a class="blue-text text-lighten-3" href="http://emanuele.itoscano.com/nodes/view/63_contacts">my website</a>. If cookieBAR has been really useful to you, please consider making a small donation as a token of your appreciation and to help me keep this up :)

                        <br>
                        <ul class="collapsible popout grey-text text-darken-3" data-collapsible="accordion">
                            <li>
                                <div class="collapsible-header">Donate with PayPal</div>
                                <div class="collapsible-body grey lighten-3 center-align">
                                    Please click the button to donate with PayPal
                                    <form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
                                    <input type="hidden" name="cmd" value="_s-xclick">
                                    <input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
                                    ">
                                    <input alt='thanks!' class='tooltipped' data-position='top' data-tooltip='Thank you for your support. I really, really appreciate that.' type="image" src="paypal.png" name="submit">
                                    <img alt="" src="paypal_pixel.gif" width="1" height="1">
                                    </form>
                                </div>
                            </li>

                            <li>
                                <div class="collapsible-header">Donate with Bitcoin</div>
                                <div class="collapsible-body grey lighten-3 center-align">
                                    Please donate Bitcoins to:
                                    <br><br>
                                    <strong class='tooltipped' data-position='top' data-tooltip='Thank you for your support. I really, really appreciate that.'>168uVh3cg4j5ZDi6E8Y7t9zG9uQeH4JtPR</strong>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col l4 offset-l2 s12">
                    <h5 class="white-text">Links</h5>
                    <ul>
                        <li><a class="grey-text text-lighten-3" href="https://github.com/ToX82/cookie-bar">GitHub repository</a></li>
                        <li><a class="grey-text text-lighten-3" href="https://www.linkedin.com/in/emanueletoscano/en">My Linkedin page</a></li>
                        <li><a class="grey-text text-lighten-3" href="http://emanuele.itoscano.com">Random stuff on my website</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright blue-grey darken-4">
            <div class="container">
                © <?= date("Y")?> Emanuele "ToX" Toscano
                - <a class="grey-text text-lighten-3" href='privacy/'>Privacy policy</a>

                <span class="right">P.IVA 03218180044</span>
            </div>
        </div>
    </footer>



<?php if (@$_COOKIE['cookiebar'] == "CookieAllowed") { ?>
    <script async type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5571f1ac18f4dec2"></script>
    <script async type="text/javascript">var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/56dd3faefd8c93706673ec32/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<?php } else { ?>
    <div class='accept_to_chat'>Need support? Please accept cookies and refresh the page :-)</div>
<?php } ?>

<script src="https://cdn.jsdelivr.net/npm/jquery@3/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/materialize-css@1/dist/js/materialize.min.js"></script>

<?php if ($_SERVER['SERVER_NAME'] == 'localhost') { ?>
    <script src="script.js"></script>
    <script src="../cookiebar/cookiebar-latest.js?<?=$params?>"></script>
<?php } else { ?>
    <script src="script.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/cookie-bar/cookiebar-latest.min.js?<?=$params?>"></script>
<?php } ?>
</body>
</html>
