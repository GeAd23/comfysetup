#!/usr/bin/python3
import sqlite3 as sql
import sys

db_conn = sql.connect('/var/www/data/MS1.db')

def getprglist():
    conn=db_conn
    c=conn.cursor()
    c.execute(f"SELECT * FROM programm where os = 'Win';")
    prg_array = c.fetchall()
    db_conn.commit()
    db_conn.close()
    prg_a = "";
    for items in prg_array:
        prg_a += "|";
        for item in items:
            prg_a += str(item) + ",";
    prg_a = prg_a[:-1];
    print(prg_a);
    return prg_a

getprglist()
