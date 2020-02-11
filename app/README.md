<p align="center">
    <img width=150 src="https://upload.wikimedia.org/wikipedia/fr/thumb/6/62/Minist%C3%A8re_de_l%27%C3%89ducation_nationale_%28logo%2C_2017%29.png/150px-Minist%C3%A8re_de_l%27%C3%89ducation_nationale_%28logo%2C_2017%29.png">
</a></p>

# Educ Management

**"Educ Management"** is a reference application created for Smile training sessions to show how to develop applications following the Symfony Best Practices, according to SensioLabs University courses.

## Installation instructions

### Project requirements

- [PHP ^7.1.3 or higher](http://php.net/manual/fr/install.php)
- PDO-SQLite PHP extension enabled;
- [Composer](https://getcomposer.org/download)
- and the [usual Symfony application requirements][1].

### Installation

1 . Clone the current repository:
```bash
$ git clone https://github.com/GaetanRole/educ-management
```

2 . Move in and create one global `.env.local` or few `.env.{environment}.local` files according to your environments with your default configuration.
**This one is not committed to the shared repository.**
> `.env` equals to the last `.env.dist` file before [november 2018][2].

3.a . Execute these commands below into your working folder to install the project:
```bash
$ composer install
$ composer update
$ bin/console doctrine:database:create
$ bin/console doctrine:migrations:migrate #IfMigrationsExist or bin/console m:m
$ bin/console doctrine:fixtures:load #Load fake data in DB
```

## Usage

```bash
$ cd educ-management
$ php bin/console server:run
```

## Security commands 

```bash
$ bin/console make:user
$ bin/console make:auth #Choice 1
$ bin/console make:registration-form
```

## Makefile usage

```bash
$ make install #Install dependencies
$ make update #Update components
$ make clear #Clear assets, vendors and so on
```

## Git reminder

```bash
$ git pull #Fetch and pull modification
$ git checkout -- [filename] #Undo file modification
$ git checkout -b [branchname] #Create a new branch from another one
$ git add [filename] #Track files
$ git commit -m "Commit message." #Valid a commit object
$ git push #Push all committed files
$ git status #See Git modification
$ git log #See past Git commits
$ git branch #See Git branches
$ git branch -D [banchname] #Delete a specific branch
$ git checkout [branchname] #Switch to a branch
```

[1]: https://symfony.com/doc/current/reference/requirements.html
[2]: https://symfony.com/doc/current/configuration.html#managing-multiple-env-files
