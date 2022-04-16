<?php
$dbServername = "localhost";
$dbUsername = "root";
$dbPassword = "Polubognonet1!";
$dbName = "wordpress";

$conn = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

$ch = curl_init("https://min-api.cryptocompare.com/data/top/totaltoptiervolfull?limit=100&tsym=BUSD&api_key=6741ce75532cc5975c3b826d4fd5ad5a6fb8322b80bbde8d58a1d99d31f7470a");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, 0);
$data = curl_exec($ch);
curl_close($ch);
$finaldata = json_decode($data, true);
$datacoins = $finaldata['Data'];
$ad = array();
$result = array();
foreach ($datacoins as $datavalue)
{
    $coinname = $datavalue['CoinInfo'];
    $finalname = $coinname['Name'];
    $coinnubmers = $datavalue['RAW']['BUSD'];
    if ($coinnubmers['CHANGEPCT24HOUR'] > 40) {
    } else {
      $finalnumbers = ($coinnubmers['VOLUMEHOURTO']/50) * ($coinnubmers['VOLUME24HOURTO']/50) * ($coinnubmers['CHANGEPCT24HOUR']*50);
      $ad[$finalname] = $finalnumbers;
    }
}

asort($ad);
$arr = array_reverse($ad);
$result = array_slice($arr, 0, 30);
print_r($result);


$a = array_keys($result);
//$a = array_reverse($as);
print_r($a);

echo "</br>";
echo "</br>";
echo "</br>";

require 'vendor/autoload.php';
$api = new Binance\API("XCLEsx8ZKh5Dy3oDUlTW7K1UB3ShvUsnYSGMPrpFQK44QZ3I1DPcbh27IBc0v4MI", "skXCO4C9HMNpAGj2szTHJwD1SnG8HOqG3J4LRHe9k1LxW8CoTle5JMDHXU7wngZb");

for ($i=0; $i < 30; $i++) {
  $askey = $a[$i];
  $usdtcoin1 = $askey."USDT";
  $usdtcoin = strtoupper($usdtcoin1);
  try {
    $api->price($usdtcoin);
  } catch (\Exception $e) {
    echo $usdtcoin . " asdasdasd" ;
    echo "</br>";
    unset($a[$i]);
  }
}

print_r($a);

