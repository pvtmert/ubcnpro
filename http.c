/*
	http.c: http protocol base implementations
	author: mert akengin
	date: 2016/06/06
	description:
		to be added
*/

#include <stdlib.h>
#include <stdarg.h>
#include <stdbool.h>
#include <string.h>
#include <unistd.h>
#include "http.h"

http_t *http_new(void)
{
	http_t *obj = (http_t*)malloc(sizeof(http_t));
	return obj;
}