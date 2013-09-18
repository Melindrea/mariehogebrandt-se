As I noted in the article on [dividing the areas](), the term "frontend" is different depending on the context. I here, obviously, use the term defined prior rather than the classical CMS definition where the frontend is what's open to normal users (logged in or not), and the backend is the administration layer.

## Why do I divide up the work?

Because to me, it makes a lot more sense — and is easier — to start with some kind of fixed dataset (be that an actual API or just lorem ipsum in one form or another) and focus on what to do with it. I don't want to need to figure out if the underlying problem is relevant to the current task — say faulty JavaScript — or if the database has crashed, or that I have an `error on line 56` of `something.php`.

## Step one, Yeoman (Yo)

This assumes you have [installed Yeoman](), obviously. 

I use Yo to generate the project, with several files. Currently I use `yo webapp`, which is a built-in generator. There are quite a few others, depending on your purpose, and you can search the generators using `npm search yeoman-generator`. To install a new one: `npm install <generator-name>`, and to get some hints (including which generators are installed) run `yo`. Now, a **word of caution**: You will need to have a stable network connection, and I discourage you from generating projects when on any kind of limited — in particular pay-per-bandwidth —, as it will use bower and npm to pull in packages.

And a final note before we continue: This is describing modding a project generated using `yo webapp`, where a future plan of mine is to make an actual generator of the things I change, but as of yet this has been the easiest one. Also, though I will compare my changes to a call made within the few days prior to publishing, the project itself was generated a long time ago, and there have been quite a few changes, so some changes between the two might be less of a choice, and more that.

Create the folder to put the project in. I store all of my web-related projects under `~/projects/web`, if you prefer a different path, replace the name. The naming of the final folder in the path is important, as it will be used by the generator to decide what it should name the project in the `package.json` and `bower.json` files. It uses a slugified version of that folder.

    mkdir -p ~/projects/web/project-name # -p Creates any parts of the path that does not exist
    cd ~/projects/web/project-name
    yo webapp

There's a few different questions, such as using the Bootstrap Sass (I tend to not) and whether or not to  use RequireJS (I tend to not here, either). Use `yo webapp --help` to get a description of options.

This creates several files in the subfolder `app`, where you are supposed to write the application, and `test`, which is where (highly surprising, no?) the unit tests reside. By default `yo webapp` uses mocha for testing, and the first test is already created in `test/spec/test.js`, with the testing file being `test/index.html`.








