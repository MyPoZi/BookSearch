<html>
<head>
    <meta http-equiv="Content-Type" content="text/html" charset="UTF-8">
    <title>BookSearch</title>
</head>
<body>
<h1>本を検索</h1>
<form action="search.php" method="get">
    <input type="text" name="name">
    <input type="submit" name="submit" value="検索">
</form>

<?php
$fp = fopen("data.csv","a");
if (isset($_POST["img"])) {
    echo "<h2>追加した本</h2>";
    while (($line = fgetcsv($fp)) !== FALSE) {
        echo "<img src='$line[0]'>";
    }
    $img = htmlspecialchars($_POST["img"]);
    echo "<img src='$img'>";

    fwrite($fp, $img . "\n");
    fclose($fp);
}
?>
<h2>読んだ本</h2>
<?php
$fp = fopen("data.csv","r");
while (($line = fgetcsv($fp))) {
    echo "<img src='$line[0]'>";
    echo "<form style=display:inline><button type='submit' name='delete'>削除🔘</button></form>";
}
fclose($fp)
?>
</body>
</html>