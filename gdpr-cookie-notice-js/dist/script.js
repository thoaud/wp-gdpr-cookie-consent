!function(e){var o=!1;if("function"==typeof define&&define.amd&&(define(e),o=!0),"object"==typeof exports&&(module.exports=e(),o=!0),!o){var t=window.Cookies,n=window.Cookies=e();n.noConflict=function(){return window.Cookies=t,n}}}(function(){function k(){for(var e=0,o={};e<arguments.length;e++){var t=arguments[e];for(var n in t)o[n]=t[n]}return o}return function e(p){function f(e,o,t){var n;if("undefined"!=typeof document){if(1<arguments.length){if("number"==typeof(t=k({path:"/"},f.defaults,t)).expires){var i=new Date;i.setMilliseconds(i.getMilliseconds()+864e5*t.expires),t.expires=i}t.expires=t.expires?t.expires.toUTCString():"";try{n=JSON.stringify(o),/^[\{\[]/.test(n)&&(o=n)}catch(e){}o=p.write?p.write(o,e):encodeURIComponent(String(o)).replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),e=(e=(e=encodeURIComponent(String(e))).replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent)).replace(/[\(\)]/g,escape);var c="";for(var a in t)t[a]&&(c+="; "+a,!0!==t[a]&&(c+="="+t[a]));return document.cookie=e+"="+o+c}e||(n={});for(var r=document.cookie?document.cookie.split("; "):[],s=/(%[0-9A-Z]{2})+/g,d=0;d<r.length;d++){var l=r[d].split("="),m=l.slice(1).join("=");this.json||'"'!==m.charAt(0)||(m=m.slice(1,-1));try{var u=l[0].replace(s,decodeURIComponent);if(m=p.read?p.read(m,u):p(m,u)||m.replace(s,decodeURIComponent),this.json)try{m=JSON.parse(m)}catch(e){}if(e===u){n=m;break}e||(n[u]=m)}catch(e){}}return n}}return(f.set=f).get=function(e){return f.call(f,e)},f.getJSON=function(){return f.apply({json:!0},[].slice.call(arguments))},f.defaults={},f.remove=function(e,o){f(e,"",k(o,{expires:-1}))},f.withConverter=e,f}(function(){})}),window["gdpr-cookie-notice-templates"]={},window["gdpr-cookie-notice-templates"]["bar.html"]='<div class="gdpr-cookie-notice">\n  <p class="gdpr-cookie-notice-description">{description}</p>\n  <nav class="gdpr-cookie-notice-nav">\n    <a href="#" class="gdpr-cookie-notice-nav-item gdpr-cookie-notice-nav-item-settings">{settings}</a>\n    <a href="#" class="gdpr-cookie-notice-nav-item gdpr-cookie-notice-nav-item-accept gdpr-cookie-notice-nav-item-btn">{accept}</a>\n  </div>\n</div>\n',window["gdpr-cookie-notice-templates"]["category.html"]='<li class="gdpr-cookie-notice-modal-cookie">\n  <div class="gdpr-cookie-notice-modal-cookie-row">\n    <h3 class="gdpr-cookie-notice-modal-cookie-title">{title}</h3>\n    <input type="checkbox" name="gdpr-cookie-notice-{prefix}" checked="checked" id="gdpr-cookie-notice-{prefix}" class="gdpr-cookie-notice-modal-cookie-input">\n    <label class="gdpr-cookie-notice-modal-cookie-input-switch" for="gdpr-cookie-notice-{prefix}"></label>\n  </div>\n  <p class="gdpr-cookie-notice-modal-cookie-info">{desc}</p>\n</li>\n',window["gdpr-cookie-notice-templates"]["modal.html"]='<div class="gdpr-cookie-notice-modal">\n  <div class="gdpr-cookie-notice-modal-content">\n    <div class="gdpr-cookie-notice-modal-header">\n      <h2 class="gdpr-cookie-notice-modal-title">{settings}</h2>\n      <button type="button" class="gdpr-cookie-notice-modal-close"></button>\n    </div>\n    <ul class="gdpr-cookie-notice-modal-cookies"></ul>\n    <div class="gdpr-cookie-notice-modal-footer">\n      <a href="#" class="gdpr-cookie-notice-modal-footer-item gdpr-cookie-notice-modal-footer-item-statement">{statement}</a>\n      <a href="#" class="gdpr-cookie-notice-modal-footer-item gdpr-cookie-notice-modal-footer-item-save gdpr-cookie-notice-modal-footer-item-btn"><span>{save}</span></a>\n    </div>\n  </div>\n</div>\n';var gdprCookieNoticeLocales={};function gdprCookieNotice(c){var n="gdprcookienotice",a="gdpr-cookie-notice",i=(window[a+"-templates"],Cookies.noConflict()),e=!1,o=!1,r=!1,s=["performance","analytics","marketing"];c.locale||(c.locale="en"),c.timeout||(c.timeout=500),c.domain||(c.domain=null),c.expiration||(c.expiration=30);var t,d,l=i.getJSON(n),m=new CustomEvent("gdprCookiesEnabled",{detail:l});function u(e){for(var o=0;o<s.length;o++)if(c[s[o]]&&!e[s[o]])for(var t=0;t<c[s[o]].length;t++)i.remove(c[s[o]][t]),!0;document.documentElement.classList.remove(a+"-loaded")}function p(e){var o={date:new Date,necessary:!0,performance:!0,analytics:!0,marketing:!0};if(e)for(var t=0;t<s.length;t++)o[s[t]]=document.getElementById(a+"-cookie_"+s[t]).checked;i.set(n,o,{expires:c.expiration,domain:c.domain}),u(o),m=new CustomEvent("gdprCookiesEnabled",{detail:o}),document.dispatchEvent(m)}function f(){if(e)return!1;!function(){var e=document.querySelectorAll("."+a+"-modal-close")[0],o=document.querySelectorAll("."+a+"-modal-footer-item-statement")[0],t=document.querySelectorAll("."+a+"-modal-cookie-title"),n=document.querySelectorAll("."+a+"-modal-footer-item-save")[0];e.addEventListener("click",function(){return document.documentElement.classList.remove(a+"-show-modal"),!1}),o.addEventListener("click",function(e){e.preventDefault(),window.location.href=c.statement});for(var i=0;i<t.length;i++)t[i].addEventListener("click",function(){return this.parentNode.parentNode.classList.toggle("open"),!1});n.addEventListener("click",function(e){console.log("savebutton click"),e.preventDefault(),n.classList.add("saved"),setTimeout(function(){n.classList.remove("saved")},1e3),p(!0)})}(),l&&(document.getElementById(a+"-cookie_performance").checked=l.performance,document.getElementById(a+"-cookie_analytics").checked=l.analytics,document.getElementById(a+"-cookie_marketing").checked=l.marketing),e=!0}function k(){f(),document.documentElement.classList.add(a+"-show-modal")}l?(u(l),document.dispatchEvent(m)):(o||(t=document.querySelectorAll("."+a+"-nav-item-settings")[0],d=document.querySelectorAll("."+a+"-nav-item-accept")[0],t.addEventListener("click",function(e){e.preventDefault(),k()}),d.addEventListener("click",function(e){e.preventDefault(),p()}),o=!0),setTimeout(function(){document.documentElement.classList.add(a+"-loaded")},c.timeout),c.implicit&&(console.log("accept scroll"),window.addEventListener("scroll",function e(){var o,t,n,i,c;o=window.innerHeight||(document.documentElement||document.body).clientHeight,c=document,t=Math.max(c.body.scrollHeight,c.documentElement.scrollHeight,c.body.offsetHeight,c.documentElement.offsetHeight,c.body.clientHeight,c.documentElement.clientHeight),n=window.pageYOffset||(document.documentElement||document.body.parentNode||document.body).scrollTop,i=t-o,25<Math.floor(n/i*100)&&!r&&(r=!0)&&(p(),window.removeEventListener("click",e))})));var g=document.querySelectorAll("."+a+"-settings-button");if(g)for(var v=0;v<g.length;v++)g[v].addEventListener("click",function(e){e.preventDefault(),k()})}gdprCookieNoticeLocales.en={description:"We use cookies to offer you a better browsing experience, personalise content and ads, to provide social media features and to analyse our traffic. Read about how we use cookies and how you can control them by clicking Cookie Settings. You consent to our cookies if you continue to use this website.",settings:"Cookie settings",accept:"Accept cookies",statement:"Our cookie statement",save:"Save settings",always_on:"Always on",cookie_essential_title:"Essential website cookies",cookie_essential_desc:"Necessary cookies help make a website usable by enabling basic functions like page navigation and access to secure areas of the website. The website cannot function properly without these cookies.",cookie_performance_title:"Performance cookies",cookie_performance_desc:"These cookies are used to enhance the performance and functionality of our websites but are non-essential to their use. For example it stores your preferred language or the region that you are in.",cookie_analytics_title:"Analytics cookies",cookie_analytics_desc:"We use analytics cookies to help us measure how users interact with website content, which helps us customize our websites and application for you in order to enhance your experience.",cookie_marketing_title:"Marketing cookies",cookie_marketing_desc:"These cookies are used to make advertising messages more relevant to you and your interests. The intention is to display ads that are relevant and engaging for the individual user and thereby more valuable for publishers and third party advertisers."};
//# sourceMappingURL=script.js.map
