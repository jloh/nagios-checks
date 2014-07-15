<?php
 
// Url to the client API
// Do NOT include the trailing slash
$url = "https://example.com:5353";
 
// Specify the key and hash to access the API
$postfields["key"] = "";
$postfields["hash"] = "";
$postfields["action"] = "status";

    // Send the query to the solusvm master
    // Note we have to use GET, POST seems to be broken.
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . "/api/client/command.php?key=".$postfields['key']."&hash=".$postfields['hash']."&action=".$postfields['action']."&bw=true");
    curl_setopt($ch, CURLOPT_TIMEOUT, 20);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
    // Uncomment the two lines below if your host is using a self-signed certificate
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $data = curl_exec($ch);
    curl_close($ch);

    // Parse the returned data and build an array
    preg_match_all('/<(.*?)>([^<]+)<\/\\1>/i', $data, $match);
    $result = array();
    foreach ($match[1] as $x => $y)
    {
      $result[$y] = $match[2][$x];
    }

    // Explode our bandwidth results so we can use them in a array
    $bandwidth_result = explode(',',$result['bw']);
    $bandwidth = $bandwidth_result['3'];

    // Do our checking to see if we've used to much bandwidth
    // At the moment we Warn if usage is above 80% and go Critical if it is above 90%
    // Change the values below if you want a warning earlier
    if ($bandwidth > 90) {
        echo "CRITICAL: ".$bandwidth."% used\n";
        exit(2);
    }
    elseif ($bandwidth > 80) {
        echo "WARNING: ".$bandwidth."% used\n";
        exit(1);
    }
    elseif ($bandwidth < 80) {
        echo "OK: ".$bandwidth."% used\n";
        exit(0);
    }

?>
