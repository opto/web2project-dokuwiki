<?php /* $Id$ $URL$ */
if (!defined('W2P_BASE_DIR')) {
	die('You should not access this file directly.');
}

global $AppUI, $project_id, $contact_id, $company_id;
$proj= new CProject();
$proj->load($project_id);
$perms = $AppUI->acl();
if (!$perms->checkModuleItem('dokuwiki', 'access')) {
    $AppUI->redirect('m=public&a=access_denied');
}

$dwiki= new CDokuwiki();


//to get pagename from project  name
$URL=$dwiki->combineProjectURL($proj->project_name,6);
//uncomment to get pagename from project short name
//$URL=$dwiki->combineProjectURL($proj->project_short_name,6);
?>

 <iframe src="<?php echo $URL ;?>" width="990" height="1200" frameborder="0">

</iframe>
<?php /* $Id$ $URL$ */