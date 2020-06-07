<!-- php（DBと連携） -->
<?php
//1.  DBに接続
try {

$edit_id = $_POST["id"];

$pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost','root','');
} catch (PDOException $e) {
  exit('データベースに接続できませんでした。'.$e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table WHERE id=$edit_id");
$status = $stmt->execute();

//３．データ表示
$view="";
if($status==false){
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:".$error[2]);
}else{
  //Selectデータの数だけ自動でループ $resultの中に「カラム名」が入ってくるのでそれを表示
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
      $edit_book = $result["book"];
      $edit_url = $result["url"];
      $edit_review = $result["review"];
  }

}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ブックマークリスト</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php">ブックマーク一覧へ</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- ここからinsert.phpにデータを送ります -->
<form method="post" action="select_edit_done.php">

<!-- idをhiddenで次の画面へパス -->
<input type="hidden" name="id" value="<?php echo $edit_id;?>">
<!-- idをhiddenで次の画面へパス -->

  <div class="background-color">
   <fieldset>
    <legend>正しいデータに修正し、「確定」を押してください。</legend>
     <label>書籍名：<input type="text" name="book" value="<?php echo $edit_book;?>"></label><br>
     <label>ＵＲＬ：<input type="text" name="url" value="<?php echo $edit_url;?>"></label><br>
     <label>書評：<br><textArea name="review" rows="4" cols="40"><?php echo $edit_review;?></textArea></label><br>
     <input type="submit" value="確定">
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>

