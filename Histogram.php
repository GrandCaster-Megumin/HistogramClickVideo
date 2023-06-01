<!--Ctrl + D	選取一樣字-->
<?php
header("Content-Type:text/html;charset=big5");
//改IP用
$wt_IP = "192.168.1.108";
// 读取文件内容
$fileContent = file_get_contents("http://{$wt_IP}/output.txt");
$fileContent = str_replace(["\r", " "], "", $fileContent);
$fileContent = str_replace(["\n", " "], "*", $fileContent);
if (isset($_GET['courseID'])) {
    $courseID = $_GET['courseID'];
} else {
    $courseID = 409432158;
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></sc>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../webCSS/userPageStyle.css">
</head>
<body id="body">
<?php
  include "../includePHP/checkUserPer.php";
?>
<!-- 可以放1cm -->
<div class="container" id="mainContainer" style="padding-top:0cm;">
    <!-- mainNav.php -->
    <nav class="navbar navbar-expand-md bg-light navbar-light">
        <a class="navbar-brand" href="../system/index.php">
            <img src="../webImage/SmartMeet.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
            <?=iconv("UTF-8","big5","智會-SmartMeet"); ?>
        </a>  <!-- Logo 放置處 -->
    
        <!-- 就是當畫面縮小時，摺疊起來的按鈕圖示 -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#link">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="link">
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="../system/errorReport.php" id="userNavLink"><?=iconv("UTF-8","big5","問題回報"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../system/message.php" id="userNavLink"><?=iconv("UTF-8","big5","系統公告"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../system/eula.php" id="userNavLink"><?=iconv("UTF-8","big5","使用者條約"); ?></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="../user/loginPage.php" id="userNavLink"><?=iconv("UTF-8","big5","開始使用"); ?></a>
            </li>
            </ul>
        </div>
    </nav>
<!-- mainNav.php -->
    <div class="row">
        <div class="col-md-2">
        <img src="
        <?php
            $sql = "SELECT * FROM userInfo WHERE userAccount ='{$_SESSION["userAccount"]}'";
            $result=mysqli_query($conn,$sql);                                                               //connection,query(查詢字串);回傳result
            $data = mysqli_fetch_assoc($result);
                                            //userInfo資料表裡是否有使用者圖片
            if($data["userImage"]==1){
            $userImagePath = "../userImage/{$_SESSION['userAccount']}.jpg";
            echo $userImagePath;
            }else{                            //沒有則使用預設圖片
            $userImagePath = "../userImage/default.jpg";
            echo $userImagePath;
            }
            $vote = "D:/xampp/htdocs/htmlPhp/files/{$courseID}/*.json";
            $vote = glob($vote);
            $vote = $vote[0];
            $vote = basename($vote);
            //聊天室窗放文字
            $fileContent2=file_get_contents("http://{$wt_IP}/output2.txt");
            // 讀取投票用JSON檔案內容
            $jsonData = file_get_contents("http://{$wt_IP}/htmlPhp/files/{$courseID}/{$vote}");
            // 解析JSON資料為PHP陣列或物件  
            $data = json_decode($jsonData, true);
            /*
                    // 檔案下載區 備註如果"get" function會讀不到 不能包在function裡
                    echo iconv("UTF-8","big5","<b>檔案下載區<b><br>");
                    $test = "D:/xampp/htdocs/htmlPhp/files/{$courseID}/*.*";
                    $fileList = glob($test);//
                    // 使用 for 迴圈遍歷檔案列表
                    for ($i = 0; $i < count($fileList); $i++) {
                        $filename = $fileList[$i];
                        $nofilepath = basename($filename);
                        echo iconv("UTF-8","big5","<a href=Download.php?filename=http://{$wt_IP}/htmlPhp/files/{$courseID}/{$nofilepath}> 下載{$nofilepath}</a><br>");
                    }
            */
        ?>
        " class="img-fluid" alt="使用者圖片" style="display:block; margin:auto;">
        <?php
            echo "<p align=\"center\">Hi, {$_SESSION['userAccount']}</p>";
        ?>
        <!-- usernav -->
        <nav class="navbar justify-content-center navbar-light bg-light">
            <ul class="navbar-nav">
                <li class="nav-item" id="userNavLink">
                    <a class="nav-link" href="../user/userPage.php"><?=iconv("UTF-8","big5","回使用者主頁"); ?></a>
                </li>
                <li class="nav-item" id="userNavLink">
                    <a class="nav-link" href="../user/HisMeetPage.php"><?=iconv("UTF-8","big5","所有歷史會議"); ?></a>
                </li>
                <li class="nav-item" id="userNavLink">
                    <a class="nav-link" href="../user/FutMeetPage.php"><?=iconv("UTF-8","big5","所有已排定會議"); ?></a>
                </li>
                <li class="nav-item" id="userNavLink">
                    <a class="nav-link" href="../user/bookingPage.php"><?=iconv("UTF-8","big5","發起會議"); ?></a>
                </li>
                <li class="nav-item" id="userNavLink">
                    <a class="nav-link" href="../user/joinPage.php"><?=iconv("UTF-8","big5","加入會議"); ?></a>
                </li>
                <li class="nav-item" id="userNavLink">
                <a class="nav-link" href="../user/logout.php"><?=iconv("UTF-8","big5","登出"); ?></a>
                </li>
            </ul>
            </nav>
            <!-- /usernav -->
        </div>
        <div class="col-5 text-center">
            <div class="ratio ratio-16x9">
                <video id="playback_video">
                <?="<source src='http://{$wt_IP}/2_13.mkv'>"; ?>
                    <!-- <source src="http://127.0.0.1/2_13.mkv"> -->
                    Your browser does not support the video tag.
                </video>  
            </div>
            <div id=whsl></div>
                <?="<img id='img' width='440' height='330' src='http://127.0.0.1/all_sleep.png' alt=''>"; ?>
                <canvas id="canvas" width="440" height="330">
                    Sorry, your browser doesn't support the &lt;canvas&gt; element.
                </canvas>
        </div>
        <div class="col-1 ">
        </div>
        <div class="col-3 ">
            <div id="messegeShow" style="white-space: pre-line; overflow: auto; height: 40vh;" class="bg-secondary bg-opacity-10  area w-70">
             <?="{$fileContent2} \n123"?>
            </div>
            <div id="file_manager" style="white-space: pre-line; overflow: auto; height: 10vh;" class="bg-info bg-opacity-10  area w-70">
                <?php
                    // 檔案下載區 備註如果"get" function會讀不到 不能包在function裡
                    echo iconv("UTF-8","big5","<b>檔案下載區<b><br>");
                    $test = "D:/xampp/htdocs/htmlPhp/files/{$courseID}/*.*";
                    $fileList = glob($test);//
                    // 使用 for 迴圈遍歷檔案列表
                    for ($i = 0; $i < count($fileList); $i++) {
                        $filename = $fileList[$i];
                        $nofilepath = basename($filename);
                        echo iconv("UTF-8","big5","<a href=Download.php?filename=http://{$wt_IP}/htmlPhp/files/{$courseID}/{$nofilepath}> 下載{$nofilepath}</a><br>");
                    }
                ?>
            </div>
            <div id="voteShow" style="white-space: pre-line; overflow: auto; height: 20vh;" class="bg-success bg-opacity-10  area w-70">
             <?php 
                for($i=1;$i<count($data);$i=$i+1)
                {
                    echo iconv("UTF-8","big5","第{$data[$i]["num"]}次投票\n投票主題 {$data[$i]["name"]}\n");
                    for ($j=0; $j <count($data[$i]["option"])-1; $j++) 
                    { 
                        echo iconv("UTF-8","big5","{$data[$i]["option"][$j]["voteOption"]}");
                        if ($data[$i]["option"][$j]["numOfVotes"]) {
                            echo iconv("UTF-8","big5"," 獲選");
                        }
                        echo "\n";
                    }
                }
             ?>
            </div>
        </div>
    </div>
    <!-- foot -->
    <style>

    </style>
    <div class="container" style="min-height: 72px;">
    </div>
    <footer class="container fixed-bottom">
        <div id="systemContactInfo">
            <div><?=iconv("UTF-8","big5","具智慧化行為分析的會議系統"); ?></div>
            <div><?=iconv("UTF-8","big5","聯絡資訊:MNELMeetingsystem@nfu.edu.tw"); ?></div>
            <div><?=iconv("UTF-8","big5","製作者:陳瑞鑫，陳懋昕，蘇偉勝，蘇富羿"); ?></div>
        </div>
    </footer>
    <!-- foot -->
</div>

</body>

</html>
<script>

//自訂暫時測資
let te_start_time="8:00"
let te_time = te_start_time
function find_aim_time(start_time,the_num) {
        te=start_time.split(':')
        te_h=Number(te[0])
        te_m=Number(te[1])
        te_m=te_m+the_num*5
        if(te_m>=60)
        {
            te_m=te_m-60
            te_h=te_h+1
        }
        if(te_m<10)
        {
            te_m="0"+te_m
        }
        return te_h+':'+te_m
    }

    const video = document.getElementById('playback_video');


    var whsl_div = document.getElementById('whsl');
    var canvas = document.getElementById('canvas');
    var ctx = canvas.getContext('2d');
    var img = document.getElementById('img');
    img.crossOrigin = "Anonymous";
    img.onload = function () {
        ctx.drawImage(img, 0, 0);
        //let imageData = ctx.getImageData(0, 0, canvas.width, canvas.height)
        lookimgpixe()
        put_aim_img();
    };
    function put_aim_img() {
        var imge = new Image();
        imge.src = "http://127.0.0.1/all.png";//127.0.0.1
        imge.crossOrigin = "Anonymous";
        imge.onload = function () {
            ctx.drawImage(imge, 0, 0);
        };
    }

    //不想照片影響思緒
    img.setAttribute("style", "display:none");
    //todo尋找同學A絕對位置
    let blue_part = [], split_blue = []
    function lookimgpixe() {
        let find_blue
        for (i = 0; i < canvas.width; i++) {
            find_blue = ctx.getImageData(i, 180, 1, 1)
            if (find_blue.data[0] > 10 && find_blue.data[0] < 60 && find_blue.data[1] > 90 && find_blue.data[1] < 150 && find_blue.data[2] > 150 && find_blue.data[2] < 210) {
                //console.log("i = " + i)
                blue_part.push(i);
            }

            // console.log("i = " + i)
            // console.log("r = " + find_blue.data[0])
            // console.log("g = " + find_blue.data[1])
            // console.log("b = " + find_blue.data[2])
            // console.log("a = " + find_blue.data[3])
        }
        console.log("圖藍色區域 = " + blue_part)
        for (i = 1, f = 0; i < blue_part.length; i++) {
            if (blue_part[i] - 1 != blue_part[i - 1]) {
                split_blue.push(blue_part[i])
            }
        }
        console.log("圖藍色地方分區 = " + split_blue)
    }
    function find_who_sleep(te_time) {
    whsl_div.innerText="Sleeper name ="
    let output_txt ="<?=$fileContent?>";
    output_txt = output_txt.split('*')
    sl_name=[]
        for(i=0;i<output_txt.length;i++)
        {
            let need_fix=output_txt[i].split('/')
            console.log(need_fix)
            if(need_fix[4]==te_time)
            {
                sl_name.push(need_fix[0]);
                //console.log(need_fix[0]+' in '+need_fix[4]+" sleeping")
                //whsl_div.innerText=whsl_div.innerText+" "+need_fix[0]
            }
        }
        whsl_div.innerText="Sleep number = "+sl_name.length+" Member ="
        for(i=0;i<sl_name.length;i++)
        {
            whsl_div.innerText=whsl_div.innerText+" "+sl_name[i]
        }
    }

    var x = 0;
    var y = 0;

    function getMousePos(canvas, evt) {
        var rect = canvas.getBoundingClientRect();
        //getBoundingClientRect 取得物件完整座標資訊，包含寬高等
        return {
            x: evt.clientX - rect.left,
            y: evt.clientY - rect.top
        };
        //這個function將會傳回滑鼠在 _canvas上的座標
    };

    function mouseMove(evt) {
        var mousePos = getMousePos(canvas, evt);
        //透過getMousePos function 去取得滑鼠座標
    };

    canvas.addEventListener('mousedown', function (evt) {
        var mousePos = getMousePos(canvas, evt);
        //從按下去就會執行第一次的座標取得
        //evt.preventDefault(); 
        //canvas.addEventListener('mousemove', mouseMove, false); 
        let thepixe = ctx.getImageData(mousePos.x, mousePos.y, 1, 1)
        if (thepixe.data[0] > 10 && thepixe.data[0] < 60 && thepixe.data[1] > 90 && thepixe.data[1] < 150 && thepixe.data[2] > 150 && thepixe.data[2] < 210) {
            let the_split = 0;
            while (mousePos.x > split_blue[the_split] - 1) {
                the_split = the_split + 1
            }
            console.log("blue is the = " + the_split)
            video.currentTime = the_split * 5;//調時間
            te_time=find_aim_time(te_time,the_split)
            find_who_sleep(te_time)
            te_time=te_start_time
        }
        //console.log(ctx.getImageData(245, 180, 1, 1))
        console.log("r = " + thepixe.data[0])
        console.log("g = " + thepixe.data[1])
        console.log("b = " + thepixe.data[2])
        console.log("a = " + thepixe.data[3])
        console.log("x = " + mousePos.x)
        console.log("y = " + mousePos.y)
        //canvas.addEventListener('mousemove',mouseMove)
        //mousemove的偵聽也在按下去的同時開啟
    });

    canvas.addEventListener('mouseup', function () {
        //canvas.removeEventListener('mousemove', mouseMove, false);
    }, false);
    //如果滑鼠放開，將會停止mouseup的偵聽
</script>