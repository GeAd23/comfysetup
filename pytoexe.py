import os
import subprocess

path=os.getcwd()
cmd = ["cmd", "/c", "pyinstaller", "--noconfirm", "--onefile", "--console", "--icon", f"{path}//software_install.ico", "--distpath", f"{path}"]

for programm in os.listdir(path):
    if not programm.endswith([".ico", ".py"]):
        fpath = path + programm
        cmd.append(fpath)

subprocess.call(cmd)