#!/usr/bin/python3
import sqlite3
import sys
import json

arg_list=sys.argv[1:]
db_conn=sqlite3.connect('./data/MS1.db', timeout=20)
arg_list=json.dump(arg_list)


def getSoftware(arg_list):
    for prg in arg_list:
        conn=db_conn
        c = conn.cursor()
        c.execute(f"SELECT * FROM programm WHERE name={prg}")
        prg_info = c.fetchall()
        conn.close()
        return prg_info

getSoftware(arg_list)
