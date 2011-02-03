<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}

t3lib_extMgm::allowTableOnStandardPages('tx_estimator_task');

$TCA['tx_estimator_task'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_task',		
		'label'     => 'taskname',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l10n_parent',	
		'transOrigDiffSourceField' => 'l10n_diffsource',	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_estimator_task.gif',
	),
);


t3lib_extMgm::allowTableOnStandardPages('tx_estimator_tpl');

$TCA['tx_estimator_tpl'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_tpl',		
		'label'     => 'tplname',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l10n_parent',	
		'transOrigDiffSourceField' => 'l10n_diffsource',	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_estimator_tpl.gif',
	),
);


t3lib_extMgm::allowTableOnStandardPages('tx_estimator_cat');

$TCA['tx_estimator_cat'] = array (
	'ctrl' => array (
		'title'     => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_cat',		
		'label'     => 'category',	
		'tstamp'    => 'tstamp',
		'crdate'    => 'crdate',
		'cruser_id' => 'cruser_id',
		'languageField'            => 'sys_language_uid',	
		'transOrigPointerField'    => 'l10n_parent',	
		'transOrigDiffSourceField' => 'l10n_diffsource',	
		'sortby' => 'sorting',	
		'delete' => 'deleted',	
		'enablecolumns' => array (		
			'disabled' => 'hidden',
		),
		'dynamicConfigFile' => t3lib_extMgm::extPath($_EXTKEY).'tca.php',
		'iconfile'          => t3lib_extMgm::extRelPath($_EXTKEY).'icon_tx_estimator_cat.gif',
	),
);


t3lib_div::loadTCA('tt_content');
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key';


t3lib_extMgm::addPlugin(array(
	'LLL:EXT:estimator/locallang_db.xml:tt_content.list_type_pi1',
	$_EXTKEY . '_pi1',
	t3lib_extMgm::extRelPath($_EXTKEY) . 'ext_icon.gif'
),'list_type');


t3lib_extMgm::addStaticFile($_EXTKEY,'static/estimations/', 'Estimations General');
t3lib_extMgm::addStaticFile($_EXTKEY,'pi1/static/','Estimations Plugin Conf');

if (TYPO3_MODE == 'BE') {
	$TBE_MODULES_EXT['xMOD_db_new_content_el']['addElClasses']['tx_estimator_pi1_wizicon'] = t3lib_extMgm::extPath($_EXTKEY).'pi1/class.tx_estimator_pi1_wizicon.php';
}


?>