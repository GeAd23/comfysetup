#!/usr/bin/python3
import sqlite3 as sql
import sys

db_conn = sql.connect('/var/www/data/MS1.db')

def getprglist():
    conn=db_conn
    c=conn.cursor()
    c.execute(f"SELECT * FROM programm where os = 'Win' AND standard_P = 'true';")
    prg_array = c.fetchall()
    db_conn.commit()
    db_conn.close()
    print(prg_array);
    return prg_array

getprglist()
