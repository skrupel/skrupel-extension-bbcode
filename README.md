Skrupel-Erweiterung BBCode
==========================

**Autor:** Till Affeldt (PseudoPsycho)

**Aktuelle Verion:** 1.1.2


Beschreibung
------------

Das BBCode-Addon erlaubt das Interpretieren von BB-Codes innerhalb von Forum und (Ex-)Chat.

Unterstützte Tags wären beispielsweise:

    [b] [big] [i] [u] [s] [highlight] [blink] [pre]
    [color] [size] [mark]
    [quote] [ironie]
    [code] [php] [html] [var] [noparse]
    [url] [img] [google] [mail]
    [table] [row] [col]
    [list] [*]
    [hr]
    [left] [center] [right]
    [spoiler] [hide]
    [top] [down]

Für einen Großteil der BBCodes stehen Ihnen im Admin-Panel diverse Konfigurationsmöglichkeiten zur Verfügung.
Desweiteren werden (konfigurationsabhängig) einige Smilies umgewandelt. Ebenso ist es möglich, sämtliche BBCodes zu unterbinden.


Installation
------------

### 1. Entpacken

Die Erweiterung muss einfach in das Verzeichnis `skrupel/extend/bbcode` entpackt werden.

#### ... oder via Git

    $ cd DEIN_SKRUPEL_VERZEICHNIS/extend
    $ git clone https://github.com/skrupel/skrupel-extension-bbcode.git bbcode


### 2. Setup

Sollte die Erweiterung noch nicht Teil Ihrer Skrupel-Version sein, so rufen Sie bitte die Datei `extend/bbc/install.php` auf.
Die Erweiterung wird dann automatisch installiert.

Bitte beachten Sie, dass vorherige Änderungen an den betroffenen Dateien (einzusehen im Verzeichnis `extend/bbc/skrupel/`)
bei der Installation verloren gehen. Erstellen Sie vorsichtshalber zuvor eine Sicherheitskopie der Dateien.

Um die Installation zu ermöglichen, müssen Sie evtl. die Schreibrechte anpassen.
Setzen Sie dazu den Ordner `extend/bbc/` samt Inhalt auf CHMOD `777`.
Unter Umständen muss auch der gesamte Skrupel-Ordner entsprechende Rechte erhalten.
Setzen Sie nach der Installation (zum Schutz Ihrer Dateien) den CHMOD wieder zurück.


### 3. Abschluss

Beachten Sie auch, dass zuvor erstellte Beiträge und Themen evtl. verfälscht dargestellt werden können.
ändern Sie ggf. die betroffenen Einträge in phpMyAdmin oder aktivieren Sie den Kompatibilitätsmodus.

Bitte entfernen Sie nach der Installation die `install.php`, da ungebetene Besucher damit Schaden anrichten können.


Konfigurationshinweise
----------------------

Erstellen Sie eine Kopie der Datei `inc.bbc_conf.php.dist` und benennen Sie sie um in `inc.bbc_conf.php`.

Gehen Sie in den Admin-Bereich und klicken Sie unter Forum auf BBCodes.
Stellen Sie die Select-Boxen Ihren Anforderungen nach ein.
Ein Klick auf den Button genügt, um die Konfiguration abzuschließen.

**Hinweis:** Schüzen Sie die Dateien `admin.settings.php` und `inc.bbc_conf.php` vor fremden Blicken,
am Besten mittels `.htaccess` und CHMOD.


### Kompatibilitätsmodus

In der Konfiguration haben Sie die Möglichkeit, den Kompatibilitätsmodus zu aktivieren.
Dieser sorgt für eine bessere Darstellung von Beiträgen, die vor der Installation verfasst wurden.
Jedoch kann dies ebenso zu einer verfälschten Darstellung einiger BBCodes führen.
Meine Empfehlung ist jedoch, ihn trotzdem zu aktivieren, da einige System-Chat-Nachrichten noch HTML beinhalten.

**Hinweis:** Einige Probleme, die in früheren Versionen in diesem Modus auftraten, wurden behoben.


### Code-Bereinigung

Nachträgliches Deaktivieren von BBCodes sorgte bislang für unschöne Code-Ruinen.
Dies wurde nun behoben. Die Funktion kann im Admin-Panel ein- und ausgeschaltet werden, sorgt jedoch für einige Probleme;
u.A. kann der `[noparse]`-Tag nur sehr schlecht interpretiert werden, wenn die Code-Bereinigung aktiviert ist.
Ich empfehle daher, diese Funktion standartmäßig zu deaktivieren.

Ebenso wurde eine Funktion erstellt, die es ermöglicht, den Text XML-fähig, z.B. für ein RSS-Feed, zu machen.
Inkludieren Sie dazu die `/extend/bbc/bbc.php` und verwenden Sie den Befehl:

    $text = createXML($text, $codierung);
