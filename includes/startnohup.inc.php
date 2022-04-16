<?php

exec("ps | grep ^sh$", $pids);
if(empty($pids)) {
  shell_exec("nohup sh -c 'while true; do php /var/www/mrpnl.com/public_html/myaccount/phpcheck/checkorders0.php; done' > /var/www/mrpnl.com/public_html/myaccount/phpcheck/log.txt &");
  shell_exec("php /var/www/mrpnl.com/public_html/myaccount/phpcheck/checkorders0.php");
}


 ?>
