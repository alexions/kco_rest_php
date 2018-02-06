COMPOSER ?= composer
COMPOSER_INSTALLED := $(shell command -v ${COMPOSER} 2> /dev/null)

COMPOSER_INSTALL_DIR ?= /usr/local/bin

install: check_composer
	$(COMPOSER) install

test: check_composer install
	$(COMPOSER) test

docs: check_composer
	$(COMPOSER) reference

analyze: check_composer
	$(COMPOSER) analyze

clean:
	rm -rf vendor build docs

install_composer:
	@php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
	@php -r "if (hash_file('SHA384', 'composer-setup.php') === \
		'544e09ee996cdf60ece3804abc52599c22b1f40f4323403c44d44fdfdd586475ca9813a858088ffbc1f233e9b180f061') \
		{ echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
	@php composer-setup.php --filename=${COMPOSER} --install-dir=$(COMPOSER_INSTALL_DIR)
	@php -r "unlink('composer-setup.php');"

check_composer:
ifndef COMPOSER_INSTALLED
	$(error "'composer' is not available. Please install composer from https://getcomposer.org or specify composer path \
	COMPOSER=/path/to/composer make")
endif

.PHONY: install test docs clean
.DEFAULT_GOAL := test