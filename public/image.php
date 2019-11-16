<?php

// Set PNG content type heade
header('Content-Type: image/png');

// Get config
require_once('../config/config.php');

// Set profile ID
$profileId = (isset($_GET['profileId'])) ? $_GET['profileId'] : false;

// If profile id defined
if(isset($profileId) && !empty($profileId)) {

    // Get trusts infos with API
    $trustsInfos = json_decode(file_get_contents($config['api']['link'].'?profileId='.$profileId), true);

    // If success
    if(!$trustsInfos['error']) {

        // Set fonts
        $boldFont = 3;
        $normalFont = 2;

        // Create image
        $image = imagecreate(300, 50);

        // Set font width
        $usernameFontWidth = imagefontwidth($boldFont);
        $trustsFontWidth = imagefontwidth($normalFont);

        // Set background
        imagecolorallocate($image, 236, 237, 243);

        // Set colors
        $black = imagecolorallocate($image, 0, 0, 0);
        $green = imagecolorallocate($image, 116, 195, 101);
        $orange = imagecolorallocate($image, 255, 165, 0);

        // Set border
        $border = imagecolorallocate($image, 187, 201, 214);
        imagesetthickness($image, 5);
        imagerectangle ($image, 2, 2, 297, 47, $border);

        // Set username
        $colorUsername = imagecolorallocate($image, 67, 103, 139);
        imagestring($image, $boldFont, (150 - (($usernameFontWidth * strlen($trustsInfos['username'])) / 2)), 7, $trustsInfos['username'], $colorUsername);

        // Set positive
        imagestring($image, ((intval($trustsInfos['trusts'][0]) > 0) ? $boldFont : $normalFont), 40, 25, $trustsInfos['trusts'][0], ((intval($trustsInfos['trusts'][0]) > 0) ? $green : $black));

        // Set first slash
        imagestring($image, $normalFont, 90, 25, '|', $black);

        // Set neutral
        imagestring($image, $normalFont, (150 - (($trustsFontWidth * strlen($trustsInfos['trusts'][1])) / 2)), 25, $trustsInfos['trusts'][1], $black);

        // Set second slash
        imagestring($image, $normalFont, 205, 25, '|', $black);

        // Set negative
        imagestring($image, ((intval($trustsInfos['trusts'][2]) < 0) ? $boldFont : $normalFont), 245, 25, $trustsInfos['trusts'][2], ((intval($trustsInfos['trusts'][2]) < 0) ? $orange : $black));

        // Return image
        imagepng($image);
        imagedestroy($image);
    }
}
?>
