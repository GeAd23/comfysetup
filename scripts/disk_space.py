#!/usr/bin/python3
import psutil;
import sys;

def disk_space_free(pfad):
    try:
        diskspace = psutil.disk_usage(pfad)[3];
        diskspace = 100.0 - diskspace;
    except:
        diskspace = "None";
    print(str(diskspace)+"% freier Speicherplatz.");
    return diskspace;

disk_space_free(sys.argv[1]);
#disk_space_free("D:\\"); #Debug
