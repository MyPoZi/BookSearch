<?php
require_once("./phpQuery/phpQuery/phpQuery.php");

if(!isset($_GET['name'])) {
    echo 'URL?name=検索キーワード';
    die();
}

//プロキシ
//$proxy = array(
//    "http" => array(
//        "proxy" => "PROXY:8080",
//        'request_fulluri' => true
//    )
//);
//
//$context = stream_context_create($proxy);
//$html = file_get_contents('http://book.tsuhankensaku.com/hon/index.php?t=booksearch&q=' . urlencode($_GET['name']),false,$context);

$html = file_get_contents('http://book.tsuhankensaku.com/hon/index.php?t=booksearch&q=' . urlencode($_GET['name']));

$phpQueryObj = phpQuery::newDocument($html);
$countDisplay = 1;
foreach ($phpQueryObj["table"]->find('img') as $img){
    $src = $img->getAttribute('src');
    $title_elem = $phpQueryObj["table:nth-child($countDisplay)"]->find('.itemdetail');
    echo $title_elem;
    echo "<img src=$src>
           <form action='index.php' method='post'>
             <input type=hidden name=book_detail value='$title_elem'>
             <input type='hidden' name='img' value='$src'>
             <input type=submit value=追加>
           </form>".'<hr>';
    $countDisplay++;
}
?>