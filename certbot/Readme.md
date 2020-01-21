root@ubuntu1604:/home/sushanghimire/htdocs/royalgurkha# certbot certonly --manual -d www.royalgurkha.com
Saving debug log to /var/log/letsencrypt/letsencrypt.log
Starting new HTTPS connection (1): acme-v01.api.letsencrypt.org
Obtaining a new certificate
Performing the following challenges:
http-01 challenge for www.royalgurkha.com

-------------------------------------------------------------------------------
NOTE: The IP of this machine will be publicly logged as having requested this
certificate. If you're running certbot in manual mode on a machine that is not
your server, please ensure you're okay with that.

Are you OK with your IP being logged?
-------------------------------------------------------------------------------
(Y)es/(N)o: Y

-------------------------------------------------------------------------------
Make sure your web server displays the following content at
http://www.royalgurkha.com/.well-known/acme-challenge/vbgr8mXotPfkUUeH_OKpFa7Mnkx-Soi63QxWgcfU2O0 before continuing:

vbgr8mXotPfkUUeH_OKpFa7Mnkx-Soi63QxWgcfU2O0.xAI2wPqbMP5ODRjVkh206_vFE8UOAgiu5NkSKdfjb6U

If you don't have HTTP server configured, you can run the following
command on the target server (as root):

mkdir -p /tmp/certbot/public_html/.well-known/acme-challenge
cd /tmp/certbot/public_html
printf "%s" vbgr8mXotPfkUUeH_OKpFa7Mnkx-Soi63QxWgcfU2O0.xAI2wPqbMP5ODRjVkh206_vFE8UOAgiu5NkSKdfjb6U > .well-known/acme-challenge/vbgr8mXotPfkUUeH_OKpFa7Mnkx-Soi63QxWgcfU2O0
# run only once per server:
$(command -v python2 || command -v python2.7 || command -v python2.6) -c \
"import BaseHTTPServer, SimpleHTTPServer; \
s = BaseHTTPServer.HTTPServer(('', 80), SimpleHTTPServer.SimpleHTTPRequestHandler); \
s.serve_forever()" 
-------------------------------------------------------------------------------
Press Enter to Continue
Waiting for verification...
Cleaning up challenges
Generating key (2048 bits): /etc/letsencrypt/keys/0001_key-certbot.pem
Creating CSR: /etc/letsencrypt/csr/0001_csr-certbot.pem

IMPORTANT NOTES:
 - Congratulations! Your certificate and chain have been saved at
   /etc/letsencrypt/live/www.royalgurkha.com/fullchain.pem. Your cert
   will expire on 2017-07-01. To obtain a new or tweaked version of
   this certificate in the future, simply run certbot again. To
   non-interactively renew *all* of your certificates, run "certbot
   renew"
 - If you like Certbot, please consider supporting our work by:

   Donating to ISRG / Let's Encrypt:   https://letsencrypt.org/donate
   Donating to EFF:                    https://eff.org/donate-le



cat /etc/letsencrypt/live/www.royalgurkha.com/fullchain.pem
cat /etc/letsencrypt/keys/0001_key-certbot.pem
cat  /etc/letsencrypt/csr/0001_csr-certbot.pem
