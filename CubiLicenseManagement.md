# Introduction #

License is commonly used by application providers to protect their software with license. Cubi provides tools and best practice to help you commercialize applications. It enables developers to make money on an open source platform.

## How License Work in Cubi ##

Openbiz Cubi is an open source platform, it does not mean the applications on top of it need to be open source as well. A Cubi application can be open source with GPL license or closed source with commercial license.

In order commercialize your applications, you can compile your PHP source with software like
  * Zend Guard
  * ionCube Encoder
  * SourceGuardian

After your source code gets encoded, it is safe to deploy your applications without releasing the source. It does not prevent others downloading and using it. A common solution is to use license to control the usage of the applications.

The most flexible way of managing who use your applications is to specify certain license files when you compile or encode your source code. Then release the encoded package with license files. License files can protect your scripts against unauthorised use by locking to specific machines. They can also time expire, which is ideal for releasing evaluation versions and enforcing annual renewal business model.

There are various ways to put a valid license along with the encoded application.
  1. Get license offline, say by email, and copy the license to the server. As shown in Diagram 1.
    * Pros: No end user action is needed for activating the application.
    * Cons: It takes time to get license offline. It is hard to restrict license on certain server.
  1. When server detects the need of license, it pushes a web page to end user. The end user submit a license acquired offline through the page. Then the server take the user input and save the license to right place. As shown in Diagram 2.
    * Pros: No server action is needed for activating the application.
    * Cons: It takes time to get license offline. It is hard to restrict license on certain server.
  1. When server detects the need of license, it pushes a web page to end user. The end user enters activation key which is used by server to generate license by matching activation key with user license policy. As shown in Diagram 3.
    * Pros: Getting license can be automated. It is easy to restrict license on certain server.
    * Cons: It is complicated to set up license server.

#### Diagram 1 - deploy license and encoded package on server ####
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/encoder_license_1.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/encoder_license_1.png)

#### Diagram 2 - user enters license through a web form ####
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/encoder_license_2.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/encoder_license_2.png)

#### Diagram 3 - user enters activation key through a web form, server generate license on the fly ####
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/encoder_license_3.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/encoder_license_3.png)

The paragraphs below give details of how to protect Cubi applications with ionCube Encoder Pro. ionCube is used by Cubi as it is a mature and affordable tool. The same logic will be applicable on Zend Guard or other encoding solutions.

## Encode Source and Deployment ##
To be completed by Jixian

## Manage License ##
Cubi license module can be used to full automate license generation as shown in Diagram 3.

The license module provides functionality of managing activation code, license policy and view issued licenses. It also provides a web service API that takes activation code and returns newly generated license.

#### First create products ####
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/license_product.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/license_product.png)

#### Create license policies ####
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/license_policy.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/license_policy.png)

#### Create activation codes for given product, contact and policy ####
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/license_actcode.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/license_actcode.png)

#### License issued ####
![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/license_issued.png](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/license_issued.png)

## License Generation ##
As mentioned previously, ionCube is used for encoding and license generation. To specify the path of ionCube "make\_license" command, please make proper changes in cubi/modules/license/lib/LicenseUtil.php
```
class LicenseUtil
{
    /* linux make_license configuration
    const make_license = "/src/license/make_license";
    const licensePath = "/src/license/make_license";
    const serverDataPath = "/src/license/make_license";
    */
    // windows make_license configuration
    const make_license = "c:/ioncube/make_license";
    const licensePath = 'c:/ioncube/tmp/license';
    const serverDataPath = 'c:/ioncube/tmp/serverdata';
...
```

## Acquire License ##
In order to use the license web service, Cubi comes with two tools
  * license client service (under cubi/modules/service/)
  * get license command line tool (under cubi/bin/tools/). This tool invokes license client service.

License client service can be configured to point to a central license server by specifying RepositoryUrl.
```
<?xml version="1.0" standalone="no"?>
<PluginService Name="licenseClient" Class="licenseClient" RepositoryUrl="http://localhost/gcubi/cubi/ws.php/license/LicenseService">
</PluginService>
```

The license client service can be easily invoke by web server script which takes user inputs from a web form. Once the return license content from this service is saved to proper location, the encoded script can be executed smoothly till the license expires.<?xml version="1.0" standalone="no"?>
<PluginService Name="licenseClient" Class="licenseClient" RepositoryUrl="http://localhost/gcubi/cubi/ws.php/license/LicenseService">
</PluginService>
}}}```