
backup: tablelist.d
include tablelist.d

tablelist.d: tablelist
	cat $< | sed 's/^/backup: /' | sed 's/$$/.BK/' >$@

tablelist:
	./tablelist.php >$@

%.BK: FORCE
	$(eval DB  := $(*D))
	$(eval TBL := $(*F))
	@mkdir -p $(DB)
	cd $(DB) && $(MAKE) -f ../Makefile.db $(TBL).sql.gz DB=$(DB)

FORCE:
