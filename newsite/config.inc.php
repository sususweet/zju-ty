<?php
// $sratr_time = strtotime('2017-10-17');
// $end_time = strtotime('2017-10-28 8:30');
// $weekarray=array("1","2","3","4","5");
// $current_week = date('w',time());
// if(!in_array($current_week,$weekarray) || time()<strtotime(date('Y-m-d').' 8:30') || time() >strtotime(date('Y-m-d').' 17:00')) {
  // header("Content-Type: textml;charset=gb2312"); 
  // print '��վά���У������������㾴���½⣡';
  // exit;
// }

/* վ���ʶ��������ȡ�������ð�����֡���ĸ���»��ߡ�-����һ����̨�еĲ�ͬվ�㲻������ */
$sitecfg['site_code'] = 'newsite';

/* ����ȷ������site_id����index.php��Ϊ��ҳģ���ṩ$catalog���������ң�mod_seo��Ҫ����������ȡ�Ż���Ϣ */
$sitecfg['site_id'] = 150005;

/* ���վ��ʹ�õĺ�̨��·��������д���·�������·����ע�ⲻ����ַ��*/
$sitecfg['wescms_dir'] = '../wescms';

/* ���վ��ʹ�õ�ģ���ļ���·��������д���·�������·�� */
$sitecfg['template_dir'] = './template';

/* ��վ����ҳʱĬ����ת���ĵ�ַ��������������;��Ĭ�ϲ���Ҫ��д */
$sitecfg['portal_url'] = '';

/* վ����ҳʹ�õ�ģ���ļ���Ĭ��Ϊindex.html���ɸ�����Ҫ���� */
$sitecfg['portal_template'] = 'index.html';

/* ģ���ļ��б�ǩ�汾����Ϊ�°�<wescms:...>��ʽ������ΪTRUE����֮ΪFALSE */
$sitecfg['use_newstyle_tag'] = false;

//$sitecfg['limit_ip'] = array('10.', '210.32.');
?>