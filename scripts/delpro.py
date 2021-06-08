import sqlite3 as sql
import sys

name=sys.argv[1]
db_conn=sql.connect('/var/www/data/MS1.db', timeout=20)

def delpro(name):
    conn = db_conn
    c = conn.cursor()
    c.execute(f"""SELECT ID FROM profil WHERE name='{name}'""")
    id = c.fetchone()
    c.execute(f"""DELETE * FROM user_profile WHERE user = '{id}'""")
    c.execute(f"""DELETE * FROM profil_programm WHERE profile = '{id}'""")
    c.execute(f"""DELETE * FROM profile WHERE ID = '{id}' LIMIT 1""")
    conn.commit()
    conn.close()
    print(prg_name)
    return prg_name

delpro(name)
