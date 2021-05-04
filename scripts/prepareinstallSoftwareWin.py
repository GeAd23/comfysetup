import os;
import time;
import ftplib;
import subprocess;

class dynTemplate:
    log="000";
    startnow = False;
    programs = [['1', '1']];
    automatic_stepdata = [["2", "2"]];
    #programs = [["testen.exe", "false"], ["toll//fertiges.exe", "false"]]; #Debug
    #automatic_stepdata = [["Ppfad 1", "/S"], ["Ppfad 1", "/S"]];

    def startinstallmanager(self):
        startwahl = True; #Installation starten
        while(startwahl == True):
            searchvariant = input("Wollen sie die Installation der Programme starten ? [ja, nein, yes, no, j, y, n] -> : ");
            if(searchvariant == "ja" or searchvariant == "yes" or searchvariant == "j" or searchvariant == "y"):
                self.startnow = True;
                startwahl = False;
            elif(searchvariant == "nein" or searchvariant == "no" or searchvariant == "n"):
                self.startnow = False;
                startwahl = False;
            else:
                startwahl = False;

        if(self.startnow == True):
            downloadfolder = os.getcwd() + "//softwared";
            if not(os.path.exists(downloadfolder)):
                os.mkdir(downloadfolder);
            print("Ziel Downloadordner : " + downloadfolder);


            try:
                ftp = ftplib.FTP("localhost", "progdown", "1234567890");
                #ftp = ftplib.FTP("speedtest.tele2.net"); #Debug
                self.log = ftp.login();
                print(self.log + "\n");
            except:
                print("Keine Verbindung zum Server oder falsche Anmeldedaten. \n");
                time.sleep(10);
                os._exit(1);

            software_download();
            software_installW();
        else:
            os._exit(0);

    def software_download(self):
        print("Download Software ... ");
        #Installationsprogramme herunterladen
        if("230 Login successful." in self.log):
            fortschrittges = len(self.programs);
            fortschritt = 0;
            for program in self.programs:
                fortschritt = fortschritt + 1;
                for operation in program:
                    print(str(fortschritt) + "/" + str(fortschrittges));
                    operationsource = operation;
                    temptarget = operation.split("/");
                    temptarget = temptarget[(len(temptarget)-1)];
                    temptarget = temptarget.split("\\");
                    temptarget = temptarget[(len(temptarget)-1)];
                    operation = temptarget;
                    #print(operation); #Debug
                    print("Quelle : " + os.path.join(downloadfolder, operationsource));

                    try:
                        downfile = open(os.path.join(downloadfolder, operation), 'wb');
                        downloadcomplete = ftp.retrbinary('RETR ' + os.path.join(downloadfolder, operation), downfile.write);
                        #downloadcomplete = ftp.retrbinary('RETR ' + "20MB.zip", downfile.write); #Debug
                        if not("226 Transfer complete." in downloadcomplete):
                            if(os.path.isfile(os.path.join(downloadfolder, operation))):
                                os.remove(os.path.join(downloadfolder, operation));
                        print(downloadcomplete + "\n");
                        downfile.close();
                    except:
                        print("Download fehlgeschlagen ---> " + os.path.join(downloadfolder, operation) + "\n");
                    break;
        if("230 Login successful." in self.log):
            ftp.close();

    def software_installW(self):
        print("Install Software ... ");
        #Programme installieren auch automatisch
        if("230 Login successful." in self.log):
            fortschrittges = len(self.programs);
            fortschritt = 0;
            for program in self.programs:
                fortschritt = fortschritt + 1;
                for operation in program:
                    print(str(fortschritt) + "/" + str(fortschrittges));
                    operationsource = operation;
                    temptarget = operation.split("/");
                    temptarget = temptarget[(len(temptarget)-1)];
                    temptarget = temptarget.split("\\");
                    temptarget = temptarget[(len(temptarget)-1)];
                    operation = temptarget;
                    print(operation); #Debug
                    print("Installationsdatei : " + os.path.join(downloadfolder, operation));
                    automatic = program[1];
                    if(os.path.isfile(os.path.join(downloadfolder, operation))):
                        if(automatic == "false"):
                            try:
                                programmauftrag = subprocess.Popen(os.path.join(downloadfolder, operation), shell=True);
                                #programmauftrag = subprocess.Popen(os.path.join(downloadfolder, "E1.doc"), shell=True); #Debug
                                try:
                                    programmauftrag.wait(180.0);
                                    if(programmauftrag == 0):
                                        print("Die Software [" + operation + "] wurde erfolgreich installiert.");
                                    else:
                                        print("Programm [" + operation + "] konnte nicht installiert werden. \n");
                                except subprocess.TimeoutExpired:
                                    print("Programm [" + operation + "] konnte nicht installiert werden. \n");
                            except:
                                print("Die Datei konnte nicht geöffnet werden.");
                        elif(automatic == "true"):
                            for step in self.automatic_stepdata:
                                programmname = step[0];
                                programmname = programmname.split("/");
                                programmname = programmname[(len(programmname)-1)];
                                programmname = programmname.split("\\");
                                programmname = programmname[(len(programmname)-1)];
                                if(programmname == operation):
                                    silentsteps = step[1];
                                    try:
                                        #programmauftrag = subprocess.Popen("C://Users//werner_j//Desktop//7z2100-x64.exe" + " " + silentsteps, shell=True); #Debug
                                        programmauftrag = subprocess.Popen(os.path.join(downloadfolder, operationsource + " " + silentsteps), shell=True);
                                        try:
                                            programmauftrag.wait(180.0);
                                            if(programmauftrag == 0):
                                                print("Die Software [" + operation + "] wurde erfolgreich silent installiert.");
                                            else:
                                                print("Programm [" + operation + "] konnte nicht installiert werden. \n");
                                        except subprocess.TimeoutExpired:
                                            print("Programm [" + operation + "] konnte nicht installiert werden. \n");
                                    except:
                                        print("Die Datei konnte nicht geöffnet werden.");
                    else:
                        print("Die Datei konnte nicht gefunden werden oder der Dateipfad existiert nicht.");
                    break;

installAssistent1 = dynTemplate();
installAssistent1.startinstallmanager();

time.sleep(20);
os._exit(0);
 
