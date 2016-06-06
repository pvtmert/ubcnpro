/*
	ll.c: linked list base implementations
	author: mert akengin
	date: 2016/06/06
	description:
		to be added
*/

#include <stdlib.h>
#include <stdarg.h>
#include <stdint.h>
#include <stdbool.h>
#include <unistd.h>
#include <string.h>

#include "ll.h"

node_t *node_new(void)
{
	node_t *node = (node_t*)malloc(sizeof(node_t));
	return node;
}