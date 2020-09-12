import sys
import datetime
import requests 
import json
import mysql.connector

url = 'https://www.google.com/maps/preview/review/listentitiesreviews?authuser=0&hl=zh-TW&gl=tw&pb='+sys.argv[1]
City=list()
Category=list()
Title=list()
Price=list()
Address=list()
username=list()
Time=list()
comment=list()
star=list()
Getdatatime=list()
headers = {'user-agent': 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36'}
if url!=0:
    for j in range(0,len(str(url))-3,1):
        if url[j:j+3]=='1i0':
            for k in range(0,8000,10):
                theTime = datetime.datetime.now().strftime('%Y-%m-%d %H:%M')
                new_url=url[:j]+url[j:j+2]+str(k)+url[j+3:]
                text = requests.get(new_url,headers=headers).text
                pretext = ')]}\''
                text = text.replace(pretext,'')
                soup = json.loads(text)
                conlist = soup[2]
                if conlist!=None:
                    for txt in conlist:
                        if str(txt[1])[-2:]!='年前':
                            username.append(str(txt[0][1]))
                            Time.append(str(txt[1]))
                            comment.append(str(txt[3]))
                            star.append(str(txt[4]))
                            Getdatatime.append(theTime)
                        else:
                            break
                elif conlist==None:
                    break
month=['一個月前','二個月前','三個月前','四個月前','五個月前','六個月前'
            ,'七個月前','八個月前','九個月前','十個月前','十一個月前']
count=[0,0,0,0,0,0,0,0,0,0,0]
for i in range(len(Time)):
    if Time[i]=='1 個月前':
        count[0]+=1
    elif Time[i]=='2 個月前':
        count[1]+=1
    elif Time[i]=='3 個月前':
        count[2]+=1
    elif Time[i]=='4 個月前':
        count[3]+=1
    elif Time[i]=='5 個月前':
        count[4]+=1
    elif Time[i]=='6 個月前':
        count[5]+=1
    elif Time[i]=='7 個月前':
        count[6]+=1
    elif Time[i]=='8 個月前':
        count[7]+=1
    elif Time[i]=='9 個月前':
        count[8]+=1
    elif Time[i]=='10 個月前':
        count[9]+=1
    elif Time[i]=='11 個月前':
        count[10]+=1
    else:
        count[0]+=1

conn = mysql.connector.connect(host = '127.0.0.1',
                       port = 3306,
                       user = 'Username',
                       passwd = 'password',
                       db = 'restaurant_db',
                       charset='utf8')
cur = conn.cursor()
into = "INSERT INTO trend_count(month,count) VALUES (%s,%s)"
values = [('一個月前',count[0]),('二個月前',count[1]),('三個月前',count[2]),('四個月前',count[3]),('五個月前',count[4]),('六個月前',count[5])
         ,('七個月前',count[6]),('八個月前',count[7]),('九個月前',count[8]),('十個月前',count[9]),('十一個月前',count[10])]
cur.executemany(into, values)
conn.commit()
conn.close()
