​import requests
import json

url = "http://www.thehindu.com/features/magazine/keeping-the-thriller-alive/article7332623.ece" #desired url is to be pasted here 
api = "http://graph.facebook.com/?fields=id,share,og_object%7Blikes.summary(true).limit(0)%7D&id=" 
r = requests.get(api + url)
data = r.text
x = json.loads(data)
share=x['share']['share_count']
like=x['og_object']['likes']['summary']['total_count']
print 'sharecount',share
print 'likescount',like

   
