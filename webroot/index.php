<?php
/**
 * This is a Origo pagecontroller for the me page.
 *
 * Contains a short presentation of the author of this page.
 *
 */

// Include the essential config-file which also creates the $origo variable with its defaults.
include(__DIR__.'/config.php');

// Do it and store it all in variables in the Origo container.
$origo['title'] = "Origo";
$origo['main'] = <<<EOD
<section>
    <h1>Välkommen till Origo</h1>
</section>
EOD;

// Finally, leave it all to the rendering phase of Origo.
include(ORIGO_THEME_PATH);
