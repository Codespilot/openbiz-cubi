# Cubi Security Module #

Security service provides advanced filters for blocking unwanted visits. Security Service Management allows administrators to set security rules for the service.
  * Url filter. It will filter out bad urls
  * Domain filter. It can block certain domain address
  * IP filter. It can block given IPs
  * Agent filter. It can block requests with certain "User-agent" headers
  * Post filter. It can disable "POST" action for certain urls.
  * Get filter. It can disable "GET" action for certain urls.

Security service can be configured with its own configuration file at openbiz/metadata/service/securityService.xml

Each filter has rules. Each rule can have format as
```
<Rule Name="ip_filter_1" Action="Deny" Match="210.72.214.*" EffectiveTime="0000-2400" />
```
  * Action can have "Allow" or "Deny".
  * Match is a regexp string matching
  * EffectiveTime has form at as starttime-endtime. That tells the effective time interval.

The screenshots below are the security management pages for URL filters. Other filter setting pages are similar with this one.

URL Filter settings

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/security_1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/security_1.jpg)

Edit a URL filter

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/security_2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/security_2.jpg)

Next: [CubiThemeModule](CubiThemeModule.md)