import urllib3

def download(name, url: list):
    print(f'Downloading {url}')
    try:
        http = urllib3.PoolManager()
        r = http.request('GET', url, preload_content=False)

        with open(name+'.exe', 'w+') as out:
            while True:
                data = r.read(4096)
                if not data:
                    break
                out.write(data)
        r.release_conn()
    except Exception as e:
        return e
