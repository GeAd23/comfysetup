#!/usr/bin/python3
import sqlite3 as sql
import sys

db_conn = sql.connect('/var/www/data/MS1.db')

def getprolist():
    conn=db_conn
    c=conn.cursor()
    c.execute(f"SELECT * FROM profile;")
    pro_array = c.fetchall()
    db_conn.commit()
    db_conn.close()
    print(pro_array);
    return pro_array

getprolist()
