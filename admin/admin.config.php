<?php
require_once('blast_sqlin.php');
$conf['debug']['level']=5;

/*		���ݿ�����		*/
$conf['db']['dsn']='mysql:host=localhost;dbname=0xc';
$conf['db']['user']='root';
$conf['db']['password']='dYAd4KeDY6ctczmN';
$conf['db']['charset']='utf8';
$conf['db']['prename']='blast_';

$conf['safepass']='123456';     //��̨��½��ȫ��

$conf['cache']['expire']=0;
$conf['cache']['dir']='_blast_buffer/';     //ǰ̨����Ŀ¼
$conf['url_modal']=2;
$conf['action']['template']='blast_Front/admin/';
$conf['action']['modals']='blast_back/admin/';
$conf['member']['sessionTime']=15*60;	// �û���Чʱ��
$conf['node']['access']='http://localhost:65531';	// node���ʻ���·��

error_reporting(E_ERROR & ~E_NOTICE);
ini_set('date.timezone', 'asia/shanghai');
ini_set('display_errors', 'Off');