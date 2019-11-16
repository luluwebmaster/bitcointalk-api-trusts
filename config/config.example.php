<?php

// Warning !!
// Please create a new account for use this API.

$config = [
    'api' => [
        'link' => 'https://api.example.com/trusts/public/api.php' // Change this link by the link of trusts API
    ],
    'login' => [
        'link' => 'https://bitcointalk.org/index.php?action=login2', // Don't change this link
    	'username' => 'root', // Bitcointalk : Username
    	'password' => 'password', // Bitcointalk : Password
    	'captcha-code' => '' // Bitcointalk : Captcha Code ( Can be found with this link : https://bitcointalk.org/captcha_code.php ) ( Copy code after "ccode=" text in the url )
    ],
    'refreshCacheTimeInHours' => 2
];
?>
