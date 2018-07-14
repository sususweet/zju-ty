<?php
// $sratr_time = strtotime('2017-10-17');
// $end_time = strtotime('2017-10-28 8:30');
// $weekarray=array("1","2","3","4","5");
// $current_week = date('w',time());
// if(!in_array($current_week,$weekarray) || time()<strtotime(date('Y-m-d').' 8:30') || time() >strtotime(date('Y-m-d').' 17:00')) {
  // header("Content-Type: textml;charset=gb2312"); 
  // print '网站维护中，给您带来不便敬请谅解！';
  // exit;
// }

/* 站点标识，可随意取名（限用半角数字、字母、下划线、-），一个后台中的不同站点不能重名 */
$sitecfg['site_code'] = 'newsite';

/* 若正确配置了site_id，则index.php会为首页模板提供$catalog变量。并且，mod_seo需要此配置以提取优化信息 */
$sitecfg['site_id'] = 150005;

/* 这个站点使用的后台的路径，可以写相对路径或绝对路径（注意不是网址）*/
$sitecfg['wescms_dir'] = '../wescms';

/* 这个站点使用的模板文件的路径，可以写相对路径或绝对路径 */
$sitecfg['template_dir'] = './template';

/* 打开站点首页时默认跳转到的地址，仅用于特殊用途，默认不需要填写 */
$sitecfg['portal_url'] = '';

/* 站点首页使用的模板文件，默认为index.html，可根据需要更改 */
$sitecfg['portal_template'] = 'index.html';

/* 模板文件中标签版本，若为新版<wescms:...>格式，则设为TRUE，反之为FALSE */
$sitecfg['use_newstyle_tag'] = false;

//$sitecfg['limit_ip'] = array('10.', '210.32.');
?>