<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-01-17 09:58:47 --> Severity: Warning --> Missing argument 1 for Site::ajax_get_scout_dis_by_region() F:\xampp\htdocs\scouts\application\modules\site\controllers\Site.php 545
ERROR - 2019-01-17 10:42:11 --> Severity: Parsing Error --> syntax error, unexpected ''region_address_bn'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' F:\xampp\htdocs\scouts\application\modules\my_office\controllers\My_office.php 333
ERROR - 2019-01-17 10:51:26 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) F:\xampp\htdocs\scouts\application\modules\site\controllers\Site.php 166
ERROR - 2019-01-17 10:52:02 --> Severity: Parsing Error --> syntax error, unexpected '$this' (T_VARIABLE) F:\xampp\htdocs\scouts\application\modules\site\controllers\Site.php 166
ERROR - 2019-01-17 11:24:39 --> Query error: Unknown column 'r.region_name_bn' in 'field list' - Invalid query: SELECT `sr`.*, `sl`.`service_name`, `r`.`region_name`, `sl`.`service_name_bn`, `r`.`region_name_bn`
FROM `service_request` `sr`
LEFT JOIN `service_list` `sl` ON `sl`.`id`=`sr`.`service_id`
LEFT JOIN `office_region` `r` ON `r`.`id`=`sr`.`serv_region_id`
WHERE `phone` = '01923405632'
ORDER BY `sr`.`id` DESC
ERROR - 2019-01-17 11:24:39 --> Severity: Error --> Call to a member function result() on boolean F:\xampp\htdocs\scouts\application\modules\site\models\Site_model.php 116
ERROR - 2019-01-17 12:37:07 --> Severity: Warning --> Missing argument 1 for Site::ajax_get_scout_dis_by_region() F:\xampp\htdocs\scouts\application\modules\site\controllers\Site.php 545
ERROR - 2019-01-17 15:30:00 --> Severity: Parsing Error --> syntax error, unexpected ''):BanglaConverter::bn2en('' (T_CONSTANT_ENCAPSED_STRING) F:\xampp\htdocs\scouts\application\views\frontend\page_footer.php 362
ERROR - 2019-01-17 15:30:09 --> Severity: Parsing Error --> syntax error, unexpected ''):BanglaConverter::bn2en('' (T_CONSTANT_ENCAPSED_STRING) F:\xampp\htdocs\scouts\application\views\frontend\page_footer.php 362
