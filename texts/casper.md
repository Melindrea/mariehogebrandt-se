<intro>
PhantomJS is a <q src="http://phantomjs.org/">headless WebKit scriptable with a JavaScript API</q>, with CasperJS building on it to give high-level functions.
</intro>

[PhantomJS](http://phantomjs.org) is used quite a lot in headless browser testing and similar tasks. I've looked over various projects which deal with screenshots, and it's been on my TODO-list to add responsive screenshotting into my build process. I was kicked into gear reading [the following tutorial](http://net.tutsplus.com/tutorials/javascript-ajax/responsive-screenshots-with-casper/) which gives a barebones script. It also used [CasperJS](http://casperjs.org/), which is why the script that I made (based on their script) uses it. 

Another reason is because I looked closer at CasperJS and noticed that it (at least in theory) would also work with another headless browser using Gecko, [SlimerJS](http://www.slimerjs.org/), which means that a future iteration will theoretically be able to support both WebKit and Gecko screenshots. I have not yet tested this theory, which is why SlimerJS is not touched on in this article.

## Prerequisites
- Python 2.6 or higher, which is pre-installed on Ubuntu
- [Git](/articles/git-and-github-on-ubuntu/)

## Install PhantomJS
Instructions can be found [on their page](http://phantomjs.org/download.html) or if you feel confident around the terminal, follow the commands below (note, it's using the version that's the most current of the writing, 1.9.1, so if you want to ensure you have the newest, check the webpage and just replace 1.9.1 with whatever is the current newest). The one thing you should **not** do is `sudo apt-get install phantomjs`, as the version in the repositories is 1.4, and as we've established, the latest version now is 1.9.

    cd ~/Downloads #default folder for downloads, duh

Decide if you need the 64-bit or 32-bit download, where the difference in file name is that 64-bit has the suffix `-x86_64.tar.bz2` and 32-bit has the suffix `-i686.tar.bz2`.

    #64-bit, v. 1.9.1
    wget http://phantomjs.googlecode.com/files/phantomjs-1.9.1-linux-x86_64.tar.bz2

    #32-bit, v. 1.9.1
    wget http://phantomjs.googlecode.com/files/phantomjs-1.9.1-linux-i686.tar.bz2

    #Unpack the tarball!
    #64-bit, v. 1.9.1
    tar -xvf phantomjs-1.9.1-linux-x86_64.tar.bz2

    #32-bit, v. 1.9.1
    tar -xvf phantomjs-1.9.1-linux-i686.tar.bz2

This is where there are two different paths to take. The binary `bin/phantomjs` is ready to use, so you can 

1. Just move it and delete the rest of the files once you clear your Download folder the next time or 

2. Move the entire folder somewhere (say the Repositories folder) and symlink the relevant binary

In case you haven't caught this nice little tip before: Write the first few letters of the path- or filename and press `tab` for autocomplete, if you're not just copy/pasting.

### Sidenote, ~/bin vs /usr/local/bin
I like to use the home-folder to store things like binaries, because it makes it a lot easier for me to backup everything I need the next time I need to reinstall, which is why I'm writing this with the assumption that you will put the binaries in `~/bin`. I will then store most source packages under `/home/user/repositories`. Another reason is that I prefer to not need to use `sudo` on normal commands.

If you prefer another way, or need to share packages between several users on one computer, you may want to replace `~/bin` with `/usr/local/bin`, and `~/repositories` with `/usr/local/src`, but then you need to ensure that you are prepending the commands with `sudo`, as the `/usr/local/` folder is owned by root.

### Path 1 

    #If you don't have bin under your home folder, create it
    mkdir ~/bin

    #64-bit
    mv phantomjs-1.9.1-linux-x86_64/bin/phantomjs ~/bin/phantomjs

    #32-bit
    mv phantomjs-1.9.1-linux-i686/bin/phantomjs ~/bin/phantomjs


### Path 2
This will just be shown using the 64-bit, but as always prior: replace `x86_64` with `i686` to instead use the 32-bit one.

    #If it does not exist, create ~/repositories
    mkdir ~/repositories
    
    #Move it and rename
    mv phantomjs-1.9.1-linux-x86_64 ~/repositories/phantomjs

Create a symbolic link to your local bin folder (creating it under your home first, see path 1)
    ln -sf ~/repositories/phantomjs/bin/phantomjs ~/bin/phantomjs

### Test it!

    phantomjs --version

If you get an error that it's not installed, close the terminal and open a new one. You might be able to just run the command `. ~/.bashrc` which reloads the file that appends your `/home/user/bin` folder to your `PATH`. If you're still out of luck, google whatever error message you're getting. It's always a good practice when you're running into issues.

## Installing CasperJS
Unlike PhantomJS, you have to take the "second path" of cloning the repository and then symlinking it. The instructions are more or less taken from the [installation information](http://docs.casperjs.org/en/latest/installation.html), with some changes in where to store things.

    #If it does not exist, create ~/repositories
    mkdir ~/repositories
    cd ~/repositories

    #clone the repository from the master branch
    git clone git://github.com/n1k0/casperjs.git
    
    #Symlink the relevant file into your bin
    ln -sf ~/repositories/casperjs/bin/casperjs ~/bin/casperjs

Now test it. Assuming everything worked, you'll get a nice helpmessage, as well as which PhantomJS version you're using.
    casperjs

In case it tells you that it can't find the file, try running the command `python ~/bin/casperjs`. That's what happened when I ran it on my working machine. On the test machine (a virtual 12.04LTS Ubuntu) these commands worked without a hitch.

What I found out was the issue is that somewhere in there, the line endings had ended up screwed up, using DOS line endings where it should be using Unix. What worked for me (and is thus a good start for you) is that beautiful command `dos2unix`.

    sudo apt-get install dos2unix #installs it if it isn't already installed
    dos2unix ~/repositories/casperjs/bin/casperjs #Can't be ran on a linked resource
    casperjs #Check to make sure you get said helpmessage

## Finishing comments
By now you should have both PhantomJS and CasperJS, which will be relevant in future articles, in particular on my workflow.
