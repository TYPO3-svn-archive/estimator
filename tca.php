<?php
if (!defined ('TYPO3_MODE')) 	die ('Access denied.');

$TCA['tx_estimator_task'] = array (
	'ctrl' => $TCA['tx_estimator_task']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,taskname,duration,category'
	),
	'feInterface' => $TCA['tx_estimator_task']['feInterface'],
	'columns' => array (
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_estimator_task',
				'foreign_table_where' => 'AND tx_estimator_task.pid=###CURRENT_PID### AND tx_estimator_task.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'taskname' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_task.taskname',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'duration' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_task.duration',		
			'config' => array (
				'type'     => 'input',
				'size'     => '4',
				'max'      => '4',
				'eval'     => 'int',
				'checkbox' => '0',
				'range'    => array (
					'upper' => '1000',
					'lower' => '10'
				),
				'default' => 0
			)
		),
		'category' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_task.category',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_estimator_cat',	
				'foreign_table_where' => 'ORDER BY tx_estimator_cat.uid',	
				'size' => 10,	
				'minitems' => 0,
				'maxitems' => 10,	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_estimator_cat',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'tx_estimator_cat',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, taskname, duration, category')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_estimator_tpl'] = array (
	'ctrl' => $TCA['tx_estimator_tpl']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,tplname,estimates'
	),
	'feInterface' => $TCA['tx_estimator_tpl']['feInterface'],
	'columns' => array (
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_estimator_tpl',
				'foreign_table_where' => 'AND tx_estimator_tpl.pid=###CURRENT_PID### AND tx_estimator_tpl.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'tplname' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_tpl.tplname',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',	
				'eval' => 'required',
			)
		),
		'estimates' => array (		
			'exclude' => 0,		
			'label' => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_tpl.estimates',		
			'config' => array (
				'type' => 'select',	
				'foreign_table' => 'tx_estimator_task',	
				'foreign_table_where' => 'ORDER BY tx_estimator_task.uid',	
				'size' => 20,	
				'minitems' => 0,
				'maxitems' => 100,	
				'wizards' => array(
					'_PADDING'  => 2,
					'_VERTICAL' => 1,
					'add' => array(
						'type'   => 'script',
						'title'  => 'Create new record',
						'icon'   => 'add.gif',
						'params' => array(
							'table'    => 'tx_estimator_task',
							'pid'      => '###CURRENT_PID###',
							'setValue' => 'prepend'
						),
						'script' => 'wizard_add.php',
					),
					'list' => array(
						'type'   => 'script',
						'title'  => 'List',
						'icon'   => 'list.gif',
						'params' => array(
							'table' => 'tx_estimator_task',
							'pid'   => '###CURRENT_PID###',
						),
						'script' => 'wizard_list.php',
					),
					'edit' => array(
						'type'                     => 'popup',
						'title'                    => 'Edit',
						'script'                   => 'wizard_edit.php',
						'popup_onlyOpenIfSelected' => 1,
						'icon'                     => 'edit2.gif',
						'JSopenParams'             => 'height=350,width=580,status=0,menubar=0,scrollbars=1',
					),
				),
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, tplname, estimates')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);



$TCA['tx_estimator_cat'] = array (
	'ctrl' => $TCA['tx_estimator_cat']['ctrl'],
	'interface' => array (
		'showRecordFieldList' => 'sys_language_uid,l10n_parent,l10n_diffsource,hidden,category,shortname'
	),
	'feInterface' => $TCA['tx_estimator_cat']['feInterface'],
	'columns' => array (
		'sys_language_uid' => array (		
			'exclude' => 1,
			'label'  => 'LLL:EXT:lang/locallang_general.xml:LGL.language',
			'config' => array (
				'type'                => 'select',
				'foreign_table'       => 'sys_language',
				'foreign_table_where' => 'ORDER BY sys_language.title',
				'items' => array(
					array('LLL:EXT:lang/locallang_general.xml:LGL.allLanguages', -1),
					array('LLL:EXT:lang/locallang_general.xml:LGL.default_value', 0)
				)
			)
		),
		'l10n_parent' => array (		
			'displayCond' => 'FIELD:sys_language_uid:>:0',
			'exclude'     => 1,
			'label'       => 'LLL:EXT:lang/locallang_general.xml:LGL.l18n_parent',
			'config'      => array (
				'type'  => 'select',
				'items' => array (
					array('', 0),
				),
				'foreign_table'       => 'tx_estimator_cat',
				'foreign_table_where' => 'AND tx_estimator_cat.pid=###CURRENT_PID### AND tx_estimator_cat.sys_language_uid IN (-1,0)',
			)
		),
		'l10n_diffsource' => array (		
			'config' => array (
				'type' => 'passthrough'
			)
		),
		'hidden' => array (		
			'exclude' => 1,
			'label'   => 'LLL:EXT:lang/locallang_general.xml:LGL.hidden',
			'config'  => array (
				'type'    => 'check',
				'default' => '0'
			)
		),
		'category' => array (	
			'exclude' => 0,		
			'label' => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_cat.category',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
		'shortname' => array (	
			'exclude' => 0,		
			'label' => 'LLL:EXT:estimator/locallang_db.xml:tx_estimator_cat.shortname',		
			'config' => array (
				'type' => 'input',	
				'size' => '30',
			)
		),
	),
	'types' => array (
		'0' => array('showitem' => 'sys_language_uid;;;;1-1-1, l10n_parent, l10n_diffsource, hidden;;1, category, shortname')
	),
	'palettes' => array (
		'1' => array('showitem' => '')
	)
);
?>