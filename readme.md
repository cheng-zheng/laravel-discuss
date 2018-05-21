#discuss
----------

    git clone git@github.com:cheng-zheng/laravel-discuss.git

##如果没安装

	composer -v		

##安装compser

	wget https://dl.laravel-china.org/composer.phar -O /usr/local/bin/composer
	chmod a+x /usr/local/bin/composer
	composer config -g repo.packagist composer https://packagist.phpcomposer.com		#国内镜像

##安装扩展

	composer install

	composer install --ignore-platform-reqs		php7问题，忽略php版本

	chmod -R 777 storage/logs

	chmod -R 777 bootstrap/cache

	chmod -R 777 storage/framework


##nginx伪静态

	location / {
		try_files $uri $uri/ /index.php$is_args$query_string;  
	} 