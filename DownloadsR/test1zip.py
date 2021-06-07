import os;
import shutil;
import subprocess;

name = "templateSoftwareWinInstall_03062021_161428_C0hK4bxZAtKhYEr8BDsD.py";

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
#os.remove("/var/www/html/installpy/" + name + ".py");
