<?php
defined('WEKIT_VERSION') or exit(403);
Wind::import('APPS:admin.library.AdminBaseController');
/**
 * 后台访问入口
 *
 * generated by phpwind.com
 */
class ManageController extends AdminBaseController {
	
    public function beforeAction($handlerAdapter) {
        parent::beforeAction($handlerAdapter);
		//TODO do something before all the action
	}
	
	public function run() {
		//TODO Insert your code here!
        $this->setTemplate('management');
	}
}

?>
