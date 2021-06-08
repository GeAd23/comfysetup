#!/usr/bin/python3
import urllib3
import sys
import validators
import requests

arg_list=sys.argv[1:]

def download(name, urls: list):
    for url in urls:
        try:
            urlCheck(url)
        except Exception as e:
            return e

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

def urlCheck(user_url):    
    url = validators.url(user_url)
    if url:
        try:
            requests.get(user_url)
            return url      
        except requests.ConnectionError as e:
            return e
    else:
        return False