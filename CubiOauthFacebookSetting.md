# Guide of how to setting Facebook OAuth on Cubi #

Despite i had made a wiki page about how to setting Google OAuth on Cubi.

But every manufacture like Google or Facebook or Twitter all have different OAuth setting and apply process.

So for let all the others avoid wasting time to figure out how to set up the Facebook OAuth on Cubi i made this wiki page.

## Step1: Open Facebook OAuth window under Extension Module ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting1.png)

## Step2: Here we can see the Facebook OAuth apply URL and Callback URL ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting2.png)

## Step3: Go to developers.facebook.com ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting3.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting3.png)

## Step4: Log in with your own Facebook account ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting4.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting4.png)

## Step5: Follow the instruction ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting5.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting5.png)

## Step6: Now click Create New App ##
**Facebook defined OAuth is a kind of APP**

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting6.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting6.png)

## Step7: Name your own App ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting7.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting7.png)

## Step8: It is will ask you verify you own APP from mobile or credit card ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting8.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting8.png)

## Step9: I verify the App with my mobile phone ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting9.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting9.png)

## Step10: Input the verify code that be sent in my phone ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting10.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting10.png)

## Step11: Account verified ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting11.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting11.png)

## Step12: Input the App name i just verified ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting12.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting12.png)

## Step13: Input Security Check code ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting13.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting13.png)

## Step14: Finally we log in. It is 60% success now ##
**And we get App ID and App Secret here**

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting14.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting14.png)

## Step15: Input our website URL that will use the App for Facebook OAuth ##
**For this example i input my local address: http://local.openbiz.me in following 5 Options, and some of them needed be input https://local.openbiz.me***

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting15.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting15.png)

## Step16: Add App Domains ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting16.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting16.png)

## Step17: Input Callback URL in Service-->Advanced--> Authentication ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting17.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting17.png)

## Step18: Finally go Cubi OAuth Facebook setting  input App Key and Secret ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting18.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting18.png)

## Step19: Test it success ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting19.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting19.png)

## Step20: Open the Facebook switch button on OAuth ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting20.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting20.png)

## Step21: We can see now we can log in Cubi with facebook account ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting21.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting21.png)

## Step22: Log in as Facebook account ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting22.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting22.png)

## Step23: Connect your facebook account with Openbiz account ##
**First time you log in with facebook account will auto create an new Openbiz account that associate with the facebook account**

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting23.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting23.png)

## Step24: Done, now we can log in Cubi with facebook account ##
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting24.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/oauth_facebook_setting/oauth_facebook_setting24.png)