DROP TABLE IF EXISTS `backup_device`;
CREATE TABLE IF NOT EXISTS `backup_device` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `description` text NOT NULL,  
  `sortorder` int(11) NOT NULL,
  `system` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `create_by` int(11) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_by` int(11) NOT NULL,
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

INSERT INTO `backup_device` VALUES (1,'Cubi Storage','{APP_FILE_PATH}/backup','Openbiz Cubi in system default backup files storage area.',50,1,1,1,'2011-04-16 12:44:45',1,'2011-04-16 05:06:37');


INSERT INTO `cronjob` (`name`, `minute`, `hour`, `day`, `month`, `weekday`, `command`, `sendmail`, `max_run`, `num_run`, `description`, `status`, `last_exec`, `create_by`, `create_time`, `update_by`, `update_time`) VALUES
( 'Weekly Backup Entire System', '1', '20', '*', '*', '5', '{APP_HOME}/bin/cronjob/run_svc.php backup.lib.BackupService BackupSystem SystemBak', '', 1, 0, 'Weekly backup entire system,\nRun at every Friday 8pm', 1, NULL, 2, '2012-02-07 10:37:15', 2, '2012-02-07 10:37:15'),
( 'Daily Backup System DB', '1', '1', '*', '*', '*', '{APP_HOME}/bin/cronjob/run_svc.php backup.lib.BackupService BackupDB SystemDB', '', 1, 0, 'Daily backup system database into default backup location.\nRunning in everyday midnight', 1, NULL, 2, '2012-02-07 10:35:02', 2, '2012-02-07 10:37:30');
