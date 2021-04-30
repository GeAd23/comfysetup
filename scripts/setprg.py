import sqlite3 as sql
import sys

db_conn=sql.connect('/var/www/data/MS1.db', timeout=20)
arg_list=sys.argv[1]
arg_list=arg_list.replace("(", "")
arg_list=arg_list.replace(")", "")

def setprg(arg_list):
    conn = db_conn
    c = conn.cursor()
    c.execute(f"""INSERT INTO programm(name, url, localurl, program_bild, standard_P, os, last_update, savestate, automatic) 
                    VALUES {arg_list}""")
    conn.commit()
    conn.close()

setprg(arg_list)