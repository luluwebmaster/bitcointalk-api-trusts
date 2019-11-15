<?php

// Set JSON header content type
header('Content-Type: application/json');

// Show all PHP error's
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Get config
require_once('../config/config.php');

// Load class
require_once('../app/Bitcointalk.php');

// Set profile ID
$profileId = (isset($_GET['profileId'])) ? $_GET['profileId'] : false;

// Set final JSON data
$finalJsonData = [];

// If profile id defined
if(isset($profileId) && !empty($profileId)) {

    // Check if tmp path exist
    if(!file_exists('../tmp')) {

        // Create path
        mkdir('../tmp');
    }

    // Check if trusts cache exist
    if(!file_exists('../tmp/trusts.json')) {

        // Create file
        file_put_contents('../tmp/trusts.json', '[]');
    }

    // Get cached trusts informations
    $cachedTrustsInfos = json_decode(file_get_contents('../tmp/trusts.json'), true);

    // If infos is in cache
    if(!isset($cachedTrustsInfos[$profileId]) || ($cachedTrustsInfos[$profileId]['savedTime'] + ($config['refreshCacheTimeInHours'] * 60 * 60)) <= time()) {

        // Init Bitcointalk instance
        $bitcointalk = new Bitcointalk($config['login']['link'], $config['login']['username'], $config['login']['password'], $config['login']['captcha-code']);

        // Connect to Bitcointalk website
        $bitcointalk->connect();

        // Refresh trusts infos
        $cachedTrustsInfos[$profileId] = [
            'savedTime' => time(),
            'infos' => $bitcointalk->getTrustsInfos($profileId)
        ];

        // Update file
        file_put_contents('../tmp/trusts.json', json_encode($cachedTrustsInfos));
    }

    // Set final JSOn data
    $finalJsonData = $cachedTrustsInfos[$profileId]['infos'];
} else {

    // Set final JSON data
    $finalJsonData = [
        'success' => false
    ];
}

// Return final JSON data
echo(json_encode($finalJsonData));
?>
