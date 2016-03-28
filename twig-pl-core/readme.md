# Rendering Twig Like Pattern Lab

# Requirements

- npm
- composer

# Installation

Install dependencies:

		npm install # This will run `composer install` after

To clean, build, serve and watch:

		npm start

To simply clean and compile:

		npm run compile

# CLI Usage

To setup a globally installed command line compile utility; run this first:

		npm link

Now, you can run this from anywhere:

		twig-pattern-library config.yml

The `config.yml` file should contain this content and all paths are relative from that config file:

```yml
src: src/
dist: dist/
globalData:
  - data.yml
```

# Testing

To run tests:

		npm test
