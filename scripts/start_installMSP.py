import platform;
import os;
import subprocess;

targetp = "";
name = "";

def settarget():
    targetp = os.getcwd();
    return(targetp);

def setname():
    names = [file for file in os.listdir(targetp) if file.endswith('.py')];
    name = "";
    for nameitem in names:
        if(nameitem.find("templateSoftwareWinInstall_") != -1):
            name = nameitem;
            break;
    return(name);

if(platform.uname()[0] == "Windows"):
    targetp = settarget();
    name = setname();
    if(name != ""):
        name = name[:-3];
    else:
        print("Bitte laden sie die Installer Zip Datei erneut von \"comfiSetup\" herunter.");
        input("Zum Beenden bestätigen.");
        os._exit(1);
    if(os.path.exists(os.path.join(targetp, name) + ".exe")):
        os.remove(os.path.join(targetp, name) + ".exe");

    if(platform.architecture()[0] == "32bit"):
        error = subprocess.call(['cmd','/C',os.path.join(targetp, "7zip86.exe"),'/S','/D=\"' + os.environ["PROGRAMFILES(X86)"] + '\\7-Zip\"']);
        if(error == 0):
            pass;
        else:
            print("Installation der Requirements ist fehlgeschlagen. Versuchen sie es bitte erneut.");
            input("Zum Beenden bestätigen.");
            os._exit(1);
        error = subprocess.call(['cmd','/C',os.path.join(targetp, "python386.exe"),'/passive','InstallAllUsers=1','AssociateFiles=1','CompileAll=0','PrependPath=1','Shortcuts=1','Include_doc=1','Include_debug=1','Include_dev=0','Include_exe=1','Include_launcher=1','InstallLauncherAllUsers=1','Include_lib=1','Include_pip=1','Include_symbols=1','Include_tcltk=1','Include_test=1','Include_tools=1','LauncherOnly=0','SimpleInstall=0','SimpleInstallDescription=\"Es wird Python 3 installiert als Requirement für die Installation der Programme.\"']);
        if(error == 0):
            pass;
        else:
            print("Installation der Requirements ist fehlgeschlagen. Versuchen sie es bitte erneut.");
            input("Zum Beenden bestätigen.");
            os._exit(1);
    elif(platform.architecture()[0] == "64bit"):
        error = subprocess.call(['cmd','/C',os.path.join(targetp, "7zip.exe"),'/S','/D=\"' + os.environ["PROGRAMFILES"] + '\\7-Zip\"']);
        if(error == 0):
            pass;
        else:
            print("Installation der Requirements ist fehlgeschlagen. Versuchen sie es bitte erneut.");
            input("Zum Beenden bestätigen.");
            os._exit(1);
        error = subprocess.call(['cmd','/C',os.path.join(targetp, "python3.exe"),'/passive','InstallAllUsers=1','AssociateFiles=1','CompileAll=0','PrependPath=1','Shortcuts=1','Include_doc=1','Include_debug=1','Include_dev=0','Include_exe=1','Include_launcher=1','InstallLauncherAllUsers=1','Include_lib=1','Include_pip=1','Include_symbols=1','Include_tcltk=1','Include_test=1','Include_tools=1','LauncherOnly=0','SimpleInstall=0','SimpleInstallDescription=\"Es wird Python 3 installiert als Requirement für die Installation der Programme.\"']);
        if(error == 0):
            pass;
        else:
            print("Installation der Requirements ist fehlgeschlagen. Versuchen sie es bitte erneut.");
            input("Zum Beenden bestätigen.");
            os._exit(1);
        
    error = subprocess.call(['cmd','/C','pip install auto-py-to-exe'], shell=True);
    if(error == 0):
        pass;
    else:
        print("Installation der Requirements ist fehlgeschlagen. Versuchen sie es bitte erneut.");
        input("Zum Beenden bestätigen.");
        os._exit(1);
    error = subprocess.call(["cmd", "/c", "pyinstaller", "--noconfirm", "--onefile", "--console", "--icon", os.path.join(targetp, "software_install.ico"), "--distpath", targetp, os.path.join(targetp, name) + ".py"], shell=True);
    if(error == 0):
        print("Das dynamische Template wurde erfolgreich erzeugt.\n");
    else:
        print("Die Erzeugung ist fehlgeschlagen. Bitte informieren sie ihren Administrator\\in.\n");
        input("Zum Beenden bestätigen.");
    loeschung = subprocess.call(["cmd", "/c", "del", "/Q", os.path.join(targetp, name) + ".spec"], shell=True);
    loeschung = subprocess.call(["cmd", "/c", "rmdir", "/S", "/Q", os.path.join(targetp, "build")], shell=True);
    loeschung = subprocess.call(["cmd", "/c", "rmdir", "/S", "/Q", os.path.join(targetp, "__pycache__")], shell=True);
    error = subprocess.Popen(os.path.join(targetp, name) + ".exe", shell=True);
else:
    print("Dieses Script funktioniert nur auf \"Windows\" PCs.");
