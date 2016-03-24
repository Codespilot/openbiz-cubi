# Cubi Cronjob Module #

Cronjob module provides a backend management UI to allow administrator to manage periodically running commands in cronjob format.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cronjob_list.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/cronjob_list.jpg)

A cronjob defined in Cubi can have following attributes.
  * name
  * minute, hour, day, month, weekday. Unix cronjob format is used. Note: `*`/N format is not supported.
  * command. This is the command to run in this job.
  * sendmail. This field includes the emails to be sent after completing executing the job.
  * max\_run. max\_run tells how many concurrent execution of this job. By default max\_run=1. It means only single job can run as the same time. If max\_run=0, then no limit of the concurrent job execution.
  * description

If you need to know more about setting cron, please check http://en.wikipedia.org/wiki/Cron

## Cronjob runner ##

Cubi provides a script to run jobs listed in the cronjob management screen. To start Cubi cronjob runner, you can add "cubi/bin/cronjob/cron.php" in system crontab and let it run every certain time interval. E.g. 1 minute. The cronjob runner reads and parses the jobs in the cronjob list, then execute them.

### Log file ###

cronjob log files are outputted to cubi/log. Each job will have its own log. The cron log file has name like cron\_n.log where "n" is the cronjob id.

### Run service script ###

Cubi provides a helper command called run\_svc.php that can invoke service with following format.
```
usage: # php run_svc.php service_name method parameter1 parameter2 ...
```
You can add this command in cronjob management page.

Next: [CubiHelpModule](CubiHelpModule.md)