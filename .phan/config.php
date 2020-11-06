<?php // .phan/config.php
return [
    // directories to be parsed
    'directory_list' => [
        'app',
        'vendor'
    ],
    // the directories to be excluded from analysis output
    "exclude_analysis_directory_list" => [
        'vendor',
    ],
];