# Installing Sass and Compass on Ubuntu

(excerpt):

Sass is a pre-preprocessor for CSS which I feel makes life easier. Compass is a CSS Authoring Framework that adds commonly used mixins.

(/excerpt)

This article is about setting up Sass and Compass, but they in turn require Ruby, which means that the first part of this will deal with installing Ruby and Ruby Version Manager on your installation. [This article by Ryan Biggs](http://ryanbigg.com/2010/12/ubuntu-ruby-rvm-rails-and-you/) explains in detail how-to (and to a certain extent why), so if you are interested I highly recommend you to read through it. 

If not, the TL;DR version (terminal commands only) can be found below. First, however, one of the key things of Ryan Bigg's article:

> Under no circumstance should you install Ruby, Rubygems or any Ruby-related packages from apt-get. This system is out-dated and leads to major headaches. Avoid it for Ruby-related packages. We do Ruby, we know what's best. Trust us.

If you already have Ruby installed, feel free to jump directly to the [Sass & Compass installation](#sass-compass) below.

## TL; DR
Based on Ryan Bigg's update from January 31st 2013. For Sass we **do not** need the Rails gem, so it will divert slightly from the article.

    sudo apt-get update

    # Curl is a "library and command-line tool for transferring data"
    sudo apt-get install curl

    # Installs Ruby Version Manager
    curl -L get.rvm.io | bash -s stable --auto

    # Reloads the profile - assumes you're using BASH!
    . ~/.bash_profile

At this point, test to ensure that it recognizes RVM (for instance through running `rvm requirements`). If not, you may want to run `. ~/.bashsrc`. The difference is in the scope of another article, though `man bash` is a good start, so's [googling it](https://www.google.com/#output=search&q=bash_profile%20vs%20bashrc).

### Requirements
The assumption for this article is that you are mainly installing Ruby for the benefits to using various gems such as Sass and Compass, so when running `rvm requirements` you will be looking for the heading that includes *For Ruby / Ruby HEAD* and install all the packages suggested there, using `sudo apt-get install`. At the time of writing they are the following:

    sudo apt-get install build-essential openssl libreadline6 libreadline6-dev curl git-core zlib1g zlib1g-dev libssl-dev libyaml-dev libsqlite3-dev sqlite3 libxml2-dev libxslt-dev autoconf libc6-dev ncurses-dev automake libtool bison subversion pkg-config

### Installing Ruby (finally!)
If you're intending to use Ruby outside of development with Sass, you are highly recommended to read the article this section is a summary of, as it mentions a few gotchas. For the purpose of Sass, those gotchas are irrelevant.

    rvm install 1.9.3
    rvm use 1.9.3

If you want to be more exact, you can take note of the patchlevel in this way:

Run `ruby -v`. The output will be something along the lines of `ruby 1.9.3p327 (2012-04-20 revision 35410) [x86_64-linux]`, where the `p327` denotes the patchlevel. 

    rvm --default use 1.9.3-p327

Beyond this point the above article by Ryan Biggs deals with Rails, so the TL;DR section is done for now.

## Sass & Compass installation {#sass-compass}

This is the easiest part of the HOW-TO, and can also be found on [Compass installation](http://compass-style.org/install/)

    gem update --system #gets the latest version of the RubyGems installer
    gem install compass #installs any gem requirements (such as Sass) and then Compass

You're done! At least with this bit. The series will continue with other parts of my development tools.

*[TL;DR]: Too long, didn't read
