# discuss
----------

    git clone git@github.com:cheng-zheng/laravel-discuss.git

## 看看有没安装compser

	composer -v		

## 安装compser

	wget https://dl.laravel-china.org/composer.phar -O /usr/local/bin/composer
	chmod a+x /usr/local/bin/composer
	composer config -g repo.packagist composer https://packagist.phpcomposer.com		#国内镜像

## 安装扩展

	composer install
	#能中国镜像可能实效 rm -f composer.lock
	composer install --ignore-platform-reqs		php7问题，忽略php版本


## 要给文件权限

	chmod -R 777 storage/logs

	chmod -R 777 bootstrap/cache

	chmod -R 777 storage/framework


## nginx伪静态

	location / {
		try_files $uri $uri/ /index.php$is_args$query_string;  
	} 
