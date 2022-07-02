<?php
// This is only to make sure the charset is UTF-8
// You may remove this line.
header('Content-Type: text/html; charset=utf-8');

// The class is in the folder classes
require 'classes/TPEpubCreator.php';

// load du lieu
$file = 'http://res.cloudinary.com/fivegins/raw/upload/v1656517312/luufiles/Tr%E1%BB%9F_Th%C3%A0nh_Th%C3%A1nh_Nh%C3%A2n_L%C3%A0_Lo%E1%BA%A1i_G%C3%AC_Tr%E1%BA%A3i_Nghi%E1%BB%87m_1_eay2jm.txt';
$nd = file_get_contents($file);

$data = explode("[nextpage]", $nd);
array_shift($data);

// Here we go
$epub = new TPEpubCreator();

// Temp folder and epub file name (path)
$epub->temp_folder = 'temp_folder/';
$epub->epub_file = 'epubs/epub_name2.epub';

// E-book configs
$epub->title = 'Epub title';
$epub->creator = 'Luiz Otávio Miranda';
$epub->language = 'pt';
$epub->rights = 'Public Domain';
$epub->publisher = 'http://www.tutsup.com/';

// You can specity your own CSS
$epub->css = file_get_contents('base.css');

// $epub->uuid = '';  // You can specify your own uuid

// them chap
foreach ($data as $row) {
    preg_match('/\[chuong\](.*?)\[\/chuong\]/', $row, $chuong);
    preg_match('#\[nd\](.*?)\[\/nd\]#is', $row, $nd2);
    $epub->AddPage( nl2br($nd2[1]), false, $chuong[1] );
}

// Create the EPUB
// If there is some error, the epub file will not be created
if ( ! $epub->error ) {

    // Since this can generate new errors when creating a folder
    // We'll check again
    $epub->CreateEPUB();
    
    // If there's no error here, you're e-book is successfully created
    if ( ! $epub->error ) {
        echo 'Success: Download your book <a href="' . $epub->epub_file . '">here</a>.';
    }
    
} else {
    // If for some reason you're e-book hasn't been created, you can see whats
    // going on
    echo $epub->error;
}
