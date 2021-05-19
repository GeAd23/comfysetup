#!/usr/bin/python3
import sqlite3 as sql
import json
import sys

name=sys.argv[1]
db_conn=sql.connect('/var/www/data/MS1.db', timeout=20)

def delprg(prg_name):
    conn=db_conn
    c=conn.cursor()
    c.execute(f"SELECT ID FROM programm WHERE name='{prg_name}'")
    id = c.fetchone()[0]
    c.execute(f"DELETE * from profil_programm WHERE programm = '{id}'")
    c.execute(f"DELETE * FROM programm WHERE ID = '{id}'")
    conn.commit()
    conn.close()
    print(prg_name)
    return prg_name
delprg(name)
