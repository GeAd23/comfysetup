#!/usr/bin/python3
import sqlite3 as sql
import sys
import os

name=sys.argv[1]
db_conn=sql.connect('/var/www/data/MS1.db', timeout=20)

def delprg(prg_name):
    conn=db_conn
    c=conn.cursor()
    c.execute(f"SELECT ID, localurl FROM programm WHERE name='{prg_name}'")
    dbdata = c.fetchall()
    id = dbdata[0][0]
    ppfad = dbdata[0][1]
    c.execute(f"DELETE * from profil_programm WHERE programm = '{id}'")
    c.execute(f"DELETE * FROM programm WHERE ID = '{id}' LIMIT 1")
    conn.commit()
    conn.close()
    os.remove(ppfad)
    print(prg_name)
    return prg_name
delprg(name)
