# Cubi Multi-language Support #

Cubi provides a set of tools for developers to make language package. The following steps describe the flow of adding a new language in Cubi application.
  1. Develop your module in English.
  1. If the new language folder is not created under /cubi/languages/lang\_code, create the folder and lang\_code.xml. A new language can be created from the Language Management screen as well.
  1. Use language generator tool to create a new language package
  1. Edit the new language file
  1. Test the new language package

## Language generator tool ##

Language generator can be found at /cubi/bin/tools/gen\_lang.php.
```
usage: php gen_lang.php [module] [locale] [translate]
```
Example: generate mainland Chinese language package
```
# php gen_lang.php user zh_CN -t
```

Where “user” is the module name, “zh\_CN” is the Chinese language code and “-t” enables translation with Google translator.

What the language generator does includes:
  1. Scan and extract all translatable strings in
    * metadata files. E.g. "Title" of EasyForm, "Label" of Element ...
    * template files. {t}...{/t} declares the translatable strings in templates.
    * message files.
  1. Put all translatable strings into /cubi/languages/lang\_code/mod.module\_name.ini that might contains 3 sections
    * [METADATA](METADATA.md)
    * [MESSAGE](MESSAGE.md)
    * [TEMPLATES](TEMPLATES.md)
  1. If "-t" is given in the command line, google translate API will be invoked to auto-translate the strings

## Language Management module ##

Language Management module can help users to
  * Create a new language folder including land\_code.xml and module.xml files (copied from English language pack)
  * Edit translation text

### Manage languages ###

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/lang_1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/lang_1.jpg)

### Create a new language package ###

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/lang_2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/lang_2.jpg)

### Manage language translations ###

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/lang_3.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/lang_3.jpg)

### Edit language translation ###

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/lang_4.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/lang_4.jpg)