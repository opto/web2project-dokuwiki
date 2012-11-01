<?php /* $Id$ $URL$ */
if (!defined('W2P_BASE_DIR')) {
	die('You should not access this file directly.');
}

global $AppUI, $task_id, $contact_id, $company_id;
$tsk=new CTask();
$tsk->load($task_id);
$proj= new CProject();
$proj->load($tsk->task_project);
$perms = $AppUI->acl();
if (!$perms->checkModuleItem('dokuwiki', 'access')) {
    $AppUI->redirect('m=public&a=access_denied');
}

$dwiki= new CDokuwiki();

//to get pagename from project  name
$URL=$dwiki->combineTaskURL($proj->project_name,$tsk->task_name,6);
//uncomment to get pagename from project short name
//$URL=$dwiki->combineProjectURL($proj->project_short_name,10);
?>
<iframe src="<?php echo $URL ;?>" width="990" height="1200" frameborder="0">

</iframe>