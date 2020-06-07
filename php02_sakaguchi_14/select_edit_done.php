<!-- php（DBと連携） -->
<?php
//1.  DBに接続
try {

$done_id = $_POST["id"];
$done_book = $_POST["book"];
$done_url = $_POST["url"];
$done_review = $_POST["review"];

$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ更新SQL作成
$stmt = $pdo->prepare("UPDATE gs_bm_table SET book='$done_book',url='$done_url',review='$done_review'  WHERE id=$done_id");
$status = $stmt->execute();

// //３．データ表示
// $view="";
// if($status==false){
//   //execute（SQL実行時にエラーがある場合）
//   $error = $stmt->errorInfo();
//   exit("ErrorQuery:".$error[2]);
// }else{
//   //Selectデータの数だけ自動でループ $resultの中に「カラム名」が入ってくるのでそれを表示
//   while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
//       $edit_date = $result["date"];
//       $edit_temperature = $result["temperature"];
//   }

// }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ブックマークリスト</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" />
<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録画面へ</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] $view-->
<div>
    <form method="post" action="#">
      <div class="form">
        <div class="container">
            <h3>●以下のとおり修正しました。</h3>
            <table border="1" width="500" cellspacing="0" cellpadding="5" bordercolor="#333333" class="book_table">
            <tr>
            <th width="150px">書籍名</th>
            <th width="150px">ＵＲＬ</th>
            <th width="200px">書評</th>
            </tr>
            <tr>
            <td width="150px"><?php echo $done_book;?></th>
            <td width="150px"><?php echo $done_url;?></th>
            <td width="200px"><?php echo $done_review;?></th>
            </tr>
            </table>
        </div>
      </div>
    </form>
</div>
<!-- Main[End] -->

</body>
</html>
