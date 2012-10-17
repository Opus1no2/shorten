<?php
/**
 *
 * Instantiate Shorten class
 */
include_once 'lib/shorten.php';

try {
    $shorten = new Shorten($_POST);
} catch (Exception $e) {
    echo $e->getMessage();
}

