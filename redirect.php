<?php
/**
 *
 * Instantiate redirect class and execute rediret
 */
include_once 'lib/redirect.php';

try {
    $redirect = new Redirect($_REQUEST['url']);
    $redirect->redirect();
} catch (Exception $e) {
    echo $e->getMessage();
}