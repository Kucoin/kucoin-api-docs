
KuCoin Developer Documentation Improvement Program
------------------------------

You can visit the live [KuCoin developer documentation](https://docs.kucoin.com).

**As a people's exchange, KuCoin will strive to support as many document languages as possible for everyone's convenience. In the process, We hope to get everyone's help.**

**You can help KuCoin to improve and translate developer documentation together.**

**For document translators with outstanding contributions, KuCoin will reward a small amount of KCS.**

**If you want to add a language to this document, please follow these steps:**

- add **[lang].yml** to **locales**
- add **index.[lang].html.md** to **source/localizable**

**If you only need to improve the translation of a language, you can directly modify the corresponding index.[lang].html.md.**

**KuCoin officially updates the English version after the API change, so the translation should be based on the English version. Before submitting the merge request, please be sure to test it. Do not destroy the main structure of the document.**

<p align="center"><img src="http://docs.kucoin.com/images/api-logo.svg" width=700 alt="KuCoin"></p>
<p align="center"><img src="https://raw.githubusercontent.com/lord/img/master/screenshot-slate.png" width=700 alt="Slate"></p>
<p align="center"><em>The KuCoin Developer Documentation was created with Slate. Check it out at <a href="https://lord.github.io/slate">lord.github.io/slate</a>.</em></p>

### Prerequisites

You're going to need:

 - **Linux or macOS** — Windows may work, but is unsupported.
 - **Ruby, version 2.3.1 or newer**
 - **Bundler** — If Ruby is already installed, but the `bundle` command doesn't work, just run `gem install bundler` in a terminal.

### Getting Set Up

1. Fork this repository on GitHub.
2. Clone *your forked repository* (not our original one) to your hard drive with `git clone git@github.com:Kucoin/kucoin-api-docs.git`
3. `cd kucoin-api-docs`
4. Initialize and start Slate. You can either do this locally, or with Vagrant:

```shell
# either run this to run locally
bundle install
bundle exec middleman server

# OR run this to run with vagrant
vagrant up
```

You can now see the docs at http://localhost:4567. Whoa! That was fast!

Now that Slate is all set up on your machine, you'll probably want to learn more about [editing Slate markdown](https://github.com/lord/slate/wiki/Markdown-Syntax), or [how to publish your docs](https://github.com/lord/slate/wiki/Deploying-Slate).

If you'd prefer to use Docker, instructions are available [in the wiki](https://github.com/lord/slate/wiki/Docker).

### Note on JavaScript Runtime

For those who don't have JavaScript runtime or are experiencing JavaScript runtime issues with ExecJS, it is recommended to add the [rubyracer gem](https://github.com/cowboyd/therubyracer) to your gemfile and run `bundle` again.


Contributors
--------------------

Slate was built by [Robert Lord](https://lord.io) while interning at [TripIt](https://www.tripit.com/).

Thanks to the following people who have submitted major pull requests:

- [@chrissrogers](https://github.com/chrissrogers)
- [@bootstraponline](https://github.com/bootstraponline)
- [@realityking](https://github.com/realityking)
- [@cvkef](https://github.com/cvkef)

Also, thanks to [Sauce Labs](http://saucelabs.com) for sponsoring the development of the responsive styles.

Special Thanks
--------------------
- [Middleman](https://github.com/middleman/middleman)
- [jquery.tocify.js](https://github.com/gfranko/jquery.tocify.js)
- [middleman-syntax](https://github.com/middleman/middleman-syntax)
- [middleman-gh-pages](https://github.com/edgecase/middleman-gh-pages)
- [Font Awesome](http://fortawesome.github.io/Font-Awesome/)
