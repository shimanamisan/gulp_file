<?php
require "head.php"
?>

<body>

    <h1 class="c-title c-title__first">Bootstrap Practice</h1>

    <h2 class="c-title c-title__second">Gridシステム</h2>

    <div class="p-articles row">
        <p>12分割を越えているのではみ出している要素がある</p>
        <div class="col-4 bg-primary">
            1
        </div>
        <div class="col-1 bg-danger">
            2
        </div>
        <div class="col-2 bg-success">
            3
        </div>
        <div class="col-4 bg-primary">
            4
        </div>
        <div class="col-2 bg-danger">
            5
        </div>
    </div>

    <h2 class="c-title c-title__second">マルチデバイスに対応させる</h2>

    <div class="p-articles row">
        <div class="col-md bg-primary">
            768px以上になった時のみ画面が分割される col-md
        </div>
        <div class="col-md bg-danger">
            768px以上になった時のみ画面が分割される col-md
        </div>
        <div class="col-md bg-success">
            768px以上になった時のみ画面が分割される col-md
        </div>
    </div>

    <h2 class="c-title c-title__second">マルチデバイスに対応させる2</h2>

    <div class="p-articles row">
        <div class="col-sm-6 col-md bg-primary">
            576px以上は6分割で表示される 768px以上で3分割 col-sm-6 col-md
        </div>
        <div class="col-sm-6 col-md bg-danger">
            576px以上は6分割で表示される 768px以上で3分割 col-sm-6 col-md
        </div>
        <div class="col-sm-12 col-md bg-success">
            576px以上は12分割で表示、768px以上で3分割 col-sm-12 col-md
        </div>
    </div>


    <?php
require "footer.php"
?>