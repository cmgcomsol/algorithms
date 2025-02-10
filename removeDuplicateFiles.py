import os
import hashlib

pathstocheck=[
	"C:/Users/HP/Downloads"
]

filelist=[]

for p in pathstocheck:
	for file in os.listdir(p):
		if "%s/%s"%(p,file) not in filelist:
			filelist.append("%s/%s"%(p,file))

duplicatelist={}
for i in range(len(filelist)):
	file=filelist[i]
	percentage="%.2f%% "%((i/(len(filelist)-1)*100))
	print("\r\t",percentage,"\t %s/%s"%(i,len(filelist)-1),file,end=" ")
	filemd5=hashlib.md5(open(file,'rb').read()).hexdigest()
	#print(filemd5,file)
	if filemd5 not in duplicatelist.keys():
		duplicatelist[filemd5]=[file,]
	else:
		duplicatelist[filemd5].append(file)

for key in duplicatelist:
	if len(duplicatelist[key])>1:
		print(key, len(duplicatelist[key]),duplicatelist[key])
		for i in range(1,len(duplicatelist[key])):
			print ("removing",duplicatelist[key][i])
			os.unlink(duplicatelist[key][i])