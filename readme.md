## Mini-CMS
A software exercise using a custom PHP MVC framework and a JSON flat file database on the backend
with bootstrap, jQuery and AngularJS on the front end. This is a simple demo. It's not intended to be a production application,
although it could provide the foundation for a production application. It's only purpose is to provide a basic demonstration of
my PHP and AngularJS programming knowledge for employers who may request sample code.

###Features

- Custom built MVC ([Model View Controller](http://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)) framework.
- AngularJS front end with article listing/sorting/search and article add/edit/update/delete features.
- Responsive pages.
- A simple custom templating and view rendering class.
- A simple REST API for CRUD actions on articles.
- JSON Flat File "database" management class.

## Setup: Prerequisites
- PHP 5.3 or greater
- Webserver (Apache is assumed in this example)

## Setup: Instructions
- Unpack files, if received in an archive, to a suitable location on your webserver.
- Make all files readable by the web server and make the file Mini-CMS/data/cms.json writable by the web server.
- You can take a look at the 'app_config.php' file in Mini-CMS/config, but you probably won't need to change anything to get started.
- Make Mini-CMS/www your document root in your web server configuration.

### Example virtual host file:
```
<VirtualHost *:80>
ServerName mini-cms.local
DocumentRoot "/home/someone/Mini-CMS/www/"
DirectoryIndex index.php index.html

<Directory "/home/someone/Mini-CMS/www/">
    Options Indexes FollowSymLinks
    AllowOverride All
    Order allow,deny
    Allow from all
</Directory>

</VirtualHost>
```

# Project Directory Structure
```
Mini-CMS/
    -- application/
      |
      config/
      |
      data/
      |
      www/
      |
      .gitignore
      readme.md
  ```

# Directory info

- application - the location for all the CMS files and the view templates.
- config - configuration files and classes.
- data - the location of the JSON data file.
- www - the application's web document root.