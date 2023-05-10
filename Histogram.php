<!--Ctrl + D	選取一樣字-->
<?php
header("Content-Type:text/html;charset=big5");
// 读取文件内容
$fileContent = file_get_contents("http://127.0.0.1/output.txt");
$fileContent = str_replace(["\r", " "], "", $fileContent);
$fileContent = str_replace(["\n", " "], "*", $fileContent);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body id="body">
    <video width="600" height="400" controls id="playback_video">
        <source src="http://127.0.0.1/2_13.mkv">
        Your browser does not support the video tag.
    </video>
    <button onclick="skipBackward()">-10s</button>
    <button onclick="skipForward()">+10s</button>
    <button onclick="lookimgpixe()">find</button>
    <div id=whsl></div>
    <img id="img" width="440" height="330" src="http://127.0.0.1/all_sleep.png" alt="">
    <canvas id="canvas" width="440" height="330">
        Sorry, your browser doesn't support the &lt;canvas&gt; element.
    </canvas>
    
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

    function skipBackward() {
        video.currentTime = 70;
    }

    function skipForward() {
        video.currentTime += 10;
    }
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
        imge.src = "http://127.0.0.1/all.png";
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
        for(i=0;i<output_txt.length;i++)
        {
            let need_fix=output_txt[i].split('/')
            console.log(need_fix)
            if(need_fix[4]==te_time)
            {
                console.log(need_fix[0]+' in '+need_fix[4]+" sleeping")
                whsl_div.innerText=whsl_div.innerText+" "+need_fix[0]
            }
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
            video.currentTime = the_split * 5;
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