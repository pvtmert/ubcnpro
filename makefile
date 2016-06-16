
all:
	rsync -rP --exclude='ubp.db' . pm:/srv/bcn
	ssh pm -- 'cd /srv/bcn; bash ../perm.sh;'
