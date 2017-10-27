<?php
ini_set('display_errors', 1);
include 'bbc.php';
if (!file_exists('../../extend/bbc/bbc.php')) {
    die('Achtung! Die Datei "bbc.php" existiert nicht oder das Verzeichnis ist nicht richtig gesetzt!!!');
}
// Wird der Text erst normal und dann umgewandelt angezeigt, so wurde das File "bbc" korrekt angelegt.
$text = '[b]hal[/b]lo[i]![/i]';
echo '<code>'.$text.'</code><br>'.bbc($text);
echo '<br><br>';
$text0 = '[spoiler]Versteckter Text[/spoiler]';
echo '<code>'.$text0.'</code><br>'.bbc($text0);
echo '<br><br>';
$text2 = '[highlight]Hervorgehobener Text[/highlight]';
echo '<code>'.$text2.'</code><br>'.bbc($text2);
echo '<br><br>';
$text3 = '[left]links[/left][center]mittig[/center][right]rechts[/right]';
echo '<code>'.$text3.'</code><br>'.bbc($text3);
echo '<br><hr><br><h2>Definierbare Tags:</h2>';
$def = '[url]http://www.space-pirates.zx9.de[/url] [url=http://www.space-pirates.zx9.de]Space-Pirates[/url]';
echo '<code>'.$def.'</code><br>'.bbc($def);
echo '<br><br>';
$def2 = '[google]Space-Pirates[/google]';
echo '<code>'.$def2.'</code><br>'.bbc($def2);
echo '<br><br>';
$def3 = '[code]<b>Test</b>[/code] [code=HTML]<b>Test</b>[/code]';
echo '<code>'.$def3.'</code><br>'.bbc($def3);
echo '<br><br>';
$def4 = '[php]echo "<b>Test</b>";[/php] [html]<b>Test</b>[/html]';
echo '<code>'.$def4.'</code><br>'.bbc($def4);
echo '<br><br>';
$def5 = '[var]Dies ist ein "<b>Test</b>".[/var]';
echo '<code>'.$def5.'</code><br>'.bbc($def5);
