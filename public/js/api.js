
function csrf_token(){
    return $("meta[name=csrf-token]").attr("content");
}

/*
 * リクエストが失敗した場合の処理。基本リロード→最初からやりなおし
 * @return {undefined}
 * 
 */
var $run=true;

function abend(){
    alert("エラーが発生しました。ブラウザをリロードしてください");
}

function async($url, $method = "GET", $data = {}, $reload = true
        ){
    if(!$run){
        abend();
        return false;
    }
    
    if (!$data._token) {
        $data._token = csrf_token();
    }
    $.ajax({
        url: $url,
        method: $method,
        data: $data,
        success: function (data) {

            /*以下書き換え*/
            notify();
            if ($reload) {
                location.reload();
            }
        },
        error: function (err) {
            abend();
        }
    });
    return false;
}