import sys
import pandas as pd
import numpy as np
import yfinance
import requests
import mysql.connector
from mplfinance.original_flavor import candlestick_ohlc
import matplotlib.dates as mpl_dates
import matplotlib.pyplot as plt
plt.rcParams['figure.figsize'] = [17, 12]
plt.rc('font', size = 14)



mydb = mysql.connector.connect(
  host="localhost",
  user="root",
  password="Polubognonet1!",
  database="strategy"
)

currency = sys.argv[1]
price = sys.argv[2]
od = int(float(price))
minprice = od*0.3

print(price);

name = currency
ticker = yfinance.Ticker(name)
df = ticker.history(interval = "1d", start = "2020-06-29", end = "2022-01-09")
df['Date'] = pd.to_datetime(df.index)
df['Date'] = df['Date'].apply(mpl_dates.date2num)
df = df.loc[: , ['Date', 'Open', 'High', 'Low', 'Close']]



def isSupport(df, i):
    support = df['Low'][i] < df['Low'][i - 1] and df['Low'][i] < df['Low'][i + 1] and df['Low'][i + 1] < df['Low'][i + 2] and df['Low'][i - 1] < df['Low'][i - 2]

    return support

def isResistance(df, i):
    resistance = df['High'][i] > df['High'][i - 1] and df['High'][i] > df['High'][i + 1] and df['High'][i + 1] > df['High'][i + 2] and df['High'][i - 1] > df['High'][i - 2]

    return resistance

s =  np.mean((df['High'] - df['Low'])*1)

def isFarFromLevel(l):
   return np.sum([abs(l-x) < s  for x in levels]) == 0

levels = []
dou = []
for i in range(2,df.shape[0]-2):
  if isSupport(df,i):
    l = df['Low'][i]
    lo = int(float(l))
    od = int(float(price))
    do = int(float(minprice))
    if lo<od:
        if isFarFromLevel(l):
            levels.append((i,l))
            dou.append((l))

  elif isResistance(df,i):
    l = df['High'][i]
    lo = int(float(l))
    od = int(float(price))
    do = int(float(minprice))
    if lo<od:
        if isFarFromLevel(l):
            levels.append((i,l))
            dou.append((l))

file_object = open('text.txt', 'w')
file_object.flush()

for valo in dou:
    print(valo)
    file_object.write(str(valo))
    file_object.write("\n")

file_object.close()

def plot_all():
    fig, ax = plt.subplots()

    candlestick_ohlc(ax, df.values, width = 0.04, \
        colorup = 'green', colordown = 'red', alpha = 0.8)

    date_format = mpl_dates.DateFormatter('%h %d %b %Y')
    ax.xaxis.set_major_formatter(date_format)
    fig.autofmt_xdate()
    fig.tight_layout()
    for level in levels:
        plt.hlines(level[1], xmin = df['Date'][level[0]], \
            xmax = max(df['Date']), colors = 'grey')
    fig.show()

    plt.savefig('/var/www/mrpnl.com/public_html/myaccount/candlellevels/foo.png')
    plt.savefig('/var/www/mrpnl.com/public_html/myaccount/candlellevels/foo.png')
    plt.savefig('/var/www/mrpnl.com/public_html/myaccount/candlellevels/foo.png', bbox_inches='tight')

plot_all()
