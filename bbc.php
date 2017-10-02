<?php

///////////////////////////////////////////
///  (c)  Till Affeldt,   Space-Pirates.zx9.de  ///
///////////////////////////////////////////

function bbc($eintrag)
{
    if (@file_exists(__DIR__ . "/inc.bbc_conf.php")) {
        require(__DIR__ . "/inc.bbc_conf.php");
    } else {
        if (file_exists("inc.bbc_conf.php")) {
            include "inc.bbc_conf.php";
        } else {
            $set = Array();
            $set[0] = 0;
            $set[1] = 0;
            $set[2] = 1;
            $set[3] = 1;
            $set[4] = 1;
            $set[5] = 1;
            $set[6] = 2;
            $set[7] = 1;
            $set[8] = 1;
            $set[9] = 1;
            $set[10] = 0;
            $set[11] = 1;
            $set[12] = 0;
            $set[13] = 1;
            $set[14] = 0;
            $set[15] = 1;
            $set[16] = 1;
            $set[17] = 1;
            $set[18] = 0;
            $set[19] = 0;
        }
    }
    if ($set[0] == 0) {
        return $eintrag;
    }

    if ($set[1] == 1) {
        $eintrag = str_replace("<br />", "\n", $eintrag);
        $eintrag = str_replace("<br>", "\n", $eintrag);
        $eintrag = str_replace("<hr>", "[hr]", $eintrag);
        $eintrag = str_replace("<hr />", "[hr]", $eintrag);
        $eintrag = preg_replace("#<b>(.*)</b>#isU", "[b]$1[/b]", $eintrag);
        $eintrag = preg_replace("#<strong>(.*)</strong>#isU", "[b]$1[/b]", $eintrag);
        $eintrag = preg_replace("#<big>(.*)</big>#isU", "[big]$1[/big]", $eintrag);
        $eintrag = preg_replace("#<i>(.*)</i>#isU", "[i]$1[/i]", $eintrag);
        $eintrag = preg_replace("#<em>(.*)</em>#isU", "[i]$1[/i]", $eintrag);
        $eintrag = str_replace("&lt;", "<", $eintrag);
        $eintrag = str_replace("&gt;", ">", $eintrag);
        $eintrag = str_replace("&#038;", "&", $eintrag);
        $eintrag = str_replace("&amp;", "&", $eintrag);
    }

    $eintrag = str_replace("&", "&amp;", $eintrag);
    $eintrag = str_replace("\"", "&quot;", $eintrag);
    $eintrag = str_replace("\'", "&#039;", $eintrag);
    $eintrag = str_replace("ä", "&auml;", $eintrag);
    $eintrag = str_replace("ü", "&uuml;", $eintrag);
    $eintrag = str_replace("ö", "&ouml;", $eintrag);
    $eintrag = str_replace("Ä", "&Auml;", $eintrag);
    $eintrag = str_replace("Ü", "&Uuml;", $eintrag);
    $eintrag = str_replace("Ö", "&Ouml;", $eintrag);
    $eintrag = str_replace("ß", "&szlig;", $eintrag);
    $eintrag = str_replace("<", "&lt;", $eintrag);
    $eintrag = str_replace(">", "&gt;", $eintrag);
    $eintrag = str_replace("*", "&#042;", $eintrag);
    $eintrag = str_replace("\r\n\r\n", "<br />&nbsp;<br />", $eintrag);
    $eintrag = str_replace("\n", "<br />", $eintrag);

    if ($set[15] == 1) {
        $eintrag = eregi_replace("\[hr\]", "<hr>", $eintrag);
    }

    if ($set[4] == 1 && $set[19] != 1) {
        $eintrag = preg_replace_callback("/\[noparse\](.*)\[\/noparse\]/Usi", 'noparse', $eintrag);
    }

    if ($set[2] == 1 && $set[3] == 1) {
        $eintrag = preg_replace('#\[html\](.*)\[/html\]#isU',
            "<br><span title=\"Quellcode\" style=\"font-weight:bold; text-decoration:underline\">HTML:</span><div style=\"background-color:#EEEEEE; text-align:justify; font:10pt, Arial, normal; border-color:steelblue; border-style:inset; border-width:4pt; white-space:nowrap; height:150px; width:575px; overflow:auto\">[var]$1[/var]</div>",
            $eintrag);
    } else {
        if ($set[2] == 2) {
            $eintrag = preg_replace_callback("/\[html\](.*)\[\/html\]/Usi", 'html', $eintrag);
        }
    }

    if ($set[3] == 1) {
        $eintrag = preg_replace('#\[code\](.*)\[/code\]#isU',
            "<br><span title=\"Quellcode\" style=\"font-weight:bold; text-decoration:underline\">Code:</span><div style=\"background-color:#EEEEEE; text-align:justify; font:10pt, Arial, normal; border-color:steelblue; border-style:inset; border-width:4pt; white-space:nowrap; height:150px; width:575px; overflow:auto\">[var]$1[/var]</div>",
            $eintrag);
        $eintrag = preg_replace('#\[php\](.*)\[/php\]#isU',
            "<br><span title=\"Quellcode\" style=\"font-weight:bold; text-decoration:underline\">PHP:</span><div style=\"background-color:#EEEEEE; text-align:justify; font:10pt, Arial, normal; border-color:steelblue; border-style:inset; border-width:4pt; white-space:nowrap; height:150px; width:575px; overflow:auto\">[var]$1[/var]</div>",
            $eintrag);
        $eintrag = preg_replace('#\[code=(.*)\](.*)\[/code\]#isU',
            "<br><span title=\"Quellcode\" style=\"font-weight:bold; text-decoration:underline\">$1:</span><div style=\"background-color:#EEEEEE; text-align:justify; font:10pt, Arial, normal; border-color:steelblue; border-style:inset; border-width:4pt; white-space:nowrap; height:150px; width:575px; overflow:auto\">[var]$2[/var]</div>",
            $eintrag);
        $eintrag = preg_replace_callback("/\[var\](.*)\[\/var\]/Usi", 'parseVar', $eintrag);
    }


    if ($set[5] == 1 && @file_exists(__DIR__ . "/smilies.php")) {
        require(__DIR__ . "/smilies.php");
        for ($zaehler = 0; $zaehler < count($smilie); $zaehler++) {
            $text1 = $smilie[$zaehler]["text"];
            $text2 = "<img src=\"" . $smilie[$zaehler]["src"] . "\" alt=\"" . $smilie[$zaehler]["alt"] . "\" title=\"" . $smilie[$zaehler]["text"] . "\"></img>";
            $eintrag = eregi_replace($text1, $text2, $eintrag);
        }
    } else {
        if ($set[5] == 1 && file_exists("smilies.php")) {
            include "smilies.php";
            for ($zaehler = 0; $zaehler < count($smilie); $zaehler++) {
                $text1 = $smilie[$zaehler]["text"];
                $text2 = "<img src=\"" . $smilie[$zaehler]["src"] . "\" alt=\"" . $smilie[$zaehler]["alt"] . "\" title=\"" . $smilie[$zaehler]["text"] . "\"></img>";
                $eintrag = eregi_replace($text1, $text2, $eintrag);
            }
        }
    }

    $eintrag = preg_replace('#\[b\](.*)\[/b\]#isU', "<strong>$1</strong>", $eintrag);
    $eintrag = preg_replace('#\[big\](.*)\[/big\]#isU', "<big>$1</big>", $eintrag);
    $eintrag = preg_replace('#\[i\](.*)\[/i\]#isU', "<em>$1</em>", $eintrag);
    $eintrag = preg_replace('#\[u\](.*)\[/u\]#isU', "<u>$1</u>", $eintrag);
    $eintrag = preg_replace('#\[s\](.*)\[/s\]#isU', "<strike style=\"color:red\"><span style=\"color:white\">$1</span></strike>", $eintrag);
    if ($set[14] == 1) {
        $eintrag = preg_replace('#\[highlight\](.*)\[/highlight\]#isU', "<span style=\"color:blue; font-weight:bolder\"><blink>$1</blink></span>", $eintrag);
    } else {
        $eintrag = preg_replace('#\[highlight\](.*)\[/highlight\]#isU', "<span style=\"color:blue; font-weight:bolder\">$1</span>", $eintrag);
    }
    if ($set[16] == 1) {
        $eintrag = preg_replace('#\[(sup|high|top)\](.*)\[/(sup|high|top)\]#isU', "<supscript>$2</supscript>", $eintrag);
        $eintrag = preg_replace('#\[(sub|down)\](.*)\[/(sub|down)\]#isU', "<subscript>$2</subscript>", $eintrag);
    }
    if ($set[12] == 1) {
        $eintrag = preg_replace('#\[pre\](.*)\[/pre\]#isU', "<pre>$1</pre>", $eintrag);
    }

    $eintrag = preg_replace('#\[align\](.*)\[/align\]#isU', "<div align=\"center\" style=\"width:550pt\">$1</div>", $eintrag);
    $eintrag = preg_replace('#\[(left|align=left)\](.*)\[/(left|align)\]#isU', "<div align=\"left\" style=\"width:550pt\">$2</div>", $eintrag);
    $eintrag = preg_replace('#\[(center|align=center)\](.*)\[/(center|align)\]#isU', "<div align=\"center\" style=\"width:550pt\">$2</div>", $eintrag);
    $eintrag = preg_replace('#\[(right|align=right)\](.*)\[/(right|align)\]#isU', "<div align=\"right\" style=\"width:550pt\">$2</div>", $eintrag);

    if ($set[14] == 1) {
        $eintrag = preg_replace('#\[blink\](.*)\[/blink\]#isU', "<blink>$1</blink>", $eintrag);
    }

    if ($set[17] == 1) {
        while (preg_match('#\[(spoiler|hide|hidden)\](.*)\[/(spoiler|hide|hidden)\]#isU', $eintrag)) {
            $eintrag = preg_replace('#\[(spoiler|hide|hidden)\](.*)\[/(spoiler|hide|hidden)\]#isU',
                "<div><input type=\"button\" onClick=\"var inner = this.parentNode.getElementsByTagName('div')[0]; if (inner.style.display == 'none'){inner.style.display = '';this.value=' - ';}else{inner.style.display = 'none';this.value=' + ';}\" value=\" + \"><div style=\"color:gray; background-color:white; display:none\">$2</div></div>",
                $eintrag);
        }
    }

    $eintrag = preg_replace('#\[color=(.*)\](.*)\[/color\]#isU', "<span style=\"color: $1\">$2</span>", $eintrag);
    $eintrag = preg_replace('#\[color\](.*)\[/color\]#isU', "<span style=\"color:#FF0000\">$1</span>", $eintrag);
    $eintrag = preg_replace('#\[mark=(.*)\](.*)\[/mark\]#isU', "<span style=\"background-color: $1\">$2</span>", $eintrag);
    $eintrag = preg_replace('#\[mark\](.*)\[/mark\]#isU', "<span style=\"background-color:yellow\">$1</span>", $eintrag);
    if ($set[18] == 1) {
        $eintrag = preg_replace('#\[size=(.*)\](.*)\[/size\]#isU', "<span style=\"font-size: $1 pt\">$2</span>", $eintrag);
    }

    if ($set[6] == 1) {
        $eintrag = preg_replace('#\[url\](.*)\[/url\]#isU', "<a href=\"$1\" target=\"_blank\" title=\"$1\">$1</a>", $eintrag);
        $eintrag = preg_replace('#\[url=(.*)\](.*)\[/url\]#isU', "<a href=\"$1\" target=\"_blank\" title=\"$1\">$2</a>", $eintrag);
    } else {
        if ($set[6] == 2) {
            $eintrag = preg_replace('#\[url\](.*)\[/url\]#isU', "<a href=\"$1\" target=\"_self\" title=\"$1\">$1</a>", $eintrag);
            $eintrag = preg_replace('#\[url=(.*)\](.*)\[/url\]#isU', "<a href=\"$1\" target=\"_self\" title=\"$1\">$2</a>", $eintrag);
        }
    }

    if ($set[10] == 1) {
        $eintrag = preg_replace('#\[google\](.*)\[/google\]#isU', "<a href=\"http://www.google.de/search?q=$1\" target=\"_blank\" title=\"$1\">Google-Suche</a>", $eintrag);
        $eintrag = preg_replace('#\[google=(.*)\](.*)\[/google\]#isU', "<a href=\"http://www.google.de/search?q=$1\" target=\"_blank\" title=\"$1\">$2</a>", $eintrag);
    } else {
        if ($set[10] == 2) {
            $eintrag = preg_replace('#\[google\](.*)\[/google\]#isU', "<a href=\"http://www.google.de/search?q=$1\" target=\"_top\" title=\"$1\">Google-Suche</a>", $eintrag);
            $eintrag = preg_replace('#\[google=(.*)\](.*)\[/google\]#isU', "<a href=\"http://www.google.de/search?q=$1\" target=\"_top\" title=\"$1\">$2</a>", $eintrag);
        }
    }

    if ($set[11] == 2 && $set[10] == 2) {
        $eintrag = preg_replace('#\[img\](.*)\[/img\]#isU', "<a href=\"$1\" title=\"$1\" target=\"_top\"><img src=\"$1\" alt=\"$1\"></a>", $eintrag);
        $eintrag = preg_replace('#\[img=(.*)\](.*)\[/img\]#isU', "<a href=\"$1\" title=\"$2\" target=\"_top\"><img src=\"$1\" alt=\"$2\"></a>", $eintrag);
    } else {
        if ($set[11] == 2) {
            $eintrag = preg_replace('#\[img\](.*)\[/img\]#isU', "<a href=\"$1\" title=\"$1\" target=\"_blank\"><img src=\"$1\" alt=\"$1\"></a>", $eintrag);
            $eintrag = preg_replace('#\[img=(.*)\](.*)\[/img\]#isU', "<a href=\"$1\" title=\"$2\" target=\"_blank\"><img src=\"$1\" alt=\"$2\"></a>", $eintrag);
        } else {
            if ($set[11] == 1) {
                $eintrag = preg_replace('#\[img\](.*)\[/img\]#isU', "<img src=\"$1\" alt=\"$1\">", $eintrag);
                $eintrag = preg_replace('#\[img=(.*)\](.*)\[/img\]#isU', "<img src=\"$1\" alt=\"$2\">", $eintrag);
            }
        }
    }

    if ($set[7] == 1) {
        $eintrag = preg_replace('#\[mail\](.*)\[/mail\]#isU', "<a href=\"mailto:$1\" target=\"_blank\" title=\"Mail an: $1\">$1</a>", $eintrag);
        $eintrag = preg_replace('#\[mail=(.*)\](.*)\[/mail\]#isU', "<a href=\"mailto:$1\" target=\"_blank\" title=\"Mail an: $1\">$2</a>", $eintrag);
    }

    if ($set[13] == 1) {
        $eintrag = preg_replace('#\[list\](.*)\[/list\]#isU', "<ul>$1</ul>", $eintrag);
        $eintrag = preg_replace('#\[list=(1|a|A|i|I)\](.*)\[/list\]#isU', "<ol type=\"$1\">$2</ol>", $eintrag);
        $eintrag = str_replace("[&#042;]", "<li>", $eintrag);
    }

    $width = 575;
    while (preg_match('#\[quote\](.*)\[/quote\]#isU', $eintrag)) {
        $width -= 10;
        $eintrag = preg_replace('#\[quote\](.*)\[/quote\]#isU', "<div class=\"zitatmeldung\" style=\"width: $width px\">Zitat:</div><div style=\"width: $width px\" class=\"zitat\">$1</div>",
            $eintrag);
    }

    $width = 575;
    while (preg_match('#\[quote=(.*)\](.*)\[/quote\]#isU', $eintrag)) {
        $width -= 10;
        $eintrag = preg_replace('#\[quote=(.*)\](.*)\[/quote\]#isU',
            "<div style=\"font-style:normal; font-weight:bold; background-color:lightskyblue; color:black; border:solid 1px black; width: $width px\">Zitat von $1:</div><div style=\"color:#101010; font-style:normal; background-color:white; border:solid 1px black; margin:0px auto; margin-left:5px; width: $width px\">$2</div>",
            $eintrag);
    }

    if ($set[9] == 1) {
        $eintrag = preg_replace('#\[(ironie|iron)\](.*)\[/(ironie|iron)\]#isU',
            "<span style=\"text-weight:bold; background-color:#FFFF00\"><img src=\"http://www.my-smileys.de/smileys3/annieironie.gif\" alt=\"Ironie!\" width=44 height=46>$2<img src=\"http://www.my-smileys.de/smileys3/annieironie.gif\" alt=\"Ironie!\" width=44 height=46></span>",
            $eintrag);
    }

    if ($set[8] == 1) {
        while (preg_match('#\[(tab|table)\](.*)\[/(tab|table)\]#isU', $eintrag)) {
            $eintrag = preg_replace('#\[(tab|table)\](.*)\[/(tab|table)\]#isU',
                "<table width=90% bgcolor=white border bordercolordark=black bordercolorlight=gray><tbody><tr><td>$2</td></tr></tbody></table>", $eintrag);
            $eintrag = preg_replace('#\[(tab|table)=(hide|hidden|structure)\](.*)\[/(tab|table)\]#isU', "<table border=0 rules=none><tbody><tr><td>$3</td></tr></tbody></table>", $eintrag);
            $eintrag = preg_replace('#\[(tab|table)=(all|cols|rows|none)\](.*)\[/(tab|table)\]#isU',
                "<table width=90% bgcolor=white border bordercolordark=black bordercolorlight=gray rules=\"$2\"><tbody><tr><td>$3</td></tr></tbody></table>", $eintrag);
            $eintrag = preg_replace('#\[(tab|table)=(.*)\](.*)\[/(tab|table)\]#isU',
                "<table width=90% bgcolor=$2 border bordercolordark=black bordercolorlight=gray rules=all><tbody><tr><td>$3</td></tr></tbody></table>", $eintrag);
        }
        $eintrag = eregi_replace('\[(row|zeile|z|tr)\]', "<tr><td>", $eintrag);
        $eintrag = preg_replace('#\[(row|zeile|z|tr)=(.*)\]#isU', "<tr><td rowspan=$2>", $eintrag);
        $eintrag = eregi_replace('\[(col|spalte|sp|td)\]', "<td>", $eintrag);
        $eintrag = preg_replace('#\[(col|spalte|sp|td)=(.*)\]#isU', "<td colspan=$2>", $eintrag);
    }

    if ($set[19] == 1) {
        $eintrag = clearCode($eintrag);
    }

    return $eintrag;
}


