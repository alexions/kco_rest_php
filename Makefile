COMPOSER ?= composer
COMPOSER_INSTALLED := $(shell command -v ${COMPOSER} 2> /dev/null)

all: check_composer
	@echo ${HELPER}
	$(COMPOSER) install

test: check_composer
	$(COMPOSER) test

docs: check_composer
	$(COMPOSER) reference

analyze: check_composer
	$(COMPOSER) analyze

clean:
	rm -rf vendor build docs

check_composer:
ifndef COMPOSER_INSTALLED
	$(error "'composer' is not available. Please install composer from https://getcomposer.org or specify composer path \
	COMPOSER=/path/to/composer make")
endif

.PHONY: all