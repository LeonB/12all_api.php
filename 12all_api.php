<?php

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $acl, $my, $option, $mosConfig_absolute_path;

// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_nieuwsbrief_generator' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

if (!defined('JPATH_ROOT')) {
	define('JPATH_ROOT', $mosConfig_absolute_path);
}

if (!defined('DS')) {
	define('DS', DIRECTORY_SEPARATOR);
}

if (!defined('ONETWOALL_COMPONENT_PATH')) {
	define('ONETWOALL_COMPONENT_PATH', dirname(__FILE__));
}

require_once(ONETWOALL_COMPONENT_PATH.DS.'config.php');

$model_files = mosReadDirectory(ONETWOALL_COMPONENT_PATH.DS.'models'.DS, '.php$', false, true);
foreach ($model_files as $model_file) {
    require_once($model_file);
}
?>