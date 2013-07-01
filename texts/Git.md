The first day of work at Pineberry I set up my workstation (Ubuntu 11.10, upgraded to Ubuntu 12.04 in June). A lot of the things were basic -- PHP, MySQL, Apache... -- but a few things were completely new to me, including Git. 

## So, what is Git?

Git is a Version Control System, a distributed one to be exact. The best description I've seen to explain it comes from [GitMagic](http://www-cs-students.stanford.edu/~blynn/gitmagic/), which compares coding to playing games, and version control to saving progress in different spots that you can return to later.

The distributed part means that there is no central or canon repository, but rather that each repository can be cloned independently, taking a peer-to-peer approach to it.

## Installation
When I first installed it, I used the simplest version: `sudo add-get install git` which installed git, not too surprisingly. However, at a later point I needed to do something -- I can't recall what anymore -- and I found out that the version in Ubuntu is not the newest. For good reasons, obviously, you want to ensure that the stable version of any operating system is stable. 

The version I use now, 1.7.10.4, was installed using the instructions for Ubuntu 10.04 by [Adam Monsen](http://adammonsen.com/post/665).

    sudo apt-get install python-software-properties
    sudo add-apt-repository ppa:git-core/ppa
    sudo apt-get update
    sudo apt-get install git

## Connection between Git and Github
There is some confusion in what Git is and what [Github](http://www.github.com) is. Github is a social coding website, mainly for collaborating on (or storing) Git repositories.
