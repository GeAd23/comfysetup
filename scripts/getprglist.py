#!/usr/bin/python3
import sqlite3 as sql
import sys

db_conn = sql.connect('/var/www/data/MS1.db')

def getprglist():
    conn=db_conn
    c=conn.cursor()
    c.execute(f"SELECT * FROM programm")
    prg_array = c.fetchall()
    print(prg_array);
    return prg_array

getprglist()
