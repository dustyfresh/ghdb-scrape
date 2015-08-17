#!/bin/bash
# ghetto but it works.. be sure to start TOR before running this to collect DB entries from GHDB
# may need to increase the range ($i), will document this later
for i in {1..4049}; do
	printf "\nDownloading $i...";
	curl -A "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)" --socks5 "socks5://localhost:9050" -s https://www.exploit-db.com/ghdb/$i/ > $i.html;
	printf "OK\n";
done
