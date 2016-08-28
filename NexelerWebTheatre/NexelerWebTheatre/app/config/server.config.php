<?php
/**
 * Returns the full configuration.
 * This is used by the core/Config class.
 */
return array(
    /**
     * Configuration for: Base URL
     * This detects your URL/IP incl. sub-folder automatically. You can also deactivate auto-detection and provide the
     * URL manually. This should then look like 'http://192.168.33.44/' ! Note the slash in the end.
     */
    'URL' => 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])),
    'ROOT' => 'http://' . $_SERVER['HTTP_HOST'] . '/nexeler/public/',
    'HOME' => 'http://' . $_SERVER['HTTP_HOST'] . '/nexeler/public/home/index',
    /**
     * Configuration for: Folders
     * Usually there's no reason to change this.
     */
    'PATH_CORE' => realpath(dirname(__FILE__).'/../../') . '/app/core/',
    'PATH_CONTROLLER' => realpath(dirname(__FILE__).'/../../') . '/app/controllers/',
    'PATH_VIEW' => realpath(dirname(__FILE__).'/../../') . '/app/views/',
    /**
     * Configuration for: Avatar paths
     * Internal path to save avatars. Make sure this folder is writable. The slash at the end is VERY important!
     */
    'PATH_AVATARS' => realpath(dirname(__FILE__).'/../../') . '/public/avatars/',
    'PATH_AVATARS_PUBLIC' => 'avatars/',
    /**
     * Configuration for: Default controller and action
     */
    'DEFAULT_CONTROLLER' => 'home',
    'DEFAULT_ACTION' => 'index',



'DB_HOST'=> 'localhost',
 'DB_USER'=>'root',
'DB_PASSWORD'=> '',
 'DB_NAME'=>'nexeler_database'
);