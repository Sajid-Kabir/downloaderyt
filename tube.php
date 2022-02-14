<?php

$out1["thumbnail_url"]="http://stateschronicle.com/wp-content/uploads/2014/08/YouTube-Music-Key.jpg";

$out1["title"]="";

$out1["author"]="";

$out1["view_count"]="";

$out1["length_seconds"]="";

function getfile($url){

    $ch=curl_init();

    curl_setopt($ch,CURLOPT_URL,$url);

    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

    $data=curl_exec($ch);

    curl_close($ch);

    return $data;

}

if($_SERVER['REQUEST_METHOD']=="POST"){

    $ul=$_POST["tube"];

    parse_str($ul,$out);

    foreach($out as $key => $value){

        $val=$value;

    }

    $url="https://www.youtube.com/get_video_info?video_id=" . $val;

    $p=getfile($url);

    parse_str($p,$out1);

    if($out1["status"]!="ok"){

        header("location:tube.php");

        exit();

        }

    $map=$out1["url_encoded_fmt_stream_map"];

    $maparr=explode(",",$map);

}

?>

<!DOCTYPE html>

<html>

    <head>

        <meta charset="utf8">

        <title>Data Video</title>

        <style>

            body{

                margin: 0;

                font-family: arial,tahoma;

                background-color: #9f8c8c;

                font-weight: bold;

                font-size: 18px;

                color: #6b283d;

            }

            .phar{

                text-align:center;

            }

            .parent{

                margin: 60px auto;

                width: 700px;

             <?php if($_SERVER['REQUEST_METHOD']=="POST"){

                echo "height: 575px;";

                echo "background-color: #838387cc;";} ?>

                padding: 19px;

            }

            form{

                margin-bottom: 20px;

            }

            form input[type="text"]{

                background-color: #555c27;

                border-radius:2%;

                width: 588px;

                height: 35px;

                border: none;

            }

            form input[type="submit"]{

                background-color: #555c27;

                border-radius: 2%;

                width: 105px;

                height: 35px;

                border: none;

            }

            .child1{

                float: left;

                width: 141px;

                height: 190px;

                margin-top: 20px;

                padding-left: 37px;

            }

            img{

                width: 130px;

                height: 100px;

            }

            p{

                margin-top: 40px;

                line-height: 0px;

            }

            table{

                width:100%;

            }

            tbody tr{

                text-align: center;

            }

            tbody tr td{

                width:33%;

                padding:10px;

            }

            a{

                text-decoration:none;

            }

        </style>

    </head>

    <body>

        <div class="phar">HI, Insert A Valide Link Youtube For Download Your Video</div>

        <div class="parent">

            <form action="tube.php" method="post">

                <input type="text" name="tube">

                <input type="submit" name="submit">

            </form>

<?php

if($_SERVER['REQUEST_METHOD']=="POST"){

    ?>

            <div class="child1">

                <img src="<?php echo $out1["thumbnail_url"]?>" alt="image">

            </div>

            <div class="child2">

                <p>Title : <?php echo $out1["title"]?></p>

                <p>Channel : <?php echo $out1["author"]?></p>

                <p>View : <?php echo $out1["view_count"]?></p>

                <p>Duré Video : <?php echo $out1["length_seconds"]?></p>

            </div>

            <table border="0">

                <tr>

                    <td>Type</td>

                    <td>Quality</td>

                    <td>Download</td>

                </tr>

<?php

            foreach($maparr as $mapa){

                parse_str($mapa,$out2);

                    $arra=explode(";",$out2["type"]);

                    $type=$arra[0];

                    echo "<tr>";

                        echo "<td>".$type."</td>";

                        echo "<td>".$out2["quality"]."</td>";

                        echo "<td><a target='_blank' href='".$out2["url"]."'>Download</a></td>";

                    echo "</tr>";

                }

            echo "</table>";

            }

?>

        </div>

    </body>

</html>
