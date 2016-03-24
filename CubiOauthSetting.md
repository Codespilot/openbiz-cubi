# Example of active an google account on Cubi OAuth #

OAuth is a popular application for more and more website or application at these days.
People can just using their own Facebook or Twitter or Google account and so on to log in the website or application that supported by OAuth.
Now the OAuth officially be intergrated into Openbiz Cubi Platform that means all the new applications be built with new cubi will support OAuth feature!
It is an exciting news,isn't it?

Here is a example that make a new google account connect on Cubi OAuth module.
We can log in our application with our social account like facebook account or google account with the new Cubi OAuth module now.

## step1: Let's open the google platform switch in Extension OAuth intergration ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic1.png)

## step2: Here we can see the google social API link and go to there ##
**And callback URL that will be needed input in google server**

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic2.jpg)

## step3: Go to Services and find out the Google+ API ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic3.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic3.png)

## step4: Open the Google+ API ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic4.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic4.png)

## step5: Click "Create an OAuth 2.0 client ID" ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic5.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic5.png)

## step6: Input the information of the OAuth ID ##
**The "Home Page URL:" is the application or website you will use the OAuth on URL, here i used my localhost for the example**

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic6.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic6.png)

## step7:Here select Web application for cubi is a web application ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic7.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic7.png)

## step8: Then we can get the Client ID and Client secret ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic8.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic8.png)

## step9: Here let's input Callback URL ##
**Callback URL is the Authorized Redirect URLs**

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic9.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic9.jpg)

## step10: Now let's Open the Google OAuth account ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic10.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic10.png)

## step11: Now we can log in cubi with google account ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic11.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic11.png)

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic12.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic12.jpg)

# Warning #
**If we input wrong username or wrong secret or wrong callback URL will see the error**

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic13.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_google_example/oauth_google_pic13.png)