import sys
import requests 
from bs4 import BeautifulSoup

url='https://www.google.com/search?q='+sys.argv[1]+'+台中'
html = requests.get(url)
soup = BeautifulSoup(html.text, 'html.parser')
tag = soup.find_all("span",class_="Eq0J8 oqSTJd")

if tag!=[]:
    star=str(tag[0]).split('>')[1].split('<')[0]
    print(str(tag[0]))
else:
    print(str(0.0))