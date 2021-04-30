import sqlite3 as sql
import sys
import json

db_conn=sql.connect('/var/www/data/MS1.db', timeout=20)
arg_list=sys.argv[1]
prg_array = json.load(arg_list)

def setprg(prg_array):
    conn = db_conn
    c = conn.cursor()
    c.execute(f"""INSERT INTO programm(name, url, localurl, program_bild, standard_P, os, last_update, savestate, automatic) 
                    # VALUES '{prg_array[0]}', '{prg_array[1]}', '{prg_array[2]}', '{prg_array[3]}', '{prg_array[4]}', '{prg_array[5]}', '{prg_array[6]}', '{prg_array[7]}', '{prg_array[8]}', '{prg_array[9]}', '{prg_array[10]}'""")
    conn.commit()
    conn.close()

setprg(arg_list)