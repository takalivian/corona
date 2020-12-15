<?php

 

$url="https://data.corona.go.jp/converted-json/covid19japan-all.json";

$json=file_get_contents($url);

$arr=json_decode($json,true);

 

$total = count($arr['0']["area"]);

 

for($i=0; $i<$total; $i++) {

  $name[] = $arr[0]["area"][$i]["name_jp"];

  $npa[] = $arr[0]["area"][$i]["npatients"];

}

 

$param = json_encode( $arr );

 

?>

 

<!DOCTYPE html>

<html>

<head>

    <title>Japan Map</title>

    <link rel="stylesheet" href="corona.css">

    <script src="https://code.jquery.com/jquery-1.9.1.min.js" integrity="sha256-wS9gmOZBqsqWxgIVgA8Y9WcQOa7PgSIX+rPA0VL2rbQ=" crossorigin="anonymous"></script>

    <script src="./jquery.japan-map.js"></script>

    <script>

    // PHPからjson取得

    var param = JSON.parse('<?php echo $param; ?>');

    // 都道府県

    var area = param[0]["area"];

 

    </script>

 

    <script>

        $(function(){

            let areas = []

            for (let i = 1; i < 48; i++) {

                // 都道府県

                let pre = area[i-1]["name_jp"]

                // 感染者

                let npa = area[i-1]["npatients"]

                // 色

                if (npa > 10000 ) {

                    let color = "#FF0461"

                    areas.push({"code": i , "name": pre, "color": color, "hoverColor":"#FF367F", "prefectures":[i]})

                } else if( npa > 1000) {

                    let color = "#FFABCE"

                    areas.push({"code": i , "name": pre, "color": color, "hoverColor":"#FFD5EC", "prefectures":[i]})

                } else {

                    let color = "#78FF94"

                    areas.push({"code": i , "name": pre, "color": color, "hoverColor":"#AEFFBD", "prefectures":[i]})

                }

            };

 

            $("#map-container").japanMap({

                width: 800,

                selection: "area",

                areas  : areas,

                backgroundColor : "#f2fcff",

                borderLineColor: "#f2fcff",

                borderLineWidth : 0.25,

                lineColor : "#a0a0a0",

                lineWidth: 1,

                drawsBoxLine: true,

                // 都道府県名表示

                // showsPrefectureName: true,

                prefectureNameType: "short",

                movesIslands : true,

                fontSize : 10,

                onSelect : function(data){

                    for (let i = 0; i < 47; i++) {

                        let pre = area[i]["name_jp"]

                        if (data.name == pre) {

                            alert(data.name + "\n感染者数　" + area[i]["npatients"] + "人")

                            break

                        }

                    }

                }

                // onHover: function(data){

                //     console.log(data);

                // }

            });

        });

 

    </script>

 

</head>

<body>

<div id="map-container"></div>

</body>

</html>