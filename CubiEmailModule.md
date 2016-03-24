# Cubi Email Module #

As all know, email delivery is not very reliable in current internet due to many reasons. The goal of Cubi email module is to send email more efficiently and manage in and out emails.

## Email queue ##

Cubi use a queue to store unsent emails. Emails in queue will be sent by cronjob or from Email queue page. On the Manage Email Queue page, user can pick emails to send or delete.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/email_queue.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/email_queue.jpg)

## Email log ##

Emails are sent by User Email Service that generates a log entry in email log table. Administer can view the email log at Manage Email Log page.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/email_log.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/email_log.jpg)

Next: [CubiCacheModule](CubiCacheModule.md)