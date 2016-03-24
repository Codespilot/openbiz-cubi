# Template Performance Comparison: Smarty vs. Zend View #

# Introduction #

I've recently finished up a few code changes to fully support Zend's template system in OpenBiz.  One can choose between Smarty and Zend for template purposes.  While Smarty is the more established, I was drawn to Zend due to expected performance gains.  Is Zend in fact faster than Smarty?  And if so, by how much?  The results below are revealing.  In short, Zend's template system improved performance by almost 40% over Smarty!


# Details #

For this test, I created a simple ListView based off the Cubi application and stripped out much of the normal HTML.  For example, I removed the footer, left menu, breadcrumb and other extra HTML.

## SMARTY ##

![http://www.freeimagehosting.net/uploads/d71edb9786.png](http://www.freeimagehosting.net/uploads/d71edb9786.png)

I then rendered the page using SMARTY exclusively.  Using Zend Studio's Profile tool, I was able to get a render time for each page load.  I made sure to load the page several times in case files needed to be cached.

Four recorded renders as well as the average are as follows:
  1. 179.31
  1. 152.18
  1. 223.02Z
  1. 223.33

Average: 194.475

## Zend View ##

![http://www.freeimagehosting.net/uploads/96e2e94f93.png](http://www.freeimagehosting.net/uploads/96e2e94f93.png)

I performed the same sequence of steps as 2nd time for Zend and gathered these results.
  1. 116.78
  1. 114.6
  1. 112.83
  1. 115.28
Average: 119.8725

Given the sizable performance advantages, I plan to migrate much of the default Cubi templates to PHP based Zend for my next project.  Perhaps we can post a 2nd template, just like the first, except based on Zend instead of Smarty.

# Update #
I wasn't entirely satisfied with my former testing.  This is because testing a full page load means I'm subjecting the test to other factors that might slow down a page rendering.  For example, database queries can take a while to perform and in the case of OpenBiz, the Log service is inefficient as well.

I set out to isolate Template performance by further striping the normal Openbiz page load by constructing a simple BizView with no BizForms to render.  The effect is that OpenBiz simply renders a plain BizView performing only a small number of normaly "template" operations.  Still, this gives us a more clear picture into how long it takes to render a simple page using Zend View or Smarty.

In this case, I ran two sets of tests where I loaded the same page 30 or so times.  Before running each test, I would restart the web server and load the page twice for it to create any needed cache.

Stats. are listed below for each test set.

|Test 1|Smarty|PHP|% Improvement|
|:-----|:-----|:--|:------------|
|Mean  |.00169|.00124|37%          |
|Median|.00130|.00105|24%          |
|Mode  |.00090|.00050|80%          |

|Test 1|Smarty|PHP|% Improvement|
|:-----|:-----|:--|:------------|
|Mean  |.00205|.00152|35%          |
|Median|.00250|.00190|32%          |
|Mode  |.00260|.00190|37%          |

**All times in a fraction of a second.**


So the results more or less hold up on a percentage basis.  It's accurate to say Zend's template system is roughly 35% faster than Smarty.   Though in the grand scheme of things, other areas will slow down your page more that choosing a sub-optimal template engine.