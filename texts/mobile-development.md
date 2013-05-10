After a lecture on [WordCamp Stockholm (Swedish)][1] about how to develop for the mobile web (hint: latency is worse than a non-responsive page), followed by the discovery that Compass has functions to base64-encode both [images and fonts][2], I decided to investigate how different parts interact when using different ways to optimize a page for speed.

Every page is tested in [GTmetrix][3], with the results presented [below][4]. Currently I have not made any effort to make it cross-browser, to not cloud the issue. A future post should probably concern how to make it as accessible as possible, as well as look into how much of the heaviness can be cut away. Do all of the font-files need to be encoded, or would it be acceptable to remove some? Feel free to [fork the repository][5] to experiment more.

## Benchmark

The basic page is based on a minimal, responsive template from [Initializr][6], without jQuery or Modernizr, as the test does not factor in JavaScript. I used six icons from [Paul Robert Lloyd][7], and two full font families (including italics, bold and italic bold) ([Alegreya][8] och [Ubuntu][9]). The fonts are accessible both on [Google Webfonts][10] and [FontSquirrel][11]. The experiments use either the Google Webfonts, or the standard web kit from FontSquirrel.

## Techniques

### Minified CSS

The benchmark page uses non-minified CSS, but starting with experiment two, the stylesheet is compressed through [Sass][12].

### Images

Images are served in three different ways:

1. Benchmark is six unique images
2. Using a [Sprite through Compass][13] (marked with IS)
3. Unique images, but encoded in base64 to lessen HTTP requests (marked with II)

### Fonts

The fonts are served in four different ways:

1. Every font by itself, in all necessary formats, using the web kit from FontSquirrel, locally
2. Google Webfonts, `@import`-ed into the stylesheet (marked with FG)
3. Google Webfonts, `<link>`-ed in the header (marked with FGL)
4. Base64 encoded into the CSS-file (marked with FI)

## Results

<table id="results">
  <tr>
    <th>
    </th>
    
    <th>
      Page Speed Grade
    </th>
    
    <th>
      YSlow Grade
    </th>
    
    <th>
      Total page size
    </th>
    
    <th>
      Total # of requests
    </th>
    
    <th>
      Load (s) *
    </th>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index.html">Base</a>
    </th>
    
    <td>
      B (81%)
    </td>
    
    <td>
      B (87%)
    </td>
    
    <td>
      161KB
    </td>
    
    <td>
      16
    </td>
    
    <td>
      4.63
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-2.html">Minified (2)</a>
    </th>
    
    <td>
      B (81%)
    </td>
    
    <td>
      B (87%)
    </td>
    
    <td>
      159KB
    </td>
    
    <td>
      16
    </td>
    
    <td>
      4.62
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-3.html">IS (3)</a>
    </th>
    
    <td>
      A (97%)
    </td>
    
    <td>
      A (95%)
    </td>
    
    <td>
      159KB
    </td>
    
    <td>
      11
    </td>
    
    <td>
      3.37
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-4.html">FG (4)</a>
    </th>
    
    <td>
      C (73%)
    </td>
    
    <td>
      B (86%)
    </td>
    
    <td>
      344KB
    </td>
    
    <td>
      17
    </td>
    
    <td>
      5.59
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-5.html">FG, IS (5)</a>
    </th>
    
    <td>
      A (91%)
    </td>
    
    <td>
      A (94%)
    </td>
    
    <td>
      344KB
    </td>
    
    <td>
      12
    </td>
    
    <td>
      4.34
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-6.html">II (6)</a>
    </th>
    
    <td>
      A (98%)
    </td>
    
    <td>
      A (97%)
    </td>
    
    <td>
      159KB
    </td>
    
    <td>
      10
    </td>
    
    <td>
      3.12
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index.html-7">FG, II (7)</a>
    </th>
    
    <td>
      A (93%)
    </td>
    
    <td>
      A (95%)
    </td>
    
    <td>
      344KB
    </td>
    
    <td>
      11
    </td>
    
    <td>
      4.09
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-8.html">FI (8)</a>
    </th>
    
    <td>
      B (87%)
    </td>
    
    <td>
      B (87%)
    </td>
    
    <td>
      490KB
    </td>
    
    <td>
      8
    </td>
    
    <td>
      3.91
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-9.html">FI, II (9)</a>
    </th>
    
    <td>
      A (97%)
    </td>
    
    <td>
      A (97%)
    </td>
    
    <td>
      491KB
    </td>
    
    <td>
      2
    </td>
    
    <td>
      2.42
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-10.html">FI, IS (10)</a>
    </th>
    
    <td>
      A (92%)
    </td>
    
    <td>
      A (95%)
    </td>
    
    <td>
      490KB
    </td>
    
    <td>
      3
    </td>
    
    <td>
      2.66
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-11.html">FGL (11)</a>
    </th>
    
    <td>
      C (76%)
    </td>
    
    <td>
      B (86%)
    </td>
    
    <td>
      344KB
    </td>
    
    <td>
      17
    </td>
    
    <td>
      5.59
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-12.html">FGL, IS (12)</a>
    </th>
    
    <td>
      A (95%)
    </td>
    
    <td>
      A (94%)
    </td>
    
    <td>
      344KB
    </td>
    
    <td>
      12
    </td>
    
    <td>
      4.34
    </td>
  </tr>
  
  <tr>
    <th>
      <a href="/initializr/index-13.html">FGL, II (13)</a>
    </th>
    
    <td>
      A (97%)
    </td>
    
    <td>
      A (95%)
    </td>
    
    <td>
      344KB
    </td>
    
    <td>
      11
    </td>
    
    <td>
      4.09
    </td>
  </tr>
</table>

<small>* Calculated on a bandwidth of 0.25Mbit, and latency of 0.25s/call</small>

[1]: http://wpsthlm.se/wordcamp-stockholm-2012/session-tank-pa-det-har-nar-du-bygger-for-mobilen/
[2]: http://compass-style.org/reference/compass/helpers/inline-data/
[3]: http://gtmetrix.com/
[4]: #results
[5]: https://github.com/Melindrea/mobile-base64-encoding-test
[6]: http://www.initializr.com/
[7]: http://paulrobertlloyd.com/2009/06/social_media_icons/
[8]: http://www.google.com/webfonts/specimen/Alegreya
[9]: http://www.google.com/webfonts/specimen/Ubuntu
[10]: http://www.google.com/webfonts
[11]: http://www.fontsquirrel.com/
[12]: http://www.thesassway.com
[13]: http://compass-style.org/help/tutorials/spriting/
