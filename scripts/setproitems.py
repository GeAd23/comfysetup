import sqlite3 as sql
import sys

db_conn=sql.connect('/var/www/data/MS1.db', timeout=20)

arg_list = sys.argv[1]
items = arg_list.split(",")

def setproitems(items):
    conn=db_conn
    c = conn.cursor()
    profile_id = items[0]
    programms = items[1]
    for programm in programms:
        c.execute(f"""INSERT INTO profile_programms(profile, programms) VALUES ('{profile_id}', '{programm}'""")
    conn.commit()
    conn.close()

setproitems(items)
