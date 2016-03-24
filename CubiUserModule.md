# Cubi User module #

Cubi user module provides the functions for end users to
  * Register
  * Login
  * Forget and reset password

## User login page ##

Login page is the default page that user will see after the successful installation.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_login.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_login.jpg)

## New user self registration ##

For a new user, he/she can click "Register new account" link to register.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_register.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_register.jpg)

After user is registered successfully, the user will be taken to a successful registration page (see screen below) and a welcome email will be sent to user email address. The welcome email is defined in email module at /cubi/modules/email/template/welcome\_email.tpl.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_register_ok.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_register_ok.jpg)

## Forget Password ##

In case a user forgets his/her password, he/she can click the "Forget password?" link on the login page to reset the password.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_forget_pass.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_forget_pass.jpg)

After user click "Send Email" button, a "Password Email Sent" page will be displayed.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_send_pass.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_send_pass.jpg)

## Reset password link ##

When a user gets reset password email, he/she click on the reset password link to enter "Reset Password" page.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_reset_pass.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_reset_pass.jpg)

After the "Reset Password" is clicked, user will see Password Reset Confirmation page.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_reset_pass_ok.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/user_reset_pass_ok.jpg)

Next: [CubiMyAccount](CubiMyAccount.md)