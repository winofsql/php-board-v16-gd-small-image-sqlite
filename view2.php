<!DOCTYPE html>
<html lang="ja">
<head>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta charset="utf-8">
    <title>掲示板</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="client.css?_=<?= time() ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js"></script>
    <link href="lightbox2/css/lightbox.css" rel="stylesheet">
    <script src="model.js?_=<?= time() ?>"></script>

<script>
// **********************************************
// クリップボードデータ用変数
// **********************************************
var clipbpardText = "";

$(function(){

    // **********************************************
    // クリップボード処理オブジェクト
    // **********************************************
    var clipboard = 
        // clipboard_btn クラスに持つボタンが対象
        new ClipboardJS('.body_text' , {
            text: function(trigger) {

                console.log( clipbpardText );

                // clipboard.js に渡す( このデータがクリップポードに転送される )
                return clipbpardText;
            }
        });	

    $(".body_text").on("click", function(){

        clipbpardText = $(this).text();
        clipbpardText = clipbpardText.replace(/^\s+/, "");
        clipbpardText = clipbpardText.replace(/\s+$/, "");

    });


    $(".spanlink").on("click",function(){
        var id = $(this).prop("id");
        id = id.replace(/row/g,"");
        parent.$("#id").val( id );

        var subject = $(this).text();
        parent.$("#subject").val(subject);
        
        // nextAll() : 同一レベル要素を現在位置より後を全て取得
        // 0 : 名前と日付
        var name = $(this).nextAll().eq(0).text();
        name = name.replace(/[ \(]/g,"");
        var awork = name.split(":");
        parent.$("#name").val(awork[0]);

        // 1 : 本文
        var text = $(this).nextAll().eq(1).text();
        text = text.replace(/^\s+/, "");
        text = text.replace(/\s+$/, "");
        parent.$("#text").val(text);
    });

    <?= $clear ?>

});
</script>

</head>

<body>
<div id="data_head" data-kensu="<?= $kensu ?>" class="alert alert-primary">投稿一覧 (<?= $kensu ?>件)</div>
<div id="data_body">
    <span style='color:red'>
        <?php
            foreach( $error as $err ) {
                print "{$err}<br>";
            }
        ?>
    </span>
    <div id="data_entry">
        <?= $log_text ?>
    </div>
</div>

<script src="lightbox2/js/lightbox.js"></script>
</body>
</html>
