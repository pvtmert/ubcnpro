
CC      = clang
CFLAGS  = -g
LDFLAGS = -lc -lm -lcurl -lsqlite3
OBJECTS = main.o ll.o db.o http.o
OUTPUT  = ./app

.PHONY: *

%.o: %.c:
	$(CC) $(CFLAGS) -c $<

$(OUTPUT): $(OBJECTS)
	$(CC) $(LDFLAGS) $(OBJECTS) -o $(OUTPUT)


