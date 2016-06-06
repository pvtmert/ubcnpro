/*
	ll.h: linked list base functions
	author: mert akengin
	date: 2016/06/06
	description:
		to be added
*/


#ifndef _LL_H_
#define _LL_H_

typedef union any {
	void *unknown;
} any_t;

typedef struct node {
	any_t data;
	struct node *next;
} node_t;

#endif