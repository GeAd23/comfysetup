import sqlite3 as sql
import json
import sys

name=sys.argv[1]
db_conn=sql.connect('/var/www/data/MS1.db', timeout=20)

def delpro(name):
    conn = db_conn
    c = conn.cursor()
    c.execute(f"""SELECT ID FROM profil WHERE name='{name}'""")
    id = c.fetchone()
    c.execute(f"""DELETE * FROM profil_programm WHERE user = '{id[0]}'""")
    c.execute(f"""DELETE * FROM profil WHERE ID = '{id[0]}' """)
    conn.commit()
    conn.close()