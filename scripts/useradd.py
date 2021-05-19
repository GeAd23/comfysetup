#!/usr/bin/python3
import sqlite3;
import sys;
import time;
import math;
import bcrypt;

def createUser():
    db_conn = sqlite3.connect('/var/www/data/MS1.db');
    #db_conn = sqlite3.connect('D:\\msp\\data\\MS1.db'); #Debug
    c = db_conn.cursor();
    c.execute(f"INSERT INTO users (UID,name,username,password_crypt,admin,active,'exists') VALUES (NULL,'"+name+"','"+username+"','"+passwort+"','"+admin+"','"+active+"','"+time+"');");
    db_conn.commit();
    db_conn.close();
    print("\nUser \""+username+"\" erfolgreich erstellt.");
    return("\nUser \""+username+"\" erfolgreich erstellt.");

def checkUserExists():
    db_conn = sqlite3.connect('/var/www/data/MS1.db');
    #db_conn = sqlite3.connect('D:\\msp\\data\\MS1.db'); #Debug
    c = db_conn.cursor();
    c.execute(f"Select * from users where username = '"+username+"';");
    user_array = c.fetchall();
    db_conn.commit();
    db_conn.close();
    if(len(user_array) == 0):
        return("Gooo");
    else:
        print("\nDer User \""+username+"\" existiert schon. Bitte versuchen sie es mit einen anderen Usernamen erneut.");
        return("\nDer User \""+username+"\" existiert schon. Bitte versuchen sie es mit einen anderen Usernamen erneut.");

print("Dieses Script erstellt einen neuen User in der Datenbank MS1.\nBitte befolgen sie die Anweisungen.\n\n");
userdata = sys.argv[1];
userdata = userdata.split(",");
print(userdata);
name = str(userdata[0]);
username = str(userdata[1]);
admin = str(userdata[2]);
active = "true";
time = str(math.floor(time.time(),));
passwort = "";
passwort1 = str(userdata[3]);
passwort2 = str(userdata[4]);
if(passwort1 != ""):
    if(passwort1 == passwort2):
        passwort = bcrypt.hashpw(passwort1.encode("utf8"), bcrypt.gensalt());
        passwort = passwort.decode("utf8");
    else:
        raise TypeError;
else:
    raise ValueError;

if(passwort != ""):
    checkedUser = checkUserExists();
    if(checkedUser == "Gooo"):
       createUser();