$sql_du  = "SELECT * FROM ordershelp";
$resultd = $conn->query($sql_du);
if ($resultd->num_rows > 0) {
    while ($rowas = $resultd->fetch_assoc()) {
      $userorders = $rowas['username'];
      for ($i=1; $i <= 3 ; $i++) {
        $tableName = "orders" . $i;
        $sql1  = "SELECT * FROM `$tableName` WHERE username = '{$userorders}'";
        $resultorders = $conn->query($sql1);
        if ($resultorders->num_rows > 0) {
            while ($roworders = $resultorders->fetch_assoc()) {
              ${"coinorders" . $i} = $roworders['coin'];
              ${"finalcoinor" . $i} = substr(${"coinorders" . $i}, 0, -4);
            }
      }
      }

foreach ($a as $akey)
{
  if ($akey !== "BTC" && $akey !== "ETH" && $akey !== "XRP" && $akey !== "BUSD" && $akey !== "USDT" && $akey !== "USDC" && $akey !== "NFT" && $akey !== $finalcoinor2 && $akey !== $finalcoinor3)
    {

            $cointotrade = $akey . "USDT";
            $finalcoin = strtoupper($cointotrade);
            $ch = curl_init("https://api.binance.com/api/v3/exchangeInfo?symbol={$finalcoin}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            $finaldata = json_decode($data);

            $symbols = $finaldata->symbols;
            $filters = $symbols[0];
            $filters1 = $filters->filters;
            $filters2 = $filters1[2];
            $stepsize = $filters2->stepSize;
            $filters3 = $filters1[3];
            $minNotional = $filters3->minNotional;

            $n1 = 0;
            $n2 = 0;

            if ($minNotional > 10) {
              break;
            }

            $strarray = str_split($stepsize);
            $n11 = 0;
            foreach ($strarray as $strarraykey)
            {
                if ($strarraykey == "0" && $strarraykey !== ".")
                {
                    $n11 = $n11 + 1;
                }
                elseif ($strarraykey == "1")
                {
                    break;
                }
            }

            $filters3 = $filters1[0];
            $tickSize = $filters3->tickSize;
            //echo $tickSize;
            $strarray = str_split($tickSize);
            $n12 = 0;
            foreach ($strarray as $strarraykey)
            {
                if ($strarraykey == "0" && $strarraykey !== ".")
                {
                    $n12 = $n12 + 1;
                }
                elseif ($strarraykey == "1")
                {
                    break;
                }
            }

            echo $finalcoin;
            echo "</br>";

            $coinprice = $api->price("{$finalcoin}");

            if ( ($coinprice>4 && $n11>0 && $n12>0) || ($coinprice>1 && $coinprice<5 && $n11>1 && $n12>1) || ($coinprice<1 && $n11>2 && $n12>2) ) {
              $sql = "UPDATE ordershelp SET coin1 = ?, on1 = ?, one1 = ? WHERE username = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("siis", $akey, $n11, $n12, $userorders);
              $stmt->execute();
              echo $finalcoinor1;
              echo $finalcoinor2;
              echo $finalcoinor3;

              echo "Username is: {$userorders} and 1 coin is" . $akey;
              echo $n11;
              echo $n12;
              echo "</br>";
              break;
            } else {
          }

    }
}

$sql_u = "SELECT * FROM ordershelp WHERE username = '{$userorders}'";
$result = $conn->query($sql_u);
if ($result->num_rows > 0)
{
    while ($row = $result->fetch_assoc())
    {
        $coin1 = $row['coin1'];
    }
}

foreach ($a as $akey)
{
  if ($akey !== "BTC" && $akey !== "ETH" && $akey !== "XRP" && $akey !== "BUSD" && $akey !== "USDT" && $akey !== "USDC" && $akey !== "NFT" && $akey !== $coin1 && $akey !== $finalcoinor1 && $akey !== $finalcoinor3)
    {

            $cointotrade = $akey . "USDT";
            $finalcoin = strtoupper($cointotrade);
            $ch = curl_init("https://api.binance.com/api/v3/exchangeInfo?symbol={$finalcoin}");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            $data = curl_exec($ch);
            curl_close($ch);
            $finaldata = json_decode($data);

            $symbols = $finaldata->symbols;
            $filters = $symbols[0];
            $filters1 = $filters->filters;
            $filters2 = $filters1[2];
            $stepsize = $filters2->stepSize;
            $filters3 = $filters1[3];
            $minNotional = $filters3->minNotional;

            $n2 = 0;

            if ($minNotional > 10) {
              break;
            }

            $strarray = str_split($stepsize);
            $n21 = 0;
            foreach ($strarray as $strarraykey)
            {
                if ($strarraykey == "0" && $strarraykey !== ".")
                {
                    $n21 = $n21 + 1;
                }
                elseif ($strarraykey == "1")
                {
                    break;
                }
            }

            $filters3 = $filters1[0];
            $tickSize = $filters3->tickSize;
            //echo $tickSize;
            $strarray = str_split($tickSize);
            $n22 = 0;
            foreach ($strarray as $strarraykey)
            {
                if ($strarraykey == "0" && $strarraykey !== ".")
                {
                    $n22 = $n22 + 1;
                }
                elseif ($strarraykey == "1")
                {
                    break;
                }
            }

            $coinprice = $api->price("{$finalcoin}");

            if ( ($coinprice>4 && $n21>0 && $n22>0) || ($coinprice>1 && $coinprice<5 && $n21>1 && $n22>1) || ($coinprice<1 && $n21>2 && $n22>2) ) {
              $sql = "UPDATE ordershelp SET coin2 = ?, on2 = ?, one2 = ? WHERE username = ?";
              $stmt = $conn->prepare($sql);
              $stmt->bind_param("siis", $akey, $n21, $n22, $userorders);
              $stmt->execute();
              echo $finalcoinor1;
              echo $finalcoinor2;
              echo $finalcoinor3;
              echo "Username is: {$userorders} and 2 coin is" . $akey;

              echo $n21;
              echo $n22;
              echo "</br>";

              break;
            } else {
          }
    }
}

$sql_d = "SELECT * FROM ordershelp WHERE username = '{$userorders}'";
$result1 = $conn->query($sql_d);
if ($result1->num_rows > 0)
{
    while ($row1 = $result1->fetch_assoc())
    {
        $coin2 = $row1['coin2'];
    }
}

foreach ($a as $akey)
{
  if ($akey !== "BTC" && $akey !== "ETH" && $akey !== "XRP" && $akey !== "BUSD" && $akey !== "USDT" && $akey !== "USDC" && $akey !== "NFT" && $akey !== $coin1 && $akey !== $coin2 && $akey !== $finalcoinor1 && $akey !== $finalcoinor2)
    {
        $cointotrade = $akey . "USDT";
        $finalcoin = strtoupper($cointotrade);
        $ch = curl_init("https://api.binance.com/api/v3/exchangeInfo?symbol={$finalcoin}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $data = curl_exec($ch);
        curl_close($ch);
        $finaldata = json_decode($data);

        $symbols = $finaldata->symbols;
        $filters = $symbols[0];
        $filters1 = $filters->filters;
        $filters2 = $filters1[2];
        $stepsize = $filters2->stepSize;
        $filters3 = $filters1[3];
        $minNotional = $filters3->minNotional;

        $n3 = 0;

        if ($minNotional > 10) {
          break;
        }

        $strarray = str_split($stepsize);
        $n31 = 0;
        foreach ($strarray as $strarraykey)
        {
            if ($strarraykey == "0" && $strarraykey !== ".")
            {
                $n31 = $n31 + 1;
            }
            elseif ($strarraykey == "1")
            {
                break;
            }
        }

        $filters3 = $filters1[0];
        $tickSize = $filters3->tickSize;
        //  echo $tickSize;
        $strarray = str_split($tickSize);
        $n32 = 0;
        foreach ($strarray as $strarraykey)
        {
            if ($strarraykey == "0" && $strarraykey !== ".")
            {
                $n32 = $n32 + 1;
            }
            elseif ($strarraykey == "1")
            {
                break;
            }
        }

        $coinprice = $api->price("{$finalcoin}");
        if ( ($coinprice>4 && $n31>0 && $n32>0) || ($coinprice>1 && $coinprice<5 && $n31>1 && $n32>1) || ($coinprice<1 && $n31>2 && $n32>2) ) {
          $sql = "UPDATE ordershelp SET coin3 = ?, on3 = ?, one3 = ? WHERE username = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("siis", $akey, $n31, $n32, $userorders);
          $stmt->execute();
          echo $finalcoinor1;
          echo $finalcoinor2;
          echo $finalcoinor3;
          echo "Username is: {$userorders} and 3 coin is" . $akey;

          echo $n31;
          echo $n32;
          echo "</br>";

          break;
        } else {
      }
    }
}
}
}

?>
