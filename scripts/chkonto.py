#!/usr/bin/python3
import sqlite3 as sql
import sys

db_conn=sql.connect('/var/www/data/MS1.db', timeout=20)
arg_list=sys.argv[1:]
user = arg_list.split(",")

def update_profile(name, username, password):
    conn=db_conn
    c = conn.cursor()
    c.exceute(f"UPDATE users SET name='{name}', password='{password}' WHERE username='{username}';")
    conn.commit()
    conn.close()

update_profile(user[0], user[1], user[2])