function parseVar($treffer)
{
    $str = $treffer[1];
    $str = str_replace("/", "<span style=\"color:seagreen\">/</span>", $str);
    $str = str_replace("[", "<span style=\"color:#007700\">&#091;</span>", $str);
    $str = str_replace("]", "<span style=\"color:#007700\">&#093;</span>", $str);
    $str = str_replace("{", "<span style=\"color:maroon\">{</span>", $str);
    $str = str_replace("}", "<span style=\"color:maroon\">}</span>", $str);
    $str = preg_replace("/(&#039;.*&#039;)/Uis", "<span style=\"color:#DD0000\">$1</span>", $str);
    $str = preg_replace("/(&quot;.*&quot;)/Uis", "<span style=\"color:#DD0000\">$1</span>", $str);
    $str = preg_replace("/(&amp;.*;)/Uis", "<span style=\"color:#808080\">$1</span>", $str);
    $str = str_replace("\\", "<span style=\"color:purple\">\\</span>", $str);

    $str = preg_replace("#(//.*<br>)#Uis", "<span style=\"color:violet\">$1</span>", $str);
    $str = preg_replace("/&lt;!--(.*)--&gt;/Uis", "<span style=\"color:violet\">&lt;!-- $1 --&gt;</span>", $str);
    $str = preg_replace("/(\/&#042;.*&#042;\/)/Uis", "<span style=\"color:violet\">$1</span>", $str);
    $str = preg_replace("/(\(.*\))/Uis", "<span style=\"color:olive\">$1</span>", $str);

    $str = str_replace("&lt;?php", "<span style=\"color:#00AA00\">&lt;?php</span>", $str);
    $str = str_replace("&lt;?", "<span style=\"color:#00AA00\">&lt;?</span>", $str);
    $str = str_replace("?&gt;", "<span style=\"color:#00AA00\">?&gt;</span>", $str);
    $str = eregi_replace("text/html", "<span style=\"color:#00AA00\">text/html</span>", $str);
    $str = eregi_replace("text/css", "<span style=\"color:#00AA00\">text/css</span>", $str);
    $str = eregi_replace("text/javascript", "<span style=\"color:#00AA00\">text/javascript</span>", $str);

    $str = str_replace("&amp;", "<span style=\"color:#000000; font-weight:bold\">&amp;</span>", $str);
    $str = str_replace("&lt;", "<span style=\"color:seagreen\">&lt;</span>", $str);
    $str = str_replace("&gt;", "<span style=\"color:seagreen\">&gt;</span>", $str);
    $str = "<span style=\"color:#0000BB\">" . $str . "</span>";

    return $str;
}

