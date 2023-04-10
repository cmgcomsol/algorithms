from ntplib import NTPClient
from datetime import datetime, timezone
import win32api
import ctypes, sys

def is_admin():
    try:
        return ctypes.windll.shell32.IsUserAnAdmin()
    except:
        return False

client = NTPClient()
response = client.request('0.in.pool.ntp.org', version=3)

ist=60*60*5+60*30
time = datetime.fromtimestamp(response.tx_time-ist)
print(time)

print(time.weekday())

if is_admin():
    #win32api.SetSystemTime(2020,9,1,21,9,10,10,0)
    win32api.SetSystemTime(time.year, time.month, time.weekday(), time.day, time.hour, time.minute, time.second, 0)
else:
    # Re-run the program with admin rights
    ctypes.windll.shell32.ShellExecuteW(None, "runas", sys.executable, __file__, None, 1)

