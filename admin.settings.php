<?php
include "../../inc.conf.php";

if ($language != "de" && $language != "en" && $language != "eng") {
    $lang = "de";
} elseif ($language == "en" || $language == "eng") {
    $lang = "en";
} else {
    $lang = $language;
}

include "../../admin/inc.header.php";
include "dat.php";

if ($_GET["fu"] == 0 || $_GET["fu"] == 1) {
    $fu = $_GET["fu"];
} else {
    $fu = 0;
}
if ($fu == 0) {
    if (file_exists("inc.bbc_conf.php")) {
        require("inc.bbc_conf.php");
    } else {
        $set = array();
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
        $dat[18] = 0;
        $dat[19] = 0;
    }
?>
    <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0">
    <form name="formular" action="admin.settings.php?fu=1" method="post">
        <h2>
            <center><?php if ($lang == "de") { echo "Einstellungen"; } elseif ($lang == "en") { echo "settings"; } ?></center>
        </h2>
<?php
        if (file_exists("install.php")) {
            if ($lang == "de") {
                echo("Bitte zuerst die install.php entfernen!!!");
            } elseif ($lang == "en") {
                echo("Please delete the install.php first!!!");
            }
        }
?>
        <center>
            <table>
<?php
        for ($zaehler1 = 0; $zaehler1 < count($dat); $zaehler1++) {
            echo "<tr><td>" . $dat[$zaehler1]["text"];
            echo "<td><select name=\"" . $zaehler1 . "\">";
            for ($zaehler2 = 0; $zaehler2 < count($dat[$zaehler1]["poss"]); $zaehler2++) {
                if ($set[$zaehler1] == $zaehler2) {
                    $checked = "selected";
                } else {
                    $checked = "";
                }
                echo "<option value=\"" . $zaehler2 . "\" " . $checked . ">" . $dat[$zaehler1]["poss"][$zaehler2] . "</option>";
            }
            echo "</select></td></tr>";
        }
?>
                <tr>
                    <td><input type="submit" value="Einstellungen &auml;ndern"></td>
                </tr>
            </table>
        </center>
    </form>
    </body>
<?php
} elseif ($fu == 1) {
    $file = fopen("inc.bbc_conf.php", "w");
    $daten = "<?php";
    if (isset($_POST)) {
        for ($zaehler3 = 0; $zaehler3 < count($_POST); $zaehler3++) {
            $daten .= "\n\$set[" . $zaehler3 . "] = " . $_POST[$zaehler3] . ";";
        }
    }
    $daten .= "\n?>";
    fwrite($file, $daten);
?>
    <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0"
          onLoad="window.setTimeout('location.replace(\'admin.settings.php\')', 800)">
<?php
    if ($lang == "de") {
        echo "Die Daten wurden erfolgreich gespeichert.";
    } elseif ($lang == "en") {
        echo "The data was stored successfully.";
    }
?>
    </body>
<?php
} else {
?>
    <body text="#ffffff" bgcolor="#444444" link="#000000" vlink="#000000" alink="#000000" leftmargin="0" rightmargin="0" topmargin="0" marginwidth="0" marginheight="0"
          onLoad="window.setTimeout('location.replace(\'admin.settings.php?fu=0\')', 1000)">
<?php
    if ($lang == "de") {
        echo "Achtung! Die Daten konnten nicht gespeichert werden!";
    } elseif ($lang == "en") {
        echo "Sorry, the data could not be saved.";
    }
?>
    </body>
<?php
}
include "../../admin/inc.footer.php";
