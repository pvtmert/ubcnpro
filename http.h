/*
	http.h: http protocol base definitions
	author: mert akengin
	date: 2016/06/06
	description:
		to be added
*/

#ifndef _HTTP_H_
#define _HTTP_H_

typedef enum http_method {
	HTTP_METHOD_NONE,
	HTTP_METHOD_GET,
	HTTP_METHOD_POST,
	HTTP_METHOD_PUT,
	HTTP_METHOD_DELETE,
	HTTP_METHOD_CONNECT,
	HTTP_METHOD_OPTIONS,
	HTTP_METHOD_TRACE,
	HTTP_METHOD_TRACK,
	HTTP_METHOD_PATCH,
} http_method_t;

typedef enum http_auth_method {
	HTTP_AUTH_NONE,
	HTTP_AUTH_BASIC,
	HTTP_AUTH_DIGEST,
	HTTP_AUTH_NTLM,
} http_auth_method_t;

typedef enum http_cookie_flags {
	HTTP_COOKIE_NONE,
	HTTP_COOKIE_HTTPONLY,
	HTTP_COOKIE_SECURE,
} http_cookie_flags_t;

typedef enum http_cache_method {
	HTTP_CACHE_NONE,
	HTTP_CACHE_REQ_NOCACHE,
	HTTP_CACHE_REQ_NOSTORE,
	HTTP_CACHE_REQ_MAXAGE,
	HTTP_CACHE_REQ_MAXSTALE,
	HTTP_CACHE_REQ_MINREFRESH,
	HTTP_CACHE_REQ_NOTRANSFORM,
	HTTP_CACHE_REQ_ONLYIFCACHED,
	HTTP_CACHE_RESP_PUBLIC,
	HTTP_CACHE_RESP_PRIVATE,
	HTTP_CACHE_RESP_NOCACHE,
	HTTP_CACHE_RESP_NOSTORE,
	HTTP_CACHE_RESP_NOTRANSFORM,
	HTTP_CACHE_RESP_MUSTREVALIDATE,
	HTTP_CACHE_RESP_PROXYREVALIDATE,
	HTTP_CACHE_RESP_MAXAGE,
	HTTP_CACHE_RESP_SMAXAGE,
} http_cache_method_t;

typedef struct http_cookie {
	const char name[64];
	const char value[256];
	const short flags;
} http_cookie_t;

typedef struct http_auth {
	unsigned short method;
} http_auth_t;

typedef struct http_cache {
	unsigned long delta;
	unsigned short type;
} http_cache_t;

typedef struct http_req_header {
	unsigned short method;
	const char uri[256];
	const float version;
	const char host[80];
	const char from[72];
	const char referer[256];
	const char agent[256];
	unsigned short expect;
	unsigned long length;
	unsigned long range[2];
	http_cookie_t *cookies;
	http_cache_t cache;
	http_auth_t auth;
	time_t date;
} http_req_header_t;

typedef struct http_resp_header {
	unsigned short code;

	const char origins[256];
	const long range[2];
	const unsigned short age;
	http_cache_t cache;
	time_t date;
} http_resp_header_t;

typedef struct http_header {
	http_req_header_t req;
	http_resp_header_t resp;
	unsigned short flags;
} http_header_t;

typedef struct http {
	http_header_t headers;
	const char *data;
} http_t;

#endif
