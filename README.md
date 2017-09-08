# M8 Test Application #

A Web application done for M8 as a vacancy test

### Setup ###

+ Framework: Symfony 3
    * Bundles: FOSRestBundle, JMSSerializerBundle, DoctrineMigrationsBundle
+ Configuration:  
    * To enable permissions on each new project: (inside the project root folder)
	    * $- HTTPDUSER=$(ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1)
	    * $- sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
	    * $- sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:$(whoami):rwX var
    * change database config from parameters.yml

+ Startup
    * terminal: $ bin/console doctrine:database:create
    * terminal: $ bin/console doctrine:migrations:diff
    * terminal: $ bin/console doctrine:migrations:migrate
    * terminal: $ bin/console server:run 
    

### Built With ###
* Phpstorm
* Symfony 3 FW
* System: Ubuntu 16.04

