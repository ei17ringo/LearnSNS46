$(function() {
    //いいね処理
    // $('.js-like').on('click', function() {
    $(document).on('click', '.js-like', function() {
        //user_id,feed_id 取得できてるか確認
        //$(this) 今のイベントを発動させた部品
        var feed_id = $(this).siblings('.feed-id').text();
        var user_id = $('#signin-user').text();

        var like_btn = $(this); //押されたボタンそのもの
        var like_count = $(this).siblings('.like_count').text(); //クラス名like_countと指定されてるタグのテキスト

        console.log(feed_id);
        console.log(user_id);

        //ajaxで動作させたい処理を記述
        $.ajax({
          //送信先、送信するデータなどを記載（目的の処理）
          url:'like.php', //実行したいプログラム
          type:'POST', // 送信方法
          datatype: 'json', //受信されてくるデータの形式
          data:{
            'feed_id':feed_id,
            'user_id':user_id,
            'is_liked':true
          }
        })
        .done(function(data){
          //目的の処理が成功した時の処理
          console.log(data);
          if (data == 'true'){
            like_count++; //like_count+1と同じ意味
            like_btn.siblings('.like_count').text(like_count); //プラス１した数字を上書き

            like_btn.removeClass('js-like');  //ボタンからLikeボタンの目印であるクラスjs-likeを削除
            like_btn.addClass('js-unlike'); //ボタンにいいねを取り消すボタンの目印であるクラスjs-unlikeを追加
            like_btn.children('span').text('いいねを取り消す'); //ボタンの表記を変更
          }
        })
        .fail(function(err){
          //目的の処理が失敗した時の処理
          console.log('error');
        })
    })

    //いいねを取り消す処理
   // $('.js-unlike').on('click', function() {
    $(document).on('click', '.js-unlike', function() {
        //user_id,feed_id 取得できてるか確認
        //$(this) 今のイベントを発動させた部品
        var feed_id = $(this).siblings('.feed-id').text();
        var user_id = $('#signin-user').text();

        var like_btn = $(this); //押されたボタンそのもの
        var like_count = $(this).siblings('.like_count').text(); //クラス名like_countと指定されてるタグのテキスト

        console.log(feed_id);
        console.log(user_id);

        //ajaxで動作させたい処理を記述
        $.ajax({
          //送信先、送信するデータなどを記載（目的の処理）
          url:'like.php', //実行したいプログラム
          type:'POST', // 送信方法
          datatype: 'json', //受信されてくるデータの形式
          data:{
            'feed_id':feed_id,
            'user_id':user_id
          }
        })
        .done(function(data){
          //目的の処理が成功した時の処理
          console.log(data);
          if (data == 'true'){
            like_count--; //like_count-1と同じ意味
            like_btn.siblings('.like_count').text(like_count); //マイナス１した数字を上書き

            like_btn.removeClass('js-unlike');
            like_btn.addClass('js-like');
            like_btn.children('span').text('いいね!'); //ボタンの表記を変更
          }
        })
        .fail(function(err){
          //目的の処理が失敗した時の処理
          console.log('error');
        })
    })

});