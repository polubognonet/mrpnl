<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php

    require 'vendor/autoload.php';
    $api = new Binance\API("khIlwP8nFIHdySoLeRR1uPjBGvP1LyWfSEo4pio307oc7FhgipVdmsFzw4OIb57V","AwmjVWVJgXa2TpgrWLDUUaxngM1AEIWPXJSGO9LmBPI45ZokIVyRki1Zze4fMHAr");

    $api->ticker("BNBBTC", function($api, $symbol, $ticker) {
	print_r($ticker);
});
     ?>
  </body>
</html>
