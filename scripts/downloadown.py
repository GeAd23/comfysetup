#!/usr/bin/python3
import urllib3

def download(name, urls: list):
    if(len(urls) == 0):
        print("Es wurde keine gültige URL übergeben.")
        return("Es wurde keine gültige URL übergeben.")
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
            return("Gooo")
        except Exception as e:
            print(e)
            return(e)
