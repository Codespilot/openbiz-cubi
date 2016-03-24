# Cubi Session Management #

Cubi allows developers to choose one of the following handlers to store session data
  * Store session in file system
  * Store session in database
  * Store session in memcache

To set the right session handler, you can modify the session part in app\_init.php
```
/* define session save handler */
// save session in DATABASE 
//define("SESSION_HANDLER", MODULE_PATH."/system/lib/SessionDBHandler"); 
// save session in MEMCACHE
//define("SESSION_HANDLER", MODULE_PATH."/system/lib/SessionMCHandler"); 
// for default FILE type session handler
define("SESSION_PATH", APP_HOME.DIRECTORY_SEPARATOR."session");
```

## Store session in file system ##

If no SESSION\_HANDLER is set in app\_init.php, by default Cubi saves session under app/sessions folder which is defined in "SESSION\_PATH" in app.inc. It is recommended to have a cron job that cleans up the session folder periodically.

Using file to save session is easy, but its disadvantage is not being able to share session across multiple web servers. You would consider using
  * Sticky session that uses load balancer to route user request to the same web server with the right session id.
  * Set session folder in NFS.

## Store session in database ##

If SESSION\_HANDLER is set to SessionDBHandler in app\_init.php, Cubi will save the session data in session table of Session database.

The "Session" database in defined in app/Config.xml. By default, session table is in the same Cubi database. Cubi session table is configured as "MEMORY" type that gives high speed read/write.

## Store session in memcache ##

If SESSION\_HANDLER is set to SessionMCHandler in app\_init.php, Cubi will save the session data in memcache server.

memcache is the fastest centralized solution for session sharing. In Unix/Linux environment, memcache is easy to build and install. On windows, please refer http://www.leonardaustin.com/technical/how-to-install-memcached-on-xampp-on-windows-7 for memcache installation.
Set your own session handler

As you can see, by setting SESSION\_HANDLER in app\_init.php, you can specify your own session handler.
For example,
```
// use custom logic to save session data
define("SESSION_HANDLER", MODULE_PATH."/abc/MySessionHandler"); 
```