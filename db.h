/*
	db.h: database base definitions
	author: mert akengin
	date: 2016/06/06
	description:
		to be added
*/

#ifndef _DB_H_
#define _DB_H_

typedef struct url {
	unsigned long id;
	const char url[256];
} url_t;

typedef struct click {
	unsigned long id;
	url_t *url;
} click_t;

#endif