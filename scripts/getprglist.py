#!/usr/local/bin/python
import sqlite3 as sql
import sys

db_conn = sql.connect('../data/MS1.db')

def getprglist():
    conn=db_conn
    c=conn.cursor()
    c.execute(f"SELECT * FROM programm")
    prg_array = c.fetchall()
    return prg_array

getprglist()
