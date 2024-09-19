<?php

ob_start();

include("widgets/alert.widget");
include("widgets/loading2.widget");
include("widgets/general_popup.widget");
include("widgets/general_popup2.widget");
include("widgets/info.widget");

template_include("home.html", REPORT);

ob_end_flush();
?>

