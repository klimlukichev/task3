<?php
$DBDebug = false;
$DBDebugToFile = false;

define("BX_FILE_PERMISSIONS", 0777);
define("BX_DIR_PERMISSIONS", 0777);
@umask(~(BX_FILE_PERMISSIONS | BX_DIR_PERMISSIONS) & 0777);

@ini_set("memory_limit", "512M");

define("BX_DISABLE_INDEX_PAGE", true);

mb_internal_encoding("UTF-8");
