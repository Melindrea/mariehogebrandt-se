# Colophon

The theme for MarieHogebrandt.se is &copy; 2013 Marie Hogebrandt under the [MIT Licence](/LICENCE.txt), derived from [Roots](http://www.rootstheme.com), [_s](http://www.underscores.me) and the [Golden Grid System](http://www.goldengridsystem.com), proudly powered by [WordPress](http://www.wordpress.org).

## Libraries

[Normalize](http://necolas.github.io/normalize.css/)
:   A CSS library to normalize the styles to compensate for different browsers

[Typeplate](http://typeplate.com/)
:   Typography is not an accident, good typography even less so

[jQuery](http://jquery.com/)
:   *The* Javascript library for modern design

[Modernizr](http://modernizr.com/)
:   Javascript library for checking capabilities

[Selectivizr](selectivizr.com)
:   Polyfill for advanced CSS-selectors

[Fancybox](http://fancyapps.com/fancybox/)
:   A lightbox script for mixed content

[jQuery Mousewheel Plugin](https://github.com/brandonaaron/jquery-mousewheel)
:   Plugin to add cross-browser support for the mousewheel

## Icons <span class="amp">&amp;</span> Ornaments

[We love Icon Fonts!] — A free <span class="amp">&amp;</span> open source icon fonts hosting service for icons.

* [Entypo](http://entypo.com/) by [Daniel Bruce](http://danielbruce.se/)
* [Brandico](http://fontello.github.io/brandico.font/demo.html) by [Fontello](http://fontello.com/)
* [Font Awesome](http://fortawesome.github.io/Font-Awesome/) by [Dave Gandy](http://davegandy.com/)
* [Printers Ornaments One](http://www.fontsquirrel.com/fonts/Printers-Ornaments-One) by Michelle Dixon
* Logo is [Constanze Initials](http://www.dafont.com/constanze-initials.font) by ClaudeP

## Typography

Both text and heading type is [Calendas Plus](http://www.calendasplus.com) by [Atipo](http://www.atipo.es/), a beautiful fontface with a very classical air to it. I like the lines and variance in strokes, which creates a very pleasant view.

The various ornaments on headers and paragraphs, as well as the different styles of headers (crossheads for first three levels, indented sideheads for the following two and finally the run-in sidehead for the sixth level) are inspired by the masterwork <cite>The Elements of Typographic Style</cite> by Robert Bringhurst.

For some extra styling of typographical elements (such as wrapping ampersands in a `span` with the class `amp`) I use an updated version of [WP-Typography](https://github.com/Melindrea/wp-typography), originally created by [Jeffrey D. King](http://kingdesk.com/).

## Development

The creation of this theme is an experiment. It has been based on testing some of the newest and most interesting tools out there, as well as using tried-and-true methods.

## Language Abstraction

[Sassy CSS](http://thesassway.com/)
:   A Pre-processor language heavily based on CSS-syntax. Used together with [Compass](http://compass-style.org) to bring even more ease into the creation of good CSS.

[Markdown](http://daringfireball.net/projects/markdown/)
: Though the HTML is written normally, posts <span class="amp">&amp;</span> pages are written using Markdown, within the context of WordPress the plugin [WP Markdown](http://wordpress.org/extend/plugins/wp-markdown/) by [Stephen Harris](http://www.stephenharris.info/).

## Development Tools
### Dependencies Handler  <span class="amp">&amp;</span> Package Managers

[Ruby](http://www.ruby-lang.org/en/)
:   A language in itself, but for my purposes uses a `gemfile` to install required gems, mainly CSSCSS and Sass.

[NodeJS](http://nodejs.org/)
:   Server-side JavaScript, here only used for installation of build tools such as Grunt, using the package manager `npm` and `package.json` to install required packages

[Bower](http://bower.io/)
:   Handling web dependencies such as Typeplate and WordPress, uses the file `bower.json`

[Composer](http://getcomposer.org/)
:   Dependency manager for PHP

### Various Tools
[GruntJS](http://gruntjs.com/)
:   According to it's creator, Grunt is <q>The JavaScript Task Runner</q>, used to automate boring chores such as automatically lint JavaScript and PHP, compile SCSS and build a lean, mean Modernizr machine. The specifications are found in the project's [Gruntfile](https://github.com/Melindrea/mariehogebrandt-se/blob/master/Gruntfile.js)

[Yeoman](http://yeoman.io/)
:   A workflow more than anything else, where Yo is a scaffolder, pulling in files and creating default settings. This theme is based on the default webapp, but one of my WIP is to create a scaffolder for themes

[CSSCSS](http://zmoazeni.github.io/csscss/)
:   A ruby gem (with a grunt wrapper) for checking CSS for duplicate styles, as one part of a better (and cleaner) codebase
