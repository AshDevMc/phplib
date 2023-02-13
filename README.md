# weblibs
A collection of common usfull functions and classes

/libs = php wrapperss and handy functions

/scripts = javascript objects and scripts


#composer

You need to add these to you composer to install the 

{
    "name": "your github name/name your project",
    "description": example",
    "type": "library",
    "license": "proprietary",
    "authors": [ {"name": "Ashley"}],
    
    "_comment": "include my repo.",
    "repositories": [{
        "type": "vcs",
        "url": "https://github.com/AshDevMc/phplib"
    }],
    "minimum-stability": "stable",
    
    "_comment": "require my repo and copyer to copy files",
    "require": {
        "ashdevmc/weblibs": "dev-main",
        "slowprog/composer-copy-file": "~0.3"
    },
    
    "_comment": "setup copy script",
    "scripts": {
        "post-install-cmd": [
            "SlowProg\\CopyFile\\ScriptHandler::copy"
        ],
        "post-update-cmd": [
            "SlowProg\\CopyFile\\ScriptHandler::copy"
        ]
    },
    
    "_comment": "these will copy my files to your project, ovwewriting existing ones",
    "extra": {
        "copy-file": {
            "vendor/ashdevmc/weblibs/libs/": "libs/?",
            "vendor/ashdevmc/weblibs/scripts/": "scripts/?"
        },
        "copy-file-dev": {
            "vendor/ashdevmc/weblibs/libs/": "libs/?"
            "vendor/ashdevmc/weblibs/scripts/": "scripts/?"
        }
    },
    "config": {
        
    }
}

Note: you dont have to include the files to copy my files, however this allows you to ignore the vendor folder when commiting your project.
You can also modify it to only copy files your using and change the folder names.
