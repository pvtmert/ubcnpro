all:
	make "updated: $$(date)"

%:
	git add .
	git commit -am "$@"
	git push

push pull:
	git branch
	git $@

