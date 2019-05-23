# bionames-backup

Backup BioNames data from CouchDB and MySQL.

## CouchDB

We need views and the actual data.



curl http://direct.bionames.org:5984/archive/_design/export/_view/jsonl  > archive/data.jsonl

curl http://direct.bionames.org:5984/gallica/_design/export/_view/jsonl  > gallica/data.jsonl

curl http://direct.bionames.org:5984/bionames/_design/export/_view/jsonl  > bionames/data.jsonl

curl http://direct.bionames.org:5984/phylota_184/_design/export/_view/jsonl > phylota_184/data.jsonl



## MySQL

Dump of database.
