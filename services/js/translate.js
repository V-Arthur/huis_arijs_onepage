/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

(function () {
    var d = window, e = document, f = "text/javascript", g = "text/css", h = "stylesheet", k = "script", l = "link", m = "head", n = "complete", p = "UTF-8", q = ".";
    function r(b) {
        var a = e.getElementsByTagName(m)[0];

        a || (a = e.body.parentNode.appendChild(e.createElement(m)));
        a.appendChild(b)
    }
    function _loadJs(b) {
        var a = e.createElement(k);
        a.type = f;
        a.charset = p;
        a.src = b;
        r(a)
    }
    function _loadCss(b) {
        var a = e.createElement(l);
        a.type = g;
        a.rel = h;
        a.charset = p;
        a.href = b;

        r(a)
    }
    function _isNS(b) {
        b = b.split(q);

        for (var a = d, c = 0; c < b.length; ++c)
            if (!(a = a[b[c]]))
                return!1;
        return!0
    }
    function _setupNS(b) {
        b = b.split(q);
        for (var a = d, c = 0; c < b.length; ++c)
            a = a[b[c]] || (a[b[c]] = {});
        return a
    }
    d.addEventListener && "undefined" == typeof e.readyState && d.addEventListener("DOMContentLoaded", function () {
        e.readyState = n
    }, !1);
    if (_isNS('google.translate.Element')) {
        return
    }
    (function () {
        var c = _setupNS('google.translate._const');
        c._cl = 'en';
        c._cuc = 'googleTranslateElementInit';
        c._cac = '';
        c._cam = '';
        var h = 'translate.googleapis.com';
        var s = (true ? 'https' : window.location.protocol == 'https:' ? 'https' : 'http') + '://';
        var b = s + h;
        c._pah = h;
        c._pas = s;
        c._pbi = b + '/translate_static/img/te_bk.gif';
        c._pci = b + '/translate_static/img/te_ctrl3.gif';
        c._pli = b + '/translate_static/img/loading.gif';
        c._plla = h + '/translate_a/l';
        c._pmi = b + '/translate_static/img/mini_google.png';
        c._ps = b + '/translate_static/css/translateelement.css';
        c._puh = 'translate.google.com';
        _loadCss(c._ps);

       //alert(s);
    })();
})();

/*************************************************************/
(function () {
    var c = document, d = "length", e = " uitschakelen", f = " via Google Translate?", k = ".", l = "Alles vertalen naar het ", m = "Deze pagina vertalen in het ", n = "Deze pagina weergeven in het: ",
    p = "Google heeft deze pagina automatisch vertaald in het: ", q = "Mogelijk gemaakt door ", r = "Uitschakelen voor: ",
    t = "Vertaald in: ", u = "Vertaling uit het ", v = "var ", w = this;
    function x(a, y) {
        var g = a.split(k), b = w;
        g[0]in b || !b.execScript || b.execScript(v + g[0]);
        for (var h; g[d] && (h = g.shift()); )
            g[d] || void 0 === y ? b[h] ? b = b[h] : b = b[h] = {} : b[h] = y
    }
    ;
    var z = {0: "Vertalen", 1: "Annuleren", 2: "Sluiten", 3: function (a) {
            return p + a
        }, 4: function (a) {
            return t + a
        }, 5: "Fout: de server kan uw verzoek niet verwerken. Probeer het later opnieuw.", 6: "Meer informatie", 7: function (a) {
            return q + a
        },
        8: "Translate",
        9: "Vertaling wordt verwerkt",
        10: function (a) {
            return m + (a + f)
        }, 11: function (a) {
            return n + a
        }, 12: "Origineel weergeven", 13: "De inhoud van dit lokale bestand wordt via een beveiligde verbinding ter vertaling naar Google verzonden.", 14: "De inhoud van deze beveiligde pagina wordt via een beveiligde verbinding voor vertaling naar Google verzonden.",
        15: "De inhoud van deze intranetpagina wordt via een beveiligde verbinding ter vertaling naar Google verzonden.",
        16: "Select languege",
        17: function (a) {
            return u + (a + e)
        },
        18: function (a) {
            //alert(a);
            return r + a
        }, 19: "Altijd verbergen", 20: "Originele tekst:", 21: "Een betere vertaling bijdragen", 22: "Bijdragen", 23: "Alles vertalen", 24: "Alles herstellen", 25: "Alles annuleren", 26: "Delen vertalen naar mijn taal", 27: function (a) {
            return l + a
        }, 28: "Originele talen weergeven", 29: "Opties", 30: "Vertaling voor deze site uitschakelen", 31: null,
        32: "Alternatieve vertalingen weergeven", 33: "Klik op de bovenstaande woorden voor alternatieve vertalingen", 34: "Gebruiken", 35: "Sleep met de Shift-toets ingedrukt om de woordvolgorde te veranderen", 36: "Klik voor alternatieve vertalingen", 37: "Houd de Shift-toets ingedrukt en sleep de bovenstaande woorden om ze in de gewenste volgorde te zetten.", 38: "Bedankt dat u een suggestie voor de vertaling heeft verzonden naar Google Translate.", 39: "Vertalingen beheren voor deze site", 40: "Klik op een woord voor alternatieve vertalingen of dubbelklik op een woord om het rechtstreeks te bewerken",
        41: "Oorspronkelijke tekst", 42: "Translate", 43: "Vertalen", 44: "Uw correctie is verzonden.", 45: "Fout: de taal van de webpagina wordt niet ondersteund."};
    var A = window.google && google.translate && google.translate._const;


    if (A) {
        var B;
        e:{
            for (var C = [], D = ["25,0.01,20150123"], E = 0; E < D[d]; ++E) {
                var F = D[E].split(","), G = F[0];
                if (G) {
                    var H = Number(F[1]);
                    if (!(!H || .1 < H || 0 > H)) {
                        var I = Number(F[2]), J = new Date, K = 1E4 * J.getFullYear() + 100 * (J.getMonth() + 1) + J.getDate();
                        !I || I < K || C.push({version: G, a: H, b: I})
                    }
                }
            }
            for (var L = 0, M = window.location.href.match(/google\.translate\.element\.random=([\d\.]+)/), N = Number(M && M[1]) || Math.random(), E = 0; E < C[d]; ++E) {
                var O = C[E], L = L + O.a;

                if (1 <= L)
                    break;
                if (N < L) {
                    B = O.version;
                    break e
                }
            }
            B = "26"
        }

        var P = "../services/js/element_main.js";

        if ("0" == B) {

            var Q = "../services/js/element_main.js";
            Q[Q[d] - 1] = "main_nl.js";
            P = Q.join("/").replace("%s", B)
        }
        if (A._cjlc)
            A._cjlc(A._pas + A._pah + P);
        else {
            var R = A._pas + A._pah + P, S = c.createElement("script");
            S.type = "text/javascript";
            S.charset = "UTF-8";
            S.src = "../services/js/element_main.js";//R;
            var T = c.getElementsByTagName("head")[0];
            T || (T = c.body.parentNode.appendChild(c.createElement("head")));
            T.appendChild(S)
        }
        x("google.translate.m", z);
        x("google.translate.v", B)
    }
    ;


})()
/**
 * goog-te-menu2-item
goog-te-menu-value
 */