#!/usr/bin/python3
#Zum Ausführen sind aktuell Adminrechte für das Script auf dem Zielrechner nötig
from pywinauto import Application
import ctypes, sys
import sqlite3 as sql

db_conn = sql.connect('/var/www/data/MS1.db')

def get_db_values():
    conn = db_conn
    c = conn.cursor()
    c.execute(f'SELECT id, path FROM autogui')
    path_values = c.fetchall()
    c.execute(f'SELECT id, name FROM autogui')
    name_values = c.fetchall()
    c.execute(f'SELECT id, buttons FROM autogui')
    button_values = c.fetchall()
    return path_values, name_values, button_values


# Check für Adminrechte
def is_admin():
    try:
        return ctypes.windll.shell32.IsUserAnAdmin()
    except:
        return False

def set_path(path_values):
    path = path_values[0][1]
    return path


def set_prog_dialog(name_values):
    prog_dialog = name_values[0][1]
    return prog_dialog


def set_button_list(button_values):
    buttons = button_values[0][1]
    button_list = buttons.split(",")
    print(button_list)
    return button_list


def run_prog_irfan(app, button_list, prog_dialog):
    irfan_button_custom = button_list[-1].split(".")
    button_list.remove(button_list[-1])
    button_list.append(irfan_button_custom)
    for i in button_list:
        if i == "Weiter >":
            app.Dialog["Weiter >"].click()
            print(app.Dialog.print_control_identifiers())
            app.Dialog.wait('ready', timeout=20)
        if type(i) is list:
            app.Dialog["IrfanView FAQs (Häufig gestellte Fragen) Webseite anzeigen"].click()
            app.Dialog["IrfanView starten"].click()
            app.Dialog["Fertig stellen"].click()


def main():
    path_values, name_values, button_values = get_db_values()
    print(get_db_values())
    path = set_path(path_values)
    prog_dialog = set_prog_dialog(name_values)
    button_list = set_button_list(button_values)
    app = Application(backend="uia").start(path)
    if prog_dialog == "IrfanView Setup":
        run_prog_irfan(app, button_list, prog_dialog)
    #print(app.windows())


if __name__ == '__main__':
    if is_admin():
        main()
    else:
        # Re-run mit Adminrechten
        ctypes.windll.shell32.ShellExecuteW(None, "runas", sys.executable, " ".join(sys.argv), None, 1)
