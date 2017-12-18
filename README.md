Jazzy recruitment task
======================

## Requirements

- PHP >= 7.1,
- MySQL / MariaDB
- Composer
- Apache 2 (other http servers can be used instead, but rules from all .htaccess file MUST be rewritten to server config)


## Installation:

All command mentioned in this file should be run at terminal (CMD) in project main dir.

1. Create empty database
2. Copy file
`./app/config/parameters.yml.dist`
to
`./app/config/parameters.yml`
3. Set database parameters in file `./app/config/parameters.yml`.
YML file is text file. Be careful with indentations (spaces at beginning of each line).
4. Run command:
`composer install`
5. Run command:
`bower install`
6. Run command:
`php ./bin/console doctrine:schema:create`
7. Now you can access project in browser. Eg.: `http://localhost/jazzy-code/web`
8. You can configure apache virtualhost (or nginx config) to use `./web/app.php` as document root


## Documentation:

* [Api documentation (HTML)](app/Resources/doc/api.html)
* [Api documentation (Markdown)](app/Resources/doc/api.md)
* [Swagger (JSON)](app/Resources/doc/swagger.json)

----
## Assets


Views (HTML, Twig files) are stored in `./app/Resources/views`

Directories listed below store only generated content (Do not add own files and modify existing content):

* ./vendor
* ./web/bundles

Uploaded files (like images) are stored in `./web/upload`

Uploaded files are cached by browser with long expiration time. It never should be modified.

----
## Cache
To clear cache in production environment:

1. Run command:
`php ./bin/console cache:clear -e=prod`

To clear cache in development environment:

1. Run command:
`php ./bin/console cache:clear -e=dev`

----
## Changelog
* 1.0.0 Recruitment task done


___________
***********
___________



## Overview

Your todays task will be to code a simple API with 4 endpoints.

We prefer Symfony2/3 or Node.js, but any other framework is good.

## Detailed description

API should:


* Provide means to manage entities of "Gnomes":
  * Create new Gnome,
  * Read Gnome,
  * Update Gnome,
  * Delete Gnome

  Gnome object has such properties:
  * Name - any string
  * Strength - int(0-100)
  * Age - int(0-100)
  * Avatar - png file (any size and resolution).

## Requirements/Suggestions

* Project should be done on git, with proper commits history (one commit is not a history)
* Project should be pushed to public git repository
* Final implementation should be on master branch
* You should use some framework
* Provide readme file!
* Autp-generated swagger docs (or other) is a big plus.

## What will be checked (as per functionality)

* If User (by API) is able to create/read/update/delete gnomes.

## What will be checked (as per code).

* Language correctness
* Formatting, code documentation
* Used frameworks (yeah, don't reinvent the wheel)
* If it works;)



## Sidenotes
* Please fill README file with instruction on how to run/build your project. The less it will take for us to run it, the better the score.


## Submitting your work

When finished, send email with your name and link to public repo with solution at [work@jazzy.pro](mailto:work@jazzy.pro)
