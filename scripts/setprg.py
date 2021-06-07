#!/usr/bin/python3
import sqlite3 as sql
import sys
import downloadown

arg_list=sys.argv[1]
url = arg_list.split(",")[2]
dname = arg_list.split(",")[1]
dname = dname + url[slice(-4, None, 1)] #None/Null ist gleich 0

def setprg(arg_list):
    conn = db_conn
    c = conn.cursor()
    c.execute(f"""INSERT INTO programm(ID, name, url, localurl, program_bild, standard_P, os, last_update, savestate, automatic) 
                    VALUES {arg_list}""")
    conn.commit()
    conn.close()

def errorbyCreate():
    print(error)
    return(error)

error = downloadown.download(dname, url)
if(error == "Gooo"):
    db_conn=sql.connect('/var/www/data/MS1.db', timeout=20)
    setprg(arg_list)
else:
    errorbyCreate()
