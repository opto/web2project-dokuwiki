<?php  /* $Id$ $URL$ */
if (!defined('W2P_BASE_DIR')) {
    die('You should not access this file directly.');
}

global $AppUI, $project_id, $contact_id, $company_id;

$perms = $AppUI->acl();
if (!$perms->checkModuleItem('dokuwiki', 'access')) {
    $AppUI->redirect('m=public&a=access_denied');
}

$todolistTab = $AppUI->processIntState('todoListIdxTab', $_GET, 'tab', 0);

// prepare the users filter
if (isset($_POST['todo_user'])) {
    $AppUI->setState('TodoOwner', intval($_POST['todo_user']));
}
$owner = $AppUI->getState('TodoOwner') !== null ? $AppUI->getState('TodoOwner') : $AppUI->user_id;

$user_list = $users = $perms->getPermittedUsers('projects');

$titleBlock = new w2p_Theme_TitleBlock('Dokuwiki', '', $m, "$m.$a");
$titleBlock->addCell('<table><tr><form action="?m=todos" method="post" name="userIdForm" accept-charset="utf-8"><td nowrap="nowrap" align="right">' . $AppUI->_('Owner') . '</td><td nowrap="nowrap" align="left">' . arraySelect($user_list, 'todo_user', 'size="1" class="text" onChange="document.userIdForm.submit();"', $owner, false) . '</td></form></tr></table>', '', '', '');
$titleBlock->show();
/*
$tabBox = new CTabBox("?m=$m", W2P_BASE_DIR . "/modules/$m/", $todolistTab);
$tabBox->add('vw_idx_open', 'Todo Items');
$tabBox->add('vw_idx_closed', 'Closed Items');
$tabBox->show();
*/
$obj= new CDokuwiki();
$dokuwiki_baseURL=$obj->getBaseURL();
/*    $dokuwiki_baseURL=$AppUI->getState('dokuwiki_base_URL');
if ($dokuwiki_baseURL==null)
{
}
//$isURLstored=CAppUI->getState('dokuwikiURLstored',0);
if ($isURLstored)
{
    $dokuwiki_baseURL=$AppUI->getState('dokuwiki_base_URL');
//    $dokuwiki_projectsnamespace=$AppUI->getState('dokuwiki_projects_namespace');
//    $dokuwiki_tasksnamespace=$AppUI->getState('dokuwiki_tasks_namespace');
}
<a href="http://www.google.de">Hmm, you are using a very old browser.
Click here to go directly to included content.</a>
 <iframe src="<?php echo $dokuwiki_baseURL;?>" width="1200" height="1200" frameborder="0">

 */    
?>
 <iframe src="<?php echo $dokuwiki_baseURL;?>" width="1200" height="1200" frameborder="0">

</iframe>
<?php /* $Id$ $URL$ */