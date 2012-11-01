<?php /* $Id$ $URL$ */
if (!defined('W2P_BASE_DIR')){
  die('You should not access this file directly.');
}

/**
 * Name:			Dokuwiki
 * Directory: dokuwiki
 * Type:			user
 * UI Name:		dokuwiki
 * UI Icon: 	?
 */

$config = array();
$config['mod_name']        = 'Dokuwiki';			    // name the module
$config['mod_version']     = '1.0.0';			      	// add a version number
$config['mod_directory']   = 'dokuwiki';             // tell web2project where to find this module
$config['mod_setup_class'] = 'CSetupDokuwiki';		// the name of the PHP setup class (used below)
$config['mod_type']        = 'user';				      // 'core' for modules distributed with w2p by standard, 'user' for additional modules
$config['mod_ui_name']	   = $config['mod_name']; // the name that is shown in the main menu of the User Interface
$config['mod_ui_icon']     = '';                  // name of a related icon
$config['mod_description'] = 'Dokuwiki links';			    // some description of the module
$config['mod_config']      = true;					      // show 'configure' link in viewmods
$config['mod_main_class']  = 'CDokuwiki';

$config['permissions_item_table'] = 'dokuwiki';
$config['permissions_item_field'] = 'dokuwiki_id';
$config['permissions_item_label'] = 'dokuwiki_title';

class CSetupDokuwiki
{
	public function install()
	{ 
		global $AppUI;

        $q = new w2p_Database_Query();
		$q->createTable('dokuwiki');
		$sql = '(
			dokuwiki_id int(10) unsigned NOT NULL AUTO_INCREMENT,
			dokuwiki_URL text,
			dokuwiki_URL_use text NOT NULL,
			
			PRIMARY KEY  (dokuwiki_id))
			ENGINE = MYISAM DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci';
        $q->createDefinition($sql);
        $q->exec();
        $q->clear();
        $q->addTable('dokuwiki','dw');
        $q->addInsert('dokuwiki_URL_use','dokuwiki_base_URL');
        $q->addInsert('dokuwiki_URL','http://localhost/dokuwiki/');
        $q->exec();
        $q->clear();
        $q->addTable('dokuwiki','dw');
        $q->addInsert('dokuwiki_URL','http://localhost/dwiki/doku.php?id=projects');
        $q->addInsert('dokuwiki_URL_use','dokuwiki_projects_namespace');
        $q->exec();
        $q->clear();
        $q->addTable('dokuwiki','dw');
        $q->addInsert('dokuwiki_URL','');
        $q->addInsert('dokuwiki_URL_use','dokuwiki_tasks_sub_namespace');
        $q->exec();
        $q->clear();
        $q->addTable('dokuwiki','dw');
        $q->addInsert('dokuwiki_URL','http://localhost/dwiki/doku.php?id=contacts');
        $q->addInsert('dokuwiki_URL_use','dokuwiki_contacs_namespace');
        $q->exec();

        $perms = $AppUI->acl();
        return $perms->registerModule('Dokuwiki', 'dokuwiki');
	}

	public function upgrade($old_version)
	{
        switch ($old_version) {
            case '1.0.0':
            case '1.0.1':
            default:
				//do nothing
		}
		return true;
	}

	public function remove()
	{ 
		global $AppUI;

        $q = new w2p_Database_Query;
		$q->dropTable('dokuwiki');
		$q->exec();

        $perms = $AppUI->acl();
        return $perms->unregisterModule('dokuwiki');
	}


    public function configure() {
        global $AppUI;
        $AppUI->redirect('m=dokuwiki&a=configure');
        return true;
    }
}