# Laravel API using Passport

It is a repository which contains the laravel source codes which is modified for the benefits of a API

  - Using Passport
  - Set bearer token on cookie on successful login
  - Set csrf token on every HEAD, GET, OPTIONS and every valid requests.

# Explained!

  - Before the first request to the API there will be no cookies set
  - If client request with a READ requests like "HEAD, GET, OPTIONS" then the server will respond with 2 cookies "laravel_session" and "XSRF-TOKEN"
  - In succeeding requests client will use these cookies by default. (laravel_session will be used to identify the session on server and XSRF-TOKEN will be used by the angular to set a HEADER "X-XSRF-TOKEN")
  - When client perfrom a successful login request and a bearer token will be send in response and in a cookie named "bearer_token" (Ofcourse the XSRF-TOKEN with a new one).
  - Succeeding request to the secured endpoints need not to have a "Authorization" header with "Bearer {token}". Instead of this the bearer_token cookie will send on request and in server the request will be modified with a "Authorization" header with the cookie.
  - In this way everything will be managed by itself.

# Worries!
- On initial request there will no csrf token so request will be blocked on middleware.
- So before request client will need to check for the presence of X-XSRF-TOKEN. In its absence client will have to do a READING request and will get updated with the csrf token on cookie.
- In case of cross domain requests there will be preflights so this problem will not be there.
