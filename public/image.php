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

        // Set username
        $username = (($trustsInfos['warning']) ? '!! ' : '').$trustsInfos['username'].(($trustsInfos['warning']) ? ' !!' : '');

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
        $blue = imagecolorallocate($image, 67, 103, 139);
        $black = imagecolorallocate($image, 0, 0, 0);
        $green = imagecolorallocate($image, 116, 195, 101);
        $orange = imagecolorallocate($image, 255, 165, 0);
        $warning = imagecolorallocate($image, 255, 65, 5);
        $red = imagecolorallocate($image, 220, 20, 60);

        // Set border
        $border = imagecolorallocate($image, 187, 201, 214);
        imagesetthickness($image, 5);
        imagerectangle ($image, 2, 2, 297, 47, $border);

        // Set username
        imagestring($image, $boldFont, (150 - ($usernameFontWidth * (strlen($username) / 2))), 7, $username, (($trustsInfos['warning']) ? $warning : $blue));

        // Set positive
        imagestring($image, (($trustsInfos['warning']) ? $boldFont : ((intval($trustsInfos['trusts'][0]) > 0) ? $boldFont : $normalFont)), 40, 25, $trustsInfos['trusts'][0], (($trustsInfos['warning']) ? $red : ((intval($trustsInfos['trusts'][0]) > 0) ? $green : $black)));

        // Set first slash
        imagestring($image, (($trustsInfos['warning']) ? $boldFont : $normalFont), 90, 25, '|', (($trustsInfos['warning']) ? $red : $black));

        // Set neutral
        imagestring($image, (($trustsInfos['warning']) ? $boldFont : $normalFont), (150 - (($trustsFontWidth * strlen($trustsInfos['trusts'][1])) / 2)), 25, $trustsInfos['trusts'][1], (($trustsInfos['warning']) ? $red : $black));

        // Set second slash
        imagestring($image, (($trustsInfos['warning']) ? $boldFont : $normalFont), 205, 25, '|', (($trustsInfos['warning']) ? $red : $black));

        // Set negative
        imagestring($image, ((intval($trustsInfos['trusts'][2]) < 0) ? $boldFont : $normalFont), 245, 25, $trustsInfos['trusts'][2], (($trustsInfos['warning']) ? $red : ((intval($trustsInfos['trusts'][2]) < 0) ? $orange : $black)));

        // Return image
        imagepng($image);
        imagedestroy($image);
    }
}
?>
