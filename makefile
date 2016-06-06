
CC      = clang
CFLAGS  = -g -c
LDFLAGS = -lc -lm -lsqlite3 -lcurl
OBJECTS = main.o ll.o db.o http.o
OUTPUT  = ./app

$(OUTPUT): $(OBJECTS)
	$(CC) $(LDFLAGS) $(OBJECTS) -o $(OUTPUT)

%.o: %.c
	$(CC) $(CFLAGS) -o $@  $<

clean:
	$(RM) $(RMFLAGS) $(OBJECTS) $(OUTPUT)

default: $(OUTPUT)
all: default run
run:
	$(OUTPUT)