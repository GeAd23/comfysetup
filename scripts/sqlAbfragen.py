#!/usr/bin/env python3
import sqlite3;
from sqlite3 import Error;

def create_connection(db_file):
    con = None;
    try:
        con = sqlite3.connect(db_file);
    except Error as e:
        return(e);
    return(con);

def insert_project(con, data_a):
    sql = ''' INSERT INTO projects(name,begin_date,end_date) VALUES(?,?,?); ''';
    cur = con.cursor();
    try:
        cur.execute(sql, data_a);
        con.commit();
    except Error as e:
        return(e);
    return(cur.lastrowid);

def select_project(con, data_a):
    sql = ''' SELECT ? FROM projects WHERE name LIKE '?' ORDER BY ? DESC; ''';
    cur = con.cursor();
    try:
        cur.execute(sql, data_a);
        con.commit();
        return(con.fetchall());
    except Error as e:
        return(e);
    return(cur.lastrowid);
    
def delete_project(con, data_a):
    sql = ''' DELETE FROM projects WHERE id=?; ''';
    cur = con.cursor();
    try:
        cur.execute(sql, data_a);
        con.commit();
    except Error as e:
        return(e);
    return(cur.lastrowid);

def update_project(con, data_a):
    sql = ''' UPDATE projects SET priority = ?, begin_date = ?, end_date = ? WHERE id = ?; ''';
    cur = con.cursor();
    try:
        cur.execute(sql, data_a);
        con.commit();
    except Error as e:
        return(e);
    return(cur.lastrowid);


def main():
    database = r"C:\sqlite\db\pythonsqlite.db";

    # create a database connection
    connect = create_connection(database);
    # create a new project
    project = ('Cool App with SQLite & Python', '2015-01-01', '2015-01-30');
    project_id = insert_project(connect, project);
    
    connect.close();
    return(True);

if __name__ == '__main__':
    main();

#<?php
#$output = shell_exec(escapeshellcmd('/home/pi/temp/Adafruit_Python_DHT/examples/AdafruitDHT.py 22 22'));
#echo $output ;
#?> #Mit Shebang #!   #php user: www-data
