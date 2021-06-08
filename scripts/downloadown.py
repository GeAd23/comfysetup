#!/usr/bin/python3
import urllib3
import sys

arg_list=sys.argv[1:]

def download(name, urls: list):
    for url in urls:
        print(f'Downloading {url}')
        try:
            http = urllib3.PoolManager()
            r = http.request('GET', url, preload_content=False)

            with open('/usb/data1/'+name+url[:4], 'w+') as out:
                while True:
                    data = r.read(4096)
                    if not data:
                        break
                    out.write(data)
            r.release_conn()
            return True
        except Exception as e:
            print(e)
            return e
