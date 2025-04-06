import os, sys
from http.server import HTTPServer, CGIHTTPRequestHandler

webdir = '.'  # Каталог с файлами HTML и подкаталогом cgi-bin для сценариев
port = 80     # Порт 80 для http://servername/, иначе http://servername:xxxx/

if len(sys.argv) > 1:
    webdir = sys.argv[1]  # Аргумент 1: корневой веб-каталог
if len(sys.argv) > 2:
    port = int(sys.argv[2])  # Аргумент 2: порт (по умолчанию 80)

print('webdir "%s", port %s' % (webdir, port))
os.chdir(webdir)  # Перейти в корневой веб-каталог

srvraddr = ('', port)  # Хост и порт
srvrobj = HTTPServer(srvraddr, CGIHTTPRequestHandler)
srvrobj.serve_forever()  # Запуск сервера