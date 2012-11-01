Dokuwiki v1.0.0
Klaus Buecher
   
The Dokuwiki module includes Dokuwiki pages for w2p projects and tasks into web2project tabs.

LICENSE

=====================================

The Dokuwiki module was built by Klaus Buecher and is released here
under modified BSD license (see GNU.org).

Copyright (c) 2012 Klaus Buecher (Opto)

XMLRPC is used to access Dokuwiki, see xmlrpc.inc for details of license



KNOWN/PREVIOUS ISSUES

=====================================

Open Issues:

* no ACL for Dokuwiki yet
* only partly localisation of strings

INSTALL

=====================================

0.  Previous installations of this module can simply be overwritten.

1.  To install this module, please follow the standard module installation
procedure.  Download the latest version and unzip this directory into your
web2project/modules directory.

2.  Select to System Admin -> View Modules and you should see "Dokuwiki" near
the bottom of the list.

3.  On the "Dokuwiki" row, select "install".  The screen should
refresh.  Now select "hidden" and then "disabled" from the same row to make it
display in your module navigation.

4. (!!) Configure the path to the dokuwiki installation according to the screen info, 
if you click configure
Dokuwiki base URL: like http://localhost/dokuwiki/

Projects namespace: any allowed Dokuwiki namespace without final :

like web2project:projects

5. No localisation of strings, yet. Also, no ACL for Dokuwiki yet, will follow at a later time.

USAGE

=====================================

1.  Projects, tasks and contacts will display an extra tab called Dokuwiki. This allows 
to create and access Dokuwiki pages on an external server, without loosing the web2project main menu 
on the screen.

2. As an additional feature, the tabs can indicate whether the Dokuwiki page does already exist.
To enable that feature, code must be added into the view.php file in the projects and tasks 
directories. This should be done directly before the $tabBox->show(); at the end of the files.

Also, projects_tab.view.dokuwiki.php and tasks_tab.view.dokuwiki.php should be renamed to avoid 
double occurrance of the tabs.

Code for Projects:
$dwiki= new CDokuwiki();
$dwiki->addDokuwikiTab($tabBox, "projects", $project->project_id, $project->project_name);


Code for Tasks:
$dwiki= new CDokuwiki();
$dwiki->addDokuwikiTab($tabBox, "tasks", $obj->task_id, $obj->task_name);

In this case, xmlrpc must be enabled in Dokuwiki settings