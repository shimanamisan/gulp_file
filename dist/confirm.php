<?php
/****************************************
 共通関数読み込み
*****************************************/
require 'function.php';

if (empty($_SESSION['transition'])) {
    debug(
        '不正に画面遷移してきました。お問い合わせページへ戻ります。confirm.php '
    );
    debug('   ');
    header("Location:index.php");
    exit();
}

debug('POSTの中身を確認しています。confirm.php：' . print_r($_POST, true));
debug('   ');

if (isset($_POST['back']) && $_POST['back']) {
    debug('前のページへ戻る処理です。confirm.php ');
    debug('   ');
    switch (true) {
    case $_SESSION['mode'] === 'contact':
      debug('お問い合わせページへ戻ります。confirm.php ');
      debug('   ');
      unset($_SESSION['csrf_token']);
      header("Location:index.php");
      exit();
      break;
    default:
      debug('エラーが発生しました。トップページへ戻ります。confirm.php ');
      debug('   ');
      unset($_SESSION['csrf_token']);
      header("Location:index.php");
      exit();
  }
}

// セッションに値が入っていたら処理を行う
if (isset($_SESSION)) {
    debug(
        'お問いわせ内容がSESSIONに格納されています。confirm.php ' .
      print_r($_SESSION, true)
    );
    debug('   ');

    if ($_SESSION['mode'] === 'contact') {
        // セッションの値を配列に格納
        $confirm_content = [
      '姓' => $_SESSION['SecondName'],
      '名' => $_SESSION['FirstName'],
      'メールアドレス' => $_SESSION['email'],
      'タイトル' => $_SESSION['subject'],
      'お問い合わせ内容' => $_SESSION['contact'],
    ];
    }

    // トークンがSESSIONにセットされていなければセットする
    if (!isset($_SESSION['csrf_token'])) {
        // CSRF対策用のトークン
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }

    // isset($_POST['send'])で'send'というキーが存在しているかを判定し、存在していれば$_POST['send']の値をチェックする
    // $_POST['send']だけだと、POST送信した際にキーが存在していなかった場合にNoticeエラーになる
    if (isset($_POST['send']) && $_POST['send']) {
        debug(
            'isset($_POST[send]) の判定を見ています。confirm.php ' .
        isset($_POST['send'])
        );
        debug('   ');
        debug(
            'メールを送信する処理です。次の画面へ遷移します。confirm.php ' .
        print_r($_POST, true)
        );
        debug('   ');
        header("Location:finish.php");
        exit();
    }
} else {
    debug('セッションが空だったので前のページへ戻ります。。confirm.php ');
    debug('   ');
    header("Location:contact.php");
    exit();
}
?>

<?php
require "head.php"
?>

<body>
    <div class="container">
        <div class="navbar">
            <h1>内容確認</h1>
        </div>

        <form class="form-horizontal" method="post" action="finish.php">
            <input type="hidden" name="csrf_token" value="<?php echo sanitize(
              $_SESSION['csrf_token']
            ); ?>">
            <div class="form-group">
                <label class="col-sm-2 control-label">お名前</label>
                <div class="col-sm-10">
                    <ul class="list-group">
                        <li class="list-group-item"><?php echo sanitize($_SESSION['SecondName']); ?></li>
                        <li class="list-group-item"><?php echo sanitize($_SESSION['FirstName']); ?></li>
                    </ul>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">メールアドレス </label>
                <div class="col-sm-10">
                    <ul class="list-group">
                        <li class="list-group-item"> <?php echo sanitize($_SESSION["email"]); ?></li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"> 件名 </label>
                <div class="col-sm-10">
                    <ul class="list-group">
                        <li class="list-group-item"> <?php echo sanitize($_SESSION["subject"]); ?></li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"> お問い合わせ内容</label>
                <div class="col-sm-10">
                    <ul class="list-group">
                        <li class="list-group-item"><?php echo sanitize($_SESSION["contact"]); ?></li>
                    </ul>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" value="送信する" onclick="return sendContact()">
                </div>
                <a href="">戻る</a>
            </div>
        </form>
    </div>


    <?php
require "footer.php"
?>