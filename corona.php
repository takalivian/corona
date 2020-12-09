<?php

$url="https://services6.arcgis.com/5jNaHNYe2AnnqRnS/arcgis/rest/services/COVID19_JapanData/FeatureServer/0/query?where=%E9%80%9A%E3%81%97%3E0&returnIdsOnly=false&returnCountOnly=false&&f=pgeojson&outFields=*&orderByFields=%E9%80%9A%E3%81%97";
$json=file_get_contents($url);
//$json=mb_detect_encoding($json,'UTF-8','ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
$arr=json_decode($json,true);

$total = count($arr['features']);

for($i=0; $i<=$total; $i++) {
  echo $arr['features'][$i]["properties"]["受診都道府県"]."<br>";
}

// foreach($arr as $data => $key){
  //   $ja= "都道府県名　".$data['name_ja']."\n"."<br>".PHP_EOL;
  //   $cases= "発生件数　　".$data['cases']."人\n"."<br>".PHP_EOL;
  //   $deaths= "死者数　　　".$data['deaths']."人\n"."<br>".PHP_EOL;
  //   $pcr= "pcr件数　　".$data['pcr']."人\n"."<br>".PHP_EOL;
  //  $virusData= array(
  //     $ja,$cases,$deaths,$pcr,
  //  );
// echo implode('',$virusData);
// }

?>


<!-- #都道府県別コロナ感染者数集計

#課題内容
https://jag-japan.com/covid19map-readme/
上記ページからCSVまたAPIにてデータを取得し、都道府県別の感染者数を集計してください。

都道府県の識別は”受信都道府県”カラムを利用してください。
感染日の識別は"確定日"カラムを利用してください。

#制限時間
90分間

#評価観点
-集計結果の正確性
-集計パターン(受診日ごとの分析等、高度な分析ができればなお可)
-集計結果の見やすさ(グラフ等でわかりやすく視覚化できればなお可) -->