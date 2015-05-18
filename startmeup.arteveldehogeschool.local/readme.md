StartMeUp app
=============


[TOC]


I. About
--------

This app is made by [Artevelde University College Ghent][ahs] as part of a project-based scientific research project.

### Project Team

 - Karijn Bonne       (Lecturer/Researcher)
 - Christel De Maeyer (Lecturer/Researcher, project lead)
 - Olivier Parent     (Lecturer/Researcher, design and development)

### Contributors

 - Lies Van Assche (Student, graphic design)
 - Orphée Alliet   (Student, graphic design)

II. Installation
----------------

### Local Development Environment

 - Use [Artevelde Laravel Homestead][artestead].

#### Configuration 

	$ artestead edit
 
```
sites:

…

# StartMeUp
# ---------

    - map: www.startmeup.arteveldehogeschool.local
      to: /home/vagrant/Code/startmeup.arteveldehogeschool.local/www/public
      hhvm: false
```

#### Install Dependencies

	$ cd ~/Code/
	$ git clone http://bitbucket.org/olivierparent/startmeup.arteveldehogeschool.local
	$ cd ~/Code/startmeup.arteveldehogeschool.local/www/
	$ composer self-update
	$ composer install
	$ composer update
	$ npm install
	$ bower install

	$ artestead up
	$ artestead ssh
	vagrant@homestead$ cd ~/Code/startmeup.arteveldehogeschool.local/www/
	vagrant@homestead$ cp .env.example .env
	vagrant@homestead$ database/init.sh
	vagrant@homestead$ ./artestead migrate --seed

### Pages

 - **API**
    - http://www.startmeup.arteveldehogeschool.local/api/v1
 - **Backoffice**
    - http://www.startmeup.arteveldehogeschool.local/backoffice
 - **Frontoffice**
    - http://www.startmeup.arteveldehogeschool.local
    - http://www.startmeup.arteveldehogeschool.local/#/gamification
    - http://www.startmeup.arteveldehogeschool.local/#/goals
    - http://www.startmeup.arteveldehogeschool.local/#/nearby
    - http://www.startmeup.arteveldehogeschool.local/#/settings
 - **Style Guide**
    - http://www.startmeup.arteveldehogeschool.local/styleguide

[ahs]:			http://www.arteveldehogeschool.be/en
[artestead]:	https://github.com/OlivierParent/homestead

