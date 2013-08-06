#Composer, a PHP dependency management tool
<entry>
    A tool that aims to fulfill the same position for PHP as NPM for NodeJS and Bundler for Ruby.
</entry>

Though it would be quite excusable to not having noticed that I do a lot of PHP considering the topics of prior articles, it's one of the languages I've spent the most time with. I work fulltime with PHP and, really, the minority of that time is using WordPress. At any rate, this is the introduction to using [Composer](http://getcomposer.org), which has quite a few [packages](https://packagist.org/) including [PHPUnit](https://github.com/sebastianbergmann/phpunit/) and [Laravel](http://laravel.com/). A touch of a shame that [WordPress](http://wordpress.org/) can't be installed through it, but once I've whipped *that* into proper submission, I'm going to post on it.

## Pre-requisites
So, what do you need to get this nice dependency-management-train running? Not too much, really.

If you haven't followed prior articles, you may want to start with some basics:

~~~
sudo apt-get update
sudo apt-get upgrade
sudo apt-get install curl
~~~

You will also need to have [PHP](http://php.net/) installed, to no one's surprise. If you don't have it installed, [check out this article](/installing-php5-and-friends-ubuntu).

## Installation
The way I will describe how to install this is based on a very simple conceit: This will be installed on a per-project basis rather than globally. I prefer, as you probably have noticed if you've read prior articles, to not use `sudo` if I can avoid it, and Composer is a single .phar-file of less than 900kB. It will occasionally remind you to update it, and if it's *right there* in your project, that to me is easier.

To install, run `curl -sS https://getcomposer.org/installer | php` in your terminal, in the root of your project. Easy-peasy, simple as that, and you can just run `php composer.phar` whenever you need use it.

### Warning: Detour
So, was I the only one whose eyes glazed over seeing that, at least the first time? For a detour, here's what this actually means and does:

It silently (but will tell you if it failed) downloads the installer, using cURL, and pipes it to PHP to be ran. The `-s` option stops it from showing the progress meter and error messages, the `-S` option makes it show error messages, by using the `|` character the terminal will pass the output ("pipe") from the first process (curl) to the second (php). For any further details on what options can be passed to cURL, `man curl` is your friend. It's got some neat stuff in there.

### Back on track
To make this slightly easier to use, I like to rename it and make it executable. 

~~~
# Still in the root of the project, or wherever you installed
mv composer.phar composer # Changes the name
chmod composer a+x # Chmod changes permissions, a+x means giving all the right to execute
~~~

