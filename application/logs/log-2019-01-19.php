<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

ERROR - 2019-01-19 12:18:32 --> Severity: Error --> Cannot access empty property F:\xampp\htdocs\scouts\application\modules\site\views\region_details.php 58
ERROR - 2019-01-19 13:00:01 --> Severity: Parsing Error --> syntax error, unexpected ''এয়ার জেলা;' (T_ENCAPSED_AND_WHITESPACE) F:\xampp\htdocs\scouts\application\language\bangla\scouts_lang.php 191
ERROR - 2019-01-19 14:40:41 --> Query error: Unknown column 'ou.upa_name_bn' in 'field list' - Invalid query: SELECT `og`.*, `r`.`region_name`, `od`.`dis_name`, `ou`.`upa_name`, `i`.`name`, `r`.`region_name_en`, `od`.`dis_name_en`, `ou`.`upa_name_bn`, `i`.`name_bn`
FROM `office_groups` `og`
LEFT JOIN `office_region` `r` ON `r`.`id` = `og`.`grp_region_id`
LEFT JOIN `office_district` `od` ON `od`.`id` = `og`.`grp_scout_dis_id`
LEFT JOIN `office_upazila` `ou` ON `ou`.`id` = `og`.`grp_scout_upa_id`
LEFT JOIN `institute` `i` ON `i`.`id` = `og`.`grp_institute_id`
WHERE `og`.`id` = '2703'
AND `og`.`grp_status` = 1
ERROR - 2019-01-19 14:40:41 --> Severity: Error --> Call to a member function num_rows() on boolean F:\xampp\htdocs\scouts\application\modules\site\models\Site_model.php 178
ERROR - 2019-01-19 14:41:53 --> Query error: Unknown column 'ou.upa_name_bn' in 'field list' - Invalid query: SELECT `og`.*, `r`.`region_name`, `od`.`dis_name`, `ou`.`upa_name`, `i`.`name`, `r`.`region_name_en`, `od`.`dis_name_en`, `ou`.`upa_name_bn`
FROM `office_groups` `og`
LEFT JOIN `office_region` `r` ON `r`.`id` = `og`.`grp_region_id`
LEFT JOIN `office_district` `od` ON `od`.`id` = `og`.`grp_scout_dis_id`
LEFT JOIN `office_upazila` `ou` ON `ou`.`id` = `og`.`grp_scout_upa_id`
LEFT JOIN `institute` `i` ON `i`.`id` = `og`.`grp_institute_id`
WHERE `og`.`id` = '2703'
AND `og`.`grp_status` = 1
ERROR - 2019-01-19 14:41:53 --> Severity: Error --> Call to a member function num_rows() on boolean F:\xampp\htdocs\scouts\application\modules\site\models\Site_model.php 178
ERROR - 2019-01-19 14:46:41 --> Query error: Unknown column 'og.grp_name_en' in 'field list' - Invalid query: SELECT `u`.*, `r`.`region_name`, `od`.`dis_name`, `ou`.`upa_name`, `og`.`grp_name`, `og`.`grp_charter`, `r`.`region_name_en`, `od`.`dis_name_en`, `ou`.`upa_name_en`, `og`.`grp_name_en`
FROM `office_unit` `u`
LEFT JOIN `office_groups` `og` ON `og`.`id` = `u`.`unit_sc_grp_id`
LEFT JOIN `office_region` `r` ON `r`.`id` = `u`.`unit_region_id`
LEFT JOIN `office_district` `od` ON `od`.`id` = `u`.`unit_scout_dis_id`
LEFT JOIN `office_upazila` `ou` ON `ou`.`id` = `u`.`unit_scout_upa_id`
WHERE `u`.`id` = '1432'
AND `u`.`unit_status` = 1
ERROR - 2019-01-19 14:46:41 --> Severity: Error --> Call to a member function num_rows() on boolean F:\xampp\htdocs\scouts\application\modules\site\models\Site_model.php 198
ERROR - 2019-01-19 14:46:56 --> Query error: Unknown column 'ou.upa_name_bn' in 'field list' - Invalid query: SELECT `u`.*, `r`.`region_name`, `od`.`dis_name`, `ou`.`upa_name`, `og`.`grp_name`, `og`.`grp_charter`, `r`.`region_name_en`, `od`.`dis_name_en`, `ou`.`upa_name_bn`, `og`.`grp_name_bn`
FROM `office_unit` `u`
LEFT JOIN `office_groups` `og` ON `og`.`id` = `u`.`unit_sc_grp_id`
LEFT JOIN `office_region` `r` ON `r`.`id` = `u`.`unit_region_id`
LEFT JOIN `office_district` `od` ON `od`.`id` = `u`.`unit_scout_dis_id`
LEFT JOIN `office_upazila` `ou` ON `ou`.`id` = `u`.`unit_scout_upa_id`
WHERE `u`.`id` = '1432'
AND `u`.`unit_status` = 1
ERROR - 2019-01-19 14:46:56 --> Severity: Error --> Call to a member function num_rows() on boolean F:\xampp\htdocs\scouts\application\modules\site\models\Site_model.php 198
ERROR - 2019-01-19 15:14:12 --> Could not find the language line "site_select_scout_region"
ERROR - 2019-01-19 15:14:24 --> Could not find the language line "site_select_scout_region"
ERROR - 2019-01-19 15:14:50 --> Severity: Parsing Error --> syntax error, unexpected ''upa_address_en'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' F:\xampp\htdocs\scouts\application\modules\my_office\controllers\My_office.php 235
ERROR - 2019-01-19 15:14:54 --> Severity: Parsing Error --> syntax error, unexpected ''upa_address_en'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' F:\xampp\htdocs\scouts\application\modules\my_office\controllers\My_office.php 235
ERROR - 2019-01-19 15:15:34 --> Severity: Parsing Error --> syntax error, unexpected ''upa_address_en'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' F:\xampp\htdocs\scouts\application\modules\my_office\controllers\My_office.php 235
ERROR - 2019-01-19 15:15:59 --> Severity: Parsing Error --> syntax error, unexpected ''upa_address_en'' (T_CONSTANT_ENCAPSED_STRING), expecting ')' F:\xampp\htdocs\scouts\application\modules\my_office\controllers\My_office.php 235