function noparse($treffer)
{
    $str = $treffer[1];
    $str = str_replace("[", "&#091;", $str);
    $str = str_replace("]", "&#093;", $str);

    return $str;
}

function html($get)
{
    $str = $get[1];
    $str = str_replace("&amp;", "&", $str);
    $str = str_replace("&quot;", "\"", $str);
    $str = str_replace("&#039;", "\'", $str);
    $str = str_replace("&auml;", "ä", $str);
    $str = str_replace("&uuml;", "ü", $str);
    $str = str_replace("&ouml;", "Ö", $str);
    $str = str_replace("&Auml;", "Ä", $str);
    $str = str_replace("&Uuml;", "Ü", $str);
    $str = str_replace("&Ouml;", "Ö", $str);
    $str = str_replace("&szlig;", "ß", $str);
    $str = str_replace("&lt;", "<", $str);
    $str = str_replace("&gt;", ">", $str);

    return $str;
}

function clearCode($code)
{
    if (@file_exists(__DIR__ . "/inc.bbc_conf.php")) {
        require(__DIR__ . "/inc.bbc_conf.php");
    } else {
        if (file_exists("inc.bbc_conf.php")) {
            include "inc.bbc_conf.php";
        } else {
            $set = Array();
            $set[4] = 1;
        }
    }
    if ($set[4] == 1) {
        $code = preg_replace("#\[noparse(.*)\](.*)\[/noparse\]#isU", 'noparse', $code);
    } else {
        $code = preg_replace("#\[noparse(.*)\](.*)\[/noparse\]#isU", "$2", $code);
    }
    $code = preg_replace("#\[\*\]#isU", "", $code);
    $code = preg_replace("#\[url(.*)\](.*)\[/url\]#isU", "$2", $code);
    $code = preg_replace("#\[list(.*)\](.*)\[/list\]#isU", "$2", $code);
    $code = preg_replace("#\[quote(.*)\](.*)\[/quote\]#isU", "$2", $code);
    $code = preg_replace("#\[code(.*)\](.*)\[/code\]#isU", "", $code);
    $code = preg_replace("#\[ironie(.*)\](.*)\[/ironie\]#isU", "$2", $code);
    $code = preg_replace("#\[iron(.*)\](.*)\[/iron\]#isU", "$2", $code);
    $code = preg_replace("#\[php(.*)\](.*)\[/php\]#isU", "", $code);
    $code = preg_replace("#\[html(.*)\](.*)\[/html\]#isU", "", $code);
    $code = preg_replace("#\[var(.*)\](.*)\[/var\]#isU", "$2", $code);
    $code = preg_replace("#\[b(.*)\](.*)\[/b\]#isU", "$2", $code);
    $code = preg_replace("#\[big(.*)\](.*)\[/big\]#isU", "$2", $code);
    $code = preg_replace("#\[i(.*)\](.*)\[/i\]#isU", "$2", $code);
    $code = preg_replace("#\[color(.*)\](.*)\[/color\]#isU", "$2", $code);
    $code = preg_replace("#\[highlight(.*)\](.*)\[/highlight\]#isU", "$2", $code);
    $code = preg_replace("#\[size(.*)\](.*)\[/size\]#isU", "$2", $code);
    $code = preg_replace("#\[blink(.*)\](.*)\[/blink\]#isU", "$2", $code);
    $code = preg_replace("#\[img\](.*)\[/img\]#isU", "$1", $code);
    $code = preg_replace("#\[img=(.*)\](.*)\[/url\]#isU", "$1", $code);
    $code = preg_replace("#\[mail(.*)\](.*)\[/mail\]#isU", "$2", $code);
    $code = preg_replace("#\[hr\]#isU", "", $code);

    return $code;
}

function createXML($code, $codierung)
{
    $code2 = Array();
    $code2[1] = $code;
    $code = html($code2);

    $code = preg_replace("#<br />#is", " ", $code);
    $code = preg_replace("#<br>#is", " ", $code);
    $code = str_replace("\r\n", " ", $code);
    $code = str_replace("\n", " ", $code);

    $code = clearCode($code);

    if (preg_match("#utf-8#is", $codierung) == 1) {
        $code = str_replace("ä", "ae", $code);
        $code = str_replace("ü", "ue", $code);
        $code = str_replace("ö", "oe", $code);
        $code = str_replace("Ä", "Ae", $code);
        $code = str_replace("Ü", "Ue", $code);
        $code = str_replace("Ö", "Oe", $code);
        $code = str_replace("ß", "ss", $code);
    }

    $code = str_replace("&", " und ", $code);
    $code = str_replace("<", "", $code);
    $code = str_replace(">", "", $code);

    $code = str_replace("    ", " ", $code);
    $code = str_replace("   ", " ", $code);
    $code = str_replace("  ", " ", $code);

    return $code;
}
