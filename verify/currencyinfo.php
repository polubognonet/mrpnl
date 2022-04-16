<div class="currencyinfo">
  <?php

  require '../vendor/autoload.php';
  $api = new Binance\API("khIlwP8nFIHdySoLeRR1uPjBGvP1LyWfSEo4pio307oc7FhgipVdmsFzw4OIb57V","AwmjVWVJgXa2TpgrWLDUUaxngM1AEIWPXJSGO9LmBPI45ZokIVyRki1Zze4fMHAr");
  $btc = $api->price("BTCUSDT");
  $eth = $api->price("ETHUSDT");
  $bnb = $api->price("BNBUSDT");
  $link = $api->price("LINKUSDT");
  $ada = $api->price("ADAUSDT");
  $newbtc = number_format($btc, 2, '.', '');
  $neweth = number_format($eth, 2, '.', '');
  $newbnb = number_format($bnb, 2, '.', '');
  $newlink = number_format($link, 2, '.', '');
  $newada = number_format($ada, 2, '.', '');

  echo "<p>BTC: $" . $newbtc . "</p>".PHP_EOL;
  echo "<p>ETH: $" . $neweth . "</p>".PHP_EOL;
  echo "<p>BNB: $" . $newbnb . "</p>".PHP_EOL;
  echo "<p>LINK: $" . $newlink . "</p>".PHP_EOL;
  echo "<p>ADA: $" . $newada . "</p>".PHP_EOL;

   ?>
</div>
