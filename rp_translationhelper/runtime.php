<?php
	spl_autoload_register(function($class_name){
		if (strpos($class_name, 'RpTranslationhelper_')===0) {
			include(PERCH_PATH.'/addons/apps/rp_translationhelper/lib/'.$class_name.'.class.php');
			return true;
		}
		return false;
	});

	PerchSystem::register_template_handler('RpTranslationhelper_Template');
