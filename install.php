<?php
$inst = array(
    'extend/bbc/inc.bbc_conf.php',
    'inhalt/kommunikation_board.php',
    'inhalt/kommunikation_ch.php',
    'inhalt/kommunikation_exch.php',
    'admin/allgemein_alpha.php',
    'admin/allgemein_gamma.php',
    'admin/menu.php',
    'lang/de/lang.admin.allgemein_gamma.php',
    'lang/de/lang.admin.menu.php',
    'lang/en/lang.admin.allgemein_gamma.php',
    'lang/en/lang.admin.menu.php',
    'inhalt/uebersicht_neuigkeiten.php'
);

$error_log = '';
foreach ($inst as $rel_file) {
    $new_file = 'skrupel/'.$rel_file;
    if (file_exists($new_file) && is_readable($new_file)) {
        $orig_file = '../../'.$rel_file;
        if (!file_exists($orig_file) || is_writable($orig_file)) {
            $new_content = file_get_contents($new_file);
            file_put_contents($orig_file, $new_content);
        } else {
            $error_log .= 'Die Datei "'.$rel_file.'" ist ist nicht beschreibbar.<br>';
        }
    } else {
        $error_log .= 'Die Installationsdatei zu der Datei "'.$rel_file.'" existiert nicht (mehr) oder ist nicht lesbar.<br>';
    }
}

if ($error_log != '') {
    echo $error_log;
    echo 'Die Installation wurde abgeschlossen.';
} else {
    echo 'Herzlichen Gl&uuml;ckwunsch!<br>Die Installation wurde fehlerfrei abgeschlossen.';
}
