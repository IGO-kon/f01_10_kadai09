<?php

//0.外部ファイル読み込み
include('functions.php');



//1.  DB接続します
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT*FROM  gs_bm_table');
$status = $stmt->execute();

//３．データ表示
//,enu
$menu = '<a class="navbar-brand" href="select.php">アンケート管理</a><a class="navbar-brand" href="index.php">アンケート登録</a>';
$menu .= '<a class="navbar-brand" href="logout.php">ログアウト</a>';


$view='';
if($status==false){
  errorMsg($stmt);
}else{
  //Selectデータの数だけ自動でループしてくれる
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<p>';
    $view .= '<a href="detail.php?id='  .  $result['id']  .   '">';  //更新ページへのaタグを作成
    $view .= $result['name'].'['.$result['date'].']';
    $view .= '</a>';
    $view .= '　';

  }
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>

<style>div{padding: 10px;font-size:16px;}</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">データ登録</a>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div>
    <div class="container jumbotron"><?=$view?></div>
  </div>
</div>
<!-- Main[End] -->

</body>
</html>