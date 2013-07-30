# Installing Grunt, Bower and Yo (Yeoman) for Ubuntu

Summary:

Yeoman is a catch-all phrase (at this time) for Grunt (automation), Bower (package manager) and Yo (scaffolder).

end Summary;

In this particular article, we'll go through how to set up [Grunt](http://gruntjs.com/), [Bower](http://bower.io/) and [Yo](http://yeoman.io/). The installation itself is very easy. You need to run the command `npm install -g yo`, which uses [NodeJS](http://nodejs.org/) to install Yo globally. Yo has Bower and Grunt as dependencies, so at that point it's all done.

The trick is, of course, the dependencies. You need to have installed [Git](/articles/git-and-github-on-ubuntu), and (assuming you're interested in my workflow) [Sass with Compass](/articles/installing-sass-and-compass-on-ubuntu). The third important thing you need to install is NodeJS.

## Preparations

If you did not install Sass, you probably want to update and install the pre-requisites:

    sudo apt-get update
    sudo apt-get upgrade
    sudo apt-get install build-essential openssl libssl-dev curl

## Install NVM
Just as with Ruby, it's occasionally a very good idea to ensure that one can use different versions. I use [Node Version Manager](https://github.com/creationix/nvm) by [Tim Caswell](https://github.com/creationix) and see no reason to change.

Taking a leaf from Ruby and RVM, the project will be cloned into a hidden folder named `.nvm` under your home folder:

    git clone git://github.com/creationix/nvm.git ~/.nvm

You will need to make sure that NVM is loaded when you open a terminal, through the following line:
    echo '[[ -s "$HOME/.nvm/nvm.sh" ]] && source "$HOME/.nvm/nvm.sh" # Load NVM into a shell session *as a function*' >> ~/.bashrc

<small>Note that if you need it in login shells, you should either also add it to `.profile` or `.bash_profile`, or source `.bashrc` in that file.</small>

To be able to use NVM directly, run `. ~/.nvm/nvm.sh`, which will load it into the current shell session.

## Install NodeJS
First, find which version of NodeJS is the current one, most easily accomplished by surfing to [NodeJS homepage](http://nodejs.org/). At the time of the writing, it is v0.10.13.

It might take a bit to install NodeJS, so be patient...

    nvm install v0.10.13 #or whatever is the latest stable at your reading
    nvm alias default 0.10.13 #sets the default assumption of any project to that

## Installing NPM
NPM is the package manager for NodeJS (what a shocker, eh?), with the homepage (and index of packages) at [NPMJS](https://npmjs.org/). It occasionally feels somewhat meta that we will install a package manager (NPM) so that we can install another package manager (Bower), but that is an article for another day.

Oh, look, another cURL script being fetched and then piped through sh!

    curl https://npmjs.org/install.sh | sh

## How to use NPM
As noted above, the command to install Yo and it's dependencies Grunt and Bower is `npm install -g yo`. More often than not, you will want to keep the Node packages local to whichever project you're in, but if you use the `-g` switch, it will install that particular package globally, IE accessible to all projects. 

Another useful command is `npm list` which lists all the packages installed in that project or, with the `-g` switch, globally.

Congratulations, you are now all done and have Grunt, Bower and Yo properly installed!

* [NVM]: Node Version Manager
* [RVM]: Ruby Version Manager
* [NPM]: Node Package Manager
