# Creating my theme
<entry>
Workflow, tools and inspiration used to build MarieHogebrandt.se
</entry>

So, back in December of 2012 I bought the domain name mariehogebrandt.se, with the intent of replacing webpage I'd had prior to that, which was hosted through my brother-in-law and my sister. I'd already started something like blogging on another of my domain names, [Melindrea.net](http://blog.melindrea.net), but it was only in Swedish, and I knew I had to do something about it. As you might know, the plan for this site is to have it both in English and Swedish, but let's not get ahead of ourselves. I want to start this series with explaining what went on before I touched a single line of code.

## Design and content
I agree fully that "content is king", so I knew that before I could come up with a design, I would need to decide what kind of content I was wanting. I came up with the following list on what I wanted my site for:

1. Presentation of myself. Why have a page with my name on it without selling my own brand, so to speak?
2. Articles and tutorials on various things in technology. I enjoy writing, and I really enjoy programming, so I knew I wanted to use my site as a tool to publish articles that I hope others will enjoy and get use out of as well, especially with the focus in Web currently on using Apple products. I don't at all mind Apple, but I enjoy my Ubuntu.
4. Various displays of my creativity, such as links to projects on Github and other places, a gallery of Deviant Art images (WIP), role playing characters and maybe the odd poem or story.

What this confirmed to me is that a majority of my content is text, which means that the typography is important, which has [already been covered](http://mariehogebrandt.se/articles/showing-typographic-work/). I also knew that I want to stray from some of the more [flamboyant](http://exalted.melindrea.net/) [designs](http://www.exaltedage.net/) I've made, while still showing who I am.

### History
Let's back up for a moment. I've been doing webpages for over half my life. When I did my first few, we used frames. I moved from there to tables, and finally over into CSS. I idolised [CSS Zengarden](http://csszengarden.com/) (though seriously, who didn't?!?), and wished I had the graphical design background to pull that off.

In time for graduation I finished a design that looked like pictures of the ocean hanging on a wall, but it wasn't responsive. A shame, really, because it was pretty. Going from there I mused a while the idea of using a bunch of tabs on the side of a folder as a design idea, but it became too messy, too complicated. In the end I decided on the subtle effects in the current theme.

### Typography
The first version of the typography was before I read <cite>The Ele­ments of Typo­graphic Style</cite>, with Georgia as bodytext, paired with [Playfair Display](http://www.google.com/webfonts/specimen/Playfair+Display) by Claus Eggers Sørense. Georgia has grown on me lately, I like its round forms and beautiful numerals, and Playfair Display - especially in its boldest form - complimented it quite nicely. However, when I saw [Calendas Plus](http://www.calendasplus.com) by [Atipo](http://www.atipo.es/), I preferred it to Georgia for bodytext, and it was too different from Playfair Display to play fair with it, so to speak.

At the time of me finalising the typography I had also read <cite>The Ele­ments of Typo­graphic Style</cite> and decided I liked some of the different headings and suggestings it put forth. To me, the current type is somewhat whimsical and not quite modern, while also not (hopefully) being too dated.

Of course, Calendas Plus is not very suited for code. That is why I for all the code sections use [Source Code Pro](https://github.com/adobe/source-code-pro) by Adobe, which happens to be the same font I myself code in.

### Grid considerations
Using a grid when designing does make a lot of sense, but I want it to be easily made responsible. I've read about other grids (and tried some but not all), but I decided on using the [Golden Grid System](http://goldengridsystem.com/). It's not the first time I've used it, and it's simplicity fits my needs. It can require a bit of extra effort in getting backgrounds of the boxes to work together, and it's not a grid system with pre-defined classes, so if one wants something closer to that one need to define them oneself.

I use the class `l-container` as the class on every element that should be, well, a container, and a couple of different classes to set how it behaves at various breakpoints. The system uses padding and border-box to get the percentage correct, but that leads to the issue that if one, as I did, want to have a background on elements, with a visible gutter. To solve that, I have an inner element (with the class `inner`) which has the actual background. 

Currently, I have three different layouts. `content-first` is the layout with a sidebar to the right of the actual content, `content-text` is a single column with a lot of padding, to be used for pure text content, and `content-media` is to be used for galleries. There is not as much padding, since images should fill out the area more.

### Colour scheme
I love greenish-blue shades, and I settled for the shade `#00AE68`. The theme uses different shades of the tetrad originating from it, as seen [at Color Scheme Designer](http://colorschemedesigner.com/#3441Tw0wbw0w0). The shades for body copy and headers are darkened versions of `#007144`, while not being purely black, to keep the scheme solid. I wanted to keep the site fairly light, but with at least something going on, which is why I went with a [Subtle Pattern](http://subtlepatterns.com/) called Exclusive Paper. 

## Putting it together
The next few articles will cover more in detail how I went about, with Grunt tasks and the various scripts that went into it, as well as how I separated the workflow into "frontend" and "backend".
