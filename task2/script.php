<?php
//Get request
//    $date_from = $_REQUEST["date_from"];
//    $date_to = $_REQUEST["date_to"];

//хардкод
$api = "3363f0c5";
$id_date[] = 790154; // =??  790154
$id_date[] = 920252; // =??  790154
$id_status_lead[] = 9585810; // =?? 9585810
$id_status_lead[] = 9585816; // =?? 9585810
$id_status_lead[] = 9585813; // =?? 9585813
$array_days = array(30);


for ($i = 0; $i < 30; $i++) {
    $array_days[$i] = 0;
}

//date_default_timezone_set('America/Vancouver');

$current_date = date('Y-m-d');
var_dump(date('Y-m-d H:i:s'));
//var_dump(date_default_timezone_get());
//var_dump(new DateTime("now"));

$current_date_30 = date('Y-m-d', strtotime("+30 days", strtotime($current_date)));

$curl = curl_init(); #Сохраняем дескриптор сеанса cURL
#Устанавливаем необходимые опции для сеанса cURL

$link = "http://api.yadrocrm.ru/tmp/crm/lead/list?";

for ($i = 0; $i < count($id_status_lead); $i++) {
    $link .= "status[]=" . $id_status_lead[$i] . '&';
};
$link .= "key=" . $api;
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_URL, $link);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_COOKIEFILE, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl, CURLOPT_COOKIEJAR, dirname(__FILE__) . '/cookie.txt'); #PHP>5.3.6 dirname(__FILE__) -> __DIR__
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

$out = curl_exec($curl); #Инициируем запрос к API и сохраняем ответ в переменную


$Response = json_decode($out, true);
$leads = $Response["result"];

$sum_leads = 0;
foreach ($leads as $lead) {
    if (!empty($lead["custom_fields"])) {

        foreach ($lead["custom_fields"] as $custom_fields) {
//            if ($custom_fields["id"] == $id_date) {
            if (in_array($custom_fields["id"], $id_date)) {
                $sum_leads += 1;

                $lead_time = date($custom_fields["values"][0]["value"]);
                if ($lead_time > $current_date &&
                    $lead_time <= $current_date_30
                ) {
                    $datediff = strtotime($lead_time) - strtotime($current_date);
//                    var_dump(ceil($datediff/(60*60*24)));
//                    var_dump(ceil(4.3));
                    $array_days[ceil($datediff / (60 * 60 * 24))] += 1;
                }

//                var_dump($lead_time);

            }
        }
    }
}


echo json_encode(array("0" => $array_days));

