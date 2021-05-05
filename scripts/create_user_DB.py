#!/usr/bin/python3
import sqlite3;
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
name = str(input("Bitte geben sie den vollen Namen für den neuen User an : "));
username = str(input("Bitte geben sie den Loginnamen/Usernamen(Alias) für den neuen User an : "));
admin = "";
while(admin != "y" and admin != "n"):
    admin = str(input("Bitte geben sie an, ob der neue User Adminrechte haben soll [y;n] : "));
if(admin == "y"):
    admin = "true";
elif(admin == "n"):
    admin = "false";
active = "true";
time = str(math.floor(time.time(),));
passwort = "";
while(passwort == ""):
    passwort1 = str(input("Bitte geben sie das Passwort für den neuen User ein : "));
    passwort2 = str(input("Bitte geben sie das Passwort für den neuen User erneut ein : "));
    if(passwort1 != ""):
        if(passwort1 == passwort2):
            passwort = bcrypt.hashpw(passwort1.encode("utf8"), bcrypt.gensalt());
            passwort = passwort.decode("utf8");
            break;
checkedUser = checkUserExists();
if(checkedUser == "Gooo"):
   createUser();
