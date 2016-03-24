# Cubi Help Module #

Cubi Help module allows users to create context-base help topics. In another word, the help topics change when the current view changes.

## Manage Help Category ##

Help Category is a tree structure that organize help topics into different sections. Each help category can have
  * A parent category
  * Name
  * URL Match. If the current page url matches the help category "URL Match" attribute, all help tips under this category will display on the context help box.
  * Description

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_cat.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_cat.jpg)

## Manage Help Tips ##

Help tip is the actual help content. It has
  * name
  * description
  * content
  * order
Each tip is under one Help Category.

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_tip.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_tip.jpg)

## Help Center block ##

Help center block is located on the left side of a page. Features of help center block include:
  * It can folded or unfolded.
  * The help topics in the help center block change according to the current page url.
  * Clicking on each help topic title will display help tip description.
  * Click on "More" button to display full help content in a popup.
  * Help center has search box which has auto-suggestion enabled.

The following screenshots demonstrate how the help center block works.

Search

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_box1.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_box1.jpg)

Clicking on help title

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_box2.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_box2.jpg)

Clicking on More button to show full help content in popup

![http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_popup.jpg](http://openbiz-cubi.googlecode.com/svn/trunk/docs/img/help_popup.jpg)