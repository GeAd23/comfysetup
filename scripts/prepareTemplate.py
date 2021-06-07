#!/usr/bin/python3
import time;
import sys;
import os;
import random;
import string;
import shutil;
import subprocess;

class prepareTemplate:
    autoinstall = ""; #Inhalte kommen aus der Datenbank
    software = "";

    def setautoinstall(self, automode):
        self.autoinstall = automode;

    def setsoftware(self, softwarepakete):
        self.software = softwarepakete;
    
    def get_randomized_name(self, anzahl_letter): #Ein Zufallsname für das dynamische Template erstellen
        time_stamp = time.strftime("%d%m%Y_%H%M%S", time.localtime());
        letters = string.ascii_letters + string.digits;
        name = "templateSoftwareWinInstall_" + time_stamp + "_";
        i = 1;
        name2 = "";
        while(i <= anzahl_letter):
            name2 = name2 + random.choice(letters);
            i = i + 1;
        name = name + name2 + ".py";
        return name;

    def copy_template(self, name): #Standard Template kopieren mit neuen Namen
        shutil.copy2("/var/www/scripts/prepareinstallSoftwareWin.py", "/var/www/html/installpy/" + name, follow_symlinks = True);

    def prepare_template(self, templatefile): #Das dynamische Template öffnen und anpassen
        tfile = open(templatefile, "r+");
        inhalttext = tfile.read();
        tfile.seek(0);
        inhalttext = inhalttext.replace('[["1", "1"]]', self.software);
        inhalttext = inhalttext.replace('[["2", "2"]]', self.autoinstall);
        tfile.write(inhalttext);
        tfile.close();
    
    def create_zip(self, name):
        name = name[:-3];
        os.mkdir("/var/www/html/installpy/" + name);
        shutil.copy2("/var/www/scripts/software_install.ico","/var/www/html/installpy/" + name + "/");
        shutil.copy2("/var/www/scripts/python3.exe","/var/www/html/installpy/" + name + "/");
        shutil.copy2("/var/www/scripts/7zip.exe","/var/www/html/installpy/" + name + "/");
        shutil.copy2("/var/www/scripts/python386.exe","/var/www/html/installpy/" + name + "/");
        shutil.copy2("/var/www/scripts/7zip86.exe","/var/www/html/installpy/" + name + "/");
        shutil.copy2("/var/www/scripts/start_install.exe","/var/www/html/installpy/" + name + "/");
        shutil.copy2("/var/www/html/installpy/" + name + ".py","/var/www/html/installpy/" + name + "/");
        created = subprocess.call("cd /var/www/html/installpy/ && zip -q -9 -r -D /var/www/html/installpy/" + name + " ./" + name + "/*", shell=True);
        shutil.rmtree("/var/www/html/installpy/" + name, ignore_errors=True);
        if(created == 0):
            os.remove("/var/www/html/installpy/" + name + ".py");
            #print("Das dynamische Template wurde erfolgreich erzeugt.\n"); #Debug
            pass;
        else:
            #print("Die Erzeugung ist fehlgeschlagen. Informieren sie ihren Administrator.\n"); #Debug
            pass;

    def get_installerName(self, name):
        print(name);
        return(name);

programme = sys.argv[1];
programme = programme.split(",");
programm = [];
for item in programme:
    programm.append([item,"false"]);
programm = str(programm);
createdynTemplate1 = prepareTemplate(); 
nametemplate = createdynTemplate1.get_randomized_name(20);

#print(nametemplate); #Debug
createdynTemplate1.copy_template(nametemplate);
createdynTemplate1.setautoinstall('[["Ppfad 1", "/S"], ["Ppfad 1", "/S"]]');
createdynTemplate1.setsoftware(programm);
createdynTemplate1.prepare_template("/var/www/html/installpy/" + nametemplate);
#Die dynamische Template py zu exe umwandeln
createdynTemplate1.create_zip(nametemplate);
createdynTemplate1.get_installerName(nametemplate);
