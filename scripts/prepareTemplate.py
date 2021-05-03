import time;
import sys;
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
    
    def create_exe(self, name):
        #Windows
        #created = subprocess.call(["cmd", "/c", "pyinstaller", "--noconfirm", "--onefile", "--console", "--icon", "C://Users//werner_j//Downloads//software_install.ico", "--distpath", "C://Users//werner_j//Desktop", "C://Users//werner_j//Desktop//" + name]);
        #Linux
        created = subprocess.call("pyinstaller --noconfirm --onefile --console --icon /var/www/scripts/software_install.ico --distpath /var/www/html/installpy/" + name, shell=True);        
        if(created == 0):
            print("Das dynamische Template wurde erfolgreich erzeugt.\n");
        else:
            print("Die Erzeugung ist fehlgeschlagen. Informieren sie ihren Administrator.\n");
        name1 = name.split(".");
        name1 = name1[0];
        #Windows
        loeschung = subprocess.call(["cmd", "/c", "del", "/Q", "C:\\Users\\werner_j\\Desktop\\" + name1 + ".spec"]);
        loeschung = subprocess.call(["cmd", "/c", "rmdir", "/S", "/Q", "C:\\Users\\werner_j\\Desktop\\build"]);
        loeschung = subprocess.call(["cmd", "/c", "rmdir", "/S", "/Q", "C:\\Users\\werner_j\\Desktop\\__pycache__"]);
        #Linux
        loeschung = subprocess.call("sudo rm -rf /var/www/test/" + name1 + ".spec", shell=True);
        loeschung = subprocess.call("sudo rm -rf /var/www/test/build/", shell=True);
        loeschung = subprocess.call("sudo rm -rf /var/www/test/__pycache__/", shell=True);        


programme = sys.argv[1];
programme = programme.split(",");
programm = [];
for item in programme:
    programm.append([item,"false"]);
createdynTemplate1 = prepareTemplate(); 
nametemplate = createdynTemplate1.get_randomized_name(20);

print(nametemplate);
createdynTemplate1.copy_template(nametemplate);
createdynTemplate1.setautoinstall('[["Ppfad 1", "/S"], ["Ppfad 1", "/S"]]');
createdynTemplate1.setsoftware('[["testen.exe", "false"], ["toll//fertiges.exe", "false"]]');
createdynTemplate1.prepare_template("C://Users//werner_j//Documents//PYGS//" + nametemplate);
#Die dynamische Template py zu exe umwandeln
createdynTemplate1.create_exe(nametemplate);
