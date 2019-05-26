// ==UserScript==
// @name         Bot ulepszony
// @version      1.0
// @description  ---
// @author       ---
// @match        http://*/
// @grant        none
// ==/UserScript==
window.bot = new function() {
    function b(K, L) {
        return Math.abs(K.x - L.x) + Math.abs(K.y - L.y)
    }
 
    function d(K, L) {
        return new s(map.col, map.x, map.y, {
            x: hero.x,
            y: hero.y
        }, {
            x: K,
            y: L
        }, g.npccol).anotherFindPath()
    }
 
    function e(K, L) {
        let M = d(K, L);
        Array.isArray(M) && (window.road = M)
    }
 
    function f(K) {
        let L = g.npc[K];
        if (L.grp)
            for (let M in g.npc) g.npc[M].grp != L.grp || I.includes(g.npc[M].id) || I.push(g.npc[M].id);
        else I.includes(K) || I.push(K)
    }
 
    function k() {
        for (let K in g.npc) {
            let L = g.npc[K];
            if ((2 == L.type || 3 == L.type) && 19 > L.wt && o(L.id) && hero.lvl + 30 >= L.lvl && 2 > Math.abs(hero.x - L.x) && 2 > Math.abs(hero.y - L.y) && q()) return _g(`fight&a=attack&ff=1&id=-${L.id}`)
        }
    }
 
    /*function l(K) {
        let L = 'https://discordapp.com/api/webhooks/559236477930700803/J0Ta8bSYSdbfADWGOGoer1lfPuisvKWUdTgJ49qOsLlEsq_90MfKHB29iKVBgyCll32l';
        $.ajax({
            url: L,
            type: "POST",
            data: JSON.stringify({
                content: K,
                username: hero.nick,
                avatar_url: `http://margonem.pl/obrazki/itemy/upg/upg01.gif`
            }),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            async: !1
        })
    }*/
 
    function m() {
        let K = new Date,
            L = K.getHours(),
            M = K.getSeconds(),
            N = K.getMinutes();
        return 10 > L && (L = `0${L}`), 10 > N && (N = `0${N}`), 10 > M && (M = `0${M}`), `${L}:${N}:${M}`
    }
 
    function o(K) {
        return g.npc[K].grp && (!p(g.npc[K].grp) || r[localStorage.getItem(`bot_expowiska`)].ignore_grp && r[localStorage.getItem(`bot_expowiska`)].ignore_grp.includes(g.npc[K].grp)) ? !1 : !0
    }
 
    function p(K) {
        for (let L in g.npc)
            if (g.npc[L].grp == K && 19 < g.npc[L].wt) return !1;
        return !0
    }
 
    function q() {
        return !!(70 < 100 * (hero.hp / hero.maxhp))
    }
    mAlert = function() {}, "undefined" == typeof g && -1 < document.location.href.indexOf("margonem.pl") && document.location.reload();
    let r = {
        "Pizzeria(wszystkie levele)": {
            map: "Podziemia - p.1, Podziemia - p.2, Odnoga kana\u0142u, Podziemia - p.1, Podziemia - p.3, Podziemia - p.1, Odnoga kana\u0142u, Podziemia - p.2"
        },
        "złodek": {
            map: "Tuzmer, Dom Losso Minewita, Pokój Grety, Dom Losso Minewita, Dom Losso Minewita p.1, Dom Losso Minewita, Tuzmer, Dom Seridiusza, Dom Seridiusza - piwnica, Dom Seridiusza, Dom Seridiusza p.1, Dom Seridiusza, Tuzmer, Dom Aurusa, Dom Aurusa p.1, Dom Aurusa, Tuzmer, Dom Horsfei, Tuzmer, Dom Telsara, Dom Telsara p.1, Dom Telsara, Tuzmer, Dom Mei Shang Lii, Dom Mei Shang Lii - piwnica, Dom Mei Shang Lii, Dom Mei Shang Lii p.1, Dom Mei Shang Lii, Tuzmer, Tawerna pod Beczką Śledzi, Tawerna pod Beczką Śledzi p.1, Tawerna pod Beczką Śledzi - mieszkanie, Tawerna pod Beczką Śledzi p.1, Tawerna pod Beczką Śledzi, Tuzmer, Dom Erkora, Dom Erkora - piwnica, Dom Erkora, Tuzmer, Dom Senekjusza, Tuzmer, Kamienica Wernaidy, Tuzmer, Zajazd pod Różą Wiatrów, Zajazd pod Różą Wiatrów p.1, Zajazd pod Różą Wiatrów p.2, Zajazd pod Różą Wiatrów p.1, Zajazd pod Różą Wiatrów, Tuzmer, Port Tuzmer, Gildia kupiecka, Gildia kupiecka - piwnica, Gildia kupiecka, Port Tuzmer, Dom Samiry, Dom Samiry - piwnica, Dom Samiry, Dom Samiry p.1, Dom Samiry, Port Tuzmer, Dom Sinis p.1, Dom Sinis, Dom Sinis p.1, Port Tuzmer, Wioska Rybacka, Chata Króla Rybaka, Chata Króla Rybaka - piwnica, Chata Króla Rybaka, Wioska Rybacka, Dom Rongo, Wioska Rybacka, Pusty dom, Wioska Rybacka, Port Tuzmer, Chata Ficjusza, Port Tuzmer, Chata Ficjusza, Port Tuzmer, Dom Parmina, Port Tuzmer, Dom Alfreda, Dom Alfreda - piwnica, Dom Alfreda, Dom Alfreda p.1, Dom Alfreda, Port Tuzmer, Latarniane Wybrzeże, Dom stajennego, Dom stajennego p.1, Dom stajennego, Latarniane Wybrzeże, Stajnia, Stodoła, Magazyn, Stodoła, Latarniane Wybrzeże, Port Tuzmer"
        },
        "Szczury w Ithan": {
            map: "Archiwa, Zaplecze, Sk\u0142ady, Przej\u015Bcie p\xF3\u0142nocno-wschodnie, Wschodnie skrzyd\u0142o mur\xF3w, Przej\u015Bcie po\u0142udniowo-wschodnie, Wschodnie skrzyd\u0142o mur\xF3w, Przej\u015Bcie p\xF3\u0142nocno-wschodnie, Sk\u0142ady, Zaplecze"
        },
        Nekropolia: {
            map: "Grobowiec Rodziny Tywelta p.1, Grobowiec Rodziny Tywelta p.2"
        },
        Demony: {
            map: "Podziemia Siedziby Maga p.3 - sala 1, Podziemia Siedziby Maga p.3 - sala 2"
        },
        "Gacki szare": {
            map: "Siedlisko Nietoperzy p.5, Siedlisko Nietoperzy p.4, Siedlisko Nietoperzy p.3, Siedlisko Nietoperzy p.2, Siedlisko Nietoperzy p.1, Siedlisko Nietoperzy p.2, Siedlisko Nietoperzy p.3, Siedlisko Nietoperzy p.4"
        },
        "mrówki ithan": {
            map: "Kopiec Mr\xF3wek, Kopiec Mr\xF3wek p.1, Kopiec Mr\xF3wek p.2, Kopiec Mr\xF3wek p.1"
        },
        "zbiry": {
            map: "Pag\xF3rki Łupie\u017Cc\xF3w, Skład Grabie\u017Cc\xF3w, Pag\xF3rki Łupie\u017Cców, Schowek na Łupy, Pag\xF3rki Łupie\u017Cc\xF3w, Kamienna Kryj\xF3wka"
        },
        Ghule: {
            map: "Polana \u015Acierwojad\xF3w, Wioska Ghuli"
        },
         orki: {
            map: "Świszcząca Grota p.3, Świszcząca Grota p.2, Świszcząca Grota p.1, Zburzona Twierdza, Opuszczony Bastion, Podziemne Przejście p.1, Podziemne Przejście p.2, Podziemne Przejście p.3, Podziemne Przejście p.2, Podziemne Przejście p.1, Opuszczony Bastion, Zburzona Twierdza"
        },
        "Wilcze plemi\u0119": {
            map: "Warcz\u0105ce Osuwiska, Wilcza Nora p.1, Wilcza Nora p.2, Wilcza Nora p.1",
            mobs_id: [71698]
        },
        "pająki": {
            map: "Rachminowa Jaskinia p.5, Rachminowa Jaskinia p.6 - rozlewisko, Rachminowa Jaskinia p.7 - bezdenna g\u0142\u0119bia, Rachminowa Jaskinia p.6 - rozlewisko"
        },
        Koboldy: {
            map: "Lazurytowa Grota p.1, Lazurytowa Grota p.2, Lazurytowa Grota p.3, Lazurytowa Grota p.2"
        },
        "Galaretki(te za pszcz\xF3\u0142kami)": {
            map: "Prastara Kopalnia Eroch p.4 - sala 1, Prastara Kopalnia Eroch p.5"
        },
        "Szlak Thorpa": {
            map: "Szlak Thorpa p.1, Szlak Thorpa p.2, Szlak Thorpa p.3, Szlak Thorpa p.4, Szlak Thorpa p.5, Szlak Thorpa p.6, Szlak Thorpa p.5, Szlak Thorpa p.4, Szlak Thorpa p.3, Szlak Thorpa p.2"
        },
        "Bia\u0142e mr\xF3wki": {
            map: "Szumi\u0105ca G\u0119stwina, Grota Bia\u0142ych Ko\u015Bci p.1 - sala 2, Grota Bia\u0142ych Ko\u015Bci p.2 - sala 2, Grota Bia\u0142ych Ko\u015Bci p.3 - sala 2, Grota Bia\u0142ych Ko\u015Bci p.4, Grota Bia\u0142ych Ko\u015Bci p.3 - sala 1, Grota Bia\u0142ych Ko\u015Bci p.4, Grota Bia\u0142ych Ko\u015Bci p.3 - sala 2, Grota Bia\u0142ych Ko\u015Bci p.2 - sala 2, Grota Bia\u0142ych Ko\u015Bci p.1 - sala 2"
        },
        "Demilisze-low": {
            map: "Rachminowa Jaskinia p.3, Rachminowa Jaskinia p.4, Rachminowa Jaskinia p.4 - przepa\u015Bcie, W\u0105ski chodnik p.4, Chodniki Erebeth p.4 - sala 1, Chodniki Erebeth p.4 - sala 2, Chodniki Erebeth p.4 - sala 1, W\u0105ski chodnik p.4, Rachminowa Jaskinia p.4 - przepa\u015Bcie, Rachminowa Jaskinia p.4"
        },
        "Demilisze-high": {
            map: "Rachminowa Jaskinia p.4 - przepa\u015Bcie, W\u0105ski chodnik p.4, Chodniki Erebeth p.4 - sala 1, Chodniki Erebeth p.4 - sala 2, Kopalnia Thudul-ultok p.4 - sala 2, Kopalnia Thudul-ultok p.4 - sala 1, Kopalnia Thudul-ultok p.4 - sala 2, Chodniki Erebeth p.4 - sala 1, W\u0105ski chodnik p.4"
        },
        Minosy: {
            map: "Labirynt Wykl\u0119tych p.2 - sala 1, Labirynt Wykl\u0119tych p.1, Labirynt Wykl\u0119tych p.2 - sala 2, Labirynt Wykl\u0119tych p.1"
        },
        "Erem p\xF3\u0142noc-po\u0142udnie": {
            map: "Erem Czarnego S\u0142o\u0144ca - sala wej\u015Bciowa, Erem Czarnego S\u0142o\u0144ca p.1 s.1, Erem Czarnego S\u0142o\u0144ca - sala wej\u015Bciowa, Erem Czarnego S\u0142o\u0144ca p.2 s.1, Erem Czarnego S\u0142o\u0144ca p.2 s.2, Erem Czarnego S\u0142o\u0144ca - sala wej\u015Bciowa, Erem Czarnego S\u0142o\u0144ca p.1 s.2, Erem Czarnego S\u0142o\u0144ca - sala wej\u015Bciowa, Ska\u0142y Mro\u017Anych \u015Apiew\xF3w, Erem Czarnego S\u0142o\u0144ca - po\u0142udnie, Erem Czarnego S\u0142o\u0144ca - lochy, Erem Czarnego S\u0142o\u0144ca - p\xF3\u0142noc, Ska\u0142y Mro\u017Anych \u015Apiew\xF3w",
            mobs_id: [34826]
        },
        "alghule i szkielety": {
            map: "Piaskowa G\u0119stwina, Dolina Pustynnych Kr\u0119g\xF3w, Sucha Dolina, Płaskowy\u017C Arpan, Skalne Cmentarzysko p.1, Skalne Cmentarzysko p.2, Skalne Cmentarzysko p.3, Skalne Cmentarzysko p.2, Skalne Cmentarzysko p.1, Płaskowy\u017C Arpan, Sucha Dolina, Dolina Pustynnych Kr\u0119g\xF3w"
        },
        Grexy: {
            map: "Grota Samotnych Dusz p.1, Grota Samotnych Dusz p.2, Grota Samotnych Dusz p.3, Grota Samotnych Dusz p.4, Grota Samotnych Dusz p.5, Grota Samotnych Dusz p.4, Grota Samotnych Dusz p.3, Grota Samotnych Dusz p.2"
        },
        "impy": {
            map: "Ochnowa Pieczara p.4 - sala 2, Podziemne Rozpadliny p.3, Podziemne Rozpadliny p.4, Podziemne Rozpadliny p.5,  Kopalnia Giriel-uzbad p.6, Kopalnia Giriel-uzbad p.5, Kopalnia Giriel-uzbad p.6, Podziemne Rozpadliny p.5, Podziemne Rozpadliny p.4, Grań Romtyn p.5, Chodnik Mrinding p.6, Grań Romtyn p.5"
        },
        "Mi\u015Bki-low": {
            map: "Firnowa Grota p.1, Firnowa Grota p.2, Firnowa Grota p.2 s.1, Firnowa Grota p.2, Ska\u0142y Mro\u017Anych \u015Apiew\xF3w, Lodowa Wyrwa p.2, Lodowa Wyrwa p.1 s.1, Ska\u0142y Mro\u017Anych \u015Apiew\xF3w",
            mobs_id: [34843, 34826]
        },
        "Mi\u015Bki-high": {
            map: "Firnowa Grota p.1, Firnowa Grota p.2, Firnowa Grota p.2 s.1, Firnowa Grota p.2, Ska\u0142y Mro\u017Anych \u015Apiew\xF3w, Lodowa Wyrwa p.2, Lodowa Wyrwa p.1 s.1, Lodowa Wyrwa p.1 s.2, Sala Lodowych Iglic, Lodowa Wyrwa p.1 s.2, Lodowa Wyrwa p.1 s.1, Ska\u0142y Mro\u017Anych \u015Apiew\xF3w",
            mobs_id: [34843, 34826]
        },
        "Piraci - dwie jaskinie": {
            map: "Korsarska Nora - sala 1, Korsarska Nora - sala 2, Korsarska Nora - sala 3, Korsarska Nora - sala 4, Korsarska Nora p.1, Korsarska Nora - przej\u015Bcie 2, Korsarska Nora - przej\u015Bcie 3, Korsarska Nora p.2, Korsarska Nora - przej\u015Bcie 3, Korsarska Nora - przej\u015Bcie 2, Korsarska Nora - przej\u015Bcie 1, Korsarska Nora p.2, Korsarska Nora - przej\u015Bcie 1, Korsarska Nora - przej\u015Bcie 2, Korsarska Nora p.2, Korsarska Nora - przej\u015Bcie 2, Korsarska Nora p.1, Korsarska Nora - sala 4, Korsarska Nora - sala 3, Korsarska Nora - sala 2, Korsarska Nora - sala 1, Latarniane Wybrze\u017Ce, Ukryta Grota Morskich Diab\u0142\xF3w, Ukryta Grota Morskich Diab\u0142\xF3w - arsena\u0142, Ukryta Grota Morskich Diab\u0142\xF3w, Ukryta Grota Morskich Diab\u0142\xF3w - siedziba, Ukryta Grota Morskich Diab\u0142\xF3w, Ukryta Grota Morskich Diab\u0142\xF3w - magazyn, Ukryta Grota Morskich Diab\u0142\xF3w, Ukryta Grota Morskich Diab\u0142\xF3w - skarbiec, Ukryta Grota Morskich Diab\u0142\xF3w, Latarniane Wybrze\u017Ce"
        },
        Mumie: {
            map: "Oaza Siedmiu Wichr\xF3w, Ciche Rumowiska, Oaza Siedmiu Wichr\xF3w, Ruiny Pustynnych Burz"
        },
        "górale": {
            map: "Wyj\u0105cy W\u0105w\xF3z, Wyj\u0105ca Jaskinia, Wyj\u0105cy W\u0105w\xF3z, Nied\u017Cwiedzie Urwisko, Wyj\u0105cy W\u0105w\xF3z, Babi Wzg\xF3rek, G\xF3ralska Pieczara p.1, G\xF3ralska Pieczara p.2, G\xF3ralska Pieczara p.3, Babi Wzg\xF3rek"
        },
        "Magradit-low": {
            map: "Magradit, Magradit - G\xF3ra Ognia, Wulkan Politraki p.4, Wulkan Politraki p.3 - sala 1, Wulkan Politraki p.3 - sala 2, Wulkan Politraki p.3 - sala 1, Wulkan Politraki p.4, Magradit - G\xF3ra Ognia"
        },
        "Magradit-high": {
            map: "Magradit, Magradit - G\xF3ra Ognia, Wulkan Politraki p.4, Wulkan Politraki p.3 - sala 1, Wulkan Politraki p.3 - sala 2, Wulkan Politraki p.2, Wulkan Politraki p.1, Wulkan Politraki p.2, Wulkan Politraki p.3 - sala 2, Wulkan Politraki p.3 - sala 1, Wulkan Politraki p.4, Magradit - G\xF3ra Ognia"
        },
        "Molochy": {
            map: "Grota Heretyk\xF3w p.1, Grota Heretyk\xF3w p.2, Grota Heretyk\xF3w p.3, Grota Heretyk\xF3w p.4, Grota Heretyk\xF3w p.5, Grota Heretyk\xF3w p.4, Grota Heretyk\xF3w p.3, Grota Heretyk\xF3w p.2"
        },
        "czerwone orki": {
            map: "Złudny Trakt, Orcza Wyżyna, Osada Czerwonych Orków, Siedziba Rady Orków, Sala Dowódcy Orków, Siedziba Rady Orków, Osada Czerwonych Orków, Orcza Wyżyna"
        },
        "Ku\u017Ania Woundriela": {
            map: "Ku\u017Ania Worundriela p.7 - sala 3, Ku\u017Ania Worundriela p.7 - sala 4"
        },
         "dojście na berki": {
            map: "Fort Eder, Mokradła, Dolina Rozbójników, Wioska Ghuli, Zaginiona Dolina"
        },
        Berserkerzy: {
            map: "Grobowiec Przodk\xF3w, Cenotaf Berserker\xF3w p.1, Grobowiec Przodk\xF3w, Czarcie Oparzeliska, Pustelnia Wojownika p.2, Pustelnia Wojownika p.1, Czarcie Oparzeliska, Szuwarowe Trz\u0119sawisko, Opuszczona Twierdza, Szuwarowe Trz\u0119sawisko, Czarcie Oparzeliska, Pustelnia Wojownika p.1, Pustelnia Wojownika p.2, Czarcie Oparzeliska, Grobowiec Przodk\xF3w, Cenotaf Berserker\xF3w p.1"
        },
        Gobliny: {
            map: "Złudny Trakt, Orcza Wyżyna, Przedsionek Złych Goblinów, Goblińskie Lokum, Przedsionek Złych Goblinów, Lokum Złych Goblinów"
        },
         wiedźmy: {
            map: "Upiorna Droga, Wiedźmie Kotłowisko, Sabatowe Góry, Tristam, Dom czarnej magii, Tristam, Dom Amry, Tristam, Dom nawiedzonej wiedźmy, Tristam, Doms starej czarownicy, Tristam, Splugawiona kaplica, Tristam, Ograbiona świątynia, Tristam, Magazyn mioteł, Tristam, Dom Adariel, Tristam, Splądrowana kaplica, Tristam, Opuszczone więzienie, Lochy Tristam, Laboratorium Adariel, Lochy Tristam, Opuszczone więzienie, Tristam, Sabatowe Góry, Wiedźmie Kotłowisko"
        },
        Kazamaty: {
            map: "Nawiedzone Kazamaty p.1, Nawiedzone Kazamaty p.2, Nawiedzone Kazamaty p.3, Nawiedzone Kazamaty p.4, Nawiedzone Kazamaty p.5, Nawiedzone Kazamaty p.6, Nawiedzone Kazamaty p.5, Nawiedzone Kazamaty p.4, Nawiedzone Kazamaty p.3, Nawiedzone Kazamaty p.2"
        },
        "Duchy - dla leszczy": {
            map: "Ruiny Tass Zhil, Przedsionek Grobowca, Ruiny Tass Zhil, B\u0142ota Sham Al",
            ignore_grp: [18]
        },
        "Duchy": {
            map: "Błota Sham Al, Ruiny Tass Zhil, Przedsionek Grobowca, Tajemne Przejście, Przeklęty Grobowiec, Ruiny Tass Zhil",
        },
        "furbole": {
            map: "Zapomniany Las, Rozległa Równina, Wzgórza Obłędu, Rozległa Równina, Dolina Gniewu, Terytorium Furii, Zapadlisko Zniewolonych, Terytorium Furii, Dolina Gniewu, Rozległa Równina",
            ignore_grp: [3]
        },
        Patrycjusze: {
            map: "Krypty Bezsennych p.1, Krypty Bezsennych p.2, Krypty Bezsennych p.2 - przej\u015Bcie - sala 1, Krypty Bezsennych p.2 - przej\u015Bcie - sala 2, Krypty Bezsennych p.2, Krypty Bezsennych p.3, Krypty Bezsennych p.2, Krypty Bezsennych p.2 - przej\u015Bcie - sala 2, Krypty Bezsennych p.2 - przej\u015Bcie - sala 1, Krypty Bezsennych p.2"
        },
        Sekta: {
            map: "Przedsionek Kultu, Tajemnicza Siedziba, Mroczne Komnaty, Przera\u017Caj\u0105ce Sypialnie, Mroczne Komnaty, Tajemnicza Siedziba, Sala Tysi\u0105ca \u015Awiec, Tajemnicza Siedziba, Lochy Kultu, Sale Rozdzierania, Lochy Kultu, Tajemnicza Siedziba"
        },
        Pająki: {
            map: "Dolina Paj\u0119czych Korytarzy, Arachnitopia p.1, Arachnitopia p.2, Arachnitopia p.3, Arachnitopia p.4, Arachnitopia p.5, Arachnitopia p.4, Arachnitopia p.3, Arachnitopia p.2, Arachnitopia p.1"
        },
        "Zakorzeniony Lud": {
            map: "Urwisko Zdrewniałych, Wąwóz Zakorzenionych Dusz, Krzaczasta Grota p.1 - sala 1, Krzaczasta Grota p.1 - sala 2, Krzaczasta Grota p.1 - sala 3, Krzaczasta Grota p.2 - sala 3, Krzaczasta Grota p.2 - sala 2, Krzaczasta Grota p.2 - sala 3, Krzaczasta Grota p.2 - sala 1, Wąwóz Zakorzenionych Dusz, Regiel Zabłąkanych, Źródło Zakorzenionego Ludu, Jaskinia Korzennego Czaru p.2 - sala 1, Jaskinia Korzennego Czaru p.3, Źródło Zakorzenionego Ludu, Jaskinia Korzennego Czaru p.3, Jaskinia Korzennego Czaru p.2 - sala 1, Jaskinia Korzennego Czaru p.1 - sala 1, Jaskinia Korzennego Czaru p.1 - sala 2, Jaskinia Korzennego Czaru p.1 - sala 4, Jaskinia Korzennego Czaru p.2 - sala 2, Jaskinia Korzennego Czaru p.1 - sala 1, Źródło Zakorzenionego Ludu, Jaskinia Korzennego Czaru p.1 - sala 1, Jaskinia Korzennego Czaru p.2 - sala 2, Jaskinia Korzennego Czaru p.1 - sala 4, Jaskinia Korzennego Czaru p.1 - sala 2, Jaskinia Korzennego Czaru p.1 - sala 1, Jaskinia Korzennego Czaru p.1 - sala 3, Jaskinia Korzennego Czaru p.1 - sala 4, Jaskinia Korzennego Czaru p.1 - sala 3, Jaskinia Korzennego Czaru p.1 - sala 1, Jaskinia Korzennego Czaru p.2 - sala 1, Źródło Zakorzenionego Ludu, Piaskowa Gęstwina, Źródło Zakorzenionego Ludu, Regiel Zabłąkanych, Wąwóz Zakorzenionych Dusz"
        },
        "maddoki low": {
            map: "Zawodzące Kaskady, Mglista Grota p.1 - sala 1, Mglista Grota p.1 - sala 2, Mglista Grota p.2, Mglista Grota - sala wyjściowa, Zawodzące Kaskady, Skryty Azyl, Jaszczurze Korytarze p.1, Jaszczurze Korytarze p.2, Jaszczurze Korytarze p.3 - sala 2, Jaszczurze Korytarze p.4 - sala 2, Jaszczurze Korytarze p.4 - sala 1, Jaszczurze Korytarze p.5, Jaszczurze Korytarze p.4 - sala 1, Jaszczurze Korytarze p.4 - sala 2, Jaszczurze Korytarze p.3 - sala 2, Jaszczurze Korytarze p.2, Jaszczurze Korytarze p.1, Skryty Azyl, Złota Dąbrowa, Oślizgłe Przejście - sala 1, Oślizgłe Przejście - sala 2, Złota Dąbrowa, Mglisty Las, Grota porośniętych Stalagmitów - sala wyjściowa, Grota porośniętych Stalagmitów - przejście, Grota porośniętych Stalagmitów - sala główna, Grota porośniętych Stalagmitów - przejście, Grota porośniętych Stalagmitów - sala boczna, Grota porośniętych, Stalagmitów - przejście, Grota porośniętych Stalagmitów - sala główna, Grota porośniętych Stalagmitów - przejście, Grota porośniętych Stalagmitów - sala wyjściowa, Mglisty Las, Złota Dąbrowa, Mglisty Las, Grota porośniętych Stalagmitów - sala wyjściowa, Grota porośniętych Stalagmitów - przejście, Grota porośniętych Stalagmitów - sala główna, Grota porośniętych Stalagmitów - przejście, Grota porośniętych Stalagmitów - sala boczna, Grota porośniętych Stalagmitów - przejście, Grota porośniętych Stalagmitów - sala wyjściowa, Mglisty Las, Złota Dąbrowa, Oślizgłe Przejście - sala 2, Oślizgłe Przejście - sala 1, Złota Dąbrowa, Skryty Azyl"
        },
        "anuraki": {
            map: "Oślizgłe Przejście - sala 2, Z\u0142ota D\u0105browa, Dolina Pe\u0142zn\u0105cego Krzyku, Grz\u0119zawisko Rozpaczy, Zatrute Torfowiska, Gnij\u0105ce Topielisko, Bagna Umar\u0142ych, Gnij\u0105ce Topielisko, Zatrute Torfowiska, Grz\u0119zawisko Rozpaczy, Dolina Pe\u0142zn\u0105cego Krzyku, Złota Dąbrowa",
ignore_grp: [17]
        },
        "Mahopteki dla leszczy": {
            map: "Altepetl Mahoptekan, Niecka Xiuh Atl, Dolina Chmur, Niecka Xiuh Atl, Altepetl Mahoptekan, Dolina Chmur, Dolina Chmur, Altepetl Mahoptekan, Mictlan p.1, Mictlan p.2, Mictlan p.3, Mictlan p.2, Mictlan p.1"
        },
        "Mahopteki-high": {
            map: "Altepetl Mahoptekan, Niecka Xiuh Atl, Dolina Chmur, Niecka Xiuh Atl, Altepetl Mahoptekan, Dolina Chmur, Dolina Chmur, Altepetl Mahoptekan, Mictlan p.1, Mictlan p.2, Mictlan p.3, Mictlan p.4, Mictlan p.5, Mictlan p.6, Mictlan p.7, Mictlan p.8, Mictlan p.7, Mictlan p.6, Mictlan p.5, Mictlan p.4, Mictlan p.3, Mictlan p.2, Mictlan p.1"
        },
        "Katakumby wysokie": {
            map: "Katakumby Poległych Legionistów, Zachodni Tunel Jaźni, Katakumby Opętanych Dusz, Korytarz Porzuconych Nadziei, Katakumby Odnalezionych Skrytobójców, Katakumby Opętanych Dusz, Korytarz Porzuconych Marzeń, Katakumby Gwałtownej Śmierci, Wschodni Tunel Jaźni, Katakumby Krwawych Wypraw, Zachodni Tunel Jaźni"
        },
        "Pustynia Shairhoud?": {
            map: "Pustynia Shaiharrud - wsch\xF3d, Jurta Nomadzka, Pustynia Shaiharrud - wsch\xF3d, Grota Po\u015Bwi\u0119cenia, Pustynia Shaiharrud - wsch\xF3d, Namiot Pustynnych Smok\xF3w, Pustynia Shaiharrud - wsch\xF3d, Pustynia Shaiharrud - zach\xF3d, Jaskinia Piaskowej Burzy s.1, Jaskinia Piaskowej Burzy s.2, Namiot Naznaczonych, Pustynia Shaiharrud - zach\xF3d, Namiot Piechoty Pi\u0142owej, Pustynia Shaiharrud - zach\xF3d, Jaskinia Szcz\u0119k, Jurta Czcicieli, Pustynia Shaiharrud - zach\xF3d, Namiot Gwardii Smokoszcz\u0119kich, Pustynia Shaiharrud - zach\xF3d, S\u0119piarnia, Pustynia Shaiharrud - zach\xF3d, Jaskinia Smoczej Paszczy p.1, Jaskinia Smoczej Paszczy p.2, Jaskinia Smoczej Paszczy p.1, Jurta Chaegda, Pustynia Shaiharrud - zach\xF3d, Smocze Skalisko, Jaskinia Odwagi, Smocze Skalisko, Urwisko Vapora, Smocze Skalisko, Pustynia Shaiharrud - zach\xF3d"
        }
    };
    class s {
        constructor(K, L, M, N, O, P) {
            this.width = L, this.height = M, this.collisions = this.parseCollisions(K, L, M), this.additionalCollisions = P || {}, this.start = this.collisions[N.x][N.y], this.end = this.collisions[O.x][O.y], this.start.beginning = !0, this.start.g = 0, this.start.f = b(this.start, this.end), this.end.target = !0, this.end.g = 0, this.addNeighbours(), this.openSet = [], this.closedSet = [], this.openSet.push(this.start)
        }
        parseCollisions(K, L, M) {
            const N = Array(L);
            for (let O = 0; O < L; O++) {
                N[O] = Array(M);
                for (let P = 0; P < M; P++) N[O][P] = new t(O, P, "1" === K.charAt(O + P * L))
            }
            return N
        }
        addNeighbours() {
            for (let K = 0; K < this.width; K++)
                for (let L = 0; L < this.height; L++) this.addPointNeighbours(this.collisions[K][L])
        }
        addPointNeighbours(K) {
            const L = K.x,
                M = K.y,
                N = [];
            0 < L && N.push(this.collisions[L - 1][M]), 0 < M && N.push(this.collisions[L][M - 1]), L < this.width - 1 && N.push(this.collisions[L + 1][M]), M < this.height - 1 && N.push(this.collisions[L][M + 1]), K.neighbours = N
        }
        anotherFindPath() {
            for (; 0 < this.openSet.length;) {
                let K = this.getLowestF(),
                    L = this.openSet[K];
                if (L === this.end) return this.reconstructPath();
                this.openSet.splice(K, 1), this.closedSet.push(L);
                for (const M of L.neighbours)
                    if (this.closedSet.includes(M)) continue;
                    else {
                        const N = L.g + 1;
                        let O = !1;
                        this.end != this.collisions[M.x][M.y] && (this.openSet.includes(M) || M.collision || this.additionalCollisions[M.x + 256 * M.y]) ? N < M.g && !M.collision && (O = !0) : (this.openSet.push(M), M.h = b(M, this.end), O = !0), O && (M.previous = L, M.g = N, M.f = M.g + M.h)
                    }
            }
        }
        getLowestF() {
            let K = 0;
            for (let L = 0; L < this.openSet.length; L++) this.openSet[L].f < this.openSet[K].f && (K = L);
            return K
        }
        reconstructPath() {
            const K = [];
            for (let L = this.end; L !== this.start;) K.push(L), L = L.previous;
            return K
        }
    }
    class t {
        constructor(K, L, M) {
            this.x = K, this.y = L, this.collision = M, this.g = 1e7, this.f = 1e7, this.neighbours = [], this.beginning = !1, this.target = !1, this.previous = void 0
        }
    }
    localStorage.getItem(`bot_lastmaps`) || localStorage.setItem(`bot_lastmaps`, JSON.stringify([]));
    let v = this,
        z = !1,
        A = !1,
        B, C, D, E = 0,
        F = !1,
        G = !1;
    g.loadQueue.push({
        fun: () => {
            G = !0
        }
    });
    let H = !0,
        I = [];
    setInterval(function() {
        B && (B = void 0)
    }, 4e3);
    let J;
    this.PI = parseInput, parseInput = function(K) {
        let L = v.PI.apply(this, arguments);
        if (!g.battle && !g.dead && G) {
            if (!B && !F) {
                if (B = v.findBestMob(), !B && localStorage.getItem(`bot_expowiska`)) {
                    let M, N = 9999;
                    if (r[localStorage.getItem(`bot_expowiska`)].mobs_id) {
                        let O = r[localStorage.getItem(`bot_expowiska`)].mobs_id;
                        for (let P in O) g.npc[O[P]] && (M = d(g.npc[O[P]].x, g.npc[O[P]].y).length, M < N && (N = M, B = O[P]))
                    }
                }
                A = !1, z = !1
            }
            if (B) {
                let M = g.npc[B];
                if (!M) return B = void 0, L;
                2 > Math.abs(hero.x - M.x) && 2 > Math.abs(hero.y - M.y) && !z ? (z = !0, _g(`fight&a=attack&ff=1&id=-${M.id}`, function(N) {
                    N.alert && `Przeciwnik walczy już z kimś innym` == N.alert && (f(M.id), B = void 0)
                }), setTimeout(function() {
                    B = void 0
                }, 500)) : !A && !z && (e(M.x, M.y), A = !0)
            } else 0 < document.querySelector(`#bot_maps`).value.length && (J = v.findBestGw(), J && !F && (hero.x == J.x && hero.y == J.y ? _g(`walk`) : (e(J.x, J.y), F = !0, setTimeout(function() {
                F = !1
            }, 2e3))));
            D == hero.y && C == C ? (E++, 4 < E && (k(), E = 0, B = void 0, J = void 0, F = !1)) : (D = hero.y, C = hero.x, E = 0)
        }
        if (g.dead && H && (H = !1, ndocument.location.href = `http://margonem.pl`), K.hasOwnProperty("f") && 1 == K.f.init && 0 < hero.clan && !Object.keys(K.f.w).some(M => 0 > M)) {
            const M = [],
                N = [];
            for (let O of Object.values(K.f.w)) 1 == O.team && M.push(`${O.name} ${O.lvl}${O.prof}`) || N.push(`${O.name} ${O.lvl}${O.prof} `);
            if (2 == K.f.myteam && -1 < document.querySelector(`#bot_maps`).value.indexOf(map.name)) {
                //const O = `Zostałem zaatakowany na mapie ${map.name} o godzinie ${m()}.\n${M.join(", ")} vs ${N.join(", ")}`;
                //l(O)
            }
        }
        return L
    }, this.findBestMob = function() {
        let K, M, L = 9999;
        for (let N in g.npc) {
            let P, Q, R, O = g.npc[N];
            if (-1 < document.querySelector(`#bot_mobs`).value.indexOf(`-`) && (P = document.querySelector(`#bot_mobs`).value.split(`-`), Q = parseInt(P[0]), R = parseInt(P[1])), (2 == O.type || 3 == O.type) && P && O.lvl <= R && O.lvl >= Q && o(O.id) && !I.includes(O.id) && 20 > O.wt) {
                if (K = d(O.x, O.y), void 0 == K) continue;
                K.length < L && (L = K.length, M = O.id)
            }
        }
        return M
    }, localStorage.getItem(`alksjd`) || localStorage.setItem(`alksjd`, 0), this.findBestGw = function() {
        let K, L = document.querySelector(`#bot_maps`).value.split(`, `),
            M = parseInt(localStorage.getItem(`alksjd`));
        for (let N in g.townname)
            if (L[M] == g.townname[N]) {
                let O = g.gwIds[N].split(`.`);
                return K = {
                    x: O[0],
                    y: O[1]
                }, K
            } M++, M > L.length && (M = 0), localStorage.setItem(`alksjd`, parseInt(M))
    }, this.initHTML = function() {
        if (!localStorage.getItem(`bot_position`)) {
            localStorage.setItem(`bot_position`, JSON.stringify({
                x: 0,
                y: 0
            }))
        }
        let K = JSON.parse(localStorage.getItem(`bot_position`)),
            L = document.createElement(`div`);
        L.id = `bot_box`, L.setAttribute(`tip`, `Złap i przenieś :)`);
        let M = document.createElement(`input`);
        M.type = `text`, M.id = `bot_mobs`, M.classList.add(`bot_inputs`), M.setAttribute(`tip`, `Wprowadź lvl mobków w postaci np. '50-70'`), L.appendChild(M);
        let N = document.createElement(`input`);
        N.type = `text`, N.id = `bot_maps`, N.classList.add(`bot_inputs`), N.setAttribute(`tip`, `Wprowadź nazwy map`), L.appendChild(N);
        let O = document.createElement(`select`);
        O.id = `bot_list`, O.classList.add(`bot_inputs`), O.setAttribute(`tip`, `Wybierz expowisko, aby dodatek wpisał mapy za Ciebie`);
        for (let S, R = 0; R < Object.keys(r).length; R++) S = document.createElement(`option`), S.setAttribute(`value`, Object.keys(r)[R]), S.text = Object.keys(r)[R], O.appendChild(S);
        L.appendChild(O), document.body.appendChild(L);
        let P = document.createElement(`style`);
        P.type = `text/css`;
        let Q = `
            #bot_box {
               position: absolute;
               border: 2px solid red;
              padding: 5px;
              text-align: center;
               background: black;
               cursor: grab;
               left: ${K.x}px;
               top: ${K.y}px;
              width: auto;
               height: auto;
               z-index: 390;
             }
            .bot_inputs {
                -webkit-box-sizing: content-box;
                -moz-box-sizing: content-box;
                box-sizing: content-box;
                margin: 0 auto;
                margin-bottom: 3px;
                padding: 2px;
                cursor: pointer;
                border: 2px solid #f76f6f;
                -webkit-border-radius: 5px;
                border-radius: 5px;
                font: normal 16px/normal "Times New Roman", Times, serif;
                color: rgba(0,142,198,1);
                -o-text-overflow: clip;
                text-overflow: clip;
                background: rgba(234,227,227,1);
                -webkit-box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
                box-shadow: 2px 2px 2px 0 rgba(0,0,0,0.2) inset;
                text-shadow: 1px 1px 0 rgba(255,255,255,0.66) ;
                display: block;
              }
              input[id=bot_mobs] {
                  text-align: center;
              }
              #bot_blessingbox {
                  border: 1px solid red;
                  background: gray;
                  height: 32px;
                  width: 32px;
                  margin: 0 auto;
              }
        `;
        P.appendChild(document.createTextNode(Q)), document.head.appendChild(P), localStorage.getItem(`bot_mobs`) && (M.value = localStorage.getItem(`bot_mobs`)), localStorage.getItem(`bot_maps`) && (N.value = localStorage.getItem(`bot_maps`)), localStorage.getItem(`bot_expowiska`) && r[localStorage.getItem(`bot_expowiska`)] && (O.value = localStorage.getItem(`bot_expowiska`)), M.addEventListener(`keyup`, () => {
            localStorage.setItem(`bot_mobs`, M.value)
        }), N.addEventListener(`keyup`, () => {
            localStorage.setItem(`bot_maps`, N.value)
        }), O.addEventListener(`change`, () => {
            localStorage.setItem(`bot_expowiska`, O.value), N.value = r[O.value].map, localStorage.setItem(`bot_maps`, N.value), localStorage.setItem(`alksjd`, 0), message(`Zapisano expowisko "${O.value}"`)
        }), $(`#bot_box`).draggable({
            stop: () => {
                let R = {
                    x: parseInt(document.querySelector(`#bot_box`).style.left),
                    y: parseInt(document.querySelector(`#bot_box`).style.top)
                };
                localStorage.setItem(`bot_position`, JSON.stringify(R)), message(`Zapisano pozycję`)
            }
        })
    }, this.initHTML()
};