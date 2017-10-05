{{--基本Json通信のみとするので表示系は扱わないが、画面サンプル--}}



<html>
    <head>
        <title>{{config("app.name")}}</title>

        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js"></script>

        <script>
            
            $(document).ready(function(){
                $("#BUTTON_HOME").on("click", function () {
                    alert("aaa");
                    }
                );                
                $("#BUTTON_LAUNCH").on("click", function () {
                    alert("aaa");
                    }
                );                
                $("#BUTTON_TEAM").on("click", function () {
                    alert("aaa");
                    }
                );                
                $("#BUTTON_CREATE").on("click", function () {
                    alert("aaa");
                    }
                );                
                $("#BUTTON_REPAIR").on("click", function () {
                    alert("aaa");
                    }
                );                
                $("#BUTTON_CHARGE").on("click", function () {
                    alert("aaa");
                    }
                );     
                $("#BUTTON_UPGRADE").on("click", function () {
                    alert("aaa");
                    }
                );
        
            });

            setInterval(
                    function () {
                        $.ajax({
                            url: "/api/status",
                            success: function(data){
                                
                                var status=data.status;
                                
                                $("#HUD .A .value").text(data.status.A);
                                $("#HUD .B .value").text(data.status.B);
                                $("#HUD .C .value").text(data.status.C);
                                $("#HUD .D .value").text(data.status.D);
                                
                            }
                        });
                        
                        console.log("update");
                    }
            , 6000);
        </script>
    </head>
    <body>
        {{-- 基本メニュー --}}
        <div id="MENU">
            <button id="BUTTON_HOME">home</button>

            <button id="BUTTON_LAUNCH">出撃</button>
            <button id="BUTTON_TEAM">編成</button>
            <button id="BUTTON_CREATE">製造</button>
            <button id="BUTTON_REPAIR">修復</button>
            <button id="BUTTON_CHARGE">補給</button>
            <button id="BUTTON_UPGRADE">改造</button>
        </div>

        {{-- ホーム画面 --}}
        <div id="HOME">

        </div>

        {{-- HUD --}}
        <div id="HUD">
            <label class="A" >燃<span class="value">0</span></label>
            <label class="B">弾<span class="value">0</span></label>
            <label class="C">石<span class="value">0</span></label>
            <label class="D">鉄<span class="value">0</span></label>
        </div>

        {{--通知関連--}}
        <div id="NOTIFY">

        </div>

        {{--シーン描画--}}
        <div id="SCENE">

        </div>

    </body>
</html>