<?php 
/**
 * [WeEngine System] Copyright (c) 2013 WE7.CC
 */
defined('IN_IA') or exit('Access Denied');
if ($_GPC['type'] == 'rule') {
	$rid = intval($_GPC['id']);
	$rule = pdo_fetch("SELECT id, module FROM ".tablename('rule')." WHERE id = :id", array(':id' => $rid));
	if (empty($rule)) {
		message('抱歉，要修改的规则不存在或是已经被删除！');
	}
	//删除回复，关键字及规则
	if (pdo_delete('rule', array('id' => $rid))) {
		pdo_delete('rule_keyword', array('rid' => $rid));
		//调用模块中的删除
		$module = module($rule['module']);
		if (method_exists($module, 'ruleDeleted')) {
			$module->ruleDeleted($rid);
		}
	}
	message('规则操作成功！', create_url('rule/display'));	
} elseif ($_GPC['type'] == 'keyword') {
	$rid = intval($_GPC['rid']);
	$kid = intval($_GPC['kid']);
	$rule = pdo_fetch("SELECT id, module FROM ".tablename('rule')." WHERE id = :id", array(':id' => $rid));
	if (empty($rule)) {
		message('抱歉，要修改的规则不存在或是已经被删除！');
	}
	pdo_delete('rule_keyword', array('rid' => $rid, 'id' => $kid));
	message('关键字删除成功！', '', 'success');
}