<?php
/****************************************
 共通関数読み込み
*****************************************/
require 'function.php';

define('DIR', __DIR__);

// IPアドレスを取得
getIP();

// ページ宣言
$mode = 'contact';

if (isset($_SESSION['mode']) && $_SESSION['mode'] !== $mode) {
    $_SESSION = []; // セッションをする前に空にする
  session_destroy(); // この時点ではセッションは削除されない
  debug('contact.php' . print_r($_SESSION, true));
    debug('   ');
}

// POST送信されていた場合
if (!empty($_POST)) {
    debug('POST送信されている処理です。');
    debug('   ');

    // POST時の値をフォームに表示させるので、確認画面から戻ってきた場合に
    // SESSIONの値を表示させているものをクリアする
    clearSession('name');
    clearSession('email');
    clearSession('subject');
    clearSession('contact');

    // 変数にフォームの値を格納
    $SecondName = $_POST['SecondName']; // 姓
    $FirstName = $_POST['FirstName']; // 名
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $contact = $_POST['contact'];

    // 入力必須
    validRequire($SecondName, 'SecondName');
    validRequire($FirstName, 'FirstName');
    validRequire($email, 'email');
    validRequire($subject, 'subject');
    validRequire($contact, 'contact');

    // バリデーションエラーが無い場合
    if (empty($err_msg)) {
        debug('未入力バリデーションが通った時の処理です。');
        debug('   ');

        // Email形式チェック
        validEmail($email, 'email');
        // 名前が全角かチェック
        validNameText($SecondName, 'SecondName');
        validNameText($FirstName, 'FirstName');

        // 各フォーム文字数チェック
        validMaxLen($SecondName, 'SecondName', 50);
        validMaxLen($FirstName, 'FirstName', 50);
        validMaxLen($email, 'email');
        validMaxLen($subject, 'subject', 50);
        validContactMaxLen($contact, 'contact');

        if (empty($err_msg)) {
            debug('バリデーションOKの時の処理です。');
            debug('   ');

            $_SESSION['SecondName'] = $SecondName;
            $_SESSION['FirstName'] = $FirstName;
            $_SESSION['email'] = $email;
            $_SESSION['subject'] = $subject;
            $_SESSION['contact'] = $contact;
            $_SESSION['transition'] = true;
            $_SESSION['mode'] = $mode;

            header("Location:confirm.php");
            exit();
        }
    }
}
?>

<?php
require "head.php"
?>

<body>
    <div class="container">
        <div class="navbar">
            <h1>お問い合わせフォーム</h1>
        </div>
        <form class="form-horizontal" method="post" action="">
            <div class="form-group">
                <label class="col-sm-2 control-label">お名前 <span class="label label-danger">必須</span></label>
                <div class="col-sm-10">
                    <input type="text" name="SecondName" class="form-control" placeholder="姓" />
                    <div class="c-error__msg">
                        <?php if (!empty($err_msg["SecondName"])) {
    echo sanitize("お名前は") . $err_msg["SecondName"];
} ?>
                    </div>
                    <input type="text" name="FirstName" class="form-control" placeholder="名" />
                    <div class="c-error__msg">
                        <?php if (!empty($err_msg["FirstName"])) {
    echo sanitize("お名前は") . $err_msg["FirstName"];
} ?>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">メールアドレス <span class="label label-danger">必須</span></label>
                <div class="col-sm-10">
                    <input type="email" name="email" class="form-control " placeholder="メールアドレス"
                        value="<?php echo getFormData("email"); ?>" />
                    <div class="c-error__msg">
                        <?php if (!empty($err_msg["email"])) {
    echo sanitize("メールアドレスは") . $err_msg["email"];
} ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"> 件名 <span class="label label-danger">必須</span></label>
                <div class="col-sm-10">
                    <input type="text" name="subject" class="form-control" placeholder="件名" />
                    <div class="c-error__msg c-error__text--contact">
                        <?php if (!empty($err_msg["contact"])) {
    echo sanitize("件名は") . $err_msg["contact"];
} ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label"> お問い合わせ内容 <span class="label label-danger">必須</span></label>
                <div class="col-sm-10">
                    <textarea name="contact" class="form-control <?php if (
                        !empty($err_msg["contact"])
                    ) {
    echo "c-error";
} ?>" placeholder="お問い合わせ内容" cols="10" rows="7"></textarea>
                    <div class="c-error__msg c-error__text--contact">
                        <?php if (!empty($err_msg["contact"])) {
    echo sanitize("お問い合わせ内容は") . $err_msg["contact"];
} ?>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <input type="submit" class="btn btn-default" value="確認する" onclick="return sendContact()">
                </div>
            </div>
        </form>
    </div>

    <?php
require "footer.php"
?>